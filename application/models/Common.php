<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Model {

	public function __construct()
	{
		parent::__construct();	
	}

	public function getTableData($table,$where = null,$select = "*",$order_by = null,$group_by = null,$limit = null,$offset = null,$joins = array()){
		if(!empty($select)){
			$this->db->select($select);
		}else{
			$this->db->select('*');
		}

		$this->db->from($table);

		if(!empty($joins)){
			foreach ($joins as $key => $value) {
				$this->db->join($value["table"],$value["condition"],$value["type"]);
			}
		}

		if(!empty($where)){
			$this->db->where($where,false,false);
		}
		if(!empty($group_by)){
			$this->db->group_by($group_by);
		}
		if(!empty($order_by)){
			$this->db->order_by($group_by);
		}
		if(!empty($offset)){
			$this->db->offset($offset);
		}
		if(!empty($limit)){
			$this->db->limit($offset);
		}
		$query1 = $this->db->get();

		if($query1->num_rows() > 0){
			return $query1->result_array();
		}

		return false;
	}

	public function insert($table,$insert) {
		$this->db->insert($table,$insert);
		return $this->db->insert_id();
	}

	public function update($table,$update,$where) {
		if(!empty($where)){
			$this->db->where($where,false,false);
		}
		return $this->db->update($table,$update);
	}

	public function delete($table,$where) {
		if(!empty($where)){
			$this->db->where($where,false,false);
		}
		return $this->db->delete($table);
	}
}
