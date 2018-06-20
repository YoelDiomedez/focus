<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_M extends CI_Model {

    public function __construct()
    {
        parent::__construct();
   	}
   	
	public function get($fields, $table, $join=false, $where=false, $group=false, $order=false, $limit=false)
	{
		$this->db->select($fields);
		$this->db->from($table);

		if ($join!=false)
			for ($i=1; $i <= count($join)/2 ; $i++) {
				$this->db->join($join['table_'.$i], $join['key_'.$i]);
			}
		if($where!=false)
			$this->db->where($where);
        if($group!=false)
			$this->db->group_by($group);
		if($order!=false)
			$this->db->order_by($order['key'], $order['sort']);
		if($limit!=false)
			 $this->db->limit($limit);

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

	public function last_insert_id()
	{
		$this->db->select('last_insert_id() as id', false);
		$query = $this->db->get();

		if($query->num_rows()>0){
			return $query->result();
		}

		return false;
	}
}