<script type="text/javascript">
    var is_created=0;
	$(function(){
        filter();
    	$('#btn-tambah').click(function(event) {
    		$('#win').window('open');
            reset_form();
    	});
    	$('#btn-batal').click(function(event) {
    		$('#win').window('close');
    	});
        $('#btn-ubah').click(function(event) {
            edit();
            is_created=1;
        });
        $('#btn-tampil').click(function(event) {
            edit();
            is_created=0;
        });
        $('#btn-simpan').click(function(event) {
            simpan();
        });
        $('#btn-hapus').click(function(event) {
            hapus();
        });
	})

	$('#dtg-golongan').datagrid({
        iconCls     :'icon-',
        singleSelect:true,
        idField     :'itemid',
    	onDblClickRow:function(index,row){
          	edit();
            is_created=1;
    	},
    	columns:[[
          	{field:'id_gol_obat',title:'Kode',width:"12%",halign:'center',align:'center'},
          	{field:'nama_gol_obat',title:'Golongan Obat',width:"25%",halign:'center',align:'left'},
          	{field:'is_aktif',title:'Status',width:"10%",halign:'center',align:'center'},
          	{field:'created_by',title:'Dibuat Oleh',width:"15%",halign:'center',align:'center'},
          	{field:'date_ins',title:'Tgl. Dibuat',width:"12%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
          	{field:'updated_by',title:'Diubah Oleh',width:"15%",halign:'center',align:'center'},
          	{field:'date_upd',title:'Tgl. Diubah',width:"12%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
    	]],
    });

    function filter(){
        var dg       = $('#dtg-golongan').datagrid('loadData',[]);
        var status   = $('#cmb-status option:selected').val();
        var criteria = $('#txt-search').val();
        $('#dtg-golongan').datagrid('unselectAll');
        data = {
            data_status: status,
            criteria   : criteria,
            page_row   : 10,
            page       : 1,
        }
        var dg = $('#dtg-golongan').datagrid({
            url        : "<?php echo base_url("farmasi/master/Golongan/filter"); ?>",
            method     : "POST",
            queryParams: data,
            loadFilter : function(data){
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
                    rows: data.data ? data.data : []
                }
            }
        });
    }

    function edit() {
        var row = $('#dtg-golongan').datagrid('getSelected');
        if (row == null) {
            swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
            return false;
        }
        get_data(row);
    }

    function get_data(row){
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/golongan/getPerkode"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data:row.id_gol_obat,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
            },
            error: function(jqXHR, textStatus, errorThrown){
                swal.fire('Error', 'something goes wrong', 'error');
            },
            complete: function(){
                $('#btn-save').prop('disabled', false);
                $('#btn-save').html('Save');
            }
        });
    }

    function simpan() {
        var id_gol_obat   = $('#txt-kode').val();
        var nama_gol_obat = $('#txt-gol_obat').val();
        var is_aktif      = $('#chk-is_aktif').is(":checked");
        var user_id       = "<?php echo $this->session->userdata['user_id'] ?>";

        if (id_gol_obat == "") {
            swal.fire('Peringatan', 'Kode tidak boleh kosong!', 'error');
            return false;
        }
        if (nama_gol_obat == "") {
            swal.fire('Peringatan', 'Golongan obat tidak boleh kosong!', 'error');
            return false;
        }

        var data={
            id_gol_obat  : id_gol_obat,
            nama_gol_obat: nama_gol_obat,
            is_aktif     : is_aktif,
            user_id      :"<?php echo $this->session->userdata['user_id'] ?>"
        };

        $.ajax({
            url     : "<?php echo base_url("farmasi/master/golongan/simpan"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                is_created: is_created,
                master    :data,
            },
            success:function(data, textStatus, jqXHR){
                if(data.error == 0){
                    swal.fire('Peringatan', data.message, 'error');
                }
                else{
                    swal.fire('Berhasil', data.message, 'success');
                }
                filter()
                $('#win').window('close'); 
            },
            error: function(jqXHR, textStatus, errorThrown){
                swal.fire('Error', 'something goes wrong', 'error');
            },
            complete: function(){
                $('#btn-save').prop('disabled', false);
                $('#btn-save').html('Save');
            }
        });
    }

    function hapus() {
        var row = $('#dtg-golongan').datagrid('getSelected');
        if (row == null) {
            swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
        return false;
        }

        data={
            id_gol_obat: row.id_gol_obat,
        }
        swal.fire({
            "title"            : "Konfirmasi",
            "text"             : "Apakah anda yakin ingin menghapus data ?",
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
                    url     : "<?php echo base_url("farmasi/master/golongan/hapus"); ?>",
                    type    : "POST",
                    dataType: 'json',
                    data    :{
                        data    : data,
                    },
                    beforeSend: function (){               
                    },
                    success:function(data, textStatus, jqXHR){
                        // $.messager.alert('Success',data.metadata.message);
                        swal.fire('Berhasil', data.message, 'success');
                        filter();
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        swal.fire('Error', 'something goes wrong', 'error');
                    },
                    complete: function(){
                    }
                }); 
            }
        });
    }

    function set_form(data) {
        if(is_created==0){
            $('#win').window('open');
            $('#txt-kode').val(data.id_gol_obat);
            $('#txt-gol_obat').val(data.nama_gol_obat);
            $('#txt-kode').attr('disabled',true);
            $('#txt-gol_obat').attr('readOnly',true);
            $('#chk-is_aktif').prop('checked', data.is_aktif);
            $('#div_simpan').hide();
        }
        else{
            $('#win').window('open');
            $('#txt-kode').val(data.id_gol_obat);
            $('#txt-gol_obat').val(data.nama_gol_obat);
            $('#txt-kode').attr('disabled',true);
            $('#txt-gol_obat').attr('readOnly',false);
            $('#chk-is_aktif').prop('checked', data.is_aktif);
            $('#div_simpan').show();
        }
    }

    function reset_form() {
        $('#txt-kode').val('');
        $('#txt-gol_obat').val('');
        $('#txt-kode').attr('disabled',false);
        $('#txt-gol_obat').attr('readOnly',false);
        $('#chk-is_aktif').prop('checked', false);
        $('#div_simpan').show();
    }
</script>