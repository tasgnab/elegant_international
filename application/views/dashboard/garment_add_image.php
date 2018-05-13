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
    <!-- Custom Theme Style -->
    <link href="<?=base_url();?>assets/css/custom.css" rel="stylesheet">
    <?php include_once('component_comodo_js.php');?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include_once('component_nav.php');?>

        <!-- page content -->
        <div id="garment-add-image" class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Upload garment image(s) for <strong><?php echo $brand_name; ?></strong> </h3>
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
                    <h2>Upload Image(s) </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="" enctype="multipart/form-data">
                      <input type="hidden" id ="brand_id" name ="brand_id" value="<?=$id;?>" />
                      <div class="dropzone" id="myDropzoneContainer">
                        <div class="dz-message" data-dz-message><span>Click or drop your files here.<br>Recommended aspect ratio 1:1.<br>Max filesize 200 KB.<br>File format '.jpg'</span></div>
                      </div>
                    </form>
                    <span><button style="margin-top: 15px; float: right" type="submit" id="submit-all" class="btn btn-success">Submit</button></span>
                    
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
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url();?>assets/js/custom.js"></script>
    <script>
      Dropzone.options.myDropzoneContainer = {
            url: "<?=base_url('dashboard/garment/create');?>",
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 10,
            acceptedFiles: ".jpg",

            init: function () {

                var submitButton = document.querySelector("#submit-all");
                var wrapperThis = this;

                submitButton.addEventListener("click", function () {
                    wrapperThis.processQueue();
                });

                this.on('sendingmultiple', function (data, xhr, formData) {
                    formData.append("brand_id", $("#brand_id").val());
                });
            }
        };
    </script>
  </body>
</html>
