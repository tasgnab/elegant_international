	<section id="stock" class="container content-section text-center">
		<div class="container">
			<div class="row">
				<h2>Stock</h2>
			</div>
			<div class="row">
				<table id="datatable-checkbox" class="table table-sm table-inverse table-responsive" cellspacing="0">
					<thead>
						<tr>
							<th>Brand</th>
							<th>Code</th>
							<th>Image</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($stock as $s):?>
						<tr>
							<td><?= $s->brand; ?></td>
							<td><?= $s->code; ?></td>
							<td><img style="width: 100%; display: block;" src="<?=(is_null($s->filename)?base_url('assets/img/').'Noimage.png':base_url('upload/garment/').substr($s->filename, 0, -4).'_250.jpg')?>" alt="image" /></td>
							<td><?= $s->stock; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<!-- Modal -->
	<div class="portfolio-modal modal fade" id="fabricModal-1" tabindex="-1" role="dialog" aria-hidden="true">
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
							<img src="<?=base_url()?>upload/fabric/1.jpg" class="img-responsive img-centered" alt="">
							<p>Lorem ipsum dolor sit amet, qui fugit audiam intellegat in. Eum illud option qualisque an, tota bonorum ius id. Id mei percipit sapientem honestatis, tale novum vivendum mel ei, eu graeco corrumpit intellegebat sea. Sed soleat iudicabit sententiae ad, vel causae aliquip ne, vidisse admodum vis ei.</p>
							<br/>
							<img src="<?=base_url()?>upload/fabric/1.jpg" class="img-responsive img-centered" alt="">
							<p>Lorem ipsum dolor sit amet, qui fugit audiam intellegat in. Eum illud option qualisque an, tota bonorum ius id. Id mei percipit sapientem honestatis, tale novum vivendum mel ei, eu graeco corrumpit intellegebat sea. Sed soleat iudicabit sententiae ad, vel causae aliquip ne, vidisse admodum vis ei.</p>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>