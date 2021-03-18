<script type="text/javascript">
	var edit           = 0;
	var edit_detail    = 0;
	var detail_item    = [];
	var data_lokasi    = [];
    var data_select    = [];
	var icon_uncentang = "<?php echo base_url('assets/img/uncentang.png'); ?>";
	var icon_centang   = "<?php echo base_url('assets/img/centang_toska.png'); ?>";

	$(function()
	{
        get_select_all();
		tab(0);
	});

    $('#nmb-rasio').numberbox({
        'precision'       : 0,
        'min'             : 0,
        'required'        :true,
        'groupSeparator'  :'.',
        'decimalSeparator':',',
        'align '          : 'right',
    });

	$('#btn-tambah_lokasi_item').click(function(event) {
		get_select("getLokasi","#cmb-lokasi");
		$('#dtg-daftar_lokasi').datagrid('loadData', []);
		$('#win-tambah_lokasi_item').window('open');
	});

	$('#btn-hapus_lokasi_item').click(function(event) {
		var row = $('#dtg-lokasi_item').datagrid('getSelected');
	    swal.fire(cohapus()).then(function(result) {
            if (result.value)
            {
            	var index = $('#dtg-lokasi_item').datagrid('getRowIndex', row);
				$('#dtg-lokasi_item').datagrid('deleteRow', index);
				unSelectDatagrid('#dtg-lokasi_item');
            }
        });
	});

	$('#btn-tutup_lokasi').click(function(event) {
		$('#win-tambah_lokasi_item').window('close');
	});

	$('#btn-tambah_supplier').click(function(event) {
		$('#txt-criteria_supplier').val('');		
		$('#dtg-data_supplier').datagrid('loadData', []);
		filter_supplier();
		$('#win-cari_supplier').window('open');
	});

	$('#btn-hapus_supplier').click(function(event) {
		var row = $('#dtg-akses_transaksi').datagrid('getSelected');
	    swal.fire(cohapus()).then(function(result) {
            if (result.value)
            {
            	var index = $('#dtg-akses_transaksi').datagrid('getRowIndex', row);
				$('#dtg-akses_transaksi').datagrid('deleteRow', index);
				unSelectDatagrid('#dtg-akses_transaksi');
            }
        });
	});

	$('#btn-batal_supplier').click(function(event) {
		$('#win-cari_supplier').window('close');
	});

    $('#cmb-lokasi').on('select2:select', function (e) {
     	let data = e.params.data;
     	let daftar_lokasi = data_lokasi[data.id][0];
     	$('#dtg-daftar_lokasi').datagrid('loadData', []);
     	$('#dtg-daftar_lokasi').datagrid('loadData', daftar_lokasi);
    });

	$('#dtg-item_farmasi').datagrid({
		singleSelect :true,
		idField      :'itemid',
		onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
            {field:'id_item',title:'ID',width:"12%",halign:'center',align:'left',hidden:true},
            {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
            {field:'nama_item',title:'Nama Item',width:"35%",halign:'center',align:'left'},
            {field:'nama_satuan',title:'Satuan',width:"9%",halign:'center',align:'left'},
            {field:'nama_kel_item',title:'Kelompok',width:"10%",halign:'center',align:'left'},
            {field:'nama_gol_obat',title:'Golongan',width:"15%",halign:'center',align:'left'},
            {field:'nama_jns_obat',title:'Jenis',width:"15%",halign:'center',align:'left'},
            {field:'nama_kat_obat',title:'Kategori',width:"15%",halign:'center',align:'left'},
            {field:'nama_kelas_terapi',title:'Kelas Terapi',width:"15%",halign:'center',align:'left'},
            {field:'nama_bentuk_sd',title:'Bentuk Sediaan',width:"10%",halign:'center',align:'left'},
            {field:'is_for_rs',title:'For RS',width:"9%",halign:'center',align:'center'},
            {field:'is_for_nas',title:'For Nas',width:"9%",halign:'center',align:'center'},
            {field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'left'},
            {field:'date_ins',title:'Tgl. Dibuat',width:"12%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
            {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'left'},     
            {field:'date_upd',title:'Tgl. Diubah',width:"12%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
	});

	$('#dtg-akses_transaksi').datagrid({
		onClickCell: function(index,field,row){
			if (field == 'icon' && row.icon!="")
			{
				row = $('#dtg-akses_transaksi').datagrid('getRows');
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

		        $('#dtg-akses_transaksi').datagrid('loadData', []);
		        $('#dtg-akses_transaksi').datagrid('loadData', row);
		        unSelectDatagrid('#dtg-akses_transaksi');
			}
		}
	});

	function tambah_komposisi()
	{
	    $('#dtg-komposisi_obat').datagrid('insertRow', {
	      index: 0,
	      row:{
	        status:'P'
	      }
	    });

	    $('#dtg-komposisi_obat').datagrid('selectRow',0);
	    $('#dtg-komposisi_obat').datagrid('beginEdit',0);
	 }

	$('#dtg-komposisi_obat').datagrid({
		singleSelect:true,
		idField:'itemid',
		onDblClickRow:function(index,row){
			//
		},
		columns:[[
			// {field:'id_satuan_sd',title:'ID',width:"10%",halign:'center',align:'left',hidden:true},
			{field:'zat_sd',title:'Zat Sediaan',width:"50%",halign:'center',align:'left',editor:'textbox',
				styler: function(value,row,index){
					return {style:'text-transform: uppercase'}
				}
			},
            {field:'kekuatan_sd',title:'Kekuatan',width:"15%",halign:'center',align:'right',
        	formatter: numberFormat,
            editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        // 'decimalSeparator' :',',
                    }
                }
            },
      //       {field:'id_satuan_ed',title:'Satuan',width:"15%",halign:'center',align:'left',
	     //        editor:{
	     //        	type:'combogrid',
	     //            options:{
						// panelWidth :'30%',
						// panelHeight:'30%',
						// idField    : 'secode2',
						// textField  : 'section',
						// url        :"<?php echo base_url("farmasi/master/Item_farmasi/getSatuanKomposisiComboGrid"); ?>",
						// mode       : 'remote',
						// fitColumns :false,
	     //                columns: [[
	     //                  {field:'id_satuan',title:'ID Satuan',width:'30%'},
	     //                  {field:'nama_satuan',title:'Nama Satuan',width:'70%'},
	     //                ]]
	     //            }
	     //        }
      //   	},
      		{field:'id_satuan_sd',title:'Satuan',halign:'center',align:'left',width:150,
		      formatter:function(value,row){
		          return row.id_satuan_sd || value;
		      },
		      editor:{
		        type:'combobox',
		        options:{
					panelHeight:'auto',
				    panelMinHeight:50,
				    panelMaxHeight:200,
					valueField:'id_satuan_sd',
					textField :'nama_satuan_sd',
					url       :'<?php echo base_url('farmasi/master/Item_farmasi/getSatuanKomposisi') ?>',
					required  :true
		        }
		      }
		    },
            {field:'action',title:'Action',width:"12%",align:'center',
                formatter:function(value,row,index){
                
                    if (row.editing){
                        var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverow(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                        var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrow(this)">Cancel</button>';
                        return s+c;
                    } else {
                        var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrow(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                        var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterow(this)">Delete</button>';
                        return e+d;
                    }
                }
            }
		]],
		onEndEdit:function(index,row){

        },
        onBeforeEdit:function(index,row){
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }
	});

	function saverow(target)
	{
	    validate = $('#dtg-komposisi_obat').datagrid('validateRow', getRowIndex(target));
	    if (!validate) {
	        notif('warning','Komposisi Obat Tidak Boleh Kosong');
	        return false;
	    }
	    $('#dtg-komposisi_obat').datagrid('endEdit', getRowIndex(target));
	}

	function editrow(target){
	    $('#dtg-komposisi_obat').datagrid('beginEdit', getRowIndex(target));
	}

	function deleterow(target){
	    swal.fire(cohapus()).then(function(result) {
	          if (result.value) {
	            $('#dtg-komposisi_obat').datagrid('deleteRow', getRowIndex(target));
	          }
	    });
	}

	function cancelrow(target)
	{
	    $('#dtg-komposisi_obat').datagrid('cancelEdit', getRowIndex(target));
	}

	function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

	function batal()
	{
		$('#win-tambah_lokasi_item').window('close');
		$('#win-cari_supplier').window('close');
	}

	function tab(tab)
	{
		if(tab==0)
		{
			$('#browse').show();
			$('#detail').hide();
			filter();
		}
		else
		{
			$('#browse').hide();
			$('#detail').show();
		}
	}

	function btn_tambah()
	{
		edit = 0;
        reset_form();
        set_read(false);
        tab(1);
	}

	function btn_ubah()
    {
        var row = $('#dtg-item_farmasi').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }

        $('#loader').css('display','');

        edit = 1;
        
        reset_form();
        
        set_read(false);
        
        get_data(row.id_item);
    }

    function simpan()
    {
        var id_item         = $('#txt-id_item').val();
        var kd_item         = $('#txt-kd_item').val();
        var nama_item       = $('#txt-nama_item').val();   
        var is_aktif        = ($('input[name=chk-is_aktif]:checked').val()!=undefined);
        var is_for_rs       = ($('input[name=chk-rumah_sakit]:checked').val()!=undefined);
        var is_for_nas      = ($('input[name=chk-nasional]:checked').val()!=undefined);
        var id_kel_item     = $('#cmb-kelompok option:selected').val();   
        var id_gol_obat     = $('#cmb-golongan option:selected').val();
        var id_kat_obat     = $('#cmb-kategori option:selected').val();
        var id_bentuk_sd    = $('#cmb-bentuk option:selected').val();
        var id_satuan_besar = $('#cmb-satuan_besar option:selected').val();
        var id_produsen     = $('#cmb-produsen option:selected').val();
        var id_jns_obat     = $('#cmb-jenis option:selected').val();
        var id_kelas_terapi = $('#cmb-kelas_terapi option:selected').val();
        var id_satuan       = $('#cmb-satuan_kecil option:selected').val();
        var rasio           = $('#nmb-rasio').numberbox('getValue');
        var ket_item        = $('#txt-keterangan').val();
        var user_id         = "<?php echo $this->session->userdata['user_id'] ?>";
        
        if (kd_item == ''||nama_item == ''|| rasio == ''|| ket_item == ''|| id_kel_item == ''|| id_gol_obat == ''|| id_kat_obat == ''|| id_bentuk_sd == ''|| id_satuan_besar == ''|| id_produsen == ''|| id_jns_obat == ''|| id_kelas_terapi == ''|| id_satuan == '')
        {
          let msg = '<br>';

          if (kd_item == '') {
            msg += 'Kode Item <br>';
          }
          if (nama_item == '') {
            msg += 'Nama Item <br>';
          }
          if (id_kel_item == '') {
            msg += 'Kelompok <br>';
          }
          if (id_gol_obat == '') {
            msg += 'Golongan <br>';
          }
          if (id_kat_obat == '') {
            msg += 'Kategori <br>';
          }
          if (id_bentuk_sd == '') {
            msg += 'Bentuk <br>';
          }
          if (id_satuan_besar == '') {
            msg += 'Satuan Besar <br>';
          }
          if (rasio == '') {
            msg += 'Rasio <br>';
          }
          if (id_produsen == '') {
            msg += 'Produsen <br>';
          }
          if (id_jns_obat == '') {
            msg += 'Jenis <br>';
          }
          if (id_kelas_terapi == '') {
            msg += 'Kelas Terapi <br>';
          }
          if (ket_item == '') {
            msg += 'Keterangan <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        master={
            kd_item        : kd_item,
            is_aktif       : is_aktif,
            nama_item      : nama_item,
            id_produsen    : id_produsen, 
            id_kel_item    : id_kel_item, 
            id_gol_obat    : id_gol_obat, 
            id_jns_obat    : id_jns_obat,
            id_kat_obat    : id_kat_obat, 
            id_kelas_terapi: id_kelas_terapi, 
            id_bentuk_sd   : id_bentuk_sd, 
            id_satuan_besar: id_satuan_besar, 
            rasio          : rasio, 
            id_satuan      : id_satuan,
            is_for_rs      : is_for_rs,
            is_for_nas     : is_for_nas,
            ket_item       : ket_item, 
            user_id        :  "<?php echo $this->session->userdata['user_id'] ?>"
        };
        
        if(id_item!='')
        {
            master['id_item']=id_item;
        }

        var row_lokasi = $('#dtg-lokasi_item').datagrid('getRows');
        var row_komposisi = $('#dtg-komposisi_obat').datagrid('getRows');
        var row_supplier = $('#dtg-akses_transaksi').datagrid('getRows');
        
        if(row_lokasi.length <= 0)
        {
            notif('warning','Lokasi Item Harus di isi!');
            return false;
        }

        if(row_komposisi.length <= 0)
        {
            notif('warning','Komposisi Obat Harus di isi!');
            return false;
        }

        if(row_supplier.length <= 0)
        {
            notif('warning','Supplier Harus di isi!');
            return false;
        }

        var lokasi    = [];
        var komposisi = [];
        var supplier  = [];
        
        for (var i=0; i<row_lokasi.length; i++) {
            lokasi.push({
                id_lokasi: row_lokasi[i]['id_lokasi'],
            });
        }

        for (var i=0; i<row_komposisi.length; i++) {
            komposisi.push({
                zat_sd      : row_komposisi[i]['zat_sd'],
                kekuatan_sd : row_komposisi[i]['kekuatan_sd'],
                id_satuan_sd: row_komposisi[i]['id_satuan_sd'],
            });
        }

        var cek = 0;
        for (var i=0; i<row_supplier.length; i++) {
            supplier.push({
                partner_id: row_supplier[i]['partner_id'],
                is_default: row_supplier[i]['is_default'],
            });

            if (row_supplier[i]['is_default']==true)
            {
                cek++;
            }
        }

        if (cek==0)
        {
            notif('warning','Default Supplier Harus Ada!');
            return false;
        }

        if (cek>1)
        {
            notif('warning','Pilih Salah Satu Default Supplier!');
            return false;
        }

        console.log(master);
        console.log(lokasi);
        console.log(komposisi);
        console.log(supplier);

        // return false;

        $('#loader').css('display','');
        $.ajax({
          url : "<?php echo base_url('farmasi/master/Item_farmasi/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master   : master,
            lokasi   : lokasi,
            komposisi: komposisi,
            supplier : supplier,
            },
          beforeSend: function (){               
            },
          success:function(data, textStatus, jqXHR){
              $('#loader').css('display','none');
              if(data.error){
                notif('error',data.message);
              }else{
                notif('success',data.message);
              }
              tab(0);
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function get_data(no)
    {
        $.ajax({
            url     : "<?php echo base_url("farmasi/master/Item_farmasi/getItem"); ?>",
            type    : "POST",
            dataType: 'json',
            async   : false,
            data    :{
                data:no,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
                tab(1);
                $('#loader').css('display','none');
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function set_form(data)
    {
        $('#txt-label').text(data.master.nama_item);

        $('#txt-id_item').val(data.master.id_item);
        $('#txt-kd_item').val(data.master.kd_item);
        $('#txt-nama_item').val(data.master.nama_item);

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

        if(data.master.is_for_rs==true)
        {
            $('#chk-rumah_sakit').checkbox({
                checked: true
            });
        }
        else
        {
            $('#chk-rumah_sakit').checkbox({
                checked: false
            });
        }

        if(data.master.is_for_nas==true)
        {
            $('#chk-nasional').checkbox({
                checked: true
            });
        }
        else
        {
            $('#chk-nasional').checkbox({
                checked: false
            });
        }

        $('#cmb-kelompok').val(data.master.id_kel_item).change();
        $('#cmb-golongan').val(data.master.id_gol_obat).change();
        $('#cmb-kategori').val(data.master.id_kat_obat).change();
        $('#cmb-bentuk').val(data.master.id_bentuk_sd).change();
        $('#cmb-satuan_besar').val(data.master.id_satuan_besar).change();
        $('#cmb-produsen').val(data.master.id_produsen).change();
        $('#cmb-jenis').val(data.master.id_jns_obat).change();
        $('#cmb-kelas_terapi').val(data.master.id_kelas_terapi).change();
        $('#cmb-satuan_kecil').val(data.master.id_satuan).change();
        
        $('#nmb-rasio').numberbox('setValue',data.master.rasio);
        $('#txt-keterangan').val(data.master.ket_item);
        $('#txt-sifat_sediaan').val(data.master.sifat_sd);

        $('#dtg-lokasi_item').datagrid('loadData', data.lokasi);
        $('#dtg-komposisi_obat').datagrid('loadData', data.komposisi);

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

        $('#dtg-akses_transaksi').datagrid('loadData', data.supplier);
    }

	function reset_form()
	{
		// body...
		$('#txt-label').text('');

		$('#txt-kd_item').val('');
        $('#txt-nama_item').val('');

        $('#chk-is_aktif').checkbox({
            checked: true
        });

        $('#chk-rumah_sakit').checkbox({
            checked: false
        });

        $('#chk-nasional').checkbox({
            checked: false
        });
        
        set_select_all();
        $('#cmb-kelompok').val('').change();
        $('#cmb-golongan').val('').change();
        $('#cmb-kategori').val('').change();
        $('#cmb-bentuk').val('').change();
        $('#cmb-satuan_besar').val('').change();
        $('#cmb-produsen').val('').change();
        $('#cmb-jenis').val('').change();
        $('#cmb-kelas_terapi').val('').change();
        $('#cmb-satuan_kecil').val('').change();

        $('#nmb-rasio').numberbox('setValue',0);
        $('#txt-keterangan').val('');

        $('#txt-sifat_sediaan').val('');

        $('#dtg-lokasi_item').datagrid('loadData', []);
        $('#dtg-komposisi_obat').datagrid('loadData', []);
        $('#dtg-akses_transaksi').datagrid('loadData', []);
	}

	function set_read(kondisi)
    {
        $('#txt-kd_item').prop('disabled', kondisi);
        $('#txt-nama_item').prop('disabled', kondisi);
        
        $('#cmb-kelompok').prop('disabled', kondisi);
        $('#cmb-golongan').prop('disabled', kondisi);
        $('#cmb-kategori').prop('disabled', kondisi);
        $('#cmb-bentuk').prop('disabled', kondisi);
        $('#cmb-satuan_besar').prop('disabled', kondisi);
        $('#cmb-produsen').prop('disabled', kondisi);
        $('#cmb-jenis').prop('disabled', kondisi);
        $('#cmb-kelas_terapi').prop('disabled', kondisi);
        $('#cmb-satuan_besar').prop('disabled', kondisi);
        $('#cmb-kelompok').prop('disabled', kondisi);

        $('#nmb-rasio-rasio').numberbox('disabled', kondisi);
        $('#txt-keterangan').prop('disabled', kondisi);

        $('.div_hidden').hide();

        if (edit==0&&kondisi==false) //tambah
        {
          $('#div_status').hide();
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();

          $('.div_simpan').show();
        }

        if (edit==1&&kondisi==false) //ubah 
        {
            $('#div_status').show();
            $('#btn-aksi').show();
            $('#btn-hapus').show();
            $('#btn-cetak').show();

            $('.div_simpan').show();       
        }

        if (edit==0&&kondisi==true) //ubah readonly
        {
          $('#div_status').show();
          $('#btn-aksi').show();
          $('#btn-hapus').hide();
          $('#btn-cetak').show();

          $('.div_simpan').hide();
        }
    }

    function tambahkan_lokasi()
    {
		var row       = $('#dtg-daftar_lokasi').datagrid('getSelections');
		var data_grid = [];
		var nama_unit = $('#cmb-lokasi option:selected').text();

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        data_grid = $('#dtg-lokasi_item').datagrid('getRows');

        for (var i = 0 ; i < row.length; i++)
        {
			row[i]['id_lokasi']   = row[i]['id_lokasi'];
			row[i]['kd_lokasi']   = row[i]['kd_lokasi'];
			row[i]['nama_lokasi'] = row[i]['nama_lokasi'];
			row[i]['nama_unit']   = nama_unit;
        }
  
        var cek;
        for (var i = 0; i < row.length; i++)
        {
            cek = 0;
            for (var j = 0; j < data_grid.length; j++)
            {
                if (data_grid[j]['id_lokasi']==row[i]['id_lokasi'])
                {
                    cek=1;
                }
            }

            if (cek==0)
            {
                data_grid.push(row[i]);
            }
        }

        $('#dtg-lokasi_item').datagrid('loadData', []);
        $('#dtg-lokasi_item').datagrid('loadData', data_grid);
        unSelectDatagrid('#dtg-daftar_lokasi');

        notif("success",row.length+" Berhasil Ditambahkan");
    }

    function pilih_supplier()
    {
        var data_grid = $('#dtg-akses_transaksi').datagrid('getRows');;
		var row       = $('#dtg-data_supplier').datagrid('getSelections');

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

        $('#dtg-akses_transaksi').datagrid('loadData', []);
        $('#dtg-akses_transaksi').datagrid('loadData', data_grid);
        unSelectDatagrid('#dtg-data_supplier');

        // notif("success",row.length+" Berhasil Ditambahkan");
        $('#win-cari_supplier').window('close');
    }

    function set_select_all()
    {
        // body...
        $("#cmb-produsen").select2({ data: data_select['getProdusen'] });
        $("#cmb-kelompok").select2({ data: data_select['getKelompok'] });
        $("#cmb-golongan").select2({ data: data_select['getGolongan'] });
        $("#cmb-jenis").select2({ data: data_select['getJenis'] });
        $("#cmb-kategori").select2({ data: data_select['getKategori'] });

        $("#cmb-kelas_terapi").select2({ data: data_select['getTerapi'] });
        $("#cmb-bentuk").select2({ data: data_select['getBentuk'] });

        $("#cmb-satuan_kecil").select2({ data: data_select['getSatuan'] });
        $("#cmb-satuan_besar").select2({ data: data_select['getSatuan'] });
    }

	function get_select_all()
	{
		// body...
		get_select("getProdusen","#cmb-produsen");
		get_select("getKelompok","#cmb-kelompok");
		get_select("getGolongan","#cmb-golongan");
		get_select("getJenis","#cmb-jenis");
		get_select("getKategori","#cmb-kategori");

		get_select("getTerapi","#cmb-kelas_terapi");
		get_select("getBentuk","#cmb-bentuk");

		get_select("getSatuan","#cmb-satuan_kecil");
		get_select("getSatuan","#cmb-satuan_besar");
	}

	function get_select(param_url,combobox)
    {
		let url_controller = "<?php echo base_url("farmasi/master/Item_farmasi/");?>"+param_url;
		
        $.ajax({
            url     : url_controller,
            type    : "POST",
            dataType: 'json',
            async   : false,
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               if (param_url=="getLokasi")
               {
               		data_lokasi = [];
               		for (var i = 0; i<data.length; i++)
               		{
               			data_lokasi[data[i].id]=[data[i].detail];	
               		}

                    $(combobox).select2({ data: data });

               		$('#cmb-lokasi').select2({
				        dropdownParent: $('#win-tambah_lokasi_item')
				    });
               }
               else
               {
                    $(combobox).select2({ data: data });

                    data_select[param_url] = data; 
               }
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

	function filter()
    {
        $('#dtg-item_farmasi').datagrid('loadData', []);

		let status   = $('#cmb-status').val();
		let criteria = $('#txt-criteria').val();
        
        data = {
			status  : status, 
			criteria:criteria,
			page    : 1,
			page_row: 10,
        }

        var dg = $('#dtg-item_farmasi').datagrid({
          url : "<?php echo base_url("farmasi/master/Item_farmasi/filter"); ?>",
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

    function filter_supplier()
    {
        $('#dtg-data_supplier').datagrid('loadData', []);

		let criteria = $('#txt-criteria_supplier').val();
        
        data = {
			criteria:criteria,
			page    : 1,
			page_row: 10,
        }

        var dg = $('#dtg-data_supplier').datagrid({
          url : "<?php echo base_url("farmasi/master/Item_farmasi/filter_supplier"); ?>",
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
                url     : "<?php echo base_url("/farmasi/master/Item_farmasi/hapus"); ?>",
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

</script>