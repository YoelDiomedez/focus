<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signin_M extends CI_Model {

    public function __construct()
    {
        parent::__construct();
   	}

	public function get_user($where)
	{
		$this->db->select('u.*',false);
		$this->db->from('user u');
		$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows() == 1){
			return $query->result();
		}

		return false;
	}

	public function get_location($where){

		$this->db->select('l.locationID, l.name');
		$this->db->from('location l, role r');
		$this->db->where('l.locationID = r.locationID');
		$this->db->where('r.userID', $where);
		$this->db->where('r.flagState = 1');

		$query=$this->db->get();

		if($query->num_rows() > 0){
			return $query->result();
		}

		return false;
	}
	public function get_role($locationID)
	{
		$fields = array(
			'locationID' => 'l.locationID',
			'location' => 'l.name',
			'userType' => 'r.type',

			'measures'   => 'r.measures',
			'brands'     => 'r.brands',
			'areas'      => 'r.areas',
			'receipts'   => 'r.receipts',
			'identities' => 'r.identities',
			'locations'  => 'r.locations',
			'users'      => 'r.users',
			'access'    => 'r.access',

			'products'  => 'r.products',
			'suppliers' => 'r.suppliers',
			'orders'    => 'r.orders',
			'inputs'    => 'r.inputs',
			'outputs'   => 'r.outputs',
			'kardex'    => 'r.kardex',
			'statistics' => 'r.statistics'
		);

		$this->db->select($fields);
		$this->db->from('role r');
		$this->db->join('location l', 'l.locationID = r.locationID');

		$this->db->where('r.userID', $this->session->userdata('userID'));
		$this->db->where('r.locationID', $locationID);
		
		$query = $this->db->get();

		if($query->num_rows()>0){
			return $query->result();
		}

		return false;
	}
}