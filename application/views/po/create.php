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
				Project Management System<br><small> PT PRAKARSALANGGENG MAJUBERSAMA</small>
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
								<span class="caption-subject bold uppercase">CREATE PURCHASE ORDER </span>
							</div>
							<div class="actions">
								<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
								</a>
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
              <!-- BEGIN FORM-->
              <form id="form-po" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" name="id_sppr">
                <div class="form-body">
                  <h3 class="form-section">General Information</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Kode Supplier</label>
                        <div class="col-md-9">
                          <select id="id_dkp_master" name="supplier_code" class="form-control select2" id="form_control_1">
														<option value=""> Select One </option>
														<?php
                            foreach ($supplier as $key) {
                              echo "<option value='".$key['value']."'>".$key['text']."</option>";
                            }
                            ?>
                          </select>
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    <!--/span-->
										<div class="form-group">
											<label class="control-label col-md-3">Kode Supplier</label>
											<div class="col-md-9">
												<input name="code_supplier" type="text" class="form-control" placeholder="Name Customer">
												<span class="help-block">
											</span>
											</div>
										</div>
									<!-- /span -->
                      <div class="form-group">
                        <label class="control-label col-md-3">Nama Supplier</label>
                        <div class="col-md-9">
                          <input name="nama_supplier" type="text" class="form-control" placeholder="Name Customer">
                          <span class="help-block">
                        </span>
                        </div>
                      </div>
                    <!-- /span -->
                      <div class="form-group">
                        <label class="control-label col-md-3">Contact Name</label>
                        <div class="col-md-9">
                          <input name="contact_name" type="text" class="form-control" placeholder="PO No.">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    <!--/span-->
                      <div class="form-group">
                        <label class="control-label col-md-3">Telp </label>
                        <div class="col-md-9">
                          <input name="telp" type="text" class="form-control" placeholder="dd/mm/yyyy">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    <!--/span-->
                      <div class="form-group">
                        <label class="control-label col-md-3">Fax</label>
                        <div class="col-md-9">
                          <input name="fax" type="text" class="form-control" placeholder="Contact No">
                          <span class="help-block">
                          </span>
                        </div>
                      </div>
                    </div>
										<!-- /span -->

                    <div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">ID PO</label>
												<div class="col-md-9">
													<input value="<?php echo $id_po ?>" name="id_po" type="text" class="form-control" placeholder="PO No">
													<span class="help-block">
													</span>
												</div>
											</div>
										<!--/span-->
											<div class="form-group">
												<label class="control-label col-md-3">Import</label>
												<div class="col-md-9">
													<input type="checkbox" name="import" value="1" class="checkboxes">
													<span class="help-block">
													</span>
												</div>
											</div>
										<!--/span-->
                      <div class="form-group">
                        <label class="control-label col-md-3">PO NO</label>
                        <div class="col-md-9">
                          <input value="" name="po_no" type="text" class="form-control" placeholder="PO No">
                          <span class="help-block">
                          </span>
                        </div>
                      </div>
                    <!--/span-->
                      <div class="form-group">
                        <label class="control-label col-md-3">Po Tanggal</label>
                        <div class="col-md-9">
                          <input name="date_po" type="text" class="form-control datepicker" placeholder="Tanggal">
                          <span class="help-block">
                           </span>
                        </div>
                      </div>
                    <!--/span-->
                      <div class="form-group">
                        <label class="control-label col-md-3">Alamat Kirim</label>
                        <div class="col-md-9">
                          <select id="id_dkp_master" name="id_alamat" class="form-control select2" id="form_control_1">
														<option value="" >Select One </option>
														<?php
														foreach ($address as $key) {
															echo "<option value='".$key['value']."'>".$key['text']."</option>";
														}
														?>
                          </select>
                          <span class="help-block">
                          </span>
                        </div>
                      </div>
											<!--/span-->
                    </div>

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Cur. ID</label>
												<div class="col-md-9">
													<select name="cur_id" class="form-control select2" id="form_control_1">
														<option value="" >Select One </option>
														<?php
														foreach ($currency as $key) {
															echo "<option value='".$key['value']."'>".$key['text']."</option>";
														}
														?>
                          </select>
													<span class="help-block">
													 </span>
												</div>
											</div>
										<!--/span-->
											<div class="form-group">
												<label class="control-label col-md-3">Tgl Kirim</label>
												<div class="col-md-9">
													<input name="date_sent" type="text" class="form-control datepicker" placeholder="">
													<span class="help-block">
													</span>
												</div>
											</div>
										</div>
                  </div>
                  <!--/row-->
              <h3 class="form-section">Addition Information</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">PPN</label>
										<div class="col-md-9">
											<input name="ppn" type="text" value="0" class="form-control" placeholder="">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Total</label>
									<div class="col-md-9">
										<input name="total" type="text" class="form-control" placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
							</div>
							<div class="col-md-6 hide">
							<div class="form-group">
								<label class="control-label col-md-3">Total HIde</label>
								<div class="col-md-9">
									<input name="total_paten" type="text" class="form-control" placeholder="">
									<span class="help-block">
									 </span>
								</div>
							</div>
						</div>
						<!--/span-->
							<!--/span-->
							<div class="col-md-6 import hide">
								<div class="form-group">
									<label class="control-label col-md-3">Reference</label>
									<div class="col-md-9">
										<input name="reference" type="text" class="form-control import" placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<div class="form-group">
									<label class="control-label col-md-3">ETD</label>
									<div class="col-md-9">
										<input name="etd" type="text" class="form-control import" placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<div class="form-group">
									<label class="control-label col-md-3">ETA</label>
									<div class="col-md-9">
										<input name="eta" type="text" class="form-control import" placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<div class="form-group">
									<label class="control-label col-md-3">Remarks</label>
									<div class="col-md-9">
										<textarea style="width: 100%; height: 97px;"name="remarks_po" type="text" class="form-control" placeholder=""></textarea>
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!-- span -->
							</div>
							<div class="col-md-6 import hide">
								<div class="form-group">
									<label class="control-label col-md-3">Include Price</label>
									<div class="col-md-9">
										<input name="include_price" type="text" class="form-control " placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<div class="form-group import">
									<label class="control-label col-md-3">Term of Payment</label>
									<div class="col-md-9">
										<input name="teop" type="text" class="form-control " placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<div class="form-group import">
									<label class="control-label col-md-3">Requipment</label>
									<div class="col-md-9">
										<input name="requ" type="text" class="form-control " placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
							</div>
							<!-- end of immport		 -->
							</div>
							<!-- end row -->
                <div class="form-actions foot-form hide">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                          <button id="submit-first" type="submit" class="btn green">Next</button>
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
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
			<div class="col-md-12 dkp-isian">
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
						<form id="form_bpmb" method="post" enctype="multipart/form-data" class="form-horizontal">
							  <div class="form-body">
									<table class="table table-striped table-bordered table-hover" id="table_material">
									 <thead>
												<tr>
                          <th> Id PR</th>
													<th> Action </th>
                          <th> DKP NO</th>
                          <th> Kode Barang </th>
                          <th> Nama Barang</th>
                          <th> Merek </th>
                          <th> SPPr NO</th>
                          <th> Qty Out</th>
                          <th> Qty Buy</th>
                          <th> Stn</th>
                          <th> Qty PO</th>
                          <th> Stn</th>
                          <th> HGS</th>
                          <th> Disc % </th>
                          <th> Jumlah</th>
                          <th> HGS akh</th>
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
				</form>
				</div>
				</div>
				<!-- ./end masterial -->
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
											<button id="submit-all" onclick="sumbit_po()" type="submit" class="btn green">Submit</button>
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
<!-- BEGIN FOOTER -->
<?php $this->load->view('include/footer');?>
<!-- END FOOTER -->
<!-- BEGIN Modal -->
<div id="draggable" class="modal fade draggable-modal"tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Material</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
					<form id="form-po-detail" method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="id_material">
						<input type="hidden" name="qty_requested">
						<div class="form-body">
							<!-- <h3 class="form-section">General Information</h3> -->
							<div class="row">
								<div class="col-md-12 ">
									<div class="form-group">
										<label class="control-label col-md-3">ID PO</label>
										<div class="col-md-9">
											<input value="<?php echo $id_po ?>" name="id_po_modal" type="text" class="form-control" placeholder="PO No">
											<span class="help-block">
											</span>
										</div>
									</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">ID PO Detail</label>
										<div class="col-md-9">
											<input name="id_po_detail" type="text" class="form-control" placeholder="PR  NO">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">ID PR Detail</label>
										<div class="col-md-9">
											<input name="id_pr_detail" type="text" class="form-control" placeholder="PR  NO">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3 ">Merk</label>
                    <div class="col-md-9">
                      <input name="merek" type="text" class="form-control " placeholder="Merk">
                      <span class="help-block">
                       </span>
                    </div>
                  </div>
                </div>
                <!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Qty Buy</label>
										<div class="col-md-9">
											<input name="qty_buy" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3">Qty PO</label>
                    <div class="col-md-9">
                      <input name="qty_po" value=0 type="text" class="form-control" value="" placeholder="">
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3 ">Harga Satuan</label>
										<div class="col-md-9">
											<input name="hgs" value=0 type="text" class="form-control"  placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Satuan PO</label>
										<div class="col-md-9">
											<input name="stn_po" type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12 ">
									<div class="form-group">
										<label class="control-label col-md-3">Diskon %</label>
										<div class="col-md-9">
											<input name="disc" value=0 type="text" class="form-control" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Jumlah</label>
										<div class="col-md-9">
											<input name="jumlah" type="text" class="form-control" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
						</div>
					</div>
					<!-- </div> -->
				</form>
				<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn default">Close</button>
				<button type="button" onclick="save_po_detail()" class="btn green">Save</button>
			</div>
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

  // $(document).ready(function() {
  //   $('#table_material').DataTable( {
  //       "order": [[ 4, "asc" ]]
  //   } );
  // } );

	//select 2==2
	$('.select2').select2();

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
	var url='<?php echo site_url().'po/get_po/'?>'+id_po;
	var table=$('#table_material').DataTable( {
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
			{ "width": "20%", "targets": 4 },
	 {
			 "targets": [ 0 ],
			 "visible": false
	 },
 ],
 "drawCallback": function( settings ) {
	 Metronic.init(); // init metronic core components

	 }
	});

