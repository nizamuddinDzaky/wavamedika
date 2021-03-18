<script type="text/javascript">
	var data_lama = [];

	$(function(){
		get_depo();		
		// $('#win-konfigurasi').window('open');
		$('#cmb-item_oksigen').select2({
          ajax: {
            url : "<?php echo base_url("farmasi/utilitas/Konfigurasi_farmasi/cari_item"); ?>",
            dataType: 'json',
            data: function (params) {
              var query = {
                criteria : params.term
              }
              // Query parameters will be ?search=[term]&type=public
              return query;
            },
            processResults: function (data) {
              // Transforms the top-level key of the response object from 'items' to 'results'
              return {
                results: data
              };
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
          }         
        }).on('select2:open', function (e) {
            $(
                $(
                    $(
                        $('#select2-cmb-item_oksigen-results').parent('.select2-results')[0]
                        ).parent('.select2-dropdown--below')[0]
                ).parent('.select2-container')[0]
            ).css("z-index", "10000");
        }).on('select2:select', function (e) {
            var data = e.params.data;
        });

        $('#cmb-item_nitrogen').select2({
          ajax: {
            url : "<?php echo base_url("farmasi/utilitas/Konfigurasi_farmasi/cari_item"); ?>",
            dataType: 'json',
            data: function (params) {
              var query = {
                criteria : params.term
              }
              // Query parameters will be ?search=[term]&type=public
              return query;
            },
            processResults: function (data) {
              // Transforms the top-level key of the response object from 'items' to 'results'
              return {
                results: data
              };
            }
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
          }         
        }).on('select2:open', function (e) {
            $(
                $(
                    $(
                        $('#select2-cmb-item_nitrogen-results').parent('.select2-results')[0]
                        ).parent('.select2-dropdown--below')[0]
                ).parent('.select2-container')[0]
            ).css("z-index", "10000");
        }).on('select2:select', function (e) {
            var data = e.params.data;
        });

        // reset_form();
        get_config();
	});

	$('.easyui-numberbox').numberbox({
        'precision' : 0,
        // 'min' : 0,
        'required':true,
        'groupSeparator' :'.',
        'decimalSeparator' :',',
        onChange: function(){
            
        }
    });

    $('.persen').numberbox({
        'precision' : 0,
        'min' : 0,
        'required':true,
        'groupSeparator' :'.',
        'decimalSeparator' :',',
    });

	function get_depo()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/utilitas/Konfigurasi_farmasi/get_depo"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $('#cmb-depo_gas_medik').select2({ data: data });
               $('#cmb-depo_retur').select2({ data: data });
               $('#cmb-depo_instansi').select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_config()
    {
        $.ajax({
            url     : "<?php echo base_url("farmasi/utilitas/Konfigurasi_farmasi/getKonfigurasi"); ?>",
            type    : "POST",
            dataType: 'json',
            success:function(data, textStatus, jqXHR){
                set_form(data);
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
    	// body...
    	data = data.data;

    	data_lama = data;

    	console.table(data);

		$('#txt-alamat').val(data.alamat_kirim_po);

		$('#cmb-item_oksigen').val(data.id_item_oksigen).change();//
        $('#cmb-item_nitrogen').val(data.id_item_nitrogen).change();//
        $('#cmb-item_oksigen').text(data.nama_item_oksigen);//
        $('#cmb-item_nitrogen').text(data.nama_item_nitrogen);//

		// let data_oksigen  = [{id:data.id_item_oksigen,text:data.nama_item_oksigen}];
		// let data_nitrogen = [{id:data.id_item_oksigen,text:data.nama_item_nitrogen}];

		// $('#cmb-item_oksigen').select2({data:data_oksigen});
		// $('#cmb-item_nitrogen').select2({data:data_nitrogen});

        $('#cmb-depo_gas_medik').val(data.id_unit_gasmed).change();
        $('#cmb-harga_jual').val(data.jns_hna_jual).change();
        $('#cmb-hitung_ppn').val(data.is_ppn).change();//
        $('#cmb-no_resep').val(data.no_resep_auto).change();
        $('#cmb-stok_penjualan').val(data.cek_stok_jual).change();//
        $('#cmb-stok_mutasi').val(data.cek_stok_mutasi_ruang).change();//
        $('#cmb-depo_retur').val(data.id_unit_depo_retur_far).change();
        $('#cmb-depo_instansi').val(data.id_unit_intransit).change();    	

    	$('#nmb-obat').numberbox('setValue',data.tarif_jrs_obat);
        $('#nmb-alkes').numberbox('setValue',data.tarif_jrs_alkes);
        $('#nmb-racikan').numberbox('setValue',data.tarif_jrs_racikan);
        $('#nmb-maksimal').numberbox('setValue',data.max_jrs);

        $('#nmb-persentase').numberbox('setValue',data.p_ppn);
        $('#nmb-safety_stok_gudang').numberbox('setValue',data.safety_stok_gdg);
        $('#nmb-safety_stok_depo').numberbox('setValue',data.safety_stok_depo);
    }

    function reset_form()
    {
    	// body...
		$('#txt-alamat').val('');

		$('#cmb-item_oksigen').val('').change();
        $('#cmb-item_nitrogen').val('').change();
        $('#cmb-depo_gas_medik').val('').change();
        $('#cmb-harga_jual').val(1).change();
        $('#cmb-hitung_ppn').val(true).change();
        $('#cmb-no_resep').val(true).change();
        $('#cmb-stok_penjualan').val(true).change();
        $('#cmb-stok_mutasi').val(true).change();
        $('#cmb-depo_retur').val('').change();
        $('#cmb-depo_instansi').val('').change();    	

    	$('#nmb-obat').numberbox('setValue',0);
        $('#nmb-alkes').numberbox('setValue',0);
        $('#nmb-racikan').numberbox('setValue',0);
        $('#nmb-maksimal').numberbox('setValue',0);

        $('#nmb-persentase').numberbox('setValue',0);
        $('#nmb-safety_stok_gudang').numberbox('setValue',0);
        $('#nmb-safety_stok_depo').numberbox('setValue',0);
    }

    function simpan()
    {
    	// body...
    	let data_simpan = [];

		let alamat_kirim_po        = $('#txt-alamat').val();
		if (alamat_kirim_po!=data_lama.alamat_kirim_po)
		{
			data_simpan.push({config_id:'alamat_kirim_po',config_value:alamat_kirim_po})
		}
		
		let id_item_oksigen        = $('#cmb-item_oksigen option:selected').val();
		if (id_item_oksigen!=data_lama.id_item_oksigen)
		{
			data_simpan.push({config_id:'id_item_oksigen',config_value:id_item_oksigen})
		}

		let id_item_nitrogen       = $('#cmb-item_nitrogen option:selected').val();
		if (id_item_nitrogen!=data_lama.id_item_nitrogen)
		{
			data_simpan.push({config_id:'id_item_nitrogen',config_value:id_item_nitrogen})
		}

		let id_unit_gasmed         = $('#cmb-depo_gas_medik option:selected').val();
		if (id_unit_gasmed!=data_lama.id_unit_gasmed)
		{
			data_simpan.push({config_id:'id_unit_gasmed',config_value:id_unit_gasmed})
		}

		let jns_hna_jual           = $('#cmb-harga_jual option:selected').val();
		if (jns_hna_jual!=data_lama.jns_hna_jual)
		{
			data_simpan.push({config_id:'jns_hna_jual',config_value:jns_hna_jual})
		}

		let is_ppn                 = $('#cmb-hitung_ppn option:selected').val();
		if (is_ppn!=data_lama.is_ppn)
		{
			data_simpan.push({config_id:'is_ppn',config_value:is_ppn})
		}

		let no_resep_auto          = $('#cmb-no_resep option:selected').val();
		if (no_resep_auto!=data_lama.no_resep_auto)
		{
			data_simpan.push({config_id:'no_resep_auto',config_value:no_resep_auto})
		}

		let cek_stok_jual          = $('#cmb-stok_penjualan option:selected').val();
		if (cek_stok_jual!=data_lama.cek_stok_jual)
		{
			data_simpan.push({config_id:'cek_stok_jual',config_value:cek_stok_jual})
		}

		let cek_stok_mutasi_ruang  = $('#cmb-stok_mutasi option:selected').val();
		if (cek_stok_mutasi_ruang!=data_lama.cek_stok_mutasi_ruang)
		{
			data_simpan.push({config_id:'cek_stok_mutasi_ruang',config_value:cek_stok_mutasi_ruang})
		}

		let id_unit_depo_retur_far = $('#cmb-depo_retur option:selected').val();
		if (id_unit_depo_retur_far!=data_lama.id_unit_depo_retur_far)
		{
			data_simpan.push({config_id:'id_unit_depo_retur_far',config_value:id_unit_depo_retur_far})
		}

		let id_unit_intransit      = $('#cmb-depo_instansi option:selected').val();    	
		if (id_unit_intransit!=data_lama.id_unit_intransit)
		{
			data_simpan.push({config_id:'id_unit_intransit',config_value:id_unit_intransit})
		}

		let tarif_jrs_obat         = $('#nmb-obat').numberbox('getValue');
		if (tarif_jrs_obat!=data_lama.tarif_jrs_obat)
		{
			data_simpan.push({config_id:'tarif_jrs_obat',config_value:tarif_jrs_obat})
		}

		let tarif_jrs_alkes        = $('#nmb-alkes').numberbox('getValue');
		if (tarif_jrs_alkes!=data_lama.tarif_jrs_alkes)
		{
			data_simpan.push({config_id:'tarif_jrs_alkes',config_value:tarif_jrs_alkes})
		}

		let tarif_jrs_racikan      = $('#nmb-racikan').numberbox('getValue');
		if (tarif_jrs_racikan!=data_lama.tarif_jrs_racikan)
		{
			data_simpan.push({config_id:'tarif_jrs_racikan',config_value:tarif_jrs_racikan})
		}

		let max_jrs                = $('#nmb-maksimal').numberbox('getValue');
		if (max_jrs!=data_lama.max_jrs)
		{
			data_simpan.push({config_id:'max_jrs',config_value:max_jrs})
		}

		let p_ppn                  = $('#nmb-persentase').numberbox('getValue');
		if (p_ppn!=data_lama.p_ppn)
		{
			data_simpan.push({config_id:'p_ppn',config_value:p_ppn})
		}

		let safety_stok_gdg        = $('#nmb-safety_stok_gudang').numberbox('getValue');
		if (safety_stok_gdg!=data_lama.safety_stok_gdg)
		{
			data_simpan.push({config_id:'safety_stok_gdg',config_value:safety_stok_gdg})
		}

		let safety_stok_depo       = $('#nmb-safety_stok_depo').numberbox('getValue');
		if (safety_stok_depo!=data_lama.safety_stok_depo)
		{
			data_simpan.push({config_id:'safety_stok_depo',config_value:safety_stok_depo})
		}

		console.table(data_simpan);

		$.ajax({
          url : "<?php echo base_url('farmasi/utilitas/Konfigurasi_farmasi/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{data:data_simpan},
          beforeSend: function (){               
            },
          success:function(data, textStatus, jqXHR){
              if(data.error){
                notif('error',data.message);
              }else{
                notif('success',data.message);
                get_config(); 
              }
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        });
    }
</script>