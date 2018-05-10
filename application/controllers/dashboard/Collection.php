<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('MCollection');
		$this->load->library('image_lib');
	}

	public function index(){
		$this->handle_not_login();

		$where = array(1 => 1);
		if (!is_null($this->input->get('search'))){
			$where['title'] = $this->input->get('search');
		}

		if (!is_null($this->input->get('favorite'))){
			$where['is_favorite'] = 'Y';
		}

		$total_rows = $this->MCollection->totalCollection($where);
		$config['base_url'] = base_url().'dashboard/collection';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 25;
		$from = $this->input->get('per_page');

		$this->pagination->initialize($config);
		$data['collection'] = $this->MCollection->allCollection($config['per_page'],is_null($from) ? 0 : $from, $where);
		$this->load_view('dashboard/collection',$data);
	}

	public function add(){
		$this->handle_not_login();
		$this->load_view('dashboard/collection_add');
	}

	public function do_add(){
		$this->handle_not_login();

		$error_found = false;
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
      redirect(base_url('dashboard/collection/add'));
    }

		$tempFile = $_FILES['file']['tmp_name'];
		$targetPath = getcwd() . '/upload/collection/';
		$randomString = random_string('alnum', 8);
		$fileName = $randomString . '.jpg';
		$targetFile = $targetPath . $fileName;
		move_uploaded_file($tempFile, $targetFile);

		$config['image_library'] = 'gd2';
		$config['source_image'] = $targetFile;
		$config['maintain_ratio'] = TRUE;
		$config['new_image'] = $randomString.'_1024.jpg';
		$config['height']	= 1024;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		$config['image_library'] = 'gd2';
		$config['source_image'] = $targetFile;
		$config['maintain_ratio'] = TRUE;
		$config['new_image'] = $randomString.'_250.jpg';
		$config['height']	= 250;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		$data = array(
			'category_id' => $this->input->post('category'),
			'is_favorite' => (null !== $this->input->post('is_favorite'))?$this->input->post('is_favorite'):'N',
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'image' => $fileName
		);
		
		if (!$error_found && !$this->handleInsertCollection($data)) {
			$error_found = true;
			$message = "Failed to insert collection";
		}

		$this->session->set_flashdata('isError', $error_found);
		if ($error_found){
			$this->session->set_flashdata('message', $message);
			redirect(base_url('dashboard/collection/add'));
		}
		$this->session->set_flashdata('message', 'New collection has been inserted');
		redirect(base_url('dashboard/collection/add'));
	}

	private function handleInsertCollection($data){
		if ($this->MCollection->insert_collection($data) != 1)
			return false;
		else
			return true;
	}

	public function do_edit(){
		$this->handle_not_login();

		$error_found=false;
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

		if (!$error_found && !$this->handleEditCollection($this->input->post('id'), $data)){
			$error_found = true;
			$message = "Failed to update collection";
		}

		$this->session->set_flashdata('isError', $error_found);
		if ($error_found){
			$this->session->set_flashdata('message', $message);
			redirect(base_url('dashboard/collection'));
		}
		$this->session->set_flashdata('message', 'Collection has been updated');
		redirect(base_url('dashboard/collection'));
	}

	private function handleEditCollection($id,$data){
		if ($this->MCollection->edit_collection($id,$data) != 1)
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
		$this->handleEditCollection($data['id'], $data);
	}

	private function isFavorite($id){
		$where['id'] = $id;
		$where['is_favorite'] = 'Y';
		if ($this->MCollection->count_collection($where)>0)
      return true;
    else 
      return false;
	}

	public function doDelete(){
		$this->handle_not_login();
		
		$id = $this->input->post('id');
		$this->MCollection->deleteCollection($id);
		$this->session->set_flashdata('message', 'Record Deleted.');
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
				'<span><a title="Edit" class="btn btn-info" onclick="editCategory(\''.$r->id.'\',\''.$r->name.'\',\''.$r->description.'\')"><i class="fa fa-pencil"></i></a></span>
				<span><a title="Delete" class="btn btn-warning" onclick="deleteCategory(\''.$r->id.'\',\''.$r->name.'\')"><i class="fa fa-trash"></i></a></span>
				<span><a title="Show Homepage" class="btn btn-default '.($r->show_homepage=='Y'?'btn-primary':'').'" onclick="showHomepage(\''.$r->id.'\',\''.$r->name.'\')"><i class="fa fa-home"></i></a></span>'
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

	public function do_add_category(){
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

		if (!$error_found && !$this->handleInsertCategory($data)){
			$error_found = true;
			$message = "Failed to insert category";
		}

		$this->handle_error($error_found, $message, $redirect_url);

		$this->session->set_flashdata('message', 'Category '.$data['name'].' has been inserted');
		redirect(base_url($redirect_url));
	}

	private function handleInsertCategory($data){
		if ($this->MCategory->insert_category($data) != 1)
			return false;
		else 
			return true;
	}

	public function do_edit_category(){
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
		if ($this->MCategory->update_category($id, $data) != 1)
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
		if ($this->MCategory->delete_category($id) != 1)
			return false;
		else 
			return true;
	}

	public function view($category){
		$this->handle_not_login();

		$where['category_id'] = $category;
		if (!is_null($this->input->get('search'))){
			$where['title'] = $this->input->get('search');
		}

		if (!is_null($this->input->get('favorite'))){
			$where['is_favorite'] = 'Y';
		}

		$total_rows = $this->MCollection->totalCollection($where);
		$config['base_url'] = base_url().'dashboard/collection/view/'.$category;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = 10;
		$from = $this->input->get('per_page');

		$this->pagination->initialize($config);
		$data['collection'] = $this->MCollection->allCollection($config['per_page'],is_null($from) ? 0 : $from, $where);
		$this->load_view('dashboard/collection',$data);
	}
}