var sum=null;

var input_qty_po=$("[name='qty_po']");
input_qty_po.keyup(function(){
	var qty_po=parseFloat($("[name='qty_po']").val());
	var hgs=parseFloat($("[name='hgs']").val());
	var disc=parseFloat($("[name='disc']").val());
	console.log('qty po : '+qty_po);
	$("[name='jumlah']").val((qty_po*hgs)-(qty_po*hgs*disc/100));
});

var input_hgs=$("[name='hgs']");
input_hgs.keyup(function(){
	var qty_po=parseFloat($("[name='qty_po']").val());
	var hgs=parseFloat($("[name='hgs']").val());
	var disc=parseFloat($("[name='disc']").val());
	console.log('hgs : '+hgs);
	$("[name='jumlah']").val((qty_po*hgs)-(qty_po*hgs*disc/100));
});

var input_disc=$("[name='disc']");
input_disc.keyup(function(){
	var qty_po=parseFloat($("[name='qty_po']").val());
	var hgs=parseFloat($("[name='hgs']").val());
	var disc=parseFloat($("[name='disc']").val());
	console.log('disc : '+disc);
	$("[name='jumlah']").val((qty_po*hgs)-(qty_po*hgs*disc/100));
});

var checkbox=$('[name="import"]');
checkbox.change(function(){
	var cek=$('[name="import"]:checked').length;
	if(cek==0)
	{
		$('.import').addClass('hide');
	}else {
		$('.import').removeClass('hide');
	}
});

	$('[name="ppn"]').keyup(function(){
		var ppn=$('[name="ppn"]').val();
		$('[name="total"]').val(parseFloat(ppn)+parseFloat($('[name="total_paten"]').val()));
	});

}) //end document ready

