<script type="text/javascript">
	var tabel_utama="dtg1";
	var jenis= '';
	$(function(){
		$('#tbl1').show();
		$('#tbl2').hide();
		$('#tbl3').hide();
		$('#tbl4').hide();
		$('#tbl5').hide();
		$('#tbl6').hide();

		$('#cmb-jenis').change(function(argument) {
			jenis = $(this).val();
			table_pilihan($(this).val());
        });
        $('#cmb-jenis').val(2);
        $('#cmb-jenis').trigger('change');
        $('#cmb-jenis').val(1);
        $('#cmb-jenis').trigger('change');
        // set_form();
		$('#dtg1').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onRowContextMenu : function (e, index, row) {
	        	// console.log('asd');
	        	$(this).datagrid('selectRow',index);
	        	e.preventDefault();
	        	var row = $(this).datagrid('getSelected');
	        	show_menu(row, e);
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
	                    {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
			            {field:'harga',title:'Harga',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_paket',title:'Jml. Paket',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_npaket',title:'Jml. Non Paket',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'signa1',title:'Signa 1',width:"10%",halign:'center',align:'left'},
			            {field:'signa2',title:'Signa 2',width:"10%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg1').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg1').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg1').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg2').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onRowContextMenu : function (e, index, row) {
	        	// console.log('asd');
	        	$(this).datagrid('selectRow',index);
	        	e.preventDefault();
	        	var row = $(this).datagrid('getSelected');
	        	show_menu(row, e);
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
	                    {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
			            {field:'harga',title:'Harga',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_paket',title:'Jml. Paket',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_npaket',title:'Jml. Non Paket',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'signa1',title:'Signa 1',width:"10%",halign:'center',align:'left'},
			            {field:'signa2',title:'Signa 2',width:"10%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg2').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg2').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg2').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg3').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onRowContextMenu : function (e, index, row) {
	        	// console.log('asd');
	        	$(this).datagrid('selectRow',index);
	        	e.preventDefault();
	        	var row = $(this).datagrid('getSelected');
	        	show_menu(row, e);
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
	                    {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'nama_satuan',title:'Satuanssss',width:"10%",halign:'center',align:'center'},
			            {field:'harga',title:'Harga',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
	                ]],
	                onResize:function(){
	                    $('#dtg3').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg3').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg3').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg4').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onRowContextMenu : function (e, index, row) {
	        	// console.log('asd');
	        	$(this).datagrid('selectRow',index);
	        	e.preventDefault();
	        	var row = $(this).datagrid('getSelected');
	        	show_menu(row, e);
	        },
	        onExpandRow: function(index,row){
	        	console.log(index);
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
			            {field:'harga',title:'Harga',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_paket',title:'Jml. Paket',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_npaket',title:'Jml. Non Paket',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'signa1',title:'Signa 1',width:"10%",halign:'center',align:'left'},
			            {field:'signa2',title:'Signa 2',width:"10%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg4').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg4').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg4').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg5').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onRowContextMenu : function (e, index, row) {
	        	// console.log('asd');
	        	$(this).datagrid('selectRow',index);
	        	e.preventDefault();
	        	var row = $(this).datagrid('getSelected');
	        	show_menu(row, e);
	        },
	        onExpandRow: function(index,row){
	        	console.log(index);
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"6%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},
			            {field:'unit_tujuan',title:'Unit',width:"17%",halign:'center',align:'left'},
			            {field:'jml_mutasi',title:'Jumlah',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'hpp',title:'Harga',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'no_batch',title:'Keterangan',width:"18%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg5').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg5').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg5').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg6').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onRowContextMenu : function (e, index, row) {
	        	// console.log('asd');
	        	$(this).datagrid('selectRow',index);
	        	e.preventDefault();
	        	var row = $(this).datagrid('getSelected');
	        	show_menu(row, e);
	        },
	        onExpandRow: function(index,row){
	        	console.log(index);
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"6%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},
			            {field:'tgl_awal_gm',title:'Tanggal/Jam Awal',width:"13%",halign:'center',align:'left'},
			            {field:'tgl_akhir_gm',title:'Tanggal/Jam Akhir',width:"13%",halign:'center',align:'left'},
			            {field:'jml_jam',title:'Lama (Jam)',width:"13%",halign:'center',align:'left'},
			            {field:'jml_menit',title:'Lama (Menit)',width:"13%",halign:'center',align:'left'},
			            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'harga',title:'Harga',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'sub_total',title:'Sub Total',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
	                ]],
	                onResize:function(){
	                    $('#dtg6').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg6').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg6').datagrid('fixDetailRowHeight',index);
            }
        });
	})

	function table_pilihan(id){
		$('#tbl1').hide();
		$('#tbl2').hide();
		$('#tbl3').hide();
		$('#tbl4').hide();
		$('#tbl5').hide();
		$('#tbl6').hide();

		var nyala='#tbl'+id;
		tabel_utama = '#dtg'+id;
		$(nyala).show();
	}

	function filter() {
		var rpt_id = $('#cmb-jenis').val();
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date = toAPIDateFormat($('#dtb-end_date').val());
        var criteria = $('#txt-criteria').val();
      	// console.log(rpt_id);
		$('#dtg'+rpt_id).datagrid('loadData',[]);
        data={
          rpt_id : rpt_id,
          start_date : start_date,
          end_date : end_date,
          criteria : criteria,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg'+rpt_id).datagrid({
          url : "<?php echo base_url("farmasi/depo/Posting_control/filter"); ?>",
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

	function show_menu(row, e) {
		if (row.msg_posting) {
    		$('#div-msg_posting').show();
    		$('#div-msg_posting').data('value', row.msg_posting);
    		$('#div-msg_posting').children(".menu-text").text(row.msg_posting);
    	}else{
    		$('#div-msg_posting').hide();
    	}

    	if (row.msg_batal) {
    		$('#div-msg_batal').show();
    		$('#div-msg_batal').data('value', row.msg_batal);
    		$('#div-msg_batal').children(".menu-text").text(row.msg_batal);
    	}else{
    		$('#div-msg_batal').hide();
    	}

    	$('#mm').menu('show', {
    		left:e.pageX,
    		top:e.pageY
    	})
	}

	function get_value(value) {
    	if (value.toLowerCase() == 'posting') {
    		return 1;
    	}

    	if (value.toLowerCase() == 'un-posting') {
    		return 2;
    	}

    	if (value.toLowerCase() == 'batal') {
    		return 3;
    	}

    	if (value.toLowerCase() == 'un-batal') {
    		return 4;
    	}
    }

    function get_ref_no() {
		var row = $('#dtg'+jenis).datagrid('getSelected');
		if (jenis == 1) {
			return row.no_nota;
		}

		if (jenis == 2) {
			return row.no_nota;
		}

		if (jenis == 3) {
			return row.no_nota;
		}

		if (jenis == 4) {
			return row.no_nota;
		}

		if (jenis == 5) {
			return row.no_mutasi;
		}

		if (jenis == 6) {
			return row.no_nota;
		}

		return false;
	}

	function proses(data) {
		
		var rpt_id = $('#cmb-jenis').val();
		data={
          rpt_id : rpt_id,
          ref_no : get_ref_no(),
          value : get_value($(data).children(".menu-text").text()),
        } 
        
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/Posting_control/proses"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            filter()
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }
</script>