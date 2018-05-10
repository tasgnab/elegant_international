<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
                    <?php if(!is_null($this->session->flashdata('message'))): ?>
                    <div class="alert <?php  if($this->session->flashdata('isError')){echo 'alert-warning';}else{echo 'alert-success';}?> alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong><?php  if($this->session->flashdata('isError')){echo 'Failed!';}else{echo 'Success!';}?></strong> <?=$this->session->flashdata('message');?>
                    </div>
                    <?php endif; ?>