<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();

        $this->load->model('logistics/input_m');
        $this->load->model('logistics/output_m');
        $this->load->model('logistics/order_m');
        $this->load->model('logistics/product_m');
        
        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $fields = array(
            'inputs' => array('total' => 'sum(unitPrice*quantity) as totalinputs'),
            'outputs' => array('total' => 'sum(unitPrice*quantity) as totaloutputs'),
            'orders' => array('total' => 'count(*) as totalorders'),
            'products' => array('total' => 'count(*) as totalproducts')
        );

        $join = array(
            'inputd' => array('table_1' => 'inputdetail as id', 'key_1' => 'id.inputID = i.inputID'),
            'outputd' => array('table_1' => 'outputdetail as od', 'key_1' => 'od.outputID = o.outputID')
        );

        $where = array(
            'inputs' => array('status' => 1, 'MONTH(i.date)'=> date('m'), 'YEAR(i.date)' => date('Y')),
            'outputs' => array('status' => 1, 'MONTH(o.date)'=> date('m'), 'YEAR(o.date)' => date('Y')),
            'orders' => array('status' => 'PRESENTADO'),
            'products' => array('flagState' => 1)
        );

        $inputs = $this->input_m->get($fields['inputs'],'input as i',$join['inputd'],$where['inputs']);
        $outputs = $this->output_m->get($fields['outputs'],'output as o',$join['outputd'],$where['outputs']);
        $orders   = $this->order_m->get($fields['orders'], 'order', false, $where['orders']);
        $products = $this->product_m->get($fields['products'], 'product', false, $where['products']);

        
        $fd = array(
            'id' => array('f' => 'i.date', 't' => 'sum(id.quantity) as quantity'),
            'od' => array('f' => 'o.date', 't' => 'sum(od.quantity) as quantity')
        );

        $jd = array(
            'id' => array('table_1' => 'inputdetail as id', 'key_1' => 'id.inputID = i.inputID'),
            'od' => array('table_1' => 'outputdetail as od', 'key_1' => 'od.outputID = o.outputID')
        );

        $wd = array(
            'id' => array('status' => 1, 'MONTH(i.date)'=> date('m'), 'YEAR(i.date)' => date('Y')),
            'od' => array('status' => 1, 'MONTH(o.date)'=> date('m'), 'YEAR(o.date)' => date('Y'))
        );

        $gd = array(
            'id' => array('id' => 'i.inputID'),
            'od' => array('od' => 'o.outputID') 
        );

        $ids = $this->input_m->get($fd['id'],'input as i',$jd['id'],$wd['id'],$gd['id']);
        $ods = $this->output_m->get($fd['od'],'output as o',$jd['od'],$wd['od'],$gd['od']);

        $forder = array(
            'product'  => 'product.detail as label',
            'quantity' => 'sum(orderdetail.quantity) as value' 
        );

        $jorder = array(
            'table_1' => 'product',
            'key_1'   => 'product.productID = orderdetail.productID'
        );

        $gorder = array('product' => 'label');
        $oorder = array('key' => 'value', 'sort' => 'DESC');

        $finventory = array(
            'location' => 'location.name as s',
            'totalpro' => 'count(inventory.productID) as tp' 
        );

        $jinventory = array(
            'table_1' => 'location',
            'key_1'   => 'location.locationID = inventory.locationID'
        );

        $winventory = array('inventory.quantity >=' => 1);
        $ginventory = array('location' => 'inventory.locationID');

        $orderdetail = $this->order_m->get($forder,'orderdetail', $jorder, false, $gorder, $oorder, 5);
        $locations = $this->product_m->get($finventory, 'inventory', $jinventory, $winventory, $ginventory);
        
        $data = array(
            'input'    => $inputs,
            'output'   => $outputs,
            'order'    => $orders,
            'product'  => $products,
            'id'       => json_encode($ids),
            'od'       => json_encode($ods),
            'orderdet' => json_encode($orderdetail),
            'location' => json_encode($locations),
            'month'    => date('m'),
            'year'     => date('Y')
        );

        return $this->load->view('logistics/dashboard/index', $data);
    }

    public function show()
    {
        $month = $this->input->post('month');
        $year  = $this->input->post('year');

        $fields = array(
            'inputs' => array('total' => 'sum(unitPrice*quantity) as totalinputs'),
            'outputs' => array('total' => 'sum(unitPrice*quantity) as totaloutputs'),
            'orders' => array('total' => 'count(*) as totalorders'),
            'products' => array('total' => 'count(*) as totalproducts')
        );

        $join = array(
            'inputd' => array('table_1' => 'inputdetail as id', 'key_1' => 'id.inputID = i.inputID'),
            'outputd' => array('table_1' => 'outputdetail as od', 'key_1' => 'od.outputID = o.outputID')
        );

        $where = array(
            'inputs' => array('status' => 1, 'MONTH(i.date)'=> $month, 'YEAR(i.date)' => $year),
            'outputs' => array('status' => 1, 'MONTH(o.date)'=> $month, 'YEAR(o.date)' => $year),
            'orders' => array('status' => 'PRESENTADO'),
            'products' => array('flagState' => 1)
        );

        $inputs = $this->input_m->get($fields['inputs'],'input as i',$join['inputd'],$where['inputs']);
        $outputs = $this->output_m->get($fields['outputs'],'output as o',$join['outputd'],$where['outputs']);
        $orders   = $this->order_m->get($fields['orders'], 'order', false, $where['orders']);
        $products = $this->product_m->get($fields['products'], 'product', false, $where['products']);

        
        $fd = array(
            'id' => array('f' => 'i.date', 't' => 'sum(id.quantity) as quantity'),
            'od' => array('f' => 'o.date', 't' => 'sum(od.quantity) as quantity')
        );

        $jd = array(
            'id' => array('table_1' => 'inputdetail as id', 'key_1' => 'id.inputID = i.inputID'),
            'od' => array('table_1' => 'outputdetail as od', 'key_1' => 'od.outputID = o.outputID')
        );

        $wd = array(
            'id' => array('status' => 1, 'MONTH(i.date)'=> $month, 'YEAR(i.date)' => $year),
            'od' => array('status' => 1, 'MONTH(o.date)'=> $month, 'YEAR(o.date)' => $year)
        );

        $gd = array(
            'id' => array('id' => 'i.inputID'),
            'od' => array('od' => 'o.outputID') 
        );

        $ids = $this->input_m->get($fd['id'],'input as i',$jd['id'],$wd['id'],$gd['id']);
        $ods = $this->output_m->get($fd['od'],'output as o',$jd['od'],$wd['od'],$gd['od']);

        $forder = array(
            'product'  => 'product.detail as label',
            'quantity' => 'sum(orderdetail.quantity) as value' 
        );

        $jorder = array(
            'table_1' => 'product',
            'key_1'   => 'product.productID = orderdetail.productID'
        );

        $gorder = array('product' => 'label');
        $oorder = array('key' => 'value', 'sort' => 'DESC');

        $finventory = array(
            'location' => 'location.name as s',
            'totalpro' => 'count(inventory.productID) as tp' 
        );

        $jinventory = array(
            'table_1' => 'location',
            'key_1'   => 'location.locationID = inventory.locationID'
        );

        $winventory = array('inventory.quantity >=' => 1);
        $ginventory = array('location' => 'inventory.locationID');

        $orderdetail = $this->order_m->get($forder,'orderdetail', $jorder, false, $gorder, $oorder, 5);
        $locations = $this->product_m->get($finventory, 'inventory', $jinventory, $winventory, $ginventory);
        
        $data = array(
            'input'    => $inputs,
            'output'   => $outputs,
            'order'    => $orders,
            'product'  => $products,
            'id'       => json_encode($ids),
            'od'       => json_encode($ods),
            'orderdet' => json_encode($orderdetail),
            'location' => json_encode($locations),
            'month'    => date('m'),
            'year'     => date('Y')
        );

        return $this->load->view('logistics/dashboard/index', $data);
    }
}
