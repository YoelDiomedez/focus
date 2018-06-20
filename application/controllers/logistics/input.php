<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/input_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $f = array(
            'id'          => 'i.inputID',
            'proveedor'   => 's.companyName',
            'comprobante' => 'r.type',
            'numeroCom'   => 'i.numberReceipt',
            'fechahora'   => 'i.date',
            'estado'      => 'i.status',
            'realtotal'   => 'sum(d.quantity * d.unitPrice) as total'
        );

        $t = array('table' => 'input as i');

        $j = array(
            'table_1' => 'receipt as r',
            'key_1'   => 'r.receiptID = i.receiptID',
            'table_2' => 'supplier as s',
            'key_2'   => 's.supplierID = i.supplierID',
            'table_3' => 'inputdetail as d',
            'key_3'   => 'd.inputID = i.inputID'
        );

        $g = array('input' => 'i.inputID');
        
        $inputs = $this->input_m->get($f, $t, $j, false, $g);

        $data = array('input' => $inputs);

        return $this->load->view('logistics/input/index', $data);
    }

    public function create()
    {
        $this->load->model('logistics/supplier_m');
        $this->load->model('logistics/receipt_m');
        $this->load->model('logistics/product_m');

        $fields = array(
            'supplier' => array('id' => 'supplierID', 'nombre' => 'companyName'),
            'receipt' => array('id' => 'receiptID', 'tipo' => 'type'), 
            'product' => array('id' => 'productID', 'detalle' => 'detail')
        );

        $table = array(
            'supplier' => 'supplier',
            'receipt' => 'receipt',
            'product' => 'product'
        );

        $where = array(
            'supplier' => array('flagState' => 1),
            'receipt' => array('flagState' => 1),
            'product' => array('flagState' => 1) 
        );

        $suppliers = $this->supplier_m->get($fields['supplier'], $table['supplier'],false,$where['supplier']);
        $receipts = $this->receipt_m->get($fields['receipt'], $table['receipt'], $where['receipt']);
        $products = $this->product_m->get($fields['product'], $table['product'], false, $where['product']);

        $data = array(
            'supplier' => $suppliers,
            'receipt' => $receipts,
            'product' => $products
        );

        return $this->load->view('logistics/input/create', $data);
    }

    public function store()
    {
        $input = array(
            'receiptID'     => $this->input->post('receipt'), 
            'supplierID'    => $this->input->post('supplier'),
            'numberReceipt' => $this->input->post('number'),
            'date'          => $this->input->post('fecha')
        );
        
        $productID  = $this->input->post('product');
        $unitPrice  = $this->input->post('price');
        $quantity   = $this->input->post('quantity');

        try {
            $this->db->trans_begin();

            $this->input_m->insert('input', $input);
            $inputID = $this->input_m->last_insert_id();

            for ($i=0; $i <count($productID) ; $i++) {

                $inputDetail = array();
                $inputDetail = array('inputID' => $inputID[0]->id) + $inputDetail;
                $inputDetail['productID'] = $productID[$i];
                $inputDetail['unitPrice'] = $unitPrice[$i];
                $inputDetail['quantity'] = $quantity[$i];
                $this->input_m->insert('inputdetail', $inputDetail);
            }

            if ($this->db->trans_status() === FALSE){
                throw new Exception('Algo salió mal, vuele a intentar.');
            }
            else{
                $this->db->trans_commit();
                echo $inputID[0]->id; 
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $e->getMessage();
        }
    }

    public function show($id)
    {
       $f = array(
            'id'          => 'i.inputID',
            'proveedor'   => 's.companyName',
            'contacto'    => 's.contactName',
            'document'    => 's.numberIdentity',
            'tipodoc'     => 'z.abbreviation',
            'comprobante' => 'r.type',
            'numeroCom'   => 'i.numberReceipt',
            'fechahora'   => 'i.date',
            'estado'      => 'i.status',
            'realtotal'   => 'sum(d.quantity * d.unitPrice) as total'
        );

        $t = array('table' => 'input as i');

        $j = array(
            'table_1' => 'receipt as r',
            'key_1'   => 'r.receiptID = i.receiptID',
            'table_2' => 'supplier as s',
            'key_2'   => 's.supplierID = i.supplierID',
            'table_3' => 'inputdetail as d',
            'key_3'   => 'd.inputID = i.inputID',
            'table_4' => 'identity as z',
            'key_4'   => 's.identityID = z.identityID'
        );

        $g = array('input' => 'i.inputID');

        $w = array('i.inputID' => $id);
        

        $fi = array(
            'product' => 'p.detail',
            'precio' => 'd.unitPrice',
            'cantidad' => 'd.quantity'
        );

        $ta = array('table' => 'inputdetail as d');

        $jo = array(
            'table_1' => 'product as p',
            'key_1'   => 'p.productID = d.productID'
        );

        $wh = array('d.inputID' => $id);
        
        $inputs = $this->input_m->get($f, $t, $j, $w, $g);
        $details = $this->input_m->get($fi, $ta, $jo, $wh);

        $data = array('input' => $inputs, 'detail' => $details);

    	return $this->load->view('logistics/input/show', $data);
    }
    
    public function destroy($id)
    {
        $fields = array(
            'producto' => 'productID',
            'cantidad' => 'quantity'
        );

        $where = array('inputID' => $id);

        $inputD = $this->input_m->get($fields, 'inputdetail', false, $where);

        $status = array('status' => 0);

        try {

            $this->db->trans_begin();

            $this->input_m->update('input', $where, $status);

            for ($i=0; $i <count($inputD) ; $i++) { 

                $f = array(
                    'cantidad' => 'quantity'
                );

                $w = array(
                    'productID' => $inputD[$i]->productID
                );

                $inventory = $this->input_m->get($f, 'inventory', false, $w);

                $data = array();

                $data['quantity'] = $inventory[0]->quantity - $inputD[$i]->quantity;

                $this->input_m->update('inventory', $w, $data);
            }

            if ($this->db->trans_status() === FALSE){
                throw new Exception('Algo salió mal, vuele a intentar.');
            }
            else{
                $this->db->trans_commit();
                echo $id; 
            }

        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $e->getMessage();
        }   
    }
}