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
		<!-- Dropzone.js -->
		<link href="<?=base_url();?>assets/vendor/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<?php include_once('nav.php');?>

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>Add New Collection </h3>
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
									<div class="x_title">
										<h2>New Collection </h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<?php if(!is_null($this->session->flashdata('message'))): ?>
										<div class="alert alert-success alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<strong>Success!</strong> <?=$this->session->flashdata('message');?>
										</div>
										<?php endif; ?>
										<br/>
										<form id="collectionAdd" method="post" action="<?=base_url('dashboard/collection/add');?>" class="form-horizontal form-label-left">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input id="title" name="title" type="text" class="form-control" required="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<textarea id="description" name="description" class="form-control" rows="4" required=""></textarea>
												</div>
											</div>
										</form>
										<form class="dropzone" action="<?=base_url('dashboard/collection/doUploadImage'); ?>" id="myDropzoneContainer" enctype="multipart/form-data">
											<div class="dz-message" data-dz-message><span>Click or drop your file here.<br>Recommended aspect ratio 4:3.<br>Max filesize 500 KB.<br>File format '.jpg'</span></div>
											<div class="fallback">
												<input name="file" type="file">
											</div>
										</form>
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
												<button id="addButton" type="submit" class="btn btn-success">Finish</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /page content -->

				<?php include_once('footer.php');?>
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
		
		<!-- Dropzone.js -->
		<script src="<?=base_url();?>assets/vendor/dropzone/dist/min/dropzone.min.js"></script>
		<!-- jQuery Smart Wizard -->
			<script src="<?=base_url();?>assets/vendor/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>

		<!-- Custom Theme Scripts -->
		<script src="<?=base_url();?>assets/js/custom.js"></script>
		<script>
			Dropzone.options.myDropzoneContainer = { 
				method: "post", 
				maxFilesize: 1,
				acceptedFiles: "image/jpeg,image/jpg",
				parallelUploads: 1,
				autoProcessQueue: true,
				uploadMultiple: false,
				maxFiles: 1
			};
			$('#addButton').click(function(){
				$('#collectionAdd').submit();
			});
		</script>
	</body>
</html>
