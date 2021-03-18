<script type="text/javascript">
	var id = "<?=$id?>";
	$(function(){
        filter();
		if(id != ''){
          getData(id)
        }else{
          tab(0);
        }
		// $('#win-detail_item').window('open');
		edit=0;
		tab(0);

		$('#nmb-subtotal').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#txt-tot_harga_grid').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })
		$('#txt-disc_harga_grid').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })
		$('#txt-subtotal_grid').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#nmb-ppn').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#nmb-biaya_lain').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            onChange: function(){
                set_total();
            },
        })

        $('#nmb-disc_nota').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            onChange: function(newValue,oldValue){
                var subtotal = $('#nmb-subtotal').numberbox('getValue');
                var discNota = $(this).val()
                if (discNota > subtotal) {
                    $(this).numberbox('setValue', oldValue)
                    notif('error','Tidak Boleh Melebihi Sub Total');
                    return false;
                }
                set_total();
            },
        })

        $('#nmb-total').numberbox({
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })

        $('#nmb-persen').numberbox({
            onChange: function(){
                set_total();
            },
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })


		$('#btn-tambah_detail_item').click(function(event) {
			filter_bpb();
		});
        
		$('#btn-cari_supplier').click(function(event) {
			$('#win-cari_supplier').window('open');
			filter_supplier();
		});

		$('#cmb-ppn').change(function (argument) {
            if ($(this).val() == 1) {
                $('#nmb-persen').numberbox('setValue', 0)
                $('#nmb-persen').numberbox({readonly : true})
            }else{
                $('#nmb-persen').numberbox({readonly : false})
            }
        })
	});

    $('#dtg-retur_pembelian').datagrid({
        singleSelect:true,
        idField     :'itemid',
        onDblClickRow:function(index,row){
            edit = 1;
            reset_form();
            set_read();
            getData(row.no_rt_pb);
        },
        columns:[[
         {field:'no_rt_pb',title:'No. Retur',width:"12%",halign:'center',align:'center'},
         {field:'tgl_rt_pb',title:'Tgl. Retur',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
         {field:'partner_name',title:'Nama Supplier',width:"25%",halign:'center',align:'left'},
         {field:'status_barang_caption',title:'Jenis Barang',width:"13%",halign:'center',align:'left'},
         {field:'jns_retur_caption',title:'Jenis Retur',width:"13%",halign:'center',align:'left'},
         {field:'total',title:'Total',width:"13%",halign:'center',align:'left', formatter: appGridMoneyFormatter},
         {field:'catatan',title:'Catatan',width:"25%",halign:'center',align:'left'},
         {field:'status_caption',title:'Status',width:"10%",halign:'center',align:'left'},
         {field:'created_by',title:'Dibuat Oleh',width:"10%",halign:'center',align:'center'},
         {field:'date_ins',title:'Tgl. Dibuat',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter},
         {field:'updated_by',title:'Diubah Oleh',width:"10%",halign:'center',align:'center'},     
         {field:'date_upd',title:'Tgl. Diubah',width:"15%",halign:'center',align:'center', formatter:appGridDateTimeFormatter}
        ]],
    });

	$('#dtg-detail_item').datagrid({
        singleSelect:true,
        iconCls     :'icon-',
        showFooter  :'true',
        idField     :'itemid',
        onDblClickRow:function(index,row){
        },
        columns:[[
            {field:'no_bpb',title:'No. BPB',width:'12%',halign :"center", align: "center"},
            {field:'kd_item',title:'Kode',width:'10%',halign :"center", align: "center"},
            {field:'nama_item',title:'Nama Item',width:'25%',halign :"center", align: "left"},
            {field:'id_satuan',title:'Satuan BPB',width:'10%',halign :"center", align: "left"},
            {field:'jml_bpb',title:'Jumlah BPB',width:'10%',halign :"center", align: "left", formatter: numberFormat,},
            {
            	field:'jml_retur',
            	title:'Jml. Retur',
            	width:'10%',
            	halign :"center",
            	align: "right",
            	formatter: numberFormat,
            	editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 0,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.'
                    }
                }
            },
            {
            	field:'harga',
            	title:'Harga',
            	width:'10%',
            	halign :"center",
            	align:"right", 
            	formatter: appGridMoneyFormatter,
            	editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :','
                    }
                }
            },
            {
            	field:'p_diskon',
            	title:'Disc. (%)',
            	width:'10%',
            	halign :"center", 
            	align:"right", 
            	formatter: numberFormat,
            	editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'min' : 0,
                        'required':true,
                        'groupSeparator' :'.',
                        onChange: function(){
                            var tot_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'tot_diskon'
                            });

                            var harga_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var jumlah_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_retur'
                            });

                            var persen = $(jumlah_ed.target).numberbox('getValue') * $(this).val()*$(harga_ed.target).numberbox('getValue') / 100

                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'tot_diskon');*/
                            $(tot_diskon_ed.target).numberbox('setValue', persen)
                        }
                    }
                }
            },
            {
            	field:'tot_diskon',
            	title:'Disc. (Harga)',
            	width:'10%',
            	halign :"center", 
            	align:"right", 
            	formatter: appGridMoneyFormatter,
            	editor : {
                    'type' : 'numberbox',
                    'options' : {
                        'precision' : 2,
                        'min' : 0,
                        onChange: function(){
                            var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'p_diskon'
                            });

                            var harga_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'harga'
                            });

                            var jumlah_ed = $('#dtg-detail_item').datagrid('getEditor', {
                                index: rowGridSelected,
                                field: 'jml_retur'
                            });

                            var persen = $(this).val()/($(harga_ed.target).numberbox('getValue') * $(jumlah_ed.target).numberbox('getValue') )*100

                            if (isNaN(persen)) {
                                persen = 0
                            }

                            

                            /*var x = $("#dtg-detail_item").datagrid('getColumnOption', 'p_diskon');*/
                            $(p_diskon_ed.target).numberbox('setValue', persen)
                        },
                        'required':true,
                        'groupSeparator' :'.',
                        'decimalSeparator' :','
                    }
                }
            },
            {field:'total',title:'Sub Total',width:'10%',halign :"center", align:"right", formatter: appGridMoneyFormatter},
            {field:'no_batch',title:'No. Batch',width:'10%',halign :"center", align:"left"},
            {field:'tgl_ed',title:'Tgl. PO',width:"10%",halign:'center',align:'center', formatter:appGridDateFormatter},
            {
                field:'action',title:'Action',width:'12%',align:'center',
                formatter:function(value,row,index){
                    console.log(row.no_bpb)

                    if(row.no_bpb == ''){
                        return '';
                    }else{
                        if (row.editing){
                            var s = '<button class="btn-action-save" type="button" href="javascript:void(0)" onclick="saverowdetail(this)">Save</button> &nbsp&nbsp&nbsp&nbsp';
                            var c = '<button class="btn-action-cancel" type="button" href="javascript:void(0)" onclick="cancelrowdetail(this)">Cancel</button>';
                            return s+c;
                        } else if(!row.editing) {
                            var e = '<button class="btn-action-edit" type="button" href="javascript:void(0)" onclick="editrowdetail(this)">Edit</button> &nbsp&nbsp&nbsp&nbsp';
                            var d = '<button class="btn-action-delete" type="button" href="javascript:void(0)" onclick="deleterowdetail(this)">Delete</button>';
                            return e+d;
                        }else{
                            return '';
                        }

                    }
                }
            }
        ]],
        onEndEdit:function(index,row){

        	row.total = (row.harga*row.jml_retur)-row.tot_diskon
        },
        onBeforeEdit:function(index,row){
            
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){

            row.editing = false;
            $(this).datagrid('refreshRow', index);
            set_total()
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }
    });

    function filter(){
        var dg = $('#dtg-retur_pembelian').datagrid('loadData', []);
        data= {
            status:$('#cmb-status').val(),
            start_date:toAPIDateFormat($('#dtb-start_date').val()),
            end_date:toAPIDateFormat($('#dtb-end_date').val()),
            criteria:$('#txt-criteria').val(),
            page:1,
            page_row:10
        }

        var dg = $('#dtg-retur_pembelian').datagrid({
          url : "<?php echo base_url("general/transaksi/retur_pembelian/filter"); ?>",
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

    function saverowdetail(target){
    	var p_diskon_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            field: 'p_diskon'
        });
        var persen = $(p_diskon_ed.target).numberbox('getValue')
    	if (persen > 100) {
        	notif('error','Diskon Tidak Boleh lebih dari 100');
        	return false;
        }

        var jml_retur_ed = $('#dtg-detail_item').datagrid('getEditor', {
            index: rowGridSelected,
            field: 'jml_retur'
        });

        var jml_retur = $(jml_retur_ed.target).numberbox('getValue')
        if (jml_retur < 0) {
            notif('error','Diskon Tidak Boleh Minus');
            return false;
        }

        $('#dtg-detail_item').datagrid('endEdit', getRowIndex(target));
        
    }
    function editrowdetail(target){
        var index = getRowIndex(target);
        rowGridSelected = index

        $('#dtg-detail_item').datagrid('beginEdit',index );
    }
    function deleterowdetail(target){
        swal.fire(cohapus()).then(function(result) {
              if (result.value) {
                $('#dtg-detail_item').datagrid('deleteRow', getRowIndex(target));
              }
        });
    }
    function cancelrowdetail(target){
        $('#dtg-detail_item').datagrid('cancelEdit', getRowIndex(target));
    }

    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }

    function filter_supplier(){
    	$('#dtg-supplier').datagrid('loadData', []);

        let criteria = $('#txt-kriteria_supplier').val();
        data = {
			criteria:criteria,
			page    : 1,
			page_row: 10,
        }

        var dg = $('#dtg-supplier').datagrid({
			url        : "<?php echo base_url("general/transaksi/retur_pembelian/filter_supplier"); ?>",
			method     : "POST",
			queryParams: data,
			loadFilter : function(data) {
            return {
				total: data.paging ? data.paging.rec_count : 0, 
				rows : data.data ? data.data : []
            }
          }
        });
    }

	function tambah(){
		edit=0;
		reset_form()
		set_read();
		$('#btn-hapus').hide();
		tab(1);
	}

	function tab(tab){
		if(tab==0){
			$('#browse').show();
			$('#detail').hide();
			filter()
		}
		else{
			$('#browse').hide();
			$('#detail').show();
		}
	}

	function set_read(){
		if(edit==1){
			$('#div_status').show();
			$('#btn-aksi').show();
            $('#btn-hapus').show();
		}
		else{
			$('#div_status').hide();
			$('#btn-aksi').hide();
		}
	}

	function cancel(){
		$('#win-cari_supplier').window('close');
		$('#win-cari_nopp').window('close');
		$('#win-detail_item').window('close');
	}

	function pilih_supplier() {
		var row = $('#dtg-supplier').datagrid('getSelected');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }
        $('#src-supplier').val(row.partner_id);
        $('#txt-alamat').val(row.data_partner);
        $('#txt-nama_supplier').val(row.partner_name);
        $('#win-cari_supplier').window('close');
	}

	function filter_bpb() {
		$('#dtg-filter_barang').datagrid('loadData', []);

        let criteria = $('#txt-kriteria-item-detail').val();
        let id_partner = $('#src-supplier').val();
        let status_barang = $('#cmb-jns-barang').val();

        if (id_partner == '') {
        	notif('warning','Supplier Belum dipilih!');
        	return false
        }
        $('#win-detail_item').window('open');
        data = {
        	id_partner: id_partner,
			criteria:criteria,
			status_barang : status_barang,
			page    : 1,
			page_row: 10,
        }

        var dg = $('#dtg-filter_barang').datagrid({
			url        : "<?php echo base_url("general/transaksi/retur_pembelian/filter_barang"); ?>",
			method     : "POST",
			queryParams: data,
			loadFilter : function(data) {
            return {
				total: data.paging ? data.paging.rec_count : 0, 
				rows : data.data ? data.data : []
            }
          }
        });
	}

	function pilih_barang() {
		var row = $('#dtg-filter_barang').datagrid('getSelections');

        if (row.length <= 0) {
            notif('warning','Data Belum dipilih!');
            return false;
        }

        for (var i = 0 ; i < row.length; i++) {
        	row[i]['jml_retur'] = 0;
			row[i]['harga'] = 0;
			row[i]['p_diskon'] = 0;
			row[i]['tot_diskon'] = 0;
			row[i]['subtotal'] = 0;
			row[i]['tot_diskon'] = 0;
			row[i]['total'] = 0;
			row[i]['id_satuan']=row[i]['id_satuan_retur']
        }

        $('#dtg-detail_item').datagrid('loadData', row);
        $('#win-detail_item').window('close');
        set_total()
	}

	function set_total() {
		var data = $("#dtg-detail_item").datagrid('getRows')
        var subtotal = 0;
        var totDisc = 0;
        var totHarga = 0
        var totHargaGrid = 0
        var totDiscGrid = 0
        var totSubtotalaGrid = 0
        if(data.length > 0){
            for(i=0 ; i < data.length ; i++){
                subtotal+=parseInt(data[i].total);
                totHargaGrid += parseInt(data[i].harga);
				totDiscGrid += parseInt(data[i].tot_diskon);
				totSubtotalaGrid += parseInt(data[i].total);
            }
        }
        var ppnPersen = $('#nmb-persen').numberbox('getValue');
        var ppn = ppnPersen / 100 * subtotal
		biayaLain = $('#nmb-biaya_lain').numberbox('getValue');
		disNota= $('#nmb-disc_nota').numberbox('getValue');

		var total = parseInt(subtotal) + parseInt(ppn) + parseInt(biayaLain) - parseInt(disNota);

		/*$('#txt-tot_harga_grid').numberbox('setValue',totHargaGrid)
		$('#txt-disc_harga_grid').numberbox('setValue',totDiscGrid)
		$('#txt-subtotal_grid').numberbox('setValue',totSubtotalaGrid)*/

		$('#nmb-ppn').numberbox('setValue',ppn);
        $('#nmb-subtotal').numberbox('setValue',subtotal);
        $('#nmb-total').numberbox('setValue',total);
        $('#dtg-detail_item').datagrid('reloadFooter', [{no_bpb:'', harga:totHargaGrid,tot_diskon:totDiscGrid, total:totSubtotalaGrid}]);
	}

	function reset_form(){
        $('#dtg-detail_item').datagrid('loadData',[]);
		$('#nmb-subtotal').numberbox('setValue',0);
		$('#nmb-disc_nota').numberbox('setValue',0);
		$('#nmb-persen').numberbox('setValue',0);
		$('#nmb-ppn').numberbox('setValue',0);
		$('#nmb-biaya_lain').numberbox('setValue',0);
		$('#nmb-total').numberbox('setValue',0);
		$('#txt-tot_harga_grid').numberbox('setValue',0)
		$('#txt-disc_harga_grid').numberbox('setValue',0)
		$('#txt-subtotal_grid').numberbox('setValue',0)

		$('#cmb-jns-barang').val('BT');
		$('#cmb-jns-retur').val('GB');
		$('#txt-no').val('')
    	$('#txt-nama_supplier').val('');
		$('#dtb-date_input').val(toAppDateFormat(new Date()))
		$('#txt-keterangan').val('')
		$('#txt-alamat').val('');
		$('#cmb-ppn').val(1).change()
		$('#src-supplier').val('');
		$('#dtg-detail_item').datagrid('loadData', []);
		$('#btn-cari_supplier').show()
		$('#cmb-jns-barang').prop('disabled', false);
		$('#cmb-jns-retur').prop('disabled', false);
		$('#btn-open').attr('hidden', false)
		$('#btn-release').attr('hidden', false)
		$('#btn-batal').attr('hidden', false)
		$('#btn-hapus').attr('hidden', false)
		$('.div_simpan').attr('hidden', false)
	}

	function simpan() {
		var no_rt_pb = $('#txt-no').val()
		var tgl_rt_pb = toAPIDateFormat($('#dtb-date_input').val())
		var catatan = $('#txt-keterangan').val()
		var ket_supplier = $('#txt-alamat').val();
		var jns_ppn = $('#cmb-ppn').val()
		var id_partner = $('#src-supplier').val();
		var subtotal = $('#nmb-subtotal').val()
		var tot_diskon = 0
		var diskon_nota = $('#nmb-disc_nota').val()
		var p_ppn = $('#nmb-persen').val()
		var tot_ppn = $('#nmb-ppn').val()
		var biaya_lain = $('#nmb-biaya_lain').val()
		var total = $('#nmb-total').val()
		var user_id = "<?php echo $this->session->userdata['user_id'] ?>";
		var status_barang = $('#cmb-jns-barang').val();
		var jns_retur = $('#cmb-jns-retur').val();

		var master = {
			no_rt_pb : no_rt_pb,
			tgl_rt_pb : tgl_rt_pb,
			catatan : catatan,
			jns_ppn : jns_ppn,
			subtotal : subtotal,
			tot_diskon : tot_diskon,
			diskon_nota : diskon_nota,
			p_ppn : p_ppn,
			tot_ppn : tot_ppn,
			biaya_lain : biaya_lain,
			total : total,
			user_id : user_id,
			id_partner: id_partner,
			ket_supplier: ket_supplier,
			status_barang : status_barang,
			jns_retur : jns_retur
		}
		if (id_partner == '') {
            notif('warning','Data Supplier Belum dipilih!');
            return false;
        }

        if (parseInt(subtotal) <= 0) {
            notif('warning','Total Tidak Boleh 0');
            return false;
        }
        

        var details = [];
        var row = $('#dtg-detail_item').datagrid('getRows');
        for (var i = 0 ; i < row.length; i++) {
        	details.push({
        		id_bpb_det: row[i]['id_bpb_det'],
        		no_bpb: row[i]['no_bpb'],
        		id_item: row[i]['id_item'],
        		id_satuan: row[i]['id_satuan'],
        		jml_retur: row[i]['jml_retur'],
        		harga: row[i]['harga'],
        		p_diskon: row[i]['p_diskon'],
        		tot_diskon: row[i]['tot_diskon'],
        		total: row[i]['total'],
        		tgl_ed: row[i]['tgl_ed'],
        		no_batch: row[i]['no_batch']
        	})
        }
        // console.log(details);
        // console.log(row);
        

        $.ajax({
			url : "<?php echo base_url("general/transaksi/retur_pembelian/simpan"); ?>",
			type: "POST",
			dataType: 'json',
			data:{
				master: master,
				details: details,
				edit:edit,
			},
			beforeSend: function (){               
			},
			success:function(data, textStatus, jqXHR){
				if (edit==0)
				{
					swal.fire(corelease(data.msg_release)).then(function(result) {
					if (result.value) {
						var dataVerifikasi = {
							no_po : data.no_po,
							user_id : "<?php echo $this->session->userdata['user_id'] ?>"
						}
						verifikasi(dataVerifikasi, 'release')
					}
					else
					{
						tab(0);
					}
					}); 
				}
				else
				{
				notif('success',data.message);
				tab(0);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
			// alert('Error,something goes wrong');
			notif('error','Error,something goes wrong');
			},
			complete: function(){
			}
		}); 
	}

    function getData(no_rt_pb){
      $.ajax({
        url : "<?php echo base_url("general/transaksi/retur_pembelian/getPerKode"); ?>",
        type: "POST",
        dataType: 'json',
        data:{
          data: no_rt_pb,
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          set_data(data);
          tab(1);
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','Error,something goes wrong');
        },
        complete: function(){
        }
      }); 
    }

    function set_data(data) {
    	$('#txt-no').val(data.master.no_rt_pb)
    	$('#txt-nama_supplier').val(data.master.partner_name);
		$('#dtb-date_input').val(toAppDateFormat(data.master.tgl_rt_pb))
		$('#txt-keterangan').val(data.master.catatan)
        $('#txt-label_nopm').text('No. Retur : '+data.master.no_rt_pb)
        $('#txt-label_status').text('Status : '+data.master.status_caption)
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
		$('#txt-alamat').val(data.master.ket_supplier);
		$('#cmb-ppn').val(data.master.jns_ppn).change()

		$('#src-supplier').val(data.master.id_partner);
		$('#nmb-disc_nota').numberbox('setValue',data.master.diskon_nota)
		$('#nmb-persen').numberbox('setValue',data.master.p_ppn)
        // console.log(data.master.subtotal)
		$('#nmb-ppn').numberbox('setValue',data.master.tot_ppn)
		$('#nmb-biaya_lain').numberbox('setValue', data.master.biaya_lain)
		// $('#nmb-total').numberbox('setValue',data.master.total)
        // $('#nmb-biaya_lain').numberbox('setValue',0);
		$('#cmb-jns-barang').val(data.master.status_barang);
		$('#cmb-jns-retur').val(data.master.jns_retur);
		$('#dtg-detail_item').datagrid('loadData', data.detail);
		$('#btn-cari_supplier').hide()
		$('#cmb-jns-barang').prop('disabled', true);
		$('#cmb-jns-retur').prop('disabled', true);

		$('#btn-open').attr('hidden', !data.master.m_open)
		$('#btn-release').attr('hidden', !data.master.m_release)
		$('#btn-batal').attr('hidden', !data.master.btn_batal)
		$('#btn-hapus').attr('hidden', !data.master.btn_hapus)
		$('.div_simpan').attr('hidden', !data.master.btn_simpan)
		/*if (data.master.jns_ppn == 1) {
			$('#nmb-persen').numberbox({readonly : true})
		}*/
		set_total()
    }

    function status(status) {
      var data={
        no_rt_pb : $('#txt-no').val(),
        user_id : "<?php echo $this->session->userdata['user_id'] ?>"
      }
      swal.fire(costatus()).then(function(result) {
          if (result.value) {
              verifikasi(data,status);
          }
      });
    }

    function verifikasi(data,status) {
        var no_rt_pb = data.no_rt_pb;
        $.ajax({
            url : "<?php echo base_url("general/transaksi/retur_pembelian/status"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
                data: data,
                status:status
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
                if(status=='open'&&data.success==true)
                {
                    getData(no_rt_pb);
                    notif('success',data.message);
                }
                else
                {
                    tab(0);
                    notif('success',data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                // alert('Error,something goes wrong');
                notif('error','Error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function hapus() {
		let no_rt_pb = $('#txt-no').val();
		let status_caption = $('#txt-status_caption').val();

		data={
			no_rt_pb : no_rt_pb,
			user_id: "<?php echo $this->session->userdata['user_id'] ?>"
		} 

		// console.log(data);

		swal.fire(cohapus()).then(function(result) {
			if (result.value) {
				$.ajax({
					url : "<?php echo base_url("general/transaksi/retur_pembelian/hapus"); ?>",
					type: "POST",
					dataType: 'json',
					data:{
						data: data,
					},
					beforeSend: function (){               
					},
					success:function(data, textStatus, jqXHR){
						notif('success',data.message);
						tab(0);
					},
					error: function(jqXHR, textStatus, errorThrown){
					// alert('Error,something goes wrong');
					notif('error','Error,something goes wrong');
					},
					complete: function(){
					}
				});
			}
		});
    }
</script>