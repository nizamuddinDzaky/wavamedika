<script type="text/javascript">
    $(function(){
        //
    })

    $('#dtg-belum_diserahkan').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'no_nota',title:'No. Nota',width:"12%",halign:'center',align:'center'},
            {field:'no_resep',title:'No. Resep',width:"12%",halign:'center',align:'center'},
            {field:'tgl_nota',title:'Tanggal',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'trans_name',title:'Jenis Nota',width:"25%",halign:'center',align:'left'},
            {field:'no_mr',title:'No. MR',width:"12%",halign:'center',align:'center'},
            {field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'action',title:'Action',width:"12%",align:'center',
                formatter:function(value,row,index){
                    // console.log(row.kd_item);
                    /*if (row.editing)
                    {*/
                    var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="ambil_obat_grid(this)" style="width: 64%;">Ambil Obat</button>';
                 /*   var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrow(this)">Cancel</button>';*/
                    return s;
                    /*} else if(!row.editing)
                    {
                        var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrow(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                        var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterow(this)">Delete</button>';
                        return e+d;
                    }*/
                }
            }
        ]],
        onEndEdit:function(index,row){
        },
        onBeforeEdit:function(index,row){
        },
        onAfterEdit:function(index,row){
        },
        onCancelEdit:function(index,row){
        }
    });

    $('#dtg-sudah_diserahkan').datagrid({
        singleSelect:true,
        idField:'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'no_nota',title:'No. Nota',width:"12%",halign:'center',align:'center'},
            {field:'no_resep',title:'No. Resep',width:"12%",halign:'center',align:'center'},
            {field:'tgl_nota',title:'Tanggal',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {field:'trans_name',title:'Jenis Nota',width:"25%",halign:'center',align:'left'},
            {field:'no_mr',title:'No. MR',width:"12%",halign:'center',align:'center'},
            {field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'action',title:'Action',width:"12%",align:'center',
                formatter:function(value,row,index){
                    var c = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="batal_ambil_nota(this)" style="width: 87%;">Batal Ambil Nota</button>';
                    return c;
                    
                }
            }
        ]],
        onEndEdit:function(index,row){
        },
        onBeforeEdit:function(index,row){
        },
        onAfterEdit:function(index,row){
        },
        onCancelEdit:function(index,row){
        }
    });

    function filter_belum_diserahkan() {
        $('#dtg-belum_diserahkan').datagrid('loadData',[]);
        var id_depo = $('#txt-id-depo').val();
        var criteria = $('#txt-criteria-belum-diserahkan').val();
      
        if (id_depo == '') {
            notif('warning','Data Depo Belum dipilih!');
            return false;
        }
        data={
          status : 1,
          id_depo : id_depo,
          criteria : criteria ? criteria : '',
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-belum_diserahkan').datagrid({
          url : "<?php echo base_url("farmasi/depo/Penyerahan_obat/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.rows ? data.rows : []
            }
          }
        });
    }

    function aksi_obat_nota(nota, aksi) {
        data={
          aksi : aksi,
          no_nota : nota,
        }
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/Penyerahan_obat/ambil_obat_grid"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            notif('success',data.message);
            filter_belum_diserahkan();
            filter_sudah_diserahkan();
            $('#win-pilih_nota').window('close');
          },
          error: function(jqXHR, textStatus, errorThrown){
              // alert('Error,something goes wrong');
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function ambil_obat_grid(target) {
        var row = $('#dtg-belum_diserahkan').datagrid('getRows')[getRowIndex(target)];
        /*console.log(row);*/
        aksi_obat_nota(row.no_nota, 1);
    }

    function batal_ambil_nota(target) {
        var row = $('#dtg-sudah_diserahkan').datagrid('getRows')[getRowIndex(target)];
        /*console.log(row);*/
        aksi_obat_nota(row.no_nota, 2);
    }

    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function btn_ambil_obat() {

        var id_depo = $('#txt-id-depo').val();
        var no_resep = $('#txt-no_resep').val();
        if (id_depo == '') {
            notif('warning','Data Depo Belum dipilih!');
            return false;
        }
        if (no_resep == '') {
            notif('warning','Data Resep Tidak Boleh Kosong!');
            return false;
        }
        data={
          aksi : 1,
          no_resep : no_resep,
          id_depo : id_depo
        }
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/Penyerahan_obat/btn_ambil_obat"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if (data.success) {
                notif('success',data.message);
            }else if(!data.success && data.status_code != '500'){
                show_popup_nota(data.nota)
            }else{
                notif('error','Data Kosong');
            }
            // filter_belum_diserahkan();
          },
          error: function(jqXHR, textStatus, errorThrown){
              
              notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function show_popup_nota(dataNota) {
        $('#win-pilih_nota').window('open');
        $('#dtg-pilih-nota').datagrid('loadData', dataNota);
    }

    function pilih_nota() {
        var row = $('#dtg-pilih-nota').datagrid('getSelected');
        if(row <= 0)
        {
          notif('warning','Data Belum dipilih!');
          return false;
        }
        aksi_obat_nota(row.no_nota,1);
    }

    function tutup_win_nota() {
        $('#win-pilih_nota').window('close');
    }

    function show_popup_depo() {
        $('#win-depo').window('open');
        var dg = $('#dtg-pilih-depo').datagrid({
          url : "<?php echo base_url("farmasi/depo/Penyerahan_obat/filter_depo"); ?>",
          method: "POST",
          /*    */
          loadFilter: function(data) {
            return {
              total: data.row_count ? data.row_count : 0, 
              rows: data.data ? data.data : []
            }
          }
        });
    }

    function pilih_depo() {
        var row = $('#dtg-pilih-depo').datagrid('getSelected');
        if(row <= 0)
        {
          notif('warning','Data Belum dipilih!');
          return false;
        }
        $('#txt-id-depo').val(row.id_unit);
        $('#btn-pilih-unit').text(row.nama_unit);
        tutup_win_depo();
    }

    function tutup_win_depo() {
        $('#win-depo').window('close');
    }

    function filter_sudah_diserahkan() {
        $('#dtg-sudah_diserahkan').datagrid('loadData',[]);
        var id_depo = $('#txt-id-depo').val();
        var criteria = $('#txt-criteria-belum-diserahkan').val();
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date = toAPIDateFormat($('#dtb-end_date').val());
        var criteria = $('#txt-criteria').val();

        if (id_depo == '') {
            notif('warning','Data Depo Belum dipilih!');
            return false;
        }
        data={
          status : 2,
          id_depo : id_depo,
          criteria : criteria ? criteria : '',
          page:1,
          tgl1 : start_date,
          tgl2 : end_date,
          page_row:10
        } 

        var dg = $('#dtg-sudah_diserahkan').datagrid({
          url : "<?php echo base_url("farmasi/depo/Penyerahan_obat/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.rows ? data.rows : []
            }
          }
        });
    }
</script>