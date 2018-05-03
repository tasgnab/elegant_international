	<section id="gallery" class="content-section text-center">
		<div class="container-fluid">
			<div class="accordian">
				<ul>
					<?php foreach ($collection as $c): ?>
					<li>
						<div class="image_title">
							<a class="text-left" data-toggle="modal" data-target="#myModal"><?=$c->title;?></a>
							<p><?=$c->description;?></p>
						</div>
						<div>
							<img src="<?=(is_null($c->image)?base_url('assets/img/').'Noimage.png':base_url('upload/collection/').$c->image);?>"/>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>
	<!-- Modal -->
	<div class="portfolio-modal modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
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
							<h2>Project Title</h2>
							<hr class="star-primary">
							<img src="<?=base_url()?>upload/1.jpg" class="img-responsive img-centered" alt="">
							<p>Lorem ipsum dolor sit amet, qui fugit audiam intellegat in. Eum illud option qualisque an, tota bonorum ius id. Id mei percipit sapientem honestatis, tale novum vivendum mel ei, eu graeco corrumpit intellegebat sea. Sed soleat iudicabit sententiae ad, vel causae aliquip ne, vidisse admodum vis ei.</p>
							<br/>
							<img src="<?=base_url()?>upload/1.jpg" class="img-responsive img-centered" alt="">
							<p>Lorem ipsum dolor sit amet, qui fugit audiam intellegat in. Eum illud option qualisque an, tota bonorum ius id. Id mei percipit sapientem honestatis, tale novum vivendum mel ei, eu graeco corrumpit intellegebat sea. Sed soleat iudicabit sententiae ad, vel causae aliquip ne, vidisse admodum vis ei.</p>
							<!-- <ul class="list-inline item-details">
								<li>Client:
									<strong><a href="http://startbootstrap.com">Start Bootstrap</a>
									</strong>
								</li>
								<li>Date:
									<strong><a href="http://startbootstrap.com">April 2014</a>
									</strong>
								</li>
								<li>Service:
									<strong><a href="http://startbootstrap.com">Web Development</a>
									</strong>
								</li>
							</ul> -->
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>