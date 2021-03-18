<script type="text/javascript">
  var edit=0;
  var baru ="";
  var data_cetak=[];
  get_select();
  $(function(){
    tab(0);

    $('#btn-tambah_detail').click(function () {
      ambil_item()
    })

    $('#btn-tambah').click(function(event) {
      edit=0;
      baru="new";
      reset_form()
      set_read();
      tab(1);
      $('#btn-hapus').hide();
      default_auth();
    });

    $('#btn-kembali').click(function(event) {
      tab(0);
    });

    $('#btn-batal').click(function(event) {
      tab(0);
    });

    $('#cmb-unit_detail').select2({
      required:true
    })
  });

  $('#dtg-permintaan_pembelian_rop').datagrid({
        singleSelect:true,
        onDblClickRow:function(index,row){
          edit = 1;
          reset_form();
          set_read();
          getData(row.no_pp);
        }
    });

    $('#dtg-detail_item').datagrid({
        title:'Detail Permintaan ROP',
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
          $('#dtg-detail_item').datagrid('beginEdit', index);
        },
        columns:[[
          {field:'id_item',title:'Id',width:50,halign:'center',align:'left',hidden:true},
          {field:'kd_item',title:'Kode',width:80,halign:'center',align:'left'},
          {field:'nama_item',title:'Nama Item',width:400,halign:'center',align:'left'},
          {field:'nama_satuan',title:'Satuan',width:100,halign:'center',align:'center'},
          {field:'nama_kel_item',title:'Jenis',width:100,halign:'center',align:'center'},
          {field:'jml_stok_depo',title:'Stok All Depo',width:100,halign:'center',align:'right',formatter:appGridNumberFormatter},
          {field:'jml_stok',title:'Stok',width:100,halign:'center',align:'right',formatter:appGridNumberFormatter},
          {field:'jml_mutasi',title:'Pemakaian',width:100,halign:'center',align:'right', formatter:appGridNumberFormatter},
          {field:'jml_ss',title:'Safety Stok (SS)',width:100,halign:'center',align:'right', formatter:appGridNumberFormatter},
          {field:'jml_rekam_order',title:'Rekam Order',width:100,halign:'center',align:'right', formatter:appGridNumberFormatter},
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
                  'min' : 0,
                  'groupSeparator' :'.',
                  'decimalSeparator' :','
              }
            }
          },
          {field:'tgl_kebutuhan',title:'Tgl. Kebutuhan',width:100,halign:'center',align:'right', formatter:appGridDateFormatter},
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

    function tab(tab){
      if(tab==0){
        if(baru=='new'){
          window.location.reload(true)
        }
        $('#browse').show();
        $('#detail').hide();
        filter(true);
      }
      else{
        $('#browse').hide();
        $('#detail').show();
      }
    }

    function set_read(){
      if(edit==0){
        $('#div_status').hide();
        $('#btn-aksi').hide();
        // $('.div_simpan').show();
      }
      else{
        // $('.div_simpan').hide();
        $('#div_status').show();
        $('#btn-aksi').show();
      }
    }

    function get_select()
    {
      $.ajax({
          url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/get_data_unit"); ?>",
          type: "POST",
          dataType: 'json',
          beforeSend: function (){               
          },
          success:function(data, textStatus, jqXHR){
             $("#cmb-unit_detail").select2({ data: data });
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
      });
    }

    function ambil_item() {
      $('#dtg-detail_item').datagrid('loadData',[]);
      var tgl_pp = toAPIDateFormat($('#dtb-date_input').val());
      var id_unit_asal = $("#cmb-unit_detail").val();
    
      if (tgl_pp == '') {
        notif('warning','Data Tanggal Belum dipilih!');
        return false;
      }

      if (id_unit_asal == '') {
        notif('warning','Data Unit Belum dipilih!');
        return false;
      }

      data={
        tgl_pp      : tgl_pp,
        id_unit_asal: id_unit_asal,
        page        : 1,
        page_row    : 10
      } 

      var dg = $('#dtg-detail_item').datagrid({
        url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/list_item"); ?>",
        method: "POST",
        queryParams: data,
        loadFilter: function(data) {
          return {
            total: data.rec_count ? data.rec_count : 0, 
            rows: data.data ? data.data : []
          }
        }
      });
    }

    function default_auth()
    {
        $('#dtg-autorisasi').datagrid('loadData',[]);
        
        data={
          user_id : "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/default_auth"); ?>",
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
    function simpan() {
      var no_pp = $('#txt-no').val();
      var tgl_pp = toAPIDateFormat($('#dtb-date_input').val());
      var id_unit_asal = $("#cmb-unit_detail").val();
      var ket_pp = $("#txt-desc").val();
      var row = $('#dtg-detail_item').datagrid('getRows');
      
      if (tgl_pp == '') {
        notif('warning','Data Tanggal Belum dipilih!');
        return false;
      }

      if (id_unit_asal == '') {
        notif('warning','Data Unit Belum dipilih!');
        return false;
      }

      if (ket_pp == '') {
        notif('warning','Catatan Tidak Boleh Kosong');
        return false;
      }

      if(row.length <= 0){
        notif('warning','Detail Harus di isi!');
        return false;
      }

      master={
        tgl_pp : tgl_pp,
        id_unit_asal : id_unit_asal,
        ket_pp : ket_pp,
        user_id: "<?php echo $this->session->userdata['user_id'] ?>",
      }

      var details = [];
      for (var i=0; i<row.length; i++) {
        if (row[i]['jml_minta'] == '') {
          notif('warning','Permintaan dengan kode '+row[i]['kd_item']+' Tidak Valid');
          return false;
          break;
        }else{
          details.push({
            id_item        : row[i]['id_item'],
            id_satuan      : row[i]['nama_satuan'],
            jml_stok_depo  : row[i]['jml_stok_depo'],
            jml_mutasi     : row[i]['jml_mutasi'],
            jml_stok       : row[i]['jml_stok'],
            jml_minta      : row[i]['jml_minta'],
            jml_ss         : row[i]['jml_ss'],
            jml_rekam_order: row[i]['jml_rekam_order'],
            tgl_kebutuhan  : setDate(row[i]['tgl_kebutuhan']),
          });
        }
      }
      
      row = $('#dtg-autorisasi').datagrid('getRows');

      if(row.length <= 0){
        notif('warning','Autorisasi Harus di isi!');
        return false;
      }

      var auths = [];

      for (var i=0; i<row.length; i++) {
        auths.push({
          sign_id   : row[i]['sign_id'],
          user_id   : row[i]['user_id'],
          is_default: row[i]['is_default'],
          seq_no    : row[i]['seq_no']
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

      $.ajax({
        url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/simpan"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: data,
          edit:edit,
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          console.log(data);
          console.log(data.msg_release);
          if (edit==0)
          {
            swal.fire(corelease(data.msg_release)).then(function(result) {
                if (result.value) {
                  var dataVerifikasi = {
                    no_pp : data.no_pp,
                    user_id : "<?php echo $this->session->userdata['user_id'] ?>"
                  }
                  verifikasi(dataVerifikasi, 'release')
                    // status('release');
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

    function filter(resetStatus)
    {
      if (resetStatus) {
        $('#cmb-status').val(0).change();
      }

      $('#dtg-permintaan_pembelian_rop').datagrid('loadData',[]);
      var status = $('#cmb-status').val();
      var start_date = toAPIDateFormat($('#dtb-start_date').val());
      var end_date = toAPIDateFormat($('#dtb-end_date').val());
      var criteria = $('#txt-criteria').val();
    
      data={
        status    : status,
        start_date: start_date,
        end_date  : end_date,
        criteria  : criteria,
        page      : 1,
        page_row  : 10
      } 

      var dg = $('#dtg-permintaan_pembelian_rop').datagrid({
        url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/filter"); ?>",
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

    function reset_form() {
      data_cetak=[];
      $('.div_simpan').show();
      $('#btn-tambah_detail').show();
      $('#dtb-date_input').val(appDateFormatter(new Date()));
      $("#txt-desc").val('');
      $('#txt-no').val('');
      $('#cmb-unit_detail').prop('disabled', false);
      $("#cmb-unit_detail").val('').change();
      $('#dtg-detail_item').datagrid('loadData',[]);
      $('#dtg-autorisasi').datagrid('loadData',[]);
    }

    function getData(no_pp)
    {
      $.ajax({
        url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/getPerKode"); ?>",
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
            notif('error','Error,something goes wrong');
        },
        complete: function(){
        }
      }); 
    }

    function set_data(data) {
      data_cetak=data;
      $('#dtb-date_input').val(toAppDateFormat(data.master.tgl_pp));
      $('#txt-no').val(data.master.no_pp);
      $('#txt-label_nopp').text('No. PP : '+data.master.no_pp);
      $('#txt-label_status').text('Status : '+data.master.status_caption);
      $('#cmb-unit_detail').prop('disabled', true);
      $("#txt-desc").val(data.master.ket_pp);
      $("#cmb-unit_detail").val(data.master.id_unit_asal).change();
      $('#dtg-detail_item').datagrid('loadData',data.detail);
      $('#dtg-autorisasi').datagrid('loadData',data.autor);
      
      $('#btn-tambah_detail').hide();


      if (data.master.status_caption == 'Open') {
        $('.div_simpan').show()
        $('#btn-hapus').show();
      }else{
        $('.div_simpan').hide()
        $('#btn-hapus').hide();
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

      /*$('#btn-open').hide(!data.master.m_open);
      $('#btn-approve').hide(!data.master.m_approve);
      $('#btn-reject').hide(!data.master.m_reject);*/
      $('#btn-release').attr('hidden', false)

      $('#btn-open').attr('hidden', !data.master.m_open);
      $('#btn-approve').attr('hidden', !data.master.m_approve);
      $('#btn-reject').attr('hidden', !data.master.m_reject);
      $('#btn-release').attr('hidden', !data.master.m_release);
    }

    function status(status) {
      var data={
        no_pp : $('#txt-no').val(),
        user_id : "<?php echo $this->session->userdata['user_id'] ?>"
      }
      swal.fire(costatus()).then(function(result) {
          if (result.value) {
              verifikasi(data,status);
          }
      });
    }

    function verifikasi(data,status) {
      console.log(data);
      var no_pp = data.no_pp;
      $.ajax({
        url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/status"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: data,
          status:status
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          if(status=='open'&&data.success==true)
          {
            getData(no_pp);
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

    function hapus() {
      let no_pp = $('#txt-no').val();
      let status_caption = $('#txt-status_caption').val();
      
      data={
        no_pp : no_pp,
        user_id: "<?php echo $this->session->userdata['user_id'] ?>"
      } 

      // console.log(data);

      swal.fire(cohapus()).then(function(result) {
          if (result.value) {
              $.ajax({
                url : "<?php echo base_url("farmasi/gudang/Permintaan_pembelian_rop/hapus"); ?>",
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

    function cetak(){
      $('#loader').css('display','');
      // console.log(data_cetak);

        $.ajax({
            url     : "<?= base_url() ?>farmasi/gudang/permintaan_pembelian_rop/cetak",
            type    : "POST",
          dataType: 'json', 
            data:data_cetak,
          success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
              var file_cetak = "Laporan_Permintaan_Pembelian_ROP.pdf";
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