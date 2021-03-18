<script type="text/javascript">
	var edit	       = -1; // -1:normal // 0:tambah // 1:edit
	var index_grid     = -1; // index grid // -1: index kosong
	var title_datagrid = "Daftar Infeksi nosokomial";
	var id_datagrid    = "#dtg-infeksi_nosokomial";
	
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
	  deleterow(index_grid,row.id_infeksi);
	}

	$(id_datagrid).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      frozenColumns:[[
        {field:'id_infeksi',title:'ID',width:'5%',halign:'center',align:'left',hidden:'true'},//
        {field:'kategori',title:'Kategori',width:'15%',halign:'center',align:'left',editor : {type:'textbox'}},
      ]],
      columns:[[
        {field:'jenis',title:'Jenis',width:'15%',halign:'center',align:'left',
        formatter:function(value,row){
                return row.jenis || value;
            },
            editor:{
            type:'combobox',
            options:{
                panelHeight:'auto',
                panelMinHeight:50,
                panelMaxHeight:200,
                valueField:'jenis',
                textField :'jenis',
                url       :'<?php echo base_url("mr/master/Infeksi_nosokomial/list_jenis") ?>',
                required  :true
            }
            }
        },
        {field:'kode_kategori',title:'Kode Kategori',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'infeksi',title:'Infeksi',width:'20%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'kode_infeksi',title:'Kode Infeksi',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'grade',title:'Grade',width:'20%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'indikator',title:'Indikator',width:'20%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'kode_indikator',title:'Kode Indikator',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'satuan',title:'Satuan',width:'10%',halign:'center',align:'left',
        formatter:function(value,row){
                return row.satuan || value;
            },
            editor:{
            type:'combobox',
            options:{
                panelHeight:'auto',
                panelMinHeight:50,
                panelMaxHeight:200,
                valueField:'satuan',
                textField :'satuan',
                url       :'<?php echo base_url("mr/master/Infeksi_nosokomial/list_satuan") ?>',
                required  :true
            }
            }
        },
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
        var jenis_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'jenis'
        });
        var jenis = $(jenis_ed.target).combobox('getValue');

		var infeksi_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'infeksi'
        });
        var infeksi = $(infeksi_ed.target).textbox('getValue');

        var kategori_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'kategori'
        });
        var kategori = $(kategori_ed.target).textbox('getValue');

        var kode_kategori_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'kode_kategori'
        });
        var kode_kategori = $(kode_kategori_ed.target).textbox('getValue');

        var kode_infeksi_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'kode_infeksi'
        });
        var kode_infeksi = $(kode_infeksi_ed.target).textbox('getValue');

        var grade_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'grade'
        });
        var grade = $(grade_ed.target).textbox('getValue');

        var indikator_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'indikator'
        });
        var indikator = $(indikator_ed.target).textbox('getValue');

        var kode_indikator_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'kode_indikator'
        });
        var kode_indikator = $(kode_indikator_ed.target).textbox('getValue');

        var satuan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'satuan'
        });
        var satuan = $(satuan_ed.target).combobox('getValue');

		if (!kategori.replace(/\s/g, '').length) {
			notif('warning','kategori tidak boleh kosong!');  
			return false;
		}
		
		if (!kode_kategori.replace(/\s/g, '').length) {
			notif('warning','Kode Kategori tidak boleh kosong!');  
			return false;
        }
        
        if (!jenis.replace(/\s/g, '').length) {
			notif('warning','Jenis tidak boleh kosong!');  
			return false;
        }
        
        if (!infeksi.replace(/\s/g, '').length) {
			notif('warning','Infeksi tidak boleh kosong!');  
			return false;
		}

        if (!kode_infeksi.replace(/\s/g, '').length) {
			notif('warning','Kode Infeksi tidak boleh kosong!');  
			return false;
		}
		
		$(id_datagrid).datagrid('endEdit', index_grid);
		var row = $(id_datagrid).datagrid('getRows')[index_grid];
		let data_simpan = {
            jenis:jenis,
            infeksi:infeksi,
            kategori:kategori,
            kode_kategori:kode_kategori,
            kode_infeksi:kode_infeksi,
            grade:grade,
            indikator:indikator,
            kode_indikator:kode_indikator,
            satuan:satuan
            };

		if (edit==1){
			
			data_simpan['id_infeksi']=row.id_infeksi;
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
			url     : "<?php echo base_url("mr/master/Infeksi_nosokomial/filter"); ?>",
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
		//     url : "<?php echo base_url("mr/master/Infeksi_nosokomial/filter"); ?>",
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
			url     : "<?php echo base_url("mr/master/Infeksi_nosokomial/simpan"); ?>",
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
		let data = {id_infeksi: id}
        $.ajax({
			url     : "<?php echo base_url("mr/master/Infeksi_nosokomial/hapus"); ?>",
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