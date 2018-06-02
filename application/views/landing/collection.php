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
	<!-- Theme CSS -->
	<link href="<?=base_url();?>assets/css/full-slider.css" rel="stylesheet">
	<!-- Elegant CSS -->
	<link href="<?=base_url();?>assets/css/elegant.css" rel="stylesheet">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
	<?php include_once('nav.php'); ?>
	<section id="gallery" class="content-section text-center" style="margin-top: 30px;">
		<?php foreach($category as $cat): ?>
			<div class="container-fluid" style="margin-bottom: 50px;">
		<div id="carousel-<?=$cat->id;?>" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		  	<?php $first = true;?>
		  	<?php $count = 0;?>
		  	<?php foreach ($collection[$cat->id] as $col): ?>
	        <li data-target="#carousel-<?=$cat->id;?>" data-slide-to="$count" class="<?=$first?'active':'';?>"></li>
		    <?php $first=false;?>
		  	<?php $count++;?>
		    <?php endforeach; ?>
	      </ol>
		  <div class="carousel-inner" role="listbox">
		  	<?php $first = true; ?>
		  	<?php foreach ($collection[$cat->id] as $col): ?>
		    <div class="carousel-item <?=$first?'active':'';?>" style="background-image: url('<?=base_url('upload/collection/').substr($col->image, 0,-4).'_900.jpg';?>')">
		      <!-- <img class="d-block" src="<?=base_url('upload/collection/').substr($col->image, 0,-4).'_900.jpg';?>" alt="First slide"> -->
		      <div class="carousel-caption d-none d-md-block">
			    <h5><?=$col->title;?></h5>
			    <p><?=$col->description;?></p>
			  </div>
		    </div>
		    <?php $first=false;?>
		    <?php endforeach; ?>
		  </div>
		  <a class="carousel-control-prev" href="#carousel-<?=$cat->id;?>" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carousel-<?=$cat->id;?>" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		</div>
		<?php endforeach; ?>

	</section>
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
