<script type="text/javascript">
	$(function(){
		getSupplier()
		$('#cmb-unit').select2({
			placeholder:'Pilih Unit'
		}).change(function function_name() {
			filter()
		})
	})

	function getSupplier(){
      	$.ajax({
			url     : "<?php echo base_url("farmasi/gudang/Lap_persediaan/getSupplier"); ?>",
			type    : "POST",
			dataType: 'json',
          	beforeSend: function (){               
          	},
          	success:function(data, textStatus, jqXHR){
             	$("#cmb-unit").select2({ data: data }).change();
          	},
          	error: function(jqXHR, textStatus, errorThrown){
              	notif('error','Error,something goes wrong');
          	},
          	complete: function(){
          	}
      	});
    }

    function filter(){
        // var dg = $('#dtg-retur_pembelian').datagrid('loadData', []);
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
      	var end_date = toAPIDateFormat($('#dtb-end_date').val());
        data= {
			start_date: start_date,
			end_date  : end_date,
			id_unit   :$("#cmb-unit").val(),
			criteria  :$('#txt-criteria').val(),
        }

        var dg = $('#dtg-lap_persediaan').datagrid({
			url        : "<?php echo base_url("farmasi/gudang/Lap_persediaan/filter"); ?>",
			method     : "POST",
			queryParams: data,
          	loadFilter: function(data) {
            	return {
              		total: data.paging ? data.paging.rec_count : 0, 
              		rows: data.data ? data.data : []
           		}
          	}
        });
    }

    function cetak(){
    	$('#loader').css('display','');
    	var start_date = toAPIDateFormat($('#dtb-start_date').val());
      	var end_date = toAPIDateFormat($('#dtb-end_date').val());
        data= {
			start_date: start_date,
			end_date  : end_date,
			id_unit   :$("#cmb-unit").val(),
			criteria  :$('#txt-criteria').val(),
			type_file : 1,
			file_name : 'Lap_persediaan.pdf'
        }

        $.ajax({
            url     :  "<?php echo base_url("farmasi/gudang/Lap_persediaan/cetakPDF"); ?>",
            type    : "POST",
            dataType: 'json',   
            data    : data,
          	success:function(data, textStatus, jqXHR){
            	if (data.success === true) {
              		$('#loader').css('display','none');
                	$("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/file/"+data.file_name)
                	$("#form_file_surat_detail").modal("show");
              	}
          	},
          	error: function(jqXHR, textStatus, errorThrown){
              	notif('info','Tidak Ada Data');
              	$('#loader').css('display','none');
            },
          	fail: function (e) {
            	console.log('fail');    
            	$('#loader').css('display','none');
         	}
        });
    }

    function export_excel(){
    	var start_date = toAPIDateFormat($('#dtb-start_date').val());
      	var end_date = toAPIDateFormat($('#dtb-end_date').val());
        $('body').append($('<form/>')
        .attr({'action': ""+"<?= base_url() ?>farmasi/gudang/Lap_persediaan/cetakPDF"+"", 'method': 'POST', 'id': 'replacer'})
        
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'start_date', 'value': ""+ start_date+""})
        )
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'end_date', 'value': ""+ end_date+""})
        )
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'id_unit', 'value': ""+$("#cmb-unit").val()+""})
        ) 
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'criteria', 'value':  ""+$('#txt-criteria').val()+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'type_file', 'value':  ""+ 2+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'file_name', 'value':  ""+ 'Lap_persediaan.pdf'+""})
        )
        /*.append($('<input/>')
          .attr({'type': 'hidden', 'name': 'file_name', 'value':  ""+'DAFTAR HARGA JUAL FARMASI.pdf'+""})
        ) */
     
        ).find('#replacer').submit();

        setInterval(function(){
            window.location.reload();
        }, 3000);
    }
</script>