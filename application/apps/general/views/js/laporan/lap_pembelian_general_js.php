<script type="text/javascript">
	var tabel_utama="dtg1";
	var url =1;
	$(function(){
		$('#tbl1').show();
		$('#tbl2').hide();
		$('#tbl3').hide();
		$('#tbl4').hide();
		$('#tbl5').hide();
		$('#tbl6').hide();
		$('#tbl7').hide();
		$('#tbl8').hide();
		$('#tbl9').hide();

		$('#cmb-jenis_laporan').change(function(argument) {
			table_pilihan($(this).val());
        });
        $('#cmb-jenis_laporan').val(2);
        $('#cmb-jenis_laporan').trigger('change');
        $('#cmb-jenis_laporan').val(1);
        $('#cmb-jenis_laporan').trigger('change');
        set_form();
		$('#dtg1').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onExpandRow: function(index,row){
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"12%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"10%",halign:'center',align:'left'},
			            {field:'jml_stok',title:'Jml. Stok',width:"10%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_mutasi',title:'Jml. Pemakaian',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'jml_minta',title:'Jml. Permintaan',width:"12%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_kebutuhan',title:'Tgl. Kebutuhan',width:"10%",halign:'center',align:'center',formatter:appGridDateFormatter},
	                ]],
	                onResize:function(){
	                    $('#dtg1').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg1').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg1').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg3').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onExpandRow: function(index,row){
	        	console.log(index);
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"6%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},
			            {field:'jml_bpb',title:'Jumlah',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'harga',title:'Harga',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'p_diskon',title:'Diskon (%)',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tot_diskon',title:'Diskon (Rp)',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'total',title:'Sub Total',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_ed',title:'Tgl. Kedaluwarsa',width:"8%",halign:'center',align:'center',formatter:appGridDateFormatter},
			            {field:'no_batch',title:'No. Batch',width:"8%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg3').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg3').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg3').datagrid('fixDetailRowHeight',index);

            }

        });

        $('#dtg5').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onExpandRow: function(index,row){
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"8%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"20%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"8%",halign:'center',align:'left'},
			            {field:'jml_bpb',title:'Jumlah',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'harga',title:'Harga',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'p_diskon',title:'Diskon (%)',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tot_diskon',title:'Diskon (Rp)',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'total',title:'Sub Total',width:"8%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_ed',title:'Tgl. Kedaluwarsa',width:"8%",halign:'center',align:'center',formatter: appGridDateFormatter},
			            {field:'no_batch',title:'No. Batch',width:"8%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg5').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg5').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg5').datagrid('fixDetailRowHeight',index);
            }
        });

        $('#dtg7').datagrid({
	        view: detailview,
	        detailFormatter:function(index,row){
	            return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
	        },
	        onExpandRow: function(index,row){
	            var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
	            ddv.datagrid({
	            	data:row.detail,
	                fitColumns:true,
	                singleSelect:true,
	                rownumbers:true,
	                loadMsg:'',
	                height:'auto',
	                columns:[[
	                    {field:'kd_item',title:'Kode',width:"9%",halign:'center',align:'left'},
			            {field:'nama_item',title:'Nama Item',width:"25%",halign:'center',align:'left'},
			            {field:'nama_satuan',title:'Satuan',width:"9%",halign:'center',align:'left'},
			            {field:'jml_bpb',title:'Jml. Terima',width:"9%",halign:'center',align:'right',formatter: appGridNumberFormatter},
			            {field:'tgl_ed',title:'Tgl. Kedaluwarsa',width:"9%",halign:'center',align:'left',formatter: appGridDateFormatter},
			            {field:'no_batch',title:'No. Batch',width:"9%",halign:'center',align:'left'},
	                ]],
	                onResize:function(){
	                    $('#dtg7').datagrid('fixDetailRowHeight',index);
	                },
	                onLoadSuccess:function(){
	                    setTimeout(function(){
	                        $('#dtg7').datagrid('fixDetailRowHeight',index);
	                    },0);
	                }
	            });
	            $('#dtg7').datagrid('fixDetailRowHeight',index);
            }
        });
	})

	function table_pilihan(id){
		$('#tbl1').hide();
		$('#tbl2').hide();
		$('#tbl3').hide();
		$('#tbl4').hide();
		$('#tbl5').hide();
		$('#tbl6').hide();
		$('#tbl7').hide();
		$('#tbl8').hide();
		$('#tbl9').hide();

		var nyala='#tbl'+id;
		tabel_utama = '#dtg'+id;
		$(nyala).show();
	}

	function filter()
	{
	  // $("#loader").css("display","");
	  $(tabel_utama).datagrid('loadData',[]);

	  url = $('#cmb-jenis_laporan option:selected').val();//name is posting not radio
	  tipe = $("input[name='radios']:checked").val();//name is posting not radio
	  // periode_belum = toAPIDateFormat($('#periode-belum-posting-mrs').datebox('getValue'));
  	  var start_date = toAPIDateFormat($('#dtb-start_date').val());
  	  var end_date = toAPIDateFormat($('#dtb-end_date').val());
  	  var month_period = $('#cmb-bulan option:selected').val();
  	  var year_period;
  	  var year_period_text;
  	  if(tipe==2){
  	  	year_period = $('#cmb-tahun1 option:selected').val();
  	  	year_period_text = $('#cmb-tahun1 option:selected').text();
  	  }
  	  else{
  	  	year_period = $('#cmb-tahun2 option:selected').val();
  	  	year_period_text = $('#cmb-tahun2 option:selected').text();
  	  }
	  // type = $('#jenis-kriteria-mrs').combobox('getValue');
	  // criteria = $('#kriteria-mrs').textbox('getValue');
	  // alert(tipe);
	  
      data={
			url             : url,
			rpt_period      : tipe,
			rpt_type        : 1,// 1=filter
			start_date      : start_date,
			end_date        : end_date,
			month_period    : month_period,
			year_period     : parseInt(year_period_text),
			year_period_text: year_period_text,
			page            : 1,
			page_row        : 10
      } 
	  console.log(data);
	  console.log(tabel_utama);
	  var dg = $(tabel_utama).datagrid({
	    url : "<?php echo base_url("general/laporan/lap_pembelian_general/filter"); ?>",
	    method: "POST",
	    queryParams: data,
	    loadFilter: function(data) {
	      // $("#loader").css("display","none");
	      // if (data.metadata.list_count<1)
	      // {
	      //   $.messager.alert('Warning','Daftar Kosong');
	      // }
	      return {
	        total: data.paging ? data.paging.rec_count : 0, 
            rows: data.data ? data.data : []
	      }
	    }
	  });
	}

