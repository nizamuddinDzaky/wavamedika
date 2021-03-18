<!-- Script easy ui -->
<script type="text/javascript">
var isCreate = true;

    $(function () {
        tab(0);

        $('#txt-no_permintaan').attr('readonly', true);

        get_select();

        $('#dtg-aut').datagrid('hideColumn', 'trans_sign_id');
        $('#dtg-aut').datagrid('hideColumn', 'seq_no');
        $('#dtg-aut').datagrid('hideColumn', 'sign_id');
        $('#dtg-aut').datagrid('hideColumn', 'is_default');
        $('#dtg-aut').datagrid('hideColumn', 'user_id');
        $('#dtg-aut').datagrid('hideColumn', 'user_id_approve');        
    });

    $('#btn-tambah').click(function () {
        isCreate = true
        reset_form();
        set_read(false);
        get_select();
        loadAuth();
        tab(1);
    });

    $('#dtg-permintaan_mutasi').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
            btn_ubah();
        }
    });

    $('#dg-data_item').datagrid({
        singleSelect:false,
        onDblClickRow:function(index,row){
            
        },
        columns:[[
            {field:'id_item',title:'Deskripsi',width:80,editor:'textbox',hidden : true},
            {field:'nama_item',title:'Nama Item',width:270,halign :"center"},
            {field:'kd_item',title:'Kode',width:150,halign :"center"},
            {field:'nama_satuan',title:'Satuan',width:100,halign :"center"},
            {field:'nama_kel_item',title:'Jenis',width:100,halign :"center"},
            {field:'jml',title:'Jumlah',width:100,halign :"center",align:"right",formatter: datagridFormatNumber}
        ]],
    });

    $('#dtg-detail').datagrid({
        title:'Detail',
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'id_item',title:'Deskripsi',width:100,editor:'textbox',hidden : true},
            {field:'nama_item',title:'Nama Item',width:580,halign :"center"},
            {field:'kd_item',title:'Kode',width:150,halign :"center"},
            {field:'nama_satuan',title:'Satuan',width:100,halign :"center"},
            {field:'nama_kel_item',title:'Jenis',width:100,halign :"center"},
            {
                field:'jml_stok',title:'Stok',width:80,halign :"center",align : "right",formatter:appGridNumberFormatter
            },
            {
                field:'jml_minta',title:'Permintaan',width:80,align : "right",
                editor : {
                  'type' : 'numberbox',
                  'options' : {
                      'required':true,
                      'precision' : 0,
                      'min' : 1,
                      'groupSeparator' :'.',
                      'decimalSeparator' :','
                    }
                },halign :"center",
                formatter:appGridNumberFormatter
            },
            {
                field:'action',title:'Action',width:150,align:'center',
                formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverow(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                        var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrow(this)">Cancel</button>';
                        return s+c;
                    } else {
                        var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrow(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                        var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterow(this)">Delete</button>';
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
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }
    });

    $('#btn-filter_data_item').click(function (event) {
        filter_data_item();
    });

    $('#btn-tambah_detail_item').click(function(event) {
        let id_unit_asal = $('#cmb-unit_asal option:selected').val();
        let id_unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
        
        if (id_unit_asal == '' || id_unit_asal == undefined) {
            notif('warning','Unit Asal Belum Di pilih');
            return false
        }

        if (id_unit_tujuan == '' || id_unit_tujuan == undefined) {
            notif('warning','Unit Tujuan Belum Di pilih');
            return false
        }
        $('#win-pencarian_item').window('open');
        filter_data_item();
    });

    $('#btn-batal_data_item').click(function () {
        $('#win-pencarian_item').window('close');
    });

    $('#btn-pilih').click(function (event) {
        var selectedItem = $('#dg-data_item').datagrid('getSelections');
        
        if (isCreate) {
            // $('#dtg-detail').datagrid('loadData', selectedItem);
            var dataDetailItem = $('#dtg-detail').datagrid('getRows');
            for (i=0;i<selectedItem.length;i++) {
                $('#dtg-detail').datagrid('appendRow',{
                    id_item : selectedItem[i].id_item,
                    nama_item : selectedItem[i].nama_item,
                    kd_item : selectedItem[i].kd_item,
                    nama_satuan : selectedItem[i].nama_satuan,
                    nama_kel_item : selectedItem[i].nama_kel_item,
                    jml_stok : selectedItem[i].jml,
                    jml_minta : 1
                   
                });
            }
        }else{
            var dataDetailItem = $('#dtg-detail').datagrid('getRows');
            for (i=0;i<selectedItem.length;i++) {
                $('#dtg-detail').datagrid('appendRow',{
                    id_item : selectedItem[i].id_item,
                    nama_item : selectedItem[i].nama_item,
                    kd_item : selectedItem[i].kd_item,
                    nama_satuan : selectedItem[i].nama_satuan,
                    nama_kel_item : selectedItem[i].nama_kel_item,
                    jml_stok : selectedItem[i].jml,
                    jml_minta : 1
                   
                });
            }     
        }
        $('#win-pencarian_item').window('close');
    });

    function btn_ubah()
    {
        var row = $('#dtg-permintaan_mutasi').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }
        isCreate = false
        reset_form();
        if(row.status_caption!="Open")
        {
            set_read(true);
        }
        else
        {
            set_read(false);
        }
        get_data(row.no_pm);
    }

    $('#btn-hapus').click(function(){
        let no_permintaan = $('#txt-no_permintaan').val();
        let status_caption = $('#txt-status_caption').val();
          if(status_caption!="Open")
          {
              notif('warning','Data Tidak Bisa Dihapus');
              return false;
          }
        hapus(no_permintaan);
    });

