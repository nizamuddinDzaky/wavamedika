<script type="text/javascript">
	$(function(){
        // set_form();
        $('#btn-cari_supplier').click(function(event) {
			$('#win-cari_supplier').window('open');
			filter_supplier();
		});
	})

	function filter_supplier(){
    	$('#dtg-supplier').datagrid('loadData', []);

        let criteria = $('#txt-kriteria_supplier').val();
        data = {
			criteria:criteria,
			page    : 1,
			page_row: 10,
        }

        var dg = $('#dtg-supplier').datagrid({
			url        : "<?php echo base_url("general/laporan/Outstanding_po_general/filter_supplier"); ?>",
			method     : "POST",
			queryParams: data,
			loadFilter : function(data) {
            return {
				total: data.paging ? data.paging.rec_count : 0, 
				rows : data.data ? data.data : []
            }
          }
        });
    }

	function tutup(){
		$('#win-cari_supplier').window('close');
	}

	function pilih_supplier() {
		var row = $('#dtg-supplier').datagrid('getSelected');
		if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }
        $('#txt-nama_supplier').val(row.partner_name)
        $('#src-supplier').val(row.partner_name)
		$('#id-supplier').val(row.partner_id)
		tutup();
	}

	function filter() {
		$('#dg-outstanding-po-farmasi').datagrid('loadData',[]);
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var partner_id	 = $('#id-supplier').val();
		var year_period;
		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		data={
			partner_id	: partner_id,
			buffer      : false,
			rpt_period  : tipe,
			rpt_type    : 1,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			page        : 1,
			page_row    : 10,
		}

		var dg = $('#dg-outstanding-po-farmasi').datagrid({
			url : "<?php echo base_url("general/laporan/Outstanding_po_general/filter"); ?>",
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

	$(".change").change(function(){
			console.log('asd')
			// alert("The text has been changed.");
			set_form();
		});

	function set_form()
	{
		// body...
		/*var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();*/
		var rpt_period   = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		/*var rpt_group 	 = $('#cmb-jenis').val();*/
		var partner_id	 = $('#id-supplier').val();
		// var cb_unit = 		$('input[type="checkbox"]').prop("checked");
		var rpt_type     = 2;
		
		var type_file    = 2; // 2 adalah excel
		
		var buffer       = true;

  	 	var year_period;

		if(rpt_type==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		/*if (!cb_unit) {
			id_unit = 0
		}else{
			id_unit = $('#cmb-unit').val()
		}*/

		var url_control = "<?= base_url() ?>general/laporan/Outstanding_po_general/cetak";

		$('#type_file').val(type_file);
		$('#buffer').val(buffer);
		$('#rpt_type').val(rpt_type);
		$('#rpt_period').val(rpt_period);
		$('#start_date').val(start_date);
		$('#end_date').val(end_date);
		$('#month_period').val(month_period);
		$('#year_period').val(year_period);
		$('#year_period_text').val(year_period);
		$('#file_name').val('Outstanding_po_general');
		/*$('#rpt_group').val(rpt_group);*/
		$('#partner_id').val(partner_id);
		/*$('#id_unit').val(id_unit);*/

		$('#form_excel').attr('action', url_control);
	}

	function export_excel()
	{
		$('#loader').css('display','');
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var file_name	= $('#file_name').val();
		var partner_id 	 = $('#partner_id').val();
		
		var year_period;
		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		data={
			buffer      : false,
			rpt_period  : tipe,
			rpt_type    : 2,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			year_period_text: year_period,
			partner_id 	: partner_id,
			page        : 1,
			page_row    : 10,
			type_file	: 2,
			file_name : file_name
		}

		$.ajax({
	        url     : "<?= base_url() ?>general/laporan/Outstanding_po_general/check_data",
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	     		$('#form_excel').submit();
	     		$('#loader').css('display','none');
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

	function cetak(){
    	$('#loader').css('display','');
    	var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var partner_id 	 = $('#id-supplier').val();
		
		var year_period;
		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		data={
			buffer      : false,
			rpt_period  : tipe,
			rpt_type    : 2,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			year_period_text: year_period,
			partner_id 	: partner_id,
			page        : 1,
			page_row    : 10,
			type_file	: 1,
			file_name 	: 'Outstanding_po_general.pdf'
		}

        $.ajax({
            url     :  "<?php echo base_url("general/laporan/Outstanding_po_general/cetak"); ?>",
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
</script>