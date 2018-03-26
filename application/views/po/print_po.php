<!DOCTYPE html>
<html lang="en">
<head>
  <title>Purchase Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<input type="hidden" name="id_po_master" value="<?php if(isset($id_po_master))echo $id_po_master; ?>">
<div class="container">
  <h2 id="po_no" style="text-align:right">0032131</h2>
<div class="row">
  <div class="col-xs-4">
    <div class="col-xs-12">
          <p class="form-control-static d_nomer">
            <b class="s_supplier_name"> </b>
          </p>
    </div>
  <div class="col-xs-12">
    <div class="form-group">
      <label style="text-align:left" class="control-label col-xs-5">Attn : </label>
      <div class="col-xs-7">
        <p class="form-control-static s_contact_name">
          BPMB00001
        </p>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="form-group">
      <label style="text-align:left"  class="control-label col-xs-5">Tel  : </label>
      <div class="col-xs-7">
        <p class="form-control-static s_telp">
          BPMB00001
        </p>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="form-group">
      <label style="text-align:left"  class="control-label col-xs-5">Fax : </label>
      <div class="col-xs-7">
        <p class="form-control-static s_fax">
          BPMB00001
        </p>
      </div>
    </div>
  </div>
  </div>
  <!-- end supp -->
  <div class="col-xs-4">
    <div class="col-xs-12">
      <p class="a_alamat"></p>
    </div>
</div>

<!-- end alamat -->
<div class="col-xs-4">
  <div class="col-xs-12">
    <div class="form-group">
      <label class="control-label col-xs-4">Tgl PO : </label>
      <div class="col-xs-8">
        <p class="form-control-static m_date_po">
          sadas
        </p>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="form-group">
      <label class="control-label col-xs-4">Tgl Kirim : </label>
      <div class="col-xs-8">
        <p class="form-control-static m_date_sent">
          sadas
        </p>
      </div>
    </div>
  </div>
</div>

<div class="col-xs-12">
  <table  id="table-item" class="table table-striped table-bordered table-hover ">
  </table>
</div>

<div class="col-md-6">
  <div class="col-xs-12">
    <div class="form-group">
      <label class="control-label col-xs-4"> Total sblm PPN: </label>
      <div class="col-xs-8">
        <p class="form-control-static tot_before">
          sadas
        </p>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="form-group">
      <label class="control-label col-xs-4">PPN: </label>
      <div class="col-xs-8">
        <p class="form-control-static m_ppn">
          sadas
        </p>
      </div>
    </div>
  </div>
  <div class="col-xs-12">
    <div class="form-group">
      <label class="control-label col-xs-4">Total Akhir </label>
      <div class="col-xs-8">
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
(function() {
    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };
    var afterPrint = function() {
        console.log('Functionality to run after printing');
    };
    var count=0;
    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
                count+=1;
                console.log("lalal"+count);
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;
}());

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
	$('#po').addClass('active open');
	$('#list_po_approved').parent().addClass('active');

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

  $(document).ready(function(){
    var id=$('[name="id_po_master"]').val();
    console.log('id nya : '+id);
    show_po(id);
  });

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
  						{ title: "Tot Price" },
  					],
  					"dom": 'tr'
  				});

          $('.modal-title').text('PO NO : '+data.master.po_no+' R'+data.master.print_count);
          $('.s_supplier_name').text(data.supplier.supplier_name)
          $('.s_contact_name').text(data.supplier.contact_name);
          $('.s_telp').text(data.supplier.telp);
          $('.s_fax').text(data.supplier.fax);

          $('.a_alamat').text(data.alamat);

          $('.m_date_po').text(data.master.date_po);
          $('.m_date_sent').text(data.master.date_sent);

          $('.tot_before').text(data.master.cur_id+" :"+data.tot_harga);
          $('.m_ppn').text(data.master.cur_id+" :"+data.master.ppn);
          $('.m_tot_after').text(data.master.cur_id+" :"+data.master.total);
          $('#po_no').text(data.master.po_no+' R'+data.master.print_count);

          $('[name="id_po_master"]').val(data.master.id_po_master);

          //
  				// var col=['nomer', 'sppr-no', 'project', 'title'];
  				// for (var i = 0; i < col.length; i++) {
  				// 	$(".d_"+col[i]).text(data.detail[i]);
  				// }
  				// $('[name="pr_no"]').val(data.detail[0]);
  				// $("#detail-bpmb").modal('show');
          // if(data.detail[data.detail.length-1]=='cancel')
          // {
          //   $(".btn-approve").hide();
          // }
   				Metronic.stopPageLoading();
          window.print();
          window.location='<?php echo site_url().'po/list_po_approved';?>';
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
</body>
</html>
