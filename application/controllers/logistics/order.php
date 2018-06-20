<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
	    
        $this->load->model('logistics/order_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $f = array(
            'id'          => 'o.orderID',
            'sucursal'    => 'l.name',
            'fechaPedido' => 'o.orderDate',
            'fechaEnvio'  => 'o.shippedDate',
            'estado'      => 'o.status'

        );

        $t = array('table' => 'order as o');

        $j = array(
            'table_1' => 'location as l',
            'key_1'   => 'l.locationID = o.locationID'
        );

        $orders = $this->order_m->get($f, $t, $j);

        $data = array('order' => $orders);

        return $this->load->view('logistics/order/index', $data);
    }

    public function create()
    {
        $this->load->model('logistics/location_m');
        $this->load->model('logistics/product_m');

        $fields = array(
            'location' => array('id' => 'locationID', 'nombre' => 'name'),
            'product'  => array('id' => 'productID', 'detalle' => 'detail')
        );

        $table = array(
            'location' => 'location',
            'product'  => 'product'
        );

        $where = array(
            'location' => array('flagState' => 1, 'locationID <>' => 1),
            'product'  => array('flagState' => 1) 
        );

        $locations = $this->location_m->get($fields['location'], $table['location'], $where['location']);
        $products  = $this->product_m->get($fields['product'], $table['product'], false, $where['product']);

        $data = array(
            'location' => $locations,
            'product'  => $products
        );

        return $this->load->view('logistics/order/create', $data);
    }

    public function store()
    {
        $order = array(
            'locationID' => $this->input->post('location'), 
            'orderDate'  => $this->input->post('fecha')
        );
        
        $productID  = $this->input->post('product');
        $quantity   = $this->input->post('quantity');

        try {
            $this->db->trans_begin();

            $this->order_m->insert('order', $order);
            $orderID = $this->order_m->last_insert_id();

            for ($i=0; $i <count($productID) ; $i++) {

                $orderDetail = array();
                $orderDetail = array('orderID' => $orderID[0]->id) + $orderDetail;
                $orderDetail['productID'] = $productID[$i];
                $orderDetail['quantity'] = $quantity[$i];
                $this->order_m->insert('orderdetail', $orderDetail);
            }

            if ($this->db->trans_status() === FALSE){
                throw new Exception('Algo salió mal, vuele a intentar.');
            }
            else{
                $this->db->trans_commit();
                echo $orderID[0]->id; 
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo $e->getMessage();
        }
    }

    public function show($id)
    {
       $f = array(
            'id'        => 'o.orderID',
            'locacion'  => 'l.name',
            'direccion' => 'l.address',
            'fecha'     => 'o.orderDate',
            'estado'    => 'o.status'
        );

        $t = array('table' => 'order as o');

        $j = array(
            'table_1' => 'location as l',
            'key_1'   => 'l.locationID = o.locationID'
        );

        $w = array('o.orderID' => $id);
        

        $fi = array(
            'product'  => 'p.detail',
            'cantidad' => 'd.quantity'
        );

        $ta = array('table' => 'orderdetail as d');

        $jo = array(
            'table_1' => 'product as p',
            'key_1'   => 'p.productID = d.productID'
        );

        $wh = array('d.orderID' => $id);
        
        $orders  = $this->order_m->get($f, $t, $j, $w);
        $details = $this->order_m->get($fi, $ta, $jo, $wh);

        $data = array('order' => $orders, 'detail' => $details);

        return $this->load->view('logistics/order/show', $data);
    }

    public function edit($id)
    {
        $f = array('id' => 'orderID', 'locationID' => 'locationID', 'orderDate'  => 'orderDate');

        $t = array('table' => 'order');

        $w = array('orderID' => $id, 'status' => 'PRESENTADO');

        $of = array(
            'productID' => 'o.productID',
            'detalle'   => 'p.detail',
            'cantidad'  => 'o.quantity' 
        );
        
        $ot = array('table' => 'orderdetail as o');

        $oj = array(
            'table_1' => 'product as p',
            'key_1'   => 'p.productID = o.productID'
        );

        $ow = array('orderID' => $id);

        $this->load->model('logistics/location_m');
        $this->load->model('logistics/product_m');

        $fields = array(
            'location' => array('id' => 'locationID', 'nombre' => 'name'),
            'product'  => array('id' => 'productID', 'detalle' => 'detail')
        );

        $table = array(
            'location' => 'location',
            'product'  => 'product'
        );

        $where = array(
            'location' => array('flagState' => 1),
            'product'  => array('flagState' => 1) 
        );

        $locations = $this->location_m->get($fields['location'], $table['location'], $where['location']);
        $products  = $this->product_m->get($fields['product'], $table['product'], false, $where['product']);

        $order  = $this->order_m->get($f,$t,false,$w);
        $detail = $this->order_m->get($of,$ot,$oj,$ow);

        $data = array(
            'location' => $locations,
            'product'  => $products,
            'o' => $order,
            'd' => $detail
        );
        
        return $this->load->view('logistics/order/edit', $data); 
    }

    public function update($id)
    {
        $l = $this->input->post('location');
        $f = $this->input->post('fecha');

        $p = $this->input->post('p');
        $c = $this->input->post('q');

        $order = array();
        if (!empty($l) && !empty($f)) {
            $order['locationID'] = $l;
            $order['orderDate']  = $f;
        }

        $where = array('orderID' => $id, 'status' => 'PRESENTADO');

        try {
            $this->db->trans_begin();

            if (!empty($order)) {
                $this->order_m->update('order', $where, $order);
            }

            if (!empty($c)) {

                for ($i=0; $i<count($p) ; $i++) {

                    $orderDetail = array();
                    $orderDetail['quantity']  = $c[$i];
                    unset($where['status']);
                    $where = array('productID' => $p[$i]) + $where;
                    $this->order_m->update('orderdetail', $where, $orderDetail);
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

    public function destroy($id)
    {
        $where  = array('orderID' => $id);
        $data  = array('status' => 'CANCELADO', 'shippedDate' => date('Y-m-d'));
        $result =  $this->order_m->update('order', $where, $data);
        echo $result;
    }
}