function tab(tab)
{
  if (tab==0)
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

function get_select()
{
    // body...
    $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_mutasi/get_unit_asal"); ?>",
        type: "POST",
        dataType: 'json',
        beforeSend: function (){               
        },
        success:function(data, textStatus, jqXHR){
           $("#cmb-unit_asal").select2({ data: data });
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','Error, Something goes wrong');
        },
        complete: function(){
        }
    });

    $.ajax({
        url : "<?php echo base_url("general/transaksi/Permintaan_mutasi/get_unit_tujuan"); ?>",
        type: "POST",
        dataType: 'json',
        beforeSend: function (){               
        },
        success:function(data, textStatus, jqXHR){
           $("#cmb-unit_tujuan").select2({ data: data });
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','Error, Something goes wrong');
        },
        complete: function(){
        }
    });
}

function loadAuth() {
    $('#dtg-aut').datagrid('loadData', [])
    data={
        user_id    : "<?php echo $this->session->userdata['user_id'] ?>"
    }

    $.ajax({
        url     : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/getAuth"); ?>",
        type    : "POST",
        dataType: 'json',
        data    :{
            data:data
        },
        success:function(data, textStatus, jqXHR){
            $('#dtg-aut').datagrid('loadData', data.data);              
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','Error, Something goes wrong');
        },
        complete: function(){
            $('#btn-save').prop('disabled', false);
            $('#btn-save').html('Save');
        }
    });
}

