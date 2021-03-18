<script>
    $(function(){
        tab(0);
        $('#cmb-ruang').select2({
            placeholder:'Pilih Ruang'
        })
        $('#cmb-dokter').select2({
            placeholder:'Pilih Dokter'
        })
    })

    $('#dtg-pasien_kontrol').datagrid({
		singleSelect:true,
		idField:'itemid',
		onDblClickRow:function(index,row){
			btn_ubah();
		},
		columns:[[
			{field:'no_bpb',title:'Kategori',width:"30%",halign:'center',align:'Left'},
			{field:'tgl_bpb',title:'Rencana',width:"15%",halign:'center',align:'right'},
			{field:'partner_name',title:'Kontrol',width:"15%",halign:'center',align:'right'},
			{field:'total',title:'Persentase',width:"15%",halign:'center',align:'right'}
		]],
	});

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
            {field:'no_nota',title:'Kontrol',width:"12%",halign:'center',align:'left'},
            {field:'tgl_nota',title:'No. MRS',width:"12%",halign:'center',align:'center'},
            {field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'nama_pasie',title:'No. RM',width:"12%",halign:'center',align:'left'},
            {field:'nama_pasi',title:'No. Antri',width:"10%",halign:'center',align:'center'},
            {field:'jns_bayar',title:'Tgl. Kontrol',width:"12%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'jns_baya',title:'Sex',width:"10%",halign:'center',align:'center'},
            {field:'jns_bay',title:'Umur',width:"15%",halign:'center',align:'center'},
            {field:'jns_ba',title:'Nama Keluarga',width:"25%",halign:'center',align:'left'},
            {field:'jns_b',title:'Telephone/HP',width:"12%",halign:'center',align:'center'}
        ]],
    });

    function btn_detail() {
        tab(1);
    }

    function tab(tab) {
        if (tab==0) {
            $('#browse').show();
            $('#detail').hide();
        }
        else{{
            $('#browse').hide();
            $('#detail').show();
        }}
    }
</script>