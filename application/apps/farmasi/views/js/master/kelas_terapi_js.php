<script type="text/javascript">
	var edit = 0;
	var flagEditStatus=true;
	$(function(){
		filter();
		$('#btn-tambah').click(function(event) {
			$('#win-kelas_terapi').window('open');
			reset_form();
			edit = 0;
		});

		$('#btn-simpan').click(function(event) {
			simpan();
			$('#win').window('close');
			filter();
		});

		$('#btn-batal').click(function(event) {
			$('#win-kelas_terapi').window('close');
		});

		$('#btn-tampil').click(function(){
			flagEditStatus = true;
			var row = $('#dtg-kelas_terapi').datagrid('getSelected');
			if(row <= 0) {
		    	swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
		    	return false;
		    }
			get_data(row);
		});

		$('#dtg-kelas_terapi').datagrid({
			iconcls:'icon-',
			singleselect:true,
			idField:'itemid',
			onDblClickRow:function(index,row){
				$('#btn-ubah').trigger('click');
			},
			columns:[[
	        	{field:'id_kelas_terapi',title:'Kode',width:"10%",halign:'center',align:'left'},
	        	{field:'nama_kelas_terapi',title:'Kelas Terapi',width:"25%",halign:'left',align:'left'},
	        	{field:'is_aktif',title:'Status',width:"10%",halign:'center',align:'center'},
	        	{field:'created_by',title:'Dibuat Oleh',width:"15%",halign:'center',align:'center'},
	        	{field:'date_ins',title:'Tgl. Dibuat',width:"12%",halign:'center',align:'center',formatter:appGridDateTimeFormatter},
	        	{field:'updated_by',title:'Diubah Oleh',width:"15%",halign:'center',align:'center'},
	        	{field:'date_upd',title:'Tgl. Diubah',width:"12%",halign:'center',align:'center',formatter:appGridDateTimeFormatter},
	      	]],
		})
	});

	function filter(){
		var dg       = $('#dtg-kelas_terapi').datagrid('loadData',[]);
		var status   = $('#cmb-status option:selected').val();
		var criteria = $('#txt-search').val();
		$('#dtg-kelas_terapi').datagrid('unselectAll');
		data = {
			data_status: status,
			criteria   : criteria,
			page_row   : 10,
			page       : 1,
		}
		var dg = $('#dtg-kelas_terapi').datagrid({
		    url : "<?php echo base_url("farmasi/master/kelas_terapi/filter"); ?>",
		    method: "POST",
			queryParams: data,
		    loadFilter: function(data){
		      	return {
		        	total: data.paging ? data.paging.rec_count : 0, 
		        	rows: data.data ? data.data : []
		      	}
		    }
	  	});
	}

	$('#btn-ubah').click(function(){
		flagEditStatus = false;
		var row = $('#dtg-kelas_terapi').datagrid('getSelected');
		if (row <= 0) {
			swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
			return false;
		}
		get_data(row);
		edit = 1;
	});

	function get_data(row){
		$.ajax({
			url     : "<?php echo base_url("farmasi/master/kelas_terapi/getTerapi"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
		    	data:row.id_kelas_terapi,
		    },
		    success:function(data, textStatus, jqXHR){
		      $('#win-kelas_terapi').window({
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
			$('#txt-kode').val(data.id_kelas_terapi);
  			$('#txt-kode').attr('disabled',true);
			$('#txt-kelas_terapi').val(data.nama_kelas_terapi);
  			$('#txt-kelas_terapi').attr('readonly',true);
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
			$('#txt-kode').val(data.id_kelas_terapi);
  			$('#txt-kode').attr('disabled',true);
			$('#txt-kelas_terapi').val(data.nama_kelas_terapi);
  			$('#txt-kelas_terapi').attr('readonly',false);
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
		$('#txt-kelas_terapi').attr('readonly',false);
		$('#txt-kode').val('');
		$('#txt-kelas_terapi').val('');
		$('#chk-is_aktif').checkbox({
            checked: false
        });
		$('#div_simpan').show();
	}

	function simpan(){
		var id_kelas_terapi = $('#txt-kode').val();
		var kelas_terapi    = $('#txt-kelas_terapi').val();
		var is_aktif        = ($('input[name=chk-is_aktif]:checked').val()!=undefined);
		var user_id         = "<?php echo $this->session->userdata['user_id'] ?>";
      
        data={
			id_kelas_terapi : id_kelas_terapi,
			nama_kelas_terapi: kelas_terapi,
			is_aktif    : is_aktif,
			user_id     : "<?php echo $this->session->userdata['user_id'] ?>",
        }
        console.log(data);
        $.ajax({
			url     : "<?php echo base_url("farmasi/master/kelas_terapi/simpan"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				edit: edit,
            	data: data,
            },
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
            	$('#win-kelas_terapi').window('close');
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

	$('#btn-hapus').click(function(){
	    var row = $('#dtg-kelas_terapi').datagrid('getSelected');
	    if(row <= 0)
	    {
	        swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
	        return false;
	    }
	    hapus(row);
	});

    function hapus(row){
        var id_kelas_terapi = row.id_kelas_terapi;
        data={
			id_kelas_terapi: id_kelas_terapi,
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
					url     : "<?php echo base_url("farmasi/master/kelas_terapi/hapus"); ?>",
					type    : "POST",
					dataType: 'json',
					data    :{
                    	data: data,
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
</script>