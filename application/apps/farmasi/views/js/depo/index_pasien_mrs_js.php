<script type="text/javascript">
	$(function(){
		tab(0);
	})

	$('#dtg-pasien_mrs').datagrid({
		singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            tab(1)
            load_detail(row)
        },
        columns:[[
            {field:'no_mr',title:'No. RM',width:"20%",halign:'center',align:'left'},
            {field:'nama_pasien',title:'Nama Pasien',width:"35%",halign:'center',align:'left'},
        ]],
	})

	function tab(tab){
		if(tab==0){
			filter();
			$('#browse').show();
			$('#detail').hide();
			$('#dtg-pasien_mrs').datagrid('resize');
		}
		else{
			
			$('#browse').hide();
			$('#detail').show();
		}
	}

	function filter() {
		data={
          criteria : $('#txt-criteria').val(),
          page:1,
          page_row:10
        }
        var dg = $('#dtg-pasien_mrs').datagrid({
          url : "<?php echo base_url("farmasi/depo/Index_pasien_mrs/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.data ? data.data : []
            }
          }
        });
	}

	function load_detail(row) {
		$('#txt-nama_pasien').val(row.nama_pasien);
		$('#txt-no_rm').val(row.no_mr);
		data={
          no_mr : row.no_mr,
          type:1
        }

        var dg = $('#dtg-detail_item').datagrid({
          url : "<?php echo base_url("farmasi/depo/Index_pasien_mrs/load_detail"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.data ? data.data : []
            }
          }
        });
	}

	function cetak() {
		$('#loader').css('display','');

		data={
          no_mr : $('#txt-no_rm').val(),
          nama_pasien : $('#txt-nama_pasien').val(),
          type:2
        }

		$.ajax({
	        url     : "<?= base_url() ?>farmasi/depo/Index_pasien_mrs/cetak",
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	        if (data.success === true) {
	          $('#loader').css('display','none');
	            var file_cetak ='Laporan Index Pasien MRS.pdf';
	            $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
	            $("#modal_preview").modal("show");
	          }
	     	},
	     	fail: function (e) {  
		        $('#loader').css('display','none');
			},
			error: function(jqXHR, textStatus, errorThrown){
              $('#loader').css('display','none');
              notif('info','Tidak Ada Data');
          	}
	    });
	}
</script>