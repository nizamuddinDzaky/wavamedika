<!-- Script easy ui -->
<script type="text/javascript">
    var edit=0;
    var detail_item;
    var data_detail_item;
    $(function () {
        tab(0);
        get_select();
        $('#dtg-autorisasi').datagrid('hideColumn', 'trans_sign_id');
        $('#dtg-autorisasi').datagrid('hideColumn', 'seq_no');
        $('#dtg-autorisasi').datagrid('hideColumn', 'sign_id');
        $('#dtg-autorisasi').datagrid('hideColumn', 'is_default');
        $('#dtg-autorisasi').datagrid('hideColumn', 'is_active');
        $('#dtg-autorisasi').datagrid('hideColumn', 'user_id_approve');
        $('#dtg-autorisasi').datagrid('hideColumn', 'user_id');
    });


        $('#btn-tambah').click(function () {
          edit = 0;
          reset_form();
          set_read(false);
          default_auth();
          get_select();
          $('#btn-hapus').hide();
          tab(1);
          // $('#btn-browse').attr('disabled', true);            
        });

        $('#btn-cek_autor').click(function () {
          var password = $('#txt-passwordcek').val();
          if(password=="ide"){
            // alert('hehe')
            status(1,0);
          }
          else{
            notif('warning','Password Salah')
          }
          // $('#btn-browse').attr('disabled', true);            
        });

        $('#btn-ubah').click(function () {
            var row = $('#dtg-mutasi_barang').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum Di Pilih')
                return false;
            }
            reset_form();
            set_read(false);
            getData(row.no_mutasi);
            edit = 1;
            // $('#btn-browse').attr('disabled', true);
        });

        $('#btn-tampil').click(function () {
            var row = $('#dtg-mutasi_barang').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum Di Pilih')
                return false;
            }
            reset_form();
            set_read(true);
            getData(row);
            edit = 2;
            $('.div_simpan').hide();
        });

        // $('#btn-hapus').click(function () {
        //     var row = $('#dtg-mutasi_barang').datagrid('getSelected');
        //     if(row <= 0)
        //     {
        //         $.messager.alert('Warning','Data Belum Di Pilih');
        //         return false;
        //     }
        //     hapus(row);
        // });


        $('#btn-batal').click(function () {
          tab(0);
        });


        $('#cmb-data_unit').select2({
          dropdownParent : $('#detail'),
          placeholder: 'Pilih unit'
        });

        

        $('#btn-open').click(function () {
          $('#alert').modal('show');
        });
        // $('#btn-release').click(function () {
        //   status(2);
        // });
        // $('#btn-approve').click(function () {
        //   status(3);
        // });

        $('#src-no_permintaan').searchbox({
            searcher: show_win_src_no_permintaan,
        });

        function show_win_src_no_permintaan() {
           var id_unit_asal  = $('#cmb-data_unit option:selected').val();
            if(id_unit_asal == "")
            {
                notif('warning','Harap Pilih Unit Asal')
                return false;
            }
            var id_unit_asal = $('#cmb-data_unit option:selected').val();
            // alert(id_unit_asal);
            $('#win-cari_no_permintaan').window('open');
            $('#dtb-start_tgl_barang').val(appDateFormatter(new Date()));
            $('#dtb-end_tgl_barang').val(appDateFormatter(new Date()));
            $('#dtg-list_barang').datagrid('loadData',[]);
            $('#dtg-list_barang_detail').datagrid('loadData',[]);
            filter_barang_all();
        }

        $('#btn-tutup_cari_no_permintaan').click(function () {
            $('#win-cari_no_permintaan').window('close');
            filter();
        });

         // $('#dtg-list_barang').datagrid({
         //            onSelect: function(rowIndex, rowData)
         //             {
         //               alert("test");
         //             }
         //         });


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

    function tab(tab)
    {
      if (tab==0)
      {
        $('#btn-browse').attr('disabled', true);
        $('#btn-detail').attr('disabled', false);
        $('#browse').show();
        $('#detail').hide();
        filter();
      }
      else
      {
        $('#btn-browse').attr('disabled', false);
        $('#btn-detail').attr('disabled', true);
        $('#browse').hide();
        $('#detail').show();
        if(edit==2||edit==1)
        {
          $('#btn-aksi').show();
        }
        else
        {
          $('#btn-aksi').hide();
        }
      }
    }

    function btn_tambah()
    {
      // body...
      edit = 0;
      reset_form();
      set_read(false);
      default_auth();
      tab(1);

    }

    $('#btn-tambah_detail').click(function () {
        var id_unit_asal  = $('#cmb-data_unit option:selected').val();
        var no_pm = $("#src-no_permintaan").searchbox('getValue');
        if(id_unit_asal == "")
        {
            notif('warning','Harap Pilih Unit Asal');
            return false;
        }
        if(no_pm == "")
        {
            notif('warning','Harap Pilih No. Permintaan')
            return false;
        }
        $('#win-cari_data_item').window('open');
        $("#txt-criteria_data_unit").val("No. Permintaan Mutasi : "+no_pm);
        filter_barang();
    });

    $('#btn-tutup_cari_dataitem').click(function () {
        $('#win-cari_data_item').window('close');
    });

    $('#dtg-mutasi_barang').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
           btn_ubah();
    }
    });

    function btn_ubah()
    {
      // body...
      edit = 1;
      var row = $('#dtg-mutasi_barang').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      reset_form();
      getData(row.no_mutasi);
      if(row.status_caption!="Open")
      {
        set_read(true);
      }
      else
      {
        set_read(false);
      }
    }

    function get_select()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("general/transaksi/mutasi_barang/get_data_unit"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-data_unit").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter()
    {
        $('#dtg-mutasi_barang').datagrid('loadData',[]);
        var status     = $('#cmb-status option:selected').val();
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date   = toAPIDateFormat($('#dtb-end_date').val());
        var criteria   = $('#txt-criteria').val();
      
        data={
          status : status,
          start_date : start_date,
          end_date : end_date,
          criteria : criteria,
          page:1,
          page_row:10
        } 

        // console.log(data);

        // $.ajax({
        //   url : "<?php echo base_url("general/transaksi/mutasi_barang/filter"); ?>",
        //   type: "POST",
        //   dataType: 'json',
        //   data:{
        //     data: data,
        //     },
        //   beforeSend: function (){               
        //    },
        //   success:function(data, textStatus, jqXHR){
        //     if (data.metadata.list_count<1)
        //     {
        //       $.messager.alert('Warning','Daftar Kosong');
        //     }
        //     $('#dtg-mutasi_barang').datagrid('loadData', data.list);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //       alert('Error,something goes wrong');
        //   },
        //   complete: function(){
        //   }
        // }); 

        var dg = $('#dtg-mutasi_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/mutasi_barang/filter"); ?>",
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

    function filter_barang()
    {
        $('#dtg-cari_barang').datagrid('loadData',[]);
        var no_pm        = $('#src-no_permintaan').val();
        var tgl_mutasi   = toAPIDateFormat($('#dtb-tgl_pp').val());
        var id_unit_stok = $('#cmb-data_unit option:selected').val();

        data={
          no_pm       : no_pm,
          tgl_mutasi  : tgl_mutasi,
          id_unit_stok: id_unit_stok
        } 

        $.ajax({
          url : "<?php echo base_url("general/transaksi/mutasi_barang/Filter_barang_no_mutasi"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if (data.row_count<1)
            {
              notif('info','Daftar Kosong');
            }
            $('#dtg-cari_barang').datagrid('loadData', data.data[0]);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        });

        // var dg = $('#dtg-cari_barang').datagrid({
        //   url : "<?php echo base_url("general/transaksi/mutasi_barang/Filter_barang_no_mutasi"); ?>",
        //   method: "POST",
        //   queryParams: data,
        //   loadFilter: function(data) {
        //     // if (data.metadata.list_count<1)
        //     // {
        //     //   $.messager.alert('Warning','Daftar Kosong');
        //     // }
        //     return {
        //       total: data.metadata ? data.metadata.paging.rec_count : 0, 
        //       rows: data.list[0] ? data.list : []
        //     }
        //   }
        // });
    }

    function filter_barang_all()
    {
        $('#dtg-list_barang').datagrid('loadData',[]);
        var tgl_mutasi   = toAPIDateFormat($('#dtb-tgl_pp').val());
        var criteria     = $('#txt-kriteria_barang_all').val();
        var id_unit_stok = $('#cmb-data_unit option:selected').val();
        var start_date   = toAPIDateFormat($('#dtb-start_tgl_barang').val());
        var end_date     = toAPIDateFormat($('#dtb-end_tgl_barang').val());

        data={
          no_pm       : "",
          start_date  : start_date,
          end_date    : end_date,
          tgl_mutasi  : tgl_mutasi,
          id_unit_stok: id_unit_stok,
          criteria    : criteria,
          page        : 1,
          page_row    : 10
        } 

        console.log(data);
        var dg = $('#dtg-list_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/mutasi_barang/filter_barang"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            // if (data.metadata.list_count<1)
            // {
            //   $.messager.alert('Warning','Daftar Kosong');
            // }
            // console.log(data.list[0]);
            data_detail_item=data;
            return {
              total: data.data ? data.paging.rec_count : 0, 
              rows : data.data ? data.data : []
            }
          },
           onSelect: function(rowIndex, rowData)
                     {
                       // alert(rowIndex);
                       console.log(rowData);
                       $('#dtg-list_barang_detail').datagrid('loadData', rowData.details);
                     }

        });
    }

    function reset_form()
    {
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
        $('#btn-release').hide();
        $('#btn-receive').hide();
        $('#btn-reject').hide();
    }

    function getData(no_mutasi)
    {
        $.ajax({
          url : "<?php echo base_url("general/transaksi/mutasi_barang/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_mutasi,
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
        detail_item=[];
        $('#txt-label_nopp').text("No. PP : "+data.master.no_mutasi);
      
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
        $('#txt-no_pp').val(data.master.no_mutasi);
        $('#dtb-tgl_pp').val(toAppDateFormat(data.master.tgl_mutasi));
        $('#txt-status_caption').val(data.master.status_caption);
        $('#cmb-data_unit').val(data.master.id_unit_stok).change();
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

          $('#dtg-detail_item').datagrid('hideColumn', 'action');
        }
        else
        {
          $('.div_simpan').show(); 
          $('#btn-hapus').show();

          $('#dtg-detail_item').datagrid('showColumn', 'action');
        }

    }

    $("#dtg-list_barang").datagrid({
      onDblClickRow:function(){
        pilih_no_pm();
      },
      
    })
    $("#dtg-list_barang_detail").datagrid({
      onSelect: function(index, row) {
        $(this).datagrid('unselectRow', index);
}
      
    })
    $("#btn-pilih").click(function(){
        pilih_no_pm();
    })

    function pilih_no_pm(){
        var row = $('#dtg-list_barang').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#src-no_permintaan').searchbox('setValue',row.no_pm);
        $('#txt-unit_tujuan').val(row.unit_asal);
        $('#txt-unit_tujuan_id').val(row.id_unit_asal);
        $('#txt-jenis_mutasi').val(row.jns_mutasi);
        $('#win-cari_no_permintaan').window('close');
    }

    $('#btn-pilih_barang').click(function(){
      var rows = $('#dtg-cari_barang').datagrid('getSelections');
      console.log(rows);
      var rowGridList = $('#dtg-detail_item').datagrid('getRows');
      //alert(rowGridListHutang.length);
      $('#dtg-detail_item').datagrid('loadData', []);
      if (edit==0) {
        $('#dtg-detail_item').datagrid('loadData', []);
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_item').datagrid('appendRow',{
              id_item    : rows[i].id_item,
              kd_item    : rows[i].kd_item,
              nama_item  : rows[i].nama_item,
              nama_satuan: rows[i].nama_satuan,
              jml_minta  : rows[i].jml_minta,
              jml_mutasi : rows[i].jml_mutasi,
              jml_sisa   : rows[i].jml_ss,
              hpp        : rows[i].niai_hpp,
              total      : (rows[i].jml_mutasi*rows[i].niai_hpp),
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
              id_item    : rows[i].id_item,
              kd_item    : rows[i].kd_item,
              nama_item  : rows[i].nama_item,
              nama_satuan: rows[i].nama_satuan,
              jml_minta  : rows[i].jml_minta,
              jml_mutasi : rows[i].jml_mutasi,
              jml_sisa   : rows[i].jml_ss,
              hpp        : rows[i].niai_hpp,
              total      : (rows[i].jml_mutasi*rows[i].niai_hpp),
          });
        }
      }
      $('#win-cari_data_item').window('close');
    });

    $('#dtg-detail_item').datagrid({
      title:'Detail Mutasi Barang',
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
        {field:'id_item',title:'No',width:100,halign:'center',align:'left'},
        {field:'kd_item',title:'Kode',width:80,halign:'center',align:'left'},
        {field:'nama_item',title:'Nama Item',width:400,halign:'center',align:'left'},
        {field:'nama_satuan',title:'Satuan',width:100,halign:'center',align:'left'},
        {
          field:'jml_minta',
          title:'Permintaan',
          width:100,
          halign:'center',
          align:'right',
          editor : {
                      'type' : 'numberbox',
                      'options' : {
                          'required':true,
                          'precision' : 0,
                          'min' : 1,
                          'groupSeparator' :'.',
                          'decimalSeparator' :','
                        }
                    },
          formatter: appGridNumberFormatter
        },
        {
            field:'jml_mutasi',title:'Disetujui',width:100,halign :"center",align:"right",formatter: appGridNumberFormatter
        },
        {
            field:'jml_sisa',title:'Sisa',width:100,halign :"center",align:"right",formatter: appGridNumberFormatter
        },
        {
            field:'hpp',title:'HPP',width:100,halign :"center",align:"right",formatter: appGridNumberFormatter,hidden:true
        },
        {
            field:'total',title:'Total',width:100,halign :"center",align:"right",formatter: appGridNumberFormatter
        },
        {field:'action',title:'Action',width:150,align:'center',
          formatter:function(value,row,index){
              if (row.editing){
                  var s = '<button type="button" class="btn-action-save" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
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
       swal.fire({
        "title"            : "Konfirmasi",
        "text"             : "Apakah Anda yakin akan menghapus data?",
        "type"             : "warning",
        "showCancelButton" : true,
        "confirmButtonText": "Ya",
        "cancelButtonText" : "Tidak",
        "reverseButtons"   : true,
        "customClass"      : {
        "confirmButton"    : "btn-danger",
        "cancelButton"     : "btn-secondary"
        }
        }).then(function(result) {
            if (result.value) {
              $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
            }
        });

        // $.messager.confirm('Confirm','Apakah Anda yakin akan menghapus data?',function(r){
        //     if (r){
        //       $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
        //     }
        // });
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
        var no_mutasi      = $('#txt-no_pp').val();
        var no_pm          = $('#src-no_permintaan').val();
        var tgl_pp         = toAPIDateFormat($('#dtb-tgl_pp').val());
        var id_unit_asal   = $('#cmb-data_unit option:selected').val();
        var id_unit_tujuan = $('#txt-unit_tujuan_id').val();
        var ket_pp         = $('#txt-ket_mutasi').val();
        var jns_mutasi     = $('#txt-jenis_mutasi').val();

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
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        master={
          no_mutasi     : no_mutasi,
          tgl_mutasi    : tgl_pp,
          id_unit_stok  : id_unit_asal,
          id_unit_tujuan: id_unit_tujuan,
          no_pm         : no_pm,
          jns_mutasi    : jns_mutasi,
          ket_mutasi    : ket_pp,
          user_id       : "<?php echo $this->session->userdata['user_id'] ?>",
        }

        row = $('#dtg-detail_item').datagrid('getRows');
        if(row.length <= 0){
          notif('warning','Detail Harus Di isi')
          return false;
        }
        for (var i=0; i<row.length; i++) {
          if (row[i]['jml_minta']=='' || row[i]['jml_minta'] == 0 || row[i]['jml_minta'] == undefined) {
            notif('warning','Jumlah Permintaan '+row[i]['no_mutasi']+' tidak boleh Kosong')
            $('#dtg-detail_item').datagrid('selectRow',i);
            $('#dtg-detail_item').datagrid('beginEdit',i);
            return false;
            break;
          }

          // if (row[i]['tgl_kebutuhan']=='' || row[i]['tgl_kebutuhan'] == undefined) {
          //   $.messager.alert('Warning','Tanggal Kebutuhan '+row[i]['no_mutasi']+' tidak boleh Kosong');
          //   $('#dtg-detail_item').datagrid('selectRow',i);
          //   $('#dtg-detail_item').datagrid('beginEdit',i);
          //   return false;
          //   break;
          // }
        }

        var details = [];
        for (var i=0; i<row.length; i++) {
          details.push({
            id_item   : row[i]['id_item'],
            id_satuan : row[i]['nama_satuan'],
            jml_minta : row[i]['jml_minta'],
            jml_mutasi: row[i]['jml_mutasi'],
            jml_sisa  : row[i]['jml_sisa'],
            hpp       : row[i]['hpp'],
            total     : row[i]['jml_mutasi']*row[i]['hpp'],
          })
        }

        row = $('#dtg-autorisasi').datagrid('getRows');

        var auths = [];

        for (var i=0; i<row.length; i++) {
          auths.push({
            sign_id        : row[i]['sign_id'],
            user_id        : row[i]['user_id'],
            is_default     : row[i]['is_default'],
            is_active      : row[i]['is_active'],
            user_id_approve: row[i]['user_id_approve'],
            seq_no         : row[i]['seq_no']
          })
        }

        if(no_mutasi=="")
        {
          data['auths']=auths;
        }
        else
        {
          master['no_mutasi']=no_mutasi;
        }


        data['master']  =master;
        data['details'] =details;
        // data['auths']   =auths;

        console.log(data);

        $.ajax({
          url : "<?php echo base_url("general/transaksi/mutasi_barang/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit:edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if(edit!=1){
            swal.fire({
                  "title"            : "Konfirmasi",
                  "text"             : data.msg_release,
                  "type"             : "question",
                  "showCancelButton" : true,
                  "confirmButtonText": "Ya",
                  "cancelButtonText" : "Tidak",
                  "reverseButtons"   : false,
                  "customClass"      : {
                    "confirmButton": "btn-primary",
                    "cancelButton" : "btn-secondary"
            }
            }).then(function(result) {
              if (result.value) {
                status(2,data.no_mutasi);
              }
              else{
                 tab(0);
              }
          });


            // var dlg = $.messager.confirm({
            //     title: 'Konfirmasi',
            //     msg: data.msg_release,
            //     buttons:[
            //       {
            //           text: 'Iya',
            //           onClick: function(){
            //               status(2,data.no_mutasi);
            //               dlg.dialog('destroy')

            //           }
            //       },
            //       {
            //           text: 'Tidak',
            //           onClick: function(){
            //               dlg.dialog('destroy');
            //               tab(0);
            //           }
            //       },
            //     ]
            //   })
              // swal.fire('Berhasil',data.message,'success');
            }
            else{
              notif('success',data.message);
              tab(0);
            }

          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function hapus(no_pp)
    {
        data={
          no_mutasi: no_pp,
          user_id  : "<?php echo $this->session->userdata['user_id'] ?>"
        } 

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
                      url : "<?php echo base_url("general/transaksi/mutasi_barang/hapus"); ?>",
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
                          alert('Error,something goes wrong');
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
          url : "<?php echo base_url("general/transaksi/mutasi_barang/default_auth"); ?>",
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
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function status(status,no)
    {
        var no_mutasi;
        if(no==0){
          var no_mutasi = $('#txt-no_pp').val();
        }
        else{
          no_mutasi=no;
        }
        if (no_mutasi=="")
        {
          return false;
        }

        var data={
          no_mutasi : no_mutasi
        }

        if (status!=1)
        {
          data['user_id']="<?php echo $this->session->userdata['user_id'] ?>";
        }

        console.log(data);
        
        if (no==0)
        {
           swal.fire({
        "title"            : "Konfirmasi",
        "text"             : "Apakah Anda yakin mengubah status?",
        "type"             : "question",
        "showCancelButton" : true,
        "confirmButtonText": "Ya",
        "cancelButtonText" : "Tidak",
        "reverseButtons"   : false,
        "customClass"      : {
          "confirmButton"    : "btn-primary",
          "cancelButton"     : "btn-secondary"
        }
        }).then(function(result) {
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
      var no_mutasi = data.no_mutasi;
      $.ajax({
        url : "<?php echo base_url("general/transaksi/mutasi_barang/status"); ?>",
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
            getData(no_mutasi);
            set_read(false);
          }
          else
          {
            tab(0);
            notif('success',data.message);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){

            notif('error','something goes wrong')
        },
        complete: function(){
        }
      });
          $('#alert').modal('hide');
    }

</script>
<!-- end script -->
