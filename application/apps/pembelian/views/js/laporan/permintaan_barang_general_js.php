<script type="text/javascript">
	var tabel_utama="dtg1";
	$(function(){
		$('#tbl1').show();
		$('#tbl2').hide();
		$('#tbl3').hide();

		$('#cmb-jenis').change(function(argument) {
			table_pilihan($(this).val());
        });

        set_form()

        $('#cmb-jenis').val(2);
        $('#cmb-jenis').trigger('change');
        $('#cmb-jenis').val(1);
        $('#cmb-jenis').trigger('change');
        // set_form();
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
			            {field:'jml_stok',title:'Jml. Stok',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_minta',title:'Jml. Permintaan',width:"13%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_kebutuhan',title:'Tgl. Kebutuhan',width:"10%",halign:'center',align:'right',formatter: appGridDateFormatter},
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
		$('#tbl1').hide();
		$('#tbl2').hide();
		$('#tbl3').hide();

		var nyala='#tbl'+id;
		tabel_utama = '#dtg'+id;
		$(nyala).show();
	}

	function filter()
	{
		$(tabel_utama).datagrid('loadData',[]);

		var url          = $('#cmb-jenis option:selected').val();
		var jns_laporan  = $('#cmb-jenis option:selected').text();
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
			id_jns          : url,
			rpt_period      : tipe,
			rpt_type        : 1,
			start_date      : start_date,
			end_date        : end_date,
			month_period    : month_period,
			year_period     : parseInt(year_period),
			page            : 1,
			page_row        : 90,
			year_period_text: year_period,
			type_file       : type_file,
			buffer          : false,
			jns_laporan     : jns_laporan,
			
		}


		// console.log(tabel_utama);
		// console.log(data);
	  	
	  	var dg = $(tabel_utama).datagrid({
			url : "<?php echo base_url("pembelian/laporan/permintaan_barang_general/filter"); ?>",
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
	    
		var url          = $('#cmb-jenis option:selected').val();
		var jns_laporan  = $('#cmb-jenis option:selected').text();
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
			id_jns          : url,
			rpt_period      : tipe,
			rpt_type        : 2,
			start_date      : start_date,
			end_date        : end_date,
			month_period    : month_period,
			year_period     : parseInt(year_period),
			page            : 1,
			page_row        : 90,
			year_period_text: year_period,
			type_file       : type_file,
			buffer          : true,
			jns_laporan     : jns_laporan,
			
		}

	    $.ajax({
	        url     : "<?= base_url() ?>pembelian/laporan/permintaan_barang_general/cetak_"+url,
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	        if (data.success === true) {
	          $('#loader').css('display','none');
	            var file_cetak ='Laporan '+jns_laporan+'.pdf';
	            $("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
	            $("#form_file_surat_detail").modal("show");
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
		var url          = $('#cmb-jenis option:selected').val();
		var jns_laporan  = $('#cmb-jenis option:selected').text();
		var tipe         = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		
  	 	var year_period;
		var rpt_type     = 2;
		
		var type_file    = 2; // 2 adalah excel
		
		var buffer       = true;
		if(tipe==2)
		{
			year_period = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period = $('#cmb-tahun2 option:selected').text();
		}
	  

		var url_control = "<?= base_url() ?>pembelian/laporan/permintaan_barang_general/cetak_"+url;

		$('#type_file').val(type_file);
		$('#buffer').val(buffer);
		$('#id_jns').val(url);
		$('#rpt_period').val(tipe);
		$('#rpt_type').val(rpt_type);
		$('#start_date').val(start_date);
		$('#end_date').val(end_date);
		$('#month_period').val(month_period);
		$('#year_period').val(year_period);
		$('#year_period_text').val(year_period);
		$('#jns_laporan').val(jns_laporan);

		$('#form_excel').attr('action', url_control);
	}

	function export_excel()
	{
		// body...
		$('#form_excel').submit();
	}
</script>