// 	$('#btn-cetak').click(function(){
//   // var row = $('#dg').datagrid('getSelected');
//   // if (row == null){
//   //   $.messager.alert('Peringatan', 'Tidak ada data yang dipilih!');
//   //   return false;
//   // }
//   // // if(row.data_status == 'Open'){
//   // //   $.messager.alert('Warning','Data Belum Diverifikasi');
//   // //   return false;
//   // // }
//   // flagEditStatus = false;
//   get_print_transaksi(row);
//   // console.log(row);
// });
function cetak(){
    $('#loader').css('display','');
	var judul        = $("#cmb-jenis_laporan option:selected").text();
	url          = $('#cmb-jenis_laporan option:selected').val();//name is posting not radio
	tipe             = $("input[name='radios']:checked").val();//name is posting not radio
	// periode_belum = toAPIDateFormat($('#periode-belum-posting-mrs').datebox('getValue'));
	var start_date   = toAPIDateFormat($('#dtb-start_date').val());
	var end_date     = toAPIDateFormat($('#dtb-end_date').val());
	var month_period = $('#cmb-bulan option:selected').val();
	var year_period;
	var year_period_text;
  	    if(tipe==2){
			year_period      = $('#cmb-tahun1 option:selected').val();
			year_period_text = $('#cmb-tahun1 option:selected').text();
  	    }
  	    else{
			year_period      = $('#cmb-tahun2 option:selected').val();
			year_period_text = $('#cmb-tahun2 option:selected').text();

  	    }
  // type = $('#jenis-kriteria-mrs').combobox('getValue');
  // criteria = $('#kriteria-mrs').textbox('getValue');
  // alert(tipe);

	var cetak;
	if(url==1){
    	cetak = "print_transaksi1";//permintaan pembelian nota
	}else if(url==2){
		cetak = "print_transaksi2";//permintaan pembelian item
	}else if(url==3||url==5||url==7){
		cetak = "print_transaksi3";//penerimaan pembelian per nota
	}else if(url==4||url==6||url==8||url==9){
		cetak = "print_transaksi4";//penerimaan pembelian per nota
	}
	var file_cetak="";
	if(tipe==1){
		file_cetak = judul+' Tanggal '+convertDateDBtoIndo(start_date)+' sd '+convertDateDBtoIndo(end_date)+'.pdf';
	}else if(tipe==2){
		file_cetak = judul+' Bulan '+convert_to_bulan(month_period)+' Tahun '+year_period_text+'.pdf';
	}else{
		file_cetak = judul+' Tahun '+year_period_text+'.pdf';

	}
	// alert(file_cetak);
	data={
		url             : url,
		rpt_period      : tipe,
		rpt_type        : 1,// 1=filter
		start_date      : start_date,
		end_date        : end_date,
		month_period    : month_period,
		year_period     : parseInt(year_period_text),
		year_period_text: year_period_text,
		page            : 1,
		page_row        : 10,
		file_cetak      : file_cetak
	}
	// alert(file_cetak);
     
	    $.ajax({

			url     : "<?= base_url() ?>general/laporan/lap_pembelian_general/"+cetak,
			type    : "POST",
			dataType: 'json',	
			data    : data,
	  //     data:{
			// data : data,
			// judul: judul
	  //     },
	      success:function(data, textStatus, jqXHR){
	        if (data.success === true) {
	          $('#loader').css('display','none');
	            $("#frame_file_surat_detail").attr("src", "<?= base_url() ?>assets/file/"+file_cetak)
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

 //  $('body').on('click', '#btn-export', function () {
	// 	var judul        = $("#cmb-jenis_laporan option:selected").text();
	// 	var url          = $('#cmb-jenis_laporan option:selected').val();
	// 	var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
	// 	var rpt_period   = $("input[name='radios']:checked").val();			
	// 	var start_date   = toAPIDateFormat($('#dtb-start_date').val());
	// 	var end_date     = toAPIDateFormat($('#dtb-end_date').val());
	// 	var month_period = $('#cmb-bulan option:selected').val();
		
	// 	var rpt_type     = 2;
		
	// 	var type_file    = 2; // 2 adalah excel
		
	// 	var buffer       = true;

 //  	 	var year_period;

 //  	 	var cetak;
	// 	if(url==1){
	//     	cetak = "print_transaksi1";//permintaan pembelian nota
	// 	}else if(url==2){
	// 		cetak = "print_transaksi2";//permintaan pembelian item
	// 	}else if(url==3||url==5||url==7){
	// 		cetak = "print_transaksi3";//penerimaan pembelian per nota
	// 	}else if(url==4||url==6||url==8||url==9){
	// 		cetak = "print_transaksi4";//penerimaan pembelian per nota
	// 	}

	// 	var year_period_text;
	// 	if(rpt_type==2)
	// 	{
	// 		year_period      = $('#cmb-tahun1 option:selected').text();
	// 		year_period_text = $('#cmb-tahun1 option:selected').text();
	// 	}
	// 	else
	// 	{
	// 		year_period      = $('#cmb-tahun2 option:selected').text();
	// 		year_period_text = $('#cmb-tahun2 option:selected').text();
	// 	}
		
	// 	var file_cetak="";
	// 	if(rpt_period==1){
	// 		file_cetak = judul+' Tanggal '+convertDateDBtoIndo(start_date)+' sd '+convertDateDBtoIndo(end_date);
	// 	}else if(rpt_period==2){
	// 		file_cetak = judul+' Bulan '+convert_to_bulan(month_period)+' Tahun '+year_period_text;
	// 	}else{
	// 		file_cetak = judul+' Tahun '+year_period_text;
	// 	}


	// 	var url_control = "<?= base_url() ?>general/laporan/lap_pembelian_general/"+cetak;
	//  	// var url_control = "<?= base_url() ?>farmasi/gudang/Lap_mutasi_barang/excel";

	//     $('body').append($('<form/>')
	//     .attr({'action': ""+url_control+"", 'method': 'POST', 'id': 'replacer'})
	    
	//     .append($('<input/>')
	//     .attr({'type': 'hidden', 'name': 'type_file', 'value': ""+type_file+""})
	//     )
	//     .append($('<input/>')
	//     .attr({'type': 'hidden', 'name': 'buffer', 'value': ""+buffer+""})
	//     )
	//     .append($('<input/>')
	//     .attr({'type': 'hidden', 'name': 'url', 'value': ""+url+""})
	//     ) 
	//     .append($('<input/>')
	//     .attr({'type': 'hidden', 'name': 'jns_laporan', 'value':  ""+jns_laporan+""})
	//     )
	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'rpt_type', 'value':  ""+rpt_type+""})
	//     )
	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'rpt_period', 'value':  ""+rpt_period+""})
	//     )
	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'start_date', 'value':  ""+start_date+""})
	//     ) 
	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'end_date', 'value':  ""+end_date+""})
	//     )
	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'month_period', 'value':  ""+month_period+""})
	//     )
	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'year_period', 'value':  ""+year_period+""})
	//     )

	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'year_period_text', 'value':  ""+year_period+""})
	//     )

	//     .append($('<input/>')
	//       .attr({'type': 'hidden', 'name': 'file_cetak', 'value':  ""+file_cetak+""})
	//     )
	 
	//     ).find('#replacer').submit();

	//     setInterval(function(){
	//     	window.location.reload();
	//  	}, 3000);

	// });

	function set_form()
	{
		// body...
		var url          = $('#cmb-jenis_laporan option:selected').val();
		var jns_laporan  = $('#cmb-jenis_laporan option:selected').text();
		var rpt_period   = $("input[name='radios']:checked").val();			
		var start_date   = toAPIDateFormat($('#dtb-start_date').val());
		var end_date     = toAPIDateFormat($('#dtb-end_date').val());
		var month_period = $('#cmb-bulan option:selected').val();
		var judul        = $("#cmb-jenis_laporan option:selected").text();
		
		var rpt_type     = 2;
		
		var type_file    = 2; // 2 adalah excel
		
		var buffer       = true;

  	 	var year_period;

		var cetak;
		if(url==1){
	    	cetak = "print_transaksi1";//permintaan pembelian nota
		}else if(url==2){
			cetak = "print_transaksi2";//permintaan pembelian item
		}else if(url==3||url==5||url==7){
			cetak = "print_transaksi3";//penerimaan pembelian per nota
		}else if(url==4||url==6||url==8||url==9){
			cetak = "print_transaksi4";//penerimaan pembelian per nota
		}

			var year_period_text;
		if(rpt_type==2)
		{
			year_period      = $('#cmb-tahun1 option:selected').text();
			year_period_text = $('#cmb-tahun1 option:selected').text();
		}
		else
		{
			year_period      = $('#cmb-tahun2 option:selected').text();
			year_period_text = $('#cmb-tahun2 option:selected').text();
		}
		
		var file_cetak="";
		if(rpt_period==1){
			file_cetak = judul+' Tanggal '+convertDateDBtoIndo(start_date)+' sd '+convertDateDBtoIndo(end_date);
		}else if(rpt_period==2){
			file_cetak = judul+' Bulan '+convert_to_bulan(month_period)+' Tahun '+year_period_text;
		}else{
			file_cetak = judul+' Tahun '+year_period_text;
		}
		var url_control = "<?= base_url() ?>general/laporan/lap_pembelian_general/"+cetak;

		$('#type_file').val(type_file);
		$('#buffer').val(buffer);
		$('#url').val(url);
		$('#jns_laporan').val(jns_laporan);
		$('#rpt_type').val(rpt_type);
		$('#rpt_period').val(rpt_period);
		$('#start_date').val(start_date);
		$('#end_date').val(end_date);
		$('#month_period').val(month_period);
		$('#year_period').val(year_period);
		$('#year_period_text').val(year_period);
		$('#file_cetak').val(file_cetak);

		$('#form_excel').attr('action', url_control);
	}

	function export_excel()
	{
		// body...
		$('#form_excel').submit();
	}

	$(".change").change(function(){
	  // alert("The text has been changed.");
	  set_form();
	});
</script>