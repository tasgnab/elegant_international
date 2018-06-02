<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function  __construct() {
		parent::__construct();
		$this->load->model('MGarment');
		$this->load->model('MCollection');
	}

	public function index(){
		$data['brand'] = $this->MBrand->get(array('is_favorite' => 'Y'))->result();
		$garment = array();
		foreach ($data['brand'] as $brand) {
			$where['brand_id'] = $brand->id;
			$where['is_favorite'] = 'Y';
			$garment[$brand->id] = $this->MGarment->get($where)->result();
		}
		$data['garment'] = $garment;
		$data['collection'] = $this->MCollection->get_homepage()->result();
		$this->load->view('landing/main',$data);
	}

	public function collection(){
		$where['show_collection'] = 'Y';
		$data['category'] = $this->MCategory->get($where)->result();
		$collection = array();
		$where = array_values($where);
		foreach($data['category'] as $category){
			$where['category_id'] = $category->id;
			$where['is_favorite'] = 'Y';
			$collection[$category->id] = $this->MCollection->get($where)->result();
		}
		$data['collection'] = $collection;
		$this->load->view('landing/collection',$data);
	}
}
