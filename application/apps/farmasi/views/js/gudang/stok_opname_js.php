<script type="text/javascript">
    var edit=0;
    var wira;
	$(function(){
		tab(0);
        get_select();
        filter();
		$('#cmb-pj_depo').select2({
			placeholder:'Pilih PJ Depo'
		})


	})

	$('#dtg-stok_opname').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'no_so',title:'No. SO',width:"12%",halign:'center',align:'center'},
            {field:'periode',title:'Periode',width:"10%",halign:'center',align:'center'},
            {field:'nama_unit',title:'Depo',width:"25%",halign:'center',align:'left'},
            {field:'nama_pj_depo',title:'PJ Depo',width:"10%",halign:'center',align:'left'},
            {field:'catatan',title:'Catatan',width:"30%",halign:'center',align:'left'},
            {field:'status_caption',title:'Status',width:"8%",halign:'center',align:'center'},
            {field:'created_by',title:'Dibuat Oleh',width:"13%",halign:'center',align:'center'},
            {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
            {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-stok_opname').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
           btn_ubah();
    }
    });

    function btn_ubah(){
      edit = 1;
      var row = $('#dtg-stok_opname').datagrid('getSelected');
      reset_form();
      getData(row.no_so);
      if(row.status_caption!="Open")
      {
        set_read(true);
      }
      else
      {
        set_read(false);
      }
    
    }

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'nama_lokasi',title:'Lokasi',width:"15%",halign:'center',align:'left'},
            {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
            {field:'id_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
            {field:'jml_sistem',title:'Jml. Sistem',width:"10%",halign:'center',align:'right',formatter:appGridNumberFormatter},
            {field:'jml_fisik',title:'Jml. Fisik',width:"10%",halign:'center',align:'right',formatter:appGridNumberFormatter},
            {field:'jml_selisih',title:'Jml. Selisih',width:"10%",halign:'center',align:'right',formatter:appGridNumberFormatter},
            {field:'nama_ket_selisih',title:'Alasan',width:"18%",halign:'center',align:'left'},
            {field:'catatan',title:'Catatan',width:"25%",halign:'center',align:'left'},
            {field:'user_fullname',title:'Dibuat Oleh',width:"10%",halign:'center',align:'left'},     
            {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

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

	function set_read(kondisi)
    {
        $('#txt-no_pp').attr('disabled', true);
        $('#dtb-tgl_pp').attr('disabled', kondisi);
        $('#cmb-data_unit').attr('disabled', kondisi);
        $('#txt-ket_pp').attr('disabled', kondisi);
        $('#src-no_permintaan').attr('disabled', kondisi);

        if (edit==0)
        {
          $('#div_status').hide();
          $('#cmb-data_unit').prop('disabled', false);
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();
        }
        else
        {
          $('#div_status').show();
          $('#cmb-data_unit').prop('disabled', true);
          $('#btn-aksi').show();
          $('#btn-hapus').show();
          $('#btn-cetak').show(); 
        }
        
        if (kondisi)
        {
          $('.div_simpan').hide();
          $('#btn-hapus').hide();
        }
        else
        {
          $('.div_simpan').show(); 
          $('#btn-hapus').show();
        }

    }

    function filter()
    {
        $('#dtg-stok_opname').datagrid('loadData', []);

        let status = $('#cmb-status').val();
        let bulan  = $('#cmb-periode').val();
        let tahun  = $('#txt-tahun').val();
        
        data = {
            status: status, 
            bulan : bulan,
            tahun : tahun
        }

        var dg = $('#dtg-stok_opname').datagrid({
          url : "<?php echo base_url("farmasi/gudang/stok_opname/filter"); ?>",
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

    function generate_so()
    {
        swal.fire(cocustom("Apakah Anda yakin akan melakukan Generate No. Stok Opname ?")).then(function(result) {
           if (result.value) {
                let bulan  = $('#cmb-periode').val();
                let tahun  = $('#txt-tahun').val();
                
                data = {
                    bulan : bulan,
                    tahun : tahun
                }

                $.ajax({
                  url : "<?php echo base_url("farmasi/gudang/stok_opname/generate_so"); ?>",
                  type: "POST",
                  dataType: 'json',
                  data:data,
                    success:function(data, textStatus, jqXHR){
                          notif('success',data.message);
                          filter();
                    },
                });
           }
        });
    }

    function reset_form(){
        $('.div_simpan').show();
        $('#txt-no_pp').attr('disabled', true);
        $('#txt-no_pp').val('');
        $('#dtb-tgl_pp').val(appDateFormatter(new Date()));
        $('#txt-status_caption').val('');
        $('#cmb-data_unit').val('');
        $('#txt-ket_pp').val('');
        $('#txt-ket_mutasi').val('');
        $('#txt-unit_tujuan').val('');

        $('#btn-open').show();
        $('#btn-release').show();
        $('#btn-receive').show();
        $('#btn-approve').show();
        $('#btn-reject').show();
        $('#btn-close').show();
        $('#btn-cancel').show();

        reset_button();

        $('#dtg-detail_item').datagrid('loadData', []);
        $('#dtg-autorisasi').datagrid('loadData', []);
        $("#src-no_permintaan").searchbox('setValue',"");

        $('#txt-label_posted').text(" ");

    }
    
    function reset_button()
    {
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-cetak').show();
        
        $('#btn-open').hide();
        $('#btn-close').hide();
    }

   function getData(no_so)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/stok_opname/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            no_so: no_so,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            wira=data;
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
        detail_item=[];
        $('#txt-label_noso').text("No. SO : "+data.master.no_so);
      
        if(data.master.status_caption!=null||data.master.status_caption!=undefined)
        {
          $('#txt-label_status').text("Status : "+data.master.status_caption);
        }
        if (data.master.status_proses==2)
        {
          $('#btn-open').show();

        }else{
          $('#btn-close').show();
        }

        if(data.master.status_posting!=null||data.master.status_posting!=undefined)
        {
          $('#txt-label_posted').text(" "+data.master.status_posting);
          if(data.master.status_posting=="Unposted")
          {
            $('#txt-label_posted').removeClass('posted');
            $('#txt-label_posted').addClass('unposted');
          }
          else
          {
            $('#txt-label_posted').removeClass('unposted');
            $('#txt-label_posted').addClass('posted');
          }
        }
        $('#txt-no_so').val(data.master.no_so);
        $('#txt-periode').val(data.master.periode);
        $('#txt-depo').val(data.master.nama_unit);
        if(data.master.id_pj_depo==0){
            $('#cmb-pj_depo').val("").change();
        }else{
            $('#cmb-pj_depo').val(data.master.id_pj_depo).change();
        }
        $('#txt-ket').val(data.master.catatan);
        $('#txt-status_caption').val(data.master.status_caption);
        // $('#src-no_permintaan').val(data.master.no_pm);
        $('#src-no_permintaan').searchbox('setValue',data.master.no_pm);
        $('#txt-unit_tujuan').val(data.master.unit_tujuan);
        $('#txt-unit_tujuan_id').val(data.master.id_unit_tujuan);
        $('#txt-ket_mutasi').val(data.master.ket_mutasi);

        $('#cmb-data_unit').attr('disabled', true);

        $('#dtg-detail_item').datagrid('loadData', data.detail);
        detail_item=data.detail;
        $('#dtg-autorisasi').datagrid('loadData', data.autor);

        if(data.master.m_open==true)
        {
          $('#btn-open').show();
        }
        if(data.master.m_release==true)
        {
          $('#btn-release').show();
        }
        if(data.master.m_receive==true)
        {
          $('#btn-receive').show();
        }
        if(data.master.m_reject==true)
        {
          $('#btn-reject').show();
        }
        
    }

    function get_select()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/stok_opname/get_data_pj"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-pj_depo").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function simpan()
    {
        // var data=[];
        var no_so      = $('#txt-no_so').val();
        var id_pj_depo = $('#cmb-pj_depo').val();
        var catatan    = $('#txt-ket').val();

        console.log(data);

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/stok_opname/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            no_so     : no_so,
            id_pj_depo: id_pj_depo,
            catatan   : catatan
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
              notif('success',data.message);
              tab(0);
              filter();
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function status(status)
    {
        var no_so = $('#txt-no_so').val();
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/stok_opname/status"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
              no_so        : no_so,
              status_proses: status
              },
            beforeSend: function (){               
             },
            success:function(data, textStatus, jqXHR){
                notif('success',data.message);
                tab(0);
                filter();
            },
            error: function(jqXHR, textStatus, errorThrown){

                notif('error','something goes wrong')
            },
            complete: function(){
            }
        });

    }

    function btn_hapus()
    {
      // body...
      let no_pp = $('#txt-no_pp').val();
      let status_caption = $('#txt-status_caption').val();
      if(status_caption!="Open")
      {
          notif('info','Data Tidak Bisa Dihapus');
          return false;
      }
      hapus(no_pp);
    }

    function hapus(no_pp)
    {
        var no_so= $('#txt-no_so').val()
        // console.log(data); 
        swal.fire({
        "title"            : "Konfirmasi",
        "text"             : "Apakah Anda yakin Akan Menghapus Data?",
        "type"             : "warning",
        "showCancelButton" : true,
        "confirmButtonText": "Ya",
        "cancelButtonText" : "Tidak",
        "reverseButtons"   : false,
        "customClass"      : {
          "confirmButton"    : "btn-danger",
          "cancelButton"     : "btn-secondary"
        }
        }).then(function(result) {
            if (result.value) {
                    $.ajax({
                      url : "<?php echo base_url("farmasi/gudang/stok_opname/hapus"); ?>",
                      type: "POST",
                      dataType: 'json',
                      data:{
                        no_so: no_so,
                        },
                      beforeSend: function (){               
                       },
                      success:function(data, textStatus, jqXHR){
                        notif('success',data.message);
                        tab(0);
                      },
                      error: function(jqXHR, textStatus, errorThrown){
                          alert('Error,something goes wrong');
                      },
                      complete: function(){
                      }
                    });  
            }
        });  

    }

    function cetak(){
    $('#loader').css('display','');
  var judul        = $("#cmb-jenis_laporan option:selected").text();
  url          = $('#cmb-jenis_laporan option:selected').val();//name is posting not radio
  tipe             = $("input[name='radios']:checked").val();//name is posting not radio
  // periode_belum = toAPIDateFormat($('#periode-belum-posting-mrs').datebox('getValue'));
  var start_date   = toAPIDateFormat($('#dtb-start_date').val());
  var end_date     = toAPIDateFormat($('#dtb-end_date').val());
  var month_period = $('#cmb-bulan option:selected').val();
  var year_period;
  var year_period_text;
        if(tipe==2){
      year_period      = $('#cmb-tahun1 option:selected').val();
      year_period_text = $('#cmb-tahun1 option:selected').text();
        }
        else{
      year_period      = $('#cmb-tahun2 option:selected').val();
      year_period_text = $('#cmb-tahun2 option:selected').text();

        }
  // type = $('#jenis-kriteria-mrs').combobox('getValue');
  // criteria = $('#kriteria-mrs').textbox('getValue');
  // alert(tipe);


  var file_cetak='wira.pdf';
  // alert(file_cetak);

  // alert(file_cetak);
     
      $.ajax({

      url     : "<?= base_url() ?>farmasi/gudang/stok_opname/print_transaksi1",
      type    : "POST",
      dataType: 'json', 
      data    : wira,
    //     data:{
      // data : data,
      // judul: judul
    //     },
        success:function(data, textStatus, jqXHR){
          if (data.success === true) {
            $('#loader').css('display','none');
              $("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/file/Stok Opname "+wira.master.no_so+".pdf")
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
</script>