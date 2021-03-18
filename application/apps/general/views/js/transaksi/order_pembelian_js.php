<script type="text/javascript">
    var ket_supplier = ''
    var arrSatuan = [];
    var comboboxGridSelected = 0;
    var rowGridSelected = 0;

    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return (dd[1]?dd:"0"+dd[0]) + '/' + (mm[1]?mm:"0"+mm[0]) + '/'+ yyyy;
    };

    $(function(){
        filter();
        /*$('#txt-biaya_lain').keyup(function (argument) {
            console.log('asd')
        })*/

        $('#cmb-ppn').change(function (argument) {
            if ($(this).val() == 2) {
                $('#txt-persen').numberbox('setValue', 0)
                $('#txt-persen').numberbox({disabled : true})
            }else{
                $('#txt-persen').numberbox({disabled : false})
            }
        })

        $('#btn-validation').click(function () {
            var password = $('#txt-passwordcek').val();
            if(password=="123"){
                var data = 
                    {
                        no_po:$('#txt-no').val(),
                        message:$('#txt-desc').val(),
                        user_id : "<?php echo $this->session->userdata['user_id'] ?>",
                        pass:password
                    }
                verifikasi(data,$('#txt-tempStatus').val());
                $('#alert').modal('hide');
            }
            else{
                notif('warning','Password Salah');
            }
        })
        
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

        $('#txt-harga').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })
        $('#txt-disc_harga').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })
        $('#txt-subtotal_grid').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#txt-disc_nota').numberbox({
            onChange: function(){
                set_total();
            },
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#txt-disc').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#txt-ppn').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
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

        $('#dtb-date_input').change(function () {
            set_jatuh_tempo();
            
        })
        

        $('#txt-persen').numberbox({
            onChange: function(){
                set_total();
            }
        })

        $('#cmb-payment').on('select2:select', function(e){
            var data = e.params.data;
            console.log(data);
            $('#txt-term-of-payment').val(data.rexita);
            set_jatuh_tempo();
        });
        $('#cmb-delivery').on('select2:select', function(e){
            var data = e.params.data;
            console.log(data);
            $('#txt-delivery').val(data.rexita);
        });
        // $('#win-detail_item').window('open');
        edit=0;
        tab(0);

        $.ajax({
            url : "<?php echo base_url("general/transaksi/Order_pembelian/termin_bayar"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-payment").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        });

        // $('#cmb-payment').combobox({
        //     valueField:'id_termin_bayar',
        //     textField:'nama_termin_bayar',
        //     url:'<?php echo base_url('general/transaksi/Order_pembelian/termin_bayar') ?>',
        //     required:true,
        //     onChange : function(newValue,oldValue) {
        //     },
        //     onClick :function(record) {
        //       $('#txt-term-of-payment').val(record.tempo)
        //       set_jatuh_tempo()
        //     }
        // });

        $.ajax({
            url : "<?php echo base_url("general/transaksi/Order_pembelian/termin_kirim"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-delivery").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        });

        // $('#cmb-delivery').combobox({
        //     valueField:'id_termin_kirim',
        //     textField:'nama_termin_kirim',
        //     url:'<?php echo base_url('general/transaksi/Order_pembelian/termin_kirim') ?>',
        //     required:true,
        //     onChange : function(newValue,oldValue) {
        //     },
        //     onClick :function(record) {
        //       $('#txt-delivery').val(record.tempo)
        //     }
        // });

        $('#btn-batal_supplier').click(function(event) {
            $('#win-cari_supplier').window('close');
        });

        $('#btn-batal_nopp').click(function(event) {
            $('#win-cari_nopp').window('close');
        });

        $('#btn-tambah_detail_item').click(function(event) {
            filter_barang();
        });

        $('#btn-batal_detail_item').click(function(event) {
            $('#win-detail_item').window('close');
        });
    });

    $('#dtg-list_barang').datagrid({
        onDblClickRow:function(index,row){
            $('#dtg-list_barang_detail').datagrid('loadData', row.details)
        }
    })

    $('#dtg-order_pembelian').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            edit = 1
            reset_form();
            set_read();
            getData(row.no_po);
        },
        columns:[[
            {field:'no_po',title:'No. PO',width:"12%",halign:'center',align:'center'},
            {field:'tgl_po',title:'Tgl. PO',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'partner_name',title:'Nama Supplier',width:"20%",halign:'center',align:'left'},
            {field:'jns_po',title:'Jenis PO',width:"10%",halign:'center',align:'center'},
            {field:'total',title:'Total PO',width:"10%",halign:'center',align:'right', formatter: appGridNumberFormatter},
            {field:'ket_po',title:'Catatan',width:"30%",halign:'center',align:'left'},
            {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'center'},
            {field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
            {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
            {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField     :'itemid',
        showFooter  :'true',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'Kode',width:100,halign :"center", hidden:true},
            {field:'id_satuan_kecil',title:'Kode',width:100,halign :"center", hidden:true},
            {field:'jml_satuan_kecil',title:'Kode',width:100,halign :"center",hidden:true},
            {field:'kd_item',title:'Kode',width:100,halign :"center"},
            {field:'nama_item',title:'Nama Item',width:280,halign :"center"},
            {field:'jml_minta',title:'Jumlah PP',width:70,halign :"center", formatter: numberFormat},
            {field:'nama_satuan_minta',title:'Satuan PP',width:70,halign :"center"},
            {field:'id_satuan_po',title:'Satuan',width:70,halign :"center"},
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
                        'groupSeparator' :'.'
                    }
                }
            },
            {
                field:'harga',
                title:'Harga',
                width:120,
                halign :"center",
                align:"right",
                formatter: datagridFormatNumber,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :','
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
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        onBlur: function (argument) {
                            console.log("asd")
                        },
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
                formatter: datagridFormatNumber,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
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
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :','
                    }
                }
            },
            {field:'total',title:'Sub Total',width:120,halign :"center", align:"right", formatter: datagridFormatNumber},
            {
                field:'action',title:'Action',width:135,align:'center',
                formatter:function(value,row,index){
                    if(row.kd_item == '' || row.kd_item == undefined){
                        return '';
                    }
                    else{
                        if (row.editing){
                            var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp';
                            var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                            return s+c;
                        }
                        else if(!row.editing) {
                            var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp';
                            var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
                            return e+d;
                        }
                        else{
                            return '';
                        }
                    }
                }
            }
        ]],
        onEndEdit:function(index,row){
            /*row.jml_po = Math.ceil(row.jml_minta * arrSatuan[index][comboboxGridSelected]['nilai_po'])*/
            row.total = (row.jml_po * row.harga) - row.tot_diskon
            row.id_satuan_kecil = arrSatuan[index][comboboxGridSelected]['id_satuan_kecil']
            row.jml_satuan_kecil = row.jml_po * arrSatuan[index][comboboxGridSelected]['nilai']
            /*console.log(row.harga)*/
        },
        onBeforeEdit:function(index,row){
            
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
            set_total()
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }
    });

    $('#dtg-detail_item').datagrid('reloadFooter',[
        {"harga":0,"tot_diskon":0, "total":0}
    ]);

    function set_total(biayaLain = null, disNota = null) {
        var data = $("#dtg-detail_item").datagrid('getRows')
        var subtotal = 0;
        var totDisc = 0;
        var totHarga = 0
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++){
                subtotal+=parseInt(data[i].total) * data[i].jml_po;
                totDisc += parseInt(data[i].tot_diskon);
                totHarga += parseInt(data[i].harga);
            }
        }

        $('#dtg-detail_item').datagrid('reloadFooter', [{no_bpb:'', harga:totHarga,tot_diskon:totDisc, total:subtotal}]);

        // $('#txt-harga').numberbox('setValue', totHarga);
        // $('#txt-disc_harga').numberbox('setValue', totDisc);
        // $('#txt-subtotal_grid').numberbox('setValue', subtotal);

        var ppnPersen = $('#txt-persen').numberbox('getValue');
        var ppn = ppnPersen / 100 * subtotal
        if (biayaLain == null) {
          biayaLain = $('#txt-biaya_lain').numberbox('getValue');
        }
        if (disNota == null) {
          disNota= $('#txt-disc_nota').numberbox('getValue');
        }
        var total = parseInt(subtotal) - parseInt(totDisc) + parseInt(ppn) + parseInt(biayaLain) - parseInt(disNota);

        $("#txt-ppn").numberbox('setValue', ppn);
        $("#txt-disc").numberbox('setValue', totDisc);
        $("#txt-subtotal").numberbox('setValue', subtotal);
        $("#txt-total").numberbox('setValue', total);
    }

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

        var persen = $(tot_diskon_ed.target).numberbox('getValue')/$(harga_ed.target).numberbox('getValue')*100
        if (persen >= 100) {
            notif('warning','Diskon Lebih dari sama dengan 100%!');
            return false;
        }else{
            $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
        }
    }
    function editrowdetail(target){
        var index = getRowIndex(target);
        rowGridSelected = index
        var x = $("#dtg-detail_item").datagrid('getColumnOption', 'id_satuan_po');
        x.editor = {
                    type:'combobox',
                    options:{
                        valueField:'id_satuan_po',
                        textField:'id_satuan_po',
                        data: arrSatuan[index],
                        required:true,
                        onSelect: function(rec){
                            comboboxGridSelected = arrSatuan[index].indexOf(rec)
                            var row = $('#dtg-detail_item').datagrid('getRows')[index];
                            var jml_po_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_po'
                            });
                            if (rec.id_satuan_po == row.id_satuan_po) {
                                $(jml_po_ed.target).numberbox('setValue', row.jml_po)
                            }else{
                                $(jml_po_ed.target).numberbox('setValue', rec.nilai_po)
                            }                            
                        }
                    }
                }
        var row = $('#dtg-detail_item').datagrid('getRows')[index];
        $('#dtg-detail_item').datagrid('beginEdit',index );
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

    function tambah(){
        edit=0;
        default_auth();
        $('#btn-hapus').hide();
        reset_form()
        set_read();
        tab(1);
    }

    function tab(tab){
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            filter()
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
            $('#btn-close_po').hide();
        }
        else{
            $('#btn-close_po').show();
            $('#div_status').show();
            $('#btn-aksi').show();
        }
    }

    /*$('#src-supplier').searchbox({
        searcher: show_supplier,
        disabled : false
    });*/

    function show_supplier(){
        $('#win-cari_supplier').window('open');
        $('#dtg-data_supplier').datagrid('loadData', [])
        filter_supplier()
    }

   /* $('#src-nopp').searchbox({
        searcher: show_nopp,
        disabled : false
    });*/

    function show_nopp(){
        var idSupplier = $('#src-supplier').val()
        if (idSupplier == '') {
            notif('warning','Data Supplier Belum dipilih!');
            return false;
        }

        $('#win-cari_nopp').window('open');
        $('#dtg-list_barang').datagrid('loadData', [])
        filter_no_pp()
    }

    function filter_no_pp() {
        $('#dtg-list_barang_detail').datagrid('loadData', [])
        var criteria = $('#txt-kriteria-no-pp').val();
        $('#txt-label_nopp').text($('#txt-nama_supplier').val())
        data = {
            is_supplier:$('#chk-is_aktif').prop("checked"),
            id_jns_po:$('#cmb-jenis').val(),
            id_partner:$('#src-supplier').val(),
            criteria:$('#txt-kriteria-no-pp').val(),
            page_row:10,
            page:1  
        }

        var dg = $('#dtg-list_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/Order_pembelian/filter_no_pp"); ?>",
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

    function filter_supplier() {
        
        data={
            criteria:$('#txt-kriteria_cari_supplier').val(),
            page_row:10,
            page:1
        }

        var dg = $('#dtg-data_supplier').datagrid({
          url : "<?php echo base_url("general/transaksi/Order_pembelian/filter_supplier"); ?>",
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

    function pilih_supplier() {
        var row = $('#dtg-data_supplier').datagrid('getSelected');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }
        $('#src-supplier').val(row.partner_id);
        $('#txt-ket_supplier').val(row.data_partner);
        $('#txt-nama_supplier').val(row.partner_name);
        $('#win-cari_supplier').window('close');
    }

    function filter_barang() {
        var idSupplier = $('#src-supplier').val()
        if (idSupplier == '') {
            notif('warning','Data Supplier Belum dipilih!');
            return false;
        }
        var no_pp = $('#src-nopp').val()
        var id_partner = $('#src-supplier').val()
        if (no_pp == '') {
            notif('warning','Data Nomor Pembelian Belum dipilih!');
            return false;
        }

        $('#txt-label_filter_barang').text(no_pp)

        $('#win-detail_item').window('open');

        data = {
            is_supplier:$('#chk-is_aktif-item-detail').prop("checked"),
            id_partner:idSupplier,
            id_jns_po:$('#cmb-jenis').val(),
            no_pp:no_pp,
            criteria:""
        } 


        var dg = $('#dtg-filter_barang').datagrid({
          url : "<?php echo base_url("general/transaksi/Order_pembelian/filter_barang"); ?>",
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

    function pilih_no_pp() {
        
        var row = $('#dtg-list_barang').datagrid('getSelected');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        $('#win-cari_nopp').window('close');
        $('#src-nopp').val(row.no_pp);
    }

    function pilih_barang() {
        var row = $('#dtg-filter_barang').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }
        arrSatuan = [];
        
        for (var i = 0 ; i < row.length; i++) {
            row[i]['id_satuan_po'] = row[i]['nama_satuan'],
            row[i]['id_satuan_kecil'] = row[i]['nama_satuan'],
            row[i]['nama_satuan_minta'] = row[i]['nama_satuan'],
            row[i]['jml_satuan_kecil'] = row[i]['jml_minta'] * 1,
            row[i]['jml_po'] = row[i]['jml_minta']
            row[i]['harga'] = row[i]['harga_beli']
            row[i]['p_diskon'] = 0.0
            row[i]['tot_diskon'] = 0
            row[i]['total'] = 0
            arrSatuan.push(row[i]['data_satuan'])
        }

        
        
        $('#dtg-detail_item').datagrid('loadData', row);
        $('#win-detail_item').window('close');
        set_total()
    }

    function reset_form() {
        $('#txt-ket').val('')
        $('#txt-no').val('')
        $('#txt-ket_supplier').val('');
        $('#txt-term-of-payment').val('')
        $('#txt-delivery').val('')
        $('#cmb-ppn').val(1)
        $('#dtg-detail_item').datagrid('loadData', []);
        $('#dtg-auth').datagrid('loadData', []);
        $('#cmb-jenis').prop('disabled', false);
        $('#cmb-ppn').prop('disabled', false);
        $('#txt-persen').numberbox('setValue', 0);
        $('#txt-ppn').numberbox('setValue', 0);
        $('#txt-subtotal').numberbox('setValue', 0);
        $('#txt-total').numberbox('setValue', 0);
        $('#txt-biaya_lain').numberbox('setValue', 0);
        $('#txt-disc_nota').numberbox('setValue', 0);
        $('#txt-nama_supplier').val('');
        $('#src-supplier').val('');
        $('#src-nopp').val('');
        $('#cmb-payment').val('').change();
        $('#cmb-delivery').val('').change();
        // $('#cmb-payment').combobox('setValue', '');
        // $('#cmb-delivery').combobox('setValue', '');
        $('#btn-hapus').hide();
        $('#dtb-date_input').val(appDateFormatter(new Date()));
        $('#dtb-date_jatuh_tempo').val(appDateFormatter(new Date()));
        $('#dtb-date_delivery').val(appDateFormatter(new Date()))
        $('.div_simpan').show()
        $('#btn-hapus').show();
        $('#btn-show-supplier').show();
        $('#btn-show-nopp').show();
        $('#dtg-detail_item').datagrid('showColumn', 'action');
    }

    function default_auth()
    {
        $('#dtg-auth').datagrid('loadData',[]);
        
        data={
          user_id : "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        var dg = $('#dtg-auth').datagrid({
          url : "<?php echo base_url("general/transaksi/Order_pembelian/default_auth"); ?>",
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

    function set_jatuh_tempo() {
        var days = 0;

        if ($('#txt-term-of-payment').val() != '') {
            days = parseInt($('#txt-term-of-payment').val())
        }

        var date = appDateParser($('#dtb-date_input').val())
        date.setDate(date.getDate() + days)

        $('#dtb-date_jatuh_tempo').val(date.toInputFormat())
    }

    function simpan() {
        var no_po = $('#txt-no').val();
        var tgl_po = toAPIDateFormat($('#dtb-date_input').val())
        var id_partner = $('#src-supplier').val();
        var ket_supplier = $('#txt-ket_supplier').val();
        var id_jns_po = $('#cmb-jenis').val()
        var no_pp = $('#src-nopp').val()
        var id_termin_bayar = $('#cmb-payment option:selected').val();
        // var id_termin_bayar = $('#cmb-payment').combobox('getValue')
        var tempo_bayar = $('#txt-term-of-payment').val()
        var tgl_jatuh_tempo = toAPIDateFormat($('#dtb-date_jatuh_tempo').val())
        var id_termin_kirim = $('#cmb-delivery option:selected').val();
        // var id_termin_kirim = $('#cmb-delivery').combobox('getValue')
        var tgl_kirim = toAPIDateFormat($('#dtb-date_delivery').val())
        var jns_ppn = $('#cmb-ppn').val()
        var ket_po = $('#txt-ket').val()
        var tot_diskon = $("#txt-disc").numberbox('getValue');
        var subtotal = $("#txt-subtotal").numberbox('getValue');
        var biaya_lain = $('#txt-biaya_lain').numberbox('getValue');
        var p_ppn = $('#txt-persen').numberbox('getValue');
        var tot_ppn = $("#txt-ppn").numberbox('getValue');
        var diskon_nota = $("#txt-disc_nota").numberbox('getValue');
        var total = $("#txt-total").numberbox('getValue');
        var user_id = "<?php echo $this->session->userdata['user_id'] ?>";

        if (id_partner == '') {
            notif('warning','Data Supplier Belum dipilih!');
            return false;
        }

        if (no_pp == '') {
            notif('warning','No pp Belum dipilih!');
            return false;
        }

        if (id_termin_bayar == '') {
            notif('warning','Term Of Payment Belum dipilih!');
            return false;
        }

        if (id_termin_kirim == '') {
            notif('warning','Delivery Belum dipilih!');
            return false;
        }



        var master = {
            no_po : no_po,
            tgl_po : tgl_po,
            id_partner : id_partner,
            ket_supplier : ket_supplier,
            id_jns_po : id_jns_po,
            no_pp : no_pp,
            id_termin_bayar : id_termin_bayar,
            tempo_bayar : tempo_bayar,
            tgl_jatuh_tempo : tgl_jatuh_tempo,
            id_termin_kirim : id_termin_kirim,
            tgl_kirim : tgl_kirim,
            jns_ppn : jns_ppn,
            ket_po : ket_po,
            tot_diskon : tot_diskon,
            subtotal : subtotal,
            biaya_lain : biaya_lain,
            p_ppn : p_ppn,
            tot_ppn : tot_ppn,
            diskon_nota : diskon_nota,
            total : total,
            user_id : user_id,
        }

        var details = [];
        var row = $('#dtg-detail_item').datagrid('getRows');
        for (var i = 0 ; i < row.length; i++) {
            details.push({
                id_item: row[i]['id_item'],
                jml_minta : row[i]['jml_minta'],
                jml_po: row[i]['jml_po'],
                id_satuan_po: row[i]['id_satuan_po'],
                id_satuan_kecil: row[i]['id_satuan_kecil'],
                jml_satuan_kecil: row[i]['jml_satuan_kecil'],
                harga: row[i]['harga'],
                p_diskon: row[i] ['p_diskon'],
                tot_diskon: row[i]['tot_diskon'],
                total: row[i]['total']
            })
        }

        if(row.length <= 0){
          notif('warning','Detail Harus di isi!');
          return false;
        }

        var auths = [];
        var rowAuth = $('#dtg-auth').datagrid('getRows');
        for (var i=0; i<rowAuth.length; i++) {
          auths.push({
            sign_id : rowAuth[i]['sign_id'],
            user_id : rowAuth[i]['user_id'],
            is_default : rowAuth[i]['is_default'],
            seq_no : rowAuth[i]['seq_no']
          })
        }

        $.ajax({
          url : "<?php echo base_url("general/transaksi/Order_pembelian/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master: master,
            details: details,
            auths : auths,
            edit:edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if (edit==0)
            {
              swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value) {
                      var dataVerifikasi = {
                        no_po : data.no_po,
                        user_id : "<?php echo $this->session->userdata['user_id'] ?>"
                      }
                      verifikasi(dataVerifikasi, 'release')
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

    function filter() {
        var dg = $('#dtg-order_pembelian').datagrid('loadData', []);
        data= {
            status:$('#cmb-status').val(),
            start_date:toAPIDateFormat($('#dtb-start_date').val()),
            end_date:toAPIDateFormat($('#dtb-end_date').val()),
            criteria:$('#txt-criteria').val(),
            page:1,
            page_row:10
        }

        var dg = $('#dtg-order_pembelian').datagrid({
          url : "<?php echo base_url("general/transaksi/Order_pembelian/filter"); ?>",
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

    function getData(no_po)
    {
      $.ajax({
        url : "<?php echo base_url("general/transaksi/Order_pembelian/getPerKode"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: no_po,
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
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
        $('#txt-no').val(data.master.no_po);
        $('#dtb-date_input').val(toAppDateFormat(data.master.tgl_po))
        $('#src-supplier').val(data.master.id_partner);
        $('#txt-nama_supplier').val(data.master.partner_name)
        $('#txt-ket_supplier').val(data.master.ket_supplier);
        $('#src-nopp').val(data.master.no_pp);
        $('#cmb-jenis').val(data.master.id_jns_po);
        $('#cmb-jenis').val(data.master.id_jns_po);
        $('#cmb-ppn').val(data.master.jns_ppn);
        $('#cmb-payment').val(data.master.id_termin_bayar).change();
        $('#cmb-delivery').val(data.master.id_termin_kirim).change();
        // $('#cmb-payment').combobox('setValue',data.master.id_termin_bayar);
        // $('#cmb-delivery').combobox('setValue',data.master.id_termin_kirim);
        $('#dtb-date_delivery').val(toAppDateFormat(data.master.tgl_kirim))
        $('#txt-ket').val(data.master.ket_po);
        $('#txt-persen').numberbox('setValue', data.master.p_ppn)
        $('#txt-disc_nota').numberbox('setValue', data.master.diskon_nota)
        $('#txt-biaya_lain').numberbox('setValue', data.master.biaya_lain)
        $('#txt-term-of-payment').val(data.master.tempo_bayar)
        $('#txt-delivery').val(data.master.tempo_kirim)
        $('#btn-open').attr('hidden', !data.master.m_open);
        $('#btn-approve').attr('hidden', !data.master.m_approve);
        $('#btn-reject').attr('hidden', !data.master.m_reject);
        $('#btn-release').attr('hidden', !data.master.m_release);
        $('#txt-label_nopo').text('No PO : '+data.master.no_po);
        $('#txt-label_status').text('Status : '+data.master.status_caption);
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
        // $('#txt-label_posted').text(data.master.status_posting);
        /*$('#btn-hapus').attr('hidden', !data.master.btn_hapus);
        $('#btn-batal').attr('hidden', !data.master.btn_batal);*/
        set_jatuh_tempo();
        $('#cmb-jenis').prop('disabled', true);

        if (data.master.status_caption == 'Open') {
            $('.div_simpan').show()
            $('#btn-hapus').show();
            $('#btn-show-supplier').show();
            $('#btn-show-nopp').show();
            $('#cmb-ppn').prop('disabled', false);
        }else{
            $('#dtg-detail_item').datagrid('hideColumn', 'action');
            $('.div_simpan').hide()
            $('#btn-hapus').hide();
            $('#btn-show-supplier').hide();
            $('#btn-show-nopp').hide();
            $('#cmb-ppn').prop('disabled', true);
        }
        /*$('#src-nopp').searchbox({disabled : true});
        $('#src-supplier').searchbox({disabled : true});*/
        
        $('#dtg-auth').datagrid('loadData',[]);
        $('#dtg-auth').datagrid('loadData',data.autor);
        $('#dtg-detail_item').datagrid('loadData',data.detail);

        arrSatuan = [];
        for (var i = 0 ; i < data.detail.length; i++) {
            arrSatuan.push(data.detail[i]['data_satuan'])
        }

        set_total();
    }

    function hapus() {
        let no_po = $('#txt-no').val();
      let status_caption = $('#txt-status_caption').val();
      
      data={
        no_po : no_po,
        user_id: "<?php echo $this->session->userdata['user_id'] ?>"
      } 

      // console.log(data);

      swal.fire(cohapus()).then(function(result) {
          if (result.value) {
              $.ajax({
                url : "<?php echo base_url("general/transaksi/Order_pembelian/hapus"); ?>",
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

    function close_po()
    {
        let no_pp = $('#src-nopp').val();

        if (no_pp=='')
        {
            notif('warning','No. PP Kosong');
            return false;
        }
        
        data={
            no_pp : no_pp,
            user_id: "<?php echo $this->session->userdata['user_id'] ?>"
        }

        console.log(data);
        
        $.ajax({
            url : "<?php echo base_url("general/transaksi/Order_pembelian/close_po"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
            data: data,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
            notif('success',data.message);
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function verifikasi(data,status) {
        var no_po = data.no_po;
        $.ajax({
            url : "<?php echo base_url("general/transaksi/Order_pembelian/status"); ?>",
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
                    getData(no_po);
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
    function status(status) {
      var data={
        no_po : $('#txt-no').val(),
        user_id : "<?php echo $this->session->userdata['user_id'] ?>"
      }
      swal.fire(costatus()).then(function(result) {
          if (result.value) {
              verifikasi(data,status);
          }
      });
    }

    function validation(status) {
        $('#txt-tempStatus').val(status)
        $('#alert').modal('show');
    }

    function numberFormat(val, row) {
        if (val % 1 ==0) {
            return appGridNumberFormatter(val, row)
        }else{
            return val
        }
    }
</script>