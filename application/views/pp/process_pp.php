$id_top<!-- this is use for functio create  -->
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
<title>Create TTBP</title>
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
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo site_url()?>">Purchasing</a>
						<i class="fa fa-circle"></i>
					</li>
					<li>
						<span>Create / Approve / View TTBP</span>
					</li>
				</ul>
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
                    <table class="table table-striped table-bordered table-hover" id="table_credit">
  									 <thead>
                       <tr>
                           <th> ID</th>
                           <th> PO NO</th>
                           <th> Type progress Payment</th>
                           <th> Persentase </th>
													 <th> Total</th>
                           <th> Nominal </th>
                           <th> Create BY</th>
                           <th> Create Date </th>
                           <!-- <th>Action</th> -->
                       </tr>
  										</thead>
  										<tbody>
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
								<i class="fa fa-shopping-cart"></i>Form TTBP
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
							<form id="form-pjum" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" name="id_sppr">
								<div class="form-body">
									<h3 class="form-section">General Information</h3>
									<div class="row">
										<div class="col-md-6 hide">
											<div class="form-group">
												<label class="control-label col-md-3">PO NO</label>
												<div class="col-md-9">
													<input name="po_id" type="text" value="<?php echo $id_po; ?>" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Credit ID</label>
												<div class="col-md-9">
													<input name="top_id" type="text" value="<?php echo $id_top; ?>" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Type</label>
												<div class="col-md-9">
													<input name="type_top" type="text" value="<?php echo $type ?>" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
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
												<label class="control-label col-md-3">Docs NO</label>
												<div class="col-md-9">
													<input name="doc_no" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date Docs</label>
												<div class="col-md-9">
													<input name="doc_date" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">No TTBP<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="ttbp_no" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date TTPB<span class="required" aria-required="true"> * </span></label>
												<div class="col-md-9">
													<input name="ttbp_date" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">NO Faktur Pajak</label>
												<div class="col-md-9">
													<input name="fp_no" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Date Faktur Pajak</label>
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
											<div class="form-group bpb_no">
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
													<span class="help-block bpb_no_span">
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
									<h3 class="form-section">Attachment</h3>
									<div class="row">
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
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">TTBP</label>
												<div class="col-md-9">
													<input name="ttbp[]" type="file" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">Dosc</label>
												<div class="col-md-9">
													<input name="doc[]" type="file" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
									</div>
									<h3 class="form-section">List Attachment</h3>
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
														$isi="'".$key."','".$value."'";
														echo '<tr> <td>'.$key.'</td>';
														echo '<td> <a download href="'.base_url().'uploads/pjum/'.$type.'/'.$id_top.'/'.$key.'/'.$value.'">'.$value.'</a></td>';
														echo '<td> <button type="button" class="btn btn-danger" onclick="delete_item('.$isi.')"> Delete</button> </td> </tr>';
													}
												}
											}
												?>
											</tbody>
										</table>
									</div>
									</div>
							</form>
							<!-- END FORM-->
						</div>
						<div class="modal-footer">
							<?php
							if(isset($status) && $status==sha1('approved'))
								{
							 ?>
						<?php
					}else{
						?>
						<button type="button" onclick="goBack()" class="btn default">Cancel</button>
						<button id="submit-first" type="button" onclick="save_bjum_master()" class="btn green">Save</button>
					<?php }?>
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
											if($_SESSION['level']=='kabag' && isset($status)){
												if($status==sha1('sent')){
											?>
											<button id="submit-first" type="button" onclick="approve()" class="btn green">Approve</button>
										<?php }
									} else{
										?>
											<button id="submit-all" onclick="sumbit_po()" type="submit" class="btn green">Submit</button>
											<?php } ?>
											<button type="button" onclick="goBack()" class="btn default">Cancel</button>
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
<!-- BEGIN Modal -->
<div id="detail-bpmb" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Purchase Request Detail</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
				<form id="form-approve_pr" method="post" enctype="multipart/form-data" class="form-horizontal">
					<input type="hidden" name="id_po_master">
					<div class="form-body">
						<!-- <h3 class="form-section">General Information</h3> -->
						<div class="row">
							<div class="col-md-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-4">Supp : </label>
                    <div class="col-md-8">
                      <p class="form-control-static d_nomer">
                        <b class="s_supplier_name"> </b>
                      </p>
                    </div>
                  </div>
                </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">C. NM : </label>
                  <div class="col-md-8">
                    <p class="form-control-static s_contact_name">
                      BPMB00001
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">Telp : </label>
                  <div class="col-md-8">
                    <p class="form-control-static s_telp">
                      BPMB00001
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">Fax : </label>
                  <div class="col-md-8">
                    <p class="form-control-static s_fax">
                      BPMB00001
                    </p>
                  </div>
                </div>
              </div>
              </div>
              <!-- end supp -->
							<div class="col-md-4">
								<div class="col-md-12">
                  <p class="a_alamat"></p>
                </div>
						</div>

            <!-- end alamat -->
            <div class="col-md-4">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">Tgl PO : </label>
                  <div class="col-md-8">
                    <p class="form-control-static m_date_po">
                      sadas
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">Tgl Kirim : </label>
                  <div class="col-md-8">
                    <p class="form-control-static m_date_sent">
                      sadas
                    </p>
                  </div>
                </div>
              </div>
            </div>

						<div class="col-md-12">
							<table  id="table-item" class="table table-striped table-bordered table-hover ">
							</table>
						</div>

            <div class="col-md-6">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4"> Total sblm PPN: </label>
                  <div class="col-md-8">
                    <p class="form-control-static tot_before">
                      sadas
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">PPN: </label>
                  <div class="col-md-8">
                    <p class="form-control-static m_ppn">
                      sadas
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">PPH: </label>
                  <div class="col-md-8">
                    <p class="form-control-static m_pph">
                      sadas
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label col-md-4">Total Akhir </label>
                  <div class="col-md-8">
                    <p class="form-control-static m_tot_after">
                      sadas
                    </p>
                  </div>
                </div>
              </div>
            </div>

					</div>
				</div>
				<!-- </div> -->
			</form>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
        <!-- <button type="button" onclick="cancel(0)" class="btn yellow btn-approve">Cancel</button> -->
				<?php if($_SESSION['level']=='kabag'){ ?>
				<!-- <button type="button" onclick="approve(0)" class="btn green btn-approve">Approve</button> -->
			<?php } ?>
			</div>
		</div>
	</div>
