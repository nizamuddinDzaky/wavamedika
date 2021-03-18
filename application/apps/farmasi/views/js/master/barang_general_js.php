<script type="text/javascript">
	var icon_uncentang = "<?php echo base_url('assets/img/uncentang.png'); ?>";
	var icon_centang   = "<?php echo base_url('assets/img/centang_toska.png'); ?>";
    var satuan_besar;
    var satuan_kecil;
    var kelompok;
    var edit=0;
	$(function(){
		tab(0);
        get_satuan();
        get_kelompok();
		$('#btn-tambah_detail').click(function(event) {
			$('#txt-kriteria_supplier').val('');
  			filter_supplier();
  			$('#win-cari_supplier').window('open');
		});

		$('#nmb-rasio').numberbox({
	        'precision'       : 0,
	        'min'             : 1,
	        'required'        : false,
	        'groupSeparator'  :'.',
	        'decimalSeparator':',',
	        'align '          : 'right',
	    });        

        $('#nmb-harga_beli').numberbox({
            'precision'       : 0,
            'min'             : 1,
            'required'        : false,
            'groupSeparator'  : '.',
            'decimalSeparator': ',',
            'align '          : 'right',
        });

	    
	})

	$('#dtg-barang_general').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
        	{field:'id_item',title:'Kode',width:"12%",halign:'center',align:'left', hidden:true},
         	{field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
         	{field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
         	{field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
         	{field:'nama_kel_item',title:'Kelompok',width:"20%",halign:'center',align:'left'},
         	{field:'status_aktif',title:'Status',width:"10%",halign:'center',align:'left'},
         	{field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'left'},
         	{field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         	{field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'left'},     
         	{field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-supplier_detail').datagrid({
		onClickCell: function(index,field,row){
			if (field == 'icon' && row.icon!="")
			{
				row = $('#dtg-supplier_detail').datagrid('getRows');
				for (var i = 0 ; i < row.length; i++)
		        {
					row[i]['partner_id']   = row[i]['partner_id'];
					row[i]['partner_name'] = row[i]['partner_name'];
					if (index==i)
					{
						row[i]['is_default']   = true;
						row[i]['icon']         = '<img src='+icon_centang+'>';
					}
					else
					{
						row[i]['is_default']   = false;
						row[i]['icon']         = '<img src='+icon_uncentang+'>';
					}
		        }

		        $('#dtg-supplier_detail').datagrid('loadData', []);
		        $('#dtg-supplier_detail').datagrid('loadData', row);
		        unSelectDatagrid('#dtg-supplier_detail');
			}
		}
	});

    function filter(){
        var dg       = $('#dtg-barang_general').datagrid('loadData',[]);
        var status   = $('#cmb-status option:selected').val();
        var criteria = $('#txt-kriteria').val();
        $('#dtg-barang_general').datagrid('unselectAll');
        data={
			status  : status,
			criteria: criteria,
			page_row: 10,
			page    : 1,
        }

        var dg = $('#dtg-barang_general').datagrid({
            url     : "<?php echo base_url("farmasi/master/barang_general/filter"); ?>",
            method  : "POST",
            dataType:'json',
                      queryParams: data,
            loadFilter: function(data) {
                return {
                    total: data.paging ? data.paging.rec_count : 0, 
              		rows: data.data ? data.data : []
                }
            }
        });
    }

    function filter_supplier(){
        $('#dtg-supplier').datagrid('loadData', []);
        let criteria = $('#txt-kriteria_supplier').val();
        data = {
            criteria:criteria,
            page: 1,
            page_row: 10,
        }

        var dg = $('#dtg-supplier').datagrid({
          	url : "<?php echo base_url("farmasi/master/barang_general/filter_supplier"); ?>",
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

    function btn_ubah(){
        var row = $('#dtg-barang_general').datagrid('getSelected');
        if(row <= 0)
        {
            notif('Warning','Data Belum Di pilih.');
            return false;
        }
        edit = 1;
        reset_form();
        // set_read(false);
        get_data(row.id_item);
    }

    function get_data(no){
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/barang_general/getItem"); ?>",
            type    : "POST",
            dataType: 'json',
            async   : false,
            data    :{
                data:no,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
                tab(1);
                // $('#loader').css('display','none');
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function set_form(data){
        $('#txt-label_obat').text(data.master.nama_item);
        $('#txt-id_item').val(data.master.id_item);
        $('#txt-kode_item').val(data.master.kd_item);

        if(data.master.is_aktif==true)
        {
            $('#chk-is_aktif').checkbox({
                checked: true
            });
        }
        else
        {
            $('#chk-is_aktif').checkbox({
                checked: false
            });
        }
        $("#cmb-satuan_besar").empty();
        $("#cmb-satuan_besar").select2({ data: satuan_besar });
        $("#cmb-satuan_kecil").empty();
        $("#cmb-satuan_kecil").select2({ data: satuan_kecil });
        $("#cmb-kelompok").empty();
        $("#cmb-kelompok").select2({ data: kelompok });

        $('#txt-nama_item').val(data.master.nama_item);
        $('#cmb-kelompok').val(data.master.id_kel_item).change();
        $('#cmb-satuan_besar').val(data.master.id_satuan_besar).change();
        $('#nmb-rasio').numberbox('setValue',data.master.rasio);
        $('#cmb-satuan_kecil').val(data.master.id_satuan).change();
        $('#nmb-harga_beli').numberbox('setValue',data.master.hna);
        $('#txt-keterangan').val(data.master.ket_item);

        for (var i = 0; i < data.supplier.length; i++)
        {
        	if(data.supplier[i]['is_default']==true)
        	{
        		data.supplier[i]['icon']='<img src='+icon_centang+'>';
        	}
        	else
        	{
        		data.supplier[i]['icon']='<img src='+icon_uncentang+'>';
        	}
        }

        $('#dtg-supplier_detail').datagrid('loadData', data.supplier);
    }

    function pilih_supplier(){
        var data_grid = $('#dtg-supplier_detail').datagrid('getRows');;
		var row       = $('#dtg-supplier').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        console.log(data_grid);

        for (var i = 0 ; i < row.length; i++)
        {
			row[i]['partner_id']   = row[i]['partner_id'];
			row[i]['partner_name'] = row[i]['partner_name'];
            if (data_grid.length<1&&i==0)
            {
                row[i]['is_default']   = true;
                row[i]['icon']         = '<img src='+icon_centang+'>';
            }
            else
            {
                row[i]['is_default']   = false;
                row[i]['icon']         = '<img src='+icon_uncentang+'>';
            }
        }
  
        var cek;
        for (var i = 0; i < row.length; i++)
        {
            cek = 0;
            for (var j = 0; j < data_grid.length; j++)
            {
                if (data_grid[j]['partner_id']==row[i]['partner_id'])
                {
                    cek=1;
                }
            }

            if (cek==0)
            {
                data_grid.push(row[i]);
            }
        }

        $('#dtg-supplier_detail').datagrid('loadData', []);
        $('#dtg-supplier_detail').datagrid('loadData', data_grid);
        unSelectDatagrid('#dtg-supplier');

        // notif("success",row.length+" Berhasil Ditambahkan");
        $('#win-cari_supplier').window('close');
    }

    function hapus_detail()
    {
        swal.fire(cohapus()).then(function(result) {
            if (result.value) {
                var dg = $('#dtg-supplier_detail');
                var row = dg.datagrid('getSelected');
                    if(row){
                      var row_index = dg.datagrid('getRowIndex', row);
                      dg.datagrid('deleteRow', row_index);       
                    } 
            }
        });


    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function hapus()
    {
        let id_item = $('#txt-id_item').val();

        data={
			id_item: id_item,
			user_id: "<?php echo $this->session->userdata['user_id'] ?>"
        }

        swal.fire(cohapus()).then(function(result) {
          if (result.value) {
            $.ajax({
                url     : "<?php echo base_url("farmasi/master/Barang_general/hapus"); ?>",
                type    : "POST",
                dataType: 'json',
                data    :{
                    data: data,
                },
                beforeSend: function (){               
                },
                success:function(data, textStatus, jqXHR){
                    notif('success',data.message);
                    tab(0);                 
                },
                error: function(jqXHR, textStatus, errorThrown){
                    notif('error','Error, Something goes wrong');
                },
                    complete: function(){
                }
            });
          }
        });
    }

	function btn_tambah(){
        edit = 0;
        reset_form();
        tab(1);
    }

    function tab(tab){
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            $('#dtg-barang_general').datagrid('resize');
            reset_form();
            filter();
        }
        else{
            $('#browse').hide();
            $('#detail').show();
        }
    }

    function tutup(){
    	$('#win-cari_supplier').window('close');
    }

    function simpan(){
        var id_item         = $('#txt-id_item').val();
        var kd_item         = $('#txt-kode_item').val();
        var is_aktif        = ($('input[name=chk-is_aktif]:checked').val()!=undefined);
        var nama_item       = $('#txt-nama_item').val();
        var id_kel_item     = $('#cmb-kelompok option:selected').val();
        var id_satuan_besar = $('#cmb-satuan_besar option:selected').val();
        var rasio           = $('#nmb-rasio').val();
        var id_satuan       = $('#cmb-satuan_kecil option:selected').val();
        var hna             = $('#nmb-harga_beli').val();
        var ket_item        = $('#txt-keterangan').val();

        row = $('#dtg-supplier_detail').datagrid('getRows');
        var supplier = [];
        for (var i=0; i<row.length; i++) {
          supplier.push({
            partner_id: row[i]['partner_id'],
            is_default: row[i]['is_default']
          })
        }

        master={
            id_item        : id_item,
            kd_item        : kd_item,
            is_aktif       : is_aktif,
            nama_item      : nama_item,
            id_kel_item    : 1,
            id_satuan_besar: id_satuan_besar,
            rasio          : parseInt(rasio),
            id_satuan      : id_satuan,
            ket_item       : ket_item,
            hna            : parseInt(hna),
            user_id        : "<?php echo $this->session->userdata['user_id'] ?>",
        }

         $.ajax({
          url : "<?php echo base_url("farmasi/master/Barang_general/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master  : master,
            supplier: supplier,
            edit    : edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            
                swal.fire("success",data.message,'success')
                tab(0);
            
            // else{

            // }
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 

    }

    function reset_form(){

        $('#div-kd_item').hide();

        $("#cmb-satuan_besar").empty();
        $("#cmb-satuan_besar").select2({ data: satuan_besar });
        $("#cmb-satuan_kecil").empty();
        $("#cmb-satuan_kecil").select2({ data: satuan_kecil });
        $("#cmb-kelompok").select2({ data: kelompok });

        $('#txt-id_item').val('');
        $('#txt-kode_item').val('');
        $('#chk-is_aktif').checkbox({
            checked: true
        });
        $('#txt-nama_item').val('');
        $('#cmb-kelompok option:selected').val('').change();
        $('#cmb-satuan_besar option:selected').val('').change();
        $('#nmb-rasio').numberbox('setValue',1);
        $('#cmb-satuan_kecil option:selected').val('').change();
        $('#nmb-harga_beli').numberbox('setValue',1);
        $('#txt-keterangan').val('');
        $('#dtg-supplier_detail').datagrid('loadData',[]);

    }

    function get_satuan()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/master/barang_general/getSatuan"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-satuan_besar").select2({ data: data });
               satuan_besar=data;
               $("#cmb-satuan_kecil").select2({ data: data });
               satuan_kecil=data;
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_kelompok()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/master/barang_general/getKelompok"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-kelompok").select2({ data: data });
               kelompok=data;
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','something goes wrong');
            },
            complete: function(){
            }
        });
    }
</script>