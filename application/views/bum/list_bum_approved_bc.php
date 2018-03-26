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
<title>List PO</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<script src="<?php echo base_url().'assets/livecss.js'?>" type="text/javascript"></script>
<?php $this->load->view('include/css');?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- <link href="<?php echo base_url().'assets/global/plugins/datatables/datatables.min.css'?>" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'?>"/>
<!-- END PAGE LEVEL PLUGINS -->
</head>
<style>
.form-horizontal .control-label {
    /*text-align: left;*/
}
.form-group {
    margin-bottom: 0px;
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
<body class="page-header-fixed page-quick-sidebar-over-content ">
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
								<span class="caption-subject bold uppercase"> List BUM APPROVED </span>
							</div>
							<div class="actions">
								<!-- <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
								</a> -->
							</div>
						</div>
						<div class="portlet-body">
							<form id="form-filter" method="post" enctype="multipart/form-data" class="form-horizontal hide">
								<div class="form-body">
									<h3 class="form-section">Filter</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">No. SPPr</label>
												<div class="col-md-9">
													<!-- <input name="no_sppr" type="text" class="form-control" placeholder="Nomor SPPr"> -->
													<select name="sppr_no" class="form-control">
														<option value=""></option>
														<?php
														foreach ($sppr as $key) {
															echo '<option value="'.$key['no_sppr'].'">'.$key['no_sppr'].'</option>';
														}
														?>
													</select>
													<span class="help-block">
													</span>
												</div>
											</div>
										</div>
										<!--/span-->
										<!-- <div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">PO No.</label>
												<div class="col-md-9">
													<input name="po_no" type="text" class="form-control" placeholder="Nomor SPPr">
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div> -->
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">ID DKP</label>
												<div class="col-md-9">
                          <select id="dkp_no" name="dkp_id" class="form-control" id="form_control_1">
                            <option value=""></option>
                            <!-- <option value=""></option> -->
                            <?php
                            // var_dump($no_sppr_all);
                            foreach ($id_dkp_all as $key) {
                              echo "<option value='".$key['id_dkp']."'>".$key['id_dkp']."</option>";
                            }
                            ?>
                          </select>
													<span class="help-block">
													 </span>
												</div>
											</div>
										</div>
										<!--/span-->
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-3">Material ID</label>
												<div class="col-md-9">
													<input name="material_id" type="text" class="form-control " >
													<span class="help-block">
													</span>
												</div>
											</div>
										</div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Jenis Bahan</label>
                        <div class="col-md-9">
                          <input name="jenis_bahan" type="text" class="form-control " >
                          <span class="help-block">
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Kode Bahan</label>
                        <div class="col-md-9">
                          <input name="kode_bahan" type="text" class="form-control " >
                          <span class="help-block">
                          </span>
                        </div>
                      </div>
                    </div>
								</div>
								<!-- row -->
							</div>
							<!-- ./form body -->
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" onclick="reset_form()">Reset</button>
								<button type="submit" class="btn btn-success" >Filter</button>

							</div>
						</form>
						<hr>
						</div>
						<div class="portlet-body table-responsive">
							<!-- BEGIN TABLE -->
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a onclick="reload_table()" id="sample_editable_1_new" class="btn green">
											Reload Table  <i class="fa fa-refresh"></i>
										</a>
										</div>
									</div>
									<div class="col-md-6">
									</div>
								</div>
							</div>
							<table  id="table-filter" class="table table-striped table-bordered table-hover ">
							</table>
							<!-- <table id="default-table" class="table table-striped table-bordered table-hover" id="table_sppr">
               <thead>
                    <tr>
                        <th> NO SPPr </th>
                        <th> Customer </th>
												<th> Order Date </th>
                        <th> Delivery Date </th>
												<th> Status </th>
                        <th> Detail Project </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table> -->
							<!-- /END TABLE -->
						</div>
						<!-- /END BODY PORTLET -->
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
<!-- END CONTENT -->
<?php } else {
	echo "You dont have an Access to this page!!";
}?>
<!-- BEGIN QUICK SIDEBAR -->
<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php $this->load->view('include/footer') ?>;
<!-- END FOOTER -->
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
        <button type="button" onclick="cancel(0)" class="btn yellow btn-approve">Cancel</button>
				<?php if($_SESSION['level']=='kabag'){ ?>
				<button type="button" onclick="approve(0)" class="btn green btn-approve">Approve</button>
			<?php } ?>
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
<script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'?>"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url().'assets/admin/pages/scripts/form-samples.js'?>"></script>
<script>
var $table='';
	jQuery(document).ready(function() {
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	FormSamples.init();

	$('.datepicker').datepicker({
		autoclose: true,
		format: 'yyyy-mm-dd',
	});
	$('#bum').addClass('active open');
	$('#list_bum_approved').parent().addClass('active');

	$("#form-filter").submit();
	//dataTables
		// var url='<?php echo site_url().'/marketing/get_sppr'?>';
		// 	$table=$('#table_sppr').DataTable( {
		// 	"ajax":
		// 	{
		// 			"url": url,
		// 			"type": "POST",
		// 			"retrieve": true,
		// 			keys: true,
		// 	},
		// });
	});
