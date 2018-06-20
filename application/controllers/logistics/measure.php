<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Measure extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/measure_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$fields = array(
    		'id'     => 'measureID', 
    		'unidad' => 'unit'
    	);

    	$table = array('table' => 'measure');
    	$where = array('flagState' => 1);
        $measures = $this->measure_m->get($fields, $table, $where);
        $data = array('measure' => $measures);

        return $this->load->view('logistics/measure/index', $data);
    }

    public function store()
    {
        $result = $this->measure_m->insert('measure', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields = array('unidad' => 'unit');
        $table  = array('table' => 'measure');
        $where  = array('flagState' => 1, 'measureID' => $id);
        $measure = $this->measure_m->get($fields, $table, $where);
        echo json_encode($measure);
    }

    public function update($id)
    {
        $where  = array('flagState' => 1, 'measureID' => $id);
        $result = $this->measure_m->update('measure', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('measureID' => $id);
        $state  = array('flagState' => 0);
        $result =  $this->measure_m->update('measure', $where, $state);
        echo $result;
    }

}
