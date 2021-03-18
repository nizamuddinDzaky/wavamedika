<script type="text/javascript">
	var konfigurasi = new Object();
    var cmb_dokter  = new Object();
    var cmb_kamar   = new Object();
    var unit        = new Object();

    var edit = 0;
    
    var nama_item    = [];
    var item_select  = [];

    var rowGridSelected = 0;
    var edit_detail     = 0;

    var data_detail  = [];
    var ket_detail   = [];

    var data_item_rc = [
    {id_item_rc:'-'},{id_item_rc:'R1'},{id_item_rc:'R2'},{id_item_rc:'R3'},{id_item_rc:'R4'},{id_item_rc:'R5'}
    ];
    
    unit.id         = "<?php echo $this->session->userdata['id_unit'] ?>";
    unit.nama       = "<?php echo $this->session->userdata['nama_unit'] ?>";

    var tr = '';
    var start = "<tr class='tr-list'>"+
                "<td style='border: none;'></td>"+
                "<td style='border: none;'></td>"+
                "<td style='border: 1px solid black;'><table>";
    var end =   "</table></td>"+
                "<td style='border: none;'></td>"+
                "<td style='border: none;'></td>"+
                "<td style='border: none;'></td></tr>";

    var ajaxReq = 'ToCancelPrevReq';

    $(function(){
		$('#label-unit').text(unit.nama);
        tab(0);
        get_konfigurasi();
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

    $('#nmb-persen').numberbox({
        'precision' : 0,
        'min' : 0,
        'required':true,
        'groupSeparator' :'.',
        'decimalSeparator' :',',
    });

    $('#cmb-dokter').select2({
        placeholder: 'Pilih Dokter'
    });
    $('#cmb-dokter').on('select2:select', function (e) {
        let data   = e.params.data;
        cmb_dokter = data;
    });

    $('#cmb-klinik_ruang').select2({
        placeholder: 'Pilih Klinik/Ruang'
    });
    $('#cmb-klinik_ruang').on('select2:select', function (e) {
        let data   = e.params.data;
        cmb_kamar = data;
    });

    $('#btn-e_resep').click(function(event) {
        let no_billing = $('#txt-no_billing').val();
        if(no_billing == "")
        {
            notif('warning','No. Billing Belum Di Pilih')
            return false;
        }
        cek_resep('master',no_billing);
    });

    $('#btn-paket_obat_alkes').click(function(event) {
        $('#txt-kriteria_paket').val('');
        filter_paket('master',[]);
        $('#win-paket_obat_alkes').window('open');
    });

    $('#btn-no_billing').click(function(event) {
        $('#txt-kriteria_billing').val('');
        filter_billing();
        $('#win-cari_no_billing').window('open');
    });

    $('#txt-no_billing').bind('keydown', function(e){
       if (e.keyCode == 13)
       {
            let criteria = $("#txt-no_billing").val();
            if (criteria!="")
            {
                cari_billing(criteria);
            }
            // return false;
       }
    });
    
    $('#txt-no_billing').on('input', function() {
        // do something
        let text = $('#txt-no_billing').val();
        reset_form();
        set_read(false);
        $('#txt-no_billing').val(text);
    });

    function pilih_billing()
    {
        let row = $('#dtg-billing').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        set_billing(row);
        $('#win-cari_no_billing').window('close');
    }

    function pilih_eresep()
    {
        // body...
        let eresep_master = $('#dtg-e_resep').datagrid('getSelected');
        if(eresep_master <= 0)
        {
            notif('warning','Data E-Resep Belum Di Pilih')
            return false;
        }

        $('#cmb-klinik_ruang').val(eresep_master.id_kamar).change();
        $('#cmb-dokter').val(eresep_master.id_dokter).change();

        let row = $('#dtg-e_resep_detail').datagrid('getRows');
        
        let detail_item  = $('#dtg-detail_item').datagrid('getRows');

        for (var i = 0 ; i < row.length; i++) {
            if (row[i]['nr']=='N')
            {
                row[i]['id_item_rc'] = '-';
            }
            else
            {
                row[i]['id_item_rc'] = row[i]['nr'];
            }
            
            row[i]['nama_obat']  = row[i]['nama_obat'];
            row[i]['id_item']    = row[i]['id_item'];
            row[i]['nama_item']  = row[i]['nama_item'];
            row[i]['kd_item']    = row[i]['kd_item'];
            row[i]['jml_paket']  = row[i]['qty'];
            row[i]['jml_npaket'] = 0;
            row[i]['jml']        = row[i]['qty'];
            row[i]['signa1']     = row[i]['aturan'];
            row[i]['signa2']     = row[i]['aturan_buat'];

            row[i]['id_kel_item'] = row[i]['id_kel_item'];
            row[i]['is_for_rs']   = row[i]['is_for_rs'];
            row[i]['is_for_nas']  = row[i]['is_for_nas'];
            
            detail_item.push(row[i]);
        }
        $('#dtg-detail_item').datagrid('loadData', detail_item);
        
        $('#win-e_resep').window('close');
    }

    function pilih_paket()
    {
        // body...
        let paket_master = $('#dtg-paket_master').datagrid('getSelected');
        if(paket_master <= 0)
        {
            notif('warning','Data Paket Belum Di Pilih')
            return false;
        }

        let row         = $('#dtg-paket_detail').datagrid('getRows');
        let detail_item = $('#dtg-detail_item').datagrid('getRows');

        for (var i = 0 ; i < row.length; i++) {

            if (row[i]['stok']>0)
            {
                row[i]['id_item']     = row[i]['id_item'];
                row[i]['kd_item']     = row[i]['kd_item'];
                row[i]['nama_item']   = row[i]['nama_item'];
                row[i]['id_kel_item'] = row[i]['id_kel_item'];
                row[i]['id_satuan']   = row[i]['id_satuan'];
                row[i]['is_for_rs']   = row[i]['is_for_rs'];
                row[i]['is_for_nas']  = row[i]['is_for_nas'];
                row[i]['qty']         = row[i]['qty'];
                row[i]['stok']        = row[i]['stok'];
                row[i]['harga']       = row[i]['harga_jual'];
                row[i]['signa1']      = row[i]['signa1'];
                row[i]['signa2']      = row[i]['signa2'];

                detail_item.push(row[i]);
            }
        }

        $('#dtg-detail_item').datagrid('loadData', detail_item);
        $('#win-paket_obat_alkes').window('close');
    }

    function tab(tab)
    {
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            filter();
            $('#dtg-nota_rawat_jalan').datagrid('resize');
        }
        else{
            $('#browse').hide();
            $('#detail').show();
            $('#dtg-detail_item').datagrid('resize');
        }
    }

    function btn_tambah()
    {
        edit = 0;
        reset_form();
        set_read(false);
        get_select('ruang');
        get_select('dokter');
        tab(1);
        $("#txt-no_billing").focus();
    }

    function btn_ubah()
    {
        var row = $('#dtg-nota_rawat_jalan').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }
        edit = 1;
        reset_form();
        get_select('ruang');
        get_select('dokter');
        if(row.status_caption!="Unposted")
        {
            set_read(true);
        }
        else
        {
            set_read(false);
        }
        get_data(row.no_nota);
    }

    $("#dtg-e_resep").datagrid({
        onSelect: function(index, row) {
            $('#txt-id_eresep').val(row.id_eresep);
            cek_resep('detail',row.id_eresep);
        }
    });

    $("#dtg-paket_master").datagrid({
        onSelect: function(index, row) {
            filter_paket('detail',row);
        }
    });

	$('#dtg-nota_rawat_jalan').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
         	{field:'no_nota',title:'No. Nota',width:"12%",halign:'center',align:'center'},
         	{field:'tgl_nota',title:'Tgl. Nota',width:"8%",halign:'center',align:'center', formatter:appGridDateFormatter},
         	{field:'jns_bayar',title:'Status Pasien',width:"13%",halign:'center',align:'left'},
         	{field:'id_mrs',title:'No. Billing',width:"10%",halign:'center',align:'center'},
         	{field:'no_mr',title:'No. RM',width:"10%",halign:'center',align:'center'},
         	{field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
         	{field:'nama_dokter',title:'Dokter',width:"25%",halign:'center',align:'left'},
         	{field:'nama_unit',title:'Unit',width:"15%",halign:'center',align:'left'},
         	{field:'total',title:'Total',width:"10%",halign:'center',align:'left', formatter:appGridNumberFormatter},
         	{field:'c_status_posting',title:'Status Posting',width:"10%",halign:'center',align:'left'},
         	{field:'c_status_proses',title:'Status Proses',width:"10%",halign:'center',align:'left'},
         	{field:'user_ins_name',title:'Dibuat Oleh',width:"15%",halign:'center',align:'center'},
         	{field:'date_upd',title:'Tgl. Dibuat',width:"13%",halign:'center',align:'center', formatter: appGridDateTimeFormatter},
         	{field:'user_upd_name',title:'Diubah Oleh',width:"15%",halign:'center',align:'center'},     
         	{field:'date_upd',title:'Tgl. Diubah',width:"13%",halign:'center',align:'center', formatter: appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField:'itemid',
        showFooter:false,
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'id item',width:"10%",halign:'center',align:'left', hidden: true},//
            {field:'jns_obat',title:'jns obat',width:"10%",halign:'center',align:'left', hidden: true},//
            {field:'is_for_rs',title:'is for rs',width:"10%",halign:'center',align:'left', hidden: true},//
            {field:'is_for_nas',title:'is for nas',width:"10%",halign:'center',align:'left', hidden: true},//
            {field:'sub_total_paket',title:'Subtotal 7',width:"10%",halign:'center',align:'left', hidden: true},
            {field:'sub_total_npaket',title:'Subtotal 23',width:"10%",halign:'center',align:'left', hidden: true},

            {field:'id_item_rc',title:'RCK',width:"10%",halign:'center',align:'left',
            formatter:function(value,row){
                  return row.id_item_rc || value;
              },
              editor:{
                type:'combobox',
                options:{
                    panelHeight:'auto',
                    panelMinHeight:50,
                    panelMaxHeight:200,
                    valueField:'id_item_rc',
                    textField :'id_item_rc',
                    data      : data_item_rc,
                    // url       :'<?php echo base_url('farmasi/depo/Nota_farmasi_rawat_jalan/get_signa/1') ?>',
                    required  :true
                }
              }
            },//
         	{field:'nama_obat',title:'E-Resep',width:"25%",halign:'center',align:'left'},
         	{field:'nama_item',title:'Obat/Alkes',width:"10%",halign :"center",
                editor :{
                    type:'textbox',
                    /*class : 'hubla211',*/
                    options:{
                        required:true,
                        prompt:'Pilih Nama Item',
                        onChange: function()
                        {
                            
                        },
                        inputEvents:$.extend({},$.fn.textbox.defaults.inputEvents,{
                            keypress:function(e){
                                /*console.log(e.which);
                                if (e.which !== 0) {
                                    alert("Character was typed. It was: " + String.fromCharCode(e.which));
                                }*/
                                
                                // tr = $(this).closest('table').parent('div').parent('td').parent('tr').parent('tbody').closest('table')[0];
                                
                                // get_data_item($(this).val());
                                let text = $(this).val();
                                if (text!=''&&text.length>3)
                                {
                                    $('#win-cari_item').window('open');
                                    cari_item_datagrid($(this).val());
                                }
                                else
                                {
                                    $('#win-cari_item').window('close');
                                }
                            }
                        })
                    }
                }
            },
            {field:'kd_item',title:'Kode',width:"10%",halign:'center',align:'left'},
         	{field:'id_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},//
         	{field:'jml_paket',title:'7',width:"8%",halign:'center',align:'right',
            formatter:appGridNumberFormatter,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                        onChange: function(){
                            
                        }
                    }
                }
            },//
         	{field:'jml_npaket',title:'23',width:"12%",halign:'center',align:'right',
            formatter:appGridNumberFormatter,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                        onChange: function(){
                            
                        }
                    }
                }
            },//
            {field:'jml',title:'Jumlah',width:"12%",halign:'center',align:'right', formatter:appGridNumberFormatter,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                        onChange: function(){
                            
                        }
                    }
                }
            },//
         	{field:'signa1',title:'Signa 1',width:"10%",halign:'center',align:'left',
            formatter:function(value,row){
                  return row.signa1 || value;
              },
              editor:{
                type:'combobox',
                options:{
                    panelHeight:'auto',
                    panelMinHeight:50,
                    panelMaxHeight:200,
                    valueField:'signa',
                    textField :'signa',
                    url       :'<?php echo base_url('farmasi/depo/Nota_farmasi_rawat_jalan/get_signa/1') ?>',
                    required  :true
                }
              }
            },//
         	{field:'signa2',title:'Signa 2',width:"10%",halign:'center',align:'left',
            formatter:function(value,row){
                  return row.signa2 || value;
              },
              editor:{
                type:'combobox',
                options:{
                    panelHeight:'auto',
                    panelMinHeight:50,
                    panelMaxHeight:200,
                    valueField:'signa',
                    textField :'signa',
                    url       :'<?php echo base_url('farmasi/depo/Nota_farmasi_rawat_jalan/get_signa/2') ?>',
                    required  :true
                }
              }
            },//
         	{field:'harga',title:'Harga',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},//
         	{field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right', formatter:appGridNumberFormatter},
            {field:'action',title:'Action',width:"12%",align:'center',
                formatter:function(value,row,index){
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
                }
            }
        ]],
        onEndEdit:function(index,row){
            // console.log(item_select);
            if (item_select!='')
            {
                row.id_item     = item_select['id_item'];
                row.id_satuan   = item_select['id_satuan'];
                row.is_for_rs   = item_select['is_for_rs'];
                row.is_for_nas  = item_select['is_for_nas'];
                row.harga       = item_select['harga_jual'];

                row.id_kel_item = item_select['id_kel_item'];
                row.kd_item     = item_select['kd_item'];
            }
            item_select = [];
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
    
    function tambah_detail()
    {
        let no_billing = $('#txt-no_billing').val();
        let nama       = $('#txt-nama_pasien').val();
        if(!no_billing || !nama)
        {
            notif('warning','No. Billing Belum Di Pilih')
            return false;
        }

        if (edit_detail==1)
        {
            notif('warning','Mohon pilih Save atau Cancel lebih dahulu');
            return false;
        }
        
        item_select      = [];
        edit_detail      = 1;
        var index_insert = 0;
        rowGridSelected  = index_insert;

        $('#dtg-detail_item').datagrid('insertRow', {
          // index: index,
          index: 0,
          row:{
            status:'P',jml_paket:0,jml_npaket:0,jml:0,id_item_rc:'-'
          }
        });

        $('#dtg-detail_item').datagrid('selectRow',index_insert);
        $('#dtg-detail_item').datagrid('beginEdit',index_insert);
    }

    function saverow(target)
    {
        var id_item_rc_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'id_item_rc'
        });
        var id_item_rc = $(id_item_rc_ed.target).combobox('getValue');
        
        var nama_item_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'nama_item'
        });
        var nama_item = $(nama_item_ed.target).textbox('getValue');

        var jml_paket_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'jml_paket'
        });
        var jml_paket = $(jml_paket_ed.target).numberbox('getValue');

        var jml_npaket_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'jml_npaket'
        });
        var jml_npaket = $(jml_npaket_ed.target).numberbox('getValue');

        var jml_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'jml'
        });
        var jml = $(jml_ed.target).numberbox('getValue');

        var signaa_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'signa1'
        });
        var signaa = $(signaa_ed.target).combobox('getValue');

        var signab_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'signa2'
        });
        var signab = $(signab_ed.target).combobox('getValue');

        if ($('#txt-jns_bayar').val()!="BPJS")
        {
            if (!jml)
            {
                notif('warning','Ada Detail item yang Kosong');
                return false;
            }
        }
        else
        {
            if (!jml_paket||!jml_npaket)
            {
                notif('warning','Ada Detail item yang Kosong');
                return false;
            }
        }

        if (!nama_item||!id_item_rc||!signaa||!signab)
        {
            notif('warning','Ada Detail item yang Kosong');
            return false;
        }
        else
        {
            edit_detail        = 0;
            data_detail        = [];
            $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
            set_total();
            ket_detail['ket'] = 1;
            ket_detail['data'] = [];
            $('#div_ambil_sebagian').show();
        }
    }
    function editrow(target)
    {
        if (edit_detail==1)
        {
            notif('warning','Mohon pilih Save atau Cancel lebih dahulu');
            return false;
        }
        
        edit_detail     = 1;
        var index       = getRowIndex(target);
        rowGridSelected = index;

        $('#dtg-detail_item').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterow(target)
    {
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
                data_detail       = [];
                set_total();
                ket_detail['ket'] = 1;
                ket_detail['data'] = [];
                $('#div_ambil_sebagian').show();
              }
        });
    }
    function cancelrow(target)
    {
        edit_detail = 0;
        item_select = [];
        $('#win-cari_item').window('close');
        $('#dtg-detail_item').datagrid('cancelEdit', getRowIndex(target));
    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function set_total()
    {
        // body...
        var data     = $("#dtg-detail_item").datagrid('getRows');

        // console.log(data);
        
        let paket_grid      = 0;
        let npaket_grid     = 0;
        let jumlah_grid     = 0;
        let harga_grid      = 0;
        let subtotal_grid   = 0;
        let subtotal_paket  = 0;
        let subtotal_npaket = 0;
        
        let jrs_paket       = 0;
        let jrs_npaket      = 0;
        let alkes           = 0;
        let racikan         = [];

        if(data.length > 0){
            for(i=0 ; i < data.length ; i++)
            {
                if (Number.isInteger(data[i]['id_item'])==false) {
                    continue;
                }

                if ($('#txt-jns_bayar').val()!="BPJS")
                {
                    data[i]['jml']       = data[i]['jml'];
                    data[i]['jml_paket'] = data[i]['jml'];    
                }

                data[i]['jml']              = parseInt(data[i]['jml_paket'])+parseInt(data[i]['jml_npaket']);
                data[i]['sub_total']        = (parseInt(data[i]['jml_paket'])+parseInt(data[i]['jml_npaket']))*data[i]['harga'];
                data[i]['sub_total_paket']  = data[i]['jml_paket']*data[i]['harga'];
                data[i]['sub_total_npaket'] = data[i]['jml_npaket']*data[i]['harga'];

                if (data[i]['id_item_rc']=='')
                {
                    data[i]['id_item_rc']='-';   
                }

                paket_grid      +=parseInt(data[i].jml_paket);
                npaket_grid     += parseInt(data[i].jml_npaket);
                subtotal_grid   +=parseInt(data[i].sub_total);
                
                subtotal_paket  += parseInt(data[i].harga)*parseInt(data[i].jml_paket);
                subtotal_npaket += parseInt(data[i].harga)*parseInt(data[i].jml_npaket);

                if (data[i].id_kel_item!=''||data[i].id_kel_item!==undefined)
                {
                    if (data[i].id_kel_item==konfigurasi.id_kel_item_obat)
                    {
                        if (data[i].jml_paket>0&&data[i].jml_paket!='')
                        {
                            jrs_paket += 1*konfigurasi.tarif_jrs_obat;
                        }
                        else if (data[i].jml_npaket>0&&data[i].jml_npaket!='')
                        {
                            jrs_npaket += 1*konfigurasi.tarif_jrs_obat;   
                        }
                    }
                    else if (data[i].id_kel_item==konfigurasi.id_kel_item_alkes)
                    {
                        alkes = konfigurasi.tarif_jrs_alkes;
                    }
                }

                if (data[i].id_item_rc!=''&&data[i].id_item_rc!='N'&&data[i].id_item_rc!='-')
                {
                    racikan.push(data[i].id_item_rc);
                }
            }
        
            $('#dtg-detail_item').datagrid('loadData', data);
        }

        var unique         = racikan.filter(onlyUnique);
        // console.log(unique.length);
        let jrs_racikan    = unique.length*konfigurasi.tarif_jrs_racikan;
        let persen       = $("#nmb-persen").numberbox('getValue');
        
        let subtotal     = subtotal_grid;
        let ppn          = (persen/100)*subtotal;
        let ppn_paket    = (persen/100)*subtotal_paket;
        let ppn_npaket   = (persen/100)*subtotal_npaket;
        let total_jrs    = parseInt(jrs_npaket)+parseInt(jrs_paket)+parseInt(alkes)+parseInt(jrs_racikan);
        let total_paket  = parseInt(subtotal_paket)+parseInt(jrs_paket)+parseInt(ppn_paket);
        let total_npaket = parseInt(subtotal_npaket)+parseInt(jrs_npaket)+parseInt(ppn_npaket);
        let total        = parseInt(total_paket)+parseInt(total_npaket);

        if (total_jrs>konfigurasi.max_jrs)
        {
            total_jrs = konfigurasi.max_jrs;
        }

        $('#nmb-subtotal').numberbox('setValue',subtotal);
        $('#nmb-subtotal_paket').numberbox('setValue',subtotal_paket);
        $('#nmb-subtotal_npaket').numberbox('setValue',subtotal_npaket);

        $('#nmb-ppn').numberbox('setValue',ppn);
        $('#nmb-ppn_paket').numberbox('setValue',ppn_paket);
        $('#nmb-ppn_npaket').numberbox('setValue',ppn_npaket);

        $('#nmb-jrs').numberbox('setValue',total_jrs);
        $('#nmb-jrs_paket').numberbox('setValue',jrs_paket);
        $('#nmb-jrs_npaket').numberbox('setValue',jrs_npaket);

        $('#nmb-total').numberbox('setValue',total);
        $('#nmb-total_paket').numberbox('setValue',total_paket);
        $('#nmb-total_npaket').numberbox('setValue',total_npaket);
    }

    function get_data(no)
    {
        $.ajax({
            url     : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/getPerNota"); ?>",
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
        let master = data.master;
        let detail = data.detail;
        // body...
        $('#txt-label_no').text("No. Nota : "+master.no_nota);
        $('#txt-label_status').text("Status : "+master.c_status_proses);
        $('#txt-label_posted').text(" "+master.c_status_posting);

        $('#txt-no_nota').val(master.no_nota);
        $('#dtb-tgl_nota').val(toAppDateTimeFormat(master.tgl_nota));
        $('#txt-no_billing').val(master.id_mrs);
        $('#txt-no_resep').val(master.no_resep);
        
        $('#txt-no_rm').val(master.no_mr);
        $('#txt-umur').val(master.umur);
        $('#txt-kelamin').val(master.jns_kel);
        $('#txt-nama_pasien').val(master.nama_pasien);
        $('#txt-status_pasien').val(master.jns_bayar);
        $('#txt-jenis_pasien').val(master.status_karyawan);

        $('#cmb-klinik_ruang').val(master.id_kamar_rawat).change();
        $('#cmb-dokter').val(master.id_dokter).change();

        cmb_dokter.id_dokter    = master.id_dokter;
        cmb_dokter.nama_dokter  = master.nama_dokter;
        
        cmb_kamar.kamar_display = master.kamar_display;
        cmb_kamar.id_unit       = master.id_unit_rawat;
        cmb_kamar.nama_unit     = master.nama_unit;
        cmb_kamar.id_kamar      = master.id_kamar_rawat;
        cmb_kamar.nama_kamar    = master.kamar_display;
        
        $('#txt-kelas').val(master.kelas);
        $('#txt-jatah_kelas').val(master.kelas_hak);

        $('#label-status_kelas').text(" "+master.kelas_status);      

        $('#txt-keterangan').val(master.ket_nota);

        $('#nmb-subtotal').numberbox('setValue',master.sub_total);
        $('#nmb-subtotal_paket').numberbox('setValue',master.sub_total_paket);
        $('#nmb-subtotal_npaket').numberbox('setValue',master.sub_total_npaket);

        $('#nmb-persen').numberbox('setValue',master.p_ppn);
        $('#nmb-ppn').numberbox('setValue',master.tot_ppn);
        $('#nmb-ppn_paket').numberbox('setValue',master.tot_ppn_paket);
        $('#nmb-ppn_npaket').numberbox('setValue',master.tot_ppn_npaket);

        $('#nmb-jrs').numberbox('setValue',master.jrs);
        $('#nmb-jrs_paket').numberbox('setValue',master.jrs_paket);
        $('#nmb-jrs_npaket').numberbox('setValue',master.jrs_npaket);

        $('#nmb-total').numberbox('setValue',master.total);
        $('#nmb-total_paket').numberbox('setValue',master.total_paket);
        $('#nmb-total_npaket').numberbox('setValue',master.total_npaket);

        //hidden
        $('#txt-id_mrs').val(master.id_mrs);
        $('#txt-id_mr').val(master.id_mr);
        $('#txt-no_mr').val(master.no_mr);
        $('#dtb-tgl_lahir').val(toAppDateFormat(master.tgl_lahir));
        $('#dtb-tgl_mrs').val('');
        $('#txt-ri_rj').val(master.jns_rawat);
        $('#txt-nama_unit').val(master.nama_unit);
        $('#txt-nama_kamar').val(master.kamar_display);
        $('#txt-id_unit_depo').val(master.id_unit_depo);
        $('#txt-id_reg_unit').val(master.id_reg_unit);
        $('#txt-asuransi').val(master.asuransi);
        $('#txt-instansi').val(master.instansi);
        $('#txt-admission').val(master.admission);
        $('#txt-jns_bayar').val(master.jns_bayar);
        $('#txt-status_pulang').val(master.status_pulang);

        $('#txt-alamat').val(master.alamat);

        $('#txt-id_eresep').val(master.id_eresep);

        $('#dtg-detail_item').datagrid('loadData', detail);

        data_detail = detail;
        ket_detail['ket'] = 1;
        ket_detail['data'] = [];
        $('#div_ambil_sebagian').show();
        
        if (master.jns_bayar!='BPJS')
        {
            $('#dtg-detail_item').datagrid('hideColumn', 'jml_paket');
            $('#dtg-detail_item').datagrid('hideColumn', 'jml_npaket');
            $('#div_ambil_sebagian').show();
        }
        else
        {
            $('#dtg-detail_item').datagrid('showColumn', 'jml_paket');
            $('#dtg-detail_item').datagrid('showColumn', 'jml_npaket');
            $('#div_ambil_sebagian').hide();
        }

        set_total();
    }

    function reset_form()
    {
        cmb_dokter = {};
        cmb_kamar  = {};

        $('.div_simpan').show();
        $('.div_hidden').hide();
        $('#div_status').show();

        $('#txt-label_no').text("No. Nota : ");
        $('#txt-label_status').text("Status : ");
        $('#txt-label_posted').text(" ");

        $('#txt-no_nota').val('');
        $('#dtb-tgl_nota').val(toAppDateTimeFormat(new Date()));
        $('#txt-no_billing').val('');
        $('#txt-no_resep').val('');
        
        $('#txt-no_rm').val('');
        $('#txt-umur').val('');
        $('#txt-kelamin').val('');
        $('#txt-nama_pasien').val('');
        $('#txt-status_pasien').val('');
        $('#txt-jenis_pasien').val('');

        $('#cmb-klinik_ruang').val('').change();
        $('#cmb-dokter').val('').change();
        
        $('#txt-kelas').val('');
        $('#txt-jatah_kelas').val('');

        $('#label-status_kelas').text(" ");      

        $('#txt-keterangan').val('');

        $('#nmb-subtotal').numberbox('setValue',0);
        $('#nmb-subtotal_paket').numberbox('setValue',0);
        $('#nmb-subtotal_npaket').numberbox('setValue',0);

        $('#nmb-persen').numberbox('setValue',0);
        $('#nmb-persen').numberbox('setValue',konfigurasi.p_ppn);
        $('#nmb-ppn').numberbox('setValue',0);
        $('#nmb-ppn_paket').numberbox('setValue',0);
        $('#nmb-ppn_npaket').numberbox('setValue',0);

        $('#nmb-jrs').numberbox('setValue',0);
        $('#nmb-jrs_paket').numberbox('setValue',0);
        $('#nmb-jrs_npaket').numberbox('setValue',0);

        $('#nmb-total').numberbox('setValue',0);
        $('#nmb-total_paket').numberbox('setValue',0);
        $('#nmb-total_npaket').numberbox('setValue',0);

        //hidden
        $('#txt-id_mrs').val('');
        $('#txt-id_mr').val('');
        $('#txt-no_mr').val('');
        $('#dtb-tgl_lahir').val('');
        $('#dtb-tgl_mrs').val('');
        $('#txt-ri_rj').val('');
        $('#txt-nama_unit').val('');
        $('#txt-nama_kamar').val('');
        $('#txt-id_unit_depo').val('');
        $('#txt-id_reg_unit').val('');
        $('#txt-asuransi').val('');
        $('#txt-instansi').val('');
        $('#txt-admission').val('');
        $('#txt-jns_bayar').val('');
        $('#txt-status_pulang').val('');

        $('#txt-id_eresep').val(0);
        
        reset_button();
        
        $('#dtg-detail_item').datagrid('loadData', []);

        edit_detail = 0;
        ket_detail['ket'] = 1;
        ket_detail['data'] = [];
        data_detail = [];
        item_select = [];
        
        $('#dtg-detail_item').datagrid('showColumn', 'jml_paket');
        $('#dtg-detail_item').datagrid('showColumn', 'jml_npaket');
        $('#div_ambil_sebagian').show();

        set_total();
    }

    function reset_button()
    {
        // body...
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-cetak').show();
    }

    function set_read(kondisi)
    {
        $('#txt-no_nota').prop('disabled', true);
        $('#dtb-tgl_nota').prop('disabled', kondisi);
        $('#txt-no_billing').prop('disabled', kondisi);
        $('#txt-no_resep').prop('disabled', konfigurasi.no_resep_auto);

        $('#txt-no_rm').prop('disabled', true);
        $('#txt-umur').prop('disabled', true);
        $('#txt-kelamin').prop('disabled', true);
        $('#txt-nama_pasien').prop('disabled', true);
        $('#txt-status_pasien').prop('disabled', true);
        $('#txt-jenis_pasien').prop('disabled', true);
        
        $('#cmb-klinik_ruang').prop('disabled', kondisi);
        $('#cmb-dokter').prop('disabled', kondisi);
        $('#txt-kelas').prop('disabled', true);
        $('#txt-jatah_kelas').prop('disabled', true);

        $('#txt-keterangan').prop('disabled', kondisi);
        
        $('#nmb-subtotal').numberbox('readonly', true);
        $('#nmb-subtotal_paket').numberbox('readonly', true);
        $('#nmb-subtotal_npaket').numberbox('readonly', true);

        $('#nmb-persen').numberbox('readonly', true);
        $('#nmb-ppn').numberbox('readonly', true);
        $('#nmb-ppn_paket').numberbox('readonly', true);
        $('#nmb-ppn_npaket').numberbox('readonly', true);

        $('#nmb-jrs').numberbox('readonly', true);
        $('#nmb-jrs_paket').numberbox('readonly', true);
        $('#nmb-jrs_npaket').numberbox('readonly', true);

        $('#nmb-total').numberbox('readonly', true);
        $('#nmb-total_paket').numberbox('readonly', true);
        $('#nmb-total_npaket').numberbox('readonly', true);

        $('#dtg-detail_item').datagrid('hideColumn', 'nama_obat');

        if (edit==0&&kondisi==false) //tambah
        {
            $('#btn-e_resep').show();

            $('#div_status').hide();
            $('#btn-aksi').hide();
            $('#btn-hapus').hide();
            $('#btn-cetak').hide();

            $('.div_simpan').show();

            $('#dtg-detail_item').datagrid('showColumn', 'action');
            $('#dtg-detail_item').datagrid('showColumn', 'nama_obat');
        }

        if (edit==1&&kondisi==false) //ubah 
        {
            $('#btn-e_resep').hide();

            $('#div_status').show();
            $('#btn-aksi').show();
            $('#btn-hapus').show();
            $('#btn-cetak').show();

            $('.div_simpan').show();

            $('#dtg-detail_item').datagrid('showColumn', 'action');          
        }

        if (edit==0&&kondisi==true) //ubah readonly
        {
            $('#btn-e_resep').hide();

            $('#div_status').show();
            $('#btn-aksi').show();
            $('#btn-hapus').hide();
            $('#btn-cetak').show();

            $('.div_simpan').hide();

            $('#dtg-detail_item').datagrid('hideColumn', 'action');
        }
    }

    function set_billing(data)
    {
        // body...
        $("#dtg-detail_item").datagrid('loadData',[]);
        $('#txt-no_billing').val(data.id_mrs);
        if (edit==0)
        {
            $('#txt-no_resep').val('');
        }
        
        $('#txt-no_rm').val(data.no_mr);
        $('#txt-umur').val(data.umur);
        $('#txt-kelamin').val(data.sex);
        $('#txt-nama_pasien').val(data.nama_lengkap);
        $('#txt-status_pasien').val(data.jns_bayar);
        $('#txt-jenis_pasien').val(data.status_karyawan);

        $('#cmb-klinik_ruang').val(data.id_kamar).change();
        $('#cmb-dokter').val(data.id_dokter).change();
        
        cmb_dokter.id_dokter    = data.id_dokter;
        cmb_dokter.nama_dokter  = data.nama_dokter;
        
        cmb_kamar.kamar_display = data.kamar_display;
        cmb_kamar.id_unit       = data.id_unit;
        cmb_kamar.nama_unit     = data.nama_unit;
        cmb_kamar.id_kamar      = data.id_kamar;
        cmb_kamar.nama_kamar    = data.nama_kamar;
        
        $('#txt-kelas').val(data.kelas);
        $('#txt-jatah_kelas').val(data.kelas_hak);

        $('#label-status_kelas').text(data.kelas_status);

        //hidden
        $('#txt-id_mrs').val(data.id_mrs);
        $('#txt-id_mr').val(data.id_mr);
        $('#txt-no_mr').val(data.no_mr);
        $('#dtb-tgl_lahir').val(toAppDateFormat(data.tgl_lahir));
        $('#dtb-tgl_mrs').val(toAppDateFormat(data.tgl_mrs));
        $('#txt-ri_rj').val(data.ri_rj);
        $('#txt-nama_unit').val(data.nama_unit);
        $('#txt-nama_kamar').val(data.nama_kamar);
        $('#txt-id_reg_unit').val(data.id_reg_unit);
        $('#txt-asuransi').val(data.asuransi);
        $('#txt-instansi').val(data.instansi);
        $('#txt-admission').val(data.admission);
        $('#txt-jns_bayar').val(data.jns_bayar);
        $('#txt-status_pulang').val(data.status_pulang);

        if (data.jns_bayar=="BPJS")
        {
            $('#dtg-detail_item').datagrid('showColumn', 'jml_paket');
            $('#dtg-detail_item').datagrid('showColumn', 'jml_npaket');
            $('#div_ambil_sebagian').hide();
        }
        else
        {
            $('#dtg-detail_item').datagrid('hideColumn', 'jml_paket');
            $('#dtg-detail_item').datagrid('hideColumn', 'jml_npaket');
            $('#div_ambil_sebagian').show();
        }

        cek_resep('master',data.id_mrs);
    }

    function tutup()
    {
    	$('#win-cari_no_billing').window('close');
    	// $('#win-unit').window('close');
    	$('#win-e_resep').window('close');
    	$('#win-paket_obat_alkes').window('close');
    }

    function get_konfigurasi()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/get_konfigurasi"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               konfigurasi = data.data;
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_select(argument)
    {
        let url_con;
        let id_cmb;
        let param;
        if (argument=='ruang')
        {
            url_con =  "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/get_kamar"); ?>";
            id_cmb  = "#cmb-klinik_ruang";
            param   = 1;
        }
        else if(argument=='dokter')
        {
            url_con =  "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/get_dokter"); ?>";
            id_cmb  = "#cmb-dokter";
        }
        // body...
        $.ajax({
            url : url_con,
            type: "POST",
            dataType: 'json',
            data    :{
                data:param,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $(id_cmb).select2({ data: data });
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
        $('#dtg-nota_rawat_jalan').datagrid('loadData', []);

        let startDate = toAPIDateFormat($('#dtb-start_date').val());
        let endDate   = toAPIDateFormat($('#dtb-end_date').val());
        let status    = $('#cmb-status').val();
        let criteria  = $('#txt-kriteria').val();
        
        data = {
            status    : status,
            start_date: startDate,
            end_date  : endDate, 
            criteria  : criteria,
            page      : 1,
            page_row  : 10,
        }

        var dg = $('#dtg-nota_rawat_jalan').datagrid({
          url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.rows ? data.rows : []
            }
          }
        });
    }

    function cari_billing(argument)
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/filter_no_billing/1"); ?>",
            type: "POST",
            dataType: 'json',
            data    :{
                data:argument,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#dtg-detail_item").datagrid('loadData',[]);
                if (data.row_count<1)
                {
                    notif('info','No. Billing tidak ditemukan');
                    return false;
                }
                else if (data.data.status_pulang==1)
                {
                    notif('notif','No. Billing tidak bisa digunakan, Data MRS tidak Aktif.');
                    return false;
                }
                else
                {
                    // notif('info','Masuk');
                    set_billing(data.data[0]);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter_billing()
    {
        $('#dtg-billing').datagrid('loadData', []);

        let criteria  = $('#txt-kriteria_billing').val();
        
        data = {
            criteria  : criteria,
            page      : 1,
            page_row  : 10,
        }

        var dg = $('#dtg-billing').datagrid({
          url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/filter_no_billing/0"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.rows ? data.rows : []
            }
          }
        });
    }

    function cek_resep(kondisi,no)
    {
        let url_con;
        if (kondisi=='master')
        {
            $('#dtg-e_resep_detail').datagrid('loadData', []);
            url_con = "get_eresep";
        }
        else if (kondisi=='detail')
        {
            $('#dtg-e_resep_detail').datagrid('loadData', []);
            url_con = "get_eresep_detail";
        }
        else
        {
            return false;
        }

        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/"); ?>"+url_con,
            type: "POST",
            dataType: 'json',
            data    :{
                data:no,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $('#dtg-e_resep').datagrid('reload');
                if (kondisi=='master'&&data.row_count<1)
                {
                    notif('info','E-Resep Tidak Ada');
                    return false;
                }
                else if (kondisi=='master'&&data.row_count>0)
                {
                    $('#win-e_resep').window('open');
                    $('#dtg-e_resep').datagrid('loadData', []);
                    $('#dtg-e_resep').datagrid('loadData', data.data);
                    $('#dtg-e_resep').datagrid('resize');
                }
                else if (kondisi=='detail')
                {
                    $('#dtg-e_resep_detail').datagrid('loadData', []);
                    $('#dtg-e_resep_detail').datagrid('loadData', data.data);
                    $('#dtg-e_resep_detail').datagrid('resize');
                }    
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter_paket(argument,row)
    {
        let param    = [];
        let criteria = $('#txt-kriteria_paket').val();

        let id_paket_item;
        let id_unit;
        // let jns_rawat;
        let jns_rawat;
        let status_karyawan;

        if (row.length>0)
        {
            id_paket_item   = row.id_paket_item;
            id_unit         = unit.id;
            jns_rawat       = $('#txt-ri_rj').val();
            status_karyawan = $('#txt-jenis_pasien').val();

            if (status_karyawan==''||jns_rawat=='')
            {
                notif('warning','No. Billing Belum dipilih');
                return false;
            }
        }

        if (argument=='master')
        {
            $('#dtg-paket_master').datagrid('loadData', []);
            $('#dtg-paket_detail').datagrid('loadData', []);
            param = {criteria:criteria};
        }
        else if (argument=='detail')
        {
            param = 
            {
                id_paket_item  : row.id_paket_item,
                id_unit        : id_unit,
                jns_rawat      : jns_rawat,
                status_karyawan: status_karyawan,
                jns_nota       : 1,
            }
        }
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/filter_paket_item"); ?>",
            type: "POST",
            dataType: 'json',
            data    : param,
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                if (argument=='master')
                {
                    $('#dtg-paket_master').datagrid('loadData', []);
                    $('#dtg-paket_detail').datagrid('loadData', []);
                    $('#dtg-paket_master').datagrid('loadData', data.data);
                }
                else if (argument=='detail')
                {
                    $('#dtg-paket_detail').datagrid('loadData', []);
                    $('#dtg-paket_detail').datagrid('loadData', data.data);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function simpan()
    {
        let posting = $('#txt-label_posted').text();
        posting = posting.toUpperCase();
        
        if (posting==" POSTED")
        {
            notif('warning',' Data tidak dapat diupdate, data sudah terposting.');
            return false;
        }

        var no_nota          = $('#txt-no_nota').val();
        
        var tgl_nota         = toAPIDateFormat($('#dtb-tgl_nota').val());
        var no_resep         = $('#txt-no_resep').val();   
        var id_mrs           = $('#txt-no_billing').val();
        var id_mr            = $('#txt-id_mr').val();
        var no_mr            = $('#txt-no_mr').val();
        var nama_pasien      = $('#txt-nama_pasien').val();
        var alamat           = $('#txt-alamat').val();
        var tgl_lahir        = toAPIDateFormat($('#dtb-tgl_lahir').val());//
        var instansi         = $('#txt-instansi').val();
        var asuransi         = $('#txt-asuransi').val();
        var admission        = $('#txt-admission').val();
        var jns_bayar        = $('#txt-jns_bayar').val();    
        var id_dokter        = $('#cmb-dokter option:selected').val();
        var nama_dokter      = $('#cmb-dokter option:selected').text();
        var id_kamar_rawat   = $('#cmb-klinik_ruang option:selected').val();
        var id_dokter        = cmb_dokter.id_karyawan;
        var nama_dokter      = cmb_dokter.nama_dokter;
        var id_unit_rawat    = cmb_kamar.id_unit;
        // var id_kamar_rawat   = cmb_kamar.id_kamar;
        var kelas            = $('#txt-kelas').val();
        var kelas_hak        = $('#txt-jatah_kelas').val();
        var kelas_status     = $('#label-status_kelas').text();
        var status_karyawan  = $('#txt-jenis_pasien').val();
        
        var sub_total        = $('#nmb-subtotal').numberbox('getValue');
        var sub_total_paket  = $('#nmb-subtotal_paket').numberbox('getValue');
        var sub_total_npaket = $('#nmb-subtotal_npaket').numberbox('getValue');
        var p_ppn            = $('#nmb-persen').numberbox('getValue');
        var tot_ppn          = $('#nmb-ppn').numberbox('getValue');
        var tot_ppn_paket    = $('#nmb-ppn_paket').numberbox('getValue');
        var tot_ppn_npaket   = $('#nmb-ppn_npaket').numberbox('getValue');
        var jrs              = $('#nmb-jrs').numberbox('getValue');
        var jrs_paket        = $('#nmb-jrs_paket').numberbox('getValue');
        var jrs_npaket       = $('#nmb-jrs_npaket').numberbox('getValue');

        var total            = $('#nmb-total').numberbox('getValue');
        var total_paket      = $('#nmb-total_paket').numberbox('getValue');
        var total_npaket     = $('#nmb-total_npaket').numberbox('getValue');
        
        var id_unit_depo     = unit.id;
        var id_eresep        = $('#txt-id_eresep').val();
        var id_reg_unit      = $('#txt-id_reg_unit').val();
        var jns_rawat        = $('#txt-ri_rj').val();
        // var is_racikan       = $('#txt-keterangan').val();
        var ket_nota         = $('#txt-keterangan').val();

        if (!id_mrs || !id_kamar_rawat || !id_dokter)
        {
          let msg = '<br>';
          if (!id_mrs) {
            msg += 'No. Billing <br>';
          }

          if (!id_kamar_rawat) {
            msg += 'Klinik / Ruang <br>';
          }

          if (!id_dokter) {
            msg += 'Dokter <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        row = $('#dtg-detail_item').datagrid('getRows');
        if(row.length <= 0)
        {
            notif('warning','Detail Harus di isi!');
            return false;
        }

         master={
                // no_nota         : no_nota,
                tgl_nota        : tgl_nota,
                no_resep        : no_resep,
                id_mrs          : id_mrs, 
                id_mr           : id_mr, 
                no_mr           : no_mr, 
                nama_pasien     : nama_pasien,
                alamat         : alamat, 
                tgl_lahir       : tgl_lahir, 
                instansi        : instansi, 
                asuransi        : asuransi, 
                admission       : admission,
                jns_bayar       : jns_bayar, 
                id_dokter       : id_dokter,
                nama_dokter     : nama_dokter,
                id_kamar_rawat  : id_kamar_rawat,
                id_unit_rawat   : id_unit_rawat,
                kelas           : kelas,
                kelas_hak       : kelas_hak,
                kelas_status    : kelas_status,
                status_karyawan : status_karyawan,
                sub_total       : sub_total,
                sub_total_paket : sub_total_paket,
                sub_total_npaket: sub_total_npaket,
                p_ppn           : p_ppn,
                tot_ppn         : tot_ppn,
                tot_ppn_paket   : tot_ppn_paket,
                tot_ppn_npaket  : tot_ppn_npaket,
                total           : total,
                total_paket     : total_paket,
                total_npaket    : total_npaket,
                jrs             : jrs,
                jrs_paket       : jrs_paket,
                jrs_npaket      : jrs_npaket,
                id_unit_depo    : id_unit_depo,
                id_eresep       : id_eresep,
                id_reg_unit     : id_reg_unit,
                jns_rawat       : jns_rawat,
                // is_racikan      : is_racikan,
                ket_nota        : ket_nota
            };

        var config;
        if(no_nota != "")
        {  
            master['no_nota'] = no_nota;
        }
        else
        {
            config = {
                no_resep_auto : true
            }
        }

        var details = [];
        var racikan = 'N';
        master['is_racikan'] = false;
        for (var i=0; i<row.length; i++) {
            if (row[i]['id_item_rc']=="-"||!row[i]['id_item_rc'])
            {
                racikan='N';
                row[i]['id_item_rc']=="-"
            }
            else
            {
                racikan = 'D';
                master['is_racikan'] = true;
            }

            if (!row[i]['id_item'])
            {
                notif('warning','Detail Obat/Alkes Kosong');
                return false;
            }

            if (!row[i]['signa1'])
            {
                notif('warning','Detail Signa 1');
                return false;   
            }

            if (!row[i]['signa2'])
            {
                notif('warning','Detail Signa 2');
                return false;   
            }

            if (!row[i]['jml'] || row[i]['jml']<0)
            {
                notif('warning','Detail Jumlah Kosong');
                return false;
            }

            let jml_paket = 0;

            if (jns_bayar!="BPJS")
            {
                jml_paket = parseInt(row[i]['jml']);
            }
            else
            {
                jml_paket = parseInt(row[i]['jml_paket']);
            }

            details.push({
                id_item   : row[i]['id_item'], 
                id_satuan : row[i]['id_satuan'], 
                harga     : row[i]['harga'], 
                // jml_paket : parseInt(row[i]['jml_paket']),
                jml_paket : jml_paket,
                jml_npaket: parseInt(row[i]['jml_npaket']), 
                jml       : parseInt(row[i]['jml']), 
                signa1    : row[i]['signa1'], 
                signa2    : row[i]['signa2'], 
                jns_obat  : racikan,
                id_item_rc: row[i]['id_item_rc'],
                is_for_rs : row[i]['is_for_rs'],
                is_for_nas: row[i]['is_for_nas'] 
            });
        }

        console.log(master);
        console.table(details);

        // return false;

        $.ajax({
          url : "<?php echo base_url('farmasi/depo/Nota_farmasi_rawat_jalan/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            config : config,
            master:master,
            detail : details
            },
          beforeSend: function (){               
            },
          success:function(data, textStatus, jqXHR){
              if(data.error){
                notif('error',data.message);
              }else{
                if (data.status_code!=200)
                {
                    notif('warning',data.message);
                }
                else
                {
                    notif('success',data.message);
                }
              }
              tab(0);
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function hapus()
    {
        
        let no_nota = $('#txt-no_nota').val();

        swal.fire(cohapus()).then(function(result) {
          if (result.value) {
            $.ajax({
                url     : "<?php echo base_url("/farmasi/depo/Nota_farmasi_rawat_jalan/hapus"); ?>",
                type    : "POST",
                dataType: 'json',
                data    :{
                    data: no_nota,
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

    function buka_unit(argument)
    {
        // body...
        if (argument==1)
        {
            $('#win-unit').window('open');
            filter_unit();
        }
        else
        {
            $('#win-unit').window('close');
        }
    }

    function filter_unit()
    {
        // body...
        $('#dtg-unit').datagrid('loadData', []);

        $.ajax({
            url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/get_unit_default"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                if (data.row_count<1)
                {
                    notif('info','Data Unit Tidak Ada');
                    return false;
                }
                else
                {
                    $('#dtg-unit').datagrid('loadData', data.data);
                }    
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function pilih_unit()
    {
        let row = $('#dtg-unit').datagrid('getSelected');

        $.ajax({
            url     : "<?php echo base_url("/farmasi/depo/Nota_farmasi_rawat_jalan/ganti_unit"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                id  : row.id_unit,
                nama: row.nama_unit,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $('#label-unit').text(row.nama_unit);
                unit.id   =row.id_unit;
                unit.nama =row.nama_unit;
                buka_unit(0);
                notif('success','Unit Berhasil Diubah'); 
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_data_item(param)
    {
        let status_karyawan = $('#txt-jenis_pasien').val();
        let jns_rawat       = $('#txt-ri_rj').val(); 

        $('.tr-list').remove();
        ajaxReq = $.ajax({
          url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/cari_item"); ?>",
          type: "GET",
          dataType: 'json',
          data:{
            type: 'public',
            jns_nota : '1',
            jns_rawat : jns_rawat,
            status_karyawan : status_karyawan,
            id_unit : unit.id,
            criteria : param
            },
          beforeSend: function (){   
            if(ajaxReq != 'ToCancelPrevReq' && ajaxReq.readyState < 4) {
                    
                    ajaxReq.abort();
                }          
          },
          success:function(data, textStatus, jqXHR){
            set_data_list(data)
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              /*notif('error','Error,something goes wrong');*/
          },
          complete: function(){
          }
        });
    }

    function set_data_list(data) {
        nama_item   = data;
        item_select = [];
        var list = '';
        $.each( data, function( key, value ) {
          list += "<tr style='border: 0.6px solid black;'><td width='100%'><a href='javascript:void(0)' class='list'>"+value.nama_item+"</a></td></tr>";
        });
        res = start + list + end;
        $(tr).append(res);
    }

    $(document).on('click','.list',function () {
        item_select = filter_item(nama_item,$(this).text());
        // console.log(item_select);
        var nama_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            field: 'nama_item'
        });
        $(nama_ed.target).textbox('setValue', $(this).text());

        $('.tr-list').remove();
    });

    function filter_item(data,criteria)
    {
        // body...
        var filtered;
        for (var i = 0; i < data.length; i++)
        {
            if (data[i]['nama_item']==criteria)
            {
                filtered = data[i];
            }
        }

        return filtered;
    }

    function ambil_sebagian(argument)
    {
        // body...
        if (edit_detail==1)
        {
            notif('warning','Mohon pilih Save atau Cancel lebih dahulu');
            return false;
        }

        var data_sebagian = [];

        if (ket_detail['ket']==1)
        {
            data_detail = [];
            data_detail = $('#dtg-detail_item').datagrid('getRows');
            // console.log('masuk == 1');
            data_sebagian = data_detail;
        }
        else
        {
            // console.log('masuk != 1');
            data_sebagian = data_detail;
        }

        // console.log(ket_detail);
        // console.log(data_sebagian);
        // console.log('awal');

        if (data_sebagian.length<1)
        {
            notif('warning','Detail Item Kosong');
            return false;
        }
        else
        {
            swal.fire(corelease('Apakah Anda Yakin Mengambil Sebagian ?')).then(function(result) {
              if (result.value)
              {
                proses_bagi(data_sebagian,argument);  
              }
              else
              {
                return false;
              }
            });
        }
    }

    function proses_bagi(data,argument)
    {
        // body...
        var sebagian_jml  = 0;
        var sebagian_sisa = 0;

        console.log(data_detail);

        for(i=0 ; i < data.length ; i++)
        {
            if (argument==1)
            {
                sebagian_jml =  data[i]['jml'];
            }
            else if (argument==12)
            {
                sebagian_jml =  data[i]['jml']/2;
            }
            else if (argument==13)
            {
                sebagian_jml = data[i]['jml']/3;
            }
            else if (argument==14)
            {
                sebagian_jml = data[i]['jml']/4;
            }

            sebagian_sisa = data[i]['jml']-sebagian_jml;
            
            sebagian_jml  = Math.ceil(sebagian_jml);

            let sisa = 0;
            
            sisa = data[i]['jml_npaket']-sebagian_sisa;

            if (sisa<0)
            {
                data[i]['jml_npaket'] = 0;
                data[i]['jml_paket']  = Math.ceil(data[i]['jml_paket']-Math.abs(sisa));
            }
            else
            {
                data[i]['jml_npaket'] = Math.ceil(data[i]['jml_npaket']-sebagian_sisa);
            }
            
            data[i]['jml'] = Math.ceil(data[i]['jml_paket'])+Math.ceil(data[i]['jml_npaket']);

            $('#dtg-detail_item').datagrid('updateRow', {
              index: i,
              row: {jml: data[i]['jml'],jml_paket : data[i]['jml_paket'],jml_npaket : data[i]['jml_npaket']}
            });
        }

        $('#div_ambil_sebagian').hide();
        console.log(data_detail);
        
        set_total();
    }

    function cari_item_datagrid(kriteria)
    {
        // body...
        // $('#dtg-item').datagrid('loadData', []);

        let status_karyawan = $('#txt-jenis_pasien').val();
        let jns_rawat       = $('#txt-ri_rj').val();

        $.ajax({
            url : "<?php echo base_url("farmasi/depo/Nota_farmasi_rawat_jalan/cari_item_datagrid"); ?>",
            type: "GET",
            dataType: 'json',
            data:{
            type: 'public',
            jns_nota : '1',
            jns_rawat : jns_rawat,
            status_karyawan : status_karyawan,
            id_unit : unit.id,
            criteria : kriteria
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                
                $('#dtg-item').datagrid('loadData', data.data);
                   
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    $('#dtg-item').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            pilih_item();
        }
    });

    function pilih_item()
    {
        // body...
        item_select = [];
        var row = $('#dtg-item').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }

        item_select = row;
        // console.log(item_select);
        var nama_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            field: 'nama_item'
        });
        $(nama_ed.target).textbox('setValue', item_select.nama_item);
        $('#win-cari_item').window('close');
        $('#dtg-item').datagrid('loadData', []);
    }

    function tutup_item()
    {
        // body...
        $('#win-cari_item').window('close');
        $('#dtg-item').datagrid('loadData', []);
    }

    function onlyUnique(value, index, self) { 
        return self.indexOf(value) === index;
    }

</script>