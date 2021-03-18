<script type="text/javascript">
	var edit	   = -1; // -1:normal // 0:tambah // 1:edit
	var index_grid = -1; // index grid // -1: index kosong
	var title_datagrid = "Daftar Unit Rumah Sakit";
	var id_datagrid    = "#dtg-unit";
	
	$(function()
	{
		filter();
		$('#txt-kriteria').focus();
	});

	$(id_datagrid).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      columns:[[
        {field:'nama_unit',title:'Nama Unit',width:'40%',halign:'center',align:'left'},
        {field:'lokasi',title:'Lokasi',width:'30%',halign:'center',align:'left'},
        {field:'unit',title:'Unit',width:'10%',halign:'center',align:'left'},
        {field:'depo',title:'Depo',width:'10%',halign:'center',align:'left'},
        {field:'cc',title:'cc',width:'10%',halign:'center',align:'left'},
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

	function filter()
	{
		$.ajax({
			url     : "<?php echo base_url("mr/master/Unit_rs/filter"); ?>",
			type    : "POST",
			dataType: 'json',
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
		//     url : "<?php echo base_url("mr/master/Unit_rs/filter"); ?>",
		//     method: "POST",
		//     loadFilter: function(data){
		//       	return {
		//         	total: data.metadata ? data.metadata.paging.rec_count : 0, 
		//         	rows: data.list ? data.list : []
		//       	}
		//     }
		// });
		  
	}
</script>