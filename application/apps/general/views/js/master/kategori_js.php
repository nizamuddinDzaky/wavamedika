<script type="text/javascript">
	var edit = 0;
	var cat_coa = '';
	$(function(){
		filter();
		$('#btn-tambah').click(function(event) {
			$('#win-kategori').window('open');
			reset_form();
			edit = 0;
		});

		$('#btn-simpan').click(function(){
			// simpan();
		});

		$('#btn-hapus').click(function(){
            var row = $('#dtg-kategori').datagrid('getSelected');
            if(row <= 0)
            {
                swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
                return false;
            }
            hapus(row);
        });

		$('#btn-ubah').click(function(event) {
			reset_form();
			ubah();	
		});

		$('#btn-tampil').click(function(event) {
			/*flagEditStatus = true;
			var row = $('#dtg-kategori').datagrid('getSelected');
			if(row <= 0) {
		    	swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
		    	return false;
		    }*/
		    reset_form();
		    tampil();
			// get_data(row);
		});

		$('#btn-coa_hpp').click(function(event) {
			$('#win-coa_hpp').window('open');
		});
		$('#btn-batal_coa_hpp').click(function(event) {
			$('#win-coa_hpp').window('close');
		});

		$('#btn-coa_persediaan').click(function(event) {
			$('#win-coa_persediaan').window('open');
		});
		$('#btn-batal_coa_persediaan').click(function(event) {
			$('#win-coa_persediaan').window('close');
		});

		$('#btn-coa_pendapatan').click(function(event) {
			$('#win-coa_pendapatan').window('open');
		});
		$('#btn-batal_coa_pendapatan').click(function(event) {
			$('#win-coa_pendapatan').window('close');
		});

		$('#dtg-kategori').datagrid({
			iconcls:'icon-',
			singleselect:true,
			idField:'itemid',
			onDblClickRow:function(index,row){
				// flagEditStatus = false;
				// var row = $('#dtg-kategori').datagrid('getSelected');
				// get_data(row);
				// edit = 1;
			},
			columns:[[
	        	{field:'id_kel_item',title:'Kode',width:"12%",halign:'center',align:'center'},
	        	{field:'nama_kel_item',title:'Kategori',width:"25%",halign:'center',align:'left'},
	        	{field:'nama_tipe_item',title:'Tipe',width:"10%",halign:'center',align:'left'},
	        	{field:'coa_hpp',title:'COA HPP',width:"10%",halign:'center',align:'left'},
	        	{field:'coa_persediaan',title:'COA Persediaan',width:"15%",halign:'center',align:'left'},
	        	{field:'coa_pendapatan',title:'COA Pendapatan',width:"15%",halign:'center',align:'left'},
	        	{field:'jns_po',title:'Jenis PO',width:"9%",halign:'center',align:'left'},
	        	{field:'is_aktif',title:'Status',width:"10%",halign:'center',align:'center'},
	        	{field:'created_by',title:'User Entry',width:"10%",halign:'center',align:'center'},
	        	{field:'date_ins',title:'Tgl. Entry',width:"12%",halign:'center',align:'center',formatter:appGridDateTimeFormatter},
	        	{field:'updated_by',title:'User Update',width:"10%",halign:'center',align:'center'},
	        	{field:'date_upd',title:'Tgl. Update',width:"12%",halign:'center',align:'center',formatter:appGridDateTimeFormatter},
	      	]],
		});
	})

	function tutup(){
		$('#win-kategori').window('close');
	}

	function filter_kategori(param) {
		cat_coa = $(param).val();
		$('#dtg-'+cat_coa).datagrid('loadData', [])
        var criteria = $('#txt-kriteria_'+cat_coa).val();
        /*$('#txt-label_nopp').text($('#txt-nama_supplier').val())*/
        data = {
            criteria:criteria ? criteria : '',
            page_row:10,
            page:1 
        }

        var dg = $('#dtg-'+cat_coa).datagrid({
          url : "<?php echo base_url("farmasi/master/Kategori/filter_coa"); ?>",
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

	function pilih_coa() {
		var row = $('#dtg-'+cat_coa).datagrid('getSelected');
		$('#txt-'+cat_coa).val(row.coa_display);
		$('#txt-id-'+cat_coa).val(row.coa_id);
		$('#win-'+cat_coa).window('close');
	}

	function simpan() {
		var id_kel_item = $('#txt-id').val();  
		var nama_kel_item = $('#txt-kategori').val();
		var id_tipe_item = $('#cmb-item').val();  
		var kd_kel_item = $('#txt-kode').val();  
		var coa_id_hpp = $('#txt-id-coa_hpp').val();  
		var coa_id_persediaan = $('#txt-id-coa_persediaan').val();  
		var coa_id_pendapatan = $('#txt-id-coa_pendapatan').val();  
		var id_jns_po = $('#cmb-jenis').val();  
		var is_aktif = $('#chk-is_aktif').prop("checked"); 
		var user_id ="<?php echo $this->session->userdata['user_id'] ?>";


		var data = {
			id_kel_item : id_kel_item, 
			nama_kel_item : nama_kel_item, 
			id_tipe_item : id_tipe_item, 
			kd_kel_item : kd_kel_item, 
			coa_id_hpp : coa_id_hpp, 
			coa_id_persediaan : coa_id_persediaan, 
			coa_id_pendapatan : coa_id_pendapatan, 
			id_jns_po : id_jns_po, 
			is_aktif : is_aktif, 
			user_id : user_id, 
		}

		$.ajax({
          url : "<?php echo base_url("farmasi/master/Kategori/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit:edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
          	notif('success',data.message);
          	$('#win-kategori').window('close');
          	filter();
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
	}

	function filter() {
        var dg = $('#dtg-kategori').datagrid('loadData', []);
        data= {
            status:$('#cmb-status').val(),
            criteria:$('#txt-search').val(),
            page:1,
            page_row:10
        }

        var dg = $('#dtg-kategori').datagrid({
          url : "<?php echo base_url("farmasi/master/Kategori/filter"); ?>",
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

    function ubah() {
    	var row = $('#dtg-kategori').datagrid('getSelected');
		if(row <= 0) {
	    	swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
	    	return false;
	    }
		edit = 1;
		get_data(row);
    }

    function tampil() {
    	$('.div_simpan').hide();
    	var row = $('#dtg-kategori').datagrid('getSelected');
		if(row <= 0) {
	    	swal.fire('Peringatan', 'Data belum dipilih!', 'warning');
	    	return false;
	    }
		edit = 1;
		get_data(row);
    }

    function get_data(row) {
    	/*console.log(row);*/
		$.ajax({
			url : "<?php echo base_url("farmasi/master/Kategori/getPerKode"); ?>",
			type: "POST",
			dataType: 'json',
			data:{
				data: row.id_kel_item,
			},
			beforeSend: function (){               
			},
			success:function(data, textStatus, jqXHR){
				set_data(data);
				$('#win-kategori').window('open');
			},
			error: function(jqXHR, textStatus, errorThrown){
				notif('error','Error,something goes wrong');
			},
			complete: function(){
			}
		}); 
    }

    function set_data(data) {
    	$('#txt-id').val(data.id_kel_item);  
		$('#txt-kategori').val(data.nama_kel_item);
		$('#cmb-item').val(data.id_tipe_item).change();  
		$('#txt-kode').val(data.kd_kel_item);
		$('#txt-id-coa_hpp').val(data.coa_id_hpp);  
		$('#txt-id-coa_persediaan').val(data.coa_id_persediaan);  
		$('#txt-id-coa_pendapatan').val(data.coa_id_pendapatan);  
		$('#txt-coa_hpp').val(data.coa_hpp);  
		$('#txt-coa_persediaan').val(data.coa_persediaan);  
		$('#txt-coa_pendapatan').val(data.coa_pendapatan);  
		$('#cmb-jenis').val(data.id_jns_po).change();  
		$('#chk-is_aktif').prop("checked", data.is_aktif); 
    }

    function reset_form() {
    	$('.div_simpan').show();
    	$('#txt-id').val('');  
		$('#txt-kategori').val('');
		$('#cmb-item').val(1).change();  
		$('#txt-kode').val('');
		$('#txt-id-coa_hpp').val('');  
		$('#txt-id-coa_persediaan').val('');  
		$('#txt-id-coa_pendapatan').val('');  
		$('#txt-coa_hpp').val('');  
		$('#txt-coa_persediaan').val('');  
		$('#txt-coa_pendapatan').val('');  
		$('#cmb-jenis').val(1).change();  
		$('#chk-is_aktif').prop("checked", false); 
    }

    function hapus(row) {

		data={
			id_kel_item : row.id_kel_item,
			user_id: "<?php echo $this->session->userdata['user_id'] ?>"
		} 

		// console.log(data);

		swal.fire(cohapus()).then(function(result) {
			if (result.value) {
				$.ajax({
					url : "<?php echo base_url("farmasi/master/Kategori/hapus"); ?>",
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
</script>