</script>

<script>

function reload_table()
{
  $("#form-filter").submit();
}

function cancel(id_po_master){

  if(id_po_master==0){
    id_po_master=$('[name="id_po_master"]').val();
  }

  console.log('ID :'+id_po_master);
	bootbox.confirm({
    message: "Are you sure want cancel ?",
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
					var url='<?php echo site_url().'/po/cancel_po/'?>'+id_po_master;
					$.ajax({
							url : url,
							type: "POST",
							// data: formdata,
							processData: false,
							contentType: false,
							dataType: "JSON",
							success: function(data)
							{
								Metronic.stopPageLoading();
								$("#form-filter").submit();
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

$("#form-filter").submit(function(event){
	event.preventDefault();
	Metronic.startPageLoading({animate: true});
	// ajax adding data to database
	var formData = new FormData($("form#form-filter")[0]);
	$.ajax({
		url: "<?php echo site_url('bum/get_bum_approved'); ?>",
		type: 'POST',
		data: formData,
		dataType: "JSON",
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(data) {
			Metronic.stopPageLoading();
			var table='';
				table=$('#table-filter').dataTable( {
					"bDestroy": true,
					data: data.data,
	        columns: [
						{ title: "PO NO" },
            { title: "BUM PO" },
						{ title: "Di Buat Oleh" },
						{ title: "Description" },
						{ title: "Lama Hari" },
						{ title: "Nominal" },
            { title: "Tangal awal" },
						{ title: "Tanggal Akhir" },
            { title: "Approve By"},
            { title: "Approve Date"},
            { title: "Status"},
						{ title: "Action" }

	        ],
          columnDefs: [
              { type: 'date-yyyy-mmm-dd', targets: 5 },
							{ "width": "25%", "targets": 4 },
         ],
          dom : "<'row'<'col-sm-2'l><'col-sm-6'><'col-sm-4'f>>"+'rtip',
					// dom: 'lBrtip',
					// buttons: [
					// 		'copy', 'csv', 'excel', 'pdf', 'print'
					// ],
          buttons: {
          buttons: [
                { extend: 'copy', text: '<i class="fa fa-files-o" aria-hidden="true"></i> Copy', className: 'btn btn-circle blue-chambray' },
                { extend: 'excel',text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel', className: 'btn btn-circle blue-chambray' },
                { extend: 'csv',text: '<i class="fa fa-file-code-o" aria-hidden="true"></i> CSV', className: 'btn btn-circle blue-chambray' },
                { extend: 'pdf',text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF', className: 'btn btn-circle blue-chambray' },
                { extend: 'print',text: '<i class="fa fa-print" aria-hidden="true"></i> Print', className: 'btn btn-circle blue-chambray' },
            ]
          },
				});
		},
		error: function(jqXHR, textStatus, errorThrown) {
			Metronic.stopPageLoading();
			alert('Error saving data ');
		}
	});
});

function reset_form()
{
  $('form#form-filter')[0].reset(); // reset form on modals
	$("#form-filter").submit();
}

function approve(id_bum)
{
  // if(id_po_master==0){
  //   id_po_master=$('[name="id_po_master"]').val();
  // }
	bootbox.confirm({
		message: "Are you sure want approve BPMB with id "+id_bum+" ?",
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
					var url='<?php echo site_url().'/bum/approve_bum/'?>'+id_bum;
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
								$("#form-filter").submit();
                $("#detail-bpmb").modal('hide');
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

//show material
function show_material(id_material)
{
	Metronic.startPageLoading({animate: true});
	console.log('selected : '+id_material);
	var url='<?php echo site_url().'/ppc/get_material_by_id/'?>'+id_material;
	$.ajax({
			url : url,
			type: "POST",
			// data: {'id_bpmb': id_bpmb},
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				var input=['id_material', 'id_dkp', 'material_dec', 'material_name','unit', 'weight', 'qty_budget', 'basic_price_budget', 'remarks'];
				for(var i=0; i < input.length-1; i++){
					$('[name="'+input[i]+'"]').val(data.data[i]);
				}
				Metronic.stopPageLoading();
				$("#material").modal('show');

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

function edit_pr(pr_no)
{
  $(".edit_view_pr").modal('show');
  // $("#detail-bpmb").modal('show');

  console.log('No PR : '+ pr_no);
  Metronic.startPageLoading({animate: true});
  $('.isi-table').html('');
  var formdata_ = new FormData($("#form_bpmb")[0]); //get data
  $.ajax({
      url : '<?php echo site_url().'/ppc/edit_pr/'?>'+pr_no,
      type: "POST",
      // data: {'id_item': id,'colom':colom, 'table': table},
      data: formdata_,
      processData: false,
      contentType: false,
      dataType: "JSON",
      success: function(data)
      {
        var isi='';
        for (var i = 0; i < data.table.length; i++) {
          isi+='<tr>';
          for (var j = 0; j < data.table[i].length; j++) {
           isi+='<td>';
           isi+=data.table[i][j];
           isi+='</td>';
          }
          isi+='</td>';
        }
        // $("#material").modal('show');
        $('.isi-table').html(isi);
        $('[name="no_sppr_bpmb"]').val(data.material_no[1]);
        $('[name="material_id"]').val(data.material_no[2]);
        $('#bpmb-tab td:nth-child(1)').hide();
        $('[name="dkp_id_bpmb"]').val(data.dkp[0]);
        $('[name="dkp_no"]').val(data.dkp[1]);
        $('[name="pr_no"]').val(data.detail[0]);
        $('[name="name_proj"]').val(data.detail[1]);
        $('[name="create_date"]').val(data.detail[2]);
        $('[name="nama_project"]').val(data.title);

        // console.log(data);
        //date datepicker
        $('.datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd',
        });

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

function save_pr_edited()
{
  $('.help-block').removeClass('has-error'); // clear error class
   $('.help-block').empty(); // clear error string
  Metronic.startPageLoading({animate: true});
   var pr_no=$('[name="pr_no"]').val();
  if(pr_no==''){
    Metronic.stopPageLoading();
    bootbox.alert({
      title: '<p class="text-danger">Error</p>',
      message: 'Error BPMB NO cannot empty',
    });
    return;
  }
  // $('.isi-table').html('');
  var formd = new FormData($("#form-edit_pr")[0]); //get data
  $.ajax({
      url : '<?php echo site_url().'/ppc/save_pr_edited'?>',
      type: "POST",
      // data: {'id_item': id,'colom':colom, 'table': table},
      data: formd,
      processData: false,
      contentType: false,
      dataType: "JSON",
      success: function(data)
      {
        if(data.status){
          Metronic.stopPageLoading();
          $(".edit_view_pr").modal('hide');
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
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
