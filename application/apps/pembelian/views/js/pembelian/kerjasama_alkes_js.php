<script type="text/javascript">
    var edit        = 0;
    var detail_item = [];
    var data_get    = [];
    var edit_detail = 0;
    var is_data    = 0;

    $(function(){
        tab(0);
        $('#dtg-produsen').datagrid({
            onDblClickRow:function(index,row){
                pilih_produsen();
            },
        });
    });

    $('.easyui-numberbox').numberbox({
        'precision' : 2,
        'min' : 0,
        'required':true,
        'groupSeparator' :'.',
        'decimalSeparator' :',',
        onChange: function(){
        }
    });

    $('#chk-is_aktif').click(function(event) {
        filter();
    });

    $('#btn-cari_produsen').click(function(event) {
        filter_produsen();
        $('#win-cari_produsen').window('open');
    });

    function pilih_produsen()
    {
        let row = $('#dtg-produsen').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#txt-id_produsen').val(row.id_produsen);
        $('#txt-nama_produsen').val(row.nama_produsen);
        $('#win-cari_produsen').window('close');
    }

    $('#btn-tambah_detail').click(function(event) {
        let id_produsen = $('#txt-id_produsen').val();
        if(id_produsen=='')
        {
            notif('warning','Harap Pilih Produsen');
            return false;
        }
        else
        {
            $('#txt-kriteria_barang').val('');
            filter_barang();
            $('#win-detail').window('open');
        }
    });

    function pilih_barang()
    {
        var data_grid = $('#dtg-detail_item').datagrid('getRows');;
        var row       = $('#dtg-barang').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        for (var i = 0 ; i < row.length; i++)
        {
                row[i]['id_item']       = row[i]['id_item'];
                row[i]['kd_item']       = row[i]['kd_item'];
                row[i]['nama_item']     = row[i]['nama_item'];
                row[i]['nama_satuan']   = row[i]['nama_satuan'];
                row[i]['id_satuan']     = row[i]['id_satuan'];
                row[i]['nama_kel_item'] = row[i]['nama_kel_item'];
                
                row[i]['harga']         = 0;
                row[i]['p_diskon_off']  = 0;
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

        $('#dtg-detail_item').datagrid('loadData', []);
        $('#dtg-detail_item').datagrid('loadData', data_grid);
        unSelectDatagrid('#dtg-barang');

        $('#win-detail').window('close');
    }

    $('#btn-tampil_cetak').click(function(event) {
        $('#win-cetak').window('open');
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
        tab(1);
    }

    function btn_ubah()
    {
        var row = $('#dtg-kerjasama_alkes').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }
        edit = 1;
        reset_form();
        set_read(false);
        get_data(row.no_kerjasama_item);
    }

    function get_data(no)
    {
        $.ajax({
            url     : "<?php echo base_url("pembelian/pembelian/Kerjasama_alkes/getKerjasama"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data:no,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
                tab(1);
                $('#loader').css('display','none');
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');       
                $('#loader').css('display','none');
            },
            complete: function(){
                $('#loader').css('display','none');
            }
        });
    }

    function set_form(data)
    {
        detail_item = [];
        data_get    = [];

        $('#dtg-detail_item').datagrid('loadData', data.details);
        
        detail_item = data.details;
        data_get    = data;
        
        $('#txt-label_no').text("No. IKS : "+data.master.no_iks);

        $('#txt-no_kerjasama_item').val(data.master.no_kerjasama_item);
        $('#dtb-tgl_pengajuan').val(toAppDateFormat(data.master.tgl_pengajuan));
        $('#txt-no_iks').val(data.master.no_iks);
        $('#txt-nama_produsen').val(data.master.nama_produsen);
        $('#txt-contact_person').val(data.master.contact_person);
        $('#txt-keterangan').val(data.master.keterangan);
        
        $('#nmb-total').numberbox('setValue',data.master.total);
        $('#dtb-tgl_awal').val(toAppDateFormat(data.master.tgl_awal));
        $('#dtb-tgl_akhir').val(toAppDateFormat(data.master.tgl_akhir));

        $('#txt-id_produsen').val(data.master.id_produsen);// hidden

        $('#txt-label_produsen').text(data.master.nama_produsen);

        set_total();

        set_excel();
    }

    function reset_form()
    {
        $('.div_simpan').show();
        $('.div_hidden').hide();

        $('#txt-label_no').text("No. IKS : ");
        
        $('#txt-no_kerjasama_item').val('');
        $('#dtb-tgl_pengajuan').val(appDateFormatter(new Date()));
        $('#txt-no_iks').val('');
        $('#txt-nama_produsen').val('');
        $('#txt-contact_person').val('');
        $('#txt-keterangan').val('');
        
        $('#nmb-total').numberbox('setValue',0);
        $('#dtb-tgl_awal').val(appDateFormatter(new Date()));
        $('#dtb-tgl_akhir').val(appDateFormatter(new Date()));

        $('#txt-id_produsen').val('');// hidden

        $('#txt-label_produsen').text('')
        
        reset_button();
        
        $('#dtg-detail_item').datagrid('loadData', []);

        set_total();
    }

    function reset_button()
    {
        // body...
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-tampil_cetak').show();
    }

    function set_read(kondisi)
    {
        $('#txt-no_kerjasama_item').prop('disabled', true);

        $('#dtb-tgl_pengajuan').prop('disabled', kondisi);
        $('#txt-no_iks').prop('disabled', kondisi);
        $('#txt-nama_produsen').prop('disabled', true);
        $('#txt-contact_person').prop('disabled', kondisi);
        $('#txt-keterangan').prop('disabled', kondisi);
        
        $('#nmb-total').prop('disabled', kondisi);
        $('#dtb-tgl_awal').prop('disabled', kondisi);
        $('#dtb-tgl_akhir').prop('disabled', kondisi);
        
        $('#btn-cari_produsen').prop('disabled', kondisi);
        
        if (edit==0&&kondisi==false) //tambah
        {
          $('#div_status').hide();
          $('#btn-hapus').hide();
          $('#btn-tampil_cetak').hide();

          $('.div_simpan').show();

          $('#dtg-detail_item').datagrid('showColumn', 'action');
        }

        if (edit==1&&kondisi==false) //ubah 
        {
            $('#btn-cari_produsen').prop('disabled', true);
            
            $('#div_status').show();
            $('#btn-hapus').show();
            $('#btn-tampil_cetak').show();

            $('.div_simpan').show();

            $('#dtg-detail_item').datagrid('showColumn', 'action');          
        }

        if (edit==0&&kondisi==true) //ubah readonly
        {
          $('#div_status').show();
          $('#btn-hapus').hide();
          $('#btn-tampil_cetak').show();

          $('.div_simpan').hide();

          $('#dtg-detail_item').datagrid('hideColumn', 'action');
        }
    }

    $('#dtg-kerjasama_alkes').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
            {field:'no_kerjasama_item',title:'No',width:"12%",halign:'center',align:'left', hidden:true},
            {field:'no_iks',title:'No. IKS',width:"12%",halign:'center',align:'left'},
            {field:'tgl_pengajuan',title:'Tgl. Pengajuan',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'nama_produsen',title:'Nama Produsen',width:"25%",halign:'center',align:'left'},
            {field:'tgl_awal',title:'Tgl. Awal',width:"13%",halign:'center',align:'center',formatter:appGridDateFormatter},
            {field:'tgl_akhir',title:'Tgl. Akhir',width:"13%",halign:'center',align:'center',formatter:appGridDateFormatter},
            {field:'total',title:'Total',width:"13%",halign:'center',align:'right', formatter: appGridNumberFormatter},
            {field:'keterangan',title:'Catatan',width:"25%",halign:'center',align:'left'},
            {field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
            {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
            {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
        title:'Detail Item',
        singleSelect:true,
        idField:'itemid',
        showFooter:true,
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'ID',width:100,halign :"center", hidden:true},
            {field:'id_satuan',title:'ID',width:100,halign :"center", hidden:true},
            {field:'kd_item',title:'Kode',width:"10%",halign :"center", align:"left"},
            {field:'nama_item',title:'Nama Item',width:"40%",halign :"center", align:"left"},
            {field:'nama_satuan',title:'Satuan',width:"10%",halign :"center", align:"left"},
            {field:'nama_kel_item',title:'Jenis',width:"10%",halign :"center", align:"left"},
            {field:'harga',title:'Harga',width:"12%",halign :"center",align:"right", formatter: formatIndo,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :',',
                        onChange: function(){
                            
                        }
                    }
                }
            },
            {field:'p_diskon_off',title:'Disc. (%)',width:"7%",halign :"center", align:"right", formatter: numberFormat,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        // 'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                        onChange: function(){
                            
                        }
                    }
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

    function saverow(target)
    {
        var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: getRowIndex(target),
            field: 'p_diskon_off'
        });

        var persen = $(p_diskon_ed.target).numberbox('getValue');

        if (persen >= 100) {
            notif('warning','Diskon Lebih dari sama dengan 100%!');
            return false;
        }else{
            $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
        }

        set_total();
    }

    function editrow(target)
    {
        $('#dtg-detail_item').datagrid('beginEdit', getRowIndex(target));
    }

    function deleterow(target)
    {
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
                set_total();
              }
        });
    }

    function cancelrow(target)
    {
        $('#dtg-detail_item').datagrid('cancelEdit', getRowIndex(target));
        set_total();
    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function set_total()
    {
        var data = $("#dtg-detail_item").datagrid('getRows');

        var totHarga = 0
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++)
            {
                totHarga += parseInt(data[i].harga);
            }
        }

        var dg =$('#dtg-detail_item').datagrid('reloadFooter',[{"harga":totHarga}]);
    }

    $('#dtg-detail_item').datagrid('reloadFooter',[
        {"harga":0}
    ]);

    function simpan()
    {   
        var no_kerjasama_item = $('#txt-no_kerjasama_item').val();
        var no_iks            = $('#txt-no_iks').val();
        var tgl_pengajuan     = toAPIDateFormat($('#dtb-tgl_pengajuan').val());
        var id_produsen       = $('#txt-id_produsen').val();
        var contact_person    = $('#txt-contact_person').val();
        var tgl_awal          = toAPIDateFormat($('#dtb-tgl_awal').val());
        var tgl_akhir         = toAPIDateFormat($('#dtb-tgl_akhir').val());
        var total             = $('#nmb-total').numberbox('getValue');
        var keterangan        = $('#txt-keterangan').val();
        var user_id           = "<?php echo $this->session->userdata['user_id'] ?>";
        
        if (no_iks == ''||id_produsen == ''|| id_produsen == '-'|| contact_person == ''|| keterangan == '')
        {
          let msg = '<br>';

          if (no_iks == '') {
            msg += 'No. IKS <br>';
          }
          if (id_produsen == '' || id_produsen == '-') {
            msg += 'Nama Produsen <br>';
          }
          if (contact_person == '') {
            msg += 'Contact Person <br>';
          }
          if (keterangan == '') {
            msg += 'Keterangan <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        master={
            tgl_pengajuan : tgl_pengajuan,
            no_iks        : no_iks,
            contact_person: contact_person,
            tgl_awal      : tgl_awal, 
            tgl_akhir     : tgl_akhir, 
            total         : total,
            keterangan    : keterangan,
            user_id       :  "<?php echo $this->session->userdata['user_id'] ?>"
        };
        
        if(no_kerjasama_item=='')
        {
            master['id_produsen'] = id_produsen;   
        }
        else
        {
            master['no_kerjasama_item'] = no_kerjasama_item;
        }

        var row_detail = $('#dtg-detail_item').datagrid('getRows');
        
        if(row_detail.length <= 0)
        {
            notif('warning','Detail Item Harus di isi!');
            return false;
        }

        var detail    = [];
        
        for (var i=0; i<row_detail.length; i++)
        {

            if (row_detail[i]['harga']=='')
            {
                notif('warning','Harga Pada Detail Tidak Boleh Kosong');
                return false;
            }

            detail.push({
                id_item     : row_detail[i]['id_item'],
                id_satuan   : row_detail[i]['id_satuan'],
                harga       : row_detail[i]['harga'],
                p_diskon_off: row_detail[i]['p_diskon_off'],
            });
        }

        // console.log(master);
        // console.log(detail);
        // return false;

        $('#loader').css('display','');
        $.ajax({
          url : "<?php echo base_url('pembelian/pembelian/Kerjasama_alkes/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master    : master,
            details   : detail,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $('#loader').css('display','none');
                if(data.error)
                {
                notif('error',data.message);
                }
                else
                {
                notif('success',data.message);
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

    function filter()
    {
        $('#dtg-kerjasama_alkes').datagrid('loadData', []);

        let criteria     = $('#txt-criteria').val();
        let tampil_semua = ($('input[name=chk-is_aktif]:checked').val()!=undefined);

        if (tampil_semua==true)
        {
            tampil_semua=1;
        }
        else
        {
            tampil_semua=0;
        }
            
        data = {
            tampil_semua: tampil_semua,
            criteria    : criteria,
            page        : 1,
            page_row    : 10,
        }

        var dg = $('#dtg-kerjasama_alkes').datagrid({
          url : "<?php echo base_url("pembelian/pembelian/Kerjasama_alkes/filter"); ?>",
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

        let id_produsen = $('#txt-id_produsen').val();
        let criteria    = $('#txt-kriteria_barang').val();
        
        data = {
            id_produsen: id_produsen,
            criteria   : criteria,
            page       : 1,
            page_row   : 10,
        }

        var dg = $('#dtg-barang').datagrid({
          url : "<?php echo base_url("pembelian/pembelian/Kerjasama_alkes/filter_barang"); ?>",
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

    function filter_produsen()
    {
        // body...
        $('#dtg-produsen').datagrid('loadData', []);
        
        let criteria = $('#txt-kriteria_produsen').val();
        let data     = [];

        $.ajax({
          url : "<?php echo base_url("pembelian/pembelian/Kerjasama_alkes/filter_produsen"); ?>",
          type: "POST",
          dataType: 'json',
          data:data,
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            data = data.list;
            if (criteria=='')
            {
                $('#dtg-produsen').datagrid('loadData', data);
            }
            else
            {
                let filtered = filterArray(data, criteria);
                // console.log(filtered);
                $('#dtg-produsen').datagrid('loadData', filtered);
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
             notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        });
    }

    function hapus()
    {
        
        let no_kerjasama_item = $('#txt-no_kerjasama_item').val();

        data={
            no_kerjasama_item: no_kerjasama_item,
            user_id          : "<?php echo $this->session->userdata['user_id'] ?>"
        }

        swal.fire(cohapus()).then(function(result) {
          if (result.value) {
            $.ajax({
                url     : "<?php echo base_url("pembelian/pembelian/Kerjasama_alkes/hapus"); ?>",
                type    : "POST",
                dataType: 'json',
                data    :{
                    data: data,
                },
                beforeSend: function (){               
                },
                success:function(data, textStatus, jqXHR){
                    let not_type = 'success';
                    if (data.status_code!=200)
                    {
                      not_type = 'error';
                    }
                    
                    notif(not_type,data.message);
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

    $(".change").change(function(){
        // alert("The text has been changed.");
        set_excel();
    });

    function cetak()
    {
        $('#loader').css('display','');

        cek_data();

        if (is_data==0)
        {
            notif('info','Data Tidak Ada');
            return false;
        }
        
        var no_kerjasama_item = $('#txt-no_kerjasama_item').val();
        var tipe              = $("input[name='radios']:checked").val();         
        var start_date        = toAPIDateFormat($('#dtb-start_date').val());
        var end_date          = toAPIDateFormat($('#dtb-end_date').val());
        var month_period      = $('#cmb-bulan option:selected').val();
        var type_file         = 1; // 1 adalah pdf

        var year_period;

        if(tipe==2)
        {
            year_period = $('#cmb-tahun1 option:selected').text();
        }
        else
        {
            year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        data={
              // no_kerjasama_item: "KOF-2008-00003",
              no_kerjasama_item: no_kerjasama_item,
              buffer           : true,
              rpt_period       : tipe,
              start_date       : start_date,
              end_date         : end_date,
              month_period     : month_period,
              year_period      : parseInt(year_period),
              year_period_text : year_period,
              type_file        : type_file
        }

        // console.log(data);

        data['cek']=0;

        $.ajax({
            url     : "<?= base_url() ?>pembelian/pembelian/Kerjasama_alkes/cetak",
            type    : "POST",
            dataType: 'json',   
            data:data,
            success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
                var file_cetak ='Laporan Kerjasama Pembelian Alkes '+no_kerjasama_item+'.pdf';
                $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
                $("#modal_preview").modal("show");
                $('#win-cetak').window('close');
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

    function set_excel()
    {
        // body...
        $('#loader').css('display','');
        
        var no_kerjasama_item = $('#txt-no_kerjasama_item').val();
        var rpt_period        = $("input[name='radios']:checked").val();         
        var start_date        = toAPIDateFormat($('#dtb-start_date').val());
        var end_date          = toAPIDateFormat($('#dtb-end_date').val());
        var month_period      = $('#cmb-bulan option:selected').val();
        var type_file         = 2; // 2 adalah excel

        var year_period;

        if(rpt_period==2)
        {
            year_period = $('#cmb-tahun1 option:selected').text();
        }
        else
        {
            year_period = $('#cmb-tahun2 option:selected').text();
        }

        var url_control = "<?= base_url() ?>pembelian/pembelian/Kerjasama_alkes/cetak";

        // $('#no_kerjasama_item').val("KOF-2008-00003");
        $('#no_kerjasama_item').val(no_kerjasama_item);
        $('#type_file').val(type_file);
        $('#buffer').val(buffer);
        $('#rpt_period').val(rpt_period);
        $('#start_date').val(start_date);
        $('#end_date').val(end_date);
        $('#month_period').val(month_period);
        $('#year_period').val(year_period);
        $('#year_period_text').val(year_period);

        $('#form_excel').attr('action', url_control);
    }

    function export_excel()
    {
        // body...
        cek_data();

        if (is_data==1)
        {
            $('#form_excel').submit();
        }
        else
        {
            notif('info','Data Tidak Ada')
        }
        
    }

    function cek_data()
    {
        // body...
        var no_kerjasama_item = $('#txt-no_kerjasama_item').val();
        var tipe              = $("input[name='radios']:checked").val();         
        var start_date        = toAPIDateFormat($('#dtb-start_date').val());
        var end_date          = toAPIDateFormat($('#dtb-end_date').val());
        var month_period      = $('#cmb-bulan option:selected').val();
        var type_file         = 2;

        var year_period;

        if(tipe==2)
        {
            year_period = $('#cmb-tahun1 option:selected').text();
        }
        else
        {
            year_period = $('#cmb-tahun2 option:selected').text();
        }
      
        data={
              // no_kerjasama_item: "KOF-2008-00003",
              no_kerjasama_item: no_kerjasama_item,
              buffer           : true,
              rpt_period       : tipe,
              start_date       : start_date,
              end_date         : end_date,
              month_period     : month_period,
              year_period      : parseInt(year_period),
              year_period_text : year_period,
              type_file        : type_file,
              cek              : 1,
        }

        is_data = 0;

        $.ajax({
            url     : "<?= base_url() ?>pembelian/pembelian/Kerjasama_alkes/filter_cetak",
            type    : "POST",
            dataType: 'json',   
            data    :data,
            async : false,
            success:function(data, textStatus, jqXHR){
                if(data.data[1]!=false)
                {
                    is_data = 1;
                }
                else
                {
                    $('#loader').css('display','none');    
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

    function tutup()
    {
        $('#win-cari_produsen').window('close');
        $('#win-detail').window('close');
        $('#win-cetak').window('close');
    }

</script>