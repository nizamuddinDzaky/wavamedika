<script type="text/javascript">
	var edit	   = -1; // -1:normal // 0:tambah // 1:edit
	var index_grid = -1; // index grid // -1: index kosong
	var title_datagrid = "Daftar Kamar";
	var id_datagrid    = "#dtg-kamar";
	
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

	$(id_datagrid).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      columns:[[
        {field:'nama_unit',title:'Nama Unit',width:'100%',halign:'center',align:'left'},
        // {field:'kelas',title:'Kelas',width:'30%',halign:'center',align:'left'},
        // {field:'no_kamar',title:'Nomor',width:'10%',halign:'center',align:'left'},
        // {field:'ri_rj',title:'Status',width:'10%',halign:'center',align:'left'},
        // {field:'tarif',title:'Tarif',width:'10%',halign:'center',align:'left'},
        // {field:'bed',title:'Bed',width:'10%',halign:'center',align:'left'},
        // {field:'lantai',title:'Lantai',width:'10%',halign:'center',align:'left'},
        // {field:'nama_kamar',title:'Keterangan',width:'10%',halign:'center',align:'left'},
        // {field:'tpp',title:'TPP',width:'10%',halign:'center',align:'left'},
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


    $(id_datagrid).datagrid({
        view: detailview,
        detailFormatter:function(index,row){
            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
        },
        onExpandRow: function(index,row){
            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
            ddv.datagrid({
                data:row.detail,
                fitColumns:true,
                singleSelect:true,
                rownumbers:true,
                loadMsg:'',
                height:'auto',
                columns:[[
                    {field:'nama_unit',title:'Nama Unit',width:'25%',halign:'center',align:'left'},
                    {field:'kelas',title:'Kelas',width:'5%',halign:'center',align:'left'},
                    {field:'no_kamar',title:'Nomor',width:'5%',halign:'center',align:'right',formatter: appGridNumberFormatter},
                    {field:'ri_rj',title:'Status',width:'10%',halign:'center',align:'left'},
                    {field:'tarif',title:'Tarif',width:'10%',halign:'center',align:'right',formatter: appGridNumberFormatter},
                    {field:'bed',title:'Bed',width:'5%',halign:'center',align:'left'},
                    {field:'lantai',title:'Lantai',width:'5%',halign:'center',align:'left'},
                    {field:'nama_kamar',title:'Keterangan',width:'30%',halign:'center',align:'left'},
                    {field:'tpp',title:'TPP',width:'5%',halign:'center',align:'left'},
                ]],
                onResize:function(){
                    $(id_datagrid).datagrid('fixDetailRowHeight',index);
                },
                onLoadSuccess:function(){
                    setTimeout(function(){
                        $(id_datagrid).datagrid('fixDetailRowHeight',index);
                    },0);
                }
            });
            $(id_datagrid).datagrid('fixDetailRowHeight',index);
        }
    });

	function filter()
	{
        $(id_datagrid).datagrid('loadData',[]);
		var criteria = $('#txt-kriteria').val();
		$(id_datagrid).datagrid('unselectAll');

		$.ajax({
			url     : "<?php echo base_url("mr/master/Kamar/filter"); ?>",
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
		//     url : "<?php echo base_url("mr/master/Kamar/filter"); ?>",
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