<?php
class MY_Model extends CI_Model {

	function __construct(){
        parent::__construct();
    }

    function appendUpdatedBy($data){
    	$data['updated_by'] = $this->session->userdata('username');
		return $data;
    }

    function appendCreatedUpdatedBy($data){
    	$data['created_by'] = $this->session->userdata('username');
        $data['updated_by'] = $this->session->userdata('username');
		return $data;
    }
}