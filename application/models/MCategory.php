<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MCategory extends MY_Model{
	function create($data){
		$data = $this->appendCreatedUpdatedBy($data);
		$this->db->insert('category',$data);
		return $this->db->affected_rows();
	}

	function update($id, $data){
		$data = $this->appendUpdatedBy($data);
		$this->db->set($data);
		$this->db->where('id',$id);
		$this->db->update('category');
		return $this->db->affected_rows();
	}

	function delete($id){
		$this->db->where('id',$id);
		$this->db->delete('category');
		return $this->db->affected_rows();
	}

	function reset_homepage(){
		$this->db->set('show_homepage', 'N');
		$this->db->update('category');
	}	

	function all_category_collection(){
		return $this->db->get('collection_category_summary');
	}

	function get($where){
		$this->db->select('id,name,description,show_homepage,show_collection');
		$this->db->from('category');
		$this->db->where($where);
		$this->db->order_by('name', 'asc');
		return $this->db->get();
	}

	function count($where){
		$this->db->from('category');
		$this->db->where($where);
		return $this->db->count_all_results();;
	}

}
?>