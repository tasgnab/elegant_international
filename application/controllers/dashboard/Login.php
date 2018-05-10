<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *     http://example.com/index.php/welcome
   *  - or -
   *     http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */

  function __construct(){
        parent::__construct();
        $this->load->model('MUser');
    }

  public function index(){
    $this->handle_login();
    $this->load->view('dashboard/login');
  }

  public function do_login(){
    $this->handle_login();
    
    if (!$this->input->post())
      redirect(base_url('dashboard/login'));

    $data = array();
    $error_found = false;

    if (!$this->input->post('username')){
      $message = "Username should not be blank";
      $error_found = true;
    }
    $data['username'] = $this->input->post('username');

    if (!$error_found && !$this->input->post('password')){
      $message = "Password should not be blank";
      $error_found = true;
    }
    $data['password'] = md5($this->input->post('password'));

    if (!$error_found && !$this->isUserExist($data['username'])){
      $message = "User does not exist";
      $error_found = true;
    }

    if (!$error_found && $this->isUserDisabled($data['username'])){
      $message = "User disabled";
      $error_found = true;
    }

    if (!$error_found && !$this->isPasswordCorrect($data)){
      $this->handleFailedLogin(array('username' => $data['username'] ));
      $message = "Invalid password";
      $error_found = true;
    }

    $this->session->set_flashdata('isError', $error_found);
    if ($error_found){
      $this->session->set_flashdata('message', $message);
      redirect(base_url('dashboard/login'));
    }

    $this->MUser->update_successful_login($data);
    $this->set_session_data($data['username']);
    redirect(base_url("dashboard/collection"));
  }

  public function logout(){
    $this->session->sess_destroy();
    redirect(base_url('dashboard/login'));
  }

  public function change_password(){
    $this->handle_not_login();
    $this->load->view('dashboard/change_password');
  }

  public function do_change_password(){
    $this->handle_not_login();
    
    if (!$this->input->post())
      redirect(base_url('dashboard/login/change_password'));

    $error_found = false;
    if (!$this->input->post('old_password')){
      $message = "Old password should not be blank";
      $error_found = true;
    }

    if (!$error_found && !$this->input->post('new_password')){
      $message = "New password should not be blank";
      $error_found = true;
    }

    if (!$error_found && !$this->input->post('new_password2')){
      $message = "New password should not be blank";
      $error_found = true;
    }

    if (!$error_found && $this->input->post('new_password')!=$this->input->post('new_password2')){
      $message = "New password does not match";
      $error_found = true;
    }

    $where = array(
      'username' => $this->session->userdata('username'), 
      'password' => md5($this->input->post('old_password'))
      );

    if (!$error_found && !$this->isPasswordCorrect($where)){
      $message = "Invalid Password";
      $error_found = true;
    }

    $data = array('password' => md5($this->input->post('new_password')));
    if (!$error_found && !$this->MUser->update_password($data)){
      $message = "Failed to update password";
      $error_found = true;
    }

    $this->session->set_flashdata('isError', $error_found);

    if ($error_found){
      $this->session->set_flashdata('message', $message);
      redirect(base_url('dashboard/login/change_password'));
    }

    $this->session->set_flashdata('message', 'Password Updated');
    redirect(base_url('dashboard/login/change_password'));
  }

  private function isUserExist($username){
    $where['username'] = $username;
    if ($this->MUser->count_user($where)>0)
      return true;
    else 
      return false;
  }

  private function isUserDisabled($username){
    $where = array(
      'username' => $username,
      'is_disabled' => 'Y'
    );

    if ($this->MUser->count_user($where)>0)
      return true;
    else
      return false;
  }

  private function isPasswordCorrect($where){
    $where['is_disabled'] = 'N';
      
    if ($this->MUser->count_user($where)>0)
      return true;
    else
      return false;
  }

  private function handleFailedLogin($where){
    $where['is_disabled'] = 'N';
    $failed_attemps = $this->MUser->get_failed_attemps($where);
    $this->MUser->update_failed_login($where);
    if ($failed_attemps>=4){
      $this->MUser->update_set_disable($where);
    }
  }
}
