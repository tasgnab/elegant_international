<?php 

class MCollection extends CI_Model{
	function totalCollection($where){
		$this->db->select('id,title,description,image,is_favorite');
		$this->db->where($where);
		$this->db->order_by('title', 'asc');
		return $this->db->get('collection')->num_rows();
	}

	function allCollection($number,$offset,$where){
		$this->db->select('id,title,description,image,is_favorite');
		$this->db->where($where);
		$this->db->order_by('title', 'asc');
		return $this->db->get('collection',$number,$offset)->result();
	}

	function insertCollection($data){
		$data['updated_by'] = $this->session->userdata('username');
		$this->db->insert('collection',$data);
	}

	function updateCollection($id,$data){
		$data['updated_by'] = $this->session->userdata('username');
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('collection');
	}

	function deleteCollection($id){
		$this->db->where('id', $id);
		$this->db->delete('collection');
	}

	function isFavorite($id){
		$this->db->select('is_favorite');
		$this->db->where('id',$id);

		$result = $this->db->get('collection')->row();
		if($result->is_favorite==1)
			return true;
		else
			return false;
	}
}
?>