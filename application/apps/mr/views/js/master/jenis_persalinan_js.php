<script type="text/javascript">
	var edit	   = -1; // -1:normal // 0:tambah // 1:edit
	var index_grid = -1; // index grid // -1: index kosong
	var title_datagrid = "Daftar";
	var id_datagrid_a  = "#dtg-jenis";
    var id_datagrid_b  = "#dtg-komplikasi";
    var id_datagrid_c  = "#dtg-jenis_sc";
    var id_datagrid

    var tab_aktif      = 1;
	
	$(function()
	{
        tab(1);
		filter();
		$('#txt-kriteria').focus();
	});

    function tab(params)
    {
        if (params==1) {
            id_datagrid = id_datagrid_a;
        }
        else if (params==2) {
            id_datagrid = id_datagrid_b;
        }
        else if (params==3) {
            id_datagrid = id_datagrid_c;
        }

        tab_aktif  = params;
        
        cancelrow();

        filter();
    }

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
      let id_hapus;
      if (tab_aktif==1) {
            id_hapus = row.id_persalinan;
      }
      else if (tab_aktif==2) {
            id_hapus = row.id_jnskomplikasipersalinan;
      }
      else if (tab_aktif==3) {
            id_hapus = row.jenis;
      }

	  deleterow(index_grid,id_hapus);
	}

	$(id_datagrid_a).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      columns:[[
        {field:'id_persalinan',title:'ID',width:'5%',halign:'center',align:'left', hidden:true},
        {field:'nama_persalinan',title:'Nama Persalinan',width:'35%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'keterangan',title:'Keterangan',width:'65%',halign:'center',align:'left',editor : {type:'textbox'}},
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

    $(id_datagrid_b).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      columns:[[
        {field:'id_jnskomplikasipersalinan',title:'ID',width:'5%',halign:'center',align:'left', hidden:true},
        {field:'nama_komplikasipersalinan',title:'Nama Komplikasi Persalinan',width:'35%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'keterangan',title:'Keterangan',width:'65%',halign:'center',align:'left',editor : {type:'textbox'}},
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
    
    $(id_datagrid_c).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      columns:[[
        {field:'old_jenis',title:'ID',width:'5%',halign:'center',align:'left',hidden:true},
        {field:'jenis',title:'Jenis',width:'95%',halign:'center',align:'left',editor : {type:'textbox'}},
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
        let data_simpan = [];

        if (tab_aktif==1) {
            data_simpan = data_simpan_jenis();
        }
        else if (tab_aktif==2) {
            data_simpan = data_simpan_komplikasi();
        }
        else if (tab_aktif==3) {
            data_simpan = data_simpan_jenis_sc();
        }

		simpan(data_simpan);
    }

    function data_simpan_jenis()
    {
        var nama_persalinan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'nama_persalinan'
        });
        var nama_persalinan = $(nama_persalinan_ed.target).textbox('getValue');

        var keterangan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'keterangan'
        });
        var keterangan = $(keterangan_ed.target).textbox('getValue');

		if (!nama_persalinan.replace(/\s/g, '').length) {
			notif('warning','Nama Persalinan tidak boleh kosong!');  
			return false;
		}
		
		$(id_datagrid).datagrid('endEdit', index_grid);
		var row = $(id_datagrid).datagrid('getRows')[index_grid];
		let data_simpan = {nama_persalinan:nama_persalinan,keterangan:keterangan};

		if (edit==1){
			
			data_simpan['id_jnspersalinan']=row.id_jnspersalinan;
		}

        return data_simpan;
    }

    function data_simpan_komplikasi()
    {
        var nama_komplikasipersalinan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'nama_komplikasipersalinan'
        });
        var nama_komplikasipersalinan = $(nama_komplikasipersalinan_ed.target).textbox('getValue');

        var keterangan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'keterangan'
        });
        var keterangan = $(keterangan_ed.target).textbox('getValue');

		if (!nama_komplikasipersalinan.replace(/\s/g, '').length) {
			notif('warning','Nama Komplikasi Persalinan tidak boleh kosong!');  
			return false;
		}
		
		$(id_datagrid).datagrid('endEdit', index_grid);
		var row = $(id_datagrid).datagrid('getRows')[index_grid];
		let data_simpan = {nama_komplikasipersalinan:nama_komplikasipersalinan,keterangan:keterangan};

		if (edit==1){
			
			data_simpan['id_jnskomplikasipersalinan']=row.id_jnskomplikasipersalinan;
		}

        return data_simpan;
    }

    function data_simpan_jenis_sc()
    {
        var jenis_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'jenis'
        });
        var jenis = $(jenis_ed.target).textbox('getValue');

        if (!jenis.replace(/\s/g, '').length) {
			notif('warning','Jenis tidak boleh kosong!');  
			return false;
		}
		
		$(id_datagrid).datagrid('endEdit', index_grid);
		var row = $(id_datagrid).datagrid('getRows')[index_grid];
		let data_simpan = {jenis:jenis};

		if (edit==1){
			
			data_simpan['old_jenis']=row.old_jenis;
		}

        console.table(data_simpan);

        return data_simpan;
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

        let url_con;
        if (tab_aktif==1) {
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/filter_jenis"); ?>";
        }
        else if (tab_aktif==2) {
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/filter_komplikasi"); ?>";
        }
        else if (tab_aktif==3) {
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/filter_jenis_sc"); ?>";
        }
		
		$.ajax({
			url     : url_con,
			type    : "POST",
			dataType: 'json',
			data    : {criteria   : criteria},
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
            	// notif('success',data.message);
                if (tab_aktif==3) {
                    for (let index = 0; index < data.data.length; index++) {
                        data.data[index]['old_jenis'] = data.data[index]['jenis'];
                    }   
                }
				$(id_datagrid).datagrid('loadData',data.data);
          	},
          	error: function(jqXHR, textStatus, errorThrown){
              	notif('error','something goes wrong');
          	},
          	complete: function(){
          	}
        });

		// var dg = $(id_datagrid).datagrid({
		//     url : "<?php echo base_url("mr/master/Jenis_pasien/filter"); ?>",
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
        let url_con;
        if (tab_aktif==1) {
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/simpan_jenis"); ?>";
        }
        else if (tab_aktif==2) {
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/simpan_komplikasi"); ?>";
        }
        else if (tab_aktif==3) {
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/simpan_jenis_sc"); ?>";
        }

        $.ajax({
			url     : url_con,
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
				notif('warning','Jenis Pasien tidak boleh kosong!');
          	},
          	complete: function(){
          	}
        }); 
    }
	
	function hapus(id)
	{   
        let data = [];
        let url_con;
        if (tab_aktif==1) {
            data = {id_jnspersalinan: id}
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/hapus_jenis"); ?>";
        }
        else if (tab_aktif==2) {
            data = {id_jnskomplikasipersalinan: id}
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/hapus_komplikasi"); ?>";
        }
        else if (tab_aktif==3) {
            data = {jenis: id}
            url_con = "<?php echo base_url("mr/master/Jenis_persalinan/hapus_jenis_sc"); ?>";
        }

        $.ajax({
			url     : url_con,
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

			$('.btn-tambah').show();
			$('.btn-hapus').show();
			$('.btn-ubah').show();

			$('.btn-simpan').hide();
			$('.btn-batal').hide();
		}
		else if(param==0) // ketika kondisi dalam posisi tambah
		{
			$('.btn-tambah').hide();
			$('.btn-hapus').hide();
			$('.btn-ubah').hide();

			$('.btn-simpan').show();
			$('.btn-batal').show();
		}
		else if(param==1) // ketika kondisi dalam posisi edit
		{
			$('.btn-tambah').hide();
			$('.btn-hapus').hide();
			$('.btn-ubah').hide();

			$('.btn-simpan').show();
			$('.btn-batal').show();
		}
	}
</script>