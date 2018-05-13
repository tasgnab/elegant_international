<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCollection extends MY_Model{
	function totalCollection($where){
		$this->db->select('id,title,description,image,is_favorite,category_id');
		$this->db->where($where);
		$this->db->order_by('title', 'asc');
		return $this->db->get('collection')->num_rows();
	}

	function allCollection($number,$offset,$where){
		$this->db->select('id,title,description,image,is_favorite,category_id');
		$this->db->where($where);
		$this->db->order_by('title', 'asc');
		return $this->db->get('collection',$number,$offset)->result();
	}

	function create($data){
		$data = $this->appendCreatedUpdatedBy($data);
		$this->db->insert('collection',$data);
		return $this->db->affected_rows();
	}

	function update($id,$data){
		$data = $this->appendUpdatedBy($data);
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('collection');
		return $this->db->affected_rows();
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('collection');
		return $this->db->affected_rows();
	}

	function count($where){
		$this->db->from('collection');
		$this->db->where($where);
		return $this->db->count_all_results();;
	}
}
?>