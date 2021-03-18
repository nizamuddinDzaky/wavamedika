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
		$('#tbl9').hide();
		$('#tbl10').hide();
		$('#tbl11').hide();
		$('#tbl12').hide();

		$('#cmb-jenis_laporan').change(function(argument) {
			table_pilihan($(this).val());
	    });

	    $('#cmb-jenis_laporan').val("per_status_px").change();
        $('#cmb-jenis_laporan').trigger('change');
        $('#cmb-jenis_laporan').val("per_brg").change();
        $('#cmb-jenis_laporan').trigger('change');

	    get_select("depo");

	    $('#cmb-depo').select2({
	    	placeholder:'Pilih Depo'
	    });

	    get_select("kategori");

	    $('#cmb-kategori').select2({
	    	placeholder:'Pilih Kategori'
	    });

	    $('#cmb-karyawan').select2({
	    	placeholder:'Pilih Karyawan'
	    });

	    set_form();

	});

	$(".change").change(function(){
		// alert("The text has been changed.");
		set_form();
	});

	function get_select(argument)
    {
    	let url_con;
    	let id_cmb;

    	if (argument=="depo")
    	{
			url_con = "<?php echo base_url("farmasi/depo/Lap_penjualan_depo/get_depo"); ?>";
			id_cmb  = "#cmb-depo";
    	}
    	else if (argument=="kategori")
    	{
			url_con = "<?php echo base_url("farmasi/depo/Lap_penjualan_depo/get_kategori"); ?>";
			id_cmb  = "#cmb-kategori";
    	}

        // body...
        $.ajax({
            url : url_con,
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $(id_cmb).select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function table_pilihan(id){
		var nyala;
		var id_baru;

		if(id=="per_brg")
		{
			id_baru = 1;
		}
		else if(id=="per_status_px")
		{
			id_baru = 2;
		}
		else if(id=="bpjs_irja")
		{
			id_baru = 3;
		}
		else if(id=="per_depo")
		{
			id_baru = 4;
		}
		else if(id=="resep_per_status")
		{
			id_baru = 5;
		}
		else if(id=="jasa_resep")
		{
			id_baru = 6;	
		}
		else if(id=="per_dokter")
		{
			id_baru = 7;
		}
		else if(id=="obat_per_dokter")
		{
			id_baru = 8;
		}
		else if(id=="per_produsen")
		{
			id_baru = 9;
		}
		else if(id=="rekap_jual")
		{
			id_baru = 10;
		}
		else if(id=="per_nota")
		{
			id_baru = 11;
		}
		else if(id=="rekap_depo")
		{
			id_baru = 12;
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
		$('#tbl10').hide();
		$('#tbl11').hide();
		$('#tbl12').hide();

		nyala       = '#tbl'+id_baru;
		tabel_utama = '#dtg'+id_baru;

		$(nyala).show();
	}

	function filter()
	{
		$(tabel_utama).datagrid('loadData',[]);

		var url             = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan     = $('#cmb-jenis_laporan option:selected').text();
		var tipe            = $("input[name='radios']:checked").val();			
		var start_date      = toAPIDateFormat($('#dtb-start_date').val());
		var end_date        = toAPIDateFormat($('#dtb-end_date').val());
		var month_period    = $('#cmb-bulan option:selected').val();
		
		var id_depo         = $('#cmb-depo option:selected').val();
		var id_kel_item     = $('#cmb-kategori option:selected').val();
		var status_karyawan = $('#cmb-karyawan option:selected').val();

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
			url            : url,
			jns_laporan    : jns_laporan,
			buffer         : false,
			rpt_period     : tipe,
			rpt_type       : 1,// 1 = filter
			start_date     : start_date,
			end_date       : end_date,
			month_period   : month_period,
			year_period    : parseInt(year_period),
			id_depo        : id_depo,
			id_kel_item    : id_kel_item,
			status_karyawan: status_karyawan,
			page           : 1,
			page_row       : 10
		}

		// console.log(tabel_utama);
		// console.log(data);
	  	
	  	var dg = $(tabel_utama).datagrid({
			url : "<?php echo base_url("farmasi/depo/Lap_penjualan_depo/filter"); ?>",
			method: "POST",
			queryParams: data,
			loadFilter: function(data) {
			// console.log(data);
			  return {
			    total: data.paging ? data.paging.rec_count : 0, 
			    rows: data.data ? data.data : []
			  }
			}
		});
	}

	function cek_data()
	{
	    var url             = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan     = $('#cmb-jenis_laporan option:selected').text();
		var tipe            = $("input[name='radios']:checked").val();			
		var start_date      = toAPIDateFormat($('#dtb-start_date').val());
		var end_date        = toAPIDateFormat($('#dtb-end_date').val());
		var month_period    = $('#cmb-bulan option:selected').val();
		
		var id_depo         = $('#cmb-depo option:selected').val();
		var id_kel_item     = $('#cmb-kategori option:selected').val();
		var status_karyawan = $('#cmb-karyawan option:selected').val();

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
			url            : url,
			jns_laporan    : jns_laporan,
			buffer         : false,
			rpt_period     : tipe,
			rpt_type       : 1,// 1 = filter
			start_date     : start_date,
			end_date       : end_date,
			month_period   : month_period,
			year_period    : parseInt(year_period),
			id_depo        : id_depo,
			id_kel_item    : id_kel_item,
			status_karyawan: status_karyawan,
			page           : 1,
			page_row       : 10
		}
		
		var cek = 0;

	    $.ajax({
	        url     : "<?= base_url() ?>farmasi/depo/Lap_penjualan_depo/filter",
	        type    : "POST",
	    	dataType: 'json',	
	        data 	: data,
	        async	: false,
	     	success:function(data, textStatus, jqXHR){
		        if (typeof data.data == "undefined" || data.data == null || data.data.length < 1)
		        {
	         		cek = 0;
	         	}
	         	else
	         	{
	         		cek = 1;
	         	}
	     	},
	     	fail: function (e) {  
		        $('#loader').css('display','none');
			},
			error: function(jqXHR, textStatus, errorThrown){
              $('#loader').css('display','none');
              notif('info','Error, Something goes wrong');
          	}
	    });

	    return cek;
	}

	function cetak()
	{
	    $('#loader').css('display','');

	    if (cek_data()==0)
		{
			notif('info','Data Kosong');
			$('#loader').css('display','none');
			return false;
		}
	    
		var url             = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan     = $('#cmb-jenis_laporan option:selected').text();
		var tipe            = $("input[name='radios']:checked").val();			
		var start_date      = toAPIDateFormat($('#dtb-start_date').val());
		var end_date        = toAPIDateFormat($('#dtb-end_date').val());
		var month_period    = $('#cmb-bulan option:selected').val();
		
		var id_depo         = $('#cmb-depo option:selected').val();
		var nama_depo       = $('#cmb-depo option:selected').text();
		var id_kel_item     = $('#cmb-kategori option:selected').val();
		var status_karyawan = $('#cmb-karyawan option:selected').val();
		
		var type_file       = 1; // 1 adalah pdf

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
			id_depo        	: id_depo,
			nama_depo     	: nama_depo,
			id_kel_item    	: id_kel_item,
			status_karyawan	: status_karyawan,
			page            : 1,
			page_row        : 10
		}

		// console.log(tabel_utama);
		// console.log(data);

	    $.ajax({
	        url     : "<?= base_url() ?>farmasi/depo/Lap_penjualan_depo/cetak_"+url,
	        type    : "POST",
	    	dataType: 'json',	
	        data:data,
	     	success:function(data, textStatus, jqXHR){
	        if (data.success === true) {
	          $('#loader').css('display','none');
	            var file_cetak ='Laporan Penjualan Depo '+jns_laporan+'.pdf';
	            $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
	            $("#modal_preview").modal("show");
	          }
	     	},
	     	fail: function (e) {  
		        $('#loader').css('display','none');
			},
			error: function(jqXHR, textStatus, errorThrown){
              $('#loader').css('display','none');
              notif('error','Error, Something goes wrong');
          	}
	    });
	}

	function set_form()
	{
		// body...
		var url             = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan     = $('#cmb-jenis_laporan option:selected').text();
		var rpt_period      = $("input[name='radios']:checked").val();			
		var start_date      = toAPIDateFormat($('#dtb-start_date').val());
		var end_date        = toAPIDateFormat($('#dtb-end_date').val());
		var month_period    = $('#cmb-bulan option:selected').val();
		
		var id_depo         = $('#cmb-depo option:selected').val();
		var nama_depo       = $('#cmb-depo option:selected').text();
		var id_kel_item     = $('#cmb-kategori option:selected').val();
		var status_karyawan = $('#cmb-karyawan option:selected').val();
		
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

		var url_control = "<?= base_url() ?>farmasi/depo/Lap_penjualan_depo/cetak_"+url;

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

		$('#id_depo').val(id_depo);
		$('#nama_depo').val(nama_depo);
		$('#id_kel_item').val(id_kel_item);
		$('#status_karyawan').val(status_karyawan);

		$('#form_excel').attr('action', url_control);
	}

	function export_excel()
	{
		// body...
		if (cek_data()==0)
		{
			notif('info','Data Kosong');
			$('#loader').css('display','none');
			return false;
		}
		
		$('#form_excel').submit();
	}

</script>