<script type="text/javascript">
	var tabel_utama="dtg1";
	$(function(){
		$('#tbl1').show();
		$('#tbl2').hide();
		$('#tbl3').hide();
		$('#tbl4').hide();
		$('#tbl5').hide();
		$('#tbl6').hide();
		$('#tbl7').hide();
		$('#tbl8').hide();

		$('#cmb-jenis_laporan').change(function(argument) {
			table_pilihan($(this).val());
        });

        $('#cmb-jenis_laporan').val("minta_mutasi_item").change();
        $('#cmb-jenis_laporan').trigger('change');
        $('#cmb-jenis_laporan').val("minta_mutasi_nota").change();
        $('#cmb-jenis_laporan').trigger('change');

        set_form();

		//belum set field children
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
	                    {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
			            {field:'jml_stok',title:'Jml. Stok',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_mutasi',title:'Jml. Pemakaian',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_minta',title:'Jml. Permintaan',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_kebutuhan',title:'Tgl. Kebutuhan',width:"10%",halign:'center',align:'center',formatter:appGridDateFormatter},
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
	        	console.log(index);
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'no_pm',title:'No. PM',width:"6%",halign:'center',align:'left'},
	                    {field:'kd_item',title:'Kode',width:"6%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},
			            {field:'jml_minta',title:'Jml. Minta',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_mutasi',title:'Jml. Mutasi',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
	                ]],
	                onResize:function(){
	                    $('#dtg3').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg3').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg3').datagrid('fixDetailRowHeight',index);

            }
        });

        $('#dtg5').datagrid({
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
	                	{field:'no_mutasi',title:'No. Mutasi',width:"10%",halign:'center',align:'left'},
	                    {field:'kd_item',title:'Kode',width:"8%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},
			            {field:'jml_retur',title:'Jml.Retur',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
	                ]],
	                onResize:function(){
	                    $('#dtg5').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg5').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg5').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg7').datagrid({
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
	                    {field:'ka_item',title:'Kode',width:"9%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"9%",halign:'center',align:'left'},
			            {field:'jml_retur',title:'Jml. Retur',width:"9%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_ed',title:'Tgl. Kedaluwarsa',width:"9%",halign:'center',align:'left',formatter: appGridDateFormatter},
			            {field:'no_batch',title:'No. Batch',width:"9%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg7').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg7').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg7').datagrid('fixDetailRowHeight',index);
            }
        });
	});

	$(".change").change(function(){
		// alert("The text has been changed.");
		set_form();
	});

	function table_pilihan(id)
	{
		var nyala;
		var id_baru;

		if(id=="minta_mutasi_nota")
		{
			id_baru = 1;
		}
		else if(id=="minta_mutasi_item")
		{
			id_baru = 2;
		}
		else if(id=="mutasi_ruang_nota")
		{
			id_baru = 3;
		}
		else if(id=="mutasi_ruang_item")
		{
			id_baru = 4;
		}
		else if(id=="retur_mutasi_nota")
		{
			id_baru = 5;
		}
		else if(id=="retur_mutasi_item")
		{
			id_baru = 6;	
		}
		else if(id=="retur_ed_nota")
		{
			id_baru = 7;
		}
		else if(id=="retur_ed_item")
		{
			id_baru = 8;
		}

		$('#tbl1').hide();
		$('#tbl2').hide();
		$('#tbl3').hide();
		$('#tbl4').hide();
		$('#tbl5').hide();
		$('#tbl6').hide();
		$('#tbl7').hide();
		$('#tbl8').hide();
		$('#tbl9').hide();

		nyala       = '#tbl'+id_baru;
		tabel_utama = '#dtg'+id_baru;

		$(nyala).show();
	}

	function filter()
	{
		$(tabel_utama).datagrid('loadData',[]);

		var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
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
			url         : url,
			jns_laporan : jns_laporan,
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

		// console.log(tabel_utama);
		// console.log(data);
	  	
	  	var dg = $(tabel_utama).datagrid({
			url : "<?php echo base_url("farmasi/gudang/Lap_mutasi_barang/filter"); ?>",
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

	function cetak()
	{
	    $('#loader').css('display','');
	    
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		
		var type_file    = 1; // 1 adalah pdf

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
			url             : url,
			jns_laporan     : jns_laporan,
			buffer          : true,
			rpt_period      : tipe,
			rpt_type        : 2,// 2 = cetak
			start_date      : start_date,
			end_date        : end_date,
			month_period    : month_period,
			year_period     : parseInt(year_period),
			year_period_text: year_period,
			type_file       : type_file,
			page            : 1,
			page_row        : 10
		}

		console.log(tabel_utama);
		console.log(data);

	    $.ajax({
	        url     : "<?= base_url() ?>farmasi/gudang/Lap_mutasi_barang/cetak_"+url,
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	        if (data.success === true) {
	          $('#loader').css('display','none');
	            var file_cetak ='Laporan '+jns_laporan+'.pdf';
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

	function set_form()
	{
		// body...
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var rpt_period   = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		
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

		var url_control = "<?= base_url() ?>farmasi/gudang/Lap_mutasi_barang/cetak_"+url;

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

		$('#form_excel').attr('action', url_control);
	}

	function export_excel()
	{
		// body...
		$('#form_excel').submit();
	}

</script>