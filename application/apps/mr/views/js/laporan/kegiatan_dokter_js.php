<script type="text/javascript">
	$(function(){
		get_unit();
		get_ruang();
		get_dokter();
		filter();
    });

	function filter()
    {
        $('#dtg-kegiatan').datagrid('loadData',[]);
        var id_unit      = $('#cmb-unit option:selected').val();
        var id_ruang     = $('#cmb-ruang option:selected').val();
        var id_dokter    = $('#cmb-dokter option:selected').val();
        var start_date   = toAPIDateFormat($('#dtb-start_date').val());
        var end_date     = toAPIDateFormat($('#dtb-end_date').val());
        var month_period = $('#cmb-kategori option:selected').val();
        var rpt_period   =  $("input[name='radios']:checked").val();
        var year_period;
        if(rpt_period==2){
			year_period = $('#cmb-tahun1 option:selected').text();
        }else{
       		year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        data={
            rpt_period  : rpt_period,
            nama_unit   : id_unit,
            nama_ruang  : id_ruang,
            nama_dokter : id_dokter,
            start_date  : start_date,
            end_date    : end_date,
            month_period: month_period,
            year_period : parseInt(year_period),
            page        : 1,
            page_row    : 10
        } 
        var dg = $('#dtg-kegiatan').datagrid({
          url : "<?php echo base_url("mr/laporan/kegiatan_dokter/filter"); ?>",
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

    function get_unit()
    {
        $.ajax({
            url : "<?php echo base_url("mr/laporan/kegiatan_dokter/get_unit"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-unit").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_ruang()
    {
        $.ajax({
            url : "<?php echo base_url("mr/laporan/kegiatan_dokter/get_ruang"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-ruang").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_dokter()
    {
        $.ajax({
            url : "<?php echo base_url("mr/laporan/kegiatan_dokter/get_dokter"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-dokter").select2({ data: data });
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
            start_date       : start_date,
            end_date         : end_date,
            month_period     : month_period,
            year_period      : parseInt(year_period),
            page             : 1,
            page_row         : 10,
            type_file        : 1
        } 

        $.ajax({
            url     : "<?= base_url() ?>mr/laporan/kegiatan_dokter/wira",
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

</script>