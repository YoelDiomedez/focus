<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/supplier_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
        $f = array(
            'id'        => 's.supplierID',
            'documento' => 'i.abbreviation',
            'numero'    => 's.numberIdentity',
            'company'   => 's.companyName',
            'ceo'       => 's.contactName'
        );

        $t = array('table' => 'supplier as s');

        $j = array(
            'table_1' => 'identity as i',
            'key_1'   => 'i.identityID = s.identityID'
        );

        $w = array('s.flagState' => 1);
        $g = array('id' => 's.supplierID');
        $suppliers = $this->supplier_m->get($f, $t, $j, $w, $g);
        $data = array('supplier' => $suppliers);

        return $this->load->view('logistics/supplier/index', $data);
    }

    public function create()
    {
        $this->load->model('logistics/identity_m');
        $f = array(
            'id'          => 'identityID',
            'abreviacion' => 'abbreviation'
        );
        $t = array('table' => 'identity');
        $w = array('flagState' => 1);
        $identities = $this->identity_m->get($f, $t, $w);
        $data = array('identity' => $identities);
        return $this->load->view('logistics/supplier/create', $data);
    }

    public function store()
    {
        $data = array(
            'identityID'     => $this->input->post('identity'),
            'numberIdentity' => $this->input->post('numberI'),
            'companyName'    => $this->input->post('company'),
            'contactName'    => $this->input->post('contact'),

            'address'    => $this->input->post('address'),
            'postalCode' => $this->input->post('zip'),
            'city'       => $this->input->post('city'),
            'region'     => $this->input->post('region'),
            'country'    => $this->input->post('country'),
            'phone'      => $this->input->post('phone'),
            'homePage'   => $this->input->post('web'),
            'email'      => $this->input->post('email'),
        );

        $result = $this->supplier_m->insert('supplier', $data);
        echo $result;
    }

    public function show($id)
    {
    	$f = array(
            'id'        => 's.supplierID',
            'company'   => 's.companyName',
            'ceo'       => 's.contactName',

            'address'    => 's.address',
            'postalCode' => 's.postalCode',
            'city'       => 's.city',
            'region'     => 's.region',
            'country'    => 's.country',
            'phone'      => 's.phone',
            'homePage'   => 's.homePage',
            'email'      => 's.email'
        );

        $t = array('table' => 'supplier as s');

        $w = array('s.flagState' => 1, 's.supplierID' => $id);

        $supplier = $this->supplier_m->get($f, $t, false, $w);

        if (!empty($supplier)) {
            $data = array('s' => $supplier);
            return $this->load->view('logistics/supplier/show', $data);
        }
    }

    public function edit($id)
    {
        $f = array(
            'id'        => 's.supplierID',
            'documento' => 'i.identityID',
            'numero'    => 's.numberIdentity',
            'company'   => 's.companyName',
            'ceo'       => 's.contactName',

            'address'    => 's.address',
            'postalCode' => 's.postalCode',
            'city'       => 's.city',
            'region'     => 's.region',
            'country'    => 's.country',
            'phone'      => 's.phone',
            'homePage'   => 's.homePage',
            'email'      => 's.email'
        );

        $t = array('table' => 'supplier as s');

        $j = array(
            'table_1' => 'identity as i',
            'key_1'   => 'i.identityID = s.identityID'
        );

        $w = array(
            's.flagState' => 1, 
            's.supplierID' => $id
        );

        $g = array('id' => 's.supplierID');

        $supplier = $this->supplier_m->get($f, $t, $j, $w, $g);

        if (!empty($supplier)) {

            $this->load->model('logistics/identity_m');
            $f = array(
                'id'          => 'identityID',
                'abreviacion' => 'abbreviation'
            );

            $t = array('table' => 'identity');
            $w = array('flagState' => 1);

            $identities = $this->identity_m->get($f, $t, $w); 

            $data = array(
                's' => $supplier,
                'i' => $identities
            );
            return $this->load->view('logistics/supplier/edit', $data);
        }
    }

    public function update($id)
    {
        $data = array(
            'identityID'     => $this->input->post('identity'),
            'numberIdentity' => $this->input->post('numberI'),
            'companyName'    => $this->input->post('company'),
            'contactName'    => $this->input->post('contact'),

            'address'    => $this->input->post('address'),
            'postalCode' => $this->input->post('zip'),
            'city'       => $this->input->post('city'),
            'region'     => $this->input->post('region'),
            'country'    => $this->input->post('country'),
            'phone'      => $this->input->post('phone'),
            'homePage'   => $this->input->post('web'),
            'email'      => $this->input->post('email'),
        );

        $where = array('flagState' => 1, 'supplierID' => $id);

        $result = $this->supplier_m->update('supplier', $where ,$data);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('supplierID' => $id);
        $data   = array('flagState' => 0);
        $result =  $this->supplier_m->update('supplier', $where, $data);
        echo $result;
    }
}