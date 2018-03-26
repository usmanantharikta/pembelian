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
<title>List PJUM Approved</title>
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
	<?php
	if($_SESSION['division']=='purchasing'){
		$this->load->view('include/slidebar');
	}else{
		$this->load->view('include/slidebar_keuangan');
	}
	?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<?php
			if((isset($_SESSION['username']) && $_SESSION['division']=='purchasing')||(isset($_SESSION['username']) && $_SESSION['division']=='keuangan')){
				?>
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
				Project Management System | Module Pembelian <br><small> PT PRAKARSALANGGENG MAJUBERSAMA</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo site_url().'pembelian';?>">Purchasing</a>
						<i class="fa fa-circle"></i>
					</li>
					<li>
						<span>processing COD</span>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
			<div class="col-md-12 dkp-isian ">
				<!-- material -->
				<div class="portlet red-flamingo box full-height-content full-height-content-scrollable">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-shopping-cart"></i>Process COD / Dana Taktis
						</div>
						<div class="tools">
							<!-- <a href="javascript:;" class="collapse">
							</a> -->
							<!-- <a href="javascript:;" class="remove"> -->
							<!-- </a> -->
						</div>
					</div>
					<div class="portlet-body" >
						<form id="form_cod" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="form-body">
								<!-- <h3 class="form-section">General Information</h3> -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">PJUM NO<span class="required" aria-required="true"> * </span></label>
											<div class="col-md-9">
												<input name="roll_no" type="text" value="<?php echo $roll_no; ?> " class="form-control" placeholder="Roll COD NO">
												<span class="help-block">
												 </span>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
	                  <div class="form-group">
	                    <label class="control-label col-md-3">Tanggal Buat<span class="required" aria-required="true"> * </span></label>
	                    <div class="col-md-9">
	                      <input name="roll_date" type="text" value="<?php echo date('Y-m-d'); ?>"class="form-control datepicker" placeholder="Tanggal">
	                      <span class="help-block">
	                       </span>
	                    </div>
	                  </div>
	                </div>
	                <!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label col-md-3">Total<span class="required" aria-required="true"> * </span></label>
											<div class="col-md-9">
												<input name="roll_total" type="text" value="<?php echo number_format($total, 2, '.', ',') ?>"class="form-control" placeholder="Tanggal">
												<span class="help-block">
												 </span>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 hide">
										<div class="form-group">
											<label class="control-label col-md-3">ID </label>
											<div class="col-md-9">
												<input name="roll_ids" type="text" value="<?php echo $id_cod ?>"class="form-control" placeholder="Tanggal">
												<span class="help-block">
												 </span>
											</div>
										</div>
									</div>
									<!--/span-->
									<div class="col-md-6 ">
										<div class="form-group">
											<label class="control-label col-md-3">Create By </label>
											<div class="col-md-9">
												<input disabled name="create_by" type="text" value="<?php echo $_SESSION['nik']; ?>"class="form-control datepicker" placeholder="Tanggal">
												<span class="help-block">
												 </span>
											</div>
										</div>
									</div>
									<!--/span-->
								</div>
							</div>
						<br>
						<br>
							  <div class="form-body">
									<table class="table table-striped table-bordered table-hover" id="table_cod">
									 <thead>
												<tr>
													<!-- <th class="table-checkbox">Check</th> -->
														<th> Id COD</th>
														<th> PO NO</th>
														<th> supplier Name</th>
														<th> Nominal </th>
														<th> Create BY</th>
														<th> Create Date </th>
														<th> Action</th>
												</tr>
										</thead>
										<tbody>
											<?php
											for ($i=0; $i < count($table) ; $i++) {
												echo '<tr>';
												for ($j=0; $j < count($table[$i]); $j++) {
													echo '<td>'.$table[$i][$j].'</td>';
												}
												echo '</tr>';
											}
											 ?>
										</tbody>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" onclick="goBack()" class="btn default">Cancel</button>
								<?php
								if(isset($id_roll)){
									if($stat!='approved'){
									echo '<button type="button" onclick="approve('.$id_roll.')" class="btn green">Approve</button>';
									}
								}else {
								?>
								<button type="button" onclick="build_cod()" class="btn green">Save</button>
							<?php } ?>
							</div>
				</form>
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
<?php $this->load->view('po/modal_po'); ?>
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
	// $('#cod').addClass('active open');
	// $('#list_cod').parent().addClass('active');

	//date datepicker
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
	});

	//dataTable material
		initial_table();

		$('#table_cod').find('.group-checkable').change(function () {
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

		$('#table_cod').on('change', 'tbody tr .checkboxes', function () {
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
	var url='<?php echo site_url().'bum/get_list_cod_p/'?>';
		$table=$('#table_cod').DataTable( {
			 "dom": 'rti'
		// 	"bDestroy": true,
		// "ajax":
		// {
		// 		"url": url,
		// 		"type": "POST",
		// 		"retrieve": true,
		// 		keys: true,
		// },
		// "order": [[ 4, 'asc' ]],
	// 	"columnDefs": [
	//  {
	// 		 "targets": [ 1 ],
	// 		 "visible": false
	//  },
	//  {
	// 		 "targets": [ 2 ],
	// 		 "visible": false
	//  }
 // ],
 // "drawCallback": function( settings ) {
	//  Metronic.init(); // init metronic core components
 //
	//  }
	});
}

// function show_po(id_po_master)
// {
// 	Metronic.startPageLoading({animate: true});
// 	console.log('PO NO: '+id_po_master);
// 	$.ajax({
// 			url : '<?php echo site_url().'po/view_po/'?>'+id_po_master,
// 			type: "POST",
// 			// data: {'pr_no': pr_no},
// 			// processData: false,
// 			// contentType: false,
// 			dataType: "JSON",
// 			success: function(data)
// 			{
// 				var table=$('#table-item').dataTable( {
// 					"bDestroy": true,
// 					data: data.table,
// 					columns: [
// 						{ title: "NO" },
// 						{ title: "Nama Barang" },
// 						{ title: "Qty Buy" },
//             { title: "Stn Buy" },
// 						{ title: "Qty PO" },
//             { title: "Stn PO" },
// 						{ title: "HGS" },
//             { title: "Last HGS" },
//             { title: "Disc" },
// 						{ title: "Tot Price (Rp)" },
// 					],
// 					"dom": 'tr'
// 				});
//
//         $('.modal-title').text('PO NO : '+data.master.po_no);
//         $('.s_supplier_name').text(data.supplier.supplier_name)
//         $('.s_contact_name').text(data.supplier.contact_name);
//         $('.s_telp').text(data.supplier.telp);
//         $('.s_fax').text(data.supplier.fax);
//
//         $('.a_alamat').text(data.alamat);
//
//         $('.m_date_po').text(data.master.date_po);
//         $('.m_date_sent').text(data.master.date_sent);
//
//         $('.tot_before').text(data.tot_harga);
//         $('.m_ppn').text(data.master.ppn);
//         $('.m_tot_after').text(data.master.total);
//         $('.m_pph').text(data.master.pph);
//
//         $('[name="id_po_master"]').val(data.master.id_po_master);
//
//
//         //
// 				// var col=['nomer', 'sppr-no', 'project', 'title'];
// 				// for (var i = 0; i < col.length; i++) {
// 				// 	$(".d_"+col[i]).text(data.detail[i]);
// 				// }
// 				// $('[name="pr_no"]').val(data.detail[0]);
// 				$("#detail-bpmb").modal('show');
//         // if(data.detail[data.detail.length-1]=='cancel')
//         // {
//         //   $(".btn-approve").hide();
//         // }
//  				Metronic.stopPageLoading();
// 			},
// 			error: function (jqXHR, textStatus, errorThrown)
// 			{
// 	 			Metronic.stopPageLoading();
// 					bootbox.alert({
// 						title: '<p class="text-danger">Error</p>',
// 						message: 'Error adding / update data',
// 					});
// 			}
// 	});
// }

// build po ya, males rubah nama fungsi
 function build_cod()
 {
	 if($('[name="roll_no"]').val()=='' || $('[name="roll_no"]').val()==0){
		 alert('Roll COD NO cannot ampty or 0');
		 return;
	 }
	 Metronic.startPageLoading({animate: true});
	 $('.isi-table').html('');
	 var formdata_ = new FormData($("#form_cod")[0]); //get data
	 $.ajax({
			 url : '<?php echo site_url().'bum/save_process_cod'?>', //nih yang bener
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
				 var url='<?php echo site_url().'bum/list_p_cod'?>';
				 // var win = window.open(url+data.id_po);
				 // win.focus();
				 window.location=url;
				}
				else{
					Metronic.stopPageLoading();
					bootbox.alert({
						title: '<p class="text-danger">Error</p>',
						message: 'Select One',
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

 //approve
 function approve(id){
	 bootbox.confirm({
		 message: "Are you sure want Acknowledge this ?",
		 buttons: {
				 confirm: {
						 label: 'Yes',
						 className: 'btn-success'
				 },
				 cancel: {
						 label: 'No',
						 className: 'btn-danger'
				 }
		 },
		 callback: function (result) {
				 if(result){
					 Metronic.startPageLoading({animate: true});
					 var url='<?php echo site_url().'/bum/approve_cod/'?>'+id;
					 // var url='<?php echo site_url().'/po/approve_bum/'?>'+id_po_master;
					 $.ajax({
							 url : url,
							 type: "POST",
							 // data: {'id_bpmb': id_bpmb},
							 processData: false,
							 contentType: false,
							 dataType: "JSON",
							 success: function(data)
							 {
								 Metronic.stopPageLoading();
									$('#table_cod').DataTable().ajax.reload(null, false);
							 },
							 error: function (jqXHR, textStatus, errorThrown)
							 {
								 Metronic.stopPageLoading();
									 bootbox.alert({
										 title: '<p class="text-danger">Error</p>',
										 message: 'Error adding / update data',
									 });
							 }
					 });
				 }
		 }
	 });
 }


</script>
