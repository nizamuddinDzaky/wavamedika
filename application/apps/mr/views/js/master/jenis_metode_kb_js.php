<script type="text/javascript">
	var edit	       = -1; // -1:normal // 0:tambah // 1:edit
	var index_grid     = -1; // index grid // -1: index kosong
	var title_datagrid = "Daftar Jenis Metode KB";
	var id_datagrid    = "#dtg-jenis_metode_kb";
	
	$(function()
	{
		filter();
		$('#txt-kriteria').focus();
	});

	$('#txt-kriteria').bind('keydown', function(e){
       if (e.keyCode == 13)
       {
            filter();
       }
    });

	function btn_tambah()
    {
		index_grid = 0;
		edit       = 0;

		$(id_datagrid).datagrid('insertRow', {
			index: index_grid,
			row:{status:'P'}
		});

		$(id_datagrid).datagrid('selectRow',index_grid);
		$(id_datagrid).datagrid('beginEdit',index_grid);

		set_read(edit);
    }

	function btn_ubah()
    {
	  // body...
	  if(edit >= 0)
      {
          notif('warning','Pilih Simpan atau Batal Dahulu!');
          return false;
	  }

      var row = $(id_datagrid).datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum dipilih!');
          return false;
	  }

	  index_grid = $(id_datagrid).datagrid("getRowIndex", row);
	  
	  editrow(index_grid);
	}

	function btn_batal()
    {
      // body...
      cancelrow();
	}
	
	function btn_simpan()
    {
      // body...
      saverow();
	}
	
	function btn_hapus()
    {
	  // body...
	  if(edit >= 0)
      {
          notif('warning','Pilih Simpan atau Batal Dahulu!');
          return false;
	  }

      var row = $(id_datagrid).datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum dipilih!');
          return false;
	  }
	  index_grid = $(id_datagrid).datagrid("getRowIndex", row);
	  deleterow(index_grid,row.id_jnskb);
	}

	$(id_datagrid).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      columns:[[
        {field:'id_jnskb',title:'ID',width:'5%',halign:'center',align:'left'},//
        {field:'nama_kb',title:'Nama KB',width:'40%',halign:'center',align:'left',editor : {type:'textbox'}},
		{field:'keterangan',title:'Keterangan',width:'60%',halign:'center',align:'left',editor : {type:'textbox'}},
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

	function saverow()
    {
		var nama_kb_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'nama_kb'
        });
        var nama_kb = $(nama_kb_ed.target).textbox('getValue');

		var keterangan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'keterangan'
        });
        var keterangan = $(keterangan_ed.target).textbox('getValue');

		if (!nama_kb.replace(/\s/g, '').length) {
			notif('warning','Nama KB tidak boleh kosong!');  
			return false;
		}
		
		$(id_datagrid).datagrid('endEdit', index_grid);
		var row = $(id_datagrid).datagrid('getRows')[index_grid];
		let data_simpan = {nama_kb:nama_kb,keterangan:keterangan};

		if (edit==1){
			
			data_simpan['id_jnskb']=row.id_jnskb;
		}

		simpan(data_simpan);
    }

    function editrow(target)
    {
		edit       = 1;
		index_grid = target;

		$(id_datagrid).datagrid('beginEdit',target);
		
		set_read(edit);
    }

    function deleterow(target,id)
    {
        swal.fire(cohapus()).then(function(result) {
            if (result.value) {
				$(id_datagrid).datagrid('deleteRow', target);
				hapus(id);
            }
        });
    }

    function cancelrow()
    {
		$(id_datagrid).datagrid('cancelEdit', index_grid);

		if(edit==0)
		{
			$(id_datagrid).datagrid('deleteRow', index_grid);
		}

		edit       = -1;
		index_grid = -1;

		set_read(edit);
    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

	function filter()
	{
		if(edit >= 0)
		{
			notif('warning','Pilih Simpan atau Batal Dahulu!');
			return false;
		}

		set_read(edit);

		$(id_datagrid).datagrid('loadData',[]);
		var criteria = $('#txt-kriteria').val();
		$(id_datagrid).datagrid('unselectAll');
		
		$.ajax({
			url     : "<?php echo base_url("mr/master/Jenis_metode_kb/filter"); ?>",
			type    : "POST",
			dataType: 'json',
			data    : {criteria   : criteria},
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
            	// notif('success',data.message);
				$(id_datagrid).datagrid('loadData',data.data);
          	},
          	error: function(jqXHR, textStatus, errorThrown){
              	notif('error','something goes wrong');
          	},
          	complete: function(){
          	}
        });

		// var dg = $(id_datagrid).datagrid({
		//     url : "<?php echo base_url("mr/master/Jenis_metode_kb/filter"); ?>",
		//     method: "POST",
		// 	queryParams: data,
		//     loadFilter: function(data){
		//       	return {
		//         	total: data.metadata ? data.metadata.paging.rec_count : 0, 
		//         	rows: data.list ? data.list : []
		//       	}
		//     }
		// });
		  
	}

	function simpan(data)
	{
        $.ajax({
			url     : "<?php echo base_url("mr/master/Jenis_metode_kb/simpan"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				edit: edit,
            	data: data,
            },
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
				edit       = -1;
				index_grid = -1;
				filter();
				notif('success',data.message);
          	},
          	error: function(jqXHR, textStatus, errorThrown){
				notif('error','Error, Something woes wrong');
          	},
          	complete: function(){
          	}
        }); 
    }
	
	function hapus(id)
	{   
		let data = {id_jnskb: id}
        $.ajax({
			url     : "<?php echo base_url("mr/master/Jenis_metode_kb/hapus"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				data: data,
			},
			beforeSend: function (){               
			},
			success:function(data, textStatus, jqXHR){
				edit       = -1;
				index_grid = -1;
				filter();
				notif('success',data.message);           
			},
			error: function(jqXHR, textStatus, errorThrown){
				notif('error','Error, Something goes wrong');
			},
			complete: function(){
			}
		});
    }

	function set_read(param)
	{
		if (param<0) // ketika kondisi tidak dalam posisi edit dan tambah
		{	
			edit       = -1;
			index_grid = -1;

			$('#btn-tambah').show();
			$('#btn-hapus').show();
			$('#btn-ubah').show();

			$('#btn-simpan').hide();
			$('#btn-batal').hide();
		}
		else if(param==0) // ketika kondisi dalam posisi tambah
		{
			$('#btn-tambah').hide();
			$('#btn-hapus').hide();
			$('#btn-ubah').hide();

			$('#btn-simpan').show();
			$('#btn-batal').show();
		}
		else if(param==1) // ketika kondisi dalam posisi edit
		{
			$('#btn-tambah').hide();
			$('#btn-hapus').hide();
			$('#btn-ubah').hide();

			$('#btn-simpan').show();
			$('#btn-batal').show();
		}
	}
</script>