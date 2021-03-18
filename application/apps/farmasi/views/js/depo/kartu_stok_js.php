<script type="text/javascript">
	$(function(){
    get_select();
		$('#cmb-unit').select2({
			placeholder: 'Pilih Unit',
		})
	})

	$('#dtg-kartu_stok').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'kd_item',title:'Kode',width:"10%",halign:'center',align:'left'},
            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
            {field:'nama_kel_item',title:'Jenis',width:"10%",halign:'center',align:'left'},
            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
            {field:'nama_bentuk_sd',title:'Bentuk Sediaan',width:"13%",halign:'center',align:'left'},
            {field:'stok_awal',title:'Stok Awal',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
            {field:'masuk',title:'Masuk',width:"10%",halign:'center',align:'right'},
            {field:'keluar',title:'Keluar',width:"10%",halign:'center',align:'right'},     
            {field:'stok_akhir',title:'Stok Akhir',width:"15%",halign:'center',align:'right',formatter: appGridNumberFormatter},
        ]],
    });

    $('#dtg-detail').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'trans_desc',title:'Jenis Transaksi',width:"20%",halign:'center',align:'left'},
            {field:'tgl_stok',title:'Tgl. Transaksi',width:"10%",halign:'center',align:'center',formatter: appGridDateTimeFormatter},
            {field:'no_ref',title:'No. Referensi',width:"15%",halign:'center',align:'left'},
            {field:'no_rm',title:'No. RM',width:"10%",halign:'center',align:'left'},
            {field:'nama_pasien',title:'Nama Pasien',width:"20%",halign:'center',align:'left'},
            {field:'ket_stok',title:'Keterangan',width:"20%",halign:'center',align:'left'},
            {field:'nama_unit',title:'Unit',width:"20%",halign:'center',align:'left'},
            {field:'masuk',title:'Masuk',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
            {field:'keluar',title:'Keluar',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
        ]],
    });

    function filter()
    {
        var id_unit_asal  = $('#cmb-unit option:selected').val();
          if(id_unit_asal == "")
          {
              notif('warning','Harap Pilih Unit')
              return false;
          }

        $('#dtg-kartu_stok').datagrid('loadData',[]);
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date   = toAPIDateFormat($('#dtb-end_date').val());
        var id_unit    = $('#cmb-unit option:selected').val();
      
        data={
          start_date: start_date,
          end_date  : end_date,
          criteria  : "",
          id_unit   : id_unit
        } 

        var dg = $('#dtg-kartu_stok').datagrid({
          url : "<?php echo base_url("farmasi/depo/kartu_stok/filter"); ?>",
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

    $('#dtg-kartu_stok').datagrid({
         onSelect: function(rowIndex, rowData)
         {
          var start_date = toAPIDateFormat($('#dtb-start_date').val());
          var end_date   = toAPIDateFormat($('#dtb-end_date').val());
          var id_unit    = $('#cmb-unit option:selected').val();

          // console.log(rowData.id_item);
          var id_item= rowData.id_item;
          detail={
                start_date: start_date,
                end_date  : end_date,
                id_unit   : id_unit,  
                id_item   : id_item,
          }  
          var dg = $('#dtg-detail').datagrid({
          url : "<?php echo base_url("farmasi/depo/kartu_stok/filter_detail"); ?>",
          method: "POST",
          queryParams: detail,
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
           // $('#dtg-list_barang_detail').datagrid('loadData', rowData.details);
         }
    });
    
    function get_select()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/kartu_stok/get_data_unit"); ?>",
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

    function cetak(){
      var id_unit_asal  = $('#cmb-unit option:selected').val();
      if(id_unit_asal == "")
      {
          notif('warning','Harap Pilih Unit')
          return false;
      }
      $('#loader').css('display','');
          var start_date = toAPIDateFormat($('#dtb-start_date').val());
          var end_date   = toAPIDateFormat($('#dtb-end_date').val());
          var id_unit    = $('#cmb-unit option:selected').val();
          var file_cetak = 'Kartu Stok Depo Tanggal '+convertDateDBtoIndo(start_date)+' sd '+convertDateDBtoIndo(end_date)+'.pdf';

          data={
            start_date: start_date,
            end_date  : end_date,
            criteria  : '',
            id_unit   : id_unit,
            file_cetak: file_cetak,
            type_file : 1          
          } 
          $.ajax({

              url     : "<?= base_url() ?>farmasi/depo/kartu_stok/print_transaksi1",
              type    : "POST",
              dataType: 'json',   
              data    : data,
        //     data:{
              // data : data,
              // judul: judul
        //     },
            success:function(data, textStatus, jqXHR){
              if (data.success === true) {
                $('#loader').css('display','none');
                  $("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/file/"+file_cetak)
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

    function cetak_detail(){
        $('#loader').css('display','');
            var row = $('#dtg-kartu_stok').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum Di Pilih')
                $('#loader').css('display','none');

                return false;
            }
            var master=[];
            master.push({
                kd_item       : row.id_item,
                nama_item     : row.nama_item,
                keluar        : row.keluar,
                masuk         : row.masuk,
                nama_bentuk_sd: row.nama_bentuk_sd,
                nama_kel_item : row.nama_kel_item,
                nama_satuan   : row.nama_satuan,
                stok_awal     : row.stok_awal,
                stok_akhir    : row.stok_akhir,
            })
            var id_item = row.id_item;
            var start_date = toAPIDateFormat($('#dtb-start_date').val());
            var end_date   = toAPIDateFormat($('#dtb-end_date').val());
            var id_unit    = $('#cmb-unit option:selected').val();
            var file_cetak = 'Detail Transaksi Per Item Tanggal '+convertDateDBtoIndo(start_date)+' sd '+convertDateDBtoIndo(end_date)+'.pdf';

            data={
                master    : master,
                start_date: start_date,
                end_date  : end_date,
                id_unit   : id_unit,  
                id_item   : id_item,
                file_cetak: file_cetak
            }  
            $.ajax({

                url     : "<?= base_url() ?>farmasi/depo/kartu_stok/print_detail",
                type    : "POST",
                dataType: 'json',   
                data    : data,
          //     data:{
                // data : data,
                // judul: judul
          //     },
              success:function(data, textStatus, jqXHR){
                if (data.success === true) {
                  $('#loader').css('display','none');
                    $("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/file/"+file_cetak)
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

     $('body').on('click', '#btn-export', function () {

        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date   = toAPIDateFormat($('#dtb-end_date').val());
        var criteria   = '';
        var id_unit    = $('#cmb-unit option:selected').val();
        var file_cetak = 'Kartu Stok Tanggal '+convertDateDBtoIndo(start_date)+' sd '+convertDateDBtoIndo(end_date);
        var type_file  = 2 ;

        var url_control = "<?= base_url() ?>farmasi/depo/kartu_stok/print_transaksi1";
        // var url_control = "<?= base_url() ?>farmasi/gudang/Lap_mutasi_barang/excel";

        $('body').append($('<form/>')
        .attr({'action': ""+url_control+"", 'method': 'POST', 'id': 'replacer'})
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'start_date', 'value':  ""+start_date+""})
        ) 
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'end_date', 'value':  ""+end_date+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'criteria', 'value':  ""+criteria+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'id_unit', 'value':  ""+id_unit+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'file_cetak', 'value':  ""+file_cetak+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'type_file', 'value':  ""+type_file+""})
        )
     
        ).find('#replacer').submit();
    });
</script>