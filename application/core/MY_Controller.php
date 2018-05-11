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
    $data['categories'] = $this->MCategory->get('1=1');
    $this->load->view($view_path,$data);
  }

  function resize($targetFile, $filename, $orientation, $size){
    $config['image_library'] = 'gd2';
    $config['source_image'] = $targetFile;
    $config['maintain_ratio'] = TRUE;
    $config['new_image'] = $filename.'_'.$size.'.jpg';
    $config[$orientation] = $size;
    $this->image_lib->clear();
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
  }

  function crop($targetFile, $filename, $height, $width){
    $config['image_library'] = 'gd2';
    $config['source_image'] = $targetFile;
    $config['maintain_ratio'] = TRUE;
    $config['new_image'] = $filename.'_'.$height.'.jpg';
    $config['height'] = $height;
    $config['width'] = $width;
    $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($config['width'] / $config['height']);
    $config['master_dim'] = ($dim > 0)? "height" : "width";
    $this->image_lib->clear();
    $this->image_lib->initialize($config);
    $this->image_lib->resize();

    $config['image_library'] = 'gd2';
    $config['source_image'] = getcwd().$this->config->item('path_upload_collection').$filename.'_250.jpg';
    $config['maintain_ratio'] = FALSE;
    $config['new_image'] = $filename.'_'.$height.'.jpg';
    $config['height'] = $height;
    $config['width'] = $width;
    $config['x_axis'] = '0';
    $config['y_axis'] = '0';
    $this->image_lib->clear();
    $this->image_lib->initialize($config);
    $this->image_lib->crop();
  }

}