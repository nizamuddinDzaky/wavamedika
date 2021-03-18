<script type="text/javascript">
	$(function(){
		filter();
	});

	$('#dtg-nomor_batch').datagrid({
        iconCls:'icon-',
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'partner_name',title:'Supplier',width:"25%",halign:'center',align:'left'},
            {field:'tgl_bpb',title:'Tanggal',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'no_bpb',title:'No. BPB',width:"12%",halign:'center',align:'left'},
            {field:'no_faktur_sup',title:'No. Faktur',width:"12%",halign:'center',align:'left'},
            {field:'kd_item',title:'Nama Barang',width:"25%",halign:'center',align:'left', hidden:true},
            {field:'nama_item',title:'Nama Barang',width:"25%",halign:'center',align:'left'},
            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
            {field:'jml_bpb',title:'Jumlah',width:"5%",halign:'center',align:'right',
            formatter:appGridNumberFormatter,
            editor : {
	              'options' : {
	                  'required':true,
	                  'precision' : 0,
	                  'min' : 0,
	                  'groupSeparator' :'.',
	                  'decimalSeparator' :','
	              }
	        }},
            {field:'harga',title:'Harga Beli',width:"10%",halign:'center',align:'right',
            formatter:appGridNumberFormatter,
            editor : {
	              'options' : {
	                  'required':true,
	                  'precision' : 2,
	                  'min' : 0,
	                  'groupSeparator' :'.',
	                  'decimalSeparator' :','
	              }
	        }},     
            {field:'no_batch',title:'No. Batch',width:"15%",halign:'center',align:'left'},
            {field:'tgl_ed',title:'Kedaluwarsa',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'created_by',title:'Dibuat Oleh',width:"12%",halign:'center',align:'left'},
        ]],
    });

    function filter()
    {
        $('#dtg-nomor_batch').datagrid('loadData',[]);
        var criteria = $('#txt-criteria').val();
      
        data={
          criteria : criteria,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-nomor_batch').datagrid({
          url : "<?php echo base_url("farmasi/gudang/Nomor_batch/filter"); ?>",
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
</script>