<?php
class MY_Controller extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('MCategory');
  }

  function is_login(){
    return $this->session->userdata('is_login');
  }

  function set_session_data($username){
    $this->session->set_userdata('is_login', true);
    $this->session->set_userdata('username', $username);
  }

  function handle_login(){
    if ($this->is_login())
      redirect(base_url('dashboard/collection'));
  }

  function handle_not_login(){
    if (!$this->is_login())
      redirect(base_url('dashboard/login'));
  }

  function handle_error($error_found,$message,$redirect_url){
    $this->session->set_flashdata('isError', $error_found);
    if ($error_found){
      $this->session->set_flashdata('message', $message);
      redirect(base_url($redirect_url));
    }
  }

  function load_view($view_path, $data=array()){
    $data['categories'] = $this->MCategory->all_category();
    $this->load->view($view_path,$data);
  }

}