<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?=$this->config->item('company_name'); ?> | <?=$this->config->item('tagline'); ?></title>

	<!-- Bootstrap Core CSS -->
	<link href="<?=base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?=base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="<?=base_url();?>assets/vendor/raccordion/css/raccordion.css" rel="stylesheet">
	<!-- Theme CSS -->
	<link href="<?=base_url();?>assets/css/grayscale.css" rel="stylesheet">
	<!-- Elegant CSS -->
	<link href="<?=base_url();?>assets/css/elegant.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

	<!-- Navigation -->
	<?php include_once('nav_stock.php'); ?>

	<!-- Stuff Section -->
	<section id="stock" class="container content-section text-center">
	</section>
	
	<!-- Footer -->
	<?php include_once('footer.php'); ?>

	<!-- jQuery -->
	<script src="<?=base_url();?>assets/vendor/jquery/jquery.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!-- Plugin JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzF6EQL3K6mRtTtgIw9zA7Gwcm8RHgmZ4&sensor=false"></script>

	<!-- <script type="text/javascript" src="<?=base_url();?>assets/vendor/raccordion/js/jquery.animation.easing.js"></script> -->
	<!-- <script type="text/javascript" src="<?=base_url();?>assets/vendor/raccordion/js/jquery.raccordion.js"></script> -->
	<!-- Theme JavaScript -->
	<script src="<?=base_url();?>assets/js/grayscale.js"></script>
</body>

</html>
