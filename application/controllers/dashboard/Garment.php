<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garment extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('mgarment');
		$this->load->library('image_lib');
	}

	public function index(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			if (!is_null($this->input->get('view'))){
				if ($this->input->get('view')=="detail"){
					$data['brand'] = $this->mgarment->dataBrandSingle($this->input->get('id'));
					$data['garment'] = $this->mgarment->dataGarment($this->input->get('id'));
					$this->load->view('dashboard/garment_detail',$data);
				} 
			} else {
				$where = "";
				if (!is_null($this->input->get('search'))){
					$where = "AND garment_brand.brand like '%".$this->input->get('search')."%' ";
				}

				if (!is_null($this->input->get('favorite'))){
					$where = "AND garment_brand.is_favorite = 1 ";
				}

				if (!is_null($this->input->get('deleted'))){
					$where = "AND garment_brand.is_deleted = 1 ";
				}

				$total_rows = $this->mgarment->totalBrand($where);
				if ($total_rows==0){
					$this->session->set_flashdata('message','No Record found !!!');
				}
				$config['base_url'] = base_url().'dashboard/garment';
				$config['total_rows'] = $total_rows;
				$config['per_page'] = 20;
				$from = $this->input->get('per_page');
				$this->pagination->initialize($config);
				$data['brand'] = $this->mgarment->dataBrand($config['per_page'],is_null($from) ? 0 : $from, $where);
				$this->load->view('dashboard/garment',$data);
			}
		}
	}

	public function add(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			if ($this->session->has_userdata('step')){
				if ($this->session->userdata('step')==2){
					$this->load->view('dashboard/garment_add_image');
				} else if ($this->session->userdata('step')==3){
					$data['listImage'] = $this->mgarment->selectImages($this->session->userdata('listImage'));
					$this->load->view('dashboard/garment_add_code',$data);
				}
			} else {
				$this->load->view('dashboard/garment_add');
			}
		}
	}

	public function uploadImage(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->load->view('dashboard/garment_add_image');
		}
	}

	public function doInsert(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$brand = $this->input->post('brand');
			$description = $this->input->post('description');

			$data = array(
				'brand' => $brand,
				'description' => $description
			);

			$brandId = $this->mgarment->insertBrand($data);

			$listImage = array();
			$this->session->set_userdata('step',2);
			$this->session->set_userdata('brand',$brand);
			$this->session->set_userdata('brandId',$brandId);
			$this->session->set_userdata('listImage',$listImage);
			redirect('dashboard/garment/add');
		}
	}

	public function doUploadImage(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			if (!empty($_FILES)) {
				$tempFile = $_FILES['file']['tmp_name'];
				$oriFilename = $_FILES['file']['name'];
				$targetPath = getcwd() . '/upload/garment/';
				$randomString = random_string('alnum', 8);
				$fileName = $randomString . '.jpg';
				$targetFile = $targetPath . $fileName;
				move_uploaded_file($tempFile, $targetFile);
				$str = explode(".",$oriFilename);

				$config['image_library'] = 'gd2';
				$config['source_image'] = $targetFile;
				$config['maintain_ratio'] = TRUE;
				$config['new_image'] = $randomString.'_250'.'.jpg';
				$config['width']	= 250;
				$config['height']	= 250;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				if ($this->session->has_userdata('listImage')){
					$data = array(
						'code' => $str[0],
						'brand' => $this->session->userdata('brandId'),
						'filename' => $fileName
					);
					$listImage = $this->session->userdata('listImage');
					$listImage[] = $this->mgarment->insertGarment($data);
					$this->session->set_userdata('listImage',$listImage);
				}
				$this->session->set_userdata('step',3);
			}
		}
	}

	public function finish(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->insertBrand(
				array(
					'brand' => $this->input->post('brand'),
					'description' => $this->input->post('description')
					)
				);
			$this->session->set_flashdata('message', 'New Brand has been inserted.');
			redirect('dashboard/garment/add');
		}
	}

	public function doFinish(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->session->unset_userdata('step');
			$this->session->unset_userdata('listImage');
			$this->session->unset_userdata('brand');
			$this->session->unset_userdata('brandId');

			redirect('dashboard/garment/add');
		}
	}

	public function doFavorite(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
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
	}

	public function doEdit(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->updateBrand(
				$this->input->post('id'),
				array(
					'brand' => $this->input->post('brand'), 
					'description' => $this->input->post('description')
					)
				);
		}
	}

	public function doDelete(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->updateBrand(
				$this->input->post('id'),
				array(
					'is_deleted' => 1,
					'is_favorite' => 0
					)
				);
		}
	}

	public function doRestore(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->updateBrand(
				$this->input->post('id'),
				array(
					'is_deleted' => 0
					)
				);
		}
	}

	public function doEditGarment(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->updateGarment(
				$this->input->post('id'),
				array(
					'code' => $this->input->post('code'), 
					'stock' => $this->input->post('stock')
					)
				);
		}
	}

	public function doDeleteGarment(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->deleteGarment(
				$this->input->post('id')
				);
		}
	}

	public function doAddImage(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
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
	}

	public function doUpdateImageGarment(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->mgarment->updateGarment(
				$this->input->post('id'),
				array(
					'filename' => $this->session->flashdata('filename')
					)
				);
		}
	}

	public function doInsertGarment(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
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
}
