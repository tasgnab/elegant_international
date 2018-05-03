<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

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
		$this->load->model('mlogin');
	}

	public function index(){
		if (!$this->isAdmin()){
			$data['message'] = $this->session->flashdata('message');
			$this->load->view('dashboard/login',$data);
		} else {
			redirect('dashboard/collection');
		}
	}

	public function doLogin(){
		if (!$this->isAdmin()){
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			if (!$this->mlogin->validateUsername($username)){
				$this->session->set_flashdata('message',$this->config->item('msg_invalid_login'));
				redirect($this->config->item('redirect_login'));
			} else {
				$failed_attempt = $this->mlogin->getFailedAttempt($username);
				if ($failed_attempt==3 && $this->mlogin->validateLastFailedAttempt($username)){
					$this->session->set_flashdata('message',$this->config->item('msg_user_locked'));
					redirect($this->config->item('redirect_login'));
				} else {
					if (!$this->mlogin->validateLogin(array('username' => $username, 'password' => $password))){
						$this->mlogin->updateFailedAttempt($username);
						$this->session->set_flashdata('message',$this->config->item('msg_invalid_login'));
						redirect($this->config->item('redirect_login'));
					} else {
						$this->mlogin->updateSuccessfulLogin($username);
						$user = $this->mlogin->getUserData($username);
						$this->session->set_userdata('isLogin',true);
						$this->session->set_userdata('isAdmin',true);
						$this->session->set_userdata('username',$username);
						$this->session->set_userdata('name',$user->name);
						redirect($this->config->item('redirect_login'));
					}
				}
			}
		} else {
			redirect($this->config->item('redirect_login'));
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect($this->config->item('redirect_login'));
	}

	public function password(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$this->load->view('dashboard/change_password');
		}
	}

	public function doChangePassword(){
		if (!$this->isAdmin()){
			redirect($this->config->item('redirect_login'));
		} else {
			$oldPassword = md5($this->input->post('oldPassword'));
			$newPassword = md5($this->input->post('newPassword'));
			if(!$this->mlogin->validateLogin(array('username' => $this->session->userdata('username'), 'password' => $oldPassword))){
				$this->session->set_flashdata('message',$this->config->item('msg_invalid_password'));
			} else {
				$this->mlogin->changePassword(
					$this->session->userdata('username'),
					array('password' => $newPassword)
					);
				$this->session->set_flashdata('message',$this->config->item('msg_success_changePassword'));
			}
			redirect('dashboard/login/password');
		}
	}
}
