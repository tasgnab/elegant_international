<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}

	public function isAdmin(){
		if($this->session->has_userdata('isAdmin')){
			return $this->session->userdata('isAdmin');
		}
		return false;
	}

	public function isUser(){
		if ($this->session->userdata("usertype")==1){
			return true;
		}
		return false;
	}
	
	public function isLogin(){
		if($this->session->has_userdata('isLogin')){
			return $this->session->userdata('isLogin');
		}
		return false;
	}

	public function isDev(){
		if ($this->config->item('environment')=='development')
			return true;
		return false;
	}

	public function uploadImage(){

	}
}