function edit_po(id_po_detail, id_pr)
{
	Metronic.startPageLoading({animate: true});
	console.log('id pr : '+id_pr);
	$.ajax({
			url : '<?php echo site_url().'po/get_po_by_id/'?>'+id_po_detail,
			type: "POST",
			// data: {'id_item': id,'colom':colom, 'table': table},
			// data: formd,
			// processData: false,
			// contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				var inputs=['merek', 'stn_po', 'qty_buy', 'qty_po', 'hgs', 'disc', 'jumlah'];

				for (var i = 0; i < inputs.length; i++) {
					$('[name="'+inputs[i]+'"]').val(data.input[i]);
				}

				$("[name='id_po_detail']").val(id_po_detail);
				$("[name='id_pr_detail']").val(id_pr);
				$("#draggable").modal('show');
				Metronic.stopPageLoading();


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

function save_po_detail()
{
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-po-detail")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_detail'?>',
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

function sumbit_po()
{
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-po")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_master'?>',
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
				 }else{
					 for (var i = 0; i < data.inputerror.length; i++) {
						 $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						 $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
					 }
					 Metronic.stopPageLoading();
				 }
			},
			complete: function(data){
				bootbox.alert({
					title: '<p class="text-success">success</p>',
					message: 'Well Done !!!!',
				});
				var url='<?php echo site_url().'po/list_po_approval/'?>';
				window.location=url;
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
