<script type="text/javascript">
	var edit	       = -1; // -1:normal // 0:tambah // 1:edit
	var index_grid     = -1; // index grid // -1: index kosong
	var title_datagrid = "Daftar Jenis Formulir";
	var id_datagrid    = "#dtg-jenis_formulir";

    var icon_uncentang = "<?php echo base_url('assets/img/uncentang.png'); ?>";
	var icon_centang   = "<?php echo base_url('assets/img/centang_toska.png'); ?>";
	
	$(function()
	{
		filter();
        $('#txt-kriteria').focus();
	});

    $('#chk-is_aktif').click(function(event) {
        filter();
    });

    $('#txt-kriteria').bind('keydown', function(e){
       if (e.keyCode == 13)
       {
            filter();
       }
    });

	function btn_tambah()
    {
		index_grid = 0;
		edit       = 0;

		$(id_datagrid).datagrid('insertRow', {
			index: index_grid,
			row:{status:'P'}
		});

		$(id_datagrid).datagrid('selectRow',index_grid);
		$(id_datagrid).datagrid('beginEdit',index_grid);

		set_read(edit);
    }

	function btn_ubah()
    {
	  // body...
	  if(edit >= 0)
      {
          notif('warning','Pilih Simpan atau Batal Dahulu!');
          return false;
	  }

      var row = $(id_datagrid).datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum dipilih!');
          return false;
	  }

	  index_grid = $(id_datagrid).datagrid("getRowIndex", row);
	  
	  editrow(index_grid);
	}

	function btn_batal()
    {
      // body...
      cancelrow();
	}
	
	function btn_simpan()
    {
      // body...
      saverow();
	}
	
	function btn_hapus()
    {
	  // body...
	  if(edit >= 0)
      {
          notif('warning','Pilih Simpan atau Batal Dahulu!');
          return false;
	  }

      var row = $(id_datagrid).datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum dipilih!');
          return false;
	  }
	  index_grid = $(id_datagrid).datagrid("getRowIndex", row);
	  deleterow(index_grid,row.kode_formulir);
	}

    $(id_datagrid).datagrid({
		onClickCell: function(index,field,row){
			if (field == 'icon' && row.aktif!="" && edit < 0)
			{
                let aktif = 0;
                
                row_grid = $(id_datagrid).datagrid('getRows')[index];
                
                if (row_grid.aktif==0){aktif = 1;}
                
                let data_simpan = {
                    kode_formulir:row_grid.kode_formulir,
                    aktif:aktif,
                    nama_formulir:row_grid.nama_formulir,
                    box:row_grid.box,
                    lama:row_grid.lama,
                    kode_lengkap:row_grid.kode_lengkap,
                    golongan:row_grid.golongan,
                    revisi:row_grid.revisi,
                    tahun:row_grid.tahun,
                    halaman:row_grid.halaman,
                    ply:row_grid.ply,
                    warna:row_grid.warna,
                    ukuran:row_grid.ukuran,
                    jenis:row_grid.jenis,
                    tintegera:row_grid.tintegera
                };

                simpan(data_simpan);
			}
		}
	});

	$(id_datagrid).datagrid({
      title:title_datagrid,
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
		btn_ubah();
      },
      frozenColumns:[[
        {field:'aktif',title:'Aktif',width:'5%',halign:'center',align:'center', hidden:true},//
        {field:'icon',title:'Aktif',width:'3%',halign:'center',align:'center'},//
        {field:'kode_formulir',title:'Kode Singkat',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'nama_formulir',title:'Nama formulir',width:'30%',halign:'center',align:'left',editor : {type:'textbox'}},
      ]],
      columns:[[
        {field:'box',title:'Box',width:'5%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'lama',title:'Kode Lama',width:'15%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'kode_lengkap',title:'Kode Lengkap',width:'15%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'golongan',title:'Golongan',width:'15%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'revisi',title:'Revisi Ke',width:'5%',halign:'center',align:'left',editor : {type:'numberbox'}},
        {field:'tahun',title:'Tahun',width:'5%',halign:'center',align:'left',editor : {type:'numberbox'}},//
        {field:'halaman',title:'Hal',width:'5%',halign:'center',align:'left',editor : {type:'numberbox'}},
        {field:'ply',title:'Ply',width:'5%',halign:'center',align:'left',editor : {type:'numberbox'}},
        {field:'warna',title:'Warna',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'ukuran',title:'Ukuran',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'jenis',title:'Jenis',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        {field:'tintegera',title:'Tinta',width:'10%',halign:'center',align:'left',editor : {type:'textbox'}},
        
      ]],
      onEndEdit:function(index,row){
          
      },
      onBeforeEdit:function(index,row){
          $(id_datagrid).datagrid('hideColumn', 'icon');

          row.editing = true;
          $(this).datagrid('refreshRow', index);
      },
      onAfterEdit:function(index,row){
          $(id_datagrid).datagrid('showColumn', 'icon');
          
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      },
      onCancelEdit:function(index,row){
          $(id_datagrid).datagrid('showColumn', 'icon');
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      }
    });

	function saverow()
    {
        var kode_formulir_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'kode_formulir'
        });
        var kode_formulir = $(kode_formulir_ed.target).textbox('getValue');

		var nama_formulir_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'nama_formulir'
        });
        var nama_formulir = $(nama_formulir_ed.target).textbox('getValue');

		var box_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'box'
        });
        var box = $(box_ed.target).textbox('getValue');

        var lama_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'lama'
        });
        var lama = $(lama_ed.target).textbox('getValue');

        var kode_lengkap_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'kode_lengkap'
        });
        var kode_lengkap = $(kode_lengkap_ed.target).textbox('getValue');

        var golongan_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'golongan'
        });
        var golongan = $(golongan_ed.target).textbox('getValue');

        var revisi_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'revisi'
        });
        var revisi = $(revisi_ed.target).numberbox('getValue');

        var tahun_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'tahun'
        });
        var tahun = $(tahun_ed.target).numberbox('getValue');

        var halaman_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'halaman'
        });
        var halaman = $(halaman_ed.target).numberbox('getValue');

        var ply_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'ply'
        });
        var ply = $(ply_ed.target).numberbox('getValue');

        var warna_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'warna'
        });
        var warna = $(warna_ed.target).textbox('getValue');

        var ukuran_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'ukuran'
        });
        var ukuran = $(ukuran_ed.target).textbox('getValue');

        var jenis_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'jenis'
        });
        var jenis = $(jenis_ed.target).textbox('getValue');

        var tintegera_ed = $(id_datagrid).datagrid('getEditor', {
            index: index_grid,
            field: 'tintegera'
        });
        var tintegera = $(tintegera_ed.target).textbox('getValue');

		if (!kode_formulir.replace(/\s/g, '').length) {
			notif('warning','Kode Formulir tidak boleh kosong!');  
			return false;
		}
		
		if (!nama_formulir.replace(/\s/g, '').length) {
			notif('warning','Nama Formulir tidak boleh kosong!');  
			return false;
        }

        tahun = tahun.toString();

        if (!revisi){revisi=0}
        if (!halaman){halaman=0}
        if (!ply){ply=0}
		
		$(id_datagrid).datagrid('endEdit', index_grid);
		var row = $(id_datagrid).datagrid('getRows')[index_grid];
		let data_simpan = {
            kode_formulir:kode_formulir,
            aktif:row.aktif,
            nama_formulir:nama_formulir,
            box:box,
            lama:lama,
            kode_lengkap:kode_lengkap,
            golongan:golongan,
            revisi:revisi,
            tahun:tahun,
            halaman:halaman,
            ply:ply,
            warna:warna,
            ukuran:ukuran,
            jenis:jenis,
            tintegera:tintegera
            };

		if (edit==1){
			
			data_simpan['kode_formulir']=row.kode_formulir;
		}
        else
        {
            data_simpan['aktif']=1;
        }

		simpan(data_simpan);
    }

    function editrow(target)
    {
		edit       = 1;
		index_grid = target;

		$(id_datagrid).datagrid('beginEdit',target);
		
		set_read(edit);
    }

    function deleterow(target,id)
    {
        swal.fire(cohapus()).then(function(result) {
            if (result.value) {
				$(id_datagrid).datagrid('deleteRow', target);
				hapus(id);
            }
        });
    }

    function cancelrow()
    {
		$(id_datagrid).datagrid('cancelEdit', index_grid);

		if(edit==0)
		{
			$(id_datagrid).datagrid('deleteRow', index_grid);
		}

		edit       = -1;
		index_grid = -1;

		set_read(edit);
    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

	function filter()
	{
		if(edit >= 0)
		{
			notif('warning','Pilih Simpan atau Batal Dahulu!');
			return false;
		}

		set_read(edit);

        let aktif = ($('input[name=chk-is_aktif]:checked').val()!=undefined);

        if (aktif==true)
        {
            aktif=1;
        }
        else
        {
            aktif=0;
        }

		$(id_datagrid).datagrid('loadData',[]);
		var criteria = $('#txt-kriteria').val();
		$(id_datagrid).datagrid('unselectAll');
		
		$.ajax({
			url     : "<?php echo base_url("mr/master/jenis_formulir/filter"); ?>",
			type    : "POST",
			dataType: 'json',
			data    : {criteria   : criteria, aktif:aktif},
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
            	// notif('success',data.message);
                for (let i = 0; i < data.data.length; i++)
                {
                    if(data.data[i]['aktif']==1)
                    {
                        data.data[i]['icon']='<img src='+icon_centang+'>';
                    }
                    else
                    {
                        data.data[i]['icon']='<img src='+icon_uncentang+'>';
                    }
                }
				$(id_datagrid).datagrid('loadData',data.data);
          	},
          	error: function(jqXHR, textStatus, errorThrown){
              	notif('error','something goes wrong');
          	},
          	complete: function(){
          	}
        });

        // data = {criteria:criteria, page: 1, page_row: 10}
		
        // var dg = $(id_datagrid).datagrid({
		//     url : "<?php echo base_url("mr/master/jenis_formulir/filter"); ?>",
		//     method: "POST",
		// 	queryParams: data,
		//     loadFilter: function(data){
		//       	return {
		//         	total: data.paging ? data.paging.rec_count : 0, 
		//         	rows: data.data ? data.data : []
		//       	}
		//     }
		// });
		  
	}

	function simpan(data)
	{
        $.ajax({
			url     : "<?php echo base_url("mr/master/jenis_formulir/simpan"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				edit: edit,
            	data: data,
            },
          	beforeSend: function (){               
           	},
          	success:function(data, textStatus, jqXHR){
				edit       = -1;
				index_grid = -1;
				filter();
				notif('success',data.message);
          	},
          	error: function(jqXHR, textStatus, errorThrown){
				notif('error','Error, Something woes wrong');
          	},
          	complete: function(){
          	}
        }); 
    }
	
	function hapus(id)
	{   
		let data = {kode_formulir: id}
        $.ajax({
			url     : "<?php echo base_url("mr/master/jenis_formulir/hapus"); ?>",
			type    : "POST",
			dataType: 'json',
			data    :{
				data: data,
			},
			beforeSend: function (){               
			},
			success:function(data, textStatus, jqXHR){
				edit       = -1;
				index_grid = -1;
				filter();
				notif('success',data.message);           
			},
			error: function(jqXHR, textStatus, errorThrown){
				notif('error','Error, Something goes wrong');
			},
			complete: function(){
			}
		});
    }

	function set_read(param)
	{
		if (param<0) // ketika kondisi tidak dalam posisi edit dan tambah
		{	
			edit       = -1;
			index_grid = -1;

			$('#btn-tambah').show();
			$('#btn-hapus').show();
			$('#btn-ubah').show();

			$('#btn-simpan').hide();
			$('#btn-batal').hide();
		}
		else if(param==0) // ketika kondisi dalam posisi tambah
		{
			$('#btn-tambah').hide();
			$('#btn-hapus').hide();
			$('#btn-ubah').hide();

			$('#btn-simpan').show();
			$('#btn-batal').show();
		}
		else if(param==1) // ketika kondisi dalam posisi edit
		{
			$('#btn-tambah').hide();
			$('#btn-hapus').hide();
			$('#btn-ubah').hide();

			$('#btn-simpan').show();
			$('#btn-batal').show();
		}
	}
</script>