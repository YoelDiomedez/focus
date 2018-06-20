<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Output extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/output_m');
        
        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $f = array(
            'id'       => 'o.outputID',
            'location' => 'l.name',
            'fecha'    => 'o.date',
            'estado'   => 'o.status',

            'total'    => 'sum(d.quantity * d.unitPrice) as total'
        );

        $t = array('table' => 'output as o');

        $j = array(
            'table_1' => 'location as l',
            'key_1'   => 'l.locationID = o.locationID',

            'table_2' => 'outputdetail as d',
            'key_2'   => 'd.outputID = o.outputID'
        );

        $g = array('output' => 'o.outputID');
        
        $outputs = $this->output_m->get($f, $t, $j, false, $g);

        $data = array('output' => $outputs);
        
        return $this->load->view('logistics/output/index', $data);
    }

    public function create()
    {
        $this->load->model('logistics/order_m');
        $this->load->model('logistics/product_m');

        $fp = array(
            'id'      => 'p.productID',
            'detalle' => 'p.detail',
            'stock'   => 'iv.quantity',
            'precio'  => 'avg(id.unitPrice) as price'
        );

        $tp = array('table' => 'product as p');

        $jp = array(
            'table_1' => 'inventory as iv',
            'key_1'   => 'iv.productID = p.productID',
            'table_2' => 'inputdetail as id',
            'key_2'   => 'id.productID = p.productID',
            'table_3' => 'input as ip',
            'key_3'   => 'ip.inputID = id.inputID' 
        );

        $wp = array(
            'p.flagState'   => 1,
            'iv.quantity >' => 0,
            'iv.locationID' => 1,  
            'ip.status'     => 1 
        );

        $gp = array(
            'product' => 'p.productID',
            'stock'   => 'iv.quantity'
        );

        $fo = array(
            'id'     => 'o.orderID',
            'local'  => 'l.locationID',
            'nombre' => 'l.name'
        );

        $to = array('table' => 'order as o');

        $jo = array(
            'table_1' => 'location as l',
            'key_1'   => 'l.locationID = o.locationID'
        );

        $wo = array('o.status' => 'PRESENTADO');

        $products  = $this->product_m->get($fp, $tp, $jp, $wp, $gp);
        $orders    = $this->order_m->get($fo, $to, $jo, $wo);

        $data = array(
            'product'  => $products,
            'order'    => $orders
        );
        return $this->load->view('logistics/output/create', $data);
    }

    public function store()
    {
        $this->load->model('logistics/product_m');
        $this->load->model('logistics/order_m');

        $output = array(
            'locationID' => $this->input->post('locationID'), 
            'date'       => $this->input->post('fecha')
        );

        $orderd = array(
            'status'  => 'ENVIADO', 
            'shippedDate' => $this->input->post('fecha')
        );

        $orderw = array('orderID' => $this->input->post('orderID'));

        $productID  = $this->input->post('product');
        $unitPrice  = $this->input->post('price');
        $quantity   = $this->input->post('quantity');

        try {
            $this->db->trans_begin();

            $this->output_m->insert('output', $output);
            $outputID = $this->output_m->last_insert_id();

            for ($i=0; $i<count($productID) ; $i++) {

                $stock  = $this->product_m->get(
                                                'quantity', 
                                                'inventory', 
                                                false, 
                                                array('productID' => $productID[$i])
                                            );
                if($quantity[$i] > $stock[0]->quantity){
                    throw new Exception('La cantidad supera al stock.');
                }else{
                    $outputDetail = array();
                    $outputDetail = array('outputID' => $outputID[0]->id) + $outputDetail;
                    $outputDetail['productID'] = $productID[$i];
                    $outputDetail['unitPrice'] = $unitPrice[$i];
                    $outputDetail['quantity']  = $quantity[$i];
                    $this->output_m->insert('outputdetail', $outputDetail);

                    if ($output['locationID'] <> 1) {

                        $f = array('cantidad' => 'quantity');
                        $w = array(
                            'productID'  => $productID[$i], 
                            'locationID' => $output['locationID']
                        );

                        $r = $this->output_m->get($f, 'inventory', false, $w);

                        if ($r == false) {
                            unset($outputDetail['outputID']);
                            unset($outputDetail['unitPrice']);
                            $outputDetail = array('locationID' => $output['locationID']) + $outputDetail;
                            $this->product_m->insert('inventory', $outputDetail);
                            
                        } else {
                            $d = array();
                            $d['quantity'] = $r[0]->quantity + $quantity[$i];
                            $this->output_m->update('inventory', $w, $d);

                        }  
                    }
                }
            }

            $this->order_m->update('order', $orderw, $orderd);

            if ($this->db->trans_status() === FALSE){
                throw new Exception('Algo salió mal, vuele a intentar.');
            }
            else{
                $this->db->trans_commit();
                echo $outputID[0]->id; 
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $e->getMessage();
        }
    }

    public function show($id)
    {
       $f = array(
            'id'        => 'o.outputID',
            'location'  => 'l.name',
            'fechahora' => 'o.date',
            'estado'    => 'o.status',
            'realtotal' => 'sum(d.quantity * d.unitPrice) as total'
        );

        $t = array('table' => 'output as o');

        $j = array(
            'table_1' => 'location as l',
            'key_1'   => 'l.locationID = o.locationID',

            'table_2' => 'outputdetail as d',
            'key_2'   => 'd.outputID = o.outputID'
        );

        $g = array('output' => 'o.outputID');

        $w = array('o.outputID' => $id);
        

        $fi = array(
            'product'  => 'p.detail',
            'precio'   => 'd.unitPrice',
            'cantidad' => 'd.quantity'
        );

        $ta = array('table' => 'outputdetail as d');

        $jo = array(
            'table_1' => 'product as p',
            'key_1'   => 'p.productID = d.productID'
        );

        $wh = array('d.outputID' => $id);
        
        $outputs  = $this->output_m->get($f, $t, $j, $w, $g);
        $details = $this->output_m->get($fi, $ta, $jo, $wh);

        $data = array('output' => $outputs, 'detail' => $details);

        return $this->load->view('logistics/output/show', $data);
    }

    public function destroy($id)
    {
        $fields = array(
            'producto' => 'productID',
            'cantidad' => 'quantity'
        );

        $where = array('outputID' => $id);

        $outputD = $this->output_m->get($fields, 'outputdetail', false, $where); //flase?? wtf

        $status = array('status' => 0);

        try {

            $this->db->trans_begin();

            $this->output_m->update('output', $where, $status);

            for ($i=0; $i <count($outputD) ; $i++) { 

                $f = array(
                    'cantidad' => 'quantity'
                );

                $w = array(
                    'productID'  => $outputD[$i]->productID,
                    'locationID' => 1
                );

                $inventory = $this->output_m->get($f, 'inventory', false, $w);

                $data = array();

                $data['quantity'] = $inventory[0]->quantity + $outputD[$i]->quantity;

                $this->output_m->update('inventory', $w, $data);

                $loc = $this->output_m->get('locationID', 'output', false, $where);

                if ($loc[0]->locationID != 1) {
                    
                    $fl = array('cantidad' => 'quantity');
                    $wl = array(
                        'productID' => $outputD[$i]->productID, 
                        'locationID' => $loc[0]->locationID
                    );

                    $in = $this->output_m->get($fl, 'inventory', false, $wl);

                    $da = array();

                    $da['quantity'] = $in[0]->quantity - $outputD[$i]->quantity;

                    $this->output_m->update('inventory', $wl, $da);
                }
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