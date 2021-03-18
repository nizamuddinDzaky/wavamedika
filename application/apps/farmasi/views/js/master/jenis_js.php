<script type="text/javascript">
    var is_created=0;
    var flagEditStatus=true;
    
    $(function(){
       filter(); 
    });

    $('#btn-tambah').click(function(event) {
        is_created = 1;
        reset_fom()
        $('#win').window('open');
    });
    $('#btn-batal').click(function(event) {
        $('#win').window('close'); 
    });
    $('#btn-ubah').click(function(event) {
        flagEditStatus = false;
        edit();
    });
    $('#btn-tampil').click(function(event) {
        flagEditStatus = true;
        edit();
    });

    $('#dtg-jenis').datagrid({
        iconCls     :'icon-',
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            flagEditStatus = false;
            edit();
        },
        columns:[[
            {field:'id_jns_obat',title:'Kode',width:"10%",halign:'center',align:'left'},
            {field:'nama_jns_obat',title:'Golongan Obat',width:"25%",halign:'center',align:'left'},
            {field:'is_aktif',title:'Status',width:"10%",halign:'center',align:'left'},
            {field:'created_by',title:'User Entry',width:"10%",halign:'center',align:'left'},
            {field:'date_ins',title:'Tgl. Entry',width:"12%",halign:'center',align:'center',formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'User Update',width:"10%",halign:'center',align:'left'},
            {field:'date_upd',title:'Tgl. Update',width:"12%",halign:'center',align:'center',formatter:appGridDateTimeFormatter},
        ]],
    });

    function filter() {
        var data = {
            status  : $('#cmb-status').val(),
            criteria: $('#txt-search').val(),
            page    : 1,
            page_row: 10,
        }

        var dg = $('#dtg-jenis').datagrid({
            url        : "<?php echo base_url("/farmasi/master/jenis/filter"); ?>",
            method     : "POST",
            queryParams: data,
            loadFilter : function(data) {
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
                    rows: data.data ? data.data : []
                }
            }
        });
    }

    function simpan() {
        var id_jns_obat   = $('#txt-kode').val();
        var nama_jns_obat = $('#txt-gol_obat').val();
        var is_aktif      = $('#chk-is_aktif').is(":checked");

        if (id_jns_obat == "") {
            swal.fire('Peringatan','Kode Tidak Boleh Kosong','error');
            return false;
        }

        if (nama_jns_obat == "") {
            swal.fire('Peringatan','Nama Obat Tidak Boleh Kosong','error');
            return false;
        }
        var data={
            id_jns_obat  : id_jns_obat,
            nama_jns_obat: nama_jns_obat,
            is_aktif     : is_aktif,
            user_id      :"<?php echo $this->session->userdata['user_id'] ?>"
        };
        $.ajax({
            url : "<?php echo base_url("/farmasi/master/jenis/simpan"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
                is_created : is_created,
                master:data,
            },
            success:function(data, textStatus, jqXHR){
                if(data.error == 0){
                    swal.fire('Peringatan',data.message,'error');
                }
                else{
                    swal.fire('Sukses',data.message,'success');
                }
                filter()
                $('#win').window('close'); 
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
                $('#btn-save').prop('disabled', false);
                $('#btn-save').html('Save');
            }
        });
    }

    function edit() {
        var row = $('#dtg-jenis').datagrid('getSelected');
        if (row == null) {
            swal.fire('','Harap Pilih Data','warning');
            return false;
        }
        get_data(row);
    }

    function hapus() {
        var row = $('#dtg-jenis').datagrid('getSelected');
        if (row == null) {
            swal.fire('','Harap Pilih Data','warning');
            return false;
        }
        data={
            id_jns_obat: row.id_jns_obat,
        }
        $.messager.confirm('Konfirmasi','Apakah Anda yakin akan menghapus data?', function(r) {
            if (r){
                $.ajax({
                    url     : "<?php echo base_url("/farmasi/master/jenis/hapus"); ?>",
                    type    : "POST",
                    dataType: 'json',
                    data    :{
                        data: data,
                    },
                    beforeSend: function (){               
                    },
                    success:function(data, textStatus, jqXHR){
                        swal.fire('Berhasil',data.message);
                        filter();
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

    function get_data(row){
      $.ajax({
            url     : "<?php echo base_url("/farmasi/master/jenis/getPerkode"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data:row.id_jns_obat,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
                $('#btn-save').prop('disabled', false);
                $('#btn-save').html('Save');
            }
        });
    }

    function set_form(data) {
        is_created = 0
        if (flagEditStatus==true){
            $('#txt-kode').val(data.id_jns_obat);
            $('#txt-kode').attr('disabled',true);
            $('#txt-gol_obat').val(data.nama_jns_obat);
            $('#txt-gol_obat').attr('disabled',true);
            $('#div_simpan').hide();
            $('#chk-is_aktif').attr('readonly',true);
            if(data.is_aktif==true){
                $('#chk-is_aktif').checkbox({
                    checked: true
                });
            }
            else{
                $('#chk-is_aktif').checkbox({
                    checked: false
                });
            }
        }
        else{
            $('#txt-kode').val(data.id_jns_obat);
            $('#txt-kode').attr('disabled',true);
            $('#txt-gol_obat').val(data.nama_jns_obat);
            $('#txt-gol_obat').attr('disabled',false);
            $('#div_simpan').show();
            // $('#chk-is_aktif').attr('readonly',false);
            if(data.is_aktif==true){
                // $('#chk-is_aktif').checkbox('check');
                $('#chk-is_aktif').checkbox({
                    checked: true
                });
            }
            else{
                $('#chk-is_aktif').checkbox({
                    checked: false
                });
            }
        }
        $('#win').window('open');
    }

    function reset_fom() {
        $('#txt-kode').attr('disabled',false);
        $('#txt-kode').val('');
        $('#txt-gol_obat').val('');
        $('#txt-gol_obat').attr('disabled',false);
        $('#chk-is_aktif').prop('checked', false);
        $('#chk-is_aktif').checkbox({
            checked: false
        });
        $('#div_simpan').show();
    }
</script>