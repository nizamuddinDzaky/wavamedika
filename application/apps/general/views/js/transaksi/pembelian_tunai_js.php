<script type="text/javascript">

    var edit                 = 0;
    var arrSatuan            = [];
    var detail_item          = [];
    var comboboxGridSelected = 0;
    var rowGridSelected      = 0;
    var edit_detail          = 0;

    $(function(){
		
        tab(0);

        get_gudang();
    
    });

    function tab(tab)
    {
        if(tab==0)
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
        edit = 0;
        reset_form();
        set_read(false);
        get_gudang();
        tab(1);
    }

    function btn_ubah()
    {
        var row = $('#dtg-pembelian_tunai').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }
        edit = 1;
        reset_form();
        if(row.status_caption!="Open")
        {
            set_read(true);
        }
        else
        {
            set_read(false);
        }
        get_data(row.no_bpb);
    }

	$('#btn-tambah_detail_item').click(function(event) {
		$('#txt-kriteria_barang').val('');
        filter_barang();
        $('#win-detail_item').window('open');
	});

    $('#btn-batal_detail_item').click(function(event) {
        $('#win-detail_item').window('close');
    });

    function pilih_barang() {
        var row = $('#dtg-barang').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        var data_grid = [];
        data_grid = $('#dtg-detail').datagrid('getRows');

        for (var i = 0 ; i < row.length; i++) {
            row[i]['id_item']           = row[i]['id_item'];
            row[i]['kd_item']           = row[i]['kd_item'];
            row[i]['nama_item']         = row[i]['nama_item'];
            row[i]['id_satuan']         = row[i]['id_satuan'];
            row[i]['nama_satuan']       = row[i]['nama_satuan'];
            row[i]['id_satuan_kecil']   = row[i]['id_satuan'];
            row[i]['nama_satuan_kecil'] = row[i]['nama_satuan'];
            row[i]['harga']             = row[i]['hpp'];
            
            row[i]['jml_bpb']           = 1;
            row[i]['p_diskon']          = 0.0;
            row[i]['tot_diskon']        = 0;
            row[i]['total']             = 0;
            
            row[i]['tgl_ed']            = setDateNow();
            
            row[i]['no_batch']          = "O";

            arrSatuan.push(row[i]['data_satuan']);

            for (var j = 0; j < row[i]['data_satuan'].length; j++)
            {
                if (row[i]['data_satuan'][j]['id_satuan']==row[i]['id_satuan'])
                {
                    row[i]['rasio']            = row[i]['data_satuan'][j]['ratio'];
                    row[i]['jml_satuan_kecil'] = 1 * row[i]['data_satuan'][j]['nilai'];
                    break;
                }
            }
        }
  
        var cek;
        for (var i = 0; i < row.length; i++)
        {
            cek = 0;
            for (var j = 0; j < data_grid.length; j++)
            {
                if (data_grid[j]['kd_item']==row[i]['kd_item'])
                {
                    cek=1;
                }
            }

            if (cek==0)
            {
                data_grid.push(row[i]);
            }
        }

        $('#dtg-detail').datagrid('loadData', []);
        $('#dtg-detail').datagrid('loadData', data_grid);
            
        $('#win-detail_item').window('close');

        comboboxGridSelected = -1;

        set_total();

        console.log(arrSatuan);
        
    }

    $('#src-supplier').searchbox({
        searcher: show_supplier,
    });

    function show_supplier()
    {
        $('#txt-kriteria_supplier').val('');
        filter_supplier();
        $('#win-cari_supplier').window('open');
    }

    function pilih_supplier()
    {
        let row = $('#dtg-supplier').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#src-supplier').searchbox('setValue',row.partner_name);
        $('#txt-partner_id').val(row.partner_id);
        $('#txt-alamat').val(row.partner_address);
        $('#win-cari_supplier').window('close');
    }

    $('#src-no_kasbon').searchbox({
        searcher: show_no_kasbon,
    });

    function show_no_kasbon()
    {
        $('#txt-kriteria_kasbon').val('');
        filter_kasbon();
        $('#win-cari_no_kasbon').window('open');
    }

    function pilih_kasbon()
    {
        let row = $('#dtg-kasbon').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#src-no_kasbon').searchbox('setValue',row.ct_no);
        $('#dtb-tgl_kasbon').val(toAppDateFormat(row.ct_date));
        $('#nmb-total_kasbon').numberbox('setValue',row.cash_adv_blc);
        $('#win-cari_no_kasbon').window('close');
    }

    function batal()
    {
        $('#win-cari_supplier').window('close');
        $('#win-cari_no_kasbon').window('close');
        $('#win-detail_item').window('close');
    }

	$('#cmb-ppn').click(function (argument)
    {
        if ($(this).val() == 2)
        {
            $('#nmb-persen').numberbox('setValue', 0);
            // $('#nmb-persen').numberbox({disabled : true});
            $('#nmb-persen').numberbox('readonly', true);
        }
        else
        {
            $('#nmb-persen').numberbox('setValue', 10);
            // $('#nmb-persen').numberbox({disabled : true});
            $('#nmb-persen').numberbox('readonly', true);
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

    // $('.change').numberbox({
    //     onChange: function(){
    //         set_total();
    //     }
    // });

    $('#nmb-persen').numberbox({
        'precision' : 0,
        'min' : 0,
        'required':true,
        'groupSeparator' :'.',
        'decimalSeparator' :',',
    });

    function reset_form()
    {
        $('.div_simpan').show();
        $('.div_hidden').hide();

        $('#txt-label_no').text("No. Pembelian : ");
        $('#txt-label_status').text("Status : ");
        $('#txt-label_posted').text(" ");

        $('#txt-no_bpb').val('');
        $('#dtb-tgl_bpb').val(appDateFormatter(new Date()));
        $('#cmb-gudang').val('').change();
        $('#txt-partner_id').val('');
        $('#src-supplier').searchbox('setValue','');
        $('#txt-alamat').val('');
        
        $('#txt-nota').val('');
        $('#dtb-tgl_nota').val(appDateFormatter(new Date()));
        
        $('#src-no_kasbon').searchbox('setValue','');
        $('#dtb-tgl_kasbon').val(appDateFormatter(new Date()));
        
        $('#nmb-total_kasbon').numberbox('setValue',0);
        $('#nmb-pemakaian').numberbox('setValue',0);
        
        $('#nmb-sisa_kasbon').numberbox('setValue',0);

        $('#nmb-harga_grid').numberbox('setValue',0);
        $('#nmb-disc_harga_grid').numberbox('setValue',0);
        $('#nmb-subtotal_grid').numberbox('setValue',0);
        
        $('#txt-keterangan').val('');

        $('#nmb-subtotal').numberbox('setValue',0);
        $('#nmb-disc_nota').numberbox('setValue',0);
        
        $('#nmb-persen').numberbox('setValue',10);
        $('#nmb-ppn').numberbox('setValue',0);
        $('#nmb-biaya_lain').numberbox('setValue',0);

        $('#cmb-ppn').val(1).change();
        
        $('#nmb-total').numberbox('setValue',0);

        $('#txt-status_caption').val('');
        
        reset_button();
        
        $('#dtg-detail').datagrid('loadData', []);

        set_total();

        arrSatuan = [];
    }

    function reset_button()
    {
        // body...
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-cetak').show();

        $('#btn-open').hide();
        $('#btn-release').hide();
        $('#btn-approve').hide();
    }

    function set_read(kondisi)
    {
        $('#txt-no_bpb').prop('disabled', true);
        $('#dtb-tgl_bpb').prop('disabled', kondisi);
        $('#cmb-gudang').prop('disabled', kondisi);
        $('#src-supplier').searchbox('readonly', kondisi);
        $('#txt-alamat').prop('disabled', true);

        $('#cmb-ppn').prop('disabled', kondisi);
        
        $('#txt-nota').prop('disabled', kondisi);
        $('#dtb-tgl_nota').prop('disabled', kondisi);
        
        $('#src-no_kasbon').searchbox('readonly', kondisi);
        $('#dtb-tgl_kasbon').prop('disabled', true);
        
        $('#nmb-total_kasbon').numberbox('readonly', true);
        $('#nmb-pemakaian').numberbox('readonly', true);
        
        $('#nmb-sisa_kasbon').numberbox('readonly', true);

        $('#nmb-harga_grid').numberbox('readonly', true);
        $('#nmb-disc_harga_grid').numberbox('readonly', true);
        $('#nmb-subtotal_grid').numberbox('readonly', true);
        
        $('#txt-keterangan').prop('disabled', kondisi);

        $('#nmb-subtotal').numberbox('readonly', true);
        $('#nmb-disc_nota').numberbox('readonly', kondisi);
        
        $('#nmb-persen').numberbox('readonly', true);
        $('#nmb-ppn').numberbox('readonly', true);
        $('#nmb-biaya_lain').numberbox('readonly', kondisi);
        
        $('#nmb-total').numberbox('readonly', true);

        if (edit==0&&kondisi==false) //tambah
        {
          $('#div_status').hide();
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();

          $('.div_simpan').show();

          $('#dtg-detail').datagrid('showColumn', 'action');
        }

        if (edit==1&&kondisi==false) //ubah 
        {
            $('#cmb-gudang').prop('disabled', true);
            $('#src-supplier').searchbox('readonly', true);

            $('#cmb-ppn').prop('disabled', false);
            $('#src-no_kasbon').searchbox('readonly', true);

            $('#div_status').show();
            $('#btn-aksi').show();
            $('#btn-hapus').show();
            $('#btn-cetak').show();

            $('.div_simpan').show();

            $('#dtg-detail').datagrid('showColumn', 'action');          
        }

        if (edit==0&&kondisi==true) //ubah readonly
        {
          $('#div_status').show();
          $('#btn-aksi').show();
          $('#btn-hapus').hide();
          $('#btn-cetak').show();

          $('.div_simpan').hide();

          $('#dtg-detail').datagrid('hideColumn', 'action');
        }
    }

	$('#dtg-pembelian_tunai').datagrid({
		singleSelect:true,
		idField:'itemid',
		onDblClickRow:function(index,row){
			btn_ubah();
		},
		columns:[[
			{field:'no_bpb',title:'No. Pembelian',width:"12%",halign:'center',align:'center'},
			{field:'tgl_bpb',title:'Tgl. Pembelian',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
			{field:'partner_name',title:'Nama Supplier',width:"25%",halign:'center',align:'left'},
			{field:'total',title:'Total',width:"10%",halign:'center',align:'right',formatter: formatIndo},
			{field:'ket_bpb',title:'Catatan',width:"20%",halign:'center',align:'left'},
			{field:'status_caption',title:'Status',width:"10%",halign:'center',align:'left'},
			{field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
			{field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
        	{field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
        	{field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
		]],
	});

	$('#dtg-detail').datagrid({
        title:'Detail Item',
        singleSelect:true,
        idField:'itemid',
        showFooter:true,
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'ID',width:100,halign :"center", hidden:true},
            {field:'kd_item',title:'Kode',width:"10%",halign :"center", align:"center"},
            {field:'nama_item',title:'Nama Item',width:"20%",halign :"center", align:"left"},
            // {field:'id_satuan',title:'ID Satuan',width:70,halign :"center"},
            {field:'nama_satuan',title:'Satuan',width:"7%",halign :"center", align:"center"},
            {field:'rasio',title:'Rasio',width:"10%",halign :"center",align:"left"},
            {field:'rasio_nilai',title:'Rasio N',width:70,halign :"center",align:"right", formatter: datagridFormatNumber, hidden:true},
            {field:'jml_bpb',title:'Jumlah',width:"8%",halign :"center",align:"right", formatter: numberFormat,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var harga_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var p_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var persen = $(harga_ed.target).numberbox('getValue') * $(this).val()*$(p_diskon_ed.target).numberbox('getValue') / 100
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {field:'harga',title:'Harga Satuan',width:"10%",halign :"center",align:"right", formatter: formatIndo,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :',',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var p_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var jumlah_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_bpb'
                            });

                            var persen = $(jumlah_ed.target).numberbox('getValue') * $(this).val()*$(p_diskon_ed.target).numberbox('getValue') / 100
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {field:'p_diskon',title:'Disc. (%)',width:"7%",halign :"center", align:"right", formatter: numberFormat,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        // 'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var harga_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var jumlah_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_bpb'
                            });

                            var persen = $(jumlah_ed.target).numberbox('getValue') * $(this).val()*$(harga_ed.target).numberbox('getValue') / 100
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {field:'tot_diskon',title:'Disc. (Harga)',width:"10%",halign :"center", align:"right", formatter: formatIndo,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :',',
                        onChange: function(){
                            var p_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var harga_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var jumlah_ed = $('#dtg-detail').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_bpb'
                            });

                            var persen = $(this).val()/($(harga_ed.target).numberbox('getValue') * $(jumlah_ed.target).numberbox('getValue') )*100

                            if (isNaN(persen)) {
                                persen = 0
                            }
                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'p_diskon');*/
                            $(p_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {field:'total',title:'Sub Total',width:"10%",halign :"center", align:"right", formatter: formatIndo},
            {field:'jml_satuan_kecil',title:'Jml. Satuan Kecil',width:"10%",halign :"center", align:"right", formatter: numberFormat},
            {field:'id_satuan_kecil',title:'ID Satuan Kecil',width:"10%",halign :"center", align:"left", hidden:true},
            {field:'nama_satuan_kecil',title:'Satuan Kecil',width:"10%",halign :"center", align:"center"},
            {field:'tgl_ed',title:'Kedaluwarsa',width:"9%",halign :"center", align:"center", formatter:appGridDateFormatter,
            editor : {
                type : 'datebox',
                'required':true
                }
            },
            {field:'no_batch',title:'No. Batch',width:"10%",halign :"center", align:"left",
            editor : {
                    type : 'textbox',
                    required : true
                }
            },
            {field:'action',title:'Action',width:"12%",align:'center',
                formatter:function(value,row,index){
                    // console.log(row.kd_item);
                    if(row.kd_item == '' || row.kd_item == undefined)
                    {
                        return '';
                    }
                    else
                    {
                        if (row.editing)
                        {
                            var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverow(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                            var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrow(this)">Cancel</button>';
                            return s+c;
                        } else if(!row.editing)
                        {
                            var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrow(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                            var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterow(this)">Delete</button>';
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
            // row.total             = row.jml_bpb * (row.harga - row.tot_diskon);
            row.total             = (row.jml_bpb * row.harga) - row.tot_diskon;
            console.log(comboboxGridSelected);
            if(comboboxGridSelected>=0)
            {
                row.id_satuan_kecil   = arrSatuan[index][comboboxGridSelected]['id_satuan'];
                row.jml_satuan_kecil  = row.jml_bpb * arrSatuan[index][comboboxGridSelected]['nilai'];
                row.rasio_nilai       = arrSatuan[index][comboboxGridSelected]['nilai'];
                row.rasio             = arrSatuan[index][comboboxGridSelected]['ratio'];
                row.nama_satuan_kecil = arrSatuan[index][comboboxGridSelected]['id_satuan'];
            }
        },
        onBeforeEdit:function(index,row){
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
            set_total();
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }
    });

    $('#dtg-detail').datagrid('reloadFooter',[
        {"harga":0,"tot_diskon":0, "total":0}
    ]);

    function set_total(biayaLain = null, disNota = null) {
        
        var data = $("#dtg-detail").datagrid('getRows');

        var subtotal = 0;
        var totDisc = 0;
        var totHarga = 0
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++){

                subtotal+=parseInt(data[i].total);
                // subtotal+=parseInt(data[i].total) * parseInt(data[i].jml_bpb);
                if (isNaN(data[i].tot_diskon)==false&&data[i].tot_diskon!=null&&data[i].tot_diskon!=undefined)
                {
                    totDisc += parseInt(data[i].tot_diskon);
                }
                totHarga += parseInt(data[i].harga);
            }
        }

        var dg =$('#dtg-detail').datagrid('reloadFooter',[{"harga":totHarga, "tot_diskon":totDisc, "total":subtotal}]);

        $('#nmb-harga_grid').numberbox('setValue', totHarga);
        $('#nmb-disc_harga_grid').numberbox('setValue', totDisc);
        $('#nmb-subtotal_grid').numberbox('setValue', subtotal);

        var ppnPersen = $('#nmb-persen').numberbox('getValue');
        var ppn = ppnPersen / 100 * subtotal;
        if (biayaLain == null) {
          biayaLain = $('#nmb-biaya_lain').numberbox('getValue');
        }
        if (disNota == null) {
          disNota= $('#nmb-disc_nota').numberbox('getValue');
        }
        // var total = parseInt(subtotal) - parseInt(totDisc) + parseInt(ppn) + parseInt(biayaLain) - parseInt(disNota);

        var total = parseInt(subtotal) + parseInt(ppn) + parseInt(biayaLain) - parseInt(disNota);

        $("#nmb-ppn").numberbox('setValue', ppn);
        $("#nmb-disc").numberbox('setValue', totDisc);
        $("#nmb-subtotal").numberbox('setValue', subtotal);
        $("#nmb-total").numberbox('setValue', total);

        $("#nmb-pemakaian").numberbox('setValue', total);
    }

    function saverow(target)
    {
        var p_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'p_diskon'
        });

        var harga_ed = $('#dtg-detail').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'harga'
        });

        var tot_diskon_ed = $('#dtg-detail').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'tot_diskon'
        });

        // var persen = $(tot_diskon_ed.target).numberbox('getValue')/$(harga_ed.target).numberbox('getValue')*100;

        var persen = $(p_diskon_ed.target).numberbox('getValue');

        if (persen >= 100) {
            notif('warning','Diskon Lebih dari sama dengan 100%!');
            return false;
        }else{
            edit_detail = 0;
            $('#dtg-detail').datagrid('endEdit', getRowIndex(target));
        }

        // $('#dtg-detail').datagrid('endEdit', getRowIndex(target));
        set_total();
    }

    function editrow(target)
    {
        if (edit_detail==1)
        {
            notif('warning','Mohon pilih Save atau Cancel lebih dahulu');
            return false;
        }
        edit_detail = 1;
        var index = getRowIndex(target);
        rowGridSelected = index;
        var x = $("#dtg-detail").datagrid('getColumnOption', 'nama_satuan');
        x.editor = {
                    type:'combobox',
                    options:{
                        valueField:'id_satuan',
                        textField:'id_satuan',
                        data: arrSatuan[index],
                        required:false,
                        onClick: function(rec){
                            comboboxGridSelected = arrSatuan[index].indexOf(rec);
                            // row.rasio_nilai      = rec.nilai;
                            // row.rasio            = rec.ratio;
                        }   
                    }
                }
        // var row = $('#dtg-detail').datagrid('getRows')[index];
        $('#dtg-detail').datagrid('beginEdit',index );

        // $('#dtg-detail').datagrid('beginEdit', getRowIndex(target));
    }

    function deleterow(target)
    {
        // edit_detail = 0;
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail').datagrid('deleteRow', getRowIndex(target));
                arrSatuan.splice(getRowIndex(target),1);
                set_total();
                console.log(arrSatuan);
              }
        });
    }

    function cancelrow(target)
    {
        edit_detail = 0;
        $('#dtg-detail').datagrid('cancelEdit', getRowIndex(target));
        set_total();
    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function get_gudang()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("general/transaksi/pembelian_tunai/get_gudang"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-gudang").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter()
    {
        $('#dtg-pembelian_tunai').datagrid('loadData', []);

        let startDate = toAPIDateFormat($('#dtb-start_date').val());
        let endDate = toAPIDateFormat($('#dtb-end_date').val());
        let status = $('#cmb-status').val();
        let criteria = $('#txt-criteria').val();
        data = {
            status : status,
            start_date: startDate,
            end_date:endDate, 
            criteria:criteria,
            page: 1,
            page_row: 10,
        }

        var dg = $('#dtg-pembelian_tunai').datagrid({
          url : "<?php echo base_url("general/transaksi/pembelian_tunai/filter"); ?>",
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
        $('#dtg-supplier').datagrid('loadData', []);

        let criteria = $('#txt-kriteria_supplier').val();
        data = {
            criteria:criteria,
            page: 1,
            page_row: 10,
        }

        var dg = $('#dtg-supplier').datagrid({
          url : "<?php echo base_url("general/transaksi/pembelian_tunai/filter_supplier"); ?>",
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

    function filter_kasbon()
    {
        $('#dtg-kasbon').datagrid('loadData', []);

        let criteria = $('#txt-kriteria_kasbon').val();
        data = {
            criteria:criteria,
            page: 1,
            page_row: 10,
        }

        var dg = $('#dtg-kasbon').datagrid({
          url : "<?php echo base_url("general/transaksi/pembelian_tunai/filter_uang_muka"); ?>",
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
        $('#dtg-barang').datagrid('loadData', []);

        let criteria = $('#txt-kriteria_barang').val();
        data = {
            criteria:criteria,
            page: 1,
            page_row: 10,
        }

        var dg = $('#dtg-barang').datagrid({
          url : "<?php echo base_url("general/transaksi/pembelian_tunai/filter_barang"); ?>",
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

    function simpan()
    {
        var no_bpb         = $('#txt-no_bpb').val();
        
        var tgl_bpb        = toAPIDateFormat($('#dtb-tgl_bpb').val());
        var id_gudang      = $('#cmb-gudang option:selected').val();   
        var id_partner     = $('#txt-partner_id').val();
        var ket_supplier   = $('#txt-alamat').val();
        var jns_ppn        = $('#cmb-ppn option:selected').val();
        var no_faktur_sup  = $('#txt-nota').val();
        var tgl_faktur_sup = toAPIDateFormat($('#dtb-tgl_nota').val());
        var ct_no          = $('#src-no_kasbon').searchbox('getValue');
        var cash_adv_blc   = $('#nmb-total_kasbon').numberbox('getValue');
        var ket_bpb        = $('#txt-keterangan').val();
        var tot_diskon     = $('#nmb-disc_harga_grid').numberbox('getValue');
        var sub_total      = $('#nmb-subtotal').numberbox('getValue');
        var diskon_nota    = $('#nmb-disc_nota').numberbox('getValue');
        var p_ppn          = $('#nmb-persen').numberbox('getValue');
        var tot_ppn        = $('#nmb-ppn').numberbox('getValue');
        var biaya_lain     = $('#nmb-biaya_lain').numberbox('getValue');
        var total          = $('#nmb-total').numberbox('getValue');
        var user_id        = "<?php echo $this->session->userdata['user_id'] ?>"
        
        if (id_gudang == ''|| id_partner == ''|| no_faktur_sup == ''|| ct_no == ''|| ket_bpb == '')
        {
          let msg = '<br>';
          if (id_gudang == '') {
            msg += 'Gudang <br>';
          }

          if (id_partner == '') {
            msg += 'Supplier <br>';
          }

          if (no_faktur_sup == '') {
            msg += 'No. Nota <br>';
          }
          if (ct_no == '') {
            msg += 'No. Kasbon <br>';
          }
          if (ket_bpb == '') {
            msg += 'Keterangan <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        if(no_bpb != "")
        {

            master={
                no_bpb        : no_bpb,
                tgl_bpb       : tgl_bpb,
                jns_ppn       : jns_ppn,
                no_faktur_sup : no_faktur_sup, 
                tgl_faktur_sup: tgl_faktur_sup, 
                ket_bpb       : ket_bpb, 
                tot_diskon    : tot_diskon,
                subtotal      : sub_total, 
                diskon_nota   : diskon_nota, 
                p_ppn         : p_ppn, 
                tot_ppn       : tot_ppn, 
                biaya_lain    : biaya_lain, 
                total         : total, 
                user_id       :  "<?php echo $this->session->userdata['user_id'] ?>"
            };

        }
        else
        {
            master={ 
            tgl_bpb       : tgl_bpb,
            id_gudang     : id_gudang, 
            id_partner    : id_partner,
            ket_supplier  : ket_supplier,
            jns_ppn       : jns_ppn,
            no_faktur_sup : no_faktur_sup, 
            tgl_faktur_sup: tgl_faktur_sup, 
            ct_no         : ct_no, 
            cash_adv_blc  : cash_adv_blc , 
            ket_bpb       : ket_bpb, 
            tot_diskon    : tot_diskon,
            subtotal      : sub_total, 
            diskon_nota   : diskon_nota, 
            p_ppn         : p_ppn, 
            tot_ppn       : tot_ppn, 
            biaya_lain    : biaya_lain, 
            total         : total, 
            user_id       :  "<?php echo $this->session->userdata['user_id'] ?>"
            }
        }

        row = $('#dtg-detail').datagrid('getRows');
        if(row.length <= 0)
        {
            notif('warning','Detail Harus di isi!');
            return false;
        }

        var details = [];
        
        for (var i=0; i<row.length; i++) {
            details.push({
                id_item         : row[i]['id_item'], 
                id_satuan_po    : row[i]['id_satuan'], 
                jml_bpb         : parseInt(row[i]['jml_bpb']), 
                id_satuan_kecil : row[i]['nama_satuan_kecil'],
                jml_satuan_kecil: parseInt(row[i]['jml_satuan_kecil']), 
                harga           : row[i]['harga'], 
                p_diskon        : row[i]['p_diskon'], 
                tot_diskon      : row[i]['tot_diskon'], 
                total           : row[i]['total'],
                tgl_ed          : setDate(row[i]['tgl_ed']), 
                no_batch        : row[i]['no_batch'],
                rasio           : row[i]['rasio'] 
            });
        }

        console.log(master);
        console.log(details);

        // return false;

        $.ajax({
          url : "<?php echo base_url('general/transaksi/pembelian_tunai/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master:master,
            details : details
            },
          beforeSend: function (){               
            },
          success:function(data, textStatus, jqXHR){
            if(edit!=1)
            {
                swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value)
                  {
                      status('release',data.no_bpb);
                  }
                  else
                  {
                    tab(0);
                  }
                }); 
            }
            else
            {
              if(data.error){
                notif('error',data.message);
              }else{
                notif('success',data.message);
              }
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

    function get_data(no)
    {
        $.ajax({
            url     : "<?php echo base_url("general/transaksi/pembelian_tunai/getPembelian"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data:no,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
                tab(1);
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function set_form(data)
    {
        detail_item = [];

        $('#dtg-detail').datagrid('loadData', data.details);
        
        detail_item = data.details;

        set_total();

        $('#txt-label_no').text("No. Permintaan : "+data.master.no_bpb);

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

        $('#txt-status_caption').val(data.master.status_caption);

        $('#txt-no_bpb').val(data.master.no_bpb);
        $('#dtb-tgl_bpb').val(toAppDateFormat(data.master.tgl_bpb));
        $('#cmb-gudang').val(data.master.id_gudang).change();
        $('#txt-partner_id').val(data.master.id_partner);
        $('#src-supplier').searchbox('setValue',data.master.partner_name);
        $('#txt-alamat').val(data.master.partner_address);

        $('#cmb-ppn').val(data.master.jns_ppn).change(); // bug
        // $('#cmb-ppn').text(data.master.ket_jns_ppn);

        if (data.master.jns_ppn==2)
        {
            $('#nmb-persen').numberbox('setValue', 0);
            // $('#nmb-persen').numberbox({disabled : true});
            $('#nmb-persen').numberbox('readonly', true);
        }
        else
        {
            $('#nmb-persen').numberbox('setValue', 10);
            // $('#nmb-persen').numberbox({disabled : true});
            $('#nmb-persen').numberbox('readonly', true);
        }
        
        $('#txt-nota').val(data.master.no_faktur_sup);
        $('#dtb-tgl_nota').val(toAppDateFormat(data.master.tgl_faktur_sup));
        
        $('#src-no_kasbon').searchbox('setValue',data.master.ct_no);
        $('#dtb-tgl_kasbon').val(toAppDateFormat(data.master.ct_date));
        
        $('#nmb-total_kasbon').numberbox('setValue',data.master.ct_amount);
        $('#nmb-pemakaian').numberbox('setValue',data.master.total);
        
        $('#nmb-sisa_kasbon').numberbox('setValue',data.master.cash_adv_blc);

        // $('#nmb-harga_grid').numberbox('setValue',0);
        // $('#nmb-disc_harga_grid').numberbox('setValue',0);
        // $('#nmb-subtotal_grid').numberbox('setValue',0);
        
        $('#txt-keterangan').val(data.master.ket_bpb);

        $('#nmb-subtotal').numberbox('setValue',data.master.subtotal);
        $('#nmb-disc_nota').numberbox('setValue',data.master.diskon_nota);
        
        $('#nmb-persen').numberbox('setValue',data.master.p_ppn);
        $('#nmb-ppn').numberbox('setValue',data.master.tot_ppn);
        $('#nmb-biaya_lain').numberbox('setValue',data.master.biaya_lain);
        
        $('#nmb-total').numberbox('setValue',data.master.total);

        arrSatuan = [];
        for (var i = 0 ; i < data.details.length; i++) {
            arrSatuan.push(data.details[i]['data_satuan'])
        }

        if(data.master.m_open==true)
        {
          $('#btn-open').show();
        }
        if(data.master.m_release==true)
        {
          $('#btn-release').show();
        }
    }

    function status(status,no)
    {
        // body...
        var no_bpb;
        if (no==0)
        {
          no_bpb = $('#txt-no_bpb').val();
        }
        else
        {
          no_bpb = no;
        }

        if (no_bpb=="")
        {
          return false;
        }

        var data={
          no_bpb : no_bpb,
          user_id : "<?php echo $this->session->userdata['user_id'] ?>"
        }

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

    function verifikasi(data,status) {
        var no_bpb = data.no_bpb;
        $.ajax({
            url     : "<?php echo base_url("/general/transaksi/pembelian_tunai/verifikasi"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data: data,
                status : status
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                if(status=="open"&&data.success==true)
                {
                    reset_button();
                    get_data(no_bpb);
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
                notif('error','Error, Something goes wrong');
            },
                complete: function(){
            }
        }); 
    }

    function hapus(){
        
        let no_bpb = $('#txt-no_bpb').val();

        data={
            no_bpb: no_bpb,
            user_id    : "<?php echo $this->session->userdata['user_id'] ?>"
        }

        swal.fire(cohapus()).then(function(result) {
          if (result.value) {
            $.ajax({
                url     : "<?php echo base_url("/general/transaksi/pembelian_tunai/hapus"); ?>",
                type    : "POST",
                dataType: 'json',
                data    :{
                    data: data,
                },
                beforeSend: function (){               
                },
                success:function(data, textStatus, jqXHR){
                    notif('success',data.message);
                    tab(0);                 
                },
                error: function(jqXHR, textStatus, errorThrown){
                    notif('error','Error, Something goes wrong');
                },
                    complete: function(){
                }
            });
          }
        });
    }

    function numberFormat(val, row) {
        if (val % 1 ==0) {
            return appGridNumberFormatter(val, row)
        }else{
            return val
        }
    }

</script>