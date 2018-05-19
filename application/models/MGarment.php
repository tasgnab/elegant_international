<?php 

class MGarment extends MY_Model{

	function allGarment($number,$offset,$where){
		$this->db->select('id,image,is_favorite');
		$this->db->where($where);
		$this->db->order_by('id', 'asc');
		return $this->db->get('garment',$number,$offset)->result();
	}

	function create($data){
		$data = $this->appendCreatedUpdatedBy($data);
		$this->db->insert('garment', $data);
		return $this->db->affected_rows();
	}

	function get($where){
		$this->db->select('id,brand_id,image,is_favorite');
		$this->db->from('garment');
		$this->db->where($where);
		$this->db->order_by('id asc');
		return $this->db->get();
	}

	function update($id,$data){
		$data = $this->appendUpdatedBy($data);
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('garment');
		return $this->db->affected_rows();
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete('garment');
		return $this->db->affected_rows();
	}

}

?>