<!-- this is use for functio create  -->
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
<title>Create PR</title>
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
<body class="page-header-fixed page-quick-sidebar-over-content  page-sidebar-closed">
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
			if((isset($_SESSION['username']) && $_SESSION['division']=='purchasing')||(isset($_SESSION['username']) && $_SESSION['division']=='keuangan') ){
				?>
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
				Project Management System | Module Pembelian <br><br><small> PT PRAKARSALANGGENG MAJUBERSAMA</small>
			</h3>
			<div class="page-bar">
			</div>
			<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- material -->
					<div class="portlet red-flamingo box full-height-content full-height-content-scrollable">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-flask"></i>Item List
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body" >
							<br>
							<br>
							<form id="form_po_det" method="post" enctype="multipart/form-data" class="form-horizontal">
									<div class="form-body">
										<table class="table table-striped table-bordered table-hover" id="table_material">
										 <thead>
													<tr>
														<!-- <th> Id PR</th> -->
														<!-- <th> Action </th> -->
														<th> PO NO</th>
														<th> BUM NO </th>
														<th> Nama Barang</th>
														<th> Merek </th>
														<th> Qty PO</th>
														<th> Stn</th>
														<th> HGS</th>
														<th> Disc % </th>
														<th> Jumlah</th>
														<th> Tanggal </th>
														<th> Jumlah </th>
														<th> Keterangan </th>
                            <th> No Perkiraan </th>
													</tr>
											</thead>
											<tbody>
												<?php
												// for ($i=0; $i < count($table); $i++) {
												// 	echo '<tr>';
												// 	for ($j=0; $j < count($table[$i]); $j++) {
												// 		echo "<td>".$table[$i][$j]."</td>";
												// 	}
												// 	echo '</tr>';
												// }
												?>
											</tbody>
									</table>
								</div>
								<div class="modal-footer hide">
									<button type="button" data-dismiss="modal" class="btn default">Close</button>
									<button type="button" onclick="save_po_detail()" class="btn green">Save</button>
								</div>
					</form>
					</div>
					</div>
					<!-- ./end masterial -->
				</div>
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet green-jungle box full-height-content full-height-content-scrollable">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-shopping-cart"></i>Form PO
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form id="form-bjum" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" name="id_sppr">
                <div class="form-body">
                  <h3 class="form-section">General Information</h3>
                  <div class="row">
                    <div class="form-group hide">
                      <label class="control-label col-md-3">ID PO</label>
                      <div class="col-md-9">
                        <input value="<?php echo $id_po ?>" name="id_po" type="text" class="form-control" placeholder="PO No">
                        <span class="help-block">
                        </span>
                      </div>
                    </div>
                    <div class="form-group hide">
                      <label class="control-label col-md-3">ID BUM</label>
                      <div class="col-md-9">
                        <input value="<?php echo $id_bum ?>" name="id_bum" type="text" class="form-control" placeholder="PO No">
                        <span class="help-block">
                        </span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">BUM NO<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-9">
                          <input name="bum_no" type="text" value="<?php echo $bum_no;?>" class="form-control" placeholder="">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
											<div class="form-group">
												<label class="control-label col-md-3">Nama<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="nama" type="text" value="<?php echo $_SESSION['username'] ;?>" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Divisi/Bagian<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="bagian" type="text" value="<?php echo $_SESSION['division'] ;?>" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
                    </div>
										<!-- /span -->

                    <div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">Jumlah BUM<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="jumlah_bum" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Jumlah PJUM<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="total" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Kelebihan / Kekurangan <span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="selisih" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
                    </div>
                  </div>
									<h3 class="form-section">Additional Data</h3>
									<div class="row">
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">No Invoice<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="invoice_no" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date Invoice<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="invoice_date" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">NO Faktur Pajak<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="fp_no" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date Faktur Pajak<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="fp_date" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">Surat Jalan</label>
												<div class="col-md-9">
													<input name="sj_no" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date Surat Jalan</label>
												<div class="col-md-9">
													<input name="sj_date" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">Doc Lain No</label>
												<div class="col-md-9">
													<input name="doc_no" type="text" value="" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date Doc Lain</label>
												<div class="col-md-9">
													<input name="doc_date" type="text" value="" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">BPB NO<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<select name="bpb_no[]" class="form-control js-example-basic-multiple" multiple="multiple">
														<?php
														if(isset($bpb_no)){
															// var_dump($bpb_no);
															for($i=0; $i<count($bpb_no); $i++) {
																echo '<option value="'.$bpb_no[$i]['no_bpb'].'">'.$bpb_no[$i]['no_bpb'].'</option>';
															}
														}
														?>
													</select>
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group hide">
												<label class="control-label col-md-3">Date BPB</label>
												<div class="col-md-9">
													<input name="bpb_date" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
									</div>
                  <!--/row-->
                  <h3 class="form-section">Attachment</h3>
									<div class="row">
										<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Attachment</th>
													<th>Nama File</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if(isset($files)){
												for ($i=0; $i < count($files) ; $i++) {
													foreach ($files[$i] as $key => $value) {
														echo '<tr> <td>'.$key.'</td>';
														echo '<td> <a download href="'.base_url().'uploads/bjum/'.$_SESSION['id_bjum'].'/'.$key.'/'.$value.'">'.$value.'</a></td>';
														echo '<td> <button class="btn btn-danger">Delete</button> </td> </tr>';
													}
												}
											}
												?>
											</tbody>
										</table>
									</div>
									</div>
                  <div class="row hide">
										<?php
										if(isset($files)){
										for ($i=0; $i < count($files) ; $i++) {
											foreach ($files[$i] as $key => $value) {
										?>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3"><?php echo $key ?></label>
												<div class="col-md-9">
													<a download href="<?php echo base_url().'uploads/bjum/'.$_SESSION['id_bjum'].'/'.$key.'/'.$value; ?>"><?php echo $value ;?></a>
												</div>
											</div>
										</div>
										<?php
											}
										}
									}
										 ?>
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label class="control-label col-md-3">Invoice</label>
                        <div class="col-md-9">
                          <input name="invoice[]" type="file" class="form-control" placeholder="">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label class="control-label col-md-3">Faktur Pajak</label>
                        <div class="col-md-9">
                          <input name="fp[]" type="file" class="form-control" placeholder="">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label class="control-label col-md-3">Surat Jalan</label>
                        <div class="col-md-9">
                          <input name="sj[]" type="file" class="form-control" placeholder="">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="form-actions foot-form hide">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-9">
													<button id="submit-first" type="button" onclick="save_po_master()" class="btn green">Save</button>
                          <button type="button" class="btn default">Cancel</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                  </div>
                </div>
              </form>
              <!-- END FORM-->
						</div>
						<div class="modal-footer hide">
							<button type="button" onclick="goBack()" class="btn default">Cancel</button>
							<button id="submit-first" type="button" onclick="save_bjum_master()" class="btn green">Save</button>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
			<div class="col-md-12 dkp-isian">
				<div class="portlet blue box full-height-content full-height-content-scrollable ">
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
											<?php
											if($status==sha1('sent')){
											?>
											<button id="submit-all" onclick="approve_bjum()" type="submit" class="btn green">Approve</button>
										<?php }
										if($_SESSION['division']=='purchasing'){?>
											<button type="button" onclick="goBack()" class="btn default">Cancel</button>
										<?php } else{
											echo '<button type="button" onclick="goBack()" class="btn default">BACK</button>';
										}?>
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
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../survey/assets/global/plugins/respond.min.js"></script>
<script src="../../survey/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<?php $this->load->view('include/js');?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url().'assets/global/plugins/dropzone/dropzone.js'?>"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- <script src="<?php echo base_url().'assets/global/plugins/jquery-ui/jquery-ui.min.js'?>" type="text/javascript"></script> -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- <script src="<?php echo base_url().'assets/global/scripts/app.min.js'?>" type="text/javascript"></script> -->
<script src="<?php echo base_url().'assets/admin/pages/scripts/ui-modals.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/admin/pages/scripts/form-samples.js'?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>

// var UIModals=function(){var n=function(){$("#draggable").draggable({handle:".modal-header"})};return{init:function(){n()}}}();jQuery(document).ready(function(){UIModals.init()});
var array_jumlah={firstName:0};
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
	$('#createPR').addClass('active');

	//date datepicker
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
	});

	$('[name="persentase"]').keyup(function(){
		var per=$('[name="persentase"]').val();
		var nc=$('[name="nominal"]').val();
		var nc_fin=numeral(nc).value();
		console.log(nc_fin + 'sds'+parseFloat(per));

		$('[name="nominal_dp"]').val(nc_fin*parseFloat(per)/100);
	});
  // $(document).ready(function() {
  //   $('#table_material').DataTable( {
  //       "order": [[ 4, "asc" ]]
  //   } );
  // } );


	//select 2==2
	$('.js-example-basic-multiple').select2();

	//get data pjum
	get_data();

	var sc=$("[name='supplier_code']"); //supplier_code
	sc.change(function(){
		var supp=$(this).val();
		var arr_supp=supp.split("%");
		var col=['code_supplier','nama_supplier', 'contact_name', 'telp', 'fax'];
		for (var i = 0; i < col.length; i++) {
			$('[name="'+col[i]+'"]').val(arr_supp[i]);
		}
	})

  var id_po=$("[name='id_po']").val();
	var id_bum=$("[name='id_bum']").val();
	var url='<?php echo site_url().'bum/get_list_material_po/'?>'+id_po+'/'+id_bum;
	var table=$('#table_material').DataTable( {
		"bDestroy": true,
		"ajax":
		{
				"url": url,
				"type": "POST",
				"retrieve": true,
				keys: true,
		},
		"order": [[ 2, 'asc' ]],
		"columnDefs": [
			// { "width": "25%", "targets": 2 },
	 // {
		// 	 "targets": [ 0 ],
		// 	 "visible": false
	 // },
 ],
 "drawCallback": function( settings ) {
	 // location.reload();
   update_total();
   var jumlah_bjum=$('.jumlah_bjum');
   jumlah_bjum.keyup(function(){
     update_total();
   });

   var jumlah_bum=$('[name="nominal_bum"]').val();
   $('[name="jumlah_bum"]').val(numeral(jumlah_bum).format('0,0.00'));

	}
});



}); //end document ready

