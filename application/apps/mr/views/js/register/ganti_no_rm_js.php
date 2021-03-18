<script type="text/javascript">
    var tabel_utama="dtg1";
    var mode=1;
    $(function(){
        $('#tbl1').show();
        $('#tbl2').hide();

        filter();
        $('#cmb-mode').change(function(argument) {
            table_pilihan($(this).val());
        });
        $('#cmb-mode').val(2);
        $('#cmb-mode').trigger('change');
        $('#cmb-mode').val(1);
        $('#cmb-mode').trigger('change');
    })

    //rekapitulasi
    $('#dtg1').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
            {field:'rekapitulasi',title:'Rekapitulasi',width:"20%",halign:'center',align:'left'},
            {field:'jns',title:'Jenis',width:"5%",halign:'center',align:'left'},
            {field:'jml',title:'Jumlah',width:"5%",halign:'center',align:'left'},
        ]],
    });

    //detail
    $('#dtg2').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
            {field:'mr_lama',title:'No. RM (Lama)',width:"12%",halign:'center',align:'left'},
            {field:'no_mr',title:'No. RM (Baru)',width:"12%",halign:'center',align:'left'},
            {field:'nama_lengkap',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'keterangan',title:'Keterangan',width:"15%",halign:'center',align:'left'},
            {field:'alasan',title:'Ulasan',width:"15%",halign:'center',align:'left'},
            {field:'operator',title:'Karyawan',width:"15%",halign:'center',align:'left'},
            {field:'tgl_input',title:'Tgl. Dibuat',width:"10%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    function table_pilihan(id){
        $('#tbl1').hide();
        $('#tbl2').hide();

        var nyala='#tbl'+id;
        tabel_utama = '#dtg'+id;
        $(nyala).show();
    }

    function filter()
    {
        $(tabel_utama).datagrid('loadData',[]);
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date   = toAPIDateFormat($('#dtb-end_date').val());
        mode = $('#cmb-mode').val();

        data = {start_date   : start_date,end_date   : end_date,mode : mode}
        
        var dg = $(tabel_utama).datagrid({
            url : "<?php echo base_url("mr/register/ganti_no_rm/filter"); ?>",
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