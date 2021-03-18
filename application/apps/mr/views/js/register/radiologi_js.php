<script type="text/javascript">
    var tabel_rekap ="#dtg-rekap";
    var tabel_detail="#dtg-detail";
    var tabel_utama

    $(function(){
        table_pilihan('rekap');
    });

    $('#cmb-mode').change(function(argument) {
        table_pilihan($(this).val());
    });

    //rekapitulasi
    $(tabel_rekap).datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },

        columns:[[
            {field:'rekapitulasi',title:'Rekapitulasi',width:"60%",halign:'center',align:'left'},
            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'left'},
        ]],
    });

    //detail
    $(tabel_detail).datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        frozenColumns:[[
            {field:'tgl_transaksi',title:'Tanggal',width:"12%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'id_mrs',title:'No. MRS',width:"12%",halign:'center',align:'left'},
            {field:'nama_lengkap',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},

        ]],
        columns:[[
            {field:'no_mr',title:'No. RM',width:"15%",halign:'center',align:'left'},
            {field:'sex',title:'Sex',width:"5%",halign:'center',align:'left'},
            {field:'umur',title:'Umur',width:"15%",halign:'center',align:'left'},
            {field:'alamat',title:'Alamat',width:"15%",halign:'center',align:'left'},

            {field:'pemerikasaan',title:'Pemerikasaan',width:"15%",halign:'center',align:'left'},
            {field:'golongan',title:'Golongan',width:"15%",halign:'center',align:'left'},
            {field:'jenis_sampel',title:'Kategori',width:"15%",halign:'center',align:'left'},
            {field:'pemerikasaan',title:'Nama Pemeriksaaan',width:"15%",halign:'center',align:'left'},
            
            {field:'kunjungan_unit',title:'Dari Unit',width:"15%",halign:'center',align:'left'},
            {field:'asuransi',title:'Asuransi',width:"15%",halign:'center',align:'left'},
            {field:'instansi',title:'Instansi',width:"15%",halign:'center',align:'left'},
            {field:'admission',title:'Admission',width:"15%",halign:'center',align:'left'},
            {field:'kelas',title:'kelas',width:"15%",halign:'center',align:'left'},
            {field:'pembayaran',title:'Pembayaran',width:"15%",halign:'center',align:'left'},
        ]],
    });

    function table_pilihan(param){

        $('.table-custom').hide();;

        var nyala='#tbl-'+param;
        tabel_utama = '#dtg-'+param;

        $(nyala).show();

        console.log(nyala);
        console.log(tabel_utama);
        console.log();

        filter();
    }

    function filter()
    {
        $(tabel_utama).datagrid('loadData',[]);
        
        let start_date = toAPIDateFormat($('#dtb-start_date').val());
        let end_date   = toAPIDateFormat($('#dtb-end_date').val());
        let mode       = $('#cmb-mode').val();

        data = {start_date   : start_date,end_date   : end_date,mode : mode}
        
        var dg = $(tabel_utama).datagrid({
            url : "<?php echo base_url("mr/register/Radiologi/filter"); ?>",
            method: "POST",
            queryParams: data,
            loadFilter: function(data){
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
                    rows: data.data ? data.data : []
                }
            }
        });

    }
</script>