<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('MCollection');
	}

	public function index(){
		redirect(base_url('dashboard/collection/category'));
	}

	public function create(){
		$this->handle_not_login();
		$this->load_view('dashboard/collection_create');
	}

	public function do_create(){
		$this->handle_not_login();

		$error_found = false; $redirect_url='dashboard/collection/create';
		if(!$this->input->post('category')){
			$error_found = true;
			$message = "Please choose a category";
		}

		if(!$error_found && !$this->input->post('title')){
			$error_found = true;
			$message = "Title cannot be empty";
		}

		if(!$error_found && !$this->input->post('description')){
			$error_found = true;
			$message = "Description cannot be empty";
		}

		if(!$error_found && empty($_FILES)){
			$error_found = true;
			$message = "Image cannot be empty";
		}

		$this->session->set_flashdata('isError', $error_found);
	    if ($error_found){
	      $this->session->set_flashdata('message', $message);
	      redirect(base_url($redirect_url));
	    }

		$tempFile = $_FILES['file']['tmp_name'];
		$targetPath = getcwd() . $this->config->item('path_upload_collection');
		$randomString = random_string('alnum', 8);
		$fileName = $randomString . '.jpg';
		$targetFile = $targetPath . $fileName;
		move_uploaded_file($tempFile, $targetFile);

		$this->resize($targetFile, $randomString, 'height', 1024);

		$this->crop($targetFile, $randomString, 250, 250);

		$data = array(
			'category_id' => $this->input->post('category'),
			'is_favorite' => (null !== $this->input->post('is_favorite'))?$this->input->post('is_favorite'):'N',
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'image' => $fileName
		);
		
		if (!$error_found && !$this->handleCreateCollection($data)) {
			$error_found = true;
			$message = "Failed to insert collection";
		}

		$this->session->set_flashdata('isError', $error_found);
		if ($error_found){
			$this->session->set_flashdata('message', $message);
			redirect(base_url($redirect_url));
		}
		$this->session->set_flashdata('message', 'New collection has been inserted');
		redirect(base_url($redirect_url));
	}

	private function handleCreateCollection($data){
		if ($this->MCollection->create($data) != 1)
			return false;
		else
			return true;
	}

	public function do_update(){
		$this->handle_not_login();

		$error_found=false; $redirect_url='dashboard/collection';
		if ($this->input->post('redirect_url')){
			$redirect_url = 'dashboard/collection/view/'.$this->input->post('redirect_url');
		}

		if (!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update collection";
		}

		if (!$error_found && !$this->input->post('title')){
			$error_found = true;
			$message = "Title should not be blank";
		}

		if (!$error_found && !$this->input->post('description')){
			$error_found = true;
			$message = "Description should not be blank";
		}

		if (!$error_found && !$this->input->post('category')){
			$error_found = true;
			$message = "Please choose a category";
		}

		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');
		$data['category_id'] = $this->input->post('category');

		if (!$error_found && !$this->handleUpdateCollection($this->input->post('id'), $data)){
			$error_found = true;
			$message = "Failed to update collection";
		}

		$this->session->set_flashdata('isError', $error_found);
		if ($error_found){
			$this->session->set_flashdata('message', $message);
			redirect(base_url($redirect_url));
		}
		$this->session->set_flashdata('message', 'Collection has been updated');
		redirect(base_url($redirect_url));
	}

	private function handleUpdateCollection($id,$data){
		if ($this->MCollection->update($id,$data) != 1)
			return false;
		else
			return true;
	}
			
	public function do_favorite(){
		$this->handle_not_login();

		$data['id'] = $this->input->post('id');
		if ($this->isFavorite($data['id'])){
			$data['is_favorite'] = 'N';
		} else {
			$data['is_favorite'] = 'Y';
		}
		$this->handleUpdateCollection($data['id'], $data);
		exit();
	}

	private function isFavorite($id){
		$where['id'] = $id;
		$where['is_favorite'] = 'Y';
		if ($this->MCollection->count($where)>0)
	      return true;
	    else 
	      return false;
	}

	public function do_delete(){
		$this->handle_not_login();

		$error_found=false; $redirect_url='dashboard/collection';
		
		if ($this->input->post('redirect_url')){
			$redirect_url = 'dashboard/collection/view/'.$this->input->post('redirect_url');
		}

		if (!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update collection";
		}

		if (!$error_found && !$this->handleDeleteCollection($this->input->post('id'))){
			$error_found = true;
			$message = "Failed to update collection";
		}

		$this->session->set_flashdata('isError', $error_found);
		if ($error_found){
			$this->session->set_flashdata('message', $message);
			redirect(base_url($redirect_url));
		}
		$this->session->set_flashdata('message', 'Collection has been deleted');
		redirect(base_url($redirect_url));
	}

	private function handleDeleteCollection($id){
		if ($this->MCollection->delete($id) != 1)
			return false;
		else 
			return true;
	}

	public function category(){
		$this->handle_not_login();
		$this->load_view('dashboard/collection_category');
	}

	public function category_list_page(){
		$this->handle_not_login();
		
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));

		$category = $this->MCategory->all_category_collection();
		$data = array();

		foreach($category->result() as $r) {
			$data[] = array(
				'<a href="'.base_url('dashboard/collection/view/').$r->id.'">'.$r->name."</a>",
				$r->total,
				'<span><a title="Edit" class="btn btn-info" onclick="update(\''.$r->id.'\',\''.$r->name.'\',\''.$r->description.'\')"><i class="fa fa-pencil"></i></a></span>
				<span><a title="Delete" class="btn btn-warning" onclick="delete_category(\''.$r->id.'\',\''.$r->name.'\')"><i class="fa fa-trash"></i></a></span>
				<span><a title="Show Homepage" class="btn btn-default '.($r->show_homepage=='Y'?'btn-primary':'').'" onclick="showHomepage(\''.$r->id.'\',\''.$r->name.'\')"><i class="fa fa-home"></i></a></span>
				<span><a title="Show Collection" class="btn btn-default '.($r->show_collection=='Y'?'btn-primary':'').'" onclick="showCollection(\''.$r->id.'\',\''.$r->name.'\')"><i class="fa fa-eye"></i></a></span>'
			);
		}

		$output = array(
			"draw" => $draw,
			"recordsTotal" => $category->num_rows(),
			"recordsFiltered" => $category->num_rows(),
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function do_create_category(){
		$this->handle_not_login();

		$error_found = false; $message=''; $redirect_url='dashboard/collection/category';

		if (!$this->input->post('name')){
			$error_found = true;
			$message = "Name should not be blank";
		}

		if (!$error_found && !$this->input->post('description')){
			$error_found = true;
			$message = "Description should not be blank";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$data['name'] = $this->input->post('name');
		$data['description'] = $this->input->post('description');

		if (!$error_found && !$this->handleCreateCategory($data)){
			$error_found = true;
			$message = "Failed to insert category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$this->session->set_flashdata('message', 'Category '.$data['name'].' has been inserted');
		redirect(base_url($redirect_url));
	}

	private function handleCreateCategory($data){
		if ($this->MCategory->create($data) != 1)
			return false;
		else 
			return true;
	}

	public function do_update_category(){
		$this->handle_not_login();

		$error_found = false; $message=''; $redirect_url='dashboard/collection/category';

		if (!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update category";
		}

		if (!$error_found && !$this->input->post('name')){
			$error_found = true;
			$message = "Name should not be blank";
		}

		if (!$error_found && !$this->input->post('description')){
			$error_found = true;
			$message = "Description should not be blank";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$id = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['description'] = $this->input->post('description');

		if (!$error_found && !$this->handleUpdateCategory($id, $data)){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$this->session->set_flashdata('message', 'Category '.$data['name'].' has been updated');
		redirect(base_url($redirect_url));
	}

	private function handleUpdateCategory($id, $data){
		if ($this->MCategory->update($id, $data) != 1)
			return false;
		else 
			return true;
	}

	public function do_delete_category(){
		$this->handle_not_login();

		$error_found = false; $message=''; $redirect_url='dashboard/collection/category';

		if (!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$id = $this->input->post('id');

		if (!$error_found && !$this->handleDeleteCategory($id)){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$this->session->set_flashdata('message', 'Category has been deleted');
		redirect(base_url($redirect_url));
	}

	private function handleDeleteCategory($id){
		if ($this->MCategory->delete($id) != 1)
			return false;
		else 
			return true;
	}

	public function do_homepage(){
		$this->handle_not_login();

		$error_found = false; $message=''; $redirect_url='dashboard/collection/category';

		if (!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$id = $this->input->post('id');

		if (!$error_found && !$this->handleHomepage($id)){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$this->session->set_flashdata('message', $this->getCategoryName($id).' is now showing in the Homepage');
		redirect(base_url($redirect_url));
	}

	private function handleHomepage($id){
		$this->MCategory->reset_homepage();
		$data['show_homepage'] = 'Y';
		if ($this->MCategory->update($id, $data) != 1)
			return false;
		else 
			return true;
	}

	public function do_show(){
		$this->handle_not_login();

		$error_found = false; $message=''; $redirect_url='dashboard/collection/category';

		if (!$this->input->post('id')){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$id = $this->input->post('id');

		if (!$error_found && !$this->handleShow($id)){
			$error_found = true;
			$message = "Failed to update category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$this->session->set_flashdata('message', $this->getCategoryName($id).' is now visible to Internet');
		redirect(base_url($redirect_url));
	}

	private function handleShow($id){
		$data['id'] = $id;
		if ($this->isShow($data['id'])){
			$data['show_collection'] = 'N';
		} else {
			$data['show_collection'] = 'Y';
		}
		return$this->handleUpdateCategory($data['id'], $data);
	}

	private function isShow($id){
		$where['id'] = $id;
		$where['show_collection'] = 'Y';
		if ($this->MCategory->count($where)>0)
	      return true;
	    else 
	      return false;
	}

	public function view($category){
		$this->handle_not_login();

		$where['category_id'] = $category;
		if (!is_null($this->input->get('search'))){
			$where['title like'] = '%'.$this->input->get('search').'%';
		}

		$total_rows = $this->MCollection->get($where)->num_rows();
		$config['base_url'] = base_url().'dashboard/collection/view/'.$category;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 10;
		$from = $this->input->get('per_page');

		$this->pagination->initialize($config);
		$data['collection'] = $this->MCollection->allCollection($config['per_page'],is_null($from) ? 0 : $from, $where);
		$data['category_name'] = $this->getCategoryName($category);
		$data['category_id'] = $category;
		$this->load_view('dashboard/collection',$data);
	}

	private function getCategoryName($category_id){
		$where['id'] = $category_id;
		$temp = $this->MCategory->get($where)->row();
		return $temp->name;
	}
}
