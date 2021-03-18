<script type="text/javascript">
	$(function(){
		set_form()
	})

	function filter() {
		$('#dtg1').datagrid('loadData',[]);
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		
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
			rpt_type    : 1,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			page        : 1,
			page_row    : 10
		}

		var dg = $('#dtg1').datagrid({
			url : "<?php echo base_url("farmasi/gudang/Lap_pembelian_non_formularium/filter"); ?>",
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

	function set_form()
	{
		// body...
		/*var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();*/
		var rpt_period   = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		
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

		var url_control = "<?= base_url() ?>farmasi/gudang/Lap_pembelian_non_formularium/cetak";

		$('#type_file').val(type_file);
		$('#buffer').val(buffer);
		$('#rpt_type').val(rpt_type);
		$('#rpt_period').val(rpt_period);
		$('#start_date').val(start_date);
		$('#end_date').val(end_date);
		$('#month_period').val(month_period);
		$('#year_period').val(year_period);
		$('#year_period_text').val(year_period);
		/*$('#id_unit').val(id_unit);*/

		$('#form_excel').attr('action', url_control);
	}

	$(".change").change(function(){
		// alert("The text has been changed.");
		set_form();
	});

	function export_excel()
	{
		$('#loader').css('display','');
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		/*var id_unit_asal = $('#cmb-unit_asal').val();
		var id_unit_tujuan = $('#cmb-unit_tujuan').val();
		var name_unit_asal = $('#cmb-unit_asal option:selected').text();
		var name_unit_tujuan = $('#cmb-unit_tujuan option:selected').text();*/
		
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
			/*id_unit_asal : id_unit_asal,
			id_unit_tujuan : id_unit_tujuan,
			name_unit_asal : name_unit_asal,
			name_unit_tujuan : name_unit_tujuan,*/
			page        : 1,
			page_row    : 10,
			type_file	: 2
		}

		$.ajax({
	        url     : "<?= base_url() ?>farmasi/gudang/Lap_pembelian_non_formularium/check_data",
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
</script>