<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="#" class="site_title"><i class="fa fa-paw"></i> <span><?=$this->config->item('company_name'); ?></span></a>
		</div>

		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			<div class="profile_info">
				<span>Welcome,</span>
				<h2><?=$this->session->userdata('username');?></h2>
			</div>
		</div>
		<!-- /menu profile quick info -->
		<br />
		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			<div class="menu_section">
				<h3>General</h3>
				<ul class="nav side-menu">
					<li><a><i class="fa fa-desktop"></i> Collection <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?=base_url('dashboard/collection/category');?>">Manage Category </a></li>
							<li><a href="<?=base_url('dashboard/collection/add');?>">Add New Collection </a></li>
							<li><a>View Collection <span class="fa fa-chevron-down"></span></a>
								<ul class="nav child_menu">
									<?php foreach ($categories->result() as $category): ?>
										<li><a href="<?=base_url('dashboard/collection/view/').$category->id;?>"><?=$category->name?></a></li>
									<?php endforeach; ?>
								</ul>
							</li>
						</ul>
					</li>
					<li><a><i class="fa fa-sticky-note"></i> Garment <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?=base_url('dashboard/garment/add');?>">Add New Brand</a></li>
							<li><a href="<?=base_url('dashboard/garment');?>">View Garments</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="menu_section">
				<ul class="nav side-menu">
					<li><a href="<?=base_url('dashboard/login/password');?>"><i class="fa fa-laptop"></i> Change Password</a></li>
				</ul>
			</div>

		</div>
		<!-- /sidebar menu -->
		<!-- /menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="FullScreen">
				<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Lock">
				<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
			</a> -->
			<a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=base_url('dashboard/logout');?>">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>

<!-- top navigation -->
<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="<?=base_url();?>assets/img/user62.png" alt=""><?=$this->session->userdata('username');?>
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="<?=base_url('dashboard/change_password');?>"><i class="fa fa-laptop pull-right"></i> Change Password</a></li>
						<li><a href="<?=base_url('dashboard/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<!-- /top navigation -->