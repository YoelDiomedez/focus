<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_M extends CI_Model {

    public function __construct()
    {
        parent::__construct();
   	}

	public function get($fields, $table, $where=false)
	{
		$this->db->select($fields);
		$this->db->from($table);

		if($where!=false)
			$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}

	public function insert($table, $data)
	{
		$this->db->insert($table, $data);
		$result = $this->db->affected_rows();
		return $result;
	}

	public function update($table, $where, $data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
		$result = $this->db->affected_rows();
		return $result;
	}
}