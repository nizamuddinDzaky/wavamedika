<!-- Script easy ui -->
<script type="text/javascript">
    var edit=0;
    var detail_item;
    var data_get = [];
    var id = "<?=$id?>"
    $(function () {
        
        // $(".dtb").val(setDateNow());
        if(id != ''){
          getData(id)
        }else{
          tab(0);
        }

        get_select();

        $('#dtg-autorisasi').datagrid('hideColumn', 'trans_sign_id');
        $('#dtg-autorisasi').datagrid('hideColumn', 'seq_no');
        $('#dtg-autorisasi').datagrid('hideColumn', 'sign_id');
        $('#dtg-autorisasi').datagrid('hideColumn', 'is_default');
        $('#dtg-autorisasi').datagrid('hideColumn', 'user_id');
        $('#dtg-autorisasi').datagrid('hideColumn', 'user_id_approve');

    });

    function tab(tab)
    {
      if (tab==0)
      {
        $('#browse').show();
        $('#detail').hide();
        filter();
      }
      else
      {
        $('#browse').hide();
        $('#detail').show();
      }
    }

    function btn_tambah()
    {
      // body...
      edit = 0;
      reset_form();
      set_read(false);
      default_auth();
      get_select();
      tab(1);
    }

    function btn_ubah()
    {
      // body...
      edit = 1;
      var row = $('#dtg-permintaan_pembelian').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum dipilih!');
          return false;
      }
      reset_form();
      getData(row.no_pp);
      if(row.status_caption!="Open")
      {
        set_read(true);
      }
      else
      {
        set_read(false);
      }
    }

    function btn_hapus()
    {
      // body...
      let no_pp = $('#txt-no_pp').val();
      let status_caption = $('#txt-status_caption').val();
      if(status_caption!="Open")
      {
          notif('error','Data Tidak Bisa dihapus!');
          return false;
      }
      hapus(no_pp);
    }

    $('#btn-tambah_detail').click(function () {
        var id_unit_asal = $('#cmb-data_unit option:selected').val();
        console.log(id_unit_asal);
        if(id_unit_asal == "" || id_unit_asal == 0 || id_unit_asal == undefined)
        {
            notif('warning','Harap Pilih Unit Asal!');
            return false;
        }
        $('#win-cari_data_item').window('open');
        filter_barang();
    });

    $('#btn-tutup_cari_dataitem').click(function () {
        $('#win-cari_data_item').window('close');
    });

    function get_select()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/get_data_unit"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-data_unit").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter()
    {
        $('#dtg-permintaan_pembelian').datagrid('loadData',[]);
        var status = $('#cmb-status option:selected').val();
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

        console.log(data);

        // $.ajax({
        //   url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/filter"); ?>",
        //   type: "POST",
        //   dataType: 'json',
        //   data:{
        //     data: data,
        //     },
        //   beforeSend: function (){               
        //    },
        //   success:function(data, textStatus, jqXHR){
        //     $('#dtg-permintaan_pembelian').datagrid('loadData', data.data);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //      alert('Error,something goes wrong');
        //      notif('error','Error,something goes wrong');
        //   },
        //   complete: function(){
        //   }
        // }); 

        var dg = $('#dtg-permintaan_pembelian').datagrid({
          url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/filter"); ?>",
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

    function filter_barang()
    {
        $('#dtg-cari_barang').datagrid('loadData',[]);
        var start_date = toAPIDateFormat($('#dtb-periode_start_date').val());
        var end_date = toAPIDateFormat($('#dtb-periode_end_date').val());
        var criteria = $('#txt-criteria').val();
        var id_unit_asal = $('#cmb-data_unit option:selected').val();

        data={
          start_date : start_date,
          end_date : end_date,
          criteria : criteria,
          id_unit_asal : id_unit_asal,
          page:1,
          page_row:10
        } 

        console.log(data);

        // $.ajax({
        //   url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/filter_barang"); ?>",
        //   type: "POST",
        //   dataType: 'json',
        //   data:{
        //     data: data,
        //     },
        //   beforeSend: function (){               
        //    },
        //   success:function(data, textStatus, jqXHR){
        //     $('#dtg-cari_barang').datagrid('loadData', data.daya);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //      alert('Error,something goes wrong');
        //      notif('error','Error,something goes wrong');
        //   },
        //   complete: function(){
        //   }
        // });

        var dg = $('#dtg-cari_barang').datagrid({
          url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/filter_barang"); ?>",
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

    function reset_form()
    {
        data_get = [];

        $('.div_simpan').show();
        $('.status_caption').hide();

        $('#txt-label_nopp').text("No. PP : ");
        $('#txt-label_status').text("Status : ");
        $('#txt-label_posted').text(" ");

        $('#txt-no_pp').val('');
        $('#dtb-tgl_pp').val(appDateFormatter(new Date()));
        $('#txt-status_caption').val('');
        $('#cmb-data_unit').val('');
        $('#txt-ket_pp').val('');

        reset_button();

        $('#dtg-detail_item').datagrid('loadData', []);
        $('#dtg-autorisasi').datagrid('loadData', []);
    }

    function reset_button()
    {
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-cetak').show();
        
        $('#btn-open').hide();
        $('#btn-release').hide();
        $('#btn-approve').hide();
        $('#btn-reject').hide();
    }

    function getData(no_pp)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_pp,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            set_data(data);
            tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function set_data(data)
    {
        data_get = data;
        detail_item=[];
        $('#txt-label_nopp').text("No. PP : "+data.master.no_pp);

        if(data.master.status_caption!=null||data.master.status_caption!=undefined)
        {
          $('#txt-label_status').text("Status : "+data.master.status_caption);
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

        $('#txt-no_pp').val(data.master.no_pp);
        $('#dtb-tgl_pp').val(toAppDateFormat(data.master.tgl_pp));
        $('#txt-status_caption').val(data.master.status_caption);
        $('#cmb-data_unit').val(data.master.id_unit_asal).change();
        $('#txt-ket_pp').val(data.master.ket_pp);

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
        if(data.master.m_approve==true)
        {
          $('#btn-approve').show();
        }
        if(data.master.m_reject==true)
        {
          $('#btn-reject').show();
        }
    }

    function set_read(kondisi)
    {
        $('#txt-no_pp').attr('readonly', true);
        $('#txt-status_caption').attr('readonly', true);
        $('#dtb-tgl_pp').attr('readonly', kondisi);
        $('#cmb-data_unit').prop('disabled', kondisi);
        $('#txt-ket_pp').attr('readonly', kondisi);

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
          $('#dtb-tgl_pp').attr('readonly', true);
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

    $('#btn-pilih_barang').click(function(){
      var rows = $('#dtg-cari_barang').datagrid('getSelections');

      var rowGridList = $('#dtg-detail_item').datagrid('getRows');
      $('#dtg-detail_item').datagrid('loadData', []);
      if (edit==0) {
        $('#dtg-detail_item').datagrid('loadData', []);
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_item').datagrid('appendRow',{
              id_item : rows[i].id_item,
              kd_item : rows[i].kd_item,
              nama_item : rows[i].nama_item,
              nama_satuan : rows[i].nama_satuan,
              nama_kel_item : rows[i].nama_kel_item,
              jml_stok_all : rows[i].jml_stok_depo,
              jml_stok : rows[i].jml_stok,
              jml_mutasi : rows[i].jml_mutasi,
              jml_minta : 1,
              tgl_kebutuhan:setDateNow()
            });
        }
      }else{
        // for (i=0;i<rowGridList.length;i++)
        // {
        //   $('#dtg-detail_item').datagrid('deleteRow', i);
        // }
        $('#dtg-detail_item').datagrid('loadData', []);
        $('#dtg-detail_item').datagrid('loadData', detail_item);
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_item').datagrid('appendRow',{
              id_item : rows[i].id_item,
              kd_item : rows[i].kd_item,
              nama_item : rows[i].nama_item,
              nama_satuan : rows[i].nama_satuan,
              nama_kel_item : rows[i].nama_kel_item,
              jml_stok_all : rows[i].jml_stok_depo,
              jml_stok : rows[i].jml_stok,
              jml_mutasi : rows[i].jml_mutasi,
              jml_minta : 1,
              tgl_kebutuhan:setDateNow()
          });
        }
      }
      $('#win-cari_data_item').window('close');
    });

    $('#dtg-permintaan_pembelian').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
           btn_ubah();
        }
    });

    $('#dtg-detail_item').datagrid({
      title:'Detail Permintaan Pembelian',
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
        {field:'nama_item',title:'Nama Item',width:390,halign:'center',align:'left'},
        {field:'nama_satuan',title:'Satuan',width:100,halign:'center',align:'left'},
        {field:'nama_kel_item',title:'Jenis',width:100,halign:'center',align:'left'},
        {
          field:'jml_stok_all',
          title:'Stok All Depo',
          width:90,
          halign:'center',
          align:'right',
          formatter:appGridNumberFormatter,
          editor : {
              'options' : {
                  'required':true,
                  'precision' : 0,
                  'min' : 0,
                  'groupSeparator' :'.',
                  'decimalSeparator' :','
              }
          }
        },
        {
          field:'jml_stok',
          title:'Stok',
          width:80,
          halign:'center',
          align:'right',
          formatter:appGridNumberFormatter,
          editor : {
              'options' : {
                  'required':true,
                  'precision' : 0,
                  'min' : 0,
                  'groupSeparator' :'.',
                  'decimalSeparator' :','
              }
          }
        },
        {
          field:'jml_mutasi',
          title:'Pemakaian',
          width:80,
          halign:'center',
          align:'right',
          formatter:appGridNumberFormatter,
          editor : {
              'options' : {
                  'required':true,
                  'precision' : 0,
                  'min' : 0,
                  'groupSeparator' :'.',
                  'decimalSeparator' :','
              }
          }
        },
        {
          field:'jml_minta',
          title:'Permintaan',
          width:80,
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
        {
            field : 'tgl_kebutuhan',
            title : 'Tgl Kebutuhan',
            width : 90,
            halign : 'center',
            align : 'center',
            formatter:appGridDateFormatter,
            editor : {
                type : 'datebox'
            }
        },
        {field:'action',title:'Action',width:150,align:'center',
          formatter:function(value,row,index){
              if (row.editing){
                  var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp';
                  var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                  return s+c;
              } else {
                  var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp';
                  var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
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
          // console.log();
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

    function simpan()
    {
        // var data=[];
        var no_pp = $('#txt-no_pp').val();
        var tgl_pp = toAPIDateFormat($('#dtb-tgl_pp').val());
        var id_unit_asal = $('#cmb-data_unit option:selected').val();
        var ket_pp = $('#txt-ket_pp').val();

        if (tgl_pp == ''||
        id_unit_asal == ''||
        ket_pp == '')
        {
          let msg = '<br>';
          if (tgl_pp == '') {
            msg += 'Tanggal PP <br>';
          }

          if (id_unit_asal == '') {
            msg += 'Unit Asal <br>';
          }

          if (ket_pp == '') {
            msg += 'Catatan <br>';
          }

          notif('warning',msg + ' Tidak Boleh Kosong!');
          return false;
        }

        master={
          tgl_pp : tgl_pp,
          id_unit_asal : id_unit_asal,
          ket_pp : ket_pp,
          user_id: "<?php echo $this->session->userdata['user_id'] ?>",
        }

        row = $('#dtg-detail_item').datagrid('getRows');
        if(row.length <= 0){
          notif('warning','Detail Harus di isi!');
          return false;
        }
        for (var i=0; i<row.length; i++) {
          if (row[i]['jml_minta']=='' || row[i]['jml_minta'] == 0 || row[i]['jml_minta'] == undefined) {
            notif('warning', 'Jumlah Permintaan ID'+row[i]['id_item']+' tidak boleh Kosong');
            $('#dtg-detail_item').datagrid('selectRow',i);
            $('#dtg-detail_item').datagrid('beginEdit',i);
            return false;
            break;
          }

          if (row[i]['tgl_kebutuhan']=='' || row[i]['tgl_kebutuhan'] == undefined) {
            notif('warning','Tanggal Kebutuhan ID'+row[i]['id_item']+' tidak boleh Kosong');
            $('#dtg-detail_item').datagrid('selectRow',i);
            $('#dtg-detail_item').datagrid('beginEdit',i);
            return false;
            break;
          }
        }

        var details = [];
        for (var i=0; i<row.length; i++) {
          details.push({
            id_item : row[i]['id_item'],
            id_satuan : row[i]['nama_satuan'],
            jml_stok_depo : row[i]['jml_stok_all'],
            jml_mutasi : row[i]['jml_mutasi'],
            jml_stok : row[i]['jml_stok'],
            jml_minta : row[i]['jml_minta'],
            tgl_kebutuhan : setDate(row[i]['tgl_kebutuhan']),
          })
        }

        row = $('#dtg-autorisasi').datagrid('getRows');

        if(row.length <= 0){
          notif('warning','Autorisasi Harus di isi!');
          return false;
        }

        var auths = [];

        for (var i=0; i<row.length; i++) {
          auths.push({
            sign_id : row[i]['sign_id'],
            user_id : row[i]['user_id'],
            is_default : row[i]['is_default'],
            seq_no : row[i]['seq_no']
          })
        }

        if(no_pp=="")
        {
          data['auths']=auths;
        }
        else
        {
          master['no_pp']=no_pp;
        }

        data['master']=master;
        data['details']=details;

        console.log(data);

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit:edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if (edit==0)
            {
              swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value) {
                      status(2,data.no_pp);
                  }
                  else
                  {
                    tab(0);
                  }
              }); 
            }
            else
            {
              notif('success',data.message);
              tab(0);
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function hapus(no_pp)
    {
        data={
          no_pp : no_pp,
          user_id: "<?php echo $this->session->userdata['user_id'] ?>"
        } 

        // console.log(data);

        swal.fire(cohapus()).then(function(result) {
            if (result.value) {
                $.ajax({
                  url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/hapus"); ?>",
                  type: "POST",
                  dataType: 'json',
                  data:{
                    data: data,
                    },
                  beforeSend: function (){               
                   },
                  success:function(data, textStatus, jqXHR){
                    notif('success',data.message);
                    tab(0);
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                      // alert('Error,something goes wrong');
                      notif('error','Error,something goes wrong');
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
          user_id : "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        console.log(data);

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/default_auth"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            $('#dtg-autorisasi').datagrid('loadData', data.data);
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function status(status,no)
    {   
        var no_pp;
        if (no==0)
        {
          no_pp = $('#txt-no_pp').val();
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
          no_pp : no_pp
        }

        if (status!=1)
        {
          data['user_id']="<?php echo $this->session->userdata['user_id'] ?>";
        }

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
    }

    function verifikasi(data,status)
    {
      // body...
      var no_pp = data.no_pp;
      $.ajax({
        url : "<?php echo base_url("farmasi/gudang/permintaan_pembelian/status"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: data,
          status:status
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          if(status==1&&data.success==true)
          {
            reset_button();
            getData(no_pp);
            set_read(false);
            notif('success',data.message);
          }
          else
          {
            tab(0);
            notif('success',data.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
            // alert('Error,something goes wrong');
            notif('error','Error,something goes wrong');
        },
        complete: function(){
        }
      });
    }

    function cetak()
    {
      $('#loader').css('display','');
      
      console.log(data_get);

        $.ajax({
            url     : "<?= base_url() ?>farmasi/gudang/permintaan_pembelian/cetak",
            type    : "POST",
          dataType: 'json',	
            data:data_get,
          success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
              let file_cetak = "Laporan_Permintaan_Pembelian_Farmasi.pdf";
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
<!-- end script -->
