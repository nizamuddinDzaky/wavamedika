<script type="text/javascript">
var edit = 0;
var detail_item;
var data_master;
var rowGridSelected      = 0;

	$(function(){
		tab(0);
    $('#dtg-retur_pemakaian_pasien').datagrid('loadData',[]);
    filter()
		$('#cmb-klinik_ruang').select2({
			placeholder:'Pilih Klinik/Ruang'
		})
		$('#cmb-dokter').select2({
			placeholder:'Pilih Dokter'
		})

		$('#btn-no_billing').click(function(event) {
      filter_billing()
			$('#win-cari_no_billing').window('open');
		});

		$('#btn-tambah_detail').click(function(event) {
      var a = $('#txt-no_billing').val();
      if(a==""){
        notif('warning','Harap Input No. Billing')
        return false;
      }
      filter_item()
			$('#win-tambah_detail').window('open');
		});
  })

  $('.easyui-numberbox').numberbox({
            'precision' : 2,
            // 'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            onChange: function(){
                // set_total();
            }
        });

	$('#dtg-retur_pemakaian_pasien').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            edit = 1;
            btn_ubah();
        },
        columns:[[
         	{field:'no_retur',title:'No. Retur',width:"12%",halign:'center',align:'left'},
         	{field:'tgl_retur',title:'Tgl. Retur',width:"8%",halign:'center',align:'center', formatter:appGridDateFormatter},
         	{field:'jns_bayar',title:'Status Pasien',width:"13%",halign:'center',align:'left'},
         	{field:'id_mrs',title:'No. Billing',width:"10%",halign:'center',align:'left'},
         	{field:'no_mr',title:'No. RM',width:"10%",halign:'center',align:'left'},
         	{field:'nama_pasien',title:'Nama Pasien',width:"25%",halign:'center',align:'left'},
         	{field:'nama_dokter',title:'Dokter',width:"25%",halign:'center',align:'left'},
         	{field:'nama_unit',title:'Unit',width:"15%",halign:'center',align:'left'},
         	{field:'total',title:'Total',width:"10%",halign:'center',align:'right', formatter:appGridNumberFormatter},
         	{field:'c_status_posting',title:'Status Posting',width:"10%",halign:'center',align:'left'},
         	{field:'user_ins_name',title:'Dibuat Oleh',width:"15%",halign:'center',align:'left'},
         	{field:'date_upd',title:'Tgl. Dibuat',width:"13%",halign:'center',align:'center', formatter: appGridDateFormatter},
         	{field:'user_upd_name',title:'Diubah Oleh',width:"15%",halign:'center',align:'left'},     
         	{field:'date_upd',title:'Tgl. Diubah',width:"13%",halign:'center',align:'center', formatter: appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
        singleSelect:true,
        idField:'itemid',
        showFooter:true,
        onDblClickRow:function(index,row){
        },
        columns:[[
          {field:'id_nota_det',title:'Kode',width:"13%",halign:'center',align:'left',hidden:true},
          {field:'kd_item',title:'Kode',width:"13%",halign:'center',align:'left'},
          {field:'id_item',title:'id',width:"13%",halign:'center',align:'left',hidden:true},
         	{field:'nama_item',title:'Obat/Alkes',width:"25%",halign :"center"},
         	{field:'id_satuan',title:'Satuan',width:"6%",halign:'center',align:'left'},
         	{field:'jml',title:'Jumlah',width:"8%",halign:'center',align:'right', formatter:datagridFormatNumber},
         	{field:'harga',title:'Harga',width:"8%",halign:'center',align:'right', formatter: datagridFormatNumber},
         	{field:'sub_total',title:'Sub Total',width:"8%",halign:'center',align:'right', formatter: datagridFormatNumber},
          {field:'hpp',title:'hpp',width:"8%",halign:'center',align:'right', formatter: datagridFormatNumber,hidden:true},
          {field:'sub_total_hpp',title:'Sub Total',width:"8%",halign:'center',align:'right', formatter: datagridFormatNumber,hidden:true},
          {field:'id_unit_depo',title:'id unit depo', formatter: datagridFormatNumber,hidden:true},
         	{field:'nama_unit',title:'Depo',width:"15%",halign:'center',align:'left'},
         	{field:'no_nota',title:'No. Nota',width:"12%",halign:'center',align:'left'},
            {field:'action',title:'Action',width:"12%",align:'center', hidden:true,
                formatter:function(value,row,index){
                    if (row.editing)
                    {
                        var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverow(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                        var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrow(this)">Cancel</button>';
                        return s+c;
                    } else if(!row.editing)
                    {
                        var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrow(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                        var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterow(this)">Delete</button>';
                        return e+d;
                    }
                }
            }
        ]],
        onEndEdit:function(index,row){
            //
        },
        onBeforeEdit:function(index,row){
            //
        },
        onAfterEdit:function(index,row){
            //
        },
        onCancelEdit:function(index,row){
            //
        }
    });

    $('#dtg-detail_item').datagrid('reloadFooter',[
        {"sub_total":0}
    ]);

    $('#dtg-item_retur').datagrid({
        singleSelect:false,
        idField:'itemid',
        showFooter:false,
        onDblClickRow:function(index,row){
          $.map($('#dtg-item_retur').datagrid('getRows'), function(row){
          var index = $('#dtg-item_retur').datagrid('getRowIndex', row);
          $('#dtg-item_retur').datagrid('updateRow', {
            index: index,
            row:{
              status:'P'
            }
          });
          $('#dtg-item_retur').datagrid('selectRow',index);
          $('#dtg-item_retur').datagrid('beginEdit',index);
        });
        },
        columns:[[
          {field:'no_nota',title:'No. Nota',width:"13%",halign:'center',align:'left'},
          {field:'tgl_nota',title:'Tgl. Nota',width:"10%",halign :"center", formatter:appGridDateFormatter},
          {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
          {field:'nama_item',title:'Nama Obat/Alkes',width:"25%",halign:'center',align:'right'},
          {field:'id_satuan',title:'Satuan',width:"12%",halign:'center',align:'right'},
          {field:'jml',title:'Jumlah',width:"13%",halign:'center',align:'right', formatter:datagridFormatNumber},
          {field:'jml_retur',title:'Jml. Retur',width:"13%",halign:'center',align:'right',
           editor : {
                      'type' : 'numberbox',
                      'options' : {
                          'required':true,
                          'precision' : 0,
                          'min' : 1,
                          'groupSeparator' :'.',
                          'decimalSeparator' :','
                        }
                     },
          formatter:datagridFormatNumber},

          {field:'action',title:'Action',width:"13%",align:'center',
                formatter:function(value,row,index){
                    if (row.editing)
                    {
                        var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                        var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                        return s+c;
                    } else if(!row.editing)
                    {
                        var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                        return e;
                    }
                }
            }
        ]],
        onEndEdit:function(index,row){
            //
        },
        onBeforeEdit:function(index,row){
          row.editing = true;
          $(this).datagrid('refreshRow', index);
      },
      onAfterEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
          // console.log();
      },
      onCancelEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      }
    });

    function saverowdetail(target){  
        var jml_retur_ed = $('#dtg-item_retur').datagrid('getEditor', {
            index: rowGridSelected,
            // index: getRowIndex(target),
            field: 'jml_retur'
        });
        var jml_retur = $(jml_retur_ed.target).numberbox('getValue');

        var batas=$('#dtg-item_retur').datagrid('getRows')[rowGridSelected].jml;

        // console.log(parseInt(batas));
        if (jml_retur > parseInt(batas)) {
            notif('warning','Jumlah Retur Melebihi Jumlah!');
            return false;
        }else{
            edit_detail = 0;
            $('#dtg-item_retur').datagrid('endEdit', getRowIndex(target));
        }

    }
    function editrowdetail(target){
        var index = getRowIndex(target);
        rowGridSelected = index;
        $('#dtg-item_retur').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterowdetail(target){
       swal.fire({
        "title"            : "Konfirmasi",
        "text"             : "Apakah Anda yakin akan menghapus data?",
        "type"             : "warning",
        "showCancelButton" : true,
        "confirmButtonText": "Ya",
        "cancelButtonText" : "Tidak",
        "reverseButtons"   : true,
        "customClass"      : {
        "confirmButton"    : "btn-danger",
        "cancelButton"     : "btn-secondary"
        }
        }).then(function(result) {
            if (result.value) {
              $('#dtg-item_retur').datagrid('deleteRow', getRowIndex(target));
            }
        });

        // $.messager.confirm('Confirm','Apakah Anda yakin akan menghapus data?',function(r){
        //     if (r){
        //       $('#dtg-item_retur').datagrid('deleteRow', getRowIndex(target));
        //     }
        // });
    }
    function cancelrowdetail(target){
        $('#dtg-item_retur').datagrid('cancelEdit', getRowIndex(target));
    }


    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function btn_tambah()
    {
        edit = 0;
        reset_form();
        $('#btn-hapus').hide();
        $('#btn-cetak').hide();

        // set_read(false);
        tab(1);
        $('#txt-no_billing').focus();
    }

    function tab(tab)
    {
        if(tab==0){
            $('#browse').show();
            $('#detail').hide();
            // filter();
            $('#dtg-retur_pemakaian_pasien').datagrid('resize');
        }
        else{
        	$('.div_hidden').hide();
            $('#browse').hide();
            $('#detail').show();
            $('#dtg-item_retur').datagrid('resize');
        }
    }

    function tutup(){
    	$('#win-cari_no_billing').window('close');
    	$('#win-tambah_detail').window('close');
    }

    function btn_hapus_det(){
    var dg = $('#dtg-detail_item');
    var row = dg.datagrid('getSelected');
    if(row){
      var row_index = dg.datagrid('getRowIndex', row);
      dg.datagrid('deleteRow', row_index);       
    }
    // console.log(detail_item);
    detail_item.splice(row_index,1)
    // console.log(detail_item);
    }

    function filter()
    {
        var start_date = toAPIDateFormat($('#dtb-start_date').val());
        var end_date   = toAPIDateFormat($('#dtb-end_date').val());
        var criteria   = $('#txt-kriteria_billing').val();
      
        data={
          tgl1    : start_date,
          tgl2    : end_date,
          criteria: criteria,
          page    : 1,
          page_row: 10
        } 

        var dg = $('#dtg-retur_pemakaian_pasien').datagrid({
          url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/filter"); ?>",
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

    function filter_billing()
    {
        
        var criteria   = $('#txt-kriteria_billing').val();
      
        data={
          jns_rawat: "RJ",
          criteria : criteria,
          page     : 1,
          page_row : 10
        } 

        var dg = $('#dtg-billing').datagrid({
          url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/filter_billing"); ?>",
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

    function pilih_billing(){
      var row = $('#dtg-billing').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        // console.log(row)
        data_master=row;
        $('#txt-no_billing').val(row.id_mrs);
        $('#txt-no_rm').val(row.no_mr);
        $('#txt-umur').val(row.umur);
        $('#txt-kelamin').val(row.sex);
        $('#txt-nama_pasien').val(row.nama_lengkap);
        $('#txt-status_pasien').val(row.status_karyawan);
        
        $('#cmb-klinik_ruang').val(row.id_unit).change();
        $('#cmb-dokter').val(row.id_dokter).change();
        $('#txt-kelas').val(row.kelas);
        $('#txt-jatah_kelas').val(row.kelas_hak);

        $('#win-cari_no_billing').window('close');
    }

    function pilih_item(){
      var row = $('#dtg-item_retur').datagrid('getSelections');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
      var data_grid = [];
      var data_grid = $('#dtg-detail_item').datagrid('getRows');
      for (var i = 0 ; i < row.length; i++) {
          row[i]['id_item']      = row[i]['id_item'];
          row[i]['kd_item']      = row[i]['kd_item'];
          row[i]['id_item']      = row[i]['id_item'];
          row[i]['nama_item']    = row[i]['nama_item'];
          row[i]['id_satuan']    = row[i]['id_satuan'];
          row[i]['jml']          = row[i]['jml_retur'];
          row[i]['harga']        = row[i]['harga'];
          row[i]['no_nota']      = row[i]['no_nota'];
          row[i]['sub_total']    = row[i]['jml_retur'] * row[i]['harga'];
          row[i]['hpp']          = row[i]['hpp'];
          row[i]['sub_total_hpp']= row[i]['jml_retur'] * row[i]['hpp'];
          row[i]['id_nota_det']  = row[i]['id_nota_det'];
          row[i]['id_unit_depo'] = row[i]['id_unit_depo'];
      }      

      var cek;
        for (var i = 0; i < row.length; i++)
        {
            cek = 0;
            for (var j = 0; j < data_grid.length; j++)
            {
                if (data_grid[j]['id_item']==row[i]['id_item'])
                {
                    cek=1;
                }
            }

            if (cek==0)
            {
                data_grid.push(row[i]);
            }
        }

      $('#dtg-detail_item').datagrid('loadData', []);
      $('#dtg-detail_item').datagrid('loadData', data_grid);
      
      $('#win-tambah_detail').window('close');
      set_total()
    }

    function set_total() {
        
        var data = $("#dtg-detail_item").datagrid('getRows');
        var tot_hpp = 0;
        var tot = 0;
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++){
                tot     += parseInt(data[i].sub_total);
                tot_hpp += parseInt(data[i].sub_total_hpp);
            }
        }
        var dg = $('#dtg-detail_item').datagrid('reloadFooter',[{"sub_total":tot,"sub_total_hpp":tot_hpp}]);
        $('#nmb-total').numberbox('setValue',tot);
        $('#nmb-total_hpp').numberbox('setValue',tot_hpp);

    }

    function cari_billing(no) {
    if(event.key === 'Enter') {
        // alert(ele.value); 
        cek_billing(no.value)       
      }
    }

    function cek_billing(no_billing)
    {

        $.ajax({
          url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/cek_billing"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_billing,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if(data.row_count==0){
              notif('warning','No. Billing Tidak Ditemukan');
              return false;
            }
            if(data.data.status_pulang==1){
              notif('warning','No. Billing tidak bisa digunakan, Data MRS tidak Aktif');
              return false;
            }

            notif('success','No. Billing Ditemukan');
            $('#txt-no_rm').val(data.data.no_mr);
            $('#txt-umur').val(data.data.umur);
            $('#txt-kelamin').val(data.data.sex);
            $('#txt-nama_pasien').val(data.data.nama_lengkap);
            $('#txt-status_pasien').val(data.data.status_karyawan);
            
            $('#cmb-klinik_ruang').val(data.data.id_unit).change();
            $('#cmb-dokter').val(data.data.id_dokter).change();
            $('#txt-kelas').val(data.data.kelas);
            $('#txt-jatah_kelas').val(data.data.kelas_hak);
            data_master=data.data;
            // console.log(data);
            // set_data(data);
            // tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function filter_item()
    {
        
        var criteria = $('#txt-kriteria_billing').val();
        var id_mrs   = $('#txt-no_billing').val();
      
        data={
          id_mrs  : id_mrs,
          // id_mrs  : "200805656",
          criteria: criteria,
          exlude_id :[1]
        } 

        var dg = $('#dtg-item_retur').datagrid({
          url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/filter_item"); ?>",
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

    function btn_ubah()
    {
      // body...
      edit = 1;
      var row = $('#dtg-retur_pemakaian_pasien').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      $('#btn-cetak').show();
      reset_form();
      getData(row.no_retur);
        $('#btn-hapus').show();
    //   if(row.c_status_posting!="Open")
    //   {
    //     set_read(true);
    //   }
    //   else
    //   {
    //     set_read(false);
    //   }
    }

    function getData(no_retur)
    {
        $.ajax({
          url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/getPerKode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: no_retur,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            data_master = data.master;
            set_total();
            set_data(data);
            tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    

    function set_data(data)
    {   
        var master = data_master;
        var detail = data.detail;
        // console.log(master);
        detail_item=[];
        $('#txt-label_retur').text("No. Retur : "+master.no_retur);
      
        if(master.status_karyawan!=null||master.status_karyawan!=undefined)
        {
          $('#txt-label_status').text("Status : "+master.status_karyawan);
        }
        if(master.c_status_posting!=null||master.c_status_posting!=undefined)
        {
          $('#txt-label_posted').text(" "+master.c_status_posting);
          if(master.c_status_posting=="Unposted")
          {
            $('#txt-label_posted').removeClass('posted');
            $('#txt-label_posted').addClass('unposted');
          }
          else
          {
            $('#txt-label_posted').removeClass('unposted');
            $('#txt-label_posted').addClass('posted');
          }
        }
        $('#txt-no_retur').val(master.no_retur);
        $('#dtb-tgl_retur').val(toAppDateFormat(master.tgl_retur));
        $('#txt-no_billing').val(master.id_mrs);
        $('#txt-no_rm').val(master.no_mr);
        $('#txt-umur').val(master.umur);
        $('#txt-kelamin').val(master.jns_kel);
        $('#txt-nama_pasien').val(master.nama_pasien);
        $('#txt-status_pasien').val(master.status_karyawan);
        
        $('#cmb-klinik_ruang').val(master.id_unit_rawat).change();
        $('#cmb-dokter').val(master.id_dokter).change();
        $('#txt-kelas').val(master.kelas);
        $('#txt-jatah_kelas').val(master.kelas_hak);
        
        $('#dtg-detail_item').datagrid('loadData', data.detail);
        detail_item=data.detail;
        
        $('#txt-keterangan').val(master.ket_retur);
        $('#nmb-total').numberbox('setValue',master.total);
        $('#nmb-total_hpp').numberbox('setValue',master.total);
        if(master.c_status_posting=="Posted"){ 
          $('#btn-hapus').hide();
        }
        
    }

    function simpan()
    {
        // var data=[];
        var no_retur      = $('#txt-no_retur').val();
        var tgl_retur     = toAPIDateFormat($('#dtb-tgl_retur').val());
        var total         = $('#nmb-total').numberbox('getValue');
        var tot_hpp       = $('#nmb-total_hpp').numberbox('getValue');
        var ket_retur     = $('#txt-keterangan').val();
        // if (tgl_pp == ''||
        // id_unit_asal == ''||
        // ket_pp == '')
        // {
        //   let msg = '<br>';
        //   if (tgl_pp == '') {
        //     msg += 'Tanggal PP <br>';
        //   }

        //   if (id_unit_asal == '') {
        //     msg += 'Unit Asal <br>';
        //   }

        //   if (ket_pp == '') {
        //     msg += 'Catatan <br>';
        //   }
        //   notif('warning',msg + ' Tidak Boleh Kosong');
        //   return false;
        // }

        master={
          no_retur     : no_retur,
          tgl_retur    : tgl_retur,
          total        : total,
          tot_hpp      : tot_hpp,
          ket_retur    : ket_retur
        }

        var input=[]; 
          input['master'] = data_master;
          input['master']['id_kamar_rawat'] = data_master.id_kamar;
          input['master']['id_unit_rawat']  = data_master.id_unit;
          input['master']['id_unit_depo']   = parseInt( "<?php echo $this->session->userdata['id_unit'] ?>");
          input['master']['jns_retur']      = 2;
          input['master']['jns_rawat']      = 'RJ';
          input['master']['no_retur']       = no_retur;
          input['master']['tgl_retur']      = tgl_retur;
          input['master']['total']          = parseInt(total);
          input['master']['tot_hpp']        = parseInt(tot_hpp);
          input['master']['ket_retur']      = ket_retur;
          input['master']['jns_kel']        = data_master.sex;
          input['master']['nama_pasien']    = data_master.nama_lengkap;
        // console.log(input);
        row = $('#dtg-detail_item').datagrid('getRows');
        // console.log(row);
        if(row.length <= 0){
          notif('warning','Detail Harus Di isi')
          return false;
        }
        // for (var i=0; i<row.length; i++) {
        //   if (row[i]['jml_minta']=='' || row[i]['jml_minta'] == 0 || row[i]['jml_minta'] == undefined) {
        //     notif('warning','Jumlah Permintaan '+row[i]['no_mutasi']+' tidak boleh Kosong')
        //     $('#dtg-item_retur').datagrid('selectRow',i);
        //     $('#dtg-item_retur').datagrid('beginEdit',i);
        //     return false;
        //     break;
        //   }

          // if (row[i]['tgl_kebutuhan']=='' || row[i]['tgl_kebutuhan'] == undefined) {
          //   $.messager.alert('Warning','Tanggal Kebutuhan '+row[i]['no_mutasi']+' tidak boleh Kosong');
          //   $('#dtg-item_retur').datagrid('selectRow',i);
          //   $('#dtg-item_retur').datagrid('beginEdit',i);
          //   return false;
          //   break;
          // }
        // }

        var details = [];
        for (var i=0; i<row.length; i++) {
          details.push({
            id_nota_det : row[i]['id_nota_det'],
            no_nota     : row[i]['no_nota'],
            id_item     : row[i]['id_item'],
            id_satuan   : row[i]['id_satuan'],
            jml         : parseInt(row[i]['jml']),
            harga       : parseInt(row[i]['harga']),
            hpp         : parseInt(row[i]['harga']),
            id_unit_depo: row[i]['id_unit_depo'],
          })
        }
        input['detail']= details;
        if(no_retur=="")
        {
        }
        else
        {
          input['master']['no_retur']=no_retur;
        }


        data['master']  =input['master'];
        data['detail'] =input['detail'];

        // console.log(data);
        // console.log(input);

        $.ajax({
          url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data : data,
            edit : edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
              notif('success',data.message);
              if(edit==0){
                setTimeout(function(){
                    cetak(1,data.no_retur)
                    }, 1000);
              }
              tab(0);

          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function cetak(mode,no)
    {
        var no_retur;
        if(mode==0){
            no_retur = $('#txt-no_retur').val();
        }else{
          no_retur=no;
        }
        $('#loader').css('display','');
        $.ajax({
            url     : "<?= base_url() ?>farmasi/depo/retur_pemakaian_pasien/cetak",
            type    : "POST",
            dataType: 'json',   
            data:{
                no_retur: no_retur
            },
            success:function(data, textStatus, jqXHR){
            if (data.success === true) {
              $('#loader').css('display','none');
                var file_cetak ='Retur Pemakaian ObatAlkes '+no_retur+'.pdf';
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

    function hapus( )
    {
        var no_retur = $('#txt-no_retur').val();
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
                      url : "<?php echo base_url("farmasi/depo/retur_pemakaian_pasien/hapus"); ?>",
                      type: "POST",
                      dataType: 'json',
                      data:{
                        no_retur: no_retur,
                        },
                      beforeSend: function (){               
                       },
                      success:function(data, textStatus, jqXHR){
                        notif('success',data.message);
                        tab(0);
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

     function reset_form(){
        $('#txt-label_retur').text("No. Retur : ");
        $('#txt-label_status').text("Status : ");
        $('#txt-label_posted').text(" ");
       
        $('#txt-no_retur').val('');
        $('#dtb-tgl_retur').val(toAppDateFormat(new Date()));
        $('#txt-no_billing').val('');
        $('#txt-no_rm').val('');
        $('#txt-umur').val('');
        $('#txt-kelamin').val('');
        $('#txt-nama_pasien').val('');
        $('#txt-status_pasien').val('');
        
        $('#cmb-klinik_ruang').val(0).change();
        $('#cmb-dokter').val(0).change();
        $('#txt-kelas').val('');
        $('#txt-jatah_kelas').val('');
        
        $('#dtg-detail_item').datagrid('loadData',[]);
        
        $('#txt-keterangan').val('');
        $('#nmb-total').numberbox('setValue',0);
        $('#nmb-total_hpp').numberbox('setValue',0);

     }

</script>
