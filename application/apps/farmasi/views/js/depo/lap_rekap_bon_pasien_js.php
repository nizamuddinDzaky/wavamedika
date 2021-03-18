<script type="text/javascript">
	$(function(){
		tab(0);
	})

	$('#dtg-rekap_bon_pasien').datagrid({
		singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'id_mrs',title:'No. Billing',width:"10%",halign:'center',align:'left'},
            {field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'no_mr',title:'No. RM',width:"10%",halign:'center',align:'left'},
            {field:'jns_kel',title:'Jenis Kelamin',width:"10%",halign:'center',align:'left'},
            {field:'alamat',title:'Alamat',width:"20%",halign:'center',align:'left'},
            {field:'umur',title:'Umur',width:"10%",halign:'center',align:'center'},
            {field:'tgl_mrs',title:'Tgl. MRS',width:"10%",halign:'center',align:'center',formatter:appGridDateFormatter },
            {field:'nama_kamar',title:'Nama Kamar',width:"12%",halign:'center',align:'left'},     
            {field:'kelas',title:'Kelas',width:"9%",halign:'center',align:'left'},
            {field:'nama_unit',title:'Nama Unit',width:"20%",halign:'center',align:'left'},
            {field:'nama_dokter',title:'Dokter',width:"17%",halign:'center',align:'left'},
            {field:'is_karyawan',title:'Karyawan',width:"15%",halign:'center',align:'left'},
            {field:'asuransi',title:'Asuransi',width:"10%",halign:'center',align:'left'},
            {field:'instansi',title:'Instansi',width:"15%",halign:'center',align:'left'},
            {field:'admission',title:'Admission',width:"10%",halign:'center',align:'left'},
            
        ]],
	})

	$('#dtg-nota_bon_pasien').datagrid({
		singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'nama_unit',title:'Unit/Ruang',width:"20%",halign:'center',align:'left'},
            {field:'no_nota',title:'No. Nota',width:"10%",halign:'center',align:'left'},
            {field:'tgl_nota',title:'Tgl. Nota',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'kd_item',title:'Kode',width:"10%",halign:'center',align:'left'},
            {field:'nama_item',title:'Nama Obat/Alkes',width:"20%",halign:'center',align:'left'},
            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
            {field:'harga',title:'Harga',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
            {field:'sub_total',title:'Sub Total',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
        ]],
	})

	$('#dtg-retur').datagrid({
		singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'nama_unit',title:'Unit/Ruang',width:"20%",halign:'center',align:'left'},
            {field:'no_nota',title:'No. Nota',width:"10%",halign:'center',align:'left'},
            {field:'tgl_nota',title:'Tgl. Nota',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'kode',title:'Kode',width:"10%",halign:'center',align:'left'},
            {field:'nama_item',title:'Nama Obat/Alkes',width:"20%",halign:'center',align:'left'},
            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
            {field:'harga',title:'Harga',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
            {field:'sub_total',title:'Sub Total',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
        ]],
	})

    $('.easyui-numberbox').numberbox({
            'precision' : 2,
            // 'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :','
        });

	function btn_tambah(){
      	edit = 0;
      	$('#div_hapus').hide();
      	// reset_form();
      	// set_read(false);
        get_detail();
      	tab(1);
    }

    function tab(tab){
    	if(tab==0){
    		$('#browse').show();
        	$('#detail').hide();
    	}
    	else{
    		$('#browse').hide();
        	$('#detail').show();
    	}
    }

    function filter()
    {
        $('#dtg-rekap_bon_pasien').datagrid('loadData',[]);
        var criteria   = $('#txt-criteria').val();
      
        data={
          criteria : criteria,
          page:1,
          page_row:10
        } 
        var dg = $('#dtg-rekap_bon_pasien').datagrid({
          url : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien/filter"); ?>",
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

    $("#dtg-rekap_bon_pasien").datagrid({
      onDblClickRow:function(){
        get_detail();
      },
    })

    function get_detail()
    {
      var row = $('#dtg-rekap_bon_pasien').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      // reset_form();
      getData(row.id_mrs);
      // if(row.status_caption!="Open")
      // {
      //   set_read(true);
      // }
      // else
      // {
      //   set_read(false);
      // }
    }

    function getData(id_mrs)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/lap_rekap_bon_pasien/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: id_mrs,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            set_data(data);
            tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function set_data(data)
    {
        
        $('#txt-no_billing').val(data.master.id_mrs);
        $('#txt-tgl_mrs').val(data.master.tgl_mrs);
        $('#txt-nama_pasien').val(data.master.nama_pasien);
        $('#txt-nama_dokter').val(data.master.nama_dokter);
        $('#txt-no_rm').val(data.master.no_mr);
        $('#txt-kelas_kamar').val(data.master.kelas);

        $('#dtg-nota_bon_pasien').datagrid('loadData', data.data_nota);
        $('#dtg-retur').datagrid('loadData', data.data_retur);
        
        $('#txt-total_bon_pasien').val(data.master.sub_total);
        $('#txt-total_retur').val(data.master.tot_retur);
        $('#txt-total_ppn').val(data.master.tot_ppn);
        $('#txt-total_jrs').val(data.master.jrs);
        $('#txt-total').val(data.master.total);

    }

    function cetak($jenis)
    {
        $('#loader').css('display','');
        var row = $('#dtg-rekap_bon_pasien').datagrid('getSelected');
        if(row <= 0)
        {
          notif('warning','Data Belum Di Pilih');
          $('#loader').css('display','none');
          return false;
        }
        var id_mrs = row.id_mrs;
        data={
            data: id_mrs
        } 
        var url="cetak_asuransi";
        if($jenis==1){
          url="cetak_reg";
        }
        $.ajax({
            url     : "<?= base_url() ?>farmasi/depo/lap_rekap_bon_pasien/"+url,
            type    : "POST",
            dataType: 'json',   
            data:data,
            success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
                var file_cetak ='Laporan Rekap Bon per Pasien.pdf';
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
</script>