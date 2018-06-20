<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipt extends CI_Controller {

	public function __construct()
	{
	    parent::__construct();
        
	    $this->load->model('logistics/receipt_m');

        if (!$this->session->userdata('userLocation')) {
           redirect(site_url(),'refresh');
        }
	}

    public function index()
    {
    	$f = array(
    		'id'   => 'receiptID', 
    		'tipo' => 'type'
    	);

    	$t = array('table' => 'receipt');
    	$w = array('flagState' => 1);
        $receipts = $this->receipt_m->get($f, $t, $w);
        $data = array('receipt' => $receipts);
        
        return $this->load->view('logistics/receipt/index', $data);
    }

    public function store()
    {
        $result = $this->receipt_m->insert('receipt', $_POST);
        echo $result;
    }

    public function edit($id)
    {
        $fields  = array('tipo' => 'type');
        $table   = array('table' => 'receipt');
        $where   = array('flagState' => 1, 'receiptID' => $id);
        $receipt = $this->receipt_m->get($fields, $table, $where);
        echo json_encode($receipt);
    }

    public function update($id)
    {
        $where  = array('flagState' => 1, 'receiptID' => $id);
        $result = $this->receipt_m->update('receipt', $where, $_POST);
        echo $result;
    }

    public function destroy($id)
    {
        $where  = array('receiptID' => $id);
        $data   = array('flagState' => 0);
        $result =  $this->receipt_m->update('receipt', $where, $data);
        echo $result;
    }
}