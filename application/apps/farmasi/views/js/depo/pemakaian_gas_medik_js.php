<script type="text/javascript">
    var gasmed;
    var data_master;
    var id_kamar_rawat;
    var id_unit_rawat;
    var tipe;
    var edit;

	$(function(){
		tab(0);
        get_ruang()
        get_gasmed()
        get_dokter()
        get_klinik()
        filter();
        $('.easyui-datetimebox').datetimebox({
            value: setDateNow()
        });
		$('#cmb-klinik_ruang_'+tipe).select2({
			placeholder:'Pilih Klinik/RUang',
			dropdownParent:$('#win-oksigen'),
            dropdownParent:$('#win-nitrogen')
		})

		$('#cmb-dokter_'+tipe).select2({
			placeholder:'Pilih Dokter',
			dropdownParent:$('#win-oksigen'),
            dropdownParent:$('#win-nitrogen')
		})

		$('#btn-tambah_oksigen').click(function(event) {  
            edit = 0;
            tipe = "oksigen";
            reset_form()
            set_popup('oksigen')
		});

		$('#btn-tambah_nitrogen').click(function(event) {
            edit = 0;
            tipe = "nitrogen";
            reset_form()
            set_popup('nitrogen')
		});

        $('#btn-ubah_detail').click(function(event) {
            edit = 1;
            var row = $('#dtg-detail_item').datagrid('getSelected');
            reset_form();
            getDataDetail(row.no_nota);
        });

        $('#btn-hapus_detail').click(function(event) {
            hapus()
        });

        $('#btn-cetak_detail').click(function(event) {
            cetak(0)
        });
	})

    $('.easyui-datetimebox').datetimebox({
        onChange: function(){
            set_waktu();
            set_pemakaian();
            set_total()
        }
    });

    $('.easyui-numberbox').numberbox({
            'precision' : 2,
            // 'min' : 0,
            // 'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            // onChange: function(){
            // }
        });

    function dateDiff( str1, str2 ) {
    var diff = Date.parse( str2 ) - Date.parse( str1 ); 
    return isNaN( diff ) ? NaN : {
        diff : diff,
        ms : Math.floor( diff            % 1000 ),
        s  : Math.floor( diff /     1000 %   60 ),
        m  : Math.floor( diff /    60000 %   60 ),
        h  : Math.floor( diff /  3600000 %   24 ),
        d  : Math.floor( diff / 86400000        )
    };
}

	$('#dtg-pemakaian_gas_medik').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
         	{field:'id_mrs',title:'No. Billing',width:"12%",halign:'center',align:'left'},
         	{field:'no_mr',title:'No. RM',width:"12%",halign:'center',align:'left'},
         	{field:'nama_lengkap',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
            {field:'sex',title:'Jns. Kelamin',width:"9%",halign:'center',align:'center'},
            {field:'tgl_mrs',title:'Tgl. MRS',width:"10%",halign:'center',align:'center',formatter:appGridDateFormatter},
            {field:'ri_rj',title:'Jns. Rawat',width:"9%",halign:'center',align:'center'},
            {field:'nama_unit',title:'Unit',width:"15%",halign:'center',align:'left'},
            {field:'kamar_display',title:'Kamar',width:"22%",halign:'center',align:'left'},
            {field:'kelas',title:'Kelas',width:"8%",halign:'center',align:'center'},
            {field:'asuransi',title:'Asuransi',width:"10%",halign:'center',align:'center'},
            {field:'instansi',title:'Instansi',width:"15%",halign:'center',align:'left'},
            {field:'admission',title:'Admision',width:"10%",halign:'center',align:'left'},
         	{field:'nama_dokter',title:'Dokter',width:"20%",halign:'center',align:'left'},
        ]],
    });

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            // btn_ubah();
        },
        columns:[[
         	{field:'no_nota',title:'No. Nota',width:"12%",halign:'center',align:'center'},
         	{field:'tgl_nota',title:'Tgl. Nota',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
         	{field:'nama_dokter',title:'Dokter',width:"20%",halign:'center',align:'left'},
         	{field:'kamar_display',title:'Ruang/Kamar',width:"10%",halign:'center',align:'left'},
         	{field:'nama_item',title:'Item',width:"10%",halign:'center',align:'left'},
         	{field:'tgl_awal_gm',title:'Tanggal/Jam Awal',width:"10%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         	{field:'tgl_akhir_gm',title:'Tanggal/Jam Akhir',width:"10%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         	{field:'jml_jam',title:'Lama (Jam)',width:"10%",halign:'center',align:'center'},
         	{field:'jml_menit',title:'Lama (Menit)',width:"10%",halign:'center',align:'center'},
         	{field:'skala',title:'Skala',width:"10%",halign:'center',align:'center'},
            {field:'jml',title:'Jumlah',width:"10%",halign:'center',align:'center',formatter:appGridNumberFormatter},
         	{field:'harga',title:'Harga',width:"12%",halign:'center',align:'right',formatter:appGridNumberFormatter},
         	{field:'total',title:'Total',width:"12%",halign:'center',align:'right',formatter:appGridNumberFormatter},
         	{field:'c_status_posting',title:'Status Posting',width:"12%",halign:'center',align:'left'},
         	{field:'user_ins_name',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
         	{field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         	{field:'user_upd_name',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
         	{field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    function tab(tab){
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            $('#dtg-pemakaian_gas_medik').datagrid('resize');
            $('#nama_depo').text('')
        }
        else{
            $('#nama_depo').text(gasmed.unit.nama_unit_gasmed)
            $('#browse').hide();
            $('#detail').show();
        }
    }

    function tutup(){
    	$('#win-oksigen').window('close');
    	$('#win-nitrogen').window('close')
    }

    function filter()
    {
        $('#dtg-pemakaian_gas_medik').datagrid('loadData',[]);
        var criteria = $('#txt-criteria').val();
        var id_unit  = $('#cmb-ruang option:selected').val();
      
        data={
          criteria : criteria,
          Jns_rawat: "",
          id_unit  : 34,
          page     : 1,
          page_row : 10
        } 

        var dg = $('#dtg-pemakaian_gas_medik').datagrid({
        url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/filter"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            // if (data.metadata.list_count<1)
            // {
            //   $.messager.alert('Warning','Daftar Kosong');
            // }
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.rows ? data.rows : []
            }
          }
        });
    }

    function get_ruang()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/get_ruang"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-ruang").select2({ data: data });
               // $("#cmb-klinik_ruang_oksigen").select2({ 
               //     data: data ,
               //     dropdownParent: $('#win-oksigen')
               // });
               // $("#cmb-cmb-klinik_ruang_nitrogen").select2({ 
               //     data: data ,
               //     dropdownParent: $('#win-nitrogen')
               // });
               $("#cmb-ruang").val(0).change();
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_klinik()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/get_klinik"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-ruang").select2({ data: data });
               $("#cmb-klinik_ruang_oksigen").select2({ 
                   data: data ,
                   dropdownParent: $('#win-oksigen')
               });
               $("#cmb-klinik_ruang_nitrogen").select2({ 
                   data: data ,
                   dropdownParent: $('#win-nitrogen')
               });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
       $("#cmb-klinik_ruang_oksigen").val("967-87").change();
       $("#cmb-klinik_ruang_nitrogen").val("1039-116").change();
    }

    function get_gasmed()
    {
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/get_gasmed"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                gasmed = data;
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
            url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/get_dokter"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#cmb-dokter_oksigen").select2({ 
                    data: data,
                    dropdownParent: $('#win-oksigen')

                });

                $("#cmb-dokter_nitrogen").select2({ 
                    data: data,
                    dropdownParent: $('#win-nitrogen')

                });
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    $('#dtg-pemakaian_gas_medik').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
           btn_ubah();
           edit =1;
    }
    });


    function btn_ubah()
    {
      // body...
      edit = 1;
      var row = $('#dtg-pemakaian_gas_medik').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      // reset_form();
      getData(row.id_mrs);
    }

    function getData(id_mrs)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: id_mrs,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            set_data(data);
            data_master = data['mrs'];
            tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function getDataDetail(no_nota)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/getPerNota"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_nota,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            set_data_detail(data);

          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    $('#dtg-detail_item').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
          edit = 1;
          var row = $('#dtg-detail_item').datagrid('getSelected');
          // reset_form();
          getDataDetail(row.no_nota);
    }
    });

    function set_data(data)
    {
        detail_item=[];
        $('#txt-label_pasien').text(data.mrs.nama_lengkap)
        $('#txt-label_norm').text("No. RM : "+data.mrs.no_mr)
        $('#txt-label_billing').text("No. Billing : "+data.mrs.id_mrs)
        $('#txt-no_billing').val(data.mrs.id_mrs)
        $('#txt-tgl_mrs').val(toAppDateFormat(data.mrs.tgl_mrs))
        $('#txt-nama_pasien').val(data.mrs.nama_lengkap)
        $('#txt-no_rm').val(data.mrs.no_mr)
        $('#txt-umur').val(data.mrs.umur)
        $('#txt-kelamin').val(data.mrs.sex)
        $('#txt-Jenis_pasien').val(data.mrs.status_karyawan)
        $('#txt-status_pasien').val(data.mrs.jns_bayar)
        $('#txt-dokter').val(data.mrs.nama_dokter)
        $('#txt-klinik_ruang').val(data.mrs.kamar_display)//fix
        $('#txt-kelas').val(data.mrs.kelas)
        $('#txt-jatah_kelas').val(data.mrs.kelas_hak)
        $('#label-status_kelas').text(data.mrs.kelas_status)

        $('#dtg-detail_item').datagrid('loadData',data.gasmed)
        
    }

    function set_data_detail(data)
    {
        if(data.jns_nota==4){
            tipe="oksigen"
            $('#win-oksigen').window('open');
            $('#win-nitrogen').window('close');
        }else{
            tipe="nitrogen"
            $('#win-nitrogen').window('open');
            $('#win-oksigen').window('close');
        }
        $('#txt-label_pasien_'+tipe+'').text(data_master.nama_lengkap)
        $('#txt-label_norm_'+tipe).text("No. RM : "+data_master.no_mr)
        $('#txt-label_billing_'+tipe).text("No. Billing : "+data_master.id_mrs)

        $('#txt-no_nota_'+tipe).val(data.no_nota)
        $('#txt-tgl_nota_'+tipe).val(toAppDateFormat(data.tgl_nota))
        console.log(''.concat(data.id_kamar_rawat,'-',data.id_unit_rawat))
        $('#cmb-klinik_ruang_'+tipe).val(''.concat(data.id_kamar_rawat,'-',data.id_unit_rawat)).change()
        $('#cmb-dokter_'+tipe).val(data.id_dokter).change()
        //data item
        console.log(gasmed[tipe])
        $('#txt-kode_item_'+tipe).val(gasmed[tipe].kd_item)
        $('#txt-nama_item_'+tipe).val(gasmed[tipe].nama_item)
        $('#txt-id_satuan_'+tipe).val(gasmed[tipe].id_satuan)
        //waktu dam lama pemakaian
        console.log(toAppDateTimeFormat(data.tgl_awal_gm))
        $('#dtb-tgl_awal_'+tipe).datetimebox('setValue',data.tgl_awal_gm)
        $('#dtb-tgl_akhir_'+tipe).datetimebox('setValue',data.tgl_akhir_gm)
        $('#txt-lama_jam_'+tipe).val(data.jml_jam)
        $('#txt-menit_'+tipe).val(data.jml_menit)
        $('#skala_'+tipe).val(data.skala)
        $('#txt-pemakaian_'+tipe).val(data.jml)
        $('#txt-harga_'+tipe).numberbox('setValue',data.harga)
        $('#txt-total_'+tipe).numberbox('setValue',data.total)
        $('#txt-keterangan_'+tipe).val(data.ket_nota)
    }

    function set_waktu(){
            var awal     = $('#dtb-tgl_awal_'+tipe).val();
            var akhir    = $('#dtb-tgl_akhir_'+tipe).val();
            var hari_ini = toAppDateFormat(new Date());
            console.log("awal");
            console.log(toAppDateFormat(awal));
            console.log("hari_ini");
            console.log(hari_ini);

            var future   = moment(akhir);
            var start    = moment(awal);

            var besok = moment(hari_ini);
            var sel_besok = besok.diff(start, 'day'); 
console.log("sel_besok");
console.log(sel_besok);
            var menit    = future.diff(start, 'minute'); 
            var jam      = future.diff(start, 'hours'); 
            var jamJam   = Math.floor(menit/60);
            var jamMenit = menit % 60;
            var str_jamMenit;
            console.log("menit")
            console.log(menit)
            if(menit<0){
                notif('warning','Waktu Akhir Tidak Boleh Kurang Dari Waktu Awal');
                $('#dtb-tgl_akhir_'+tipe).datetimebox(new Date());
                $('#txt-lama_jam_'+tipe).val(0)
                $('#txt-pemakaian_'+tipe).val(0)
                $('#txt-harga_'+tipe).numberbox('setValue',0)
                $('#txt-total_'+tipe).numberbox('setValue',0)
                return false
            }
            if(sel_besok<-60){
                notif('warning','Waktu Awal Tidak Boleh Lebih Dari Hari Ini');
                $('#dtb-tgl_awal_'+tipe).datetimebox(new Date());
                $('#txt-lama_jam_'+tipe).val(0)
                $('#txt-menit_'+tipe).val(0)
                $('#txt-pemakaian_'+tipe).val(0)
                $('#txt-harga_'+tipe).numberbox('setValue',0)
                $('#txt-total_'+tipe).numberbox('setValue',0)
                return false
            }
            if(menit<60){
                str_jamMenit = jamJam;
            }
            else if(jamMenit==0){
                str_jamMenit = jamJam;
            }else{
                str_jamMenit = jamJam + ":" + jamMenit;
            }
            if(isNaN(menit) == false){
                $('#txt-menit_'+tipe).val(menit);
                $('#txt-lama_jam_'+tipe).val(str_jamMenit);
            }
    }

    function set_pemakaian(){
        var menit = parseInt($('#txt-menit_'+tipe).val());
        var skala = parseInt($('#skala_'+tipe).val());
        var pemakaian = menit * skala;
        $('#txt-pemakaian_'+tipe).val(pemakaian);
    }

    function set_total(){
        var pemakaian = parseInt($('#txt-pemakaian_'+tipe).val());
        var harga     = parseInt($('#txt-harga_'+tipe).val());
        var total = pemakaian * harga;
        $('#txt-total_'+tipe).numberbox('setValue',total);
    }

    function get_harga(jns)
    {
        var jns_nota;
        var id_item;
        if(jns==1){
            jns_nota= gasmed.jns_nota_oksigen
            id_item = gasmed.oksigen.id_item
        }else{
            jns_nota=gasmed.jns_nota_nitrogen
            id_item = gasmed.nitrogen.id_item
        }
        $.ajax({
            url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/get_harga"); ?>",
            type: "POST",
            dataType: 'json',
            data : {
                jns_hna_jual   : gasmed.jns_hna_jual,
                p_ppn          : gasmed.p_ppn,
                jns_nota       : jns_nota,
                jns_rawat      : data_master.ri_rj,
                status_karyawan: data_master.status_karyawan,
                id_item        : id_item
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                $("#txt-harga_"+tipe).numberbox('setValue',data.harga_jual)
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    $('#cmb-klinik_ruang_oksigen').on('select2:select', function (e) {
        let data = e.params.data;
        console.log(data)
        id_kamar_rawat =  data.id_kamar;
        id_unit_rawat =  data.id_unit;
    });

    $('#cmb-klinik_ruang_nitrogen').on('select2:select', function (e) {
        let data = e.params.data;
        console.log(data)
        id_kamar_rawat =  data.id_kamar;
        id_unit_rawat =  data.id_unit;
    });

    function simpan(jns){

        let no_nota      = $('#txt-no_nota_'+tipe).val()
        let tgl_nota     = toAPIDateFormat($('#txt-tgl_nota_'+tipe).val())
        let keterangan   = $('#txt-keterangan_'+tipe).val()
        let tgl_awal_gm  = toAPIDateHourMinuteFormat($('#dtb-tgl_awal_'+tipe).val())
        let tgl_akhir_gm = toAPIDateHourMinuteFormat($('#dtb-tgl_akhir_'+tipe).val())
        let jml_menit    = $('#txt-menit_'+tipe).val()
        let skala        = $('#skala_'+tipe).val()
        let jml          = $('#txt-pemakaian_'+tipe).val()
        let harga        = $('#txt-harga_'+tipe).val()
        let id_dokter    = $('#cmb-dokter_'+tipe+' option:selected').val();
        let nama_dokter  = $('#cmb-dokter_'+tipe+' option:selected').text();
        
        let id_ruang    = $('#cmb-klinik_ruang_'+tipe+' option:selected').val();
        if (typeof id_ruang === "undefined"||
            typeof id_dokter === "undefined")
        {
          let msg = '<br>';
          if (typeof id_ruang === "undefined") {
            msg += 'Klinik/Ruang <br>';
          }

          if (typeof id_dokter === "undefined") {
            msg += 'Dokter <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        let input=[];
        input                   = data_master;
        input['no_nota']        = no_nota;
        input['id_dokter']      = id_dokter;
        input['nama_dokter']    = nama_dokter;
        input['tgl_nota']       = tgl_nota;
        input['nama_pasien']    = data_master.nama_lengkap;
        input['alamat']         = data_master.alamat;
        input['id_kamar_rawat'] = id_kamar_rawat;
        input['id_unit_rawat']  = id_unit_rawat;
        input['jns_nota']       = gasmed["jns_nota_"+tipe];
        input['id_unit_depo']   = gasmed.unit.id_unit_gasmed;
        input['jns_rawat']      = data_master.ri_rj;
        input['ket_nota']       = keterangan;
        input['id_item']        = gasmed[tipe].id_item;
        input['id_satuan']      = gasmed[tipe].id_satuan;
        input['tgl_awal_gm']    = tgl_awal_gm;
        input['tgl_akhir_gm']   = tgl_akhir_gm;
        input['jml_menit']      = jml_menit;
        input['skala']          = skala;
        input['jml']            = jml;
        input['harga']          = harga;

        input['jns_kel']        = data_master.sex;
        
        console.log(input)

        $.ajax({
          url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: input,
            edit: edit,
            tipe: tipe,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
             notif('success',data.message);
             getData($('#txt-no_billing').val())
             $('#win-oksigen').window('close')
             $('#win-nitrogen').window('close')
             if(edit==0){
                setTimeout(function(){
                    cetak(1,data.no_nota)
                    }, 1000);
             }

          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function set_popup(tipe){
            $('#txt-label_pasien_'+tipe).text(data_master.nama_lengkap)
            $('#txt-label_norm_'+tipe).text("No. RM : "+data_master.no_mr)
            $('#txt-label_billing_'+tipe).text("No. Billing : "+data_master.id_mrs)
            $('#txt-kode_item_'+tipe).val(gasmed[tipe].kd_item)
            $('#txt-nama_item_'+tipe).val(gasmed[tipe].nama_item)
            $('#txt-id_satuan_'+tipe).val(gasmed[tipe].id_satuan)
            $('#skala_'+tipe).val( 1)
            get_harga(1);
            $('#win-'+tipe).window('open');
            set_pemakaian();
            set_total();
            $('#txt-total_'+tipe).numberbox('setValue', 0)
    }

    function hapus()
    {
      var row = $('#dtg-detail_item').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
        data={
          no_nota: row.no_nota,
          user_id  : "<?php echo $this->session->userdata['user_id'] ?>"
        } 

        // console.log(data); 
        swal.fire({
        "title"            : "Konfirmasi",
        "text"             : "Apakah Anda yakin Akan Menghapus Data?",
        "type"             : "warning",
        "showCancelButton" : true,
        "confirmButtonText": "Ya",
        "cancelButtonText" : "Tidak",
        "reverseButtons"   : false,
        "customClass"      : {
          "confirmButton"    : "btn-danger",
          "cancelButton"     : "btn-secondary"
        }
        }).then(function(result) {
            if (result.value) {
                    $.ajax({
                      url : "<?php echo base_url("farmasi/depo/pemakaian_gas_medik/hapus"); ?>",
                      type: "POST",
                      dataType: 'json',
                      data:{
                        data: data,
                        },
                      beforeSend: function (){               
                       },
                      success:function(data, textStatus, jqXHR){
                        notif('success',data.message);
                        // tab(0);
                        getData($('#txt-no_billing').val())
                      },
                      error: function(jqXHR, textStatus, errorThrown){
                          alert('Error,something goes wrong');
                      },
                      complete: function(){
                      }
                    });  
            }
        });  

    }

    function cetak(btn,no_nota)
    {
        var nota;
        var row = $('#dtg-detail_item').datagrid('getSelected');
        if(btn == 0 && row <= 0)
          {
              notif('warning','Data Belum Di Pilih');
              return false;
          }
        if(btn==1){
            nota=no_nota;
        }else{
            nota=row.no_nota;
        }
        $('#loader').css('display','');
        $.ajax({
            url     : "<?= base_url() ?>farmasi/depo/pemakaian_gas_medik/cetak",
            type    : "POST",
            dataType: 'json',   
            data:{
                no_nota: nota
            },
            success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
                var file_cetak ='Pemakaian Gas Medik '+nota+'.pdf';
                $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
                $("#modal_preview").modal("show");
                $('#win-cetak').window('close');
              }
            },
            fail: function (e) {  
                $('#loader').css('display','none');
            },
            error: function(jqXHR, textStatus, errorThrown){
              $('#loader').css('display','none');
              notif('info','Tidak Ada Data');
            }
        });
    }

    function reset_form(){
        // if(data.jns_nota==4){
        //     tipe="oksigen"
        //     $('#win-oksigen').window('open');
        //     $('#win-nitrogen').window('close');
        // }else{
        //     tipe="nitrogen"
        //     $('#win-nitrogen').window('open');
        //     $('#win-oksigen').window('close');
        // }
        $('#txt-label_pasien_'+tipe+'').text('')
        $('#txt-label_norm_'+tipe).text("No. RM : ")
        $('#txt-label_billing_'+tipe).text("No. Billing : ")

        $('#txt-no_nota_'+tipe).val('')
        $('#txt-tgl_nota_'+tipe).val(toAppDateFormat(new Date()))
        $('#cmb-klinik_ruang_'+tipe).val(''.concat(data.id_kamar_rawat,'-',data.id_unit_rawat)).change()
        $('#cmb-dokter_'+tipe).val(data.id_dokter).change()
        //data item
        $('#txt-kode_item_'+tipe).val('')
        $('#txt-nama_item_'+tipe).val('')
        $('#txt-id_satuan_'+tipe).val('')
        //waktu dam lama pemakaian
        $('#dtb-tgl_awal_'+tipe).datetimebox(new Date())
        $('#dtb-tgl_akhir_'+tipe).datetimebox(new Date())
        $('#txt-lama_jam_'+tipe).val(0)
        $('#txt-menit_'+tipe).val(0)
        $('#skala_'+tipe).val(1)
        $('#txt-pemakaian_'+tipe).val(0)
        $('#txt-harga_'+tipe).numberbox('setValue',0)
        $('#txt-total_'+tipe).numberbox('setValue',0)
        $('#txt-keterangan_'+tipe).val('')
    }
</script>