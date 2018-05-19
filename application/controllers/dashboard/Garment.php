<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garment extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('MGarment');
	}

	public function index(){
		redirect(base_url('dashboard/garment/brand'));
	}

	public function brand(){
		$this->handle_not_login();
		$this->load_view('dashboard/garment_brand');
	}

	public function brand_list_page(){
		$this->handle_not_login();
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$brand = $this->MBrand->get('1 = 1');
		$data = array();

		foreach($brand->result() as $r) {
			$data[] = array(
				'<a href="'.base_url('dashboard/garment/view/').$r->id.'">'.$r->brand.'</a>',
				'<span><a title="Edit" class="btn btn-info" onclick="update(\''.$r->id.'\',\''.$r->brand.'\',\''.$r->description.'\')"><i class="fa fa-pencil"></i></a></span>
				<span><a title="Delete" class="btn btn-warning" onclick="delete_brand(\''.$r->id.'\',\''.$r->brand.'\')"><i class="fa fa-trash"></i></a></span>
				<span><a href="'.base_url('dashboard/garment/create/').$r->id.'" title="Add Image" class="btn btn-default btn-success"><i class="fa fa-plus"></i></a></span>
				<span><a title="Show Homepage" class="btn btn-default '.($r->is_favorite=='Y'?'btn-primary':'').'" onclick="show_brand(\''.$r->id.'\',\''.$r->brand.'\')"><i class="fa fa-home"></i></a></span>
				<span><a href="'.base_url('dashboard/garment/view/').$r->id.'" title="View Image" class="btn btn-default btn-success"><i class="fa fa-arrow-right"></i></a></span>'
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $brand->num_rows(),
			"recordsFiltered" => $brand->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function do_create_brand(){
		$this->handle_not_login();
		$error_found = false; $message = ''; $redirect_url='dashboard/garment/brand';

		if(!$this->input->post('brand')){
			$error_found = true;
			$message = "Brand cannot be empty";
		}

		if(!$error_found && !$this->input->post('description')){
			$error_found = true;
			$message = "Description cannot be empty";
		}

		if(!$error_found && empty($_FILES)){
			$error_found = true;
			$message = "Image cannot be empty";
		}

		$this->handle_error($error_found, $message, $redirect_url);

	    $tempFile = $_FILES['file']['tmp_name'];
		$targetPath = getcwd() . $this->config->item('path_upload_garment');
		$randomString = random_string('alnum', 8);
		$fileName = $randomString . '.jpg';
		$targetFile = $targetPath . $fileName;
		move_uploaded_file($tempFile, $targetFile);

		$this->crop($targetFile, $randomString, 250, 250);

		$data['brand'] = $this->input->post('brand');
		$data['description'] = $this->input->post('description');
		$data['image'] = $fileName;

		if (!$error_found && !$this->handleCreateBrand($data)) {
			$error_found = true;
			$message = "Failed to insert brand";
		}

		$this->handle_error($error_found, $message, $redirect_url);
		$this->session->set_flashdata('message', 'New brand has been inserted');
		redirect(base_url($redirect_url));
	}

	private function handleCreateBrand($data){
		if ($this->MBrand->create($data) != 1)
			return false;
		else
			return true;
	}

	public function do_update_brand(){
		$this->handle_not_login();
		$error_found = false;  $message=''; $redirect_url='dashboard/garment/brand';

		if(!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update brand";
		}

		if(!$error_found && !$this->input->post('brand')){
			$error_found = true;
			$message = "Brand cannot be empty";
		}

		if(!$error_found && !$this->input->post('description')){
			$error_found = true;
			$message = "Description cannot be empty";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$id = $this->input->post('id');
		$data['brand'] = $this->input->post('brand');
		$data['description'] = $this->input->post('description');

		if (!$error_found && !$this->handleUpdateBrand($id, $data)) {
			$error_found = true;
			$message = "Failed to update brand";
		}

		$this->handle_error($error_found, $message, $redirect_url);
		$this->session->set_flashdata('message', 'Brand has been updated');
		redirect(base_url($redirect_url));
	}

	private function handleUpdateBrand($id, $data){
		if ($this->MBrand->update($id, $data) != 1)
			return false;
		else
			return true;
	}

	public function do_delete_brand(){
		$this->handle_not_login();
		$error_found = false;  $message=''; $redirect_url='dashboard/garment/brand';

		if(!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to delete brand";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		if (!$error_found && !$this->handleDeleteBrand($this->input->post('id'))) {
			$error_found = true;
			$message = "Failed to delete brand";
		}

		$this->handle_error($error_found, $message, $redirect_url);
		$this->session->set_flashdata('message', 'Brand has been deleted');
		redirect(base_url($redirect_url));
	}

	private function handleDeleteBrand($id){
		if ($this->MBrand->delete($id) != 1)
			return false;
		else
			return true;
	}

	public function do_show_brand(){
		$this->handle_not_login();
		$error_found = false;  $message=''; $redirect_url='dashboard/garment/brand';

		if(!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update brand";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$id = $this->input->post('id');
		if ($this->isFavoriteBrand($id)) {
			$data['is_favorite'] = 'N';
		} else {
			$data['is_favorite'] = 'Y';
		}

		if (!$error_found && !$this->handleUpdateBrand($id, $data)) {
			$error_found = true;
			$message = "Failed to update brand";
		}

		$this->handle_error($error_found, $message, $redirect_url);
		$this->session->set_flashdata('message', 'Brand has been updated');
		redirect(base_url($redirect_url));
	}

	public function view($brand){
		$this->handle_not_login();

		$where['brand_id'] = $brand;
		if (!is_null($this->input->get('search'))){
			$where['title like'] = '%'.$this->input->get('search').'%';
		}

		$total_rows = $this->MGarment->totalGarment($where);
		$config['base_url'] = base_url().'dashboard/collection/view/'.$brand;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 10;
		$from = $this->input->get('per_page');

		$this->pagination->initialize($config);
		$data['garments'] = $this->MGarment->allGarment($config['per_page'],is_null($from) ? 0 : $from, $where);
		$data['brand_name'] = $this->getBrandName(array('id' => $brand));
		$data['brand_id'] = $brand;
		$this->load_view('dashboard/garment',$data);
	}

	private function isFavoriteBrand($id){
		$data['id'] = $id;
		$data['is_favorite'] = 'Y';
		if ($this->MBrand->get($data)->num_rows() > 0)
			return true;
		else
			return false;
	}

	public function create($brand_id){
		$this->handle_not_login();
		$data['id'] = $brand_id;
		$data['brand_name'] =  $this->getBrandName($data);

		$this->load_view('dashboard/garment_add_image', $data);	
	}

	private function getBrandName($where){
		$row = $this->MBrand->get($where)->row();
		return $row->brand;
	}

	public function do_create(){
		$this->handle_not_login();
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
		if (!empty($_FILES)) {
			for($i = 0; $i < count($_FILES['file']['name']); $i++){
				$tempFile = $_FILES['file']['tmp_name'][$i];
				$targetPath = getcwd() . $this->config->item('path_upload_garment');
				$randomString = random_string('alnum', 8);
				$fileName = $randomString . '.jpg';
				$targetFile = $targetPath . $fileName;
				move_uploaded_file($tempFile, $targetFile);

				$this->crop($targetFile, $randomString, 250, 250);
				$data['image'] = $fileName;
				$data['brand_id'] = $this->input->post('brand_id');
				$this->handleCreate($data);
			}
			
		}
		exit();
	}

	private function handleCreate($data){
		if ($this->MGarment->create($data) != 1)
			return false;
		else
			return true;
	}

	public function do_favorite(){
		$this->handle_not_login();

		$id = $this->input->post('id');

		if ($this->isFavorite($id)) {
			$data['is_favorite'] = 'N';
		} else {
			$data['is_favorite'] = 'Y';
		}

		$this->handleUpdate($id, $data);
		exit();
	}

	private function isFavorite($id){
		$where['id'] = $id;
		$where['is_favorite'] = 'Y';
		if ($this->MGarment->get($where)->num_rows() > 0)
			return true;
		else
			return false;
	}

	private function handleUpdate($id, $data){
		if ($this->MGarment->update($id, $data) != 1)
			return false;
		else 
			return true;
	}

	public function do_delete(){
		$this->handle_not_login();
		$error_found = false;  $message=''; $redirect_url='dashboard/garment/view/'.$this->input->post('redirect_url');

		if(!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to delete image";
		}

		$this->handle_error($error_found, $message, $redirect_url);
		$id = $this->input->post('id');
		if (!$error_found && !$this->handleDelete($id)) {
			$error_found = true;
			$message = "Failed to delete image";
		}
		
		$this->handle_error($error_found, $message, $redirect_url);
		$this->session->set_flashdata('message', 'Image has been deleted');
		redirect(base_url($redirect_url));
	}

	private function handleDelete($id){
		if ($this->MGarment->delete($id) != 1)
			return false;
		else
			return true;
	}

	public function doFavorite(){
		$this->handle_not_login();
		
		$id = $this->input->post('id');
		if ($this->mgarment->isFavorite($id)){
			$this->mgarment->updateBrand(
				$id, 
				array(
					'is_favorite' => 0
					)
				);
		} else {
			$this->mgarment->updateBrand(
				$id, 
				array(
					'is_deleted' => 0, 
					'is_favorite' => 1
				)
			);
		}
	}

	public function doEdit(){
		$this->handle_not_login();

		$this->mgarment->updateBrand(
			$this->input->post('id'),
			array(
				'brand' => $this->input->post('brand'), 
				'description' => $this->input->post('description')
			)
		);
	}

	public function doDelete(){
		$this->handle_not_login();

		$this->mgarment->updateBrand(
			$this->input->post('id'),
			array(
				'is_deleted' => 1,
				'is_favorite' => 0
			)
		);
	}

	public function doRestore(){
		$this->handle_not_login();

		$this->mgarment->updateBrand(
			$this->input->post('id'),
			array(
				'is_deleted' => 0
			)
		);
	}

	public function doEditGarment(){
		$this->handle_not_login();

		$this->mgarment->updateGarment(
			$this->input->post('id'),
			array(
				'code' => $this->input->post('code'), 
				'stock' => $this->input->post('stock')
			)
		);
	}

	public function doDeleteGarment(){
		$this->handle_not_login();

		$this->mgarment->deleteGarment(
			$this->input->post('id')
		);	
	}

	public function doAddImage(){
		$this->handle_not_login();

		if (!empty($_FILES)) {
			$tempFile = $_FILES['file']['tmp_name'];
			$targetPath = getcwd() . '/upload/garment/';
			$randomString = random_string('alnum', 8);
			$fileName =  $randomString.'.jpg';
			$targetFile = $targetPath . $fileName;
			move_uploaded_file($tempFile, $targetFile);
			$this->session->set_flashdata('filename',$fileName);
			$config['image_library'] = 'gd2';
			$config['source_image'] = $targetFile;
			$config['maintain_ratio'] = TRUE;
			$config['new_image'] = $randomString.'_250'.'.jpg';
			$config['width']	= 250;
			$config['height']	= 250;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
	}

	public function doUpdateImageGarment(){
		$this->handle_not_login();

		$this->mgarment->updateGarment(
			$this->input->post('id'),
			array(
				'filename' => $this->session->flashdata('filename')
			)
		);
	}

	public function doInsertGarment(){
		$this->handle_not_login();
	
		$this->mgarment->insertGarment(
			array(
				'code' => $this->input->post('code'),
				'brand' => $this->input->post('brandId'),
				'stock' => $this->input->post('stock'),
				'filename' => $this->session->flashdata('filename')
			)
		);
	}
}
