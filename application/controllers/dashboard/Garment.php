<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garment extends MY_Controller {

	function  __construct() {
		parent::__construct();
		$this->load->model('mgarment');
		$this->load->model('MBrand');
		$this->load->library('image_lib');
	}

	public function index(){
		$this->handle_not_login();

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
			$this->load_view('dashboard/garment',$data);
		}
		
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

		$brand = $this->MBrand->all_brand();
		$data = array();

		foreach($brand->result() as $r) {
			$data[] = array(
				'<a href="'.base_url('dashboard/collection/view/').$r->id.'">'.$r->brand.'</a>',
				'<span><a title="Edit" class="btn btn-info" onclick="update(\''.$r->id.'\',\''.$r->brand.'\',\''.$r->description.'\')"><i class="fa fa-pencil"></i></a></span>
				<span><a title="Delete" class="btn btn-warning" onclick="remove(\''.$r->id.'\',\''.$r->brand.'\')"><i class="fa fa-trash"></i></a></span>
				<span><a title="Show Homepage" class="btn btn-default '.($r->is_favorite=='Y'?'btn-primary':'').' onclick="show(\''.$r->id.'\',\''.$r->brand.'\')"><i class="fa fa-home"></i></a></span>'
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

	public function do_add_brand(){
		$this->handle_not_login();
		$error_found = false;  $redirect_url='dashboard/garment/brand/add';
		if(!$this->input->post('brand')){
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
		$targetPath = getcwd() . $this->config->item('path_upload_garment');
		$randomString = random_string('alnum', 8);
		$fileName = $randomString . '.jpg';
		$targetFile = $targetPath . $fileName;
		move_uploaded_file($tempFile, $targetFile);

		$config['image_library'] = 'gd2';
		$config['source_image'] = $targetFile;
		$config['maintain_ratio'] = false;
		$config['new_image'] = $randomString.'_250.jpg';
		$config['height'] = 250;
		$config['width'] = 250;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();

		$data = array(
			'brand' => $this->input->post('brand'),
			'description' => $this->input->post('description'),
			'image' => $fileName
		);

		if (!$error_found && !$this->handleInsertBrand($data)) {
			$error_found = true;
			$message = "Failed to insert brand";
		}

		$this->session->set_flashdata('isError', $error_found);
		if ($error_found){
			$this->session->set_flashdata('message', $message);
			redirect(base_url($redirect_url));
		}
		$this->session->set_flashdata('message', 'New brand has been inserted');
		redirect(base_url($redirect_url));
	}

	private function handleInsertBrand($data){
		if ($this->MBrand->insert($data) != 1)
			return false;
		else
			return true;
	}

	public function uploadImage(){
		$this->handle_not_login();
	
		$this->load_view('dashboard/garment_add_image');	
	}

	public function doInsert(){
		$this->handle_not_login();

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

	public function doUploadImage(){
		$this->handle_not_login();

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

	public function finish(){
		$this->handle_not_login();

		$this->mgarment->insertBrand(
			array(
				'brand' => $this->input->post('brand'),
				'description' => $this->input->post('description')
				)
			);
		$this->session->set_flashdata('message', 'New Brand has been inserted.');
		redirect('dashboard/garment/add');
	}

	public function doFinish(){
		if (!$this->is_login())
			redirect(base_url('dashboard/login'));

		$this->session->unset_userdata('step');
		$this->session->unset_userdata('listImage');
		$this->session->unset_userdata('brand');
		$this->session->unset_userdata('brandId');
		redirect('dashboard/garment/add');

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
