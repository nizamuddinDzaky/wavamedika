<script type="text/javascript">
    var edit=0;
    var arrSatuan = [];
    var detail_item;
    var data_detail_item;
    var rowGridSelected = 0;

    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return (dd[1]?dd:"0"+dd[0]) + '/' + (mm[1]?mm:"0"+mm[0]) + '/'+ yyyy;
    };
    $(function(){
        
        // $('#win-detail_item').window('open');
        edit=0;
        tab(0);
get_select();

    });

 $('#btn-batal_supplier').click(function(event) {
            $('#win-cari_supplier').window('close');
        });

        $('#btn-batal_nopo').click(function(event) {
            $('#win-cari_nopo').window('close');
        });


        $('#btn-batal_detail_item').click(function(event) {
            $('#win-detail_item').window('close');
        });

        $('#cmb-gudang').select2({
            dropdownParent: $('#detail'),
            placeholder   : 'Pilih Unit'
        })
        // $('#dtg-penerimaan_barang').datagrid({
        //   singleSelect:true,
        //   onDblClickRow:function(index,row){
        //        btn_ubah();
        //   }
        // });

        $('#txt-biaya_lain').numberbox({
            onChange: function(){
                set_total();
            },
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            inputEvents: $.extend({}, $.fn.numberbox.defaults.inputEvents, {
                keypress: function (e) {
                    
                    /*var result = $.fn.numberbox.defaults.inputEvents.keypress.call(this, e);
                    if (e.keyCode == 35) {
//this doesn't work
                        $(e.data.target).textbox('setValue', '#');
                    }*/
                    // return result;
                }
            })
        })

        $('#cmb-ppn').change(function(argument) {
          if ($(this).val()==2) {
              $('#txt-persen').numberbox('setValue', 0);
              // $('#txt-persen').numberbox({disabled : true})
              $('#txt-persen').numberbox('readonly', true);
          }else{
              $('#txt-persen').numberbox('setValue', 10)
              // $('#txt-persen').numberbox({disabled : false})
              $('#txt-persen').numberbox('readonly', true);
          }
        });

        $('.easyui-numberbox').numberbox({
            'precision' : 2,
            // 'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            onChange: function(){
                set_total();
            }
        });
      

        $('#txt-diskon_nota').numberbox({
            onChange: function(){
                set_total();
            },
            'precision' : 2,
            'min' : 0,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#txt-total').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#txt-subtotal').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })
     $('#cmb-gudang').on('select2:select', function (e) {
          var data = e.params.data;
          // $('#txt-no').val(data.wira);
          console.log(data);
        });

    // $("#dtg-list_barang_detail").datagrid({
    //   onSelect: function(index, row) {
    //     $(this).datagrid('unselectRow', index);
    // }})
        // $('#btn-tambah_detail_item').click(function(event) {

        //     $('#txt-label_supplier').text($('#src-supplier').searchbox('getValue'));
        //     $('#txt-label_nopo2').text("No. PO: "+$('#src-nopo').searchbox('getValue'));
        //     $('#win-detail_item').window('open');
        // });
    $('#txt-persen').numberbox({
        'precision' : 0,
        'min' : 0,
        'required':true,
        'groupSeparator' :'.',
        'decimalSeparator' :',',
            onChange: function(){
                set_total();
            }
    })
    function btn_ubah()
    {
      // body...
      edit = 1;
      var row = $('#dtg-penerimaan_barang').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      reset_form();
      if(row.status_caption!="Open")
      {
        set_read(true);
      }
      else
      {
        set_read(false);
      }
      getData(row.no_bpb);
    }

    function reset_form()
    {
        // $('#txt-persen').attr('disabled', false);
        $('#txt-persen').numberbox('readonly', true);
        $('#txt-persen').numberbox('setValue', 10);
        $('.div_simpan').show();
        $('#btn-open').show();
        $('#btn-release').show();
        $('#btn-receive').show();
        $('#btn-approve').show();
        $('#btn-reject').show();
        $('#btn-close').show();
        $('#btn-cancel').show();

        reset_button();
        $('#txt-no').attr('disabled', true);
        $('#txt-no').val('');
        $('#dtb-date_input').val(appDateFormatter(new Date()));
        $('#cmb-gudang').val('');
        $('#src-supplier').searchbox('setValue','');
        $('#id_supplier').val('');
        $('#txt-alamat').val('');

        $('#cmb-ppn').val(1).change();

        $('#src-nopo').searchbox('setValue','');
        $('#txt-no_faktur').val('');
        $('#txt-payment').val('');
        $('#txt-term-of-payment').val('');
        $('#txt-surat_jalan').val('');

        $('#dtb-faktur').val(appDateFormatter(new Date()));
        $('#dtb-jatuh_tempo').val(appDateFormatter(new Date()));
        $('#dtb-surat_jalan').val(appDateFormatter(new Date()));

        $('#txt-keterangan').val('');
        $('#txt-subtotal').numberbox('setValue', 0);
        $('#txt-total').numberbox('setValue', 0);
        $('#txt-biaya_lain').numberbox('setValue', 0);
        $('#txt-diskon_nota').numberbox('setValue', 0);

        $('#dtg-detail_item').datagrid('loadData', []);
        $('#txt-label_posted').text("");

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

    function getData(no_bpb)
    {
        $.ajax({
          url : "<?php echo base_url("general/transaksi/penerimaan_barang/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_bpb,
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
        $('#txt-label_nobpb').text("No. BPB : "+data.master.no_bpb);
      
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
        $('#txt-no').val(data.master.no_bpb);
        $('#dtb-date_input').val(toAppDateFormat(data.master.tgl_bpb));
        $('#txt-status_caption').val(data.master.status_caption);
        $('#cmb-gudang').val(data.master.id_gudang).change();
        // $('#src-no_permintaan').val(data.master.no_pm);
        $('#src-supplier').searchbox('setValue',data.master.partner_name);
        $('#id_supplier').val(data.master.id_partner);
        $('#txt-alamat').val(data.master.partner_address);
        $('#src-nopo').searchbox('setValue',data.master.no_po);
        $('#cmb-ppn').val(data.master.jns_ppn).change();

        if (data.master.jns_ppn==2)
        {
            $('#txt-persen').numberbox('setValue', 0);
            // $('#nmb-persen').numberbox({disabled : true});
            $('#txt-persen').numberbox('readonly', true);
        }
        else
        {
            $('#txt-persen').numberbox('setValue', 10);
            // $('#nmb-persen').numberbox({disabled : true});
            $('#txt-persen').numberbox('readonly', true);
        }

        $('#txt-no_faktur').val(data.master.no_faktur_sup);
        $('#dtb-faktur').val(toAppDateFormat(data.master.tgl_faktur_sup));
        $('#txt-payment').val(data.master.nama_termin_bayar);
        $('#dtb-jatuh_tempo').val(toAppDateFormat(data.master.tgl_jatuh_tempo));
        $('#txt-surat_jalan').val(data.master.no_surat_jalan);
        $('#dtb-surat_jalan').val(toAppDateFormat(data.master.tgl_surat_jalan));

        $('#txt-keterangan').val(data.master.ket_bpb);
        $('#txt-sub_total').val(data.master.subtotal);
        $('#txt-diskon_nota').val(data.master.diskon_nota);
        $('#txt-persen').val(data.master.p_ppn);
        $('#txt-total_ppn').val(data.master.tot_ppn);
        $('#txt-biaya_lain').val(data.master.biaya_lain);
        $('#txt-total').val(data.master.total);

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
        set_total();
    }

    function set_read(kondisi)
    {
        $('#txt-no').attr('disabled', true);
        $('#dtb-tgl_pp').attr('disabled', kondisi);
        $('#cmb-data_unit').attr('disabled', kondisi);
        $('#txt-ket_pp').attr('disabled', kondisi);
        $('#src-supplier').attr('disabled', kondisi);
        $('#src-nopo').attr('disabled', kondisi);

        $('#cmb-ppn').prop('disabled', kondisi);
        if (edit==0)
        {
          $('#div_status').hide();
          $('#cmb-data_unit').prop('disabled', false);
          $('#cmb-ppn').prop('disabled', false);
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


    function get_select()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("general/transaksi/penerimaan_barang/get_data_gudang"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-gudang").select2({ data: data });
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
        $('#dtg-penerimaan_barang').datagrid('loadData',[]);
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

        var dg = $('#dtg-penerimaan_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/penerimaan_barang/filter"); ?>",
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

    function filter_supplier()
    {
        $('#dtg-list_barang').datagrid('loadData',[]);
        var tgl_mutasi   = toAPIDateFormat($('#dtb-tgl_pp').val());
        var criteria     = $('#txt-kriteria_barang_all').val();
        var id_unit_stok = $('#cmb-data_unit option:selected').val();
        var start_date   = toAPIDateFormat($('#dtb-start_tgl_barang').val());
        var end_date     = toAPIDateFormat($('#dtb-end_tgl_barang').val());

        data={
          status  : 0,
          criteria: "",
          page    : 1,
          page_row: 10
        } 

        // console.log(data);
        var dg = $('#dtg-data_supplier').datagrid({
          url : "<?php echo base_url("general/transaksi/penerimaan_barang/filter_supplier"); ?>",
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
           // onSelect: function(rowIndex, rowData)
           //           {
           //             // console.log(rowData);
           //             $('#dtg-list_barang_detail').datagrid('loadData', rowData.details);
           //           }

        });
    }

    function filter_nopo()
    {
        $('#dtg-list_barang').datagrid('loadData',[]);
        var criteria   = $('#txt-kriteria_nopo').val();
        var id_partner = $('#id_supplier').val();

        data={
          id_partner: id_partner,            
          criteria  : criteria,
          page      : 1,
          page_row  : 10
        } 

        // console.log(data);
        var dg = $('#dtg-list_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/penerimaan_barang/filter_nopo"); ?>",
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
                       // console.log(rowData);
                       $('#dtg-list_barang_detail').datagrid('loadData', rowData.details);
                     }

        });
    }

    $('#dtg-penerimaan_barang').datagrid({
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
            {field:'no_bpb',title:'No. BPB',width:"12%",halign:'center',align:'left'},
            {field:'tgl_bpb',title:'Tgl. BPB',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'partner_name',title:'Nama Supplier',width:"25%",halign:'center',align:'left'},
            {field:'jns_po',title:'Jenis PO',width:"10%",halign:'center',align:'center'},
            {field:'total_po',title:'Total PO',width:"13%",halign:'center',align:'right',formatter:appGridNumberFormatter},
            {field:'total',title:'Total Terima',width:"13%",halign:'center',align:'right',formatter:appGridNumberFormatter},
            {field:'ket_bpb',title:'Catatan',width:"20%",halign:'center',align:'left'},
            {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'left'},
            {field:'created_by',title:'Dibuat Oleh',width:"15%",halign:'center',align:'left'},     
            {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'Diubah Oleh',width:"15%",halign:'center',align:'left'},
            {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
        title:'Detail Item',
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        showFooter:true,
        onDblClickRow:function(index,row){
        },
        frozenColumns:[[
            {field:'id_item',title:'id',hidden :"true"},
            {field:'kd_item',title:'Kode',width:100,halign :"center"},
            {field:'nama_item',title:'Nama Item',width:280,halign :"center"},
        ]],
        columns:[[
            {
                field:'jml_po',
                title:'Jumlah',
                width:70,
                halign :"center", 
                formatter: numberFormat,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var harga_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var persen = $(harga_ed.target).numberbox('getValue') * $(this).val()*$(p_diskon_ed.target).numberbox('getValue') / 100
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {field:'jml_sisa_po',title:'Jml. Sisa PO',width:80,halign :"center",align:"right",formatter: numberFormat},
            {field:'id_satuan_po',title:'Satuan PO',width:80,halign :"center"},
            {field:'rasio',title:'Rasio',width:80,halign :"center",align:"right",formatter: numberFormat},
            {
                field:'harga',
                title:'Harga',
                width:120,
                halign :"center",
                align:"right",
                formatter: formatIndo,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :',',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var jumlah_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_po'
                            });

                            var persen = $(jumlah_ed.target).numberbox('getValue') * $(this).val()*$(p_diskon_ed.target).numberbox('getValue') / 100
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
             {
                field:'p_diskon',
                title:'Disc. (%)',
                width:85,
                halign :"center",
                align:"right",
                formatter: numberFormat,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :',',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var harga_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var jumlah_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_po'
                            });

                            var persen = $(jumlah_ed.target).numberbox('getValue') * $(this).val()*$(harga_ed.target).numberbox('getValue') / 100
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {
                field:'tot_diskon',
                title:'Disc. (Harga)',
                width:120,
                halign :"center", 
                align:"right", 
                formatter: formatIndo,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'groupSeparator' :'.',
                        'decimalSeparator' :',',
                        onChange: function(){
                            var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var harga_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var jumlah_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_po'
                            });

                            var persen = $(this).val()/($(harga_ed.target).numberbox('getValue') * $(jumlah_ed.target).numberbox('getValue') )*100

                            if (isNaN(persen)) {
                                persen = 0
                            }
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'p_diskon');*/
                            $(p_diskon_ed.target).numberbox('setValue', persen)
                        },
                        // 'required':true,
                    }
                }
            },
            {field:'total',title:'Sub Total',width:120,halign :"center", align:"right", formatter: formatIndo},
            {field:'jml_bpb',title:'Jml. Terima',width:80,halign :"center",align:"right",formatter: numberFormat},
            {field:'jml_satuan_kecil',title:'Jml. Satuan Kecil',width:120,halign :"center",align:"right",formatter: numberFormat},
            {field:'nama_satuan_kecil',title:'Satuan Kecil',width:120,halign :"center",align:"left"},
            {
            field : 'tgl_ed',
            title : 'Tgl. ED',
            width : 90,
            halign : 'center',
            align : 'center',
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
                // required:true,
                prompt:'no batch'
            }
        },
        },
            {
                field:'action',title:'Action',width:130,align:'center',
                formatter:function(value,row,index){
                // console.log(this)
                if(row.kd_item == '' || row.kd_item == undefined)
                    {
                        return '';
                    }
                    else
                    {
                        if (row.editing)
                        {
                            var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                            var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                            return s+c;
                        } else if(!row.editing)
                        {
                            var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                            var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
                            return e+d;
                        }
                        else
                        {
                            return '';
                        }
                    }
                }
            }
        ]],
     onEndEdit:function(index,row){
           row.total = (row.jml_po * row.harga) - row.tot_diskon;
      },
      onBeforeEdit:function(index,row){
          row.editing = true;
          $(this).datagrid('refreshRow', index);
      },
      onAfterEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
            set_total()
          // console.log();
      },
      onCancelEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      }
    });

    $('#dtg-detail_item').datagrid('reloadFooter',[
        {"harga":0,"tot_diskon":0, "total":0}
    ]);

    function saverowdetail(target){  
         var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

        var harga_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            field: 'harga'
        });

        var tot_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

        var persen = $(tot_diskon_ed.target).numberbox('getValue')/$(harga_ed.target).numberbox('getValue')*100;
        if (persen >= 100) {
            notif('warning','Diskon Lebih dari sama dengan 100%!');
            return false;
        }else{
            $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
        }
    }
    function editrowdetail(target){
        var index = getRowIndex(target);
        var row = $('#dtg-detail_item').datagrid('getRows')[index];
        $('#dtg-detail_item').datagrid('beginEdit',index );
    }
    //  function saverowdetail(target){  
    //     $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
    // }
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

    function tambah(){
        edit=0;
        reset_form();
        set_read();
        $('#btn-hapus').hide();
        get_select();
        tab(1);
    }

    function tab(tab){
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            filter();
        }
        else{
            $('#browse').hide();
            $('#detail').show();
        }
    }

    // function set_read(){
    //     if(edit==0){
    //         $('#div_status').show();
    //         $('#btn-aksi').show();
    //     }
    //     else{
    //         $('#div_status').hide();
    //         $('#btn-aksi').hide();
    //     }
    // }

    $('#src-supplier').searchbox({
        searcher: show_supplier,
    });

    function show_supplier(){
        $('#win-cari_supplier').window('open');
        filter_supplier();
    }

    $("#btn-pilih_supplier").click(function(){
        pilih_sup();
    })

    function pilih_sup(){
        var row = $('#dtg-data_supplier').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#id_supplier').val(row.partner_id);
        $('#src-supplier').searchbox('setValue',row.partner_name);
        $('#txt-alamat').val(row.data_partner);
        $('#win-cari_supplier').window('close');
    }

    $("#dtg-data_supplier").datagrid({
      onDblClickRow:function(){
        pilih_sup();
      },
    })

    $('#src-nopo').searchbox({
        searcher: show_nopo,
    });

    function show_nopo(){
         var supplier = $('#src-supplier').val();
         if(supplier==""){
            notif('warning','Supplier Belum di Pilih');
            return false;
        }
        $('#win-cari_nopo').window('open');
        $('#txt-label_nopo').text($('#src-supplier').searchbox('getValue'));
        filter_nopo();
    }

    function pilih_nopo(){
        var row = $('#dtg-list_barang').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#src-nopo').searchbox('setValue',row.no_po);
        $('#txt-payment').val(row.nama_termin_bayar);
        $('#txt-term-of-payment').val(row.tempo_bayar);
        $('#win-cari_nopo').window('close');
        set_jatuh_tempo();
    }

    $("#btn-pilih_nopo").click(function(){
        pilih_nopo();
    })

    $("#dtg-list_barang").datagrid({
      onDblClickRow:function(){
        pilih_nopo();
      }
    })

    $('#btn-tambah_detail_item').click(function (event) {
        var supplier = $("#src-supplier").searchbox('getValue');
        var no_po    = $("#src-nopo").searchbox('getValue');
        if(supplier == "")
        {
            notif('warning','Harap Pilih Supplier');
            return false;
        }
        if(no_po == "")
        {
            notif('warning','Harap Pilih No. PO')
            return false;
        }
        $('#txt-label_supplier').text($('#src-supplier').searchbox('getValue'));
        $('#txt-label_nopo2').text("No. PO: "+$('#src-nopo').searchbox('getValue'));
        $('#win-detail_item').window('open');
        filter_barang();
    });

    function filter_barang()
    {
        $('#dtg-barang_po').datagrid('loadData',[]);
        var supplier = $("#id_supplier").val();
        var no_po    = $("#src-nopo").searchbox('getValue');

        data={
          id_partner       : supplier,
          no_po  : no_po,
          criteria: ""
        } 

        $.ajax({
          url : "<?php echo base_url("general/transaksi/penerimaan_barang/Filter_barang_po"); ?>",
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
            $('#dtg-barang_po').datagrid('loadData', data.data);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        });
    }

    $('#btn-pilih_barang_po').click(function(){
      var rows = $('#dtg-barang_po').datagrid('getSelections');
      console.log(rows);
      arrSatuan = [];
      var rowGridList = $('#dtg-detail_item').datagrid('getRows');
      //alert(rowGridListHutang.length);
      $('#dtg-detail_item').datagrid('loadData', []);
      if (edit==0) {
        $('#dtg-detail_item').datagrid('loadData', []);
        for (i=0;i<rows.length;i++) {
          $('#dtg-detail_item').datagrid('appendRow',{
              id_item          : rows[i].id_item,
              kd_item          : rows[i].kd_item,
              nama_item        : rows[i].nama_item,
              jml_po           : rows[i].jml_po,
              jml_sisa_po      : rows[i].jml_sisa_po,
              id_satuan_po     : rows[i].id_satuan_po,
              rasio            : rows[i].rasio,
              harga            : rows[i].harga,
              p_diskon         : rows[i].p_diskon,
              tot_diskon       : rows[i].tot_diskon,
              total            : rows[i].total,
              jml_bpb          : rows[i].jml_bpb,
              jml_satuan_kecil : rows[i].jml_satuan_kecil,
              nama_satuan_kecil: rows[i].nama_satuan_kecil,
              tgl_ed           : setDateNow(),
              no_batch         : "o"


              // total      : (rows[i].jml_mutasi*rows[i].niai_hpp),
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
              id_item          : rows[i].id_item,
              kd_item          : rows[i].kd_item,
              nama_item        : rows[i].nama_item,
              jml_po           : rows[i].jml_po,
              jml_sisa_po      : rows[i].jml_sisa_po,
              id_satuan_po     : rows[i].id_satuan_po,
              rasio            : rows[i].rasio,
              harga            : rows[i].harga,
              p_diskon         : rows[i].p_diskon,
              tot_diskon       : rows[i].tot_diskon,
              total            : rows[i].total,
              jml_bpb          : rows[i].jml_bpb,
              jml_satuan_kecil : rows[i].jml_satuan_kecil,
              nama_satuan_kecil: rows[i].nama_satuan_kecil,
              tgl_ed           :setDateNow(),
              no_batch         : "o"


          });
        }
      }
      for (var i = 0 ; i < rows.length; i++) {
            arrSatuan.push(rows[i]['data_satuan'])
        }
      $('#win-detail_item').window('close');
      set_total()

    });

    function simpan()
    {
        // var data=[];
        var no_bpb          = $('#txt-no').val();
        var tgl_bpb         = toAPIDateFormat($('#dtb-date_input').val());
        var no_faktur_sup   = $('#txt-no_faktur').val();
        var tgl_faktur_sup  = toAPIDateFormat($('#dtb-faktur').val());
        var tgl_jatuh_tempo = toAPIDateFormat($('#dtb-jatuh_tempo').val());
        var no_surat_jalan  = $('#txt-surat_jalan').val();
        var tgl_surat_jalan = toAPIDateFormat($('#dtb-surat_jalan').val());
        var ket_bpb         = $('#txt-keterangan').val();
        var tot_diskon      = $('#txt-disc_harga').val();
        var subtotal        = $('#txt-sub_total').val();
        var diskon_nota     = $('#txt-diskon_nota').val();
        var p_ppn           = $('#txt-persen').val();
        var tot_ppn         = $('#txt-total_ppn').val();
        var biaya_lain      = $('#txt-biaya_lain').val();
        var total           = $('#txt-total').val();
        var no_po           = $('#src-nopo').val();
        var id_gudang       = $('#cmb-gudang').val();
        var jns_ppn         = $('#cmb-ppn').val();
        var id_partner      = $('#id_supplier').val();
        // var id_unit_asal = $('#cmb-data_unit option:selected').val();
        var id_unit_tujuan  = $('#txt-unit_tujuan_id').val();
        var ket_supplier    = $('#txt-alamat').val();
        var ket_pp          = $('#txt-ket_mutasi').val();
        var jns_mutasi      = $('#txt-jenis_mutasi').val();

        if (id_gudang == ''|| id_partner == ''|| no_po == ''|| no_faktur_sup == ''|| no_surat_jalan == '')
        {
          let msg = '<br>';
          if (id_gudang == '') {
            msg += 'Gudang <br>';
          }

          if (id_partner == '') {
            msg += 'Supplier <br>';
          }

          if (no_po == '') {
            msg += 'No. PO <br>';
          }
          if (no_faktur_sup == '') {
            msg += 'No. Faktur <br>';
          }
          if (no_surat_jalan == '') {
            msg += 'No. Surat Jalan <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        master={
          no_bpb         : no_bpb, 
          tgl_bpb        : tgl_bpb,
          id_gudang      : id_gudang, 
          id_partner     : id_partner,
          ket_supplier   : ket_supplier,
          no_po          : no_po,
          jns_ppn        : jns_ppn,
          no_faktur_sup  : no_faktur_sup, 
          tgl_faktur_sup : tgl_faktur_sup, 
          tgl_jatuh_tempo: tgl_jatuh_tempo, 
          no_surat_jalan : no_surat_jalan ,
          tgl_surat_jalan: tgl_surat_jalan, 
          ket_bpb        : ket_bpb, 
          tot_diskon     : tot_diskon,
          subtotal       : subtotal, 
          diskon_nota    : diskon_nota, 
          p_ppn          : p_ppn, 
          tot_ppn        : tot_ppn, 
          biaya_lain     : biaya_lain, 
          total          : total, 
          user_id        : "<?php echo $this->session->userdata['user_id'] ?>",
        }

        // for (var i=0; i<row.length; i++) {
        //   if (row[i]['jml_minta']=='' || row[i]['jml_minta'] == 0 || row[i]['jml_minta'] == undefined) {
        //     notif('warning','Jumlah Permintaan '+row[i]['no_bpb']+' tidak boleh Kosong')
        //     $('#dtg-detail_item').datagrid('selectRow',i);
        //     $('#dtg-detail_item').datagrid('beginEdit',i);
        //     return false;
        //     break;
        //   }

        //   if (row[i]['tgl_kebutuhan']=='' || row[i]['tgl_kebutuhan'] == undefined) {
        //     $.messager.alert('Warning','Tanggal Kebutuhan '+row[i]['no_bpb']+' tidak boleh Kosong');
        //     $('#dtg-detail_item').datagrid('selectRow',i);
        //     $('#dtg-detail_item').datagrid('beginEdit',i);
        //     return false;
        //     break;
        //   }
        // }

        // if(no_bpb!="")
        // {
        //  master.push({
        //  no_bpb       : no_bpb,
        //   })

        // }
        row = $('#dtg-detail_item').datagrid('getRows');
        if(row.length <= 0){
          notif('warning','Detail Harus di isi!');
          return false;
        }

        var details = [];
        for (var i=0; i<row.length; i++) {
          details.push({
            id_po_det       : 8,
            id_item         : row[i]['id_item'], 
            // id_item         : row[i]['kd_item'], 
            id_satuan_po    : row[i]['id_satuan_po'], 
            jml_po          : row[i]['jml_po'], 
            jml_sisa_po     : row[i]['jml_sisa_po'], 
            rasio           : row[i]['rasio'], 
            jml_bpb         : row[i]['jml_bpb'], 
            id_satuan_kecil : row[i]['nama_satuan_kecil'],
            jml_satuan_kecil: row[i]['jml_satuan_kecil'], 
            harga           : row[i]['harga'], 
            p_diskon        : row[i]['p_diskon'], 
            tot_diskon      : row[i]['tot_diskon'], 
            total           : row[i]['total'],
            tgl_ed          : setDate(row[i]['tgl_ed']), 
            no_batch        : row[i]['no_batch'] 
          })
        }


        data['master']  = master;
        data['details'] = details;

        console.log(data);

        $.ajax({
          url : "<?php echo base_url('general/transaksi/penerimaan_barang/simpan'); ?>",
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
           swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value) {
                      status(2,data.no_bpb);
                  }
                  else
                  {
                    tab(0);
                  }
              }); 
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

    function status(status,no)
    {
        var no_bpb;
        if(no==0){
          var no_bpb = $('#txt-no').val();
        }
        else{
          no_bpb=no;
        }
        if (no_bpb=="")
        {
          return false;
        }

        var data={
          no_bpb : no_bpb,
          user_id: "<?php echo $this->session->userdata['user_id'] ?>"
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
      console.table(data);
      var no_bpb = data.no_bpb;
      $.ajax({
        url : "<?php echo base_url("general/transaksi/penerimaan_barang/status"); ?>",
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
            getData(no_bpb);
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

    function set_jatuh_tempo() {
        var days = 0;

        if ($('#txt-term-of-payment').val() != '') {
            days = parseInt($('#txt-term-of-payment').val())
        }

        var date = appDateParser($('#dtb-date_input').val())
        date.setDate(date.getDate() + days)

        $('#dtb-jatuh_tempo').val(date.toInputFormat())
    }

    $('#dtb-date_input').change(function () {
        set_jatuh_tempo();
            
    })

    function numberFormat(val, row) {
        if (val % 1 ==0) {
            return appGridNumberFormatter(val, row)
        }else{
            return val
        }
    }

    function hapus() {
      let no_bpb = $('#txt-no').val();
      let status_caption = $('#txt-status_caption').val();
      
      data={
        no_bpb : no_bpb,
        user_id: "<?php echo $this->session->userdata['user_id'] ?>"
      } 

      // console.log(data);

      swal.fire(cohapus()).then(function(result) {
          if (result.value) {
              $.ajax({
                url : "<?php echo base_url("general/transaksi/penerimaan_barang/hapus"); ?>",
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

    function set_total(biayaLain = 0, disNota = 0) {
        var data     = $("#dtg-detail_item").datagrid('getRows')
        var subtotal = 0;
        var totDisc  = 0;
        var totHarga = 0;
        // console.log(data);
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++){

                subtotal += parseInt(data[i].total);
                // totDisc  += parseInt(data[i].tot_diskon);
                if (isNaN(data[i].tot_diskon)==false&&data[i].tot_diskon!=null&&data[i].tot_diskon!=undefined)
                {
                    totDisc += parseInt(data[i].tot_diskon);
                }
                totHarga += parseInt(data[i].harga);
            }
        }

        var dg =$('#dtg-detail_item').datagrid('reloadFooter',[{"harga":totHarga, "tot_diskon":totDisc, "total":subtotal}]);

        $('#txt-harga').numberbox('setValue', totHarga);
        $('#txt-disc_harga').numberbox('setValue', totDisc);
        $('#txt-subtotal_grid').numberbox('setValue', subtotal);

        var ppnPersen = $('#txt-persen').numberbox('getValue');
        var ppn = ppnPersen / 100 * subtotal
        if (biayaLain == 0) {
          biayaLain = $('#txt-biaya_lain').numberbox('getValue');
        }
        if (disNota == 0) {
          disNota= $('#txt-diskon_nota').numberbox('getValue');
        }
        // alert("subtotal: "+subtotal);
        // alert("totDisc: "+totDisc);
        // alert("ppn: "+ppn);
        // alert("biayaLain: "+biayaLain);
        // alert("disNota: "+disNota);
        var total = parseInt(subtotal) - parseInt(totDisc) + parseInt(ppn) + parseInt(biayaLain) - parseInt(disNota);
        // alert(total);
        $("#txt-total_ppn").numberbox('setValue', ppn);
        // $("#txt-disc").numberbox('setValue', totDisc);
        $("#txt-sub_total").numberbox('setValue', subtotal);
        $("#txt-total").numberbox('setValue', total);
    }

</script>