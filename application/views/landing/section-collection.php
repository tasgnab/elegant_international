	<section id="gallery" class="content-section text-center">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
		  	<?php $first = true; ?>
		  	<?php foreach ($collection as $c): ?>
		    <div style="max-height: 600px;" class="carousel-item <?=$first?'active':'';?>">
		      <img style="max-height: 600px;" class="d-block" src="<?=base_url('upload/collection/').substr($c->image, 0,-4).'_900.jpg';?>" alt="First slide">
		      <div class="carousel-caption d-none d-md-block">
			    <h5>...</h5>
			    <p>...</p>
			  </div>
		    </div>
		    <?php $first=false;?>
		    <?php endforeach; ?>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		<div style="padding-top: 20px;" class="container">
			<div class="row">
				<div class="col-lg-12">
					<a href="<?=base_url('collection')?>" class="btn btn-default btn-lg"><span class="network-name">Check Other Collection</span></a>
				</div>
			</div>
		</div>
	</section>