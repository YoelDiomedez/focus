<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brand extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/brand_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$fields = array(
    		'id'     => 'brandID', 
    		'nombre' => 'name'
    	);

    	$table = array('table' => 'brand');
    	$where = array('flagState' => 1);
        $brands = $this->brand_m->get($fields, $table, $where);
        $data = array('brand' => $brands);
        
        return $this->load->view('logistics/brand/index', $data);
    }

    public function store()
    {
        $result = $this->brand_m->insert('brand', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields = array('nombre' => 'name');
        $table  = array('table' => 'brand');
        $where  = array('flagState' => 1, 'brandID' => $id);
        $brand  = $this->brand_m->get($fields, $table, $where);
        echo json_encode($brand);
    }

    public function update($id)
    {
        $where  = array('flagState' => 1, 'brandID' => $id);
        $result = $this->brand_m->update('brand', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('brandID' => $id);
        $state  = array('flagState' => 0);
        $result =  $this->brand_m->update('brand', $where, $state);
        echo $result;
    }

}
