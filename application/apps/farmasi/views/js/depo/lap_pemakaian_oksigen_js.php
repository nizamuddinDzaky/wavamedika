<script type="text/javascript">
	$(function(){
		get_select();
		set_form();
		$('#cmb-unit').select2({
			placeholder:'Pilih Unit'
		})
	})

	$(".change").change(function(){
		// alert("The text has been changed.");
		set_form();
	});

	$('#dtg-pemakaian_oksigen').datagrid({
		singleSelect:true,
		idField:'itemid',
		onDblClickRow:function(index,row){
			// btn_ubah();
		},
		columns:[[
			{field:'no_nota',title:'No. Nota',width:"13%",halign:'center',align:'center'},
			{field:'tgl_nota',title:'Tanggal',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
			{field:'unit_asal',title:'Unit Asal',width:"20%",halign:'center',align:'left'},
			{field:'unit_tujuan',title:'Unit Tujuan',width:"20%",halign:'center',align:'left'},
			{field:'id_mrs',title:'Billing',width:"13%",halign:'center',align:'center'},
			{field:'no_mr',title:'No. MR',width:"10%",halign:'center',align:'center'},
			{field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
			{field:'nama_dokter',title:'Nama Dokter',width:"25%",halign:'center',align:'left'},
        	{field:'kelas_kamar',title:'Nama Kamar',width:"20%",halign:'center',align:'left'},
        	{field:'nama_kel_item',title:'Jenis',width:"10%",halign:'center',align:'center'},
        	{field:'nama_item',title:'Nama Obat/Alkes',width:"18%",halign:'center',align:'left'},
        	{field:'skala',title:'Skala',width:"10%",halign:'center',align:'center'},
        	{field:'jml_menit',title:'Jml. Menit Pemakaian',width:"15%",halign:'center',align:'center'},
        	{field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
        	{field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'center'},
        	{field:'harga',title:'Harga',width:"13%",halign:'center',align:'right', formatter: formatIndo},
        	{field:'sub_total',title:'Sub Total',width:"13%",halign:'center',align:'right', formatter: formatIndo},
		]],
	});

	function get_select(){
		$.ajax({
	        url : "<?php echo base_url("farmasi/depo/Lap_pemakaian_oksigen/get_unit"); ?>",
	        type: "POST",
	        dataType: 'json',
	        beforeSend: function (){               
	        },
	        success:function(data, textStatus, jqXHR){
	           	$("#cmb-unit").select2({
	           		// dropdownParent: $('#win'),
	           		data: data
	       		});
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	            swal.fire('Error', 'something goes wrong', 'error');
	        },
	        complete: function(){
	        }
	    });
	}

	function filter() {
		$('#dtg-pemakaian_oksigen').datagrid('loadData',[]);
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var id_unit      = $('#cmb-unit option:selected').val();
		
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
			id_unit		: id_unit,
			page        : 1,
			page_row    : 90
		}

		var dg = $('#dtg-pemakaian_oksigen').datagrid({
			url : "<?php echo base_url("farmasi/depo/Lap_pemakaian_oksigen/filter"); ?>",
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

	function export_excel(){
		$('#loader').css('display','');
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var id_unit      = $('#cmb-unit option:selected').val();
		var nama_unit      = $('#cmb-unit option:selected').text();
		
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
			id_unit		: id_unit,
			page        : 1,
			page_row    : 90,
			type_file	: 2,
			nama_unit : nama_unit
		}

		$.ajax({
	        url     : "<?= base_url() ?>farmasi/depo/Lap_pemakaian_oksigen/check_data",
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

	function set_form(){
		// body...
		/*var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();*/
		var rpt_period   = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var id_unit      = $('#cmb-unit option:selected').val();
		var nama_unit      = $('#cmb-unit option:selected').text();
		
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

		var url_control = "<?= base_url() ?>farmasi/depo/Lap_pemakaian_oksigen/cetak";

		$('#type_file').val(type_file);
		$('#buffer').val(buffer);
		$('#rpt_type').val(rpt_type);
		$('#rpt_period').val(rpt_period);
		$('#start_date').val(start_date);
		$('#end_date').val(end_date);
		$('#month_period').val(month_period);
		$('#year_period').val(year_period);
		$('#year_period_text').val(year_period);
		$('#id_unit').val(id_unit);
		$('#nama_unit').val(nama_unit);

		$('#form_excel').attr('action', url_control);
	}
</script>