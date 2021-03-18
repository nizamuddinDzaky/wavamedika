<script type="text/javascript">
    $(function(){
        get_kelompok()
        $('#cmb-kelompok').val(1);
        $('#cmb-kelompok').trigger('change');
        $('#cmb-kelompok').val(0);
        $('#cmb-kelompok').trigger('change');
        filter()

        $('#cmb-supplier').select2({
            placeholder:'Pilih Supplier',
        })

        $('#cmb-kelompok').select2({
            placeholder:'Pilih Depo',
        })
        $('#cmb-supplier').change(function () {
            filter_harga_beli($(this).val())
        })

        $('#cmb-depo').change(function () {
            filter_harga_pokok($(this).val())
        })
    })

    $('#dtg-harga_jual').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            get_supplier(row.id_item)
            get_depo(row.id_item)
        },
    });

    $('#dtg-harga_beli').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            filter_harga_pokok($('#cmb-depo').val())
        },
        columns:[[
            {field:'tgl_beli',title:'Tgl. BPB',width:"15%",halign:'center',align:'center',formatter:appGridDateFormatter},
            {field:'no_bpb',title:'No. BPB',width:"15%",halign:'center',align:'left'},
            {field:'partner_name',title:'Supplier',width:"30%",halign:'center',align:'left'},
            {field:'hna',title:'HNA',width:"15%",halign:'center',align:'right', formatter:appGridMoneyFormatter},
        ]],
    });

    $('#dtg-harga_pokok').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            filter_harga_jual_hna()
        },
        columns:[[
            {field:'tgl_hpp',title:'Tgl. HPP',width:"15%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'ref_no',title:'No. Transaksi',width:"15%",halign:'center',align:'center'},
            {field:'nama_unit',title:'Depo',width:"30%",halign:'center',align:'left'},
            {field:'nilai_hpp',title:'HPP',width:"15%",halign:'center',align:'right', formatter:appGridMoneyFormatter},
        ]],
    });

    $('#dtg-harga_jual_hna').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
            //
        },
        columns:[[
            {field:'tgl_hpp',title:'Tgl. Perubahan',width:"15%",halign:'center',align:'center',formatter:appGridDateFormatter},
            {field:'hna_awal',title:'HNA Awal',width:"15%",halign:'center',align:'left', formatter:appGridNumberFormatter},
            {field:'hna_baru',title:'HNA Baru',width:"15%",halign:'center',align:'left', formatter:appGridNumberFormatter},
            {field:'hna_updated_by',title:'User',width:"20%",halign:'center',align:'left'},
        ]],
    });

    function get_kelompok(){
        $.ajax({
            url       : "<?php echo base_url("farmasi/master/harga_jual/getKelompok"); ?>",
            type      : "POST",
            dataType  : 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#cmb-kelompok").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_supplier(id){
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/harga_jual/getSupplier"); ?>",
            type    : "POST",
            dataType: 'json',
            data    : {
                'id' : id
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#cmb-supplier").select2({ data: data });
                $("#cmb-supplier").change()
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_depo(id){
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/harga_jual/getDepo"); ?>",
            type    : "POST",
            dataType: 'json',
            data    : {
                'id' : id
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $('#cmb-depo').select2({ data: data });
                $('#cmb-depo').change()
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function filter(){
        var dg = $('#dtg-harga_jual').datagrid('loadData', []);
        data= {
            id_kel_item: parseInt($('#cmb-kelompok').val()),
            criteria   : $('#txt-criteria').val()
        } 

        var dg = $('#dtg-harga_jual').datagrid({
            url        : "<?php echo base_url("farmasi/master/harga_jual/filter"); ?>",
            method     : "POST",
            queryParams: data,
            loadFilter: function(data) {
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
                    rows: data.data ? data.data : []
                }
            }
        });
    }

    function filter_harga_beli(partnerId){
        // var dg = $('#dtg-retur_pembelian').datagrid('loadData', []);
        data= {
            id_item   :$('#dtg-harga_jual').datagrid('getSelected').id_item,
            partner_id:partnerId,
            page      :1,
            page_row  :10
        }

        var dg = $('#dtg-harga_beli').datagrid({
            url        : "<?php echo base_url("farmasi/master/harga_jual/filterHargaBeli"); ?>",
            method     : "POST",
            queryParams: data,
            loadFilter: function(data) {
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
                    rows: data.data ? data.data : []
                }
            }
        });
    }

    function filter_harga_pokok(unitId){
        // var dg = $('#dtg-retur_pembelian').datagrid('loadData', []);
        data= {
            id_item :$('#dtg-harga_jual').datagrid('getSelected').id_item,
            id_unit :unitId,
            page    :1,
            page_row:10
        }

        var dg = $('#dtg-harga_pokok').datagrid({
            url : "<?php echo base_url("farmasi/master/harga_jual/filterHargaPokok"); ?>",
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

    function filter_harga_jual_hna(){
        // var dg = $('#dtg-retur_pembelian').datagrid('loadData', []);
        data= {
            id_item :$('#dtg-harga_jual').datagrid('getSelected').id_item,
            page    :1,
            page_row:10
        }

        var dg = $('#dtg-harga_jual_hna').datagrid({
            url        : "<?php echo base_url("farmasi/master/harga_jual/filterHargaJualHNA"); ?>",
            method     : "POST",
            queryParams: data,
            loadFilter: function(data) {
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
                    rows: data.data ? data.data : []
                }
            }
        });
    }

    function cetak(){
        $('#loader').css('display','');
        data= {
            id_kel_item:$('#cmb-kelompok').val(),
            criteria   :$('#txt-criteria').val(),
            page       :1,
            page_row   :10,
            row        : 10,
            type_file  : 1,
            file_name  : 'DAFTAR HARGA JUAL FARMASI.pdf'
        }

        $.ajax({
            url     : "<?= base_url() ?>farmasi/master/harga_jual/cetakPDF",
            type    : "POST",
            dataType: 'json',   
            data    : data,
            success:function(data, textStatus, jqXHR){
                if (data.success === true) {
                    $('#loader').css('display','none');
                    $("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/file/"+data.file_name)
                    $("#form_file_surat_detail").modal("show");
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('info','Tidak Ada Data');
                $('#loader').css('display','none');
            },
            fail: function (e) {
                console.log('fail');    
                $('#loader').css('display','none');
            }
        });
    }

    function export_excel(){
        $('body').append($('<form/>')
        .attr({'action': ""+"<?= base_url() ?>farmasi/master/harga_jual/cetakPDF"+"", 'method': 'POST', 'id': 'replacer'})
        
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'type_file', 'value': ""+2+""})
        )
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'id_kel_item', 'value': ""+$('#cmb-kelompok').val()+""})
        )
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'criteria', 'value': ""+$('#txt-criteria').val()+""})
        ) 
        .append($('<input/>')
        .attr({'type': 'hidden', 'name': 'page', 'value':  ""+1+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'page_row', 'value':  ""+10+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'row', 'value':  ""+10+""})
        )
        .append($('<input/>')
          .attr({'type': 'hidden', 'name': 'file_name', 'value':  ""+'DAFTAR HARGA JUAL FARMASI.pdf'+""})
        ) 
     
        ).find('#replacer').submit();

        setInterval(function(){
            window.location.reload();
        }, 3000);
    }
</script>