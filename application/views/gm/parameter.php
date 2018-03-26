<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Mb | MIS</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<script src="<?php echo base_url().'assets/livecss.js'?>" type="text/javascript"></script>
<?php $this->load->view('include/css');?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url().'assets/global/plugins/dropzone/css/dropzone.css'?>" rel="stylesheet"/>
<!-- END PAGE LEVEL STYLES -->
</head>
<style>
.form-horizontal .control-label {
    /*text-align: left;*/
}
</style>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content  page-sidebar-closed">
<!-- BEGIN HEADER -->
<?php $this->load->view('include/header'); ?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
<?php $this->load->view('include/slidebar');?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
      <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
MIS<small> PT PRAKARSALANGGENG MAJUBERSAMA</small>
			</h3>
			<div class="page-bar">
			</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet light bordered ">
						<div class="portlet-title">
							<div class="caption font-green-haze">
								<i class="icon-settings font-green-haze"></i>
								<span class="caption-subject bold uppercase"> Create New DKP </span>
							</div>
							<div class="actions">
								<!-- <a class="btn btn-circle btn-icon-only blue" href="javascript:;">
								<i class="icon-cloud-upload"></i>
								</a>
								<a class="btn btn-circle btn-icon-only green" href="javascript:;">
								<i class="icon-wrench"></i>
								</a>
								<a class="btn btn-circle btn-icon-only red" href="javascript:;">
								<i class="icon-trash"></i>
								</a> -->
								<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form id='save-form'  method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Maximum Per Item </label>
												<div class="col-md-9 ">
													<input type='text' id='item' value="<?php echo $param[0]['item_max'] ;?>" name="item" class="form-control ">
													<span class="help-block old_password"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Maximum Total</label>
												<div class="col-md-9 ">
													<input type='text' id='total' value="<?php echo $param[0]['total_max'] ;?>" name="total" class="form-control ">
													<span class="help-block old_password"></span>
												</div>
											</div>
										</div>
									</div>
                </div>
              </form>
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" onclick="create_user()" class="btn green">Submit</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
              </div>
              <!-- ./end form -->
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
<div class="page-footer-inner">
	 2014 &copy; Metronic by keenthemes.
</div>
<div class="scroll-to-top">
	<i class="icon-arrow-up"></i>
</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../survey/assets/global/plugins/respond.min.js"></script>
<script src="../../survey/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<?php $this->load->view('include/js');?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url().'assets/global/plugins/dropzone/dropzone.js'?>"></script>
<script src="<?php echo base_url().'assets/admin/pages/scripts/form-samples.js'?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
jQuery(document).ready(function() {
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
FormSamples.init();
// $('#sppr').removeClass('active open');
$('#bod-param').addClass('active open');
$('#param').parent().addClass('active');

var level_bod='<?php echo $_SESSION['level']; ?>';

if(level_bod=='bod'){
	$('.bod').addClass('hide');
	$('.unbod').removeClass('hide');
}

var item_max=$('#item');
var total_max=$('#total');

item_max.val(numeral(item_max.val()).format(0,0));
total_max.val(numeral(total_max.val()).format(0,0));


});
</script>

<script>
Metronic.startPageLoading({animate: true});
  $(document).ready(function(){
    Metronic.stopPageLoading();
  });
  function create_user(){
    Metronic.startPageLoading({animate: true});
    var formdata = new FormData($("#save-form")[0]);
    //  event.preventDefault();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
       $.ajax({
           url : '<?php echo site_url('/bod/save_param') ?>',
           type: "POST",
           data: formdata,
           processData: false,
           contentType: false,
           dataType: "JSON",
           success: function(data)
           {
             Metronic.stopPageLoading();
						 location.reload();
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
             Metronic.stopPageLoading();
               alert('Error adding / update data');
               $('#btnSave').text('save'); //change button text
               $('#btnSave').attr('disabled',false); //set button enable
           }
       });
         } //end ajax save

  function reset()
  {
    $('#add-form')[0].reset(); // reset form on modals
  }
</script>
<!-- END JAVASCRIPTS -->
<!-- END BODY -->
</html>
