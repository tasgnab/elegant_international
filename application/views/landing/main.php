<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Elegant International | <?=$this->config->item('tagline'); ?></title>
	<link rel="icon" type="image/png" href="<?=base_url();?>assets/img/favicon.png" />
	<!-- Bootstrap Core CSS -->
	<link href="<?=base_url();?>assets/vendor/bootstrap4/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="<?=base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<!-- Theme CSS -->
	<link href="<?=base_url();?>assets/css/grayscale.css" rel="stylesheet">
	<!-- Elegant CSS -->
	<link href="<?=base_url();?>assets/css/elegant.css" rel="stylesheet">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
	<?php include_once('nav.php'); ?>

	<!-- Intro Header -->
	<header class="intro">
		<div class="intro-body">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="brand-heading">Elegant International</h1>
						<p class="intro-text">At your service.
							<!-- <br>We welcome the opportunity to be in service. --></p>
						<a href="#about" class="btn btn-circle page-scroll">
							<i class="fa fa-angle-double-down animated"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- About Section -->
	<?php include_once('section-about.php'); ?>

	<!-- Gallery Section -->
	<?php include_once('section-collection.php'); ?>

	<!-- Stuff Section -->
	<?php include_once('section-stuff.php'); ?>
	
	
	<!-- Contact Section -->
	<?php include_once('section-contact.php'); ?>

	<!-- Map Section -->
	<div id="map"></div>

	<!-- Footer -->
	<?php include_once('footer.php'); ?>

	<!-- jQuery -->
	<script src="<?=base_url();?>assets/vendor/jquery/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?=base_url();?>assets/vendor/bootstrap4/js/bootstrap.min.js"></script>
	<!-- Plugin JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzF6EQL3K6mRtTtgIw9zA7Gwcm8RHgmZ4&sensor=false"></script>
	<script src="<?=base_url();?>assets/js/grayscale.js"></script>
	<script src="<?=base_url();?>assets/js/gmaps.js"></script>
	<script type="text/javascript">
		$('#carouselExampleControls').on('slide.bs.carousel', function () {
		  // do something…
		})
	</script>
</body>

</html>
