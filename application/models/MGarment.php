<?php 

class MGarment extends CI_Model{

	function isFavorite($id){
		$this->db->select('is_favorite');
		$this->db->where('id',$id);

		$result = $this->db->get('garment_brand')->row();
		if($result->is_favorite==1)
			return true;
		else
			return false;
	}

	function updateBrand($id,$data){
		$data['updated_by'] = $this->session->userdata('username');
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('garment_brand');
	}

	function insertBrand($data){
		$data['updated_by'] = $this->session->userdata('username');
		$this->db->insert('garment_brand',$data);
		return $this->db->insert_id();
	}

	function insertGarment($data){
		$data['updated_by'] = $this->session->userdata('username');
		$this->db->insert('garment',$data);
		return $this->db->insert_id();
	}

	function selectImages($data){
		$this->db->select('id,code,brand,filename,stock');
		$this->db->from('garment');
		$this->db->where_in('id',$data);
		return $this->db->get()->result();
	}

	function updateGarment($id,$data){
		$data['updated_by'] = $this->session->userdata('username');
		$this->db->set($data);
		$this->db->where('id',$id);
		$this->db->update('garment');
	}

	function totalBrand($where){
		$query = $this->db->query("SELECT * FROM (select garment_brand.id,garment_brand.brand,garment_brand.description,garment.filename,garment_brand.is_favorite,garment_brand.is_deleted from garment_brand left join garment on garment.brand=garment_brand.id WHERE 1 = 1 ".$where." ORDER BY garment_brand.id ASC )as a GROUP BY id");
		return $query->num_rows();
	}

	function dataBrand($number,$offset,$where){
		$query = $this->db->query("SELECT * FROM (select garment_brand.id,garment_brand.brand,garment_brand.description,garment.filename,garment_brand.is_favorite,garment_brand.is_deleted from garment_brand left join garment on garment.brand=garment_brand.id WHERE 1 = 1 ".$where." ORDER BY garment_brand.id ASC )as a GROUP BY id  LIMIT $offset, $number");
		return $query->result();		
	}

	function dataGarment($id){
		$this->db->select('garment.id,garment.code,garment.filename,garment.stock');
		$this->db->from('garment');
		$this->db->join('garment_brand','garment.brand=garment_brand.id');
		$this->db->where(
			array(
				'garment_brand.id' => $id
				)
			);
		$this->db->order_by('code', 'asc');
		return $this->db->get()->result();
	}

	function dataBrandSingle($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get('garment_brand')->row();
	}

	function dataGarmentSingle($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		return $this->db->get('garment')->row();	
	}

	function deleteGarment($id){
		$this->db->where('id', $id);
		$this->db->delete('garment');
	}

	function allGarment(){
		$this->db->select('garment.id,garment.code,garment_brand.brand,garment.filename,garment.stock');
		$this->db->from('garment');
		$this->db->join('garment_brand','garment.brand=garment_brand.id');
		$this->db->where(
			array(
				'garment_brand.is_deleted' => 0,
				'garment.is_deleted' => 0
				)
			);
		$this->db->order_by('brand,code', 'asc');
		return $this->db->get()->result();
	}

}

?>