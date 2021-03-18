<script type="text/javascript">
	$(function(){
		filter();
		$('#dtg-registrasi_pasien').datagrid({
	        singleSelect:true,
	        idField:'itemid',
	        onDblClickRow:function(index,row){
	            //
	        },
	        columns:[[
	            {field:'id_mrs',title:'No. Register',width:"10%",halign:'center',align:'center'},
	            {field:'nama_lengkap',title:'Nama Lengkap',width:"25%",halign:'center',align:'left'},
	            {field:'sex',title:'Sex',width:"5%",halign:'center',align:'center'},
	            {field:'umur',title:'Umur',width:"13%",halign:'center',align:'left'},
	            {field:'no_mr',title:'No. MR',width:"10%",halign:'center',align:'center'},
	            {field:'tgl_mrs',title:'Tgl. MRS',width:"12%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
	            {field:'id_kamar',title:'No. Kamar',width:"10%",halign:'center',align:'center'},
	            {field:'kamar',title:'Nama Kamar',width:"9%",halign:'center',align:'left'},     
	            {field:'kelas',title:'Kelas',width:"9%",halign:'center',align:'center'},
	            {field:'ri_rj',title:'Perawatan',width:"10%",halign:'center',align:'center'},
	            {field:'nama_unit',title:'Nama Unit',width:"20%",halign:'center',align:'left'},
	            {field:'karyawan',title:'Karyawan',width:"15%",halign:'center',align:'left'},
	            {field:'asuransi',title:'Asuransi',width:"10%",halign:'center',align:'center'},
	            {field:'instansi',title:'Instansi',width:"15%",halign:'center',align:'left'},
	            {field:'admission',title:'Admission',width:"10%",halign:'center',align:'center'},
	            {field:'dpjp',title:'Dokter',width:"17%",halign:'center',align:'left'},
	        ]],
	    });
	})

	function filter(){
        // var dg = $('#dtg-retur_pembelian').datagrid('loadData', []);
        data= {
            jns_rawat:$('#cmb-perawatan').val(),
            criteria:$('#txt-kriteria').val(),
            page:1,
            page_row:10
        }

        var dg = $('#dtg-registrasi_pasien').datagrid({
          url : "<?php echo base_url("farmasi/depo/Registrasi_pasien/filter"); ?>",
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