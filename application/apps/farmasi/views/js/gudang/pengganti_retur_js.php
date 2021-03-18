<script type="text/javascript">
	
    var edit        = 0;
    var detail_item = [];
    var data_get    = [];
    var edit_detail = 0;

  	$(function(){
  		tab(0);

  		get_gudang();
  	});

  	$('#btn-cari_supplier').click(function(event) {
  		$('#txt-kriteria_supplier').val('');
  		filter_supplier();
  		$('#win-cari_supplier').window('open');
  	});

  	function pilih_supplier()
    {
        let row = $('#dtg-supplier').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#txt-partner_name').val(row.partner_name);
        $('#txt-partner_id').val(row.partner_id);
        $('#txt-alamat').val(row.partner_address);
        $('#win-cari_supplier').window('close');
    }

  	$('#btn-cari_noretur').click(function(event) {
  		let id_partner = $('#txt-partner_id').val();
  		if(id_partner=='')
          {
              notif('warning','Harap Pilih Supplier');
              return false;
          }
          $('#txt-kriteria_data_retur').val('');
          $('#txt-label_partner').text($('#txt-partner_name').val());
          filter_retur_pembelian();
  		$('#win-cari_noretur').window('open');
  	});

  	function pilih_retur_pembelian()
    {
        let row = $('#dtg-list_retur_pembelian').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di Pilih')
            return false;
        }
        $('#txt-no_retur').val(row.no_rt_pb);
        $('#txt-jns_ppn').val(row.jns_ppn);
        $('#dtb-tgl_retur').val(toAppDateFormat(row.tgl_rt_pb));
        $('#win-cari_noretur').window('close');
    }

  	$('#btn-tambah_detail_item').click(function(event) {
  		let no_rt_pb     = $('#txt-no_retur').val();
  		let partner_name = $('#txt-partner_name').val();
  		if(no_rt_pb == '')
      {
          notif('warning','Harap Pilih No. Retur');
          return false;
      }
      $('#txt-label_supplier_detail').text("Supplier : "+partner_name);
      $('#txt-label_no_retur_detail').text("No. Retur : "+no_rt_pb);
      filter_barang_retur();
  		$('#win-detail_item').window('open');
  	});

  	function pilih_barang_retur()
    {
        var data_grid = $('#dtg-detail_item').datagrid('getRows');;
    		var row       = $('#dtg-barang_retur').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        // console.log(data_grid);

        for (var i = 0 ; i < row.length; i++)
        {
    			row[i]['id_bpb_det']     = row[i]['id_bpb_det'];
    			row[i]['id_item']        = row[i]['id_item'];
    			row[i]['kd_item']        = row[i]['kd_item'];
    			row[i]['nama_item']      = row[i]['nama_item'];
    			row[i]['nama_satuan_rt'] = row[i]['nama_satuan'];
    			row[i]['id_satuan_rt']   = row[i]['id_satuan'];
    			row[i]['jml_rt']         = row[i]['jml_retur'];
    			
    			row[i]['jml_ganti']      = 1;
    			row[i]['tgl_ed']         = setDateNow();
    			row[i]['no_batch']       = 0;
        }

        var cek;
        for (var i = 0; i < row.length; i++)
        {
            cek = 0;
            for (var j = 0; j < data_grid.length; j++)
            {
                if (data_grid[j]['id_bpb_det']==row[i]['id_bpb_det'])
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
        unSelectDatagrid('#dtg-barang_retur');

        $('#win-detail_item').window('close');
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
        get_gudang();
        tab(1);
    }

    function btn_ubah()
    {
        var row = $('#dtg-pengganti_retur').datagrid('getSelected');
        if(row <= 0)
        {
            notif('warning','Data Belum Di pilih');
            return false;
        }
        edit = 1;
        reset_form();
        if(row.status_caption!="Open")
        {
            set_read(true);
        }
        else
        {
            set_read(false);
        }
        get_data(row.no_bpb);
    }

    function get_data(no)
    {
        $.ajax({
            url     : "<?php echo base_url("farmasi/gudang/pengganti_retur/getRetur"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data:no,
            },
            success:function(data, textStatus, jqXHR){
                set_form(data);
                tab(1);
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
        detail_item = [];
        data_get    = [];

        $('#dtg-detail_item').datagrid('loadData', data.details);
        
        detail_item = data.details;
        data_get    = data;
        
        $('#txt-label_no').text("No. BPB : "+data.master.no_bpb);

        if(data.master.status_caption!=null||data.master.status_caption!=undefined)
        {
          $('#txt-label_status').text("Status : "+data.master.status_caption);
        }
        if(data.master.status_posting!=null||data.master.status_posting!=undefined)
        {
          $('#txt-label_posted').text(" "+data.master.status_posting);
          if(data.master.status_posting=="Unposted")
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

        $('#txt-status_caption').val(data.master.status_caption);

        $('#txt-no_bpb').val(data.master.no_bpb);
        $('#dtb-tgl_bpb').val(toAppDateFormat(data.master.tgl_bpb));
        $('#cmb-gudang').val(data.master.id_gudang).change();
        $('#txt-partner_id').val(data.master.id_partner);
        $('#txt-partner_name').val(data.master.partner_name);
        $('#txt-alamat').val(data.master.partner_address);

        $('#txt-no_retur').val(data.master.no_rt_pb);
        $('#txt-jns_ppn').val(data.master.jns_ppn);
        $('#dtb-tgl_retur').val(toAppDateFormat(data.master.tgl_rt_pb));
        
        $('#txt-ket_bpb').val(data.master.ket_bpb);

        if(data.master.m_open==true)
        {
          $('#btn-open').show();
        }
        if(data.master.m_release==true)
        {
          $('#btn-release').show();
        }
    }

	  $('#dtg-pengganti_retur').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            btn_ubah();
        },
        columns:[[
         {field:'no_bpb',title:'No. Penerimaan',width:"12%",halign:'center',align:'center'},
         {field:'tgl_bpb',title:'Tgl. Penerimaan',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
         {field:'partner_name',title:'Nama Supplier',width:"25%",halign:'center',align:'left'},
         {field:'no_rt_pb',title:'No. Retur',width:"13%",halign:'center',align:'left'},
         {field:'tgl_rt_pb',title:'Tgl. Retur',width:"13%",halign:'center',align:'center', formatter:appGridDateFormatter},
         {field:'ket_bpb',title:'Catatan',width:"25%",halign:'center',align:'left'},
         {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'left'},
         {field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
         {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
         {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

    $('#dtg-detail_item').datagrid({
      title:'Detail Item',
      iconCls:'icon-',
      singleSelect:true,
      idField:'itemid',
      onDblClickRow:function(index,row){
        $.map($('#dtg-detail_item').datagrid('getRows'), function(row){
          var index = $('#dtg-detail_item').datagrid('getRowIndex', row);
          $('#dtg-detail_item').datagrid('updateRow', {
            index: index,
            row:{
              status:'P'
            }
          });
          $('#dtg-detail_item').datagrid('selectRow',index);
          $('#dtg-detail_item').datagrid('beginEdit',index);
        });
      },
      columns:[[
        {field:'id_bpb_det',title:'Id',width:50,halign:'center',align:'left',hidden:true},
        {field:'id_item',title:'Id',width:50,halign:'center',align:'left',hidden:true},
        {field:'id_satuan_rt',title:'Id',width:50,halign:'center',align:'left',hidden:true},
        {field:'jml_satuan_kecil',title:'Id',width:50,halign:'center',align:'left',hidden:true},
        {field:'id_satuan_kecil',title:'Id',width:50,halign:'center',align:'left',hidden:true},
        {field:'nama_satuan_kecil',title:'Id',width:50,halign:'center',align:'left',hidden:true},

        {field:'kd_item',title:'Kode',width:'10%',halign:'center',align:'left'},
        {field:'nama_item',title:'Nama Item',width:'40%',halign:'center',align:'left'},
        {field:'jml_rt',title:'Jml. Retur',width:'7%',halign:'center',align:'left',formatter:appGridNumberFormatter},
        {field:'nama_satuan_rt',title:'Satuan',width:'8%',halign:'center',align:'left'},
        {
          field:'jml_ganti',
          title:'Jml. Ganti',
          width:'7%',
          halign:'center',
          align:'right',
          formatter:appGridNumberFormatter,
          editor : {
              'type' : 'numberbox',
              'options' : {
                  'required':true,
                  'precision' : 0,
                  'min' : 1,
                  'groupSeparator' :'.',
                  'decimalSeparator' :',',
              }
          }
        },
        {
            field : 'tgl_ed',
            title : 'Tgl Kedaluwarsa',
            width : '9%',
            halign : 'center',
            align : 'center',
            formatter:appGridDateFormatter,
            editor : {
                type : 'datebox'
            }
        },
        {field:'no_batch',title:'No. Batch',width:'8%',halign:'center',align:'left',
        editor : {
                    type : 'textbox',
                    required : true
                }
    	},
        {field:'action',title:'Action',width:'12%',align:'center',
          formatter:function(value,row,index){
              if (row.editing){
                  var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp';
                  var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                  return s+c;
              } else {
                  var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp';
                  var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
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
          // console.log();
      },
      onCancelEdit:function(index,row){
          row.editing = false;
          $(this).datagrid('refreshRow', index);
      }
    });

    function saverowdetail(target)
    {
      var tot_jml_ganti_ed = $('#dtg-detail_item').datagrid('getEditor', {
          index: getRowIndex(target),
          field: 'jml_ganti'
      });

      var jml_ganti = $(tot_jml_ganti_ed.target).numberbox('getValue');

      var no_batch_ed = $('#dtg-detail_item').datagrid('getEditor', {
          index: getRowIndex(target),
          field: 'no_batch'
      });

      var no_batch = $(no_batch_ed.target).textbox('getValue');

     	var row = $('#dtg-detail_item').datagrid('getRows');
     	
     	var jml_rt = parseInt(row[getRowIndex(target)]['jml_rt']);

     	if (no_batch=="")
     	{
     		notif('warning','No. Batch Tidak Boleh Kosong');
        	return false;
     	}

        if (jml_ganti>jml_rt)
        {
        	notif('warning','Jumlah Ganti Lebih Besar dari Jumlah Retur');
        	return false;
        }
        else
        {
        	$('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
        }
    }
    function editrowdetail(target)
    {
        $('#dtg-detail_item').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterowdetail(target)
    {
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
              }
        });
    }
    function cancelrowdetail(target)
    {
        $('#dtg-detail_item').datagrid('cancelEdit', getRowIndex(target));
    }

    function getRowIndex(target)
    {
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function reset_form()
    {
        $('.div_simpan').show();
        $('.div_hidden').hide();

        $('#txt-label_no').text("No. BPB : ");
        $('#txt-label_status').text("Status : ");
        $('#txt-label_posted').text(" ");

        $('#txt-no_bpb').val('');
        $('#dtb-tgl_bpb').val(appDateFormatter(new Date()));
        $('#cmb-gudang').val('').change();
        $('#txt-partner_name').val('');
        $('#txt-partner_id').val('');
        $('#txt-alamat').val('');
        
        $('#txt-no_retur').val('');
        $('#txt-jns_ppn').val('');
        $('#dtb-tgl_retur').val(appDateFormatter(new Date()));
        
        $('#txt-ket_bpb').val('');

        $('#txt-status_caption').val('');
        
        reset_button();
        
        $('#dtg-detail_item').datagrid('loadData', []);
    }

    function reset_button()
    {
        // body...
        $('#btn-aksi').show();
        $('#btn-hapus').show();
        $('#btn-cetak').show();

        $('#btn-open').hide();
        $('#btn-release').hide();
    }

    function set_read(kondisi)
    {
        $('#txt-no_bpb').prop('disabled', true);
        $('#dtb-tgl_retur').prop('disabled', true);
        $('#dtb-tgl_bpb').prop('disabled', kondisi);
        $('#cmb-gudang').prop('disabled', kondisi);
        $('#txt-partner_name').prop('disabled', true);
        $('#txt-no_retur').prop('disabled', true);
        $('#txt-alamat').prop('disabled', true);
        $('#txt-ket_bpb').prop('disabled', kondisi);

        $('#btn-cari_supplier').prop('disabled', kondisi);
        $('#btn-cari_noretur').prop('disabled', kondisi);
        
        if (edit==0&&kondisi==false) //tambah
        {
          $('#div_status').hide();
          $('#btn-aksi').hide();
          $('#btn-hapus').hide();
          $('#btn-cetak').hide();

          $('.div_simpan').show();

          $('#dtg-detail_item').datagrid('showColumn', 'action');
        }

        if (edit==1&&kondisi==false) //ubah 
        {
            $('#cmb-gudang').prop('disabled', true);

            $('#btn-cari_supplier').prop('disabled', true);
  	        $('#btn-cari_noretur').prop('disabled', true);
            
            $('#div_status').show();
            $('#btn-aksi').show();
            $('#btn-hapus').show();
            $('#btn-cetak').show();

            $('.div_simpan').show();

            $('#dtg-detail_item').datagrid('showColumn', 'action');          
        }

        if (edit==0&&kondisi==true) //ubah readonly
        {
          $('#div_status').show();
          $('#btn-aksi').show();
          $('#btn-hapus').hide();
          $('#btn-cetak').show();

          $('.div_simpan').hide();

          $('#dtg-detail_item').datagrid('hideColumn', 'action');
        }
    }

    function simpan()
    {   
    		var no_bpb       = $('#txt-no_bpb').val();
    		
    		var tgl_bpb      = toAPIDateFormat($('#dtb-tgl_bpb').val());
    		var id_gudang    = $('#cmb-gudang option:selected').val();   
    		var id_partner   = $('#txt-partner_id').val();
    		var ket_supplier = $('#txt-alamat').val();
    		var no_rt_pb     = $('#txt-no_retur').val();
    		var jns_ppn      = $('#txt-jns_ppn').val();
    		var ket_bpb      = $('#txt-ket_bpb').val();
    		var user_id      = "<?php echo $this->session->userdata['user_id'] ?>";
        
        if (id_gudang == ''||id_partner == ''|| no_rt_pb == ''|| ket_bpb == '')
        {
          let msg = '<br>';

          if (id_gudang == '') {
            msg += 'Gudang <br>';
          }
          if (id_partner == '') {
            msg += 'Supplier <br>';
          }
          if (no_rt_pb == '') {
            msg += 'No. Retur <br>';
          }
          if (ket_bpb == '') {
            msg += 'Catatan <br>';
          }
          notif('warning',msg + ' Tidak Boleh Kosong');
          return false;
        }

        master={
    			tgl_bpb     : tgl_bpb,
    			// id_gudang   : id_gudang,
    			// id_partner  : id_partner,
    			// ket_supplier: ket_supplier, 
    			// no_rt_pb    : no_rt_pb, 
    			jns_ppn     : jns_ppn,
    			ket_bpb     : ket_bpb,
    			user_id     :  "<?php echo $this->session->userdata['user_id'] ?>"
        };
        
        if(no_bpb=='')
        {
    			master['id_gudang']    = id_gudang;
    			master['id_partner']   = id_partner;
    			master['ket_supplier'] = ket_supplier;
    			master['no_rt_pb']     = no_rt_pb;   
        }
        else
        {
        	master['no_bpb']=no_bpb;
        }

        var row_detail = $('#dtg-detail_item').datagrid('getRows');
        
        if(row_detail.length <= 0)
        {
            notif('warning','Detail Item Harus di isi!');
            return false;
        }

        var detail    = [];
        
        for (var i=0; i<row_detail.length; i++)
        {

        	if (row_detail[i]['no_batch']=='')
        	{
        		notif('warning','No. Batch Pada Detail Tidak Boleh Kosong');
	        	return false;
        	}

            detail.push({
      				id_bpb_det: row_detail[i]['id_bpb_det'],
      				id_item   : row_detail[i]['id_item'],
      				id_satuan : row_detail[i]['id_satuan_rt'],
      				jml_retur : row_detail[i]['jml_rt'],
      				jml_ganti : row_detail[i]['jml_ganti'],
      				tgl_ed    : setDate(row_detail[i]['tgl_ed']),
      				no_batch  : row_detail[i]['no_batch'],
            });
        }

        // console.log(master);
        // console.log(detail);
        // return false;

        $('#loader').css('display','');
        $.ajax({
          url : "<?php echo base_url('farmasi/gudang/pengganti_retur/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            master    : master,
            details   : detail,
            },
          beforeSend: function (){               
            },
          success:function(data, textStatus, jqXHR){
        	$('#loader').css('display','none');
         	if(edit!=1)
            {
                swal.fire(corelease(data.msg_release)).then(function(result) {
                  if (result.value)
                  {
                      status('release',data.no_bpb);
                  }
                  else
                  {
                    tab(0);
                  }
                }); 
            }
            else
            {
              if(data.error){
                notif('error',data.message);
              }else{
                notif('success',data.message);
              }
              tab(0);
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
              notif('error','something goes wrong');
          },
          complete: function(){
          }
        }); 
    }

    function filter()
    {
        $('#dtg-pengganti_retur').datagrid('loadData', []);

    		let startDate = toAPIDateFormat($('#dtb-start_date').val());
    		let endDate   = toAPIDateFormat($('#dtb-end_date').val());
    		let status    = $('#cmb-status').val();
    		let criteria  = $('#txt-criteria').val();
            
        data = {
    			status    : status,
    			start_date: startDate,
    			end_date  : endDate, 
    			criteria  : criteria,
    			page      : 1,
    			page_row  : 10,
        }

        var dg = $('#dtg-pengganti_retur').datagrid({
          url : "<?php echo base_url("farmasi/gudang/pengganti_retur/filter"); ?>",
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
        $('#dtg-supplier').datagrid('loadData', []);
        let criteria = $('#txt-kriteria_supplier').val();
        data = {
            criteria:criteria,
            page: 1,
            page_row: 10,
        }

        var dg = $('#dtg-supplier').datagrid({
          url : "<?php echo base_url("farmasi/gudang/pengganti_retur/filter_supplier"); ?>",
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

    function filter_retur_pembelian()
    {
        $('#dtg-list_retur_pembelian').datagrid('loadData', []);
        $('#dtg-list_retur_pembelian_detail').datagrid('loadData', []);
		    
        let criteria   = $('#txt-kriteria_data_retur').val();
		    let id_partner = $('#txt-partner_id').val();
        
        data = {
    			id_partner:id_partner,
    			criteria  :criteria,
    			page      : 1,
    			page_row  : 10,
        }

        var dg = $('#dtg-list_retur_pembelian').datagrid({
          url : "<?php echo base_url("farmasi/gudang/pengganti_retur/filter_retur_pembelian"); ?>",
          method: "POST",
          queryParams: data,
          loadFilter: function(data) {
            return {
              total: data.paging ? data.paging.rec_count : 0, 
              rows: data.data ? data.data : []
            }
          },
          onSelect: function(rowIndex, rowData)
          {
          	$('#dtg-list_retur_pembelian_detail').datagrid('loadData', rowData.details);
		      }
        });
    }

    function filter_barang_retur()
    {
        // body...
        $('#dtg-barang_retur').datagrid('loadData', []);
		    let no_rt_pb = $('#txt-no_retur').val();
        
        data = {
			   no_rt_pb:no_rt_pb
        }

        $.ajax({
          url : "<?php echo base_url("farmasi/gudang/pengganti_retur/filter_barang_retur"); ?>",
          type: "POST",
          dataType: 'json',
          data:data,
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            $('#dtg-barang_retur').datagrid('loadData', data.data);
          },
          error: function(jqXHR, textStatus, errorThrown){
             notif('error','Error,something goes wrong');
          },
          complete: function(){
          }
        });
    }

    function get_gudang()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/pengganti_retur/get_gudang"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-gudang").select2({ data: data });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
            complete: function(){
            }
        });
    }

    $('#cmb-gudang').on('select2:select', function (e) {
     	let data = e.params.data;
     	$('#txt-label_partner').text(data.nama_unit);
    });

    function status(status,no)
    {
        // body...
        var no_bpb;
        if (no==0)
        {
          no_bpb = $('#txt-no_bpb').val();
        }
        else
        {
          no_bpb = no;
        }

        if (no_bpb=="")
        {
          return false;
        }

        var data={
          no_bpb : no_bpb,
          user_id : "<?php echo $this->session->userdata['user_id'] ?>"
        }

        if (no==0)
        {
          swal.fire(costatus()).then(function(result) {
              if (result.value) {
                verifikasi(data,status); 
              }
          });
        }
        else
        {
          verifikasi(data,status);
        }
    }

    function verifikasi(data,status)
    {
        var no_bpb = data.no_bpb;
        $.ajax({
            url     : "<?php echo base_url("/farmasi/gudang/pengganti_retur/verifikasi"); ?>",
            type    : "POST",
            dataType: 'json',
            data    :{
                data: data,
                status : status
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                if(status=="open"&&data.success==true)
                {
                    reset_button();
                    get_data(no_bpb);
                    set_read(false);
                    notif('success',data.message);
                }
                else
                {
                    tab(0);
                    notif('success',data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error','Error, Something goes wrong');
            },
                complete: function(){
            }
        }); 
    }

    function hapus()
    {
        
        let no_bpb = $('#txt-no_bpb').val();

        data={
            no_bpb: no_bpb,
            user_id    : "<?php echo $this->session->userdata['user_id'] ?>"
        }

        swal.fire(cohapus()).then(function(result) {
          if (result.value) {
            $.ajax({
                url     : "<?php echo base_url("/farmasi/gudang/Pengganti_retur/hapus"); ?>",
                type    : "POST",
                dataType: 'json',
                data    :{
                    data: data,
                },
                beforeSend: function (){               
                },
                success:function(data, textStatus, jqXHR){
                    if (data.status_code==200)
                    {
                      let not_type = 'success';
                    }
                    else
                    {
                      let not_type = 'error';
                    }
                    notif(not_type,data.message);
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

    function cetak()
    {
      $('#loader').css('display','');  
    
      $.ajax({
        url     : "<?= base_url() ?>farmasi/gudang/Pengganti_retur/cetak",
        type    : "POST",
        dataType: 'json', 
        data    :data_get,
        success:function(data, textStatus, jqXHR){
          if (data.success === true)
          {
            $('#loader').css('display','none');
            var file_cetak ='Pengganti Retur No. BPB '+data_get.master.no_bpb+'.pdf';
            $("#modal_preview_detail").attr("src", "<?= base_url() ?>assets/laporan/"+file_cetak)
            $("#modal_preview").modal("show");
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

    function cancel()
    {
		  $('#win-cari_supplier').window('close');
  		$('#win-cari_noretur').window('close');
  		$('#win-detail_item').window('close');
	  }
</script>