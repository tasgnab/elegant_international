<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MBrand extends MY_Model{
	function create($data){
		$data = $this->appendCreatedUpdatedBy($data);
		$this->db->insert('brand',$data);
		return $this->db->affected_rows();
	}

	function update($id, $data){
		$data = $this->appendUpdatedBy($data);
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('brand');
		return $this->db->affected_rows();
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('brand');
		return $this->db->affected_rows();
	}

	function get($where){
		$this->db->select('id,brand,description,image,is_favorite');
		$this->db->from('brand');
		$this->db->where($where);
		$this->db->order_by('brand', 'asc');
		return $this->db->get();
	}
}
?>