function update_total()
{
		var total=0;
		var tot_bjum=0;;
		$('#table_material tr').each(function(){
				var num=$(this).find('.jumlah').val();
				var num_bjum=$(this).find('.jumlah_bjum').val();
				if(typeof num !== 'undefined'){
				total=total+parseFloat(num);
				}
				if(typeof num_bjum !== 'undefined'){
					tot_bjum=tot_bjum+parseFloat(num_bjum);
				}
		});
		$('[name="total_bt"]').val(numeral(total).format('0,0.00'));
		$('[name="total"]').val(numeral(tot_bjum+(tot_bjum*10/100)).format('0,0.00'));
    $('[name="selisih"]').val(total+(total*10/100)-(tot_bjum+(tot_bjum*10/100)));

}

function save_po_detail()
{
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form_po_det")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'bum/save_po_detail_ex'?>',
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
					$('#table_material').DataTable().ajax.reload(null, false);
					Metronic.stopPageLoading();
					$("#draggable").modal('hide');
					$('[name="total_paten"]').val(data.total);
					var ppnn=parseFloat($('[name="ppn"]').val());
					$('[name="total"]').val(parseFloat(ppnn+parseFloat($('[name="total_paten"]').val())));
					bootbox.alert({
						title: '<p class="text-success">success</p>',
						message: 'Well Done !!!!',
					});
				 }else{
					 for (var i = 0; i < data.inputerror.length; i++) {
						 $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						 $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
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


function save_bjum_master()
{
	// save_po_detail();
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-bjum")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'bum/save_bjum'?>',
			type: "POST",
			// data: {'id_item': id,'colom':colom, 'table': table},
			data: formd,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				console.log(data);
				if(data.status)
				{
					Metronic.stopPageLoading();
					$("#draggable").modal('hide');
					// alert('success');
						bootbox.alert({
							title: '<p class="text-success">success</p>',
							message: 'Well Done !!!!',
							// callback: function(){
							// 	var url='<?php echo site_url().'po/list_po_approval/'?>';
							// 	window.location=url;
							// }
						});
				 }else{
					 for (var i = 0; i < data.inputerror.length; i++) {
						 $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						 $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
					 }
					 Metronic.stopPageLoading();
					 bootbox.alert({
						 title: '<p class="text-error">Error</p>',
						 message: 'Please Complete the form !!!!',
					 });
				 }
			},
			// complete: function(data){
			// 	bootbox.alert({
			// 		title: '<p class="text-success">success</p>',
			// 		message: 'Well Done !!!!',
			// 	});
			// 	var url='<?php echo site_url().'po/list_po_approval/'?>';
			// 	window.location=url;
			// },
			error: function (jqXHR, textStatus, errorThrown)
			{
				Metronic.stopPageLoading();

					alert('Error, Please select one');
					$('#btnSave').text('save'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable
			}
	});
}

