<script type="text/javascript">
	var edit = 0;
	$(function(){
		filter();
		$('#btn-tambah').click(function(event) {
			$('#win').window('open');
			reset_form();
			edit = 0;
		});

		$('#btn-batal').click(function(event) {
			/* Act on the event */
			$('#win').window('close');
			reset_form();
		});

		$('#btn-filter').click(function(){
			filter();
		});

		$('#btn-ubah').click(function(){
			flagEditStatus = false;
			var row = $('#dg').datagrid('getSelected');
			if (row <= 0) {
				swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
				return false;
			}
			get_data(row);
			edit = 1;
		});

		$('#btn-tampil').click(function(){
			flagEditStatus = true;
			var row = $('#dg').datagrid('getSelected');
			if(row <= 0) {
		    	swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
		    	return false;
		    }
			get_data(row);
		});

		$('#btn-simpan').click(function(event) {
			simpan();
			// $('#win').window('close');
			// filter();
		});

		$('#btn-hapus').click(function(){
            var row = $('#dg').datagrid('getSelected');
            if(row <= 0)
            {
                swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
                return false;
            }
            hapus(row);
        });
	});

	function filter(){
		var dg       = $('#dg').datagrid('loadData',[]);
		var status   = $('#cmb-status option:selected').val();
		var criteria = $('#txt-search').val();
		$('#dg').datagrid('unselectAll');
		data = {
			data_status: status,
			criteria   : criteria,
			page_row   : 10,
			page       : 1,
		}
		var dg = $('#dg').datagrid({
		    url : "<?php echo base_url("farmasi/master/Produsen/filter"); ?>",
		    method: "POST",
			queryParams: data,
		    loadFilter: function(data){
		      	return {
		        	total: data.metadata ? data.metadata.paging.rec_count : 0, 
		        	rows: data.list ? data.list : []
		      	}
		    }
	  	});
	}

	function simpan(){
		var id_produsen   = $('#txt-kode').val();
		var nama_produsen = $('#txt-name_pro').val();
		var is_aktif      = ($('input[name=chk-is_aktif]:checked').val()!=undefined);
		var user_id       ="<?php echo $this->session->userdata['user_id'] ?>";

        if (id_produsen == "") {
	      	swal.fire('Peringatan', 'ID Produsen tidak boleh kosong!', 'warning');
	      	return false;
	    }

	    if (nama_produsen == "") {
	      	swal.fire('Peringatan', 'Nama Produsen tidak boleh kosong!', 'warning');
	      	return false;
	    }

        data={
			id_produsen  : id_produsen,
			nama_produsen: nama_produsen,
			is_aktif     : is_aktif,
			user_id      : '<?php echo $this->session->userdata['user_id'] ?>',
        }
        console.log(data);
        $.ajax({
			url     : "<?php echo base_url("farmasi/master/produsen/simpan"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				edit: edit,
            	data: data,
            },
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
            	$('#win').window('close');
            	// $.messager.alert('Success',data.metadata.message);
            	swal.fire('Berhasil', data.metadata.message, 'success');
            	filter();
          	},
          	error: function(jqXHR, textStatus, errorThrown){
              	// alert('Error,something goes wrong');
              	swal.fire('Error', 'something goes wrong', 'error');
          	},
          	complete: function(){
          	}
        }); 
    }

	function get_data(row){
		$.ajax({
			url     : "<?php echo base_url("farmasi/master/Produsen/getProdusen"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
		    	data:row.id_produsen,
		    },
		    success:function(data, textStatus, jqXHR){
		      $('#win').window({
		        onOpen: function(){
		          // reset_form();
		          set_form(data);
		          // set_readonly(flagEditStatus);
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
			$('#txt-kode').val(data.id_produsen);
  			$('#txt-name_pro').val(data.nama_produsen);
  			$('#txt-kode').attr('disabled',true);
			$('#txt-name_pro').attr('readonly',true);
			$('#div_simpan').hide();
			$('#chk-is_aktif').attr('readonly',true);
			if(data.is_aktif==true){
            	$('#chk-is_aktif').checkbox({
                	checked: true
            	});
            }else{
            	$('#chk-is_aktif').checkbox({
                	checked: false
            	});
            }
		}
		else{
			$('#txt-kode').val(data.id_produsen);
  			$('#txt-name_pro').val(data.nama_produsen);
  			$('#txt-kode').attr('disabled',true);
			$('#txt-name_pro').attr('readonly',false);
			$('#div_simpan').show();
			// $('#chk-is_aktif').attr('readonly',false);
			if(data.is_aktif==true){
            	// $('#chk-is_aktif').checkbox('check');
            	$('#chk-is_aktif').checkbox({
                	checked: true
            	});
            }else{
            	$('#chk-is_aktif').checkbox({
                	checked: false
            	});
            }
		}
	}

	function reset_form(){
		$('#txt-kode').attr('disabled',false);
		$('#txt-name_pro').attr('readonly',false);
		$('#txt-kode').val('');
		$('#txt-name_pro').val('');
		$('#div_simpan').show();
		$('#chk-is_aktif').checkbox({
            checked: false
        });
	}

	function hapus(row){
        var id_produsen = row.id_produsen;
        data={
			id_produsen: id_produsen,
			user_id    : "<?php echo $this->session->userdata['user_id'] ?>",
        }
        console.log(data);
        // swal.fire('Berhasil', data.metadata.message, 'success');
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
					url     : "<?php echo base_url("farmasi/master/produsen/hapus"); ?>",
					type    : "POST",
					dataType: 'json',
					data    :{
                    	data: data,
                    },
                  	beforeSend: function (){               
                   	},
                  	success:function(data, textStatus, jqXHR){
                    	// $.messager.alert('Success',data.metadata.message);
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