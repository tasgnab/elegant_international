<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('mcollection');
		$this->load->library('image_lib');
	}

	public function index(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$where = array(1 => 1);
			if (!is_null($this->input->get('search'))){
				$where['title'] = $this->input->get('search');
			}

			if (!is_null($this->input->get('favorite'))){
				$where['is_favorite'] = 1;
			}

			$total_rows = $this->mcollection->totalCollection($where);
			$config['base_url'] = base_url().'dashboard/collection';
			$config['total_rows'] = $total_rows;
			$config['per_page'] = 10;
			$from = $this->input->get('per_page');

			$this->pagination->initialize($config);
			$data['collection'] = $this->mcollection->allCollection($config['per_page'],is_null($from) ? 0 : $from, $where);
			$this->load->view('dashboard/collection',$data);
		}
	}

	public function add(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->load->view('dashboard/collection_add');
		}
	}

	public function doUploadImage(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			if (!empty($_FILES)) {
				$tempFile = $_FILES['file']['tmp_name'];
				$targetPath = getcwd() . '/upload/collection/';
				$randomString = random_string('alnum', 8);
				$fileName = $randomString . '.jpg';
				$targetFile = $targetPath . $fileName;
				move_uploaded_file($tempFile, $targetFile);
				$this->session->set_flashdata('image',$fileName);
				$config['image_library'] = 'gd2';
				$config['source_image'] = $targetFile;
				$config['maintain_ratio'] = TRUE;
				$config['new_image'] = $randomString.'_250'.'.jpg';
				$config['width']	= 250;
				$config['height']	= 250;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$config['new_image'] = $randomString.'_1024'.'.jpg';
				$config['width']	= 1024;
				$config['height']	= 1024;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
			}
		}
	}

	public function doAddCollection(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$image = $this->session->flashdata('image');
			$data = array(
				'title' => $title, 
				'description' => $description,
				'image' => $image
				);
			$this->mcollection->insertCollection($data);
			$this->session->set_flashdata('message','New Collection Inserted');
			redirect('dashboard/collection/add');
		}
	}

	public function doUpdate(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mcollection->updateCollection(
				$this->input->post('id'),
				array(
					'title' => $this->input->post('title'), 
					'description' => $this->input->post('description')
					)
				);
			$this->session->set_flashdata('message', 'Record Updated.');
		}
	}

	public function doFavorite(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$id = $this->input->post('id');
			if ($this->mcollection->isFavorite($id)){
				$this->mcollection->updateCollection(
					$id, 
					array(
						'is_favorite' => 0
						)
					);
			} else {
				$this->mcollection->updateCollection(
					$id, 
					array(
						'is_favorite' => 1
						)
					);
			}
		}
	}

	public function doDelete(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$id = $this->input->post('id');
			$this->mcollection->deleteCollection($id);
			$this->session->set_flashdata('message', 'Record Deleted.');
		}
	}
}
