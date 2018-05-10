<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MCategory extends MY_Model{
	function insert_category($data){
		$data = $this->appendCreatedUpdatedBy($data);
		$this->db->insert('category',$data);
		return $this->db->affected_rows();
	}

	function update_category($id, $data){
		$data = $this->appendUpdatedBy($data);
		$this->db->set($data);
		$this->db->where('id',$id);
		$this->db->update('category');
		return $this->db->affected_rows();
	}

	function delete_category($id){
		$this->db->where('id',$id);
		$this->db->delete('category');
		return $this->db->affected_rows();
	}

	function all_category(){
		$this->db->select('id,name,description,show_homepage,show_collection');
		$this->db->from('category');
		$this->db->order_by('name', 'asc');
		return $this->db->get();
	}

	function all_category_collection(){
		return $this->db->get('collection_category_summary');
	}

}
?>