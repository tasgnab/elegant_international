<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
    <!-- Datatables -->
    <link href="<?=base_url();?>assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <?php include_once('component_comodo_js.php');?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include_once('component_nav.php');?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Brand</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <span><a title="Add new Category" href="" data-toggle="modal" data-target="#modal-create" id="modal-button"><button type="button" class="btn btn-info"><i class="fa fa-plus"></i>  New</button></a></span>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <?php include_once('component_alert.php');?>
                      <br/>
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="footer-left">
                        <span><i class="fa fa-pencil"></i> edit &nbsp;</span>
                        <span><i class="fa fa-trash"></i> delete &nbsp;</span>
                        <span><i class="fa fa-plus"></i> add image(s)&nbsp;</span>
                        <span><i class="fa fa-home"></i> toggle show&nbsp;</span>
                        <span><i class="fa fa-arrow-right"></i> view image(s)&nbsp;</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include_once('component_footer.php');?>
      </div>
    </div>
    <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-create" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url('dashboard/garment/brand/create');?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="brand" name="brand" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="description" name="description" required="required" class="form-control col-md-7 col-xs-12" rows="4"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Image <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" class="form-control-file" name="file" required="required"/>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-update" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url('dashboard/garment/brand/update');?>" method="post">
              <input type="hidden" id="id" name="id" class="form-control col-md-7 col-xs-12">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="brand" name="brand" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="description" name="description" required="required" class="form-control col-md-7 col-xs-12" rows="4"></textarea>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-delete" data-parsley-validate class="form-horizontal form-label-left" method="post">
              <input type="hidden" id="id" name="id" class="form-control col-md-7 col-xs-12">
              <h3></h3>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </div>
            </form>
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
    <!-- Datatables -->
    <script src="<?=base_url();?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/jszip/dist/jszip.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/pdfmake/build/vfs_fonts.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url();?>assets/js/custom.js"></script>
    <script type="text/javascript">
      $('#datatable-responsive').DataTable({
        "pageLength" : 25,
        "columns": [
          { "width": "10%", "className": "align-middle"},
          { "orderable": false, "searchable": false}
        ],
        "ajax": {
            url : '<?=base_url("dashboard/garment/brand_list_page");?>',
            type : 'GET'
          },
        });
      function update(id, brand, description) {
        $('#form-update #id').val(id);
        $('#form-update #brand').val(brand);
        $('#form-update #description').val(description);
        $('#modal-update').modal();
      }
      function delete_brand(id, name) {
        $('#modal-delete h5').text("Delete Garment Brand");
        $('#form-delete').attr("action", '<?=base_url('dashboard/garment/brand/delete');?>');
        $('#form-delete h3').text("Delete "+name+"?");
        $('#form-delete #id').val(id);
        $('#modal-delete').modal();
      }
      function show_brand(id, name){
        $('#modal-delete h5').text("Set Homepage");
        $('#form-delete').attr("action", '<?=base_url('dashboard/garment/brand/show');?>');
        $('#form-delete h3').text("Brand "+name+" will be showing in the homepage");
        $('#form-delete #id').val(id);
        $('#modal-delete').modal();
      }
      $('form').submit(function() {
        $(this).find("button[type='submit']").prop('disabled',true);
      });
    </script>
  </body>
</html>
