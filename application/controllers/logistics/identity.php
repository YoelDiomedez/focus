<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Identity extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
        $this->load->model('logistics/identity_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $f = array(
            'id'          => 'identityID',
            'abreviacion' => 'abbreviation',
            'nombre'      => 'name'
        );

        $t          = array('table' => 'identity');
        $w          = array('flagState' => 1);
        $identities = $this->identity_m->get($f, $t, $w);
        $data       = array('identity' => $identities);

        return $this->load->view('logistics/identity/index', $data);
    }

    public function store()
    {
        $result = $this->identity_m->insert('identity', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields = array(
            'abreviacion' => 'abbreviation',
            'nombre'      => 'name'
        );

        $table  = array('table' => 'identity');

        $where  = array(
            'flagState' => 1, 
            'identityID' => $id
        );

        $identity  = $this->identity_m->get($fields, $table, $where);

        echo json_encode($identity);
    }

    public function update($id)
    {
        $where  = array('flagState' => 1, 'identityID' => $id);
        $result = $this->identity_m->update('identity', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('identityID' => $id);
        $data   = array('flagState' => 0);
        $result =  $this->identity_m->update('identity', $where, $data);
        echo $result;
    }
}
