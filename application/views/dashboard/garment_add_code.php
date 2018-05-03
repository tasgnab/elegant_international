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
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<?php include_once('nav.php');?>

				<!-- page content -->
				<div id="garment-add-code" class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>Add new Garment </h3>
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
										<h2>Brand <strong><?php echo $this->session->userdata('brand'); ?></strong></h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<?php foreach ($listImage as $garment): ?>
										<div class="row">
											<div class="col-md-3 col-sm-6 col-xs-6">
												<img src="<?=base_url('upload/garment/').substr($garment->filename, 0, -4).'_250.jpg';?>">
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<form class="form-horizontal form-label-left">
													<div class="form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Code <span class="required">*</span></label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="code" name="code" type="text" class="form-control" required="" maxlength="20" value="<?=$garment->code;?>">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-3 col-sm-3 col-xs-12">Stock <span class="required">*</span></label>
														<div class="col-md-6 col-sm-6 col-xs-12">
															<input id="stock" name="stock" type="number" class="form-control" required="" value="<?=$garment->stock;?>">
														</div>
													</div>
													<div class="form-group">
														<input id="id" name="id" type="hidden" class="form-control" required="" value="<?=$garment->id;?>">
													</div>
													<div class="form-group">
														<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
															<button type="submit" class="btn btn-success">Update</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										<?php endforeach; ?>
										<a href="<?=base_url('dashboard/garment/doFinish');?>"><button style="float: right" type="submit" class="btn btn-info">Finish</button></a>
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

		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Data Update</h4>
					</div>
					<div class="modal-body">
						<p>Data telah berhasil diperbarui.</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
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
		<!-- Custom Theme Scripts -->
		<script src="<?=base_url();?>assets/js/custom.js"></script>
		<script type="text/javascript">
			 $(function () {
			 	$('form').on('submit', function (e) {
			 		e.preventDefault();
			 		$.ajax({
			 			type: 'post',
			 			url: "<?=base_url('dashboard/garment/update');?>",
			 			data: $('form').serialize(),
			 			success: function () {
			 				$('#myModal').modal('show');
			 			}
			 		});
			 	});
			 });
		</script>
	</body>
</html>
