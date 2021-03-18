<!-- Script easy ui -->
<script type="text/javascript">
    var edit=0;

    get_select();

    $(function(){
        tab(0);

        get_select();

        $('#cmb-unit_asal').select2({
            placeholder: 'Pilih Unit Asal'
        });

        $('#cmb-unit_tujuan').select2({
            placeholder: 'Pilih Unit Tujuan'
        });

        $('#dtg-auth').datagrid('hideColumn', 'trans_sign_id');
        $('#dtg-auth').datagrid('hideColumn', 'seq_no');
        $('#dtg-auth').datagrid('hideColumn', 'sign_id');
        $('#dtg-auth').datagrid('hideColumn', 'is_default');
        $('#dtg-auth').datagrid('hideColumn', 'user_id');
        $('#dtg-auth').datagrid('hideColumn', 'user_id_approve');

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
            $('#dtg-detail').datagrid('reload');
            $('#browse').hide();
            $('#detail').show();
        }
    }

    $('#btn-tambah').click(function(){
        edit = 0;
        reset_form();
        set_read(false);
        default_auth()
        tab(1);
    });

    $('#dtg-retur_mutasi').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
            btn_ubah();
        }
    });

    $('#btn-tambah_detail').click(function(){
        var id_unit_asal = $('#cmb-unit_asal').val();
        var id_unit_tujuan = $('#cmb-unit_tujuan').val();
        var jns_mutasi = $('#cmb-jns_mutasi').val();

        if(id_unit_asal == "" || id_unit_asal == null || id_unit_asal == undefined)
        {
            notif('warning','Harap Pilih Unit Asal');
            return false;
        }

        if(id_unit_tujuan == ""|| id_unit_tujuan == null || id_unit_tujuan == undefined)
        {
            notif('warning','Harap Pilih Unit Tujuan');
            return false;
        }

        $('#win-cari_data_item').window('open');

        filter_barang()
    });

    $('#btn-pilih').click(function () {
        var rows = $('#dtg-data_item').datagrid('getSelections');

        var rowGridList = $('#dtg-detail').datagrid('getRows');
        /*$('#dtg-detail_item').datagrid('loadData', []);*/
        if (edit==0) {
            for (i=0;i<rows.length;i++) {
                rows[i]['jml_retur'] = '1'
                rows[i]['jml_sisa'] = rows[i].jml_mutasi - 1
            }
        $('#dtg-detail').datagrid('loadData', rows);
        }else{
            for (i=0;i<rows.length;i++) {
                $('#dtg-detail').datagrid('appendRow',{
                    id_item : rows[i].id_item,
                    kd_item : rows[i].kd_item,
                    nama_item : rows[i].nama_item,
                    nama_satuan : rows[i].nama_satuan,
                    nama_kel_item : rows[i].nama_kel_item,
                    jml_stok : rows[i].jml_stok,
                    jml_mutasi : rows[i].jml_mutasi,
                    no_mutasi : rows[i].no_mutasi,
                    hpp : rows[i].hpp
                });
            }
        }
        $('#win-cari_data_item').window('close');
    });

    $('#btn-batal_detail_item').click(function() {
        $('#win-cari_data_item').window('close');
    });

    $('#btn-kembali').click(function() {
        tab(0);
    });

    $('#btn-batal').click(function() {
        tab(0);
    });

    $('#dtg-detail').datagrid({
        title:'Detail Item',
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'ID. Mutasi',width:100,halign :"center",hidden:true},
            {field:'no_mutasi',title:'No. Mutasi',width:150,halign :"center"},
            {field:'kd_item',title:'Kode',width:150,halign :"center"},
            {field:'nama_item',title:'Nama Item',width:350,halign :"center"},
            {field:'nama_satuan',title:'Satuan',width:100,halign :"center"},
            {field:'jml_mutasi',title:'Jml. Sisa Mutasi',width:100,halign :"center",align:"right", formatter: datagridFormatNumber},
            {field:'jml_stok',title:'Jml. Stok',width:100,halign :"center", align:"right", formatter: datagridFormatNumber},
            {
                field:'jml_retur',
                title:'Jml. Retur',
                width:100,halign :"center",align:"right",
                formatter: datagridFormatNumber,
                editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'required':true,
                        'precision' : 0,
                        'min' : 0,
                        'groupSeparator' :'.',
                        'decimalSeparator' :','
                    }
                },
            },
            {field:'jml_sisa',title:'Jml. Sisa Akhir',width:100,halign :"center", align:"right", formatter: datagridFormatNumber},
            {field:'hpp',title:'HPP',width:100,halign :"center", align:"right", formatter: datagridFormatNumber},
            {
                field:'action',title:'Action',width:150,align:'center',
                formatter:function(value,row,index){
                // console.log(this)
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
            var jml_retur_ed = $(this).datagrid('getEditor', {
                index: index,
                field: 'jml_retur'
            });

            let retur = $(jml_retur_ed.target).numberbox('getValue');
            let sisa = parseInt(row.jml_mutasi) - retur

            row.jml_sisa = sisa
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

    function saverowdetail(target){
        var index = getRowIndex(target);
        var row = $('#dtg-detail').datagrid('getRows')[index];

        var jml_retur_ed = $('#dtg-detail').datagrid('getEditor', {
            index: index,
            field: 'jml_retur'
        });

        let retur = $(jml_retur_ed.target).numberbox('getValue');
        let sisa = parseInt(row.jml_mutasi) - retur

        if (sisa < 1) {
            notif('warning','(Jml Mutasi - Jml Retur) Tidak Boleh Kurang dari 1');
            return false
        }else{

            $('#dtg-detail').datagrid('endEdit', index);
        }
    }
    function editrowdetail(target){
        $('#dtg-detail').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterowdetail(target){
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail').datagrid('deleteRow', getRowIndex(target));
              }
        });
    }
    function cancelrowdetail(target){
        $('#dtg-detail').datagrid('cancelEdit', getRowIndex(target));
    }

    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function btn_ubah()
    {
        var row = $('#dtg-retur_mutasi').datagrid('getSelected');
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
        getData(row.no_rt_mutasi);
    }

    function get_select()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/get_unit_asal"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#cmb-unit_asal").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        });

        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/get_unit_tujuan"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#cmb-unit_tujuan").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter_barang()
    {
        $('#dtg-data_item').datagrid('loadData',[]);
        var id_unit_tujuan = $('#cmb-unit_tujuan').val();
        var id_unit_asal = $('#cmb-unit_asal').val();
        var jns_mutasi = $('#cmb-jns_mutasi').val();
        var end_date = toAPIDateFormat($('#dtb-end_date-filter_item').val());
        var start_date = toAPIDateFormat($('#dtb-start_date-filter_item').val());
        var criteria = $('#txt-kriteria_cari_nomutasi').val()

        data={
            start_date : start_date,
            end_date : end_date,
            criteria : criteria,
            id_unit_stok : id_unit_asal,
            id_unit_tujuan : id_unit_tujuan,
            jns_mutasi : jns_mutasi,
            page:1,
            page_row:10
        } 

        var dg = $('#dtg-data_item').datagrid({
            url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/filter_barang"); ?>",
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

    function default_auth()
    {
        $('#dtg-auth').datagrid('loadData',[]);
        
        data={
          user_id :"<?php echo $this->session->userdata['user_id'] ?>"
        } 

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/default_auth"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            $('#dtg-auth').datagrid('loadData', data.data);
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function simpan() {
        let tgl_rt_mutasi = toAPIDateFormat($('#dtb-date-input').val());
        let id_unit_stok = $('#cmb-unit_asal').val();
        let id_unit_tujuan = $('#cmb-unit_tujuan').val();
        let ket_rt_mutasi = $('#txt-desc').val();
        let no_rt_mutasi = $('#txt-no_retur').val();
        let user_id = "<?= $this->session->userdata('user_id')?>"

        if (id_unit_stok=="") {
            notif('warning','Unit Asal Tidak Boleh Kosong');
            return false;
        }

        if (id_unit_tujuan=="") {
            notif('warning','Unit Tujuan Tidak Boleh Kosong');
            return false;
        }

        if (ket_rt_mutasi=="") {
            notif('warning','Catatan Tidak Boleh Kosong');
            return false;
        }

        master={
            tgl_rt_mutasi : tgl_rt_mutasi,
            id_unit_stok : id_unit_stok,
            id_unit_tujuan : id_unit_tujuan,
            ket_rt_mutasi : ket_rt_mutasi,
            user_id : user_id
        }

        row = $('#dtg-detail').datagrid('getRows');
        if(row.length <= 0){
            notif('warning','Detail Harus Di isi');
            return false;
        } 
        var details = [];

        for (var i = 0 ; i < row.length; i++) {

            if (row[i]['jml_retur'] == '' || row[i]['jml_retur'] == undefined || row[i]['jml_retur'] == 0) {
                notif('warning','Jumlah Retur '+row[i]['no_mutasi']+' tidak boleh Kosong');
                return false;  
            }

            details.push({
                no_mutasi : row[i]['no_mutasi'],
                id_item : row[i]['id_item'],
                id_satuan : row[i]['nama_satuan'],
                jml_mutasi : row[i]['jml_mutasi'],
                jml_stok : row[i]['jml_stok'],
                jml_retur : row[i]['jml_retur'],
                hpp: row[i]['hpp']
            })
        }

        rowAuth = $('#dtg-auth').datagrid('getRows');
        if(rowAuth.length <= 0){
            notif('warning','Warning','Autorisasi Harus Di isi');
            return false;
        }

        var auths = [];

        if(no_rt_mutasi != '')
        {
            master['no_rt_mutasi']=no_rt_mutasi;
        }
        else
        {
            for (var i=0; i<rowAuth.length; i++)
            {
                auths.push({
                    sign_id : rowAuth[i]['sign_id'],
                    user_id : rowAuth[i]['user_id'],
                    is_default : rowAuth[i]['is_default'],
                    seq_no : rowAuth[i]['seq_no']
                });
            }
        }

        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/simpan"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
            master:master,
            details : details,
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
                        status("release",data.no_rt_mutasi);
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
                    notif('success',data.message);
                  }else{
                    notif('success',data.message);
                  }
                  tab(0);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        }); 
    }

    function filter()
    {
        $('#dtg-retur_mutasi').datagrid('loadData',[]);
        var status = $('#cmb-status').val();
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date = toAPIDateFormat($('#dtb-end_date').val());
        var criteria = $('#txt-kriteria').val();
      
        data={
          status : status,
          start_date : start_date,
          end_date : end_date,
          criteria : criteria,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-retur_mutasi').datagrid({
          url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/filter"); ?>",
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
        $('.div_simpan').show();
        $('.status_caption').hide();
        $('#txt-label_nopp').text("No. Permintaan : ");
        $('#dtb-date-input').val(appDateFormatter(new Date()));
        $('#txt-label_status').text("Status : ");
        $('#txt-label_posted').text(" ");
        $('#txt-no_retur').val('');
        $('#cmb-unit_tujuan').val('').change();
        $('#cmb-unit_asal').val('').change();
        $('#txt-desc').val('');
        $('#txt-status_caption').val('');
        reset_button();
        $('#dtg-detail').datagrid('loadData', []);
        $('#dtg-auth').datagrid('loadData', []);
    }

    function reset_button()
    {
        // body...
        $('#btn-open').hide();
        $('#btn-release').hide();
        $('#btn-receive').hide();
        $('#btn-reject').hide()
    }

    function getData(no_rt_mutasi)
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/getPerKode"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
                data: no_rt_mutasi,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
                tab(1);
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        }); 
    }

    function set_form(data) {
        $('#txt-label_nopp').text("No. Retur : "+data.master.no_rt_mutasi);

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

        $('#txt-no_retur').val(data.master.no_rt_mutasi);
        $('#dtb-date-input').val(toAppDateFormat(data.master.tgl_rt_mutasi));
        $('#cmb-unit_asal').val(data.master.id_unit_stok).change();
        $('#cmb-unit_tujuan').val(data.master.id_unit_tujuan).change();
        $('#txt-desc').val(data.master.ket_rt_mutasi);

        $('#txt-status_caption').val(data.master.status_caption);
        
        $('#dtg-detail').datagrid('loadData', data.detail);
        $('#dtg-auth').datagrid('loadData', data.aut);

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
        // body...
        $('#txt-no_retur').attr('readonly', true);
        $('#txt-status_caption').attr('readonly', true);
        $('#dtb-date-input').prop('disabled', kondisi);
        $('#cmb-unit_asal').prop('disabled', kondisi);
        $('#cmb-unit_tujuan').prop('disabled', kondisi);
        $('#txt-desc').attr('readonly', kondisi);

        if (edit==0&&kondisi==false) //tambah
        {
          $('#div_status').hide();
          $('#cmb-unit_asal').prop('disabled', false);
          $('#cmb-unit_tujuan').prop('disabled', false);
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();

          $('.div_simpan').show();

          $('#dtg-detail').datagrid('showColumn', 'action');
        }

        if (edit==1&&kondisi==false) //ubah 
        {
          $('#div_status').show();
          $('#cmb-unit_asal').prop('disabled', true);
          $('#cmb-unit_tujuan').prop('disabled', true);
          $('#btn-aksi').show();
          $('#btn-hapus').show();
          $('#btn-cetak').show();

          $('.div_simpan').show();

          $('#dtg-detail').datagrid('showColumn', 'action');          
        }

        if (edit==1&&kondisi==true) //ubah readonly
        {
          $('#div_status').show();
          $('#cmb-unit_asal').prop('disabled', true);
          $('#cmb-unit_tujuan').prop('disabled', true);
          $('#btn-aksi').show();
          $('#btn-hapus').hide();
          $('#btn-cetak').show();

          $('.div_simpan').hide();

          $('#dtg-detail').datagrid('hideColumn', 'action');
        }
    }

    function hapus()
    {
        let no_rt_mutasi = $('#txt-no_retur').val();
        let status_caption = $('#txt-status_caption').val();
        if(status_caption!="Open")
        {
          notif('warning','Data Tidak Bisa Dihapus');
          return false;
        }

        data={
          no_rt_mutasi : no_rt_mutasi,
          user_id: "<?php echo $this->session->userdata['user_id'] ?>",
        } 

        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $.ajax({
                  url : "<?php echo base_url("farmasi/gudang/Retur_mutasi/hapus"); ?>",
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
                      notif('error','something goes wrong');
                  },
                  complete: function(){
                  }
                });
              }
        });
    }

    function status(status,no)
    {
        var no_rt_mutasi = $('#txt-no_retur').val();

        if (no==0)
        {
          no_rt_mutasi = $('#txt-no_retur').val();
        }
        else
        {
          no_rt_mutasi = no;
        }

        if (no_rt_mutasi=="")
        {
            return false;
        }

        var data={
            no_rt_mutasi : no_rt_mutasi,
            user_id : "<?php echo $this->session->userdata['user_id'] ?>"
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
        var no_rt_mutasi = data.no_rt_mutasi;
        $.ajax({
            url     : "<?php echo base_url("farmasi/gudang/Retur_mutasi/status"); ?>",
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
                    getData(no_rt_mutasi);
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
                notif('error','something goes wrong');
            },
                complete: function(){
            }
        }); 
    }
</script>
<!-- end script -->
