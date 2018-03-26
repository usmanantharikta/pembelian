function get_data_master()
{
  var id_po_master=$('[name="id_po"]').val();
  var url_depan=$('[name="id_po"]').data('option');
  Metronic.startPageLoading({animate: true});
	// console.log('id pr : '+id_pr);
	$.ajax({
			url : url_depan+id_po_master,
			type: "POST",
			// data: {'id_item': id,'colom':colom, 'table': table},
			// data: formd,
			// processData: false,
			// contentType: false,
			dataType: "JSON",
			success: function(data)
			{
				Metronic.stopPageLoading();
				//list files
				$('#files-list').html(' ');
				var table_body='';
				if(data.files.length!=0){
					for(var i=0; i<data.files.length; i++){
						var link="'"+data.files[i][1]+"'";
						table_body+='<tr>';
						table_body+='<td><a target="_blank" onclick="download_file('+link+')">'+data.files[i][0]+'</a></td>';
						table_body+='<td><a class="btn btn-danger" onclick="delete_file('+link+')">Delete</a></td></tr>';
					}
					// console.log(table_body);
					$('#files-list').append(table_body);
					$('.list-file').removeClass('hide');
				}else{
					// $('.list-file').addClass('hide');
				}

				var gin=['po_no', 'date_po', 'ppn', 'total', 'date_sent', 'import_id', 'etd', 'eta', 'remarks_po', 'include_price', 'reference', 'requ'];

				var top=['detail_dp', 'nominal_dp', 'detail_termin', 'nominal_termin', 'detail_pelunasan', 'nominal_pelunasan'];

				for (var i = 0; i < gin.length; i++) {
          if(data.gi[i]!=null){
					       $('[name="'+gin[i]+'"]').val(data.gi[i]);
          }
				}

				for (var i = 0; i < data.top.length; i++) {
						var tr='<tr> <td>'+data.top[i][1].toUpperCase()+'</td>';
						tr+='<td> '+data.top[i][2]+'</td>';
						tr+='<td> '+data.top[i][3]+'</td>';
						tr+='<td> '+data.top[i][4]+'</td>';
						if(data.top[i][1]=='COD'){
						tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_top('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
						}
						else if (data.top[i][1]=='CIA-BUM') {
							tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_bum('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
						}
						else if (data.top[i][1]=='TERMINJ' || data.top[i][1]=='DP' ) {
							tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_dp('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
						}
						else{
							tr+='<td> <a class="btn btn-danger btn-delete" onclick="delete_top('+data.top[i][0]+')"><i class="fa fa-trash"></i></a></td>';
						}
						tr+='</tr>';
						$('#tbody').append(tr);

				}

				$('.btn-delete').click(function(){
					console.log('sdsds');
					$(this).parent().parent().remove();
				});

        var din=['reference', 'include_price', 'etd', 'eta', 'teop', 'remarks_po', 'requ'];

        // for (var i = 0; i < din.length; i++) {
          if(data.di!=null){
          // $('[name="'+din[i]+'"]').val(data.di[i]);
          $('[name="import"]').attr("checked", true);
          $('[name="import"]').parent('span').addClass('checked');
          }
        // }

				var sl=['code_supplier', 'id_alamat', 'cur_id'];
			         for (var i = 0; i < sl.length; i++) {
			           if(data.sd[i]!=null){
			           $('[name="'+sl[i]+'"]').val(data.sd[i]).trigger('change');
			           }
			         }
			 					$('[name="nama_supplier"]').val(data.supp[0].supplier_name);
			 					$('[name="contact_name"]').val(data.supp[0].contact_name);
			 					$('[name="telp"]').val(data.supp[0].telp);
			 					$('[name="fax"]').val(data.supp[0].fax);




			 				// $("[name='id_po_detail']").val(id_po_detail);
			 				// $("[name='id_pr_detail']").val(id_pr);
			 				// $("#draggable").modal('show');
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

function download_file(link){
   window.location.href='http://'+document.location.host+'/pembelian/po/download?data='+link;
}

$(document).ready(function(){
  var type_po=$('[name="type_po"]');
  type_po.change(function(){
    console.log('type selected :'+$(this).val());
    if(type_po!=0){
      calculate_no_po($(this).val());
    }
  })
});

function calculate_no_po(type){
  console.log('type :'+type);
  $.ajax({
      url : 'http://192.168.25.3/pembelian/po/get_po_no/'+type, // calculate ID BUM
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="po_no"]').val(data.no);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error, Please select one');
      }
  })
}
