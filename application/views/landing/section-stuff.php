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
						<img class="image" src="<?=(is_null($b->filename)?base_url('assets/img/').'Noimage.png':base_url('upload/garment/').$b->filename);?>"/>
						<div class="middle">
							<div class="text"><h4><?=$b->brand;?></h4></div>
						</div>
					</div>
					</a>
				</div>
				<!-- Modal -->
				<div class="portfolio-modal modal fade" id="fabricModal-<?=$b->id;?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-content">
						<div class="close-modal" data-dismiss="modal">
							<div class="lr">
								<div class="rl">
								</div>
							</div>
						</div>
						<div class="container">
							<div class="row">
								<div class="col-lg-8 col-lg-offset-2">
									<div class="modal-body">
										<h2><?=$b->brand;?></h2>
										<hr class="star-primary">
										<img src="<?=(is_null($b->filename)?base_url('assets/img/').'Noimage.png':base_url('upload/garment/').$b->filename);?>" class="img-responsive img-centered" alt="">
										<p><?=$b->description;?></p>
										<br/>
										<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</section>

	