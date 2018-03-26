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
<title>Edit PO</title>
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

.list-file{
	margin-left: 20px;
	margin-right: 20px;
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
														<th> DKP NO</th>
														<th> Nama Barang</th>
														<th> Kode Barang </th>
														<th> Nama Pasar </th>
														<th> Merek </th>
														<th> SPPr NO</th>
														<th> Qty Out</th>
														<th> Qty Buy</th>
														<th> Stn</th>
														<th> Qty PO</th>
														<th> Stn PO</th>
														<th> HGS</th>
														<th> Disc % </th>
														<th> Jumlah</th>
														<th> PPN </th>
														<th> PPH </th>
														<th> HGS akh</th>
														<th> HGS Budget</th>
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
								<div class="modal-footer">
									<!-- <button type="button" data-dismiss="modal" class="btn default">Close</button> -->
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
							<form id="form-po" method="post" enctype="multipart/form-data" class="form-horizontal">
								<input type="hidden" name="id_sppr">
								<div class="form-body">
									<h3 class="form-section">General Information</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">PPN Total</label>
												<div class="col-md-9">
													<input name="ppn" type="text" value="0" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">PPH Total</label>
												<div class="col-md-9">
													<input name="pph" type="text" value="0" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Select Supplier</label>
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
														<button class="btn btn-success" type="button"  data-toggle="modal" data-target="#modal-supplier"><i class="fa fa-plus"></i> Add Supplier</button>
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
											<input disabled name="nama_supplier" type="text" class="form-control" placeholder="Name Customer">
											<span class="help-block">
										</span>
										</div>
									</div>
								<!-- /span -->
									<div class="form-group">
										<label class="control-label col-md-3">Contact Name</label>
										<div class="col-md-9">
											<input disabled name="contact_name" type="text" class="form-control" placeholder="PO No.">
											<span class="help-block">
											 </span>
										</div>
									</div>
								<!--/span-->
									<div class="form-group">
										<label class="control-label col-md-3">Telp </label>
										<div class="col-md-9">
											<input disabled name="telp" type="text" class="form-control" placeholder="dd/mm/yyyy">
											<span class="help-block">
											 </span>
										</div>
									</div>
								<!--/span-->
									<div class="form-group">
										<label class="control-label col-md-3">Fax</label>
										<div class="col-md-9">
											<input disabled name="fax" type="text" class="form-control" placeholder="Contact No">
											<span class="help-block">
											</span>
										</div>
									</div>
								</div>
								<!-- /span -->

										<div class="col-md-6 ">
											<div class="form-group">
												<label class="control-label col-md-3">Total Sebelum Pajak</label>
												<div class="col-md-9">
													<input name="total_bt" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Total Setelah Pajak</label>
												<div class="col-md-9">
													<input name="total" type="text" class="form-control" placeholder="">
													<span class="help-block">
													 </span>
												</div>
											</div>
											<div class="form-group hide">
												<label class="control-label col-md-3">ID PO</label>
												<div class="col-md-9">
													<input data-option="<?php echo site_url().'po/get_detail_master/'?>" value="<?php echo $id_po ?>" value="<?php echo $id_po ?>" name="id_po" type="text" class="form-control" placeholder="PO No">
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
										<div class="form-group ">
											<label class="control-label col-md-3">Type </label>
											<div class="col-md-9">
												<select class="form-control" name="type_po">
													<option value="0"> Select One</option>
													<option value="1">Raw Material </option>
													<option value="6">Semi Finish Hoodl</option>
												</select>
												<span class="help-block">
												</span>
											</div>
										</div>
									<!--/span-->
										<div class="form-group ">
											<label class="control-label col-md-3">PO NO</label>
											<div class="col-md-9">
												<input value="" name="po_no" type="text" class="form-control" placeholder="PO No">
												<span class="help-block">
												</span>
											</div>
										</div>
									<!--/span-->
											<!-- <div class="form-group hide">
												<label class="control-label col-md-3">PO NO</label>
												<div class="col-md-9">
													<input value="" name="po_no" type="text" class="form-control" placeholder="PO No">
													<span class="help-block">
													</span>
												</div>
											</div> -->
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

									<h3 class="form-section">Term of Payment</h3>
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label col-md-3">Type </label>
													<div class="col-md-9">
														<select name="type" class="form-control select2" id="form_control_1">
															<!-- <option value="">Select Type</option> -->
															<option value="cia">Cash In Advance</option>
															<option value="cod"> COD</option>
															<option value="credit">Credit</option>
															<option value="pp">Progress Payment</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<button type="button" onclick="add_column()" class="btn btn-success"><i class="fa fa-plus"></i></button>
											</div>
										</div>
										<div class="col-md-12">
											<div class="table-responsive">
										  <table class="table table-hover table-bordered table-top">
										    <thead>
										      <tr>
										        <th>Type</th>
										        <th>Description</th>
										        <th>Nominal</th>
										        <th>Persentase</th>
										        <th>Tengang Waktu</th>
														<th>Action</th>
										      </tr>
										    </thead>
										    <tbody id="tbody">

										    </tbody>
										  </table>
										  </div>
										</div>
										<!-- span -->
									</div>
							<h3 class="form-section">Addition Information</h3>
							<div class="row">
							<div class="col-md-6 import">
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
							<div class="col-md-6 import">
								<div class="form-group">
									<label class="control-label col-md-3">Include Price</label>
									<div class="col-md-9">
										<input name="include_price" type="text" class="form-control " placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<div class="form-group">
									<label class="control-label col-md-3">Reference</label>
									<div class="col-md-9">
										<input name="reference" type="text" class="form-control import" placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div>
								<!--/span-->
								<!-- <div class="form-group import">
									<label class="control-label col-md-3">Term of Payment</label>
									<div class="col-md-9">
										<input name="teop" type="text" class="form-control " placeholder="">
										<span class="help-block">
										 </span>
									</div>
								</div> -->
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
							<h3 class="form-section">Upload File</h3>
							<div class="row">
								<div class="upload-file">
							 <div class="dropzone dz-clickable" id="my-dropzone" style="margin-left: 20px; margin-right: 20px;">
								 <div class="dz-default dz-message">
									 <span>Drop files here to upload</span>
								 </div>
							 </div>
						 </div>
						 <div class="list-file">
							 <table class="table table-hover table-bordered table-striped">
						    <thead>
						      <tr>
						        <th>Name File</th>
						        <th>Action</th>
						      </tr>
						    </thead>
						    <tbody id="files-list">
						    </tbody>
						  </table>
						 </div>
						 <!-- end of list file -->
							</div>
								<div class="form-actions foot-form hide">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<button id="submit-first" type="button" onclick="save_po_master()" class="btn green">Save</button>
													<!-- <button type="button" class="btn default">Cancel</button> -->
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
						<div class="modal-footer">
							<!-- <button type="button" onclick="goBack()" class="btn default">Cancel</button> -->
							<button id="submit-first" type="button" onclick="save_po_master()" class="btn green">Save</button>
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
<!-- Modal -->
<div id="modal-supplier" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
				<form id="form-supplier" class="form-horizontal" enctype="multipart/form-data" method="post">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Kode Supplier</label>
							<div class="col-md-9">
								<input name="supplier_code" type="text" class="form-control" placeholder="Name Customer">
								<span class="help-block">
							</span>
							</div>
						</div>
					<!-- /span -->
							<div class="form-group">
								<label class="control-label col-md-3">Nama Supplier</label>
								<div class="col-md-9">
									<input name="supplier_name" type="text" class="form-control" placeholder="">
									<span class="help-block">
								</span>
								</div>
							</div>
						<!-- /span -->
							<div class="form-group">
								<label class="control-label col-md-3">Contact Name</label>
								<div class="col-md-9">
									<input name="contact_name" type="text" class="form-control" placeholder="">
									<span class="help-block">
									 </span>
								</div>
							</div>
						<!--/span-->
							<div class="form-group">
								<label class="control-label col-md-3">Telp </label>
								<div class="col-md-9">
									<input name="telp" type="text" class="form-control" placeholder="">
									<span class="help-block">
									 </span>
								</div>
							</div>
						<!--/span-->
							<div class="form-group">
								<label class="control-label col-md-3">Fax</label>
								<div class="col-md-9">
									<input name="fax" type="text" class="form-control" placeholder="">
									<span class="help-block">
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Fax</label>
								<div class="col-md-9">
									<textarea name="note" type="text" class="form-control" placeholder=""></textarea>
									<span class="help-block">
									</span>
								</div>
							</div>
					</div>
				</form>
      </div>
      <div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="save_supplier()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- BEGIN Modal -->
<div id="draggable" class="modal fade draggable-modal bum-modal"tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">BUM</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
					<form id="form-po-bum" method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="id_material">
						<input type="hidden" name="qty_requested">
						<div class="form-body">
							<!-- <h3 class="form-section">General Information</h3> -->
							<div class="row">
								<div class="col-md-12 hide ">
									<div class="form-group">
										<label class="control-label col-md-3">ID PO</label>
										<div class="col-md-9">
											<input value="<?php echo $id_po ?>" name="id_po_modal" type="text" class="form-control" placeholder="PO No">
											<span class="help-block">
											</span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">BUM No</label>
										<div class="col-md-9">
											<input name="bum_no" type="text" class="form-control" placeholder="">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-9">
											<input name="nama" value="<?php echo $_SESSION['username'];?>"type="text" class="form-control" placeholder="">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3 ">Jabatan</label>
                    <div class="col-md-9">
                      <input name="jabatan" value="<?php echo $_SESSION['division'];?>" type="text" class="form-control " placeholder="">
                      <span class="help-block">
                       </span>
                    </div>
                  </div>
                </div>
                <!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nominal BUM</label>
										<div class="col-md-9">
											<input name="nominal_bum" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3">Lama Hari</label>
                    <div class="col-md-9">
                      <input name="lama_hari" value=0 type="text" class="form-control" value="" placeholder="">
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Deskripsi</label>
										<div class="col-md-9">
											<textarea name="description" value=0 type="text" class="form-control" value="" placeholder=""></textarea>
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
				<button type="button" onclick="save_po_bum()" class="btn green">Save</button>
			</div>
		</div>
	</div>
</div>
</div>
<!-- ./END MODAL -->
<!-- BEGIN COD Modal -->
<div id="draggable" class="modal fade draggable-modal cod-modal"tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">COD</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
					<form id="form-po-cod" method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="id_material">
						<input type="hidden" name="qty_requested">
						<div class="form-body">
							<!-- <h3 class="form-section">General Information</h3> -->
							<div class="row">
								<div class="col-md-12 hide ">
									<div class="form-group">
										<label class="control-label col-md-3">ID PO</label>
										<div class="col-md-9">
											<input value="<?php echo $id_po ?>" name="id_po_modal" type="text" class="form-control" placeholder="PO No">
											<span class="help-block">
											</span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-9">
											<input name="nama" value="<?php echo $_SESSION['username'];?>"type="text" class="form-control" placeholder="">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3 ">Jabatan</label>
                    <div class="col-md-9">
                      <input name="jabatan" value="<?php echo $_SESSION['division'];?>" type="text" class="form-control " placeholder="">
                      <span class="help-block">
                       </span>
                    </div>
                  </div>
                </div>
                <!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nominal COD</label>
										<div class="col-md-9">
											<input name="nominal_cod" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
                <div class="col-md-12 hide">
                  <div class="form-group">
                    <label class="control-label col-md-3">Lama Hari</label>
                    <div class="col-md-9">
                      <input name="time" value='' type="text" class="form-control" value="" placeholder="">
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
								<div class="col-md-12 hide">
									<div class="form-group">
										<label class="control-label col-md-3">Deskripsi</label>
										<div class="col-md-9">
											<textarea name="description" value='' type="text" class="form-control" value="" placeholder=""></textarea>
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
				<button type="button" onclick="save_po_cod()" class="btn green">Save</button>
			</div>
		</div>
	</div>
</div>
</div>
<!-- ./END MODAL -->
<!-- BEGIN credit Modal -->
<div id="draggable" class="modal fade draggable-modal credit-modal"tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Credit</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
					<form id="form-po-credit" method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="id_material">
						<input type="hidden" name="qty_requested">
						<div class="form-body">
							<!-- <h3 class="form-section">General Information</h3> -->
							<div class="row">
								<div class="col-md-12 hide ">
									<div class="form-group">
										<label class="control-label col-md-3">ID PO</label>
										<div class="col-md-9">
											<input value="<?php echo $id_po ?>" name="id_po_modal" type="text" class="form-control" placeholder="PO No">
											<span class="help-block">
											</span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-9">
											<input name="nama" value="<?php echo $_SESSION['username'];?>"type="text" class="form-control" placeholder="">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3 ">Jabatan</label>
                    <div class="col-md-9">
                      <input name="jabatan" value="<?php echo $_SESSION['division'];?>" type="text" class="form-control " placeholder="">
                      <span class="help-block">
                       </span>
                    </div>
                  </div>
                </div>
                <!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Type Credit</label>
										<div class="col-md-9">
											<select name="type_top" class="form-control select2" id="form_control_1">
												<!-- <option value="">Select Type</option> -->
												<option value="REGULAR">Regular</option>
												<option value="SKBDN/LC USANCE">SKBDN/LC Usance</option>
												<option value="SKBDN/LC AT SIGHT">SKBDN/LC AT SIGHT</option>
											</select>
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nominal Credit</label>
										<div class="col-md-9">
											<input name="nominal_credit" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3">Lama Hari</label>
                    <div class="col-md-9">
											<select name="time" class="form-control select2" id="form_control_1">
												<!-- <option value="">Select Type</option> -->
												<option value="15">15 Hari</option>
												<option value="30">30 Hari</option>
												<option value="45">45 Hari</option>
												<option value="60">60 Hari</option>
												<option value="90">90 Hari</option>
											</select>
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Deskripsi</label>
										<div class="col-md-9">
											<textarea name="description" value=0 type="text" class="form-control" value="" placeholder=""></textarea>
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
				<button type="button" onclick="save_po_credit()" class="btn green">Save</button>
			</div>
		</div>
	</div>
</div>
</div>
<!-- ./END MODAL -->
<!-- BEGIN progress Modal -->
<div id="draggable" class="modal fade draggable-modal progress-modal"tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Credit</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1"> -->
					<form id="form-po-progress" method="post" enctype="multipart/form-data" class="form-horizontal">
						<input type="hidden" name="id_material">
						<input type="hidden" name="qty_requested">
						<div class="form-body">
							<!-- <h3 class="form-section">General Information</h3> -->
							<div class="row">
								<div class="col-md-12 hide ">
									<div class="form-group">
										<label class="control-label col-md-3">ID PO</label>
										<div class="col-md-9">
											<input value="<?php echo $id_po ?>" name="id_po_modal" type="text" class="form-control" placeholder="PO No">
											<span class="help-block">
											</span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nama</label>
										<div class="col-md-9">
											<input name="nama" value="<?php echo $_SESSION['username'];?>"type="text" class="form-control" placeholder="">
											<span class="help-block">
											 </span>
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3 ">Jabatan</label>
                    <div class="col-md-9">
                      <input name="jabatan" value="<?php echo $_SESSION['division'];?>" type="text" class="form-control " placeholder="">
                      <span class="help-block">
                       </span>
                    </div>
                  </div>
                </div>
                <!--/span-->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Type</label>
										<div class="col-md-9">
											<select name="type_pp" class="form-control select2" id="form_control_1">
												<option value="">Select Type</option>
												<option value="DP">DP</option>
												<option value="TERMINJ">TERMINJ</option>
											</select>
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12 dp hide">
									<div class="form-group">
										<label class="control-label col-md-3">Butuh BPB/BA</label>
										<div class="col-md-9">
											<input type="checkbox" name="bpb_ack" value="1" class="checkboxes">
											<span class="help-block">
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Total</label>
										<div class="col-md-9">
											<input name="nominal" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Persentase</label>
										<div class="col-md-9">
											<input name="persentase" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Nominal</label>
										<div class="col-md-9">
											<input name="nominal_dp" value=0 type="text" class="form-control" value="" placeholder="">
											<span class="help-block">
										</span>
										</div>
									</div>
								</div>
								<!-- /span -->
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label col-md-3">Lama Hari</label>
                    <div class="col-md-9">
											<select name="time" class="form-control select2" id="form_control_1">
												<!-- <option value="">Select Type</option> -->
												<option value="7" > 7 Hari </option>
												<option value="15">15 Hari</option>
												<option value="30">30 Hari</option>
												<option value="45">45 Hari</option>
												<option value="60">60 Hari</option>
												<option value="90">90 Hari</option>
											</select>
                      <span class="help-block">
                    </span>
                    </div>
                  </div>
                </div>
                <!-- /span -->
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-3">Deskripsi</label>
										<div class="col-md-9">
											<textarea name="description" value=0 type="text" class="form-control" value="" placeholder=""></textarea>
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
				<button type="button" onclick="save_po_process()" class="btn green">Save</button>
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
<script type="text/javascript" src="<?php echo base_url().'assets/js/global_js.js'?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>

// var UIModals=function(){var n=function(){$("#draggable").draggable({handle:".modal-header"})};return{init:function(){n()}}}();jQuery(document).ready(function(){UIModals.init()});
var array_jumlah={firstName:0};
var flag=true;
var $table='';
var global_id_dkp='';
var foto_upload='';
jQuery(document).ready(function() {
	//setup metronic
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	FormSamples.init();

	var url_upload='<?php echo site_url().'/po/upload_file'?>';
	//UPLOAD File
	Dropzone.autoDiscover = false;
	foto_upload= new Dropzone("div#my-dropzone",{
		autoProcessQueue: false,
		url: url_upload,
		maxFilesize: 20,
		// maxFiles: 24,
		parallelUploads: 24,
		uploadMultiple: true,
		dictResponseError: 'Error while uploading file!',
		method:"post",
		// acceptedFiles:"*",
		paramName:"userfile",
		// dictInvalidFileType:"Type file ini tidak dizinkan",
		addRemoveLinks:true,
		// init: function() {
		// 	var submitButton = document.querySelector("#submit-first")
		// 	myDropzone = this; // closure
		//
		// 	submitButton.addEventListener("click", function() {
		// 		myDropzone.processQueue(); // Tell Dropzone to process all queued files.
		// 		// this.options.autoProcessQueue = true;
		// 		// autoProcessQueue: true;
		// 	});
		// }
	});

	foto_upload.on('error', function(file, response) {
						// (assuming your response object has an errorMessage property...)
						var errorMessage = "Upload Gagal";
						$(file.previewElement).find('.dz-error-message').text(errorMessage);
				});

	//Event ketika Memulai mengupload
	foto_upload.on("sending",function(a,b,c){
		a.id_po=$('[name="id_po"]').val();
		console.log('id po upload: '+a.id_po);
		c.append("id_po",a.id_po); //Menmpersiapkan token untuk masing masing foto
	});


	//active slide bar
	$('#pr').addClass('active open');
	$('#createPR').addClass('active');

	//date datepicker
	$('.datepicker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
	});

  //get data and embed to form
  get_data_master();

  // $(document).ready(function() {
  //   $('#table_material').DataTable( {
  //       "order": [[ 4, "asc" ]]
  //   } );
  // } );

	//select 2==2
	$('.select2').select2();

//embed supplier code
	var sc=$("[name='supplier_code']"); //supplier_code
	sc.change(function(){
		var supp=$(this).val();
		var arr_supp=supp.split("%");
		var col=['code_supplier','nama_supplier', 'contact_name', 'telp', 'fax'];
		for (var i = 0; i < col.length; i++) {
			$('[name="'+col[i]+'"]').val(arr_supp[i]);
		}
	});

//set nombnial by persentation
	$('[name="persentase"]').keyup(function(){
		var per=$('[name="persentase"]').val();
		var nc=$('[name="nominal"]').val();
		var nc_fin=numeral(nc).value();
		console.log(nc_fin + 'sds'+parseFloat(per));

		$('[name="nominal_dp"]').val(nc_fin*parseFloat(per)/100);
	});
//sert persenet by nomnilan
	$('[name="nominal_dp"]').keyup(function(){
		var nom=$('[name="nominal_dp"]').val();
		var nc=$('[name="nominal"]').val();
		var nc_fin=numeral(nc).value();
		console.log(nc_fin + 'sds'+parseFloat(nom));

		$('[name="persentase"]').val(nom*100/nc_fin);
	});

	//cek type pp is TERMINJ
	$('[name="type_pp"]').change(function(){
		var tPP=$('[name="type_pp"]').val();
		if(tPP=='TERMINJ'){
			$('.dp').removeClass('hide');
		}else{
			$('.dp').addClass('hide');
		}
	});

	// get data material list
	var id_po=$("[name='id_po']").val();
	var url='<?php echo site_url().'po/get_po_edit/'?>'+id_po;
	var table=$('#table_material').DataTable( {
		"bDestroy": true,
		"ajax":
		{
				"url": url,
				"type": "POST",
				"retrieve": true,
				keys: true,
		},
		"order": [[ 1, 'asc' ]],
		"columnDefs": [
			{ "width": "30%", "targets": 2 },
	 // {
		// 	 "targets": [ 0 ],
		// 	 "visible": false
	 // },
 ],
 "drawCallback": function( settings ) {
  	 Metronic.init(); // init metronic core components
		 update_total();
     //if hgs was change
     $('.hgs').keyup(function(){
       var hgs=$(this).val();
       var qty_po=$(this).parent().prev().prev().children().val();
       var disc_=$(this).parent().next().children().val();
       // console.log('HGS :'+hgs+' Qpo: '+qty_po+'Dosc: '+disc_);
       var jumlah=$(this).parent().next().next().children();
			 var ppns=$(this).parent().next().next().next().children();

       jumlah.val((parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100));
			 ppns.val(((parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100))*(10/100));
			 // var ppn=$('[name="ppn"]').val();
			 var namenya=$(this).attr("name");
			 // array_jumlah["'i"+namenya+"'"]=(parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100);
			 update_total();
     });

     //if qty po
     $('.qty_po').keyup(function(){
       var qty_po=$(this).val();
       var hgs=$(this).parent().next().next().children().val();
       var disc_=$(this).parent().next().next().next().children().val();
       console.log('HGS :'+hgs+' Qpo: '+qty_po+'Disc: '+disc_);
       var jumlah=$(this).parent().next().next().next().next().children();
       jumlah.val((parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100));
			 ppns.val(((parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100))*(10/100));

			 var namenya=$(this).attr("name");
			 // array_jumlah["'i"+namenya+"'"]=(parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100);
			 update_total();
     });

     //if disc was change
     $('.disc').keyup(function(){
       var disc_=$(this).val();
       var hgs=$(this).parent().prev().children().val();
       var qty_po=$(this).parent().prev().prev().prev().children().val();
       console.log('HGS :'+hgs+' Qpo: '+qty_po+'Disc: '+disc_);
       var jumlah=$(this).parent().next().children();
       jumlah.val((parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100));
			 ppns.val(((parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100))*(10/100));

			 // var ppn=$('[name="ppn"]').val();
			 var namenya=$(this).attr("name");
			  // array_jumlah["'i"+namenya+"'"]=(parseFloat(hgs)*parseFloat(qty_po))-(parseFloat(hgs)*parseFloat(qty_po)*parseFloat(disc_)/100);
				update_total();
     });

		 $('.pph').keyup(function(){
			 update_total();
		 });

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
		update_total();
	});


}) //end document ready

function update_total()
{
		var total=0.0;
		var tot_ppn=0;
		tot_ppn=parseFloat(tot_ppn);
		var tot_pph=0.0;
		$('#table_material tr').each(function(){
				var num=$(this).find('.jumlah').val();
				var ppn_input=$(this).find('.ppn').val();
				var pph_input=$(this).find('.pph').val();
				if(typeof num !== 'undefined'){
				total=total+parseFloat(num);
				}
				if(typeof ppn_input !== 'undefined'){
					tot_ppn=tot_ppn+parseFloat(ppn_input);
				}
				if(typeof pph_input !== 'undefined'){
					tot_pph=tot_pph+(parseFloat(pph_input)/100*parseFloat(num));
				}
		});
		$('[name="ppn"]').val(numeral(tot_ppn).format('0,0.00'));
		$('[name="pph"]').val(numeral(tot_pph).format('0,0.00'));
		$('[name="total_bt"]').val(numeral(total).format('0,0.00'));
		$('[name="total"]').val(numeral(tot_ppn+total+tot_pph).format('0,0.00'));
		$('[name="nominal"]').val(numeral(tot_ppn+total+tot_pph).format('0,0.00'));

}
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
	var formd = new FormData($("#form_po_det")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_detail_ex'?>',
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

function save_po_bum()
{
	// save_po_master();
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-po-bum")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/bum/save_po_bum'?>',
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
						var tr='<tr> <td>CIA-BUM</td>';
						tr+='<td> '+data.data.bum_no+'-'+data.data.description+'</td>';
						tr+='<td> '+numeral(data.data.nominal_bum).format(0,0)+'</td>';
						tr+='<td></td>';
						tr+='<td> '+data.data.lama_hari+'</td>';
						tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_bum('+data.id+')"><i class="fa fa-trash"></i></a></td>';
						tr+='</tr>';

						$('#tbody').append(tr);

					$('.btn-delete').click(function(){
						console.log('sdsds');
						$(this).parent().parent().remove();
					});

					// bootbox.alert({
					// 	title: '<p class="text-success">success</p>',
					// 	message: 'Well Done !!!!',
					// });
					Metronic.stopPageLoading();
					$('.bum-modal').modal('hide');

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

function save_po_cod()
{
	// save_po_master();
	Metronic.startPageLoading({animate: true});
	var formd = new FormData($("#form-po-cod")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_cod'?>',
			type: "POST",
			data: formd,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
						var tr='<tr> <td>COD</td>';
						tr+='<td> '+data.data.description+'</td>';
						tr+='<td> '+numeral(data.data.nominal).format(0,0)+'</td>';
						tr+='<td></td>';
						tr+='<td> '+data.data.time+'</td>';
						tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_top('+data.id+')"><i class="fa fa-trash"></i></a></td>';
						tr+='</tr>';

						$('#tbody').append(tr);

					$('.btn-delete').click(function(){
						console.log('sdsds');
						$(this).parent().parent().remove();
					});
					Metronic.stopPageLoading();
					$('.cod-modal').modal('hide');

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

function save_po_credit()
{
	// save_po_master();
	Metronic.startPageLoading({animate: true});
	var formd = new FormData($("#form-po-credit")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_credit'?>',
			type: "POST",
			data: formd,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
						var tr='<tr> <td> Credit-'+data.data.type_top+'</td>';
						tr+='<td> '+data.data.description+'</td>';
						tr+='<td> '+numeral(data.data.nominal).format(0,0)+'</td>';
						tr+='<td></td>';
						tr+='<td> '+data.data.time+'</td>';
						tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_top('+data.id+')"><i class="fa fa-trash"></i></a></td>';
						tr+='</tr>';

						$('#tbody').append(tr);

					$('.btn-delete').click(function(){
						console.log('sdsds');
						$(this).parent().parent().remove();
					});
					Metronic.stopPageLoading();
					$('.credit-modal').modal('hide');

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

function save_po_process()
{
	// save_po_master();
	var t_pp=$('[name="type_pp"]').val();
	if(t_pp==''){
		alert("Type cannot Empty, select One Please !!!");
		return 0 ;
	}
	Metronic.startPageLoading({animate: true});
	var formd = new FormData($("#form-po-progress")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_progress'?>',
			type: "POST",
			data: formd,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
						var tr='<tr> <td> Credit-'+data.data.type_pp+'</td>';
						tr+='<td> '+data.data.description+'</td>';
						tr+='<td> '+numeral(data.data.nominal_dp).format(0,0)+'</td>';
						tr+='<td> '+data.data.persentase+'</td>';
						tr+='<td> '+data.data.time+'</td>';
						tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_dp('+data.id+')"><i class="fa fa-trash"></i></a></td>';
						tr+='</tr>';

						$('#tbody').append(tr);

					$('.btn-delete').click(function(){
						console.log('sdsds');
						$(this).parent().parent().remove();
					});
					Metronic.stopPageLoading();
					// $('.credit-modal').modal('hide');
					$('.progress-modal').modal('hide');


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

function save_po_master()
{
	foto_upload.processQueue();
	Metronic.startPageLoading({animate: true});
	$(".form-group").removeClass('has-error');
	$(".help-block").empty();
	var formd = new FormData($("#form-po")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/save_po_master_ex'?>',
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
	var formd = new FormData($("#form-po")[0]); //get data
	$.ajax({
			url : '<?php echo site_url().'/po/sent_po'?>',
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
								var url='<?php echo site_url().'po/list_po_approval/'?>';
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

// function get_data_master()
// {
//   var id_po_master=$('[name="id_po"]').val();
//   Metronic.startPageLoading({animate: true});
// 	// console.log('id pr : '+id_pr);
// 	$.ajax({
// 			url : '<?php echo site_url().'po/get_detail_master/'?>'+id_po_master,
// 			type: "POST",
// 			// data: {'id_item': id,'colom':colom, 'table': table},
// 			// data: formd,
// 			// processData: false,
// 			// contentType: false,
// 			dataType: "JSON",
// 			success: function(data)
// 			{
// 				Metronic.stopPageLoading();
// 				console.log(data.files.length);
// 				var l=data.files.length;
// 				//list files
// 				$('#files-list').html(' ');
// 				var table_body='';
// 				if(data.files.length!=0){
// 					for(var i=0; i<data.files.length; i++){
// 						var link="'"+data.files[i][1]+"'";
// 						table_body+='<tr>';
// 						table_body+='<td>'+data.files[i][0]+'</td>';
// 						table_body+='<td><a class="btn btn-danger" onclick="delete_file('+link+')">Delete</a></td></tr>';
// 					}
// 					console.log(table_body);
// 					$('#files-list').append(table_body);
// 					$('.list-file').removeClass('hide');
// 				}else{
// 					// $('.list-file').addClass('hide');
// 				}
//
//
// 				var gin=['po_no', 'date_po', 'ppn', 'total', 'date_sent', 'import_id', 'etd', 'eta', 'remarks_po', 'include_price', 'reference', 'requ'];
//
// 				var top=['detail_dp', 'nominal_dp', 'detail_termin', 'nominal_termin', 'detail_pelunasan', 'nominal_pelunasan'];
//
// 				for (var i = 0; i < gin.length; i++) {
//           if(data.gi[i]!=null){
// 					       $('[name="'+gin[i]+'"]').val(data.gi[i]);
//           }
// 				}
//
// 				if(data.gi[0]!=''){
// 					$('[name="po_no"]').attr('disabled','disabled');
// 				}
//
// 				//list top
// 				for (var i = 0; i < data.top.length; i++) {
// 						var tr='<tr> <td>'+data.top[i][1].toUpperCase()+'</td>';
// 						tr+='<td> '+data.top[i][2]+'</td>';
// 						tr+='<td> '+data.top[i][3]+'</td>';
// 						tr+='<td> </td>';
// 						tr+='<td> '+data.top[i][4]+'</td>';
// 						if(data.top[i][1]=='COD'){
// 						tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_top('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
// 						}
// 						else if (data.top[i][1]=='CIA-BUM') {
// 							tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_bum('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
// 						}
// 						else if (data.top[i][1]=='TERMINJ' || data.top[i][1]=='DP' ) {
// 							tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_dp('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
// 						}
// 						else{
// 							tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_top('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
// 						}
// 						tr+='</tr>';
// 						$('#tbody').append(tr);
//
// 				}
//
// 				$('.btn-delete').click(function(){
// 					console.log('sdsds');
// 					$(this).parent().parent().remove();
// 				});
//
//         var din=['reference', 'include_price', 'etd', 'eta', 'teop', 'remarks_po', 'requ'];
//
//         // for (var i = 0; i < din.length; i++) {
//           if(data.di!=null){
//           // $('[name="'+din[i]+'"]').val(data.di[i]);
//           $('[name="import"]').attr("checked", true);
//           $('[name="import"]').parent('span').addClass('checked');
//           }
//         // }
//
// 				var sl=['code_supplier', 'id_alamat', 'cur_id'];
// 			         for (var i = 0; i < sl.length; i++) {
// 			           if(data.sd[i]!=null){
// 			           $('[name="'+sl[i]+'"]').val(data.sd[i]).trigger('change');
// 			           }
// 			         }
// 			 					$('[name="nama_supplier"]').val(data.supp[0].supplier_name);
// 			 					$('[name="contact_name"]').val(data.supp[0].contact_name);
// 			 					$('[name="telp"]').val(data.supp[0].telp);
// 			 					$('[name="fax"]').val(data.supp[0].fax);
//
//
//
//
// 			 				// $("[name='id_po_detail']").val(id_po_detail);
// 			 				// $("[name='id_pr_detail']").val(id_pr);
// 			 				// $("#draggable").modal('show');
// 			 			},
// 			 			error: function (jqXHR, textStatus, errorThrown)
// 			 			{
// 			 				Metronic.stopPageLoading();
//
// 			 					alert('Error, Please select one');
// 			 					$('#btnSave').text('save'); //change button text
// 			 					$('#btnSave').attr('disabled',false); //set button enable
// 			 			}
// 			 	});
// 			 }

			 var global_top=0;
			 var global_total=0;
			 function cek_total_top()
			 {
				 var nominal=0.0;
				 $('.table-top tr').each(function() {
				     if (!this.rowIndex) return; // skip first row
				     var nominal_td = this.cells[2].innerHTML;
				 		 console.log(nominal_td);
						 nominal=nominal+parseFloat(numeral(nominal_td).value());
				 });
				 global_top=nominal;
				 return nominal;
			 }

			 function add_column()
			 {
				var nominal_top=cek_total_top();
				var total=$('[name="total"]').val();
				var total_final=numeral(total).value();
				if(nominal_top>=parseFloat(total_final)){
					alert("sudah tidak dapat menambah Term of Payment !!!");
					return;
				}
				$('[name="nominal_cod"]').val(total_final-nominal_top);
				$('[name="nominal_bum"]').val(total_final-nominal_top);
				$('[name="nominal_credit"]').val(total_final-nominal_top);
			 	var type=$('[name="type"]').val();
			 	console.log(type+' '+nominal_top);
			 	if(type=='cia'){
					$('[name="nominal"]').val(total_final-nominal_top);
			 		$.ajax({
			 				url : '<?php echo site_url().'bum/get_bum_no/'?>', // calculate ID BUM
			 				type: "POST",
			 				dataType: "JSON",
			 				success: function(data)
			 				{
			 					$('[name="bum_no"]').val(data.no);
			 				},
			 				error: function (jqXHR, textStatus, errorThrown)
			 				{
			 						alert('Error, Please select one');
			 				}
			 		});

			 		$('.bum-modal').modal('show');
			 	}
			 	else if (type=='cod') {
			 		// $('.cod-modal').modal('show');
					$('[name="nominal"]').val(total_final-nominal_top);
			 		 save_po_cod();
			 	}
			 	else if (type=='credit')
			 	{
					$('[name="nominal"]').val(total_final-nominal_top);
			 		$('.credit-modal').modal('show');
			 	}
			 	else if(type=='pp'){
			 		$('.progress-modal').modal('show');
			 	}
			 	else{
			 		var tr='<tr> <td>'+type.toUpperCase()+'</td>';
			 		tr+='<td> <input type="text" class="form-control" name="detail_'+type+'[]"></td>';
			 		tr+='<td> <input type="text" class="form-control" name="nominal_'+type+'[]"></td>';
			 		tr+='<td> <select class="form-control" name="time_'+type+'[]"> <option value="14">14 hari</option> <option value="30">30 hari</option></select></td>';
			 		tr+='<td> <a class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></a></td>';
			 		tr+='</tr>';

			 		$('#tbody').append(tr);
			 	}

			 	$('.btn-delete').click(function(){
			 		console.log('sdsds');
			 		$(this).parent().parent().remove();
			 	});
			 }

			 function delete_bum($id)
			 {
			 	$.ajax({
			 			url : '<?php echo site_url().'bum/delete_bum/'?>'+$id, // calculate ID BUM
			 			type: "POST",
			 			dataType: "JSON",
			 			success: function(data)
			 			{
			 				$('[name="bum_no"]').val(data.no);
			 			},
			 			error: function (jqXHR, textStatus, errorThrown)
			 			{
			 					alert('Error, Please select one');
			 			}
			 	});
			 }

			 function delete_top(id)
			 {
			 	$.ajax({
			 			url : '<?php echo site_url().'po/delete_top/'?>'+id, // calculate ID BUM
			 			// data:
			 			type: "POST",
			 			dataType: "JSON",
			 			success: function(data)
			 			{
			 				// $('[name="bum_no"]').val(data.no);
			 			},
			 			error: function (jqXHR, textStatus, errorThrown)
			 			{
			 					alert('Error, Please select one');
			 			}
			 	});
			 }

			 function delete_dp(id)
			 {
			 	$.ajax({
			 			url : '<?php echo site_url().'po/delete_dp/'?>'+id, // calculate ID BUM
			 			// data:
			 			type: "POST",
			 			dataType: "JSON",
			 			success: function(data)
			 			{
			 				// $('[name="bum_no"]').val(data.no);
			 			},
			 			error: function (jqXHR, textStatus, errorThrown)
			 			{
			 					alert('Error, Please select one');
			 			}
			 	});
			 }

			 function save_supplier()
			 {
			 	Metronic.startPageLoading({animate: true});
			 	$(".form-group").removeClass('has-error');
			 	$(".help-block").empty();
			 	var formd = new FormData($("#form-supplier")[0]); //get data
			 	$.ajax({
			 			url : '<?php echo site_url().'/po/save_supplier'?>',
			 			type: "POST",
			 			// data: {'id_item': id,'colom':colom, 'table': table},
			 			data: formd,
			 			processData: false,
			 			contentType: false,
			 			dataType: "JSON",
			 			success: function(data)
			 			{
			 				Metronic.stopPageLoading();
			 				$('#modal-supplier').modal('hide');
			 				// $('[name="code_supplier"]').val(data.id);
			 				var col=['code_supplier', 'nama_supplier', 'contact_name', 'telp', 'fax' ];

			 				// var col=['nama_supplier', 'contact_name', 'telp', 'fax' ];

			 				for (var i = 0; i < col.length; i++) {
			 					$('[name="'+col[i]+'"]').val(data.isi[i]);
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

			 function delete_file($link){
				 $.ajax({
						 url : '<?php echo site_url().'po/delete_file/'?>', // calculate ID BUM
						 type: "POST",
						 data: {'link': $link},
						 dataType: "JSON",
						 success: function(data)
						 {
							 get_data_master();
						 },
						 error: function (jqXHR, textStatus, errorThrown)
						 {
								 alert('Error, Please select one');
						 }
				 });
			 }

			 </script>
