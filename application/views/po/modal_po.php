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
							<div class="col-md-4 col-lg-4 col-sm-4">
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
							<div class="col-md-4 col-lg-4 col-sm-4">
								<div class="col-md-12">
                  <p class="a_alamat"></p>
                </div>
						</div>

            <!-- end alamat -->
            <div class="col-md-4 col-lg-4 col-sm-4">
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
                  <label class="control-label col-md-6"> Term of Payment : </label>
                  <div class="col-md-6">
                    <p class="form-control-static top">
                      TOP
                    </p>
                  </div>
                </div>
              </div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label col-md-6"> File Attch : </label>
									<div class="col-md-6" style="padding-left: 0px;">
										<ol class="files" style="padding-left: 30px;">
										</ol>
									</div>
								</div>
							</div>
            </div>
            <div class="col-md-6 text-right">
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

<script type="text/javascript">
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
          "dom": 'tr',
          "drawCallback": function( settings ) {
            Metronic.init(); // init metronic core components
            $(".over_po").parent().parent().addClass('danger');
            $(".expensive_po").parent().parent().addClass('warning');
            }
        });

        $('.modal-title').text('PO NO : '+data.master.po_no);
        $('.s_supplier_name').text(data.supplier.supplier_name)
        $('.s_contact_name').text(data.supplier.contact_name);
        $('.s_telp').text(data.supplier.telp);
        $('.s_fax').text(data.supplier.fax);

        $('.a_alamat').text(data.alamat);

        $('.top').text(data.top);

        $('.m_date_po').text(data.master.date_po);
        $('.m_date_sent').text(data.master.date_sent);

        $('.tot_before').text(data.master.cur_id+" "+numeral(data.tot_harga).format('0,0.00'));
        $('.m_ppn').text(data.master.cur_id+" "+numeral(data.master.ppn).format('0,0.00'));
        $('.m_tot_after').text(data.master.cur_id+" "+numeral(data.master.total).format('0,0.00'));
        $('.m_pph').text(data.master.cur_id+" "+numeral(data.master.pph).format('0,0.00'));

        $('[name="id_po_master"]').val(data.master.id_po_master);

				//to $list_file
				var li='';
				if(data.list_file.length!=0){
					for (var i = 0; i < data.list_file.length; i++) {
						li+='<li><a href="<?php echo site_url('/po/download'); ?>?data='+data.list_file[i][1]+'">'+data.list_file[i][0]+'</a></li>';
					}
					$(".files").append(li);
				}



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
</script>
