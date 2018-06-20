<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/location_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$fields = array(
    		'id'        => 'locationID', 
    		'unidad'    => 'name',
            'direction' => 'address',
            'telefono'  => 'phone'
    	);

    	$table = array('table' => 'location');

    	$where = array('flagState' => 1);

        $locations = $this->location_m->get($fields, $table, $where);

        $data = array('location' => $locations);
   
        return $this->load->view('logistics/location/index', $data);
    }

    public function store()
    {
        $result = $this->location_m->insert('location', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields = array(
            'name'     => 'name',
            'address'  => 'address',
            'phone'    => 'phone'
        );

        $table  = array('table' => 'location');

        $where  = array(
            'flagState'  => 1, 
            'locationID' => $id
        );

        $location  = $this->location_m->get($fields, $table, $where);

        echo json_encode($location);
    }

    public function update($id)
    {
        $where  = array('flagState' => 1, 'locationID' => $id);
        $result = $this->location_m->update('location', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('locationID' => $id);
        $data   = array('flagState' => 0);
        $result =  $this->location_m->update('location', $where, $data);
        echo $result;
    }

}