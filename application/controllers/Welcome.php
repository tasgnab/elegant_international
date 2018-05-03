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
		$this->load->model('mgarment');
		$this->load->model('mcollection');
	}

	public function index(){
		$where = "AND garment_brand.is_favorite = 1 ";
		$data['brand'] = $this->mgarment->dataBrand(8, 0, $where);
		$data['collection'] = $this->mcollection->allCollection(8, 0, array('is_favorite' => 1));
		$this->load->view('landing/main',$data);
	}
}
