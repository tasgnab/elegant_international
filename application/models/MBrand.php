<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MBrand extends MY_Model{
	function create($data){
		$data = $this->appendCreatedUpdatedBy($data);
		$this->db->insert('brand',$data);
		return $this->db->affected_rows();
	}

	function all_brand(){
		$this->db->select('id,brand,description,image,is_favorite');
		$this->db->from('brand');
		$this->db->order_by('brand', 'asc');
		return $this->db->get();
	}
}
?>