function sumbit_po()
{
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-bjum")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/bum/sent_bjum'?>',
			type: "POST",
			// data: {'id_item': id,'colom':colom, 'table': table},
			data: formd,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				console.log(data);
				if(data.status)
				{
					Metronic.stopPageLoading();
					$("#draggable").modal('hide');
					// alert('success');
						bootbox.alert({
							title: '<p class="text-success">success</p>',
							message: 'Well Done !!!!',
							callback: function(){
								var url='<?php echo site_url().'bum/list_bjum_approval/'?>';
								window.location=url;
							}
						});
				 }else{
					 for (var i = 0; i < data.inputerror.length; i++) {
						 $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						 $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
					 }
					 Metronic.stopPageLoading();
					 bootbox.alert({
						 title: '<p class="text-error">Error</p>',
						 message: 'Please Complete the form !!!!',
					 });
				 }
			},
			// complete: function(data){
			// 	bootbox.alert({
			// 		title: '<p class="text-success">success</p>',
			// 		message: 'Well Done !!!!',
			// 	});
			// 	var url='<?php echo site_url().'po/list_po_approval/'?>';
			// 	window.location=url;
			// },
			error: function (jqXHR, textStatus, errorThrown)
			{
				Metronic.stopPageLoading();

					alert('Error, Please select one');
					$('#btnSave').text('save'); //change button text
					$('#btnSave').attr('disabled',false); //set button enable
			}
	});
}

function approve_bjum()
{
  // if(id_pjum==0){
  //   id_pjum=$('[name="id_bjum"]').val();
  // }
	bootbox.confirm({
		message: "Are you sure want approv ?",
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
					var url='<?php echo site_url().'/bum/approve_bjum/'?>'+"<?php echo $id_bjum;?>";
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
								goBack();
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

function get_data(){
	Metronic.startPageLoading({animate: true});
	var url='<?php echo site_url().'/bum/get_data_bjum/'?>'+"<?php echo $id_bjum;?>";
	$.ajax({
			url : url,
			type: "POST",
			// data: {'id_bpmb': id_bpmb},
			// processData: false,
			// contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				Metronic.stopPageLoading();
				var col=['invoice_no', 'invoice_date', 'sj_no', 'sj_date', 'fp_no', 'fp_date', 'doc_no', 'doc_date'];

				for (var i = 0; i < col.length; i++) {
					$('[name="'+col[i]+'"]').val(data[i]);
				}

				$('.js-example-basic-multiple').val(data[8]).trigger('change');
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


</script>
