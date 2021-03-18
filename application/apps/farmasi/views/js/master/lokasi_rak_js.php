<script type="text/javascript">
	var edit = 0;
	var flagEditStatus = true;
	$(function(){
		get_select();
		filter();
		// $('#win').window('open');
		$('#btn-tambah').click(function(event) {
			$('#win').window('open');
			reset_form();
			edit = 0;
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

		$('#btn-hapus').click(function(){
            var row = $('#dg').datagrid('getSelected');
            if(row <= 0)
            {
                swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
                return false;
            }
            hapus(row);
        });

		$('#btn-batal').click(function(event) {
			$('#win').window('close');
		});

		$('#btn-filter').click(function(event) {
			filter();
		});

		$('#btn-simpan').click(function(event) {
			simpan();
		});
	})

	$('#dg').datagrid({
		onDblClickRow:function(index,row){
			$('#btn-ubah').trigger('click');
		},
	})

	function filter(){
		var dg = $('#dg').datagrid('loadData',[]);
		var id_unit = $('#cmb-unit option:selected').val();
		var criteria = $('#txt-kriteria').val();
		data = {
			id_unit : id_unit,
			criteria: criteria,
			page_row:10, 
    		page:1
		}
		console.log(data);
		var dg = $('#dg').datagrid({
          url : "<?php echo base_url("farmasi/master/Lokasi_rak/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              	total: data.metadata ? data.metadata.paging.rec_count : 0, 
        		rows : data.list ? data.list : []
            }
          }
        });
		// $.ajax({
		// 	url     : "<?php echo base_url("farmasi/master/Lokasi_rak/filter"); ?>",
		// 	type    : "POST",
		// 	dataType: 'json',
		// 	data    :
		// 	{
	 //        	data: data,
	 //        },
	 //    	success:function(data, textStatus, jqXHR){
	 //        	$('#dg').datagrid('loadData', data);
	 //      	},
	 //      	error: function(jqXHR, textStatus, errorThrown){
	 //          	alert('Error,something goes wrong');
	 //      	},
	 //      	complete: function(){
	 //        	$('#btn-save').prop('disabled', false);
	 //        	$('#btn-save').html('Save');
	 //      	}
	 //    });
	}

	function simpan(){
		let id_lokasi       = $('#txt-id').val();
		let kd_lokasi       = $('#txt-kode').val();
		let no_urut         = $('#txt-no_urut').val();
		let nama_lokasi     = $('#txt-nama_rak').val();
		let id_unit         = $('#cmb-unit_detail option:selected').val();
		let id_karyawan_pic = $('#cmb-pic_detail option:selected').val();
		var user_id			= "<?php echo $this->session->userdata['user_id'] ?>";

		if (kd_lokasi == ''||
        no_urut == ''||
        nama_lokasi == '' ||
        id_unit == '' ||
        id_karyawan_pic == ''||
        kd_lokasi == undefined ||
        no_urut == undefined ||
        nama_lokasi == undefined ||
        id_unit == undefined ||
        id_karyawan_pic == undefined)
        {
          	let msg = '<br>';
          	if (kd_lokasi == '' || kd_lokasi == undefined) {
            	msg += 'Kode Lokasi <br>';
          	}

          	if (no_urut == '' || no_urut == undefined) {
            	msg += 'No Urut <br>';
          	}

          	if (nama_lokasi == '' || nama_lokasi == undefined) {
            	msg += 'Nama Lokasi <br>';
          	}

          	if (id_unit == '' || id_unit == undefined) {
            	msg += 'Unit <br>';
          	}

          	if (id_karyawan_pic == '' || id_karyawan_pic == undefined) {
            	msg += 'PIC <br>';
          	}

          	swal.fire('Peringatan', msg + 'tidak boleh kosong', 'warning');
          	// $.messager.alert('Warning',msg + ' Tidak Boleh Kosong');
          	return false;
        }

        data={
			kd_lokasi      : kd_lokasi,
			no_urut        : no_urut,
			nama_lokasi    : nama_lokasi,
			id_unit        : id_unit,
			id_karyawan_pic: id_karyawan_pic,
			user_id        : "<?php echo $this->session->userdata['user_id'] ?>"
        }
        if (edit==1)
        {
        	data['id_lokasi']=id_lokasi;
        }
        console.log(data);
        $.ajax({
			url     : "<?php echo base_url("farmasi/master/lokasi_rak/simpan"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				edit: edit,
            	data: data
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
              	swal.fire('Error', 'something goes wrong', 'error');
          	},
          	complete: function(){
          	}
        }); 
    }

    function get_data(row){
		$.ajax({
			url     : "<?php echo base_url("farmasi/master/Lokasi_rak/getBarang"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
		    	data:row.id_lokasi,
		    },
		    success:function(data, textStatus, jqXHR){
		      $('#win').window({
		        onOpen: function(){
		          reset_form();
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
			$('#txt-id').val(data.id_lokasi);
			$('#txt-kode').val(data.kd_lokasi);
  			$('#txt-no_urut').val(data.no_urut);
  			$('#txt-nama_rak').val(data.nama_lokasi);
  			$('#cmb-unit_detail').val(data.id_unit).change();
  			// $('#cmb-unit_detail').combobox('setText',data.nama_unit);
  			$('#cmb-pic_detail').val(data.id_karyawan_pic).change();
  			// $('#cmb-pic_detail').combobox('setText',data.nama);
  			$('#txt-kode').attr('readonly',true);
  			$('#txt-no_urut').attr('readonly',true);
  			$('#txt-nama_rak').attr('readonly',true);
  			$('#cmb-unit_detail').attr('disabled',true);
  			$('#cmb-pic_detail').attr('disabled',true);
			$('#div_simpan').hide();
		}
		else{
			$('#txt-id').val(data.id_lokasi);
			$('#txt-kode').val(data.kd_lokasi);
  			$('#txt-no_urut').val(data.no_urut);
  			$('#txt-nama_rak').val(data.nama_lokasi);
  			$('#cmb-unit_detail').val(data.id_unit).change();
  			// $('#cmb-unit_detail').combobox('setText',data.nama_unit);
  			$('#cmb-pic_detail').val(data.id_karyawan_pic).change();
  			// $('#cmb-pic_detail').combobox('setText',data.nama);
  			$('#txt-kode').attr('readonly',false);
  			$('#txt-no_urut').attr('readonly',false);
  			$('#txt-nama_rak').attr('readonly',false);
  			$('#cmb-unit_detail').attr('disabled',false);
  			$('#cmb-pic_detail').attr('disabled',false);
			$('#div_simpan').show();
		}
	}

	function get_select(){
		$.ajax({
	        url : "<?php echo base_url("farmasi/master/Lokasi_rak/get_unit_all"); ?>",
	        type: "POST",
	        dataType: 'json',
	        beforeSend: function (){               
	        },
	        success:function(data, textStatus, jqXHR){
	           $("#cmb-unit").select2({
	           		data: data
	           	});
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	            swal.fire('Error', 'something goes wrong', 'error');
	        },
	        complete: function(){
	        }
	    });

	    $.ajax({
	        url : "<?php echo base_url("farmasi/master/Lokasi_rak/get_unit"); ?>",
	        type: "POST",
	        dataType: 'json',
	        beforeSend: function (){               
	        },
	        success:function(data, textStatus, jqXHR){
	           	$("#cmb-unit_detail").select2({
	           		dropdownParent: $('#win'),
	           		data: data
	       		});
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	            swal.fire('Error', 'something goes wrong', 'error');
	        },
	        complete: function(){
	        }
	    });

	    $.ajax({
	        url : "<?php echo base_url("farmasi/master/Lokasi_rak/get_karyawan"); ?>",
	        type: "POST",
	        dataType: 'json',
	        beforeSend: function (){               
	        },
	        success:function(data, textStatus, jqXHR){
	        	$("#cmb-pic_detail").select2({
	           		dropdownParent: $('#win'),
	           		data: data
	       		});
	        },
	        error: function(jqXHR, textStatus, errorThrown){
	            swal.fire('Error', 'something goes wrong', 'error');
	        },
	        complete: function(){
	        }
	    });	    
	}

    function reset_form(){
    	$('#txt-id').val('');
    	$('#txt-kode').val('');
		$('#txt-name_pro').val('');
		$('#txt-no_urut').val('');
		$('#txt-nama_rak').val('');
		$('#cmb-unit_detail').val('');
		$('#cmb-pic_detail').val('');

		$('#txt-kode').attr('readonly',false);
		$('#txt-no_urut').attr('readonly',false);
		$('#txt-nama_rak').attr('readonly',false);
		$('#cmb-unit_detail').attr('disabled',false);
		$('#cmb-pic_detail').attr('disabled',false);
		$('#div_simpan').show();
    }

    function hapus(row){
        var id_lokasi = row.id_lokasi;
        data={
			id_lokasi: id_lokasi,
			user_id    : "<?php echo $this->session->userdata['user_id'] ?>"
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
					url     : "<?php echo base_url("farmasi/master/Lokasi_rak/hapus"); ?>",
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
                      	alert('Error,something goes wrong');
                  	},
                  	complete: function(){
                  	}
                }); 
	        }
	    });
    }
</script>