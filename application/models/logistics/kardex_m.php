<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kardex_M extends CI_Model {

    public function __construct()
    {
        parent::__construct();
   	}
   	
   	public function query($query){
		$query=$this->db->query($query);
		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}

	public function get($fields, $table, $join=false, $where=false, $group=false)
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

		$query = $this->db->get();

		if($query->num_rows()>0){
			return $query->result();
		}
		return false;
	}
}