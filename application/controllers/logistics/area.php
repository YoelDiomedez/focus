<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Area extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/area_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$fields = array(
    		'id'     => 'areaID', 
    		'nombre' => 'name'
    	);

    	$table = array('table' => 'area');
    	$where = array('flagState' => 1);
        $areas = $this->area_m->get($fields, $table, $where);
        $data  = array('area' => $areas);
        
        return $this->load->view('logistics/area/index', $data);
    }

    public function store()
    {
        $result = $this->area_m->insert('area', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields = array('nombre' => 'name');
        $table  = array('table' => 'area');
        $where  = array('flagState' => 1, 'areaID' => $id);
        $brand  = $this->area_m->get($fields, $table, $where);
        echo json_encode($brand);
    }

    public function update($id)
    {
        $where  = array('flagState' => 1, 'areaID' => $id);
        $result = $this->area_m->update('area', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('areaID' => $id);
        $state  = array('flagState' => 0);
        $result =  $this->area_m->update('area', $where, $state);
        echo $result;
    }
}
