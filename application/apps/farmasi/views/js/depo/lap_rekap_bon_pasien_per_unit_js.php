<script type="text/javascript">
	$(function(){
		filter();
		get_unit_asal();
		get_unit_tujuan();
		get_kategori();
		$('#cmb-unit_asal').select2({
			placeholder:'Pilih Unit Asal'
		})
		$('#cmb-unit_tujuan').select2({
			placeholder:'Pilih Unit Tujuan'
		})
		$('#cmb-kategori').select2({
			placeholder:'Pilih Kategori'
		})
	set_form();

    });

    $(".change").change(function(){
        // alert("The text has been changed.");
        set_form();
    });

	function filter()
    {
        $('#dtg-mutasi_barang').datagrid('loadData',[]);
		var rpt_period     = tipe = $("input[name='radios']:checked").val();
		var rpt_type       = 1;
		var id_unit_asal   = $('#cmb-unit_asal option:selected').val();
		var id_unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
		var id_kel_item    = $('#cmb-kategori option:selected').val();
		var start_date     = toAPIDateFormat($('#dtb-start_date').val());
		var end_date       = toAPIDateFormat($('#dtb-end_date').val());
		var month_period   = $('#cmb-kategori option:selected').val();
        var year_period;
        if(rpt_period==2){
			year_period = $('#cmb-tahun1 option:selected').text();
        }else{
       		year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        data={
			rpt_period    : rpt_period,
			rpt_type      : rpt_type,
			id_unit_asal  : id_unit_asal,
			id_unit_tujuan: id_unit_tujuan,
			id_kel_item   : id_kel_item,
			// id_unit_asal  : 0,
			// id_unit_tujuan: 0,
			// id_kel_item   : 0,
			start_date    : start_date,
			end_date      : end_date,
			month_period  : month_period,
			year_period   : parseInt(year_period),
			page          : 1,
			page_row      : 10
        } 
        var dg = $('#dtg1').datagrid({
          url : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien_per_unit/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            // if (data.metadata.list_count<1)
            // {
            //   $.messager.alert('Warning','Daftar Kosong');
            // }
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.data ? data.data : []
            }
          }
        });
    }

    function get_unit_asal()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien_per_unit/get_data_unit_asal"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-unit_asal").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_unit_tujuan()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien_per_unit/get_data_unit_tujuan"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-unit_tujuan").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_kategori()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien_per_unit/get_kategori"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-kategori").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function cetak()
    {
        $('#loader').css('display','');

        var rpt_period     = tipe = $("input[name='radios']:checked").val();
        var rpt_type       = 2;
        var id_unit_asal   = $('#cmb-unit_asal option:selected').val();
        var id_unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
        var id_kel_item    = $('#cmb-kategori option:selected').val();
        var start_date     = toAPIDateFormat($('#dtb-start_date').val());
        var end_date       = toAPIDateFormat($('#dtb-end_date').val());
        var month_period   = $('#cmb-kategori option:selected').val();
        var year_period;
        if(rpt_period==2){
            year_period = $('#cmb-tahun1 option:selected').text();
        }else{
            year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        data={
            rpt_period       : rpt_period,
            rpt_type         : rpt_type,
            id_unit_asal     : id_unit_asal,
            id_unit_tujuan   : id_unit_tujuan,
            id_kel_item      : id_kel_item,
            // id_unit_asal  : 0,
            // id_unit_tujuan: 0,
            // id_kel_item   : 0,
            start_date       : start_date,
            end_date         : end_date,
            month_period     : month_period,
            year_period      : parseInt(year_period),
            page             : 1,
            page_row         : 10,
            type_file        : 1
            } 

        // console.log(data);

        // data['cek']=0;

        $.ajax({
            url     : "<?= base_url() ?>farmasi/depo/lap_rekap_bon_pasien_per_unit/wira",
            type    : "POST",
            dataType: 'json',   
            data:data,
            success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
                var file_cetak ='Laporan Rekap Bon per Unit.pdf';
                $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
                $("#modal_preview").modal("show");
                $('#win-cetak').window('close');
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
        var rpt_period     = tipe = $("input[name='radios']:checked").val();
        var rpt_type       = 2;
        var id_unit_asal   = $('#cmb-unit_asal option:selected').val();
        var id_unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
        var id_kel_item    = $('#cmb-kategori option:selected').val();
        var start_date     = toAPIDateFormat($('#dtb-start_date').val());
        var end_date       = toAPIDateFormat($('#dtb-end_date').val());
        var month_period   = $('#cmb-kategori option:selected').val();
        var year_period;
        var type_file    = 2; // 2 adalah excel
        var url_control = "<?= base_url() ?>farmasi/depo/lap_rekap_bon_pasien_per_unit/cetak";


        if(rpt_period==2){
            year_period = $('#cmb-tahun1 option:selected').text();
        }else{
            year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        $('#type_file').val(type_file);
        $('#rpt_period').val(rpt_period);
        $('#rpt_type').val(rpt_type);
        $('#id_unit_asal').val(id_unit_asal);
        $('#id_unit_tujuan').val(id_unit_tujuan);
        $('#id_kel_item').val(id_kel_item);
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        $('#month_period').val(month_period);
        $('#year_period').val(year_period);

        $('#form_excel').attr('action', url_control);
    }

    function export_excel()
    {
        if (cek_data()==0)
        {
            notif('info','Data Kosong');
            $('#loader').css('display','none');
            return false;
        }
        
        $('#form_excel').submit();
    }

    function cek_data()
    {
        var rpt_period     = tipe = $("input[name='radios']:checked").val();
        var rpt_type       = 2;
        var id_unit_asal   = $('#cmb-unit_asal option:selected').val();
        var id_unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
        var id_kel_item    = $('#cmb-kategori option:selected').val();
        var start_date     = toAPIDateFormat($('#dtb-start_date').val());
        var end_date       = toAPIDateFormat($('#dtb-end_date').val());
        var month_period   = $('#cmb-kategori option:selected').val();
        var year_period;
        if(rpt_period==2){
            year_period = $('#cmb-tahun1 option:selected').text();
        }else{
            year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        data={
            rpt_period       : rpt_period,
            rpt_type         : rpt_type,
            id_unit_asal     : id_unit_asal,
            id_unit_tujuan   : id_unit_tujuan,
            id_kel_item      : id_kel_item,
            // id_unit_asal  : 0,
            // id_unit_tujuan: 0,
            // id_kel_item   : 0,
            start_date       : start_date,
            end_date         : end_date,
            month_period     : month_period,
            year_period      : parseInt(year_period),
            page             : 1,
            page_row         : 10,
            type_file        : 1
        } 
        
        var cek = 0;

        $.ajax({
            url     : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien_per_unit/filter"); ?>",
            type    : "POST",
            dataType: 'json',   
            data    : data,
            async   : false,
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
</script>