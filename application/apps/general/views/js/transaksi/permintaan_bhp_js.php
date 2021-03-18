<!-- Script easy ui -->
<script type="text/javascript">
    var edit=0;
    var detail_item;
    
    $(function () {
      // $(".dtb").val(setDateNow());

      tab(0);
      // $("#tbl-autorisasi").hide();
      // $('#dtg-autorisasi').datagrid('hideColumn', 'trans_sign_id');
      // $('#dtg-autorisasi').datagrid('hideColumn', 'seq_no');
      // $('#dtg-autorisasi').datagrid('hideColumn', 'sign_id');
      // $('#dtg-autorisasi').datagrid('hideColumn', 'is_default');
      // $('#win-cari_data_item').window('open');
      $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_bhp/get_unit_asal"); ?>",
        type: "POST",
        dataType: 'json',
        beforeSend: function (){               
        },
        success:function(data, textStatus, jqXHR){
           $("#cmb-unit_asal").select2({ data: data });
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','something goes wrong');
        },
        complete: function(){
        }
      });

      $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_bhp/get_unit_tujuan"); ?>",
        type: "POST",
        dataType: 'json',
        beforeSend: function (){               
        },
        success:function(data, textStatus, jqXHR){
           $("#cmb-unit_tujuan").select2({ data: data });
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','something goes wrong');
        },
        complete: function(){
        }
      }); 

        tab(0);
        
        $('#btn-tambah').click(function () {
          edit = 0;
          reset_form();
          set_read(false);
          $('#btn-hapus').hide();
          // default_auth();
          tab(1);
          // $('#btn-browse').attr('disabled', true);            
        });

        $('#btn-tampil').click(function () {
            var row = $('#dtg-permintaan_bhp').datagrid('getSelected');
            if(row <= 0)
            {
                notif('Warning','Data Belum Di pilih');
                return false;
            }
            reset_form();
            getData(row);
            edit = 2;
            $('.div_simpan').hide();
        });

        $('#btn-hapus').click(function () {
          var row = $('#dtg-permintaan_bhp').datagrid('getSelected');
          if(row <= 0)
          {
            notif('warning','Data Belum Di Pilih');
            return false;
          }
          if (row.status_caption.toLowerCase() != 'open') {
            notif('warning','Status Harus Open');
            return false;  
          }

          hapus(row);
        });

        $('#btn-kembali').click(function () {
          tab(0);
        });

        $('#btn-batal').click(function () {
          tab(0);
        });

        $('#btn-detail').click(function () {
            var row = $('#dtg-permintaan_bhp').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum Di Pilih');
                return false;
            }
            // reset_form();
            
            
            $('.div_simpan').hide();            
        });

        $('#cmb-unit_asal').select2({
          placeholder: 'Pilih unit',
          allowClear: true
        });

        $('#cmb-unit_tujuan').select2({
          placeholder: 'Pilih unit',
          allowClear: true
        });

        // $('#dtg-autorisasi').datagrid('hideColumn', 'trans_sign_id');
        // $('#dtg-autorisasi').datagrid('hideColumn', 'seq_no');
        // $('#dtg-autorisasi').datagrid('hideColumn', 'sign_id');
        // $('#dtg-autorisasi').datagrid('hideColumn', 'is_default');
        /*$('#dtg-autorisasi').datagrid('hideColumn', 'user_id');*/

        // $('#btn-open').click(function () {
        //   status(1);
        // });
        // $('#btn-release').click(function () {
        //   status(2);
        // });
        // $('#btn-approve').click(function () {
        //   status(3);
        // });
    });

    $('#dtg-permintaan_bhp').datagrid({
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
        // btn_ubah();
        // if (row.status_caption.toLowerCase() != 'open') {
        //   $.messager.alert('Warning','Data Harus Di open');
        //   return false;
        // }
        edit=1;
        reset_form();
        var row = $('#dtg-permintaan_bhp').datagrid('getSelected');
        getData(row);
        if(row.status_caption!="Open")
        {
          set_read(true);
        }
        else
        {
          set_read(false);
        }
      },
      columns:[[
        {field:'no_pm',title:'No. Permintaan',width:"12%",halign:'center',align:'center'},
        {field:'tgl_pm',title:'Tgl. Minta',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
        {field:'unit_asal',title:'Unit Asal Item',width:"20%",halign:'center',align:'left'},
        {field:'ket_pm',title:'Catatan',width:"25%",halign:'center',align:'left'},
        {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'center'},
        {field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
        {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
        {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
        {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
      ]],
    });

    $('#dtg-detail_item').datagrid({
      title:'Detail Permintaan BMHP',
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
       $.map($('#dtg-detail_item').datagrid('getRows'), function(row){
          var index = $('#dtg-detail_item').datagrid('getRowIndex', row);
          $('#dtg-detail_item').datagrid('updateRow', {
            index: index,
            row:{
              status:'P'
            }
          });
          $('#dtg-detail_item').datagrid('selectRow',index);
          $('#dtg-detail_item').datagrid('beginEdit',index);
        });
      },
      columns:[[
        {field:'id_item',title:'Id',width:50,halign:'center',align:'left',hidden:true},
        {field:'kd_item',title:'Kode',width:80,halign:'center',align:'left'},
        {field:'nama_item',title:'Nama Item',width:600,halign:'center',align:'left'},
        {field:'nama_satuan',title:'Satuan',width:100,halign:'center',align:'left'},
        {field:'jml_stok',title:'Jumlah Stok',width:100,halign:'center',align:'right',formatter: appGridNumberFormatter},
        {
          field:'jml_minta',
          title:'Permintaan',
          width:100,
          halign:'center',
          align:'right',
          formatter:appGridNumberFormatter,
          editor : {
              'type' : 'numberbox',
              'options' : {
                  'required':true,
                  'precision' : 0,
                  'min' : 1,
                  'groupSeparator' :'.',
                  'decimalSeparator' :','
              }
          }
        },
        {field:'action',title:'Action',width:150,align:'center',
          formatter:function(value,row,index){
            // console.log(this)
              if (row.editing){
                  var s = '<button type="button" class="btn-action-save" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp';
                  var c = '<button type="button" class="btn-action-cancel" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                  return s+c;
              } else {
                  var e = '<button type="button" class="btn-action-edit" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                  var d = '<button type="button" class="btn-action-delete" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
                  return e+d;
              }
          }
        }
        
        
      ]],
      onEndEdit:function(index,row){
          
      },
      onBeforeEdit:function(index,row){
          row.editing = true;
          $(this).datagrid('refreshRow', index);
      },
      onAfterEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      },
      onCancelEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      }
    });

    function saverowdetail(target){  
        $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
    }
    function editrowdetail(target){
        $('#dtg-detail_item').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterowdetail(target){
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
              }
        });
    }
    function cancelrowdetail(target){
        $('#dtg-detail_item').datagrid('cancelEdit', getRowIndex(target));
    }

    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function tab(tab)
    {
      if (tab==0){
        // $('#btn-browse').attr('disabled', true);
        // $('#btn-detail').attr('disabled', false);
        $('#browse').show();
        $('#detail').hide();
        filter();
      }
      else{
        // $('#btn-browse').attr('disabled', false);
        // $('#btn-detail').attr('disabled', true);
        $('#browse').hide();
        $('#detail').show();

        if(edit==2){
          // $('#btn-aksi').show();
          // $('#label-status').show();
          // $('#div-input-status').show();
        }
        else{
          // $('#btn-aksi').hide();
          // $('#label-status').hide();
          // $('#div-input-status').hide();
        }
      }
    }

    $('#btn-tambah_detail').click(function () {
        var id_unit_asal = $('#cmb-unit_asal').val();
        var id_unit_tujuan = $('#cmb-unit_tujuan').val();
        if(id_unit_asal == "" || id_unit_asal == null || id_unit_asal == undefined)
        {
            notif('warning','Harap Pilih Unit Asal');
            return false;
        }

        if(id_unit_tujuan == ""|| id_unit_tujuan == null || id_unit_tujuan == undefined)
        {
            notif('warning','Harap Pilih Unit Tujuan');
            return false;
        }

        $('#win-cari_data_item').window('open');

        filter_barang()
    });

    $('#btn-tutup_cari_dataitem').click(function () {
        $('#win-cari_data_item').window('close');
    });

    function filter()
    {
        $('#dtg-permintaan_bhp').datagrid('loadData',[]);
        var status = $('#cmb-status').val();
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date = toAPIDateFormat($('#dtb-end_date').val());
        var criteria = $('#txt-criteria').val();
      
        data={
          status : status,
          start_date : start_date,
          end_date : end_date,
          criteria : criteria,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-permintaan_bhp').datagrid({
          url : "<?php echo base_url("general/transaksi/Permintaan_bhp/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            // if (data.metadata.list_count<1)
            // {
            //   $.messager.alert('Warning','Daftar Kosong');
            // }
            return {
              total: data.metadata ? data.metadata.paging.rec_count : 0, 
              rows: data.list ? data.list : []
            }
          }
        });
    }

    function filter_barang()
    {
        $('#dtg-cari_barang').datagrid('loadData',[]);
        var criteria = $('#txt-criteria_data_unit').val();
        var id_unit_tujuan = $('#cmb-unit_tujuan').val();

        data={
          criteria : criteria,
          id_unit_tujuan : id_unit_tujuan,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-cari_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/Permintaan_bhp/filter_barang"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            console.log(data);
            // if (data.metadata.list_count<1)
            // {
            //   $.messager.alert('Warning','Daftar Kosong');
            // }
            return {
              total: data.metadata ? data.metadata.paging.rec_count : 0, 
              rows: data.list ? data.list : []
            }
          }
        });
    }

    $('#btn-pilih_barang').click(function(){
      var rows = $('#dtg-cari_barang').datagrid('getSelections');

      var rowGridList = $('#dtg-detail_item').datagrid('getRows');
      /*$('#dtg-detail_item').datagrid('loadData', []);*/
      if (edit==0) {
        $('#dtg-detail_item').datagrid('loadData', rows);
      }else{
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_item').datagrid('appendRow',{
              id_item : rows[i].id_item,
              kd_item : rows[i].kd_item,
              nama_item : rows[i].nama_item,
              nama_satuan : rows[i].nama_satuan,
              nama_kel_item : rows[i].nama_kel_item,
              jml_stok_all : rows[i].jml_stok_depo,
              jml_stok : rows[i].jml_stok,
              jml_mutasi : rows[i].jml_mutasi
          });
        }
      }
      $('#win-cari_data_item').window('close');
    });

    

    function hapus(row)
    {
        var no_pp = row.no_pp;
        
        data={
          no_pp : no_pp,
          user_id: "<?php echo $this->session->userdata['user_id'] ?>",
        } 
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                  $.ajax({
                    url : "<?php echo base_url("general/transaksi/Permintaan_bhp/hapus"); ?>",
                    type: "POST",
                    dataType: 'json',
                    data:{
                      data: data,
                      },
                    beforeSend: function (){               
                     },
                    success:function(data, textStatus, jqXHR){
                      notif('success',data.metadata.message);
                      filter();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        notif('error','something goes wrong');
                    },
                    complete: function(){
                    }
                  }); 
              }
        });
    }

    function default_auth()
    {
        $('#dtg-autorisasi').datagrid('loadData',[]);
        
        data={
          user_id :"<?php echo $this->session->userdata['user_id'] ?>"
        } 

        console.log(data);

        $.ajax({
          url : "<?php echo base_url("general/transaksi/Permintaan_bhp/default_auth"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            $('#dtg-autorisasi').datagrid('loadData', data.list);
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function status(status,no)
    {
        var no_pp = $('#txt-no').val();
        
        if (no==0)
        {
          no_pp = $('#txt-no').val();
        }
        else
        {
          no_pp = no;
        }

        if (no_pp=="")
        {
          return false;
        }

        var data={
          no_pm : no_pp,
          user_id : "<?= $this->session->userdata('user_id')?>"
        }

        // if (status!=1)
        // {
        //   data['user_id']=1;
        // }

        console.log(data);

        if (no==0)
        {
          swal.fire(costatus()).then(function(result) {
              if (result.value) {
               verifikasi(data,status);     
              }
          });
        }
        else
        {
          verifikasi(data,status);
        }

        // $.ajax({
        //   url : "<?php echo base_url("general/transaksi/Permintaan_bhp/status"); ?>",
        //   type: "POST",
        //   dataType: 'json',
        //   data:{
        //     data: data,
        //     status:status
        //     },
        //   beforeSend: function (){               
        //    },
        //   success:function(data, textStatus, jqXHR){
        //     tab(0);
        //     $.messager.alert('Success',data.metadata.message);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //       notif('error','something goes wrong');
        //   },
        //   complete: function(){
        //   }
        // }); 
    }

    function reset_button()
    {
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-cetak').show();
        
        $('#btn-open').show();
        $('#btn-release').show();
        $('#btn-approve').show();
        $('#btn-reject').show();
    }

    function verifikasi(data,status)
    {
      // body...
      var no_pp = data.no_pm;
      $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_bhp/status"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: data,
          status:status
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          if(status==1&&data.metadata.error==false)
          {
            reset_button();
            getDataByNo(no_pp);
            set_read(false);
          }
          else
          {
            tab(0);
            notif('success',data.metadata.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','something goes wrong');
        },
        complete: function(){
        }
      });
    }

    function simpan() {
      let tgl_pm = toAPIDateFormat($('#dtb-date_input').val());
      let id_unit_asal = $('#cmb-unit_asal').val();
      let id_unit_tujuan = $('#cmb-unit_tujuan').val();
      let ket_pm = $('#txt-desc').val();
      let no_pm = $('#txt-no').val();
      let user_id = "<?= $this->session->userdata('user_id')?>"

      if (id_unit_asal=="") {
        notif('warning','Unit Asal Tidak Boleh Kosong');
        return false;
      }

      if (id_unit_tujuan=="") {
        notif('warning',"Unit Tujuan Tidak Boleh Kosong");
        return false;
      }

      master={
        tgl_pm : tgl_pm,
        id_unit_asal : id_unit_asal,
        id_unit_tujuan : id_unit_tujuan,
        ket_pm : ket_pm,
        user_id : user_id
      }

      row = $('#dtg-detail_item').datagrid('getRows');
      if(row.length <= 0){
        notif('warning','Detail Harus Di isi');
        return false;
      } 
      var details = [];
      for (var i = 0 ; i < row.length; i++) {
        if (row[i]['jml_minta'] == '' || row[i]['jml_minta'] == undefined || row[i]['jml_minta'] == 0) {
          notif('warning','Jumlah Permintaan '+row[i]['id_item']+' tidak boleh Kosong');
          return false;  
        }

        details.push({
          id_item:row[i]['id_item'] ,
          id_satuan:row[i]['nama_satuan'],
          jml_stok:row[i]['jml_stok'],
          jml_minta:row[i]['jml_minta']
        })
      }

       // row = $('#dtg-autorisasi').datagrid('getRows');

       //  if(row.length <= 0){
       //    notif('warning','Autorisasi Harus Di isi');
       //    return false;
       //  }

       // var auths = [];

       //  for (var i=0; i<row.length; i++) {
       //    auths.push({
       //      sign_id : row[i]['sign_id'],
       //      user_id : row[i]['user_id'],
       //      is_default : row[i]['is_default'],
       //      seq_no : row[i]['seq_no']
       //    })
       //  }

        if(no_pm=="")
        {
           // alert('auth');
          // data['auths']=auths;
        }
        else
        {
          master['no_pm']=no_pm;
        }
      

        data['master']=master;
        data['details']=details;

      $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_bhp/simpan"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data:data,
          edit:edit,
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          if (edit==0)
              {
                swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value) {
                      status(2,data.metadata.no_pm);
                  }
                  else
                  {
                    tab(0);
                  }
                });
              }
          else
          {
            notif('success',data.metadata.message);
            tab(0);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','something goes wrong');
        },
        complete: function(){
        }
      }); 
    }

    function getData(row)
    {
      var row = $('#dtg-permintaan_bhp').datagrid('getSelected');
      if(row <= 0){
        notif('warning','Data Belum Di Pilih');
        return false;
      }

      if(row.status_caption!="Open"){
        set_read(true);
      }
      else{
        set_read(false);
      }
      $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_bhp/getPerKode"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: row.no_pm,
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          // console.log(data);
          set_form(data);
          tab(1);
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','something goes wrong');
        },
        complete: function(){
        }
      }); 
    }

    function getDataByNo(no_mutasi)
    {
        $.ajax({
          url : "<?php echo base_url("general/transaksi/Permintaan_bhp/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_mutasi,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            set_form(data);
            tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function set_form(data) {
      console.log()
      $('#txt-label_nopm').text("No. PP : "+data.master.no_pm);
      $('#txt-label_status').text("Status : "+data.master.status_caption);
      if(data.master.status_posting!=null||data.master.status_posting!=undefined){
        $('#txt-label_posted').text(" "+data.master.status_posting);
        if(data.master.status_posting=="Unposted"){
          $('#txt-label_posted').removeClass('posted');
          $('#txt-label_posted').addClass('unposted');
        }
        else{
          $('#txt-label_posted').removeClass('unposted');
          $('#txt-label_posted').addClass('posted');
        }
      }
      $('#txt-desc').val(data.master.ket_pm);
      $('#cmb-unit_asal').val(data.master.id_unit_asal).change();
      $('#cmb-unit_tujuan').val(data.master.id_unit_tujuan).change();
      $('#cmb-unit_tujuan').attr('disabled', true);
      $('#cmb-unit_asal').attr('disabled', true);
      $('#txt-no').val(data.master.no_pm);
      $('#dtb-date_input').val(toAppDateFormat(data.master.tgl_pm));
      $('#dtg-detail_item').datagrid('loadData', data.detail);
      // $('#dtg-autorisasi').datagrid('loadData', data.aut);
      $('#txt-status').val(data.master.status_caption);

      if(data.master.m_open==false)
      {
        $('#btn-open').hide();
      }
      if(data.master.m_release==false)
      {
        $('#btn-release').hide();
      }
      if(data.master.m_approve==false)
      {
        $('#btn-approve').hide();
      }
      if(data.master.m_reject==false)
      {
        $('#btn-reject').hide();
      }
      if(data.master.m_close==false)
      {
        $('#btn-close').hide();
      }
      if(data.master.m_cancel==false)
      {
        $('#btn-cancel').hide();
      }
    }

    // function btn_ubah(){
    //   edit=1;
    //   var row = $('#dtg-permintaan_bhp').datagrid('getSelected');
    //   if(row <= 0){
    //     notif('warning','Data Belum Di Pilih');
    //     return false;
    //   }
    //   reset_form();
    //   getData(row);
    // }

    function set_read(kondisi)
    {
      $('#txt-no').attr('disabled', true);
      $('#dtb-date_input').attr('disabled', kondisi);
      $('#cmb-unit_tujuan').attr('disabled', kondisi);
      $('#cmb-unit_asal').attr('disabled', kondisi);
      $('#txt-ket_pp').attr('disabled', kondisi);

      if (edit==0&&kondisi==false) //tambah
        {
          $('#div_status').hide();
          $('#cmb-data_unit').prop('disabled', false);
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();

          $('.div_simpan').show(); 

          $('#dtg-detail_item').datagrid('showColumn', 'action');
        }

        if (edit==1&&kondisi==false) //ubah 
        {

          $('#div_status').show();
          $('#cmb-data_unit').prop('disabled', true);
          $('#btn-aksi').show();
          $('#btn-hapus').show();
          $('#btn-cetak').show();

          $('.div_simpan').show();

          $('#dtg-detail_item').datagrid('showColumn', 'action');          
        }

        if (edit==1&&kondisi==true) //ubah readonly
        {

          $('#div_status').show();
          $('#cmb-data_unit').prop('disabled', true);
          $('#btn-aksi').show();
          $('#btn-hapus').hide();
          $('#btn-cetak').show();

          $('.div_simpan').hide();

          $('#dtg-detail_item').datagrid('hideColumn', 'action');
        }
    }

    function reset_form()
    {
        $('.div_simpan').show();
        $('#txt-no').attr('disabled', true);
        $('#txt-status').attr('disabled', true);
        $('#cmb-unit_tujuan').attr('disabled', false);
        $('#cmb-unit_asal').attr('disabled', false);
        $('#cmb-unit_tujuan').val("").change();
        $('#cmb-unit_asal').val('').change();
        $('#txt-no').val('');
        $('#dtb-date_input').val(appDateFormatter(new Date()));
        $('#txt-status_caption').val('');
        $('#txt-desc').val('');

        $('#btn-open').show();
        $('#btn-release').show();
        $('#btn-approve').show();
        $('#btn-reject').show();
        $('#btn-close').show();
        $('#btn-cancel').show();

        $('#dtg-detail_item').datagrid('loadData', []);
        // $('#dtg-autorisasi').datagrid('loadData', []);
    }

    // function status(status)
    // {
    //     var no_pm = $('#txt-no').val();

    //     if (no_pm=="")
    //     {
    //       return false;
    //     }

    //     var data={
    //       no_pm : no_pm
    //     }

    //     if (status!=1)
    //     {
    //       data['user_id']=1;
    //     }

    //     $.ajax({
    //       url : "<?php echo base_url("general/transaksi/Permintaan_bhp/status"); ?>",
    //       type: "POST",
    //       dataType: 'json',
    //       data:{
    //         data: data,
    //         status:status
    //         },
    //       beforeSend: function (){               
    //        },
    //       success:function(data, textStatus, jqXHR){
    //         tab(0);
    //         $.messager.alert('Success',data.metadata.message);
    //       },
    //       error: function(jqXHR, textStatus, errorThrown){
    //           notif('error','something goes wrong');
    //       },
    //       complete: function(){
    //       }
    //     }); 
    // }

    function hapus(row)
    {
        var no_pm = row.no_pm;
        
        data={
          no_pm : no_pm,
          user_id: "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        console.log(data);   
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $.ajax({
                      url : "<?php echo base_url("general/transaksi/Permintaan_bhp/hapus"); ?>",
                      type: "POST",
                      dataType: 'json',
                      data:{
                        data: data,
                        },
                      beforeSend: function (){               
                       },
                      success:function(data, textStatus, jqXHR){
                        notif('success',data.metadata.message);
                        tab(0);
                        // filter();
                      },
                      error: function(jqXHR, textStatus, errorThrown){
                          notif('error','something goes wrong');
                      },
                      complete: function(){
                      }
                    }); 
              }
        });
    }

</script>
<!-- end script -->
