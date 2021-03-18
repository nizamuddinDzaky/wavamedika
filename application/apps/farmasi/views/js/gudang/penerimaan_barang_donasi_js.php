<script type="text/javascript">
    var edit=0;
    var arrSatuan = [];
    var rowGridSelected = 0;
    var comboboxGridSelected = 0;
    var data_cetak=[];
    $(function(){
        filter();
        get_gudang();

        tab(0);
        // $('#win-detail_item').window('open');
        $('#btn-tambah_detail_item').click(function(event) {
            $('#win-detail_item').window('open');
            filter_po();
        });
        $('#cmb-gudang').select2({
            // dropdownParent: $('#detail'),
            placeholder   : 'Pilih Unit'
        })

        /*$('#txt-total').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })*/
    })

    $('#dtg-penerimaan_barang_donasi').datagrid({
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            edit = 1;
            reset_form();
            set_read();
            getData(row.no_bpb);
        },
        columns:[[
            {field:'no_bpb',title:'No. BPB',width:"12%",halign:'center',align:'left'},
            {field:'tgl_bpb',title:'Tgl. BPB',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'partner_name',title:'Nama Donatur',width:"25%",halign:'center',align:'left'},
            {field:'ket_bpb',title:'Catatan',width:"20%",halign:'center',align:'left'},
            {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'center'},
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
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'Kode',width:100,halign :"center", hidden: true},
            {field:'kd_item',title:'Kode',width:100,halign :"center"},
            {field:'nama_item',title:'Nama Item',width:280,halign :"center"},
            {field:'nama_satuan',title:'Satuan',width:70,halign :"center", align:"center"},
            {field:'rasio',title:'Rasio',width:80,halign :"center",align:"right"},
            {
                field:'jml_bpb',
                title:'Jumlah',
                width:80,
                halign :"center",
                align:"right", 
                formatter: datagridFormatNumber,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 1,
                        'required':true,
                        'groupSeparator' :'.'
                    }
                }
            },
            {field:'jml_satuan_kecil',title:'Jml Satuan Kecil',width:100,halign :"center",align:"right",formatter: datagridFormatNumber},
            {field:'nama_satuan_kecil',title:'Satuan Kecil',width:100,halign :"center",align:"right"},
            {field:'harga',title:'HPP',width:80,halign :"center",align:"right",formatter: datagridFormatNumber},
            {field:'total',title:'Sub Total',width:85,halign :"center", align:"right", formatter: datagridFormatNumber},
            {
                field:'tgl_ed',
                title:'Kedaluwarsa',
                width:120,
                halign :"center",
                align:"right",
                formatter:appGridDateFormatter,
                editor : {
                    'type' : 'datebox',
                    'options' : {
                        'required':true,
                        'parser':myparser,
                        'formatter':myformatter
                    }
                }
            },
            {field:'no_batch',title:'No. Batch',width:120,halign :"center", align:"right", editor: 'textbox'},
            {
                field:'action',title:'Action',width:130,align:'center',
                formatter:function(value,row,index){
                // 
                    if (row.editing){
                        var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                        var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                        return s+c;
                    } else {
                        var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                        var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
                        return e+d;
                    }
                }
            }
        ]],
        onEndEdit:function(index,row){
            row.total = row.harga * row.jml_bpb
            row.jml_satuan_kecil = arrSatuan[index][comboboxGridSelected]['nilai'] * row.jml_bpb
            row.rasio = arrSatuan[index][comboboxGridSelected]['ratio']
            var tgl_ed_ed = $('#dtg-detail_item').datagrid('getEditor', {
                index: rowGridSelected,
                field: 'tgl_ed'
            });
            var x =$(tgl_ed_ed.target).datebox('getValue')
            row.tgl_ed = toAPIDateFormat(x)
            console.log(x)
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

    $('#dtg-data_po').datagrid({
        iconCls:'icon-',
        singleSelect:false,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'id_item',title:'Kode',width:"25%",halign:'center',align:'center', hidden: true},
            {field:'kd_item',title:'Kode',width:"25%",halign:'center',align:'center'},
            {field:'nama_item',title:'Nama Item',width:"45%",halign:'center',align:'left'},
            {field:'nama_satuan',title:'Satuan',width:"15%",halign:'center',align:'left'},
            {field:'hpp',title:'HPP',width:"15%",halign:'center',align:'left', formatter: datagridFormatNumber},
        ]],
    });

    $('#dtg-list_supplier').datagrid({
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'partner_id',title:'ID Supplier',width:"15%",halign:'center',align:'center'},
            {field:'partner_name',title:'Nama Supplier',width:"30%",halign:'center',align:'left'},
            {field:'partner_address',title:'Alamat',width:"30%",halign:'center',align:'left'},
            {field:'partner_phone',title:'No. Telepon',width:"13%",halign:'center',align:'left'},
            {field:'contact_person',title:'Contact Person',width:"13%",halign:'center',align:'center'},
            {field:'contact_person',title:'Contact Person',width:"13%",halign:'center',align:'center', hidden:true},
        ]],
    });

    function saverowdetail(target){
       
        $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
    }
    function editrowdetail(target){
        var index = getRowIndex(target);
        rowGridSelected = index;
        var x = $("#dtg-detail_item").datagrid('getColumnOption', 'nama_satuan');
        x.editor = {
                    type:'combobox',
                    options:{
                        valueField:'kd_satuan',
                        textField:'kd_satuan',
                        data: arrSatuan[index],
                        required:true,
                        onSelect: function(rec){
                            comboboxGridSelected = arrSatuan[index].indexOf(rec)
                        }
                    }
                }
        var row = $('#dtg-detail_item').datagrid('getRows')[index];
        console.log(row.tgl_ed)
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
        set_read();
        reset_form();
        tab(1);
    }

    function batal(){
        $('#win-cari_donatur').window('close');
        $('#win-detail_item').window('close');
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
        }
        else{
            $('#div_status').show();
            $('#btn-aksi').show();
        }
    }

    /*$('#src-donatur').searchbox({
        searcher: show_donatur,
    });*/

    function show_donatur(){
        $('#win-cari_donatur').window('open');
        $('#dtg-list_supplier').datagrid('loadData', []);
        filter_donatur()
    }

    function filter_donatur() {
        data={
            criteria:$('#txt-kriteria_donatur').val(),
            page_row:10,
            page:1
        }

        var dg = $('#dtg-list_supplier').datagrid({
          url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/filter_supplier"); ?>",
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

    function get_gudang()
    {
      $.ajax({
          url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/get_gudang"); ?>",
          type: "POST",
          dataType: 'json',
          beforeSend: function (){               
          },
          success:function(data, textStatus, jqXHR){
             $("#cmb-gudang").select2({ data: data });
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
      });
    }

    function pilih_supplier() {
        var row = $('#dtg-list_supplier').datagrid('getSelected');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }
        $('#src-donatur').val(row.partner_name);
        $('#txt-alamat').val(row.data_partner);
        $('#txt-label_supplier').text(row.partner_name);
        $('#win-cari_donatur').window('close');
    }

    function filter_po() {
        data={
            criteria:$('#txt-kriteria_item').val(),
            page_row:10,
            page:1
        }

        var dg = $('#dtg-data_po').datagrid({
          url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/filter_po"); ?>",
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

    function pilih_po() {
        var row = $('#dtg-data_po').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }
        arrSatuan = [];
        
        for (var i = 0 ; i < row.length; i++) {
            row[i]['nama_satuan_kecil'] = row[i]['nama_satuan'],
            row[i]['rasio'] = row[i]['data_satuan'][0]['ratio'],
            row[i]['harga'] = row[i]['hpp'],
            row[i]['jml_bpb'] = 1,
            row[i]['jml_satuan_kecil'] = row[i]['jml_bpb'] * row[i]['data_satuan'][0]['nilai'],
            row[i]['tgl_ed'] = toAPIDateFormat(toAppDateFormat(new Date()))
            row[i]['total'] = row[i]['hpp'] * row[i]['jml_satuan_kecil'],

            arrSatuan.push(row[i]['data_satuan'])
        }
        $('#dtg-detail_item').datagrid('loadData', row)
        $('#win-detail_item').window('close');
        set_total()
    }

    function set_total(biayaLain = null, disNota = null) {
        
        var data = $("#dtg-detail_item").datagrid('getRows')
        var totHarga = 0
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++){
                totHarga += parseInt(data[i].total);
            }
        }

        $('#txt-total').val(totHarga)
    }

    function simpan() {
        var no_bpb = $('#txt-nobpb').val();
        var tgl_bpb = toAPIDateFormat($('#dtb-detail').val());
        var id_gudang = $('#cmb-gudang').val();
        var id_partner = $('#src-donatur').val();
        var ket_supplier = $('#txt-alamat').val();
        var no_faktur_sup = $('#txt-no_dokumen').val();
        var tgl_faktur_sup = toAPIDateFormat($('#dtb-dokumen').val());
        var ket_bpb = $('#txt-ket').val();
        var subtotal = $('#txt-total').val();
        var user_id = "<?php echo $this->session->userdata['user_id'] ?>";

        if (id_gudang == '') {
            notif('warning','Gudang Belum dipilih!');
            return false;
        }

        if (id_partner == '') {
            notif('warning','Gudang Belum dipilih!');
            return false;
        }

        var master = {
            no_bpb : no_bpb,
            tgl_bpb : tgl_bpb,
            id_gudang : id_gudang,
            id_partner : id_partner,
            ket_supplier : ket_supplier,
            no_faktur_sup : no_faktur_sup,
            tgl_faktur_sup : tgl_faktur_sup,
            ket_bpb : ket_bpb,
            subtotal : subtotal,
            user_id : user_id,
        }

        var details = [];
        var row = $('#dtg-detail_item').datagrid('getRows');

        if(row.length <= 0){
          notif('warning','Detail Harus di isi!');
          return false;
        }

        for (var i = 0 ; i < row.length; i++) {

            details.push({
                id_item : row[i]['id_item'],
                jml_bpb : row[i]['jml_bpb'],
                id_satuan_bpb : row[i]['nama_satuan'],
                id_satuan_kecil : row[i]['nama_satuan_kecil'],
                jml_satuan_kecil : row[i]['jml_satuan_kecil'],
                harga : row[i]['harga'],
                total : row[i]['total'],
                tgl_ed : row[i]['tgl_ed'],
                no_batch : row[i]['no_batch'],
                rasio : row[i]['rasio'],
            })
        }
        console.log(details);

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master: master,
            details: details,
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
                        no_bpb : data.no_bpb,
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

    function reset_form() {
        data_cetak=[];
        $('#btn-hapus').hide();
        $('#txt-nobpb').val('');
        $('#dtb-detail').val(appDateFormatter(new Date()));
        $('#cmb-gudang').val('').change();
        $('#src-donatur').val('');
        $('#txt-alamat').val('');
        $('#txt-no_dokumen').val('');
        $('#dtb-dokumen').val(appDateFormatter(new Date()));
        $('#txt-ket').val('');
        $('#txt-total').val('');
        $('.div_simpan').show()
        $('#dtg-detail_item').datagrid('loadData',[]);
        $('#dtg-detail_item').datagrid('showColumn', 'action');
        $('#btn-show-supplier').show();
    }

    function getData(no_bpb) {
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/getPerKode"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
            data: no_bpb,
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
        data_cetak=data;
        $('#txt-nobpb').val(data.master.no_bpb);
        $('#dtb-detail').val(toAppDateFormat(data.master.tgl_bpb));
        $('#cmb-gudang').val(data.master.id_gudang).change();
        $('#src-donatur').val(data.master.partner_name);
        $('#txt-alamat').val(data.master.partner_address);
        $('#txt-no_dokumen').val(data.master.no_faktur_sup);
        $('#dtb-dokumen').val(toAppDateFormat(data.master.tgl_faktur_sup));
        $('#txt-ket').val(data.master.ket_bpb);
        $('#dtg-detail_item').datagrid('loadData',data.detail);
        $('#btn-open').attr('hidden', !data.master.m_open);
        $('#btn-release').attr('hidden', !data.master.m_release);

        $('#txt-label_nobpb').text('No. BPB : ' + data.master.no_bpb);
        $('#txt-label_status').text('Status :  ' + data.master.status_caption);

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

        if (data.master.status_caption == 'Open') {
            $('.div_simpan').show()
            $('#btn-hapus').show();
            $('#btn-show-supplier').show();
        }else{
            $('#dtg-detail_item').datagrid('hideColumn', 'action');
            $('.div_simpan').hide()
            $('#btn-hapus').hide();
            $('#btn-show-supplier').hide();
        }
        arrSatuan = [];
        for (var i = 0 ; i < data.detail.length; i++) {
            arrSatuan.push(data.detail[i]['data_satuan'])
        }

        set_total()
    }

    function filter() {
        var dg = $('#dtg-penerimaan_barang_donasi').datagrid('loadData',[]);
        data={
            status : $('#cmb-status').val(),
            start_date:toAPIDateFormat($('#dtb-start_date').val()),
            end_date:toAPIDateFormat($('#dtb-end_date').val()),
            criteria:$('#txt-criteria').val(),
            page_row:10,
            page:1
        }

        var dg = $('#dtg-penerimaan_barang_donasi').datagrid({
          url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/filter"); ?>",
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
    function myparser(s){
        if (!s) return new Date();
        var ss = (s.split('/'));
        var d = parseInt(ss[0],10);
        var m = parseInt(ss[1],10);
        var y = parseInt(ss[2],10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
            return new Date(y,m-1,d);
        } else {
            return new Date();
        }
    }
    function myformatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
        return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
    }

    function hapus() {
        let no_bpb = $('#txt-nobpb').val();
      
        data={
            no_bpb : no_bpb,
            user_id: "<?php echo $this->session->userdata['user_id'] ?>"
        } 

        // console.log(data);

        swal.fire(cohapus()).then(function(result) {
            if (result.value) {
                $.ajax({
                    url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/hapus"); ?>",
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
    function verifikasi(data,status) {
        var no_bpb = data.no_bpb;
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/Penerimaan_barang_donasi/status"); ?>",
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
                    getData(no_bpb);
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
        no_bpb : $('#txt-nobpb').val(),
        user_id : "<?php echo $this->session->userdata['user_id'] ?>"
      }
      swal.fire(costatus()).then(function(result) {
          if (result.value) {
              verifikasi(data,status);
          }
      });
    }

    function cetak(){
      $('#loader').css('display','');
      console.log(data_cetak);
      $.ajax({
        url     : "<?= base_url() ?>farmasi/gudang/Penerimaan_barang_donasi/cetak",
        type    : "POST",
        dataType: 'json', 
        data    : data_cetak,
        success:function(data, textStatus, jqXHR){
          if (data.success === true) {
            $('#loader').css('display','none');
            let file_cetak = "Laporan_Penerimaan_Barang_Donasi.pdf";
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