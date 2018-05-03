<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {

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
	}

	public function index(){
		$data['stock'] = $this->mgarment->allGarment();
		$this->load->view('landing/stock_page',$data);
	}

	// public function findStock(){
	// 	$this->load->view('stock_find');
	// }
}