</div>
</div>
<!-- ./END MODAL -->
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
var step=true;
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
	var url='<?php echo site_url().'pjum/get_list_pp_by_id/'?>'+'<?php echo $id_top; ?>';
	var table=$('#table_credit').DataTable( {
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
	//  if(step){
	//  location.reload();
	//  step=false;
 // }
   update_total();
   var jumlah_bjum=$('.jumlah_bjum');
   jumlah_bjum.keyup(function(){
     update_total();
   });

   var jumlah_bum=$('[name="nominal_bum"]').val();
   $('[name="jumlah_bum"]').val(numeral(parseFloat(jumlah_bum)+(parseFloat(jumlah_bum)*10/100)).format('0,0.00'));

	}
});

}) //end document ready

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
		$('[name="jumlah_bum"]').val(numeral(total+(tot_bjum*10/100)).format('0,0.00'));
		$('[name="total"]').val(numeral(tot_bjum+(tot_bjum*10/100)).format('0,0.00')); //total bjum
    $('[name="selisih"]').val(total+(total*10/100)-(tot_bjum+(tot_bjum*10/100)));

}

function save_bjum_master()
{
	// save_po_detail();
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-pjum")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'pjum/save_pjum_pp/1'?>',
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
								// var url='<?php echo site_url().'po/list_po_approval/'?>';
								// window.location=url;
								location.reload();
							}
						});
				 }else{
					 for (var i = 0; i < data.inputerror.length; i++) {
						 $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						 $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						 if(data.inputerror[i]=='bpb_no'){
							 $('.bpb_no').addClass('has-error');
							 $('.bpb_no_span').text('Cannot Empty !!!');
						 }
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
	// save_bjum_master();
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-pjum")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/pjum/sent_pjum_pp'?>',
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
								var url='<?php echo site_url().'pjum/list_pjum_approval_pp/'?>';
								window.location=url;
							}
						});
				 }else{
					 var message='';
					 for (var i = 0; i < data.inputerror.length; i++) {
						 $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						 $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						 if(data.inputerror[i]=='bpb_no'){
							 $('.bpb_no').addClass('has-error');
							 $('.bpb_no_span').text('Cannot Empty !!!');
						 }
					 }
					 Metronic.stopPageLoading();
					 bootbox.alert({
						 title: '<p class="text-error">Error</p>',
						 message: 'Please Complete the form !!!!<br>'+message,
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

function show_po(id_po_master)
{
	Metronic.startPageLoading({animate: true});
	console.log('PO NO: '+id_po_master);
	$.ajax({
			url : '<?php echo site_url().'po/view_po/'?>'+id_po_master,
			type: "POST",
			// data: {'pr_no': pr_no},
			// processData: false,
			// contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				var table=$('#table-item').dataTable( {
					"bDestroy": true,
					data: data.table,
					columns: [
						{ title: "NO" },
						{ title: "Nama Barang" },
						{ title: "Qty Buy" },
            { title: "Stn Buy" },
						{ title: "Qty PO" },
            { title: "Stn PO" },
						{ title: "HGS" },
            { title: "Last HGS" },
            { title: "Disc" },
						{ title: "Tot Price (Rp)" },
					],
					"dom": 'tr'
				});

        $('.modal-title').text('PO NO : '+data.master.po_no);
        $('.s_supplier_name').text(data.supplier.supplier_name)
        $('.s_contact_name').text(data.supplier.contact_name);
        $('.s_telp').text(data.supplier.telp);
        $('.s_fax').text(data.supplier.fax);

        $('.a_alamat').text(data.alamat);

        $('.m_date_po').text(data.master.date_po);
        $('.m_date_sent').text(data.master.date_sent);

        $('.tot_before').text(data.tot_harga);
        $('.m_ppn').text(data.master.ppn);
        $('.m_tot_after').text(data.master.total);
        $('.m_pph').text(data.master.pph);

        $('[name="id_po_master"]').val(data.master.id_po_master);


        //
				// var col=['nomer', 'sppr-no', 'project', 'title'];
				// for (var i = 0; i < col.length; i++) {
				// 	$(".d_"+col[i]).text(data.detail[i]);
				// }
				// $('[name="pr_no"]').val(data.detail[0]);
				$("#detail-bpmb").modal('show');
        // if(data.detail[data.detail.length-1]=='cancel')
        // {
        //   $(".btn-approve").hide();
        // }
 				Metronic.stopPageLoading();
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

function get_data(){
	Metronic.startPageLoading({animate: true});
	var url='<?php echo site_url().'/pjum/get_data_pjum_pp/'?>'+"<?php echo $id_top;?>";
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
				var col=['doc_no', 'doc_date', 'invoice_no', 'invoice_date', 'sj_no', 'sj_date', 'fp_no', 'fp_date', 'ttbp_no', 'ttbp_date'];

				for (var i = 0; i < col.length; i++) {
					$('[name="'+col[i]+'"]').val(data[i]);
				}

				$('.js-example-basic-multiple').val(data[data.length-1]).trigger('change');
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

function delete_item(folder, file){
	var id_top=$('[name="top_id"]').val();
	console.log(id_top+' allala');
	$.ajax({
			url : '<?php echo site_url().'/pjum/delete_pjum'?>',
			type: "POST",
			data: {'id': id_top, 'type':'<?php if(isset($type)) echo $type; ?>', 'folder':folder, 'file': file},
			// data: fo,
			// processData: false,
			// contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status){
					location.reload();
				}else {
					Metronic.stopPageLoading();
					bootbox.alert({
						title: '<p class="text-error">Error</p>',
						message: 'Error Delete !!!!<br>',
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

function approve()
{
	bootbox.confirm({
		message: "Are you sure want approve BPMB with id ?",
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
					var url='<?php echo site_url().'/pjum/approve_pjum_pp/'?>'+'<?php if(isset($status)) echo $id_pjum ?>';
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
								bootbox.alert({
									title: '<p class="text-success">success</p>',
									message: 'Well Done !!!!',
									callback: function(){
										var url='<?php echo site_url().'pjum/list_pjum_approved_pp/'?>';
										window.location=url;
									}
								});
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
