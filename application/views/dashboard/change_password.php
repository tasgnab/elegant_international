<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?=$this->config->item('company_name'); ?> | <?=$this->config->item('tagline'); ?></title>

		<!-- Bootstrap -->
		<link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?=base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?=base_url();?>assets/vendor/nprogress/nprogress.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
		<?php include_once('component_comodo_js.php');?>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<?php include_once('component_nav.php');?>
				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>Change Password </h3>
							</div>
							<div class="title_right">
								<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
								</div>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
									<div class="x_content">
										<?php if(!is_null($this->session->flashdata('message'))): ?>
										<div class="alert <?php  if($this->session->flashdata('isError')){echo 'alert-warning';}else{echo 'alert-success';}?> alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<strong><?php  if($this->session->flashdata('isError')){echo 'Failed!';}else{echo 'Success!';}?></strong> <?=$this->session->flashdata('message');?>
										</div>
										<?php endif; ?>
										<br/>
										<form method="post" class="form-horizontal form-label-left" action="<?=base_url('dashboard/change_password');?>" data-toggle="validator" role="form">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Old Password <span class="required">*</span></label>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<input id="old_password" name="old_password" type="password" class="form-control" required="" minlength="6" placeholder="Current Password">
													<div class="help-block with-errors"></div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">New Password <span class="required">*</span></label>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<input id="new_password" name="new_password" type="password" class="form-control" required="" minlength="6" placeholder="New Password"></input>
													<div class="help-block with-errors"></div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm New Password <span class="required">*</span></label>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<input id="new_password2" name="new_password2" type="password"  class="form-control" required="" minlength="6" placeholder="Confirm New Password" data-match="#new_password"></input>
													<div class="help-block with-errors"></div>
												</div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
												<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
													<button type="submit" class="btn btn-info">Change Password</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include_once('component_footer.php');?>
			</div>
		</div>
		<!-- jQuery -->
		<script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="<?=base_url();?>assets/vendor/fastclick/lib/fastclick.js"></script>
		<!-- NProgress -->
		<script src="<?=base_url();?>assets/vendor/nprogress/nprogress.js"></script>
		<!-- bootstrap-validator -->
		<script src="<?=base_url();?>assets/vendor/bootstrap-validator/dist/validator.js"></script>
		<!-- Custom Theme Scripts -->
		<script src="<?=base_url();?>assets/js/custom.js"></script>
	</body>
</html>
