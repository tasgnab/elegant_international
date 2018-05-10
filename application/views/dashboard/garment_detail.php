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
    <!-- Dropzone.js -->
    <link href="<?=base_url();?>assets/vendor/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

    <link href="<?=base_url();?>assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
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
                <h3><?=$brand->brand;?> </h3>
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
                  <div class="x_title">
                    <h2><?=$brand->description;?> </h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a href="<?=base_url('dashboard/garment');?>"><button class="btn btn-default" type="button"><span><i class="fa fa-angle-left"></i> &nbsp;Back</span></button></a></li>
                        <li><a data-toggle="modal" data-target="#CollectionModalAdd"><button class="btn btn-default" type="button"><span><i class="fa fa-plus"></i> &nbsp;Add</span></button></a></li>
                      </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <br/>
                    <table id="garment-table" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Image</th>
                          <th>Stock</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($garment as $g): ?>
                          <tr>
                            <td><?=$g->code;?></td>
                            <td><img style="max-height: 250px; display: block;" src="<?=(is_null($g->filename)?base_url('assets/img/').'Noimage.png':base_url('upload/garment/').substr($g->filename, 0, -4).'_250.jpg');?>" alt="image" /></td>
                            <td><?=$g->stock;?></td>
                            <td>
                              <!-- Single button -->
                              <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a onClick='edit(<?=$g->id;?>,"<?=$g->code;?>",<?=$g->stock;?>)'>Edit</a></li>
                                  <li><a onClick='deleteGarment(<?=$g->id;?>)'>Delete</a></li>
                                  <li><a onClick='changeImage(<?=$g->id;?>)'>Change / Remove Image</a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
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

    <div id="CollectionModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Update Garment</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="collectionEdit" class="form-horizontal" role="form">
                <input type="hidden" class="form-control" id="id" name="id">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="code" name="code">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Stock</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="stock" name="stock">
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button id="collectionEditButton" type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="CollectionModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Delete Garment</h4>
          </div>
          <div class="modal-body">
            <p>Delete this Garment?</p>
            <form id="collectionDelete" class="form-horizontal" role="form">
              <input type="hidden" class="form-control" id="id" name="id">
            </form>  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button id="collectionDeleteButton" type="button" class="btn btn-primary antosubmit">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <div id="CollectionModalAddImage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Delete Garment</h4>
          </div>
          <div class="modal-body">
            <form id="collectionDelete" class="form-horizontal" role="form">
              <input type="hidden" class="form-control" id="id" name="id">
            </form>  
            <form class="dropzone" action="<?=base_url('dashboard/garment/doAddImage'); ?>" id="myDropzoneContainer" enctype="multipart/form-data">
              <div class="dz-message" data-dz-message><span>Click or drop your file here.<br>Recommended aspect ratio 1:1.<br>Max filesize 200 KB.<br>File format '.jpg'</span></div>
              <div class="fallback">
                <input name="file" type="file">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button id="collectionAddImageButton" type="button" class="btn btn-primary antosubmit">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <div id="CollectionModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Update Garment</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="collectionEdit" class="form-horizontal" role="form">
                <input type="hidden" class="form-control" id="brandId" name="brandId" value="<?=$brand->id;?>">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="code" name="code">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Stock</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="stock" name="stock">
                  </div>
                </div>
              </form>
              <form class="dropzone" action="<?=base_url('dashboard/garment/doAddImage'); ?>" id="myDropzoneContainer" enctype="multipart/form-data">
                <div class="dz-message" data-dz-message><span>Click or drop your file here.<br>Recommended aspect ratio 1:1.<br>Max filesize 200 KB.<br>File format '.jpg'</span></div>
                <div class="fallback">
                  <input name="file" type="file">
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
            <button id="collectionAddButton" type="button" class="btn btn-primary antosubmit">Save changes</button>
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
    <!-- Dropzone.js -->
    <script src="<?=base_url();?>assets/vendor/dropzone/dist/min/dropzone.min.js"></script>

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

    <!-- Custom Theme Scripts -->
    <script src="<?=base_url();?>assets/js/custom.js"></script>
    <script type="text/javascript">
      Dropzone.options.myDropzoneContainer = { 
        method: "post", 
        maxFilesize: 1,
        acceptedFiles: "image/jpeg,image/jpg",
        parallelUploads: 1,
        autoProcessQueue: true,
        uploadMultiple: false,
        maxFiles: 1
      };

      $('#garment-table').dataTable({
          'order': [[ 0, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [1,3] }
            ]
        });

      function edit(id,code,stock){
          $("#CollectionModalEdit").find('input#id').val(id);
          $("#CollectionModalEdit").find('input#code').val(code);
          $("#CollectionModalEdit").find('input#stock').val(stock);
          $('#CollectionModalEdit').modal('toggle');
        }

      $('#collectionEditButton').click(function(e){
          e.preventDefault();
          var id = $('#CollectionModalEdit').find('input#id').val();
          var code = $('#CollectionModalEdit').find('input#code').val();
          var stock = $('#CollectionModalEdit').find('input#stock').val();
          $('#CollectionModalEdit').modal('toggle');
          $.ajax({
            type: "POST",
            url: "<?=base_url('dashboard/garment/update');?>", 
            dataType: 'json',
            data: {id: id, code: code, stock: stock},
            success: function(){
              
            }
          });
          location.reload(true);
        });

      function deleteGarment(id){
          $("#CollectionModalDelete").find('input#id').val(id);
          $('#CollectionModalDelete').modal('toggle');
        }

      $('#collectionDeleteButton').click(function(e){
          e.preventDefault();
          var id = $('#CollectionModalDelete').find('input#id').val();
          $('#CollectionModalDelete').modal('toggle');
          $.ajax({
            type: "POST",
            url: "<?=base_url('dashboard/garment/doDeleteGarment');?>", 
            dataType: 'json',
            data: {id: id},
            success: function(){
              
            }
          });
          location.reload(true);
        });

      function changeImage(id){
          $("#CollectionModalAddImage").find('input#id').val(id);
          $('#CollectionModalAddImage').modal('toggle');
        }

      $('#collectionAddImageButton').click(function(e){
          e.preventDefault();
          var id = $('#CollectionModalAddImage').find('input#id').val();
          $('#CollectionModalAddImage').modal('toggle');
          $.ajax({
            type: "POST",
            url: "<?=base_url('dashboard/garment/doUpdateImageGarment');?>", 
            dataType: 'json',
            data: {id: id},
            success: function(){
              
            }
          });
          location.reload(true);
        });

      $('#collectionAddButton').click(function(e){
          e.preventDefault();
          var brandId = $('#CollectionModalAdd').find('input#brandId').val();
          var code = $('#CollectionModalAdd').find('input#code').val();
          var stock = $('#CollectionModalAdd').find('input#stock').val();
          $('#CollectionModalAdd').modal('toggle');
          $.ajax({
            type: "POST",
            url: "<?=base_url('dashboard/garment/doInsertGarment');?>", 
            dataType: 'json',
            data: {brandId: brandId, code: code, stock: stock},
            success: function(){
              
            }
          });
          location.reload(true);
        });
    </script>
  </body>
</html>
