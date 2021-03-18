<script type="text/javascript">
    var tabel_utama="dtg1";
    var mode=1;
    $(function(){
        $('#tbl1').show();
        $('#tbl2').hide();

        filter();
        get_unit()
        get_dokter()
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
            {field:'kategori',title:'Kategori',width:"20%",halign:'center',align:'left'},
            {field:'rencana',title:'Rencana',width:"10%",halign:'center',align:'right'},
            {field:'kontrol',title:'Kontrol',width:"10%",halign:'center',align:'right'},
            {field:'aa',title:'%',width:"5%",halign:'center',align:'left'},
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
            {field:'id_rencanakontrol',title:'Kontrol',width:"12%",halign:'center',align:'right'},
            {field:'no_mr',title:'No. MRS',width:"12%",halign:'center',align:'right'},
            {field:'nama_lengkap',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'no_mr',title:'No. RM',width:"15%",halign:'center',align:'right'},
            {field:'no_antri',title:'No. Antri',width:"10%",halign:'center',align:'right'},
            {field:'tgl_rencana',title:'Tgl. Kontrol',width:"13%",halign:'center',align:'center',formatter:appGridDateFormatter},
            {field:'sex',title:'Sex',width:"5%",halign:'center',align:'left'},
            {field:'umur',title:'Umur',width:"15%",halign:'center',align:'left'},
            {field:'nama_keluarga',title:'Nama Keluarga',width:"15%",halign:'center',align:'left'},
            {field:'telepon',title:'Telepon/HP',width:"20%",halign:'center',align:'left'},
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
        var start_date  = toAPIDateFormat($('#dtb-start_date').val());
        var end_date    = toAPIDateFormat($('#dtb-end_date').val());
        var nama_unit   = $('#cmb-data_unit').val();
        var nama_dokter = $('#cmb-data_dokter').val();
        var kontrol     = $('#cmb-kontrol').val();
        mode = $('#cmb-mode').val();

        data = {start_date   : start_date,end_date   : end_date,mode : mode,nama_unit : nama_unit,nama_dokter:nama_dokter, kontrol : kontrol}
        
        var dg = $(tabel_utama).datagrid({
            url : "<?php echo base_url("mr/register/pasien_kontrol/filter"); ?>",
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

    function get_unit()
    {
        $.ajax({
            url : "<?php echo base_url("mr/register/pasien_kontrol/get_data_unit"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-data_unit").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_dokter()
    {
        $.ajax({
            url : "<?php echo base_url("mr/register/pasien_kontrol/get_data_dokter"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-data_dokter").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }
</script>