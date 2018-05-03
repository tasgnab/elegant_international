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
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left"><h3> Garment </h3></div>
							<div class="title_right">
								<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
									<form method="GET" action="<?=base_url('dashboard/garment');?>">
										<div class="input-group">
											<input id="search" name="search" type="text" class="form-control" placeholder="Search for Collection">
											<span class="input-group-btn"><button type="submit" class="btn btn-default" type="button">Go!</button></span>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12">
								<div class="x_panel">
									<div class="x_title">
										<h2>Form Wizards <small>Sessions</small></h2>
										<ul class="nav navbar-right panel_toolbox">
											<li><a href="<?=base_url('dashboard/garment?deleted=1');?>"><button class="btn btn-default" type="button"><span><i class="fa fa-trash"></i> &nbsp;Deleted</span></button></a></li>
											<li><a href="<?=base_url('dashboard/garment?favorite=1');?>"><button class="btn btn-default" type="button"><span><i class="fa fa-star"></i> &nbsp;Favorite</span></button></a></li>
											<li><a href="<?=base_url('dashboard/garment');?>"><button class="btn btn-default" type="button"><span><i class="fa fa-bars"></i> &nbsp;All</span></button></a></li>
											<li><a href="<?=base_url('dashboard/garment/add');?>"><button class="btn btn-default" type="button"><span><i class="fa fa-plus"></i> &nbsp;Add</span></button></a></li>
										</ul>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<div class="row">
											<?php if(!is_null($this->session->flashdata('message'))): ?>
											<div class="alert alert-warning alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<strong>Sorry!</strong> <?=$this->session->flashdata('message');?>
											</div>
											<?php endif; ?>
											<?php foreach($brand as $b): ?> 
											<div class="col-md-55">
												<div class="<?php if($b->is_favorite==1){echo 'thumbnail border-gold';} else { if($b->is_deleted){echo 'thumbnail border-blue';}else {echo 'thumbnail';}}?>">
													<div class="image view view-first">
														<input name="id" id="id" type="hidden" value="<?=$b->id; ?>">
														<input name="brand" id="brand" type="hidden" value="<?=$b->brand; ?>">
														<input name="description" id="description" type="hidden" value="<?=$b->description; ?>">
														<a href="<?=base_url('dashboard/garment?view=detail&id=').$b->id; ?>"><img style="width: 100%; display: block;" src="<?=(is_null($b->filename)?base_url('assets/img/').'Noimage.png':base_url('upload/garment/').substr($b->filename, 0, -4).'_250.jpg');?>" alt="image" /></a>
														<div class="mask">
															<div class="tools tools-bottom">
																<i class="fa fa-pencil" data-toggle="modal" data-target="#CollectionModalEdit"></i>
																&nbsp;&nbsp;
																<i class="<?php if($b->is_deleted==1){echo 'fa fa-trash color-gold';} else {echo 'fa fa-trash';}?>"></i>
																&nbsp;&nbsp;
																<i class="<?php if($b->is_favorite==1){echo 'fa fa-star color-gold';} else {echo 'fa fa-star';}?>"></i>
															</div>
														</div>
													</div>
													<div class="caption">
														<p><?=$b->brand;?></p>
													</div>
												</div>

											</div>
											<?php endforeach; ?>
										</div>
										<div class="row">
											<div class="footer-left">
												<span><i class="fa fa-pencil"></i> edit &nbsp;</span>
												<span><i class="fa fa-trash"></i> delete &nbsp;</span>
												<span><i class="fa fa-star"></i> toggle favorite</span>
											</div>
											<div style="float: right; padding-right: 20px;">
												<?php echo $this->pagination->create_links(); ?>
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

		<div id="CollectionModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Update Brand</h4>
					</div>
					<div class="modal-body">
						<div id="testmodal" style="padding: 5px 20px;">
							<form id="collectionEdit" class="form-horizontal" role="form">
								<input type="hidden" class="form-control" id="id" name="id">
								<div class="form-group">
									<label class="col-sm-3 control-label">Brand</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="brand" name="brand">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Description</label>
									<div class="col-sm-9">
										<textarea class="form-control" style="height:55px;" id="description" name="description"></textarea>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
						<button id="collectionEditButton" type="button" class="btn btn-primary antosubmit">Save changes</button>
					</div>
				</div>
			</div>
		</div>

		<div id="CollectionModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Delete Collection</h4>
					</div>
					<div class="modal-body">
						<p>Delete this Collection?</p>
						<form id="collectionDelete" class="form-horizontal" role="form">
							<input type="hidden" class="form-control" id="id" name="id">
						</form>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
						<button id="collectionDeleteButton" type="button" class="btn btn-primary antosubmit">Delete</button>
					</div>
				</div>
			</div>
		</div>

		<div id="CollectionModalUnDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Delete Collection</h4>
					</div>
					<div class="modal-body">
						<p>Restore this Collection?</p>
						<form id="collectionDelete" class="form-horizontal" role="form">
							<input type="hidden" class="form-control" id="id" name="id">
						</form>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
						<button id="collectionUnDeleteButton" type="button" class="btn btn-primary antosubmit">Save changes</button>
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
		<script src="<?=base_url();?>assets/js/custom.min.js"></script>
		<script type="text/javascript">
		
			$(".thumbnail .fa-star").click(function(){
				var id = $(this).closest($('.thumbnail')).find($('input#id')).attr('value');
				$.ajax({
					type: "POST",
					url: "<?=base_url('dashboard/garment/doFavorite');?>", 
					dataType: 'json',
					data: {id: id},
					success: function(){
						
					}
				});
				$(this).toggleClass('color-gold');
				$(this).siblings($('.fa-trash')).removeClass('color-gold');
				$(this).closest($('.thumbnail')).toggleClass('border-gold');
				$(this).closest($('.thumbnail')).removeClass('border-blue');
			});

			$(".thumbnail .fa-pencil").click(function(){
				var id = $(this).closest($('.thumbnail')).find($('input#id')).attr('value');
				var brand = $(this).closest($('.thumbnail')).find($('input#brand')).attr('value');
				var description = $(this).closest($('.thumbnail')).find($('input#description')).attr('value');
				$('#CollectionModalEdit').find('input#id').val(id);
				$('#CollectionModalEdit').find('input#brand').val(brand);
				$('#CollectionModalEdit').find('textarea#description').val(description);
				
			});

			$('#collectionEditButton').click(function(e) {
				e.preventDefault();
				var id = $('#CollectionModalEdit').find('input#id').val();
				var brand = $('#CollectionModalEdit').find('input#brand').val();
				var description = $('#CollectionModalEdit').find('textarea#description').val();
				$('#CollectionModalEdit').modal('toggle');
				$.ajax({
					type: "POST",
					url: "<?=base_url('dashboard/garment/doEdit');?>", 
					dataType: 'json',
					data: {id: id, brand: brand, description: description},
					success: function(){
						
					}
				});
			});

			$(".thumbnail .fa-trash").click(function(e){
				e.preventDefault();
				var id = $(this).closest($('.thumbnail')).find($('input#id')).attr('value');
				if ($(this).hasClass('color-gold')){
					$('#CollectionModalUnDelete').modal('toggle');
					$('#CollectionModalUnDelete').find('input#id').val(id);
				} else {
					$('#CollectionModalDelete').modal('toggle');
					$('#CollectionModalDelete').find('input#id').val(id);
				}
			});

			$('#collectionDeleteButton').click(function(e) {
				e.preventDefault();
				var id = $('#CollectionModalDelete').find('input#id').val();
				$('#CollectionModalDelete').modal('toggle');
				$.ajax({
					type: "POST",
					url: "<?=base_url('dashboard/garment/doDelete');?>", 
					dataType: 'json',
					data: {id: id},
					success: function(){
						
					}
				});
				$('.x_content .row').find('input#id[value="'+id+'"]').closest($('.thumbnail')).toggleClass('border-blue');
				$('.x_content .row').find('input#id[value="'+id+'"]').closest($('.thumbnail')).find($('.fa-trash')).toggleClass('color-gold');
				$('.x_content .row').find('input#id[value="'+id+'"]').closest($('.thumbnail')).find($('.fa-star')).toggleClass('color-gold');
			});

			$('#collectionUnDeleteButton').click(function(e) {
				e.preventDefault();
				var id = $('#CollectionModalUnDelete').find('input#id').val();
				$('#CollectionModalUnDelete').modal('toggle');
				$.ajax({
					type: "POST",
					url: "<?=base_url('dashboard/garment/doRestore');?>", 
					dataType: 'json',
					data: {id: id},
					success: function(){
					}
				});
				$('.x_content .row').find('input#id[value="'+id+'"]').closest($('.thumbnail')).toggleClass('border-blue');
				$('.x_content .row').find('input#id[value="'+id+'"]').closest($('.thumbnail')).find($('.fa-trash')).toggleClass('color-gold');
				$('.x_content .row').find('input#id[value="'+id+'"]').closest($('.thumbnail')).find($('.fa-star')).toggleClass('color-gold');
			});
		</script>
	</body>
</html>