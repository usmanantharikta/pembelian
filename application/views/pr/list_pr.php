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
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>List Outstanding PR</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<script src="<?php echo base_url().'assets/livecss.js'?>" type="text/javascript"></script>
<?php $this->load->view('include/css');?>
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url().'assets/global/plugins/dropzone/css/dropzone.css'?>" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'?>"/>
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
<body class="page-header-fixed page-quick-sidebar-over-content">
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
			<?php
			if(isset($_SESSION['username']) && $_SESSION['division']=='purchasing'){
				?>
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
				Project Management System | Module Pembelian <br><small> PT PRAKARSALANGGENG MAJUBERSAMA</small>
			</h3>
			<div class="page-bar">
			</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
			<div class="col-md-12 dkp-isian ">
				<!-- material -->
				<div class="portlet red-flamingo box full-height-content full-height-content-scrollable">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-shopping-cart"></i>List Outstanding PR
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<!-- <a href="javascript:;" class="remove"> -->
							<!-- </a> -->
						</div>
					</div>
					<div class="portlet-body" >
						<br>
						<br>
						<form id="form_bpmb" method="post" enctype="multipart/form-data" class="form-horizontal">
							  <div class="form-body">
									<table class="table table-striped table-bordered table-hover" id="table_material">
									 <thead>
												<tr>
													<th class="table-checkbox">Check</th>
														<th> ID PR</th>
														<th> DKP NO</th>
														<th> Kode Barang </th>
														<th> Nama Barang</th>
														<th> Material </th>
														<th> Delivery Time</th>
														<th> Qty Req</th>
												</tr>
										</thead>
										<tbody>
										</tbody>
								</table>
							</div>
				</form>
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-offset-5 col-md-6">
								<button id="submit-first" onclick="build_pr()" class="btn green">Create PO</button>
								<button type="button" onclick="cancel_ch()" class="btn default">Cancel</button>
							</div>
						</div>
					</div>
					<div class="col-md-6">
					</div>
				</div>
				<!-- button -->
				</div>
				</div>
				<!-- ./end masterial -->
				<div class="portlet blue box full-height-content full-height-content-scrollable hide">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file"></i>Action
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse">
							</a>
							<a href="javascript:;" class="remove">
							</a>
						</div>
					</div>
					<div class="portlet-body" >
						<div class="form-actions">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-offset-4 col-md-8">
											<button id="submit-all" onclick="sent()" type="submit" class="btn green">Submit</button>
											<button type="button" class="btn default">Cancel</button>
										</div>
									</div>
								</div>
								<div class="col-md-3"></div>
							</div>
						</div>
				</div>
				</div>
				<!-- /END ATTACHMENT -->

			</div>
				<!-- ./END OTHER -->
        <div class="col-md-12">
          <!-- BEGIN SAMPLE FORM PORTLET-->
          <!-- END SAMPLE FORM PORTLET-->
				<?php } else {
					echo "You dont have an Access to this page!!";
				}?>
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
<?php $this->load->view('include/footer');?>
<!-- END FOOTER -->
<!-- BEGIN Modal -->
<div id="material" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Material</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
					<form id="form-bpmb-final" method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="id_material">
						<input type="hidden" name="qty_requested">
						<div class="form-body">
							<!-- <h3 class="form-section">General Information</h3> -->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">PR NO</label>
										<div class="col-md-9">
											<input name="pr_no" type="text" class="form-control" placeholder="PR  NO">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6 ">
                  <div class="form-group">
                    <label class="control-label col-md-3">Tanggal Buat</label>
                    <div class="col-md-9">
                      <input name="create_date" type="text" class="form-control datepicker" placeholder="Tanggal">
                      <span class="help-block">
                       </span>
                    </div>
                  </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3">Project Name</label>
                    <div class="col-md-9">
                      <input name="name_proj" type="text" class="form-control" value="" placeholder="">
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-md-3">NO SPPr</label>
                    <div class="col-md-9">
                      <input name="no_sppr_bpmb" type="text" class="form-control" value="" placeholder="">
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
								<div class="col-md-6 hide">
									<div class="form-group">
										<label class="control-label col-md-3">ID DKP</label>
										<div class="col-md-9">
											<input name="dkp_id_bpmb" type="text" class="form-control" value="<?php echo $id_dkp;?>" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-6 ">
									<div class="form-group">
										<label class="control-label col-md-3">DKP NO</label>
										<div class="col-md-9">
											<input name="dkp_no" type="text" class="form-control" value="<?php echo $id_dkp;?>" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-6 ">
									<div class="form-group">
										<label class="control-label col-md-3">Title</label>
										<div class="col-md-9">
											<input name="nama_project" type="text" class="form-control" value="<?php echo $id_dkp;?>" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-6 hide">
									<div class="form-group">
										<label class="control-label col-md-3">ID Material</label>
										<div class="col-md-9">
											<input name="material_id" class="js-data-example-ajax form-control">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<table id="bpmb-tab" class="table table-striped table-bordered table-hover">
									 <thead>
												<tr>
														<th style="display: none"> asdas</th>
														<th> Id Material</th>
														<th> Komponen</th>
														<th> Nama Bahan</th>
														<th> Qty </th>
														<th> Tanggal Butuh </th>
														<th> Unit</th>
														<th> Keterangan </th>
												</tr>
										</thead>
										<tbody class="isi-table">

										</tbody>
								</table>
								</div>
						</div>
					</div>
			<!-- </div> -->
		</form>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" onclick="save_pr_final()" class="btn green">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- ./END MODAL -->
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
var flag=true;
var $table='';
var global_id_dkp='';
jQuery(document).ready(function() {

	//setup metronic
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	FormSamples.init();

	//active slide bar
	$('#pr').addClass('active open');
	$('#listopr').parent().addClass('active');

	//date datepicker
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
	});

	//dataTable material
		initial_table();

		$('#table_material').find('.group-checkable').change(function () {
				$('.checkboxes').parent().removeClass('checked');
				var set = jQuery(this).attr("data-set");
				var checked = jQuery(this).is(":checked");
				jQuery(set).each(function () {
						if (checked) {
								$(this).attr("checked", true);
								$(this).parents('tr').addClass("active");
						} else {
								$(this).attr("checked", false);
								$(this).parents('tr').removeClass("active");
								$('.checkboxes').parent().removeClass('checked');
						}
				});
				jQuery.uniform.update(set);
		});

		$('#table_material').on('change', 'tbody tr .checkboxes', function () {
				$(this).parents('tr').toggleClass("active");
		});
});

function cancel_ch()
{
	console.log("sdasdsa");
	//$('.checkboxes').attr('checked', true); // Unchecks it
	$('.checkboxes').attr("checked", false);
	$('.checkboxes').parents('tr').removeClass("active");
	$('.checkboxes').parents('span').removeClass("checked");
}

function initial_table()
{
	$('.dkp-isian').removeClass('hide');
	flag=false;
	$('.foot-form').addClass('hide');
		//dataTables material
	var url='<?php echo site_url().'pr/get_list_ots_pr/'?>';
		$table=$('#table_material').DataTable( {
			"bDestroy": true,
		"ajax":
		{
				"url": url,
				"type": "POST",
				"retrieve": true,
				keys: true,
		},
		"order": [[ 4, 'asc' ]],
		"columnDefs": [
			{ "orderable": false, "targets": 0 }
	//  {
	// 		 "targets": [ 1 ],
	// 		 "visible": false
	//  },
	//  {
	// 		 "targets": [ 2 ],
	// 		 "visible": false
	//  }
 ],
 "drawCallback": function( settings ) {
	 Metronic.init(); // init metronic core components

	 }
	});
}
</script>

<script>
	// build po ya, males rubah nama fungsi
	 function build_pr()
	 {
		 Metronic.startPageLoading({animate: true});
		 $('.isi-table').html('');
		 var formdata_ = new FormData($("#form_bpmb")[0]); //get data
		 $.ajax({
				 url : '<?php echo site_url().'pr/build_po'?>', //nih yang bener
				 type: "POST",
				 // data: {'id_item': id,'colom':colom, 'table': table},
				 data: formdata_,
				 processData: false,
				 contentType: false,
				 dataType: "JSON",
				 success: function(data)
				 {
					 if(data.status){
					 Metronic.stopPageLoading();
					 var url='<?php echo site_url().'po/edit_po/'?>';
					 // var win = window.open(url+data.id_po);
					 // win.focus();
					 window.location=url+data.id_po+'/draf';
				 	}
					else{
						Metronic.stopPageLoading();
						var message='';
						var id_po='';
						for (var i = 0; i < data.nama_bahan.length; i++) {
							message+=i+1+'. '+data.nama_bahan[i]+'<br>';
							id_po+=data.id_po[i]+'/';
						}
						bootbox.alert({
							title: '<p class="text-danger">Error</p>',
							message: 'PR dengan nama bahan : <b>'+message+' </b> sudah ada di draf, silahkan edit di Draf PO dengan ID PO: <b>'+id_po+'</b>',
						});
					}
				 },
				 error: function (jqXHR, textStatus, errorThrown)
				 {
					 Metronic.stopPageLoading();

						 alert('Error, Please select one');
						 $('#btnSave').text('save'); //change button text
						 $('#btnSave').attr('disabled',false); //set button enable
				 }
		 });
	 }

	 function save_pr_final()
	 {
		 $('#help-block').text('');
		 $('#help-block').parent().removeClass('has-error');
		 Metronic.startPageLoading({animate: true});
		  var id_bpmb=$('[name="bpmb_no"]').val();
		 if(id_bpmb==''){
			 Metronic.stopPageLoading();
			 bootbox.alert({
				 title: '<p class="text-danger">Error</p>',
				 message: 'Error BPMB NO cannot empty',
			 });
			 return;
		 }
		 // $('.isi-table').html('');
		 var formd = new FormData($("#form-bpmb-final")[0]); //get data
		 $.ajax({
				 url : '<?php echo site_url().'/ppc/save_pr_final'?>',
				 type: "POST",
				 // data: {'id_item': id,'colom':colom, 'table': table},
				 data: formd,
				 processData: false,
				 contentType: false,
				 dataType: "JSON",
				 success: function(data)
				 {
					 if(data.status)
					 {
						 Metronic.stopPageLoading();
						 $("#material").modal('hide');
						 initial_table($('[name="dkp_id_bpmb"]').val());
				 		}else{
							for (var i = 0; i < data.inputerror.length; i++) {
								$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
								$('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
							}
							Metronic.stopPageLoading();
				 		}
				 },
				 error: function (jqXHR, textStatus, errorThrown)
				 {
					 Metronic.stopPageLoading();

						 alert('Error, Please select one');
						 $('#btnSave').text('save'); //change button text
						 $('#btnSave').attr('disabled',false); //set button enable
				 }
		 });
	 }

</script>
