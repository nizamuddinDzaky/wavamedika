<!-- Script easy ui -->
<script type="text/javascript">
    var edit=0;
    var detail_item;
    var data_detail_item;
    var data_cetak=[];
    $(function () {
        tab(0);
        get_select();
    });
        $('#btn-batal_item').on('click',function(){
            $('#win-cari_data_item').window('close');
        });
        
        $('#dtg-retur_barang').datagrid({
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
           btn_ubah();
        },
        columns:[[
            {field:'no_rt_mutasi',title:'No. Retur',width:"12%",halign:'center',align:'center'},
            {field:'tgl_rt_mutasi',title:'Tgl. Retur',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'unit_stok',title:'Unit Asal',width:"20%",halign:'center',align:'left'},
            {field:'ket_rt_mutasi',title:'Catatan',width:"10%",halign:'center',align:'left'},
            {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'left'},
            {field:'created_by',title:'Dibuat Oleh',width:"15%",halign:'center',align:'left',},
            {field:'date_ins',title:'Tgl. Dibuat',width:"10%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'Diubah Oleh',width:"15%",halign:'center',align:'left'},
            {field:'date_upd',title:'Tgl. Diubah',width:"10%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
        });

        $('#btn-tambah').click(function () {
          edit = 0;
          reset_form();
          set_read(false);
          get_select();
          $('#btn-hapus').hide();
          tab(1);
          // $('#btn-browse').attr('disabled', true);            
        });

        $('#btn-ubah').click(function () {
            var row = $('#dtg-retur_barang').datagrid('getSelected');
            if(row <= 0)
            {
                notif('warning','Data Belum Di Pilih')
                return false;
            }
            reset_form();
            set_read(false);
            getData(row.no_rt_mutasi);
            edit = 1;
            // $('#btn-browse').attr('disabled', true);
        });

        $('#btn-tampil').click(function () {
            var row = $('#dtg-retur_barang').datagrid('getSelected');
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
        //     var row = $('#dtg-retur_barang').datagrid('getSelected');
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


        $('#cmb-unit_asal').select2({
          dropdownParent : $('#detail'),
          placeholder: 'Pilih unit'
        });

        

        // $('#btn-open').click(function () {
        //   status(1);
        // });
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
           var id_unit_asal  = $('#cmb-unit_asal option:selected').val();
            if(id_unit_asal == "")
            {
                notif('warning','Harap Pilih Unit Asal')
                return false;
            }
            var id_unit_asal = $('#cmb-unit_asal option:selected').val();
            // alert(id_unit_asal);
            $('#win-cari_no_permintaan').window('open');
            
            var dga = $('#dtg-list_barang').datagrid();
            $('#dtg-list_barang').datagrid('loadData',[]);

            var dgb = $('#dtg-list_barang_detail').datagrid();
            $('#dtg-list_barang_detail').datagrid('loadData',[]);
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
          let no_pp = $('#txt-no').val();
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
      tab(1);
    }

    $('#btn-tambah_item').click(function () {
        var id_unit_asal  = $('#cmb-unit_asal option:selected').val();
        if(id_unit_asal == "")
        {
            notif('warning','Harap Pilih Unit Asal');
            return false;
        }
        $('#win-cari_data_item').window('open');
        filter_barang();
    });

    $('#btn-tutup_cari_dataitem').click(function () {
        $('#win-cari_data_item').window('close');
    });

    $('#dtg-retur_barang').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
           btn_ubah();
    }
    });

    function btn_ubah()
    {
      // body...
      edit = 1;
      var row = $('#dtg-retur_barang').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      reset_form();
      getData(row.no_rt_mutasi);
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
            url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/get_data_unit"); ?>",
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

    function filter()
    {
        $('#dtg-retur_barang').datagrid('loadData',[]);
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
        //   url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/filter"); ?>",
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
        //     $('#dtg-retur_barang').datagrid('loadData', data.list);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //       alert('Error,something goes wrong');
        //   },
        //   complete: function(){
        //   }
        // }); 

        var dg = $('#dtg-retur_barang').datagrid({
          url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/filter"); ?>",
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
        var tgl_rt_mutasi   = toAPIDateFormat($('#dtb-date_input').val());
        var id_unit_stok = $('#cmb-unit_asal option:selected').val();
        var criteria     = $("#txt-kriteria_cari_nomutasi").val();

        data={
          tgl_rt_mutasi: tgl_rt_mutasi,
          id_unit_stok : id_unit_stok,
          criteria     : criteria,
          page_row     : 10,
          page         : 1
        } 

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/Filter_barang_no_mutasi"); ?>",
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
            $('#dtg-data_item').datagrid('loadData', data.data);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        });

        // var dg = $('#dtg-cari_barang').datagrid({
        //   url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/Filter_barang_no_mutasi"); ?>",
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
        var tgl_rt_mutasi   = toAPIDateFormat($('#dtb-date_input').val());
        var criteria     = $('#txt-kriteria_barang_all').val();
        var id_unit_stok = $('#cmb-unit_asal option:selected').val();
        var start_date   = toAPIDateFormat($('#dtb-start_tgl_barang').val());
        var end_date     = toAPIDateFormat($('#dtb-end_tgl_barang').val());

        data={
          no_pm       : "",
          start_date  : start_date,
          end_date    : end_date,
          tgl_rt_mutasi  : tgl_rt_mutasi,
          id_unit_stok: id_unit_stok,
          criteria    : criteria,
          page        : 1,
          page_row    : 10
        } 

        console.log(data);
        var dg = $('#dtg-list_barang').datagrid({
          url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/filter_barang"); ?>",
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
        data_cetak=[];
        $('.div_simpan').show();
        $('#txt-no').attr('disabled', true);
        $('#txt-no').val('');
        $('#dtb-date_input').val(appDateFormatter(new Date()));
        $('#txt-status_caption').val('');
        $('#cmb-unit_asal').val('');
        $('#txt-ket_rt_mutasi').val('');
        $('#txt-desc').val('');
        $('#txt-unit_tujuan').val('');

        $('#btn-open').show();
        $('#btn-release').show();
        $('#btn-receive').show();
        $('#btn-approve').show();
        $('#btn-reject').show();
        $('#btn-close').show();
        $('#btn-cancel').show();

        reset_button();

        $('#dtg-detail_ed').datagrid('loadData', []);
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

    function getData(no_rt_mutasi)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_rt_mutasi,
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
        data_cetak=data;
        detail_item=[];
        $('#txt-label_noed').text("No. Retur : "+data.master.no_rt_mutasi);
      
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
        $('#txt-no').val(data.master.no_rt_mutasi);
        $('#dtb-date_input').val(toAppDateFormat(data.master.tgl_rt_mutasi));
        $('#txt-status_caption').val(data.master.status_caption);
        $('#cmb-unit_asal').val(data.master.id_unit_stok).change();
        // $('#src-no_permintaan').val(data.master.no_pm);
        $('#src-no_permintaan').searchbox('setValue',data.master.no_pm);
        $('#txt-unit_tujuan').val(data.master.unit_tujuan);
        $('#txt-unit_tujuan_id').val(data.master.id_unit_tujuan);
        $('#txt-desc').val(data.master.ket_rt_mutasi);

        $('#cmb-unit_asal').attr('disabled', true);

        $('#dtg-detail_ed').datagrid('loadData', data.detail);
        detail_item=data.detail;

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
        $('#txt-no').attr('disabled', true);
        $('#dtb-date_input').attr('disabled', kondisi);
        $('#cmb-unit_asal').attr('disabled', kondisi);
        $('#txt-ket_rt_mutasi').attr('disabled', kondisi);

        if (edit==0)
        {
          $('#div_status').hide();
          $('#cmb-unit_asal').prop('disabled', false);
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();
        }
        else
        {
          $('#div_status').show();
          $('#cmb-unit_asal').prop('disabled', true);
          $('#btn-aksi').show();
          $('#btn-hapus').show();
          $('#btn-cetak').show(); 
        }
        
        if (kondisi)
        {
          $('.div_simpan').hide();
          $('#btn-hapus').hide();

          $('#dtg-detail_ed').datagrid('hideColumn', 'action');
        }
        else
        {
          $('.div_simpan').show(); 
          $('#btn-hapus').show();

          $('#dtg-detail_ed').datagrid('showColumn', 'action');
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
        $('#win-cari_no_permintaan').window('close');
    }

    $('#btn-pilih_barang').click(function(){
      var rows = $('#dtg-data_item').datagrid('getSelections');

      var rowGridList = $('#dtg-detail_ed').datagrid('getRows');
      //alert(rowGridListHutang.length);
      $('#dtg-detail_ed').datagrid('loadData', []);
      if (edit==0) {
        $('#dtg-detail_ed').datagrid('loadData', []);
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_ed').datagrid('appendRow',{
              id_item    : rows[i].id_item,
              kd_item    : rows[i].kd_item,
              nama_item  : rows[i].nama_item,
              nama_satuan: rows[i].nama_satuan,
              jml_stok   : rows[i].jml_stok,
              jml_retur  : 1,
              hpp        : rows[i].nilai_hpp,
              tgl_ed     : setDateNow(),
              no_batch   : "o"
            });
        }
      }else{
        // for (i=0;i<rowGridList.length;i++)
        // {
        //   $('#dtg-detail_ed').datagrid('deleteRow', i);
        // }
        $('#dtg-detail_ed').datagrid('loadData', []);
        $('#dtg-detail_ed').datagrid('loadData', detail_item);
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_ed').datagrid('appendRow',{
              id_item    : rows[i].id_item,
              kd_item    : rows[i].kd_item,
              nama_item  : rows[i].nama_item,
              nama_satuan: rows[i].nama_satuan,
              jml_stok   : rows[i].jml_stok,
              jml_retur  : 1,
              hpp        : rows[i].nilai_hpp,
              tgl_ed     : setDateNow(),
              no_batch   : "o"
          });
        }
      }
      $('#win-cari_data_item').window('close');
    });

    $('#dtg-detail_ed').datagrid({
      title:'Detail Item',
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
        $.map($('#dtg-detail_ed').datagrid('getRows'), function(row){
          var index = $('#dtg-detail_ed').datagrid('getRowIndex', row);
          $('#dtg-detail_ed').datagrid('updateRow', {
            index: index,
            row:{
              status:'P'
            }
          });
          $('#dtg-detail_ed').datagrid('selectRow',index);
          $('#dtg-detail_ed').datagrid('beginEdit',index);
        });
      },
      columns:[[
        {field:'id_item',title:'No',width:100,halign:'center',align:'left',hidden:true},
        {field:'kd_item',title:'Kode',width:80,halign:'center',align:'left'},
        {field:'nama_item',title:'Nama Item',width:400,halign:'center',align:'left'},
        {field:'nama_satuan',title:'Satuan',width:100,halign:'center',align:'left'},
        {
          field:'jml_stok',
          title:'Jml. Stok',
          width:100, halign :"center",align:"right",formatter: appGridNumberFormatter
        },
        {
          field:'jml_retur',title:'Jml. Retur',width:100,
          halign:'center',
          align:'right',
          editor : {
                      'type' : 'numberbox',
                      'options' : {
                          'required':true,
                          'precision' : 0,
                          'min' : 1,
                          'groupSeparator' :'.',
                          'decimalSeparator' :',',
                          'prompt' :'Jml Retur'
                        },
                    },
          formatter: appGridNumberFormatter
        },
        {
            field:'hpp',title:'Harga',width:100,halign :"center",align:"right",formatter: appGridNumberFormatter
        },
        {
            field:'tgl_ed',
            title:'Tgl. ED',
            width:100,
            halign :"center",
            align:"center",
            formatter:appGridDateFormatter,
            editor : {
                type : 'datebox'
            }
        },
        {
            field:'no_batch',
            title:'No. Batch',
            width:100,
            halign:'center',
            align:'left',
            editor:{
            type:'textbox',
            options:{
                required:true,
                prompt:'no batch'
            }
        },
        },
        {field:'secode2',title:'Section',width:200,align:'left',
            editor:{
                  type:'combogrid',
                  options:{
                    idField: 'secode2', textField: 'section',
                    url:'retur_barang_ed/no_batch',
                    queryParams:{
                      id_item:5570,
                      criteria:''
                    },
                    mode: 'remote',
                    fitColumns:false,
                    columns: [[
                      {field:'no_batch',title:'SeCode',width:60,align:'right'},
                      {field:'no_bpb',width:0,hidden:true},
                      {field:'section2',width:0, hidden:true},
                      {field:'section',title:'Section',width:260},
                      {field:'no_bpb',title:'Department',width:200}
                    ]],
                  panelHeight:135
                  }
            }
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
        $('#dtg-detail_ed').datagrid('endEdit', getRowIndex(target));
    }
    function editrowdetail(target){
        $('#dtg-detail_ed').datagrid('beginEdit', getRowIndex(target));
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
              $('#dtg-detail_ed').datagrid('deleteRow', getRowIndex(target));
            }
        });

        // $.messager.confirm('Confirm','Apakah Anda yakin akan menghapus data?',function(r){
        //     if (r){
        //       $('#dtg-detail_ed').datagrid('deleteRow', getRowIndex(target));
        //     }
        // });
    }
    function cancelrowdetail(target){
        $('#dtg-detail_ed').datagrid('cancelEdit', getRowIndex(target));
    }


    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function simpan()
    {
        // var data=[];
        var no_rt_mutasi   = $('#txt-no').val();
        var tgl_pp         = toAPIDateFormat($('#dtb-date_input').val());
        var id_unit_asal   = $('#cmb-unit_asal option:selected').val();
        var id_unit_tujuan = $('#txt-unit_tujuan_id').val();
        var ket_rt_mutasi  = $('#txt-desc').val();

        if (tgl_pp == ''||
        id_unit_asal == ''||
        ket_rt_mutasi == '')
        {
          let msg = '<br>';
          if (tgl_pp == '') {
            msg += 'Tanggal PP <br>';
          }

          if (id_unit_asal == '') {
            msg += 'Unit Asal <br>';
          }

          if (ket_rt_mutasi == '') {
            msg += 'Catatan <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        master={
          no_rt_mutasi     : no_rt_mutasi,
          tgl_rt_mutasi    : tgl_pp,
          id_unit_stok  : id_unit_asal,
          ket_rt_mutasi    : ket_rt_mutasi,
          user_id       : "<?php echo $this->session->userdata['user_id'] ?>",
        }

        row = $('#dtg-detail_ed').datagrid('getRows');
        if(row.length <= 0){
          notif('warning','Detail Harus Di isi')
          return false;
        }
        for (var i=0; i<row.length; i++) {
             if (row[i]['jml_retur']=='' || row[i]['jml_retur'] == 0 || row[i]['jml_retur'] == undefined) {
                notif('warning','Jumlah Retur '+row[i]['no_rt_mutasi']+' tidak boleh Kosong')
                $('#dtg-detail_ed').datagrid('selectRow',i);
                $('#dtg-detail_ed').datagrid('beginEdit',i);
                return false;
                break;
            }
            if (row[i]['tgl_ed']=='' || row[i]['tgl_ed'] == undefined) {
                notif('warning','Tanggal ED ID'+row[i]['id_item']+' tidak boleh Kosong');
                $('#dtg-detail_ed').datagrid('selectRow',i);
                $('#dtg-detail_ed').datagrid('beginEdit',i);
                return false;
                break;
            }
            if (row[i]['no_batch']=='' || row[i]['tgl_ed'] == undefined) {
                notif('warning','No. Batch ID'+row[i]['id_item']+' tidak boleh Kosong');
                $('#dtg-detail_ed').datagrid('selectRow',i);
                $('#dtg-detail_ed').datagrid('beginEdit',i);
                return false;
                break;
            }

          // if (row[i]['tgl_ed']=='' || row[i]['tgl_ed'] == undefined) {
          //   $.messager.alert('Warning','Tanggal Kebutuhan '+row[i]['no_rt_mutasi']+' tidak boleh Kosong');
          //   $('#dtg-detail_ed').datagrid('selectRow',i);
          //   $('#dtg-detail_ed').datagrid('beginEdit',i);
          //   return false;
          //   break;
          // }
        }

        var details = [];
        for (var i=0; i<row.length; i++) {
          details.push({
            id_item  : row[i]['id_item'],
            id_satuan: row[i]['nama_satuan'],
            jml_stok : row[i]['jml_stok'],
            jml_retur: row[i]['jml_retur'],
            hpp      : row[i]['hpp'],
            tgl_ed   : setDate(row[i]['tgl_ed']),
            no_batch : row[i]['no_batch'],

          })
        }

        if(no_rt_mutasi=="")
        {
        
        }
        else
        {
          master['no_rt_mutasi']=no_rt_mutasi;
        }


        data['master']  =master;
        data['details'] =details;

        console.table(data);

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/simpan"); ?>",
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
                status(2,data.no_rt_mutasi);
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
            //               status(2,data.no_rt_mutasi);
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
          no_rt_mutasi: no_pp,
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
                      url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/hapus"); ?>",
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

    

    function status(status,no)
    {
        var no_rt_mutasi;
        if(no==0){
          var no_rt_mutasi = $('#txt-no').val();
        }
        else{
          no_rt_mutasi=no;
        }
        if (no_rt_mutasi=="")
        {
          return false;
        }

        var data={
          no_rt_mutasi : no_rt_mutasi
        }

        data['user_id']="<?php echo $this->session->userdata['user_id'] ?>";

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
      var no_rt_mutasi = data.no_rt_mutasi;
      $.ajax({
        url : "<?php echo base_url("farmasi/gudang/retur_barang_ed/status"); ?>",
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
            getData(no_rt_mutasi);
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
    }

    function cetak(){
      $('#loader').css('display','');
      // console.log(data_cetak);
      $.ajax({
        url     : "<?= base_url() ?>farmasi/gudang/retur_barang_ed/cetak",
        type    : "POST",
        dataType: 'json', 
        data    : data_cetak,
        success:function(data, textStatus, jqXHR){
          if (data.success === true) {
            $('#loader').css('display','none');
            let file_cetak = "Laporan_Retur_Barang_ED.pdf";
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
