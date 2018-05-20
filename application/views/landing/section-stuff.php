	<section id="stuff" class="container content-section text-center">
		<div class="container">
			<div class="row">
				<h2>Garment</h2>
			</div>
			<div class="row">
				<?php foreach($brand as $b): ?> 
				<div class="col-lg-3">
					<a class="text-left" data-toggle="modal" data-target="#fabricModal-<?=$b->id;?>">
					<div class="garment-container">
						<img class="image" src="<?=base_url('upload/garment/').substr($b->image, 0, -4).'_250.jpg';?>"/>
						<div class="middle">
							<div class="text"><h4><?=$b->brand;?></h4></div>
						</div>
					</div>
					</a>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</section>

	<?php foreach($brand as $b): ?>
	<div class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="fabricModal-<?=$b->id;?>">
	  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="close-modal" data-dismiss="modal" aria-label="Close">
					<div class="lr">
						<div class="rl">
						</div>
					</div>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="modal-body">
								<h2><?=$b->brand;?></h2>
								<hr class="star-primary">
								<img src="<?=base_url('upload/garment/').substr($b->image, 0, -4).'_250.jpg';?>" class="img-responsive img-centered" alt="">
								<p><?=$b->description;?></p>
								<br/>
								<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
							</div>
						</div>
					</div>
					<div class="row">
						<?php foreach($garment[$b->id] as $g): ?>
						<div class="col-md-55">
							<div class="modal-body">
								<img src="<?=base_url('upload/garment/').substr($g->image, 0, -4).'_250.jpg';?>" class="img-responsive img-centered" alt="">
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach;?>
