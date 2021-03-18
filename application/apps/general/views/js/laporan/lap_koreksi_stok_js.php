<script type="text/javascript">
	var tabel_utama="#dtg1";
	$(function(){
		$('#tbl1').show();
		$('#tbl2').hide();
		$('#tbl3').hide();
		get_select()
		$('#cmb-jenis_laporan').change(function(argument) {
			table_pilihan($(this).val());
        });
        $('#cmb-unit').select2({
        	placeholder:'Pilih Unit/Depo',
        })
        set_form();

        $('#dtg1').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onExpandRow: function(index,row){
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'tgl_so_det',title:'Tanggal',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
			            {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'center'},
			            {field:'jml_sistem',title:'Jml. Sistem',width:"10%",halign:'center',align:'right', formatter: appGridNumberFormatter},
			            {field:'jml_fisik',title:'Jml. Fisik',width:"10%",halign:'center',align:'right', formatter: appGridNumberFormatter},
			            {field:'jml_selisih',title:'Jml. Selisih',width:"10%",halign:'center',align:'right', formatter: appGridNumberFormatter},
			            {field:'nama_ket_selisih',title:'Keterangan',width:"20%",halign:'center',align:'left'},
			            {field:'user_fullname',title:'User Insert',width:"12%",halign:'center',align:'center'},
	                ]],
	                onResize:function(){
	                    $('#dtg1').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg1').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg1').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg3').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onExpandRow: function(index,row){
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'periode',title:'Periode',width:"12%",halign:'center',align:'left'},
			            {field:'no_so',title:'No. SO',width:"12%",halign:'center',align:'left'},
			            {field:'jml_sistem',title:'Jml. Sistem',width:"12%",halign:'center',align:'left', formatter: appGridNumberFormatter},
			            {field:'jml_fisik',title:'Jml. Fisik',width:"12%",halign:'center',align:'right', formatter: appGridNumberFormatter},
			            {field:'jml_selisih_lebih',title:'Selisih SO Lebih',width:"12%",halign:'center',align:'right', formatter: appGridNumberFormatter},
			            {field:'jml_selisih_kurang',title:'Selisih SO Kurang',width:"12%",halign:'center',align:'right', formatter: appGridNumberFormatter},
			            {field:'hpp',title:'HPP',width:"10%",halign:'center',align:'center', formatter: appGridNumberFormatter},
			            {field:'nama_ket_selisih',title:'Keterangan',width:"20%",halign:'center',align:'center'},
			            {field:'user_fullname',title:'User',width:"12%",halign:'center',align:'center'},
			            {field:'tgl_so_det',title:'Tgl. SO',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
	                ]],
	                onResize:function(){
	                    $('#dtg1').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg1').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg1').datagrid('fixDetailRowHeight',index);
            }
        });
	})

	$(".change").change(function(){
		// alert("The text has been changed.");
		set_form();
	});


	function table_pilihan(id){

		var id_baru;
		if(id=="so_nota")
		{
			id_baru = 1;
		}
		else if(id=="so_item")
		{
			id_baru = 2;
		}
		else if(id=="so_rekap")
		{
			id_baru = 3;
		}

		$('#tbl1').hide();
		$('#tbl2').hide();
		$('#tbl3').hide();

		var showed='#tbl'+id_baru;
		tabel_utama = '#dtg'+id_baru;
		$(showed).show();
	}

	function filter() {
		$(tabel_utama).datagrid('loadData',[]);
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var cb_unit = 		$('input[type="checkbox"]').prop("checked");
		var year_period;

		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		if (!cb_unit) {
			id_unit = 0
		}else{
			id_unit = $('#cmb-unit').val()
		}

		console.log(cb_unit);

		data={
			url         : url,
			jns_laporan : jns_laporan,
			buffer      : false,
			rpt_period  : tipe,
			rpt_type    : 1,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			id_unit : id_unit,
			page        : 1,
			page_row    : 10
		}

		var dg = $(tabel_utama).datagrid({
			url : "<?php echo base_url("general/laporan/Lap_koreksi_stok/filter"); ?>",
			method: "POST",
			queryParams: data,
			loadFilter: function(data) {
			console.log(data);
			  return {
			    total: data.paging ? data.paging.rec_count : 0, 
			    rows: data.data ? data.data : []
			  }
			}
		});
	}

	function cetak() {
		$('#loader').css('display','');

		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var cb_unit = 		$('input[type="checkbox"]').prop("checked");
		var year_period;

		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		if (!cb_unit) {
			id_unit = 0
		}else{
			id_unit = $('#cmb-unit').val()
		}

		data={
			url         : url,
			jns_laporan : jns_laporan,
			buffer      : false,
			rpt_period  : tipe,
			rpt_type    : 2,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			year_period_text: year_period,
			id_unit : id_unit,
			page        : 1,
			page_row    : 10,
			type_file	: 1
		}

		$.ajax({
	        url     : "<?= base_url() ?>general/laporan/Lap_koreksi_stok/cetak_"+url,
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	        if (data.success === true) {
	          $('#loader').css('display','none');
	            var file_cetak ='Laporan '+jns_laporan+'.pdf';
	            console.log(file_cetak);
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

	function get_select()
    {
      $.ajax({
          url : "<?php echo base_url("general/laporan/Lap_koreksi_stok/get_data_unit"); ?>",
          type: "POST",
          dataType: 'json',
          beforeSend: function (){               
          },
          success:function(data, textStatus, jqXHR){
             $("#cmb-unit").select2({ data: data });
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
      });
    }

    function set_form()
	{
		// body...
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var rpt_period   = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var cb_unit = 		$('input[type="checkbox"]').prop("checked");
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

		if (!cb_unit) {
			id_unit = 0
		}else{
			id_unit = $('#cmb-unit').val()
		}

		var url_control = "<?= base_url() ?>general/laporan/Lap_koreksi_stok/cetak_"+url;

		$('#type_file').val(type_file);
		$('#buffer').val(buffer);
		$('#url').val(url);
		$('#jns_laporan').val(jns_laporan);
		$('#rpt_type').val(rpt_type);
		$('#rpt_period').val(rpt_period);
		$('#start_date').val(start_date);
		$('#end_date').val(end_date);
		$('#month_period').val(month_period);
		$('#year_period').val(year_period);
		$('#year_period_text').val(year_period);
		$('#id_unit').val(id_unit);

		$('#form_excel').attr('action', url_control);
	}

	function export_excel()
	{
		// body...
		/**/

		$('#loader').css('display','');

		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var cb_unit = 		$('input[type="checkbox"]').prop("checked");
		var year_period;

		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}

		if (!cb_unit) {
			id_unit = 0
		}else{
			id_unit = $('#cmb-unit').val()
		}

		data={
			url         : url,
			jns_laporan : jns_laporan,
			buffer      : false,
			rpt_period  : tipe,
			rpt_type    : 2,// 1 = filter
			start_date  : start_date,
			end_date    : end_date,
			month_period: month_period,
			year_period : parseInt(year_period),
			year_period_text: year_period,
			id_unit : id_unit,
			page        : 1,
			page_row    : 10,
			type_file	: 1
		}

		$.ajax({
	        url     : "<?= base_url() ?>general/laporan/Lap_koreksi_stok/check_data",
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	     		$('#form_excel').submit();
	          $('#loader').css('display','none');
	        /*if (data.success === true) {
	            var file_cetak ='Laporan '+jns_laporan+'.pdf';
	            console.log(file_cetak);
	            $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
	            $("#modal_preview").modal("show");
	          }*/
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