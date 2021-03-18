<!-- Script easy ui -->
<script type="text/javascript">
    var edit = 0;
    $(function () {
        filter();
        $('#btn-tambah').click(function () {
            $('#win-data_supplier').window('open');
            reset_form();
            edit = 0;
        });
        $('#btn-simpan').click(function () {
            $('#frm-detail').submit();
        })
        $('#btn-batal').click(function () {
            $('#win-data_supplier').window('close');
        });
        $('#btn-filter').click(function(){
            filter();
        });
        $('#btn-ubah').click(function(){
            flagEditStatus = false;
            var row = $('#dtg-daftar_supplier').datagrid('getSelected');
            if (row <= 0) {
                swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
                return false;
            }
            get_data(row);
            edit = 1;
        });
        $('#btn-tampil').click(function(){
            flagEditStatus = true;
            var row = $('#dtg-daftar_supplier').datagrid('getSelected');
            if(row <= 0) {
                swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
                return false;
            }
            get_data(row);
        });
        $('#btn-simpan').click(function(event) {
            simpan();
            $('#win-data_supplier').window('close');
            filter();
        });
        $('#btn-hapus').click(function(){
            var row = $('#dtg-daftar_supplier').datagrid('getSelected');
            if(row <= 0){
                swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
                return false;
            }
            hapus(row);
        });
    });

    function filter(){
        var dg       = $('#dtg-daftar_supplier').datagrid('loadData',[]);
        var status   = $('#cmb-status option:selected').val();
        var criteria = $('#txt-kriteria').val();
        $('#dtg-daftar_supplier').datagrid('unselectAll');
            data={
                data_status: status,
                criteria   : criteria,
                page_row   : 10,
                page       : 1,
            }

        var dg = $('#dtg-daftar_supplier').datagrid({
            url     : "<?php echo base_url("farmasi/master/supplier/filter"); ?>",
            method  : "POST",
            dataType:'json',
                      queryParams: data,
            loadFilter: function(data) {
                return {
                    total: data.metadata ? data.metadata.paging.rec_count : 0, 
                    rows : data.list ? data.list : []
                }
            }
        });
    }

    function simpan(){
        var partner_id           = $('#txt-kode').val();
        var partner_name         = $('#txt-partner_name').val();
        var partner_address      = $('#txt-partner_address').val();
        var partner_phone        = $('#txt-partner_phone').val();
        var partner_fax          = $('#txt-partner_fax').val();
        var website              = $('#txt-website').val();
        var contact_person       = $('#txt-contact_person').val();
        var contact_person_phone = $('#txt-contact_person_phone').val();
        var email                = $('#txt-email').val();
        var is_active            = ($('input[name=chk-is_active]:checked').val()!=undefined);
        var user_id              = "<?php echo $this->session->userdata['user_id'] ?>";
      
        data={
            partner_id          :partner_id,
            partner_name        :partner_name,
            partner_address     :partner_address, 
            partner_phone       :partner_phone, 
            partner_fax         :partner_fax, 
            website             :website, 
            contact_person      :contact_person, 
            contact_person_phone:contact_person_phone, 
            email               :email,    
            is_active           :is_active ,
            user_id             :"<?php echo $this->session->userdata['user_id'] ?>",
        }
        console.log(data);
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/supplier/simpan"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                edit: edit,
                data: data,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $('#win-data_supplier').window('close');
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

    function get_data(row){
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/Supplier/getSupplier"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data:row.partner_id,
            },
            success:function(data, textStatus, jqXHR){
                $('#win-data_supplier').window({
                    onOpen: function(){
                        set_form(data);
                    }
                })  
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

    function set_form(data){
        if (flagEditStatus==true){
            $('#txt-kode').val(data.partner_id);
            $('#txt-kode').attr('disabled',true);
            $('#txt-partner_name').val(data.partner_name);
            $('#txt-partner_name').attr('disabled',false);     
            $('#txt-partner_address').val(data.partner_address);
            $('#txt-partner_address').attr('disabled',false);
            $('#txt-partner_phone').val(data.partner_phone);
            $('#txt-partner_phone').attr('disabled',false);
            $('#txt-partner_fax').val(data.partner_fax);
            $('#txt-partner_fax').attr('disabled',false);
            $('#txt-website').val(data.website);
            $('#txt-website').attr('disabled',false);
            $('#txt-contact_person').val(data.contact_person);
            $('#txt-contact_person').attr('disabled',false);
            $('#txt-contact_person_phone').val(data.contact_person_phone);
            $('#txt-contact_person_phone').attr('disabled',false);
            $('#txt-email').val(data.email);
            $('#txt-email').attr('disabled',false);
            $('#div-simpan').hide();
            $('#chk-is_active').attr('readonly',true);
            if(data.is_active==true){
                $('#chk-is_active').checkbox({
                    checked: true
                });
            }
            else{
                $('#chk-is_active').checkbox({
                    checked: false
                });
            }
        }
        else{
            $('#txt-kode').val(data.partner_id);
            $('#txt-kode').attr('disabled',true);
            $('#txt-partner_name').val(data.partner_name);
            $('#txt-partner_name').attr('disabled',false);     
            $('#txt-partner_address').val(data.partner_address);
            $('#txt-partner_address').attr('disabled',false);
            $('#txt-partner_phone').val(data.partner_phone);
            $('#txt-partner_phone').attr('disabled',false);
            $('#txt-partner_fax').val(data.partner_fax);
            $('#txt-partner_fax').attr('disabled',false);
            $('#txt-website').val(data.website);
            $('#txt-website').attr('disabled',false);
            $('#txt-contact_person').val(data.contact_person);
            $('#txt-contact_person').attr('disabled',false);
            $('#txt-contact_person_phone').val(data.contact_person_phone);
            $('#txt-contact_person_phone').attr('disabled',false);
            $('#txt-email').val(data.email);
            $('#txt-email').attr('disabled',false);
            $('#div-simpan').show();
            if(data.is_active==true){
                $('#chk-is_active').checkbox({
                    checked: true
                });
            }
            else{
                $('#chk-is_active').checkbox({
                    checked: false
                });
            }
        }
    }

    function reset_form(){
        $('#txt-kode').attr('disabled',false);
        $('#txt-kode').val('');
        $('#txt-partner_name').val('');
        $('#txt-partner_address').val('');
        $('#txt-partner_address').attr('disabled',false);
        $('#txt-partner_phone').val('');
        $('#txt-partner_phone').attr('disabled',false);
        $('#txt-partner_fax').val('');
        $('#txt-partner_fax').attr('disabled',false);
        $('#txt-website').val('');
        $('#txt-website').attr('disabled',false);
        $('#txt-contact_person').val('');
        $('#txt-contact_person').attr('disabled',false);
        $('#txt-contact_person_phone').val('');
        $('#txt-contact_person_phone').attr('disabled',false);
        $('#txt-email').val('');
        $('#txt-email').attr('disabled',false);
        $('#div-simpan').show();
        $('#chk-is_active').checkbox({
            checked: false
        });
    }

    function hapus(row){
        var partner_id = row.partner_id;
        var user_id    ="<?php echo $this->session->userdata['user_id'] ?>";
        data={
            partner_id: partner_id,
            user_id    : "<?php echo $this->session->userdata['user_id'] ?>",
        }
        console.log(data);
        swal.fire({
            "title"            : "Konfirmasi",
            "text"             : "Apakah anda yakin ingin menghapus data ?",
            "type"             : "warning",
            "showCancelButton" : true,
            "confirmButtonText": "Ya",
            "cancelButtonText" : "Tidak",
            "reverseButtons"   : false,
            "customClass"      : {
                "confirmButton": "btn-danger",
                "cancelButton" : "btn-secondary"
            }
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url     : "<?php echo base_url("farmasi/master/Supplier/hapus"); ?>",
                    type    : "POST",
                    dataType: 'json',
                    data    :{
                        data: data,
                    },
                    beforeSend: function (){               
                    },
                    success:function(data, textStatus, jqXHR){
                        swal.fire('Berhasil', data.metadata.message, 'success');
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
</script>
<!-- end script -->