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
    <!-- Switchery -->
    <link href="<?=base_url();?>assets/vendor/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
    <?php include_once('component_comodo_js.php');?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include_once('component_nav.php');?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add New Collection </h3>
              </div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <?php include_once('component_alert.php');?>
                    <br/>
                    <form id="demo-form2" action="<?=base_url('dashboard/collection/create');?>" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" method="post">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <select id="category" name="category" class="form-control" required="required">
                          <option value="">Select category</option>
                          <?php foreach ($categories->result() as $category): ?>
                            <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                          <?php endforeach;?>
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="is_favorite">Show</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="checkbox" class="js-switch" name="is_favorite" id="is_favorite" value="Y"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Title <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <input id="title" name="title" type="text" class="form-control" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                          <textarea id="description" name="description" class="form-control" rows="4" required=""></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="image">File <span class="required">*</span></label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="file" class="form-control-file" name="file" accept=".jpg" required="required"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                          <button type="submit" class="btn btn-info" onclick="disable">Submit</button>
                        </div>
                      </div>
                    </form>
                    <div class="ln_solid"></div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include_once('component_footer.php');?>
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
    <!-- Switchery -->
    <script src="<?=base_url();?>assets/vendor/switchery/dist/switchery.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url();?>assets/js/custom.min.js"></script>
    <script type="text/javascript">
      $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
      });
    </script>
    
  </body>
</html>