function status(status,no)
{
    // body...
    var no_pm;
    if (no==0)
    {
      no_pm = $('#txt-no_permintaan').val();
    }
    else
    {
      no_pm = no;
    }

    if (no_pm=="")
    {
      return false;
    }

    var data={
      no_pm : no_pm,
      user_id    : "<?php echo $this->session->userdata['user_id'] ?>"
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

function verifikasi(data,status) {
    var no_pm = data.no_pm;
    $.ajax({
        url     : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/verifikasi"); ?>",
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
                get_data(no_pm);
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

function hapus(no_permintaan){
    
    data={
        no_pm: no_permintaan,
        user_id    : "<?php echo $this->session->userdata['user_id'] ?>"
    }

    swal.fire(cohapus()).then(function(result) {
      if (result.value) {
        $.ajax({
            url     : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/hapus"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data: data,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                console.log(data);
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

function filter() {
    $('#dtg-permintaan_mutasi').datagrid('loadData', []);

    let startDate = toAPIDateFormat($('#start-date-input').val());
    let endDate = toAPIDateFormat($('#end-date-input').val());
    let status = $('#cmb-status').val();
    let criteria = $('#txt-search').val();
    data = {
        status : status,
        start_date: startDate,
        end_date:endDate, 
        criteria:criteria,
        page: 1,
        page_row: 10,
    }

    // $.ajax({
    //     url     : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/filter"); ?>",
    //     type    : "POST",
    //     dataType: 'json',
    //     data    :
    //     {
    //         data: data,
    //     },
    //     success:function(data, textStatus, jqXHR){
    //         $('#dtg-permintaan_mutasi').datagrid('loadData', data.data);
    //     },
    //     error: function(jqXHR, textStatus, errorThrown){
    //         notif('error','Error, Something goes wrong');
    //     },
    //     complete: function(){
    //         $('#btn-save').prop('disabled', false);
    //         $('#btn-save').html('Save');
    //     }
    // });

    var dg = $('#dtg-permintaan_mutasi').datagrid({
      url : "<?php echo base_url("general/transaksi/Permintaan_mutasi/filter"); ?>",
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

function filter_data_item() {
    // body...
    $('#dg-data_item').datagrid('loadData',[]);

    let id_unit_asal = $('#cmb-unit_asal option:selected').val();
    let id_unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
    
    if (id_unit_asal == '' || id_unit_asal == undefined) {
        notif('warning','Unit Asal Belum Di pilih');
        return false
    }

    if (id_unit_tujuan == '' || id_unit_tujuan == undefined) {
        notif('warning','Unit Tujuan Belum Di pilih');
        return false
    }

    var data = {
        tgl_pm : toAPIDateFormat($('#mutasi-date-input').val()),
        id_unit_asal : $('#cmb-unit_asal option:selected').val(),
        id_unit_tujuan : $('#cmb-unit_tujuan option:selected').val(),
        criteria : $('#txt-search-item').val(),
        page_row: 10,
        page : 1
    }

    console.log(data);

    // $.ajax({
    //     url : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/search_item"); ?>",
    //     type: "POST",
    //     dataType: 'json',
    //     data:{
    //       data: data,
    //       },
    //     success:function(data, textStatus, jqXHR){                  
    //       var dg = $('#dg-data_item').datagrid();
    //       if (data.length > 0) {
    //         dg.datagrid('loadData',data);
    //       }else{
    //          notif('warning','Data Kosong');
    //         return false
    //       }
    //     },
    //     error: function(jqXHR, textStatus, errorThrown){
    //         notif('error','Error, Something goes wrong');
    //     },
    //     complete: function(){
    //       $('#btn-save').prop('disabled', false);
    //         $('#btn-save').html('Save');
    //     }
    // });

    var dg = $('#dg-data_item').datagrid({
      url : "<?php echo base_url("general/transaksi/Permintaan_mutasi/search_item"); ?>",
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

function simpan() {

    let unit_asal = $('#cmb-unit_asal option:selected').val();
    let unit_tujuan = $('#cmb-unit_tujuan option:selected').val();
    let catatan = $('#txt-desc').val();
    let tgl_pm = toAPIDateFormat($('#mutasi-date-input').val());
    let no_pm = $('#txt-no_permintaan').val();

    var details = [];
    row = $('#dtg-detail').datagrid('getRows');
    for (var i=0; i<row.length; i++) {
        details.push({
          id_item: row[i]['id_item'],
          id_satuan: row[i]['nama_satuan'],
          jml_stok: row[i]['jml_stok'],
          jml_minta: row[i]['jml_minta'],
        });
    }

    console.log(details);

    let auths= []
    if (no_pm != '') {
        var data={
            tgl_pm : tgl_pm,
            id_unit_asal: unit_asal,
            id_unit_tujuan: unit_tujuan,
            ket_pm: catatan,
            user_id:"<?php echo $this->session->userdata['user_id'] ?>",
            no_pm : no_pm
        };
        
    }else{
        var data={
            tgl_pm : tgl_pm,
            id_unit_asal: unit_asal,
            id_unit_tujuan: unit_tujuan,
            ket_pm: catatan,
            user_id:"<?php echo $this->session->userdata['user_id'] ?>"
        };

        row = $('#dtg-aut').datagrid('getRows');

        if(row.length <= 0){
          notif('warning','Autorisasi Harus Di isi');
          return false;
        }

        for (var i=0; i<row.length; i++) {
          auths.push({
            sign_id : row[i]['sign_id'],
            user_id : row[i]['user_id'],
            is_default : row[i]['is_default'],
            seq_no : row[i]['seq_no']
          });
        }
    }
    
    var validate = valdationForm(data, details)
    if (!validate.validate) {
        notif('warning',validate.message);
        return false
    }

    $.ajax({
        url : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/simpan"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
            master:data,
            details : details,
            auths : auths
        },
        success:function(data, textStatus, jqXHR){
          if (isCreate==true)
            {
                swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value) {
                    status("release",data.no_pm);
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
            notif('error','Error, Something goes wrong');
        },
        complete: function(){
          $('#btn-save').prop('disabled', false);
            $('#btn-save').html('Save');
        }
    });
}

function get_data(no_pm){
    $.ajax({
        url     : "<?php echo base_url("/general/transaksi/Permintaan_mutasi/getPermintaan"); ?>",
        type    : "POST",
        dataType: 'json',
        data    :{
            data:no_pm,
        },
        success:function(data, textStatus, jqXHR){
            set_form(data);
            tab(1);
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','Error, Something goes wrong');
        },
        complete: function(){
            $('#btn-save').prop('disabled', false);
            $('#btn-save').html('Save');
        }
    });
}

function set_form(data) {
    $('#txt-label_nopp').text("No. Permintaan : "+data.master.no_pm);

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

    $('#mutasi-date-input').val(toAppDateFormat(data.master.tgl_pm));
    $('#cmb-unit_asal').val(data.master.id_unit_asal).change();
    $('#cmb-unit_tujuan').val(data.master.id_unit_tujuan).change();
    $('#txt-desc').val(data.master.ket_pm);
    $('#txt-no_permintaan').val(data.master.no_pm);
    $('#txt-status_caption').val(data.master.status_caption);

    $('#dtg-detail').datagrid('loadData', data.details);
    $('#dtg-aut').datagrid('loadData', data.auth);

    if(data.master.m_open==true)
    {
      $('#btn-open').show();
    }
    if(data.master.m_release==true)
    {
      $('#btn-release').show();
    }
    if(data.master.m_approve==true)
    {
      $('#btn-approve').show();
    }
    if(data.master.m_reject==true)
    {
      $('#btn-reject').show();
    }
}

function valdationForm(data, details) {
    var validation
    if (data.tgl_pm == '') {
        return {
            validate: false,
            message: 'Tanggal Tidak Boleh Kosong'
        }
    }

    if (data.id_unit_asal == '') {
        return {
            validate: false,
            message :'Unit Asal Tidak Boleh Kosong'
        }
    }

    if (data.id_unit_tujuan == '') {
        return {
            validate: false,
            message: 'Unit Tujuan Tidak Boleh Kosong'
        }
    }

    if (data.ket_pm == '') {
        return {
            validate: false,
            message: 'Catatan Tidak Boleh Kosong'
        }
    }

    if (details.length < 1) {
        return {
            validate: false,
            message :'Detail Item Tidak Boleh Kosong'
        }
    }

    for (var i = 0; i < details.length; i++) {
        // console.log(details[i].jml_minta);
        if (details[i].jml_minta == 0 || details[i].jml_minta == '' || details[i].jml_minta == undefined) {
            return {
                validate :false,
                message: 'Data Permintaan ke ' + (i+1) + ' Tidak Boleh Kosong'
            }       
        }
    }

    return {
            validate: true,
            message: ''
        }
}

function saverow(target){
    validate = $('#dtg-detail').datagrid('validateRow', getRowIndex(target));
    if (!validate) {
        notif('warning','Permintaan Tidak Boleh Kosong');
        return false;
    }
    $('#dtg-detail').datagrid('endEdit', getRowIndex(target));
}

function editrow(target){
    $('#dtg-detail').datagrid('beginEdit', getRowIndex(target));
}

function deleterow(target){
    swal.fire(cohapus()).then(function(result) {
          if (result.value) {
            $('#dtg-detail').datagrid('deleteRow', getRowIndex(target));
          }
    });
}

function cancelrow(target){
    $('#dtg-detail').datagrid('cancelEdit', getRowIndex(target));
}

function getRowIndex(target){
    var tr = $(target).closest('tr.datagrid-row');
    return parseInt(tr.attr('datagrid-row-index'));
}

function reset_form() {
    $('.div_simpan').show();
    $('.status_caption').hide();
    $('#mutasi-date-input').val(appDateFormatter(new Date()));
    $('#txt-label_nopp').text("No. Permintaan : ");
    $('#txt-label_status').text("Status : ");
    $('#txt-label_posted').text(" ");

    $('#txt-no_permintaan').val('');
    $('#cmb-unit_asal').val('').change();
    $('#cmb-unit_tujuan').val('').change();;
    $('#txt-desc').val('');
    $('#txt-status_caption').val('');
    
    reset_button();
    
    $('#dtg-detail').datagrid('loadData', []);
    $('#dtg-aut').datagrid('loadData', []);
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
    $('#btn-reject').hide();
}

function set_read(kondisi)
{
    $('#txt-no_permintaan').attr('readonly', true);
    $('#txt-status_caption').attr('readonly', true);
    $('#mutasi-date-input').prop('disabled', kondisi);
    $('#cmb-unit_asal').prop('disabled', kondisi);
    $('#cmb-unit_tujuan').prop('disabled', kondisi);
    $('#txt-desc').attr('readonly', kondisi);

    if (isCreate==true&&kondisi==false) //tambah
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

    if (isCreate==false&&kondisi==false) //ubah 
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

    if (isCreate==false&&kondisi==true) //ubah readonly
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

</script>
<!-- end script -->
