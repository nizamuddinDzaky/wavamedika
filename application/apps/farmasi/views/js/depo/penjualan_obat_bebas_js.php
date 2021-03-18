<script type="text/javascript">
	$(function(){
		tab(0);
		$('#cmb-dokter').select2({
			placeholder:'Pilih Dokter'
		})
		$('#btn-cari_karyawan').click(function(event) {
			$('#win-karyawan').window('open');
		});
		$('#btn-cetak').click(function(event) {
			$('#win-cetak').window('open');
		});
	})

	$('#dtg-penjualan_obat_bebas').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
         	{field:'no_bpb',title:'No. Nota',width:"12%",halign:'center',align:'center'},
         	{field:'tgl_bpb',title:'Tgl. Nota',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
         	{field:'partner_name',title:'Jenis',width:"10%",halign:'center',align:'center'},
         	{field:'no_rt_pb',title:'NIK',width:"12%",halign:'center',align:'center'},
         	{field:'ket_bp',title:'Nama Karyawan',width:"25%",halign:'center',align:'left'},
         	{field:'ket_bpb',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
         	{field:'ket_b',title:'Alamat',width:"20%",halign:'center',align:'left'},
         	{field:'status_caption',title:'Dokter',width:"20%",halign:'center',align:'left'},
         	{field:'unit',title:'Unit',width:"15%",halign:'center',align:'left'},
         	{field:'total',title:'Total',width:"12%",halign:'center',align:'left', formatter:appGridNumberFormatter},
         	{field:'posting',title:'Status Posting',width:"12%",halign:'center',align:'left'},
         	{field:'proses',title:'Status Proses',width:"12%",halign:'center',align:'left'},
         	{field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
         	{field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         	{field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
         	{field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'no_bpb',title:'RCK',width:"10%",halign:'center',align:'left'},
         	{field:'tgl_bpb',title:'Obat/Alkes',width:"25%",halign:'center',align:'left'},
         	{field:'partner_name',title:'Kode',width:"10%",halign:'center',align:'left'},
         	{field:'no_rt_pb',title:'Satuan',width:"10%",halign:'center',align:'center'},
         	{field:'status_caption',title:'Jumlah',width:"12%",halign:'center',align:'right'},
         	{field:'unit',title:'Signa 1',width:"10%",halign:'center',align:'left'},
         	{field:'total',title:'Signa 2',width:"10%",halign:'center',align:'left'},
         	{field:'posting',title:'Harga',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
         	{field:'sub_total',title:'Sub Total',width:"12%",halign:'center',align:'right', formatter:appGridNumberFormatter},
        ]]
    });

	function btn_tambah(){
    	edit = 0;
        // reset_form();
        set_read();
        // get_gudang();
        tab(1);
    }

    function tab(tab){
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            // filter()
        }
        else{
            $('#browse').hide();
            $('#detail').show();
        }
    }

    function set_read(){
        if(edit==0){
            $('#div_status').hide();
            $('#btn-aksi').hide();
        }
        else{
            $('#div_status').show();
            $('#btn-aksi').show();
        }
    }

    function tutup(){
    	$('#win-karyawan').window('close');
    	$('#win-cetak').window('close');
    }
</script>