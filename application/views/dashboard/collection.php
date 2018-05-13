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
              <div class="title_left"><h3><strong><?php if(isset($category_name)){echo $category_name;} ?></strong> Collection </h3></div>
              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <form method="GET" action="<?=base_url('dashboard/collection/view/').$category_id;?>">
                    <div class="input-group">
                      <input id="search" name="search" type="text" class="form-control" placeholder="Search for Collection">
                      <span class="input-group-btn"><button type="submit" class="btn btn-default" type="button">Go!</button></span>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Wizards <small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a><button id="showFavorite" class="btn btn-default" type="button"><span><i class="fa fa-star"></i> &nbsp;Favorite</span></button></a></li>
                      <li><a href="<?=base_url('dashboard/collection/create');?>"><button class="btn btn-default" type="button"><span><i class="fa fa-plus"></i> &nbsp;Add</span></button></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <?php include_once('component_alert.php');?>
                      <?php foreach($collection as $c): ?> 
                      <div class="col-md-55">
                        <div class="<?php if($c->is_favorite=='Y'){echo 'thumbnail border-gold';} else { echo 'thumbnail';}?>">
                          <div class="image view view-first">
                            <input name="category" id="category" type="hidden" value="<?=$c->category_id; ?>">
                            <input name="id" id="id" type="hidden" value="<?=$c->id; ?>">
                            <input name="title" id="title" type="hidden" value="<?=$c->title; ?>">
                            <input name="description" id="description" type="hidden" value="<?=$c->description; ?>">
                            <a><img style="width: 100%; display: block;" src="<?=base_url('upload/collection/').substr($c->image, 0, -4).'_250.jpg';?>" alt="image" onClick="showImage('<?=substr($c->image, 0, -4);?>');" alt="image"/></a>
                            <div class="mask">
                              <div class="tools tools-bottom">
                                <i class="fa fa-pencil" data-toggle="modal" data-target="#CollectionModalUpdate"></i>
                                &nbsp;&nbsp;
                                <i class="fa fa-trash"></i>
                                &nbsp;&nbsp;
                                <i class="<?php if($c->is_favorite=='Y'){echo 'fa fa-star color-gold';} else {echo 'fa fa-star';}?>"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><?=$c->title;?></p>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="row">
                      <div class="footer-left">
                        <span><i class="fa fa-pencil"></i> edit &nbsp;</span>
                        <span><i class="fa fa-trash"></i> delete &nbsp;</span>
                        <span><i class="fa fa-star"></i> show in page</span>
                      </div>
                      <div style="float: right; padding-right: 20px;">
                        <?php echo $this->pagination->create_links(); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- /page content -->
        <?php include_once('component_footer.php');?>
      </div>
    </div>

    <div id="CollectionModalUpdate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Collection</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="collectionEdit" class="form-horizontal" role="form" action="<?=base_url('dashboard/collection/update');?>" method="post">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Category <span class="required">*</span></label>
                  <div class="col-sm-9">
                    <select id="category" name="category" class="form-control" required>
                      <option value="">Select category</option>
                      <?php foreach ($categories->result() as $category): ?>
                        <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <input type="hidden" class="form-control" id="id" name="id">
                <input type="hidden" class="form-control" id="redirect_url" name="redirect_url" value="<?=$category_id;?>">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Title <span class="required">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="title" name="title" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description <span class="required">*</span></label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows=5 id="description" name="description" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="CollectionModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Delete Collection</h4>
          </div>
          <div class="modal-body">
            <p>Delete this Collection?</p>
            <form id="collectionDelete" class="form-horizontal" role="form" action="<?=base_url('dashboard/collection/delete');?>" method="post">
              <input type="hidden" class="form-control" id="id" name="id">
              <input type="hidden" class="form-control" id="redirect_url" name="redirect_url" value="<?=$category_id;?>">
              <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
            </form>  
          </div>
        </div>
      </div>
    </div>

    <div id="CollectionModalShow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <img style="width: 100%;" src="" alt="image" />
          </div>
        </div>
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
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url();?>assets/js/custom.min.js"></script>
    <script type="text/javascript">
    
      $(".thumbnail .fa-star").click(function(){
        var id = $(this).closest($('.thumbnail')).find($('input#id')).attr('value');
        $.ajax({
          type: "POST",
          url: "<?=base_url('dashboard/collection/favorite');?>", 
          dataType: 'json',
          data: {id: id},
          success: function(){
          }
        });

        $(this).closest($('.col-md-55')).toggleClass('normal');
        $(this).toggleClass('color-gold');
        $(this).closest($('.thumbnail')).toggleClass('border-gold');
      });

      $(".thumbnail .fa-pencil").click(function(){
        var category = $(this).closest($('.thumbnail')).find($('input#category')).attr('value');
        var id = $(this).closest($('.thumbnail')).find($('input#id')).attr('value');
        var title = $(this).closest($('.thumbnail')).find($('input#title')).attr('value');
        var description = $(this).closest($('.thumbnail')).find($('input#description')).attr('value');

        $('#CollectionModalUpdate').find('select#category').val(category);
        $('#CollectionModalUpdate').find('input#id').val(id);
        $('#CollectionModalUpdate').find('input#title').val(title);
        $('#CollectionModalUpdate').find('textarea#description').val(description);
        
      });

      $(".thumbnail .fa-trash").click(function(e){
        e.preventDefault();
        var id = $(this).closest($('.thumbnail')).find($('input#id')).attr('value');
        $('#CollectionModalDelete').find('input#id').val(id);
        $('#CollectionModalDelete').modal('toggle');
      });

      $('#showFavorite').click(function(){
        $('.col-md-55.normal').toggleClass('hide');
        $(this).toggleClass('btn-warning');
        $(this).blur(); 
      })

      function showImage(filename){
        $('#CollectionModalShow').find('img').attr('src',"<?=base_url('upload/collection/');?>"+filename+"_1024.jpg");
        $('#CollectionModalShow').modal('toggle');
      }

    </script>
  </body>
</html>