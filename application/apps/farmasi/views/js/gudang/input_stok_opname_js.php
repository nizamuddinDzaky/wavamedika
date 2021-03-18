<script type="text/javascript">
	var status = 1;
	var criteria = "";
	var stok_opname = [];
	$(function(){
			
		tab(0);
		get_depo();
		get_alasan();
		$('#win-so').window('open');
		$('#cmb-depo').select2({
			placeholder:'Pilih Depo',
			dropdownParent:$('#win-so')
		});
		$('#cmb-rak').select2({
			placeholder:'Pilih Rak',
			dropdownParent:$('#win-so')
		});
		$('#cmb-alasan').select2({
			placeholder:'Pilih Keterangan',
			dropdownParent:$('#win-so')
		});

        $('.easyui-numberbox').numberbox({
            'precision' : 0,
            // 'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            // onChange: function(){
            //     set_total();
            // }
        });


	})

	$('#cmb-depo').on('select2:select', function (e) {
	    var data = e.params.data;
	    $("#txt-no_so").val(data.no_so)
	    stok_opname['id_unit']=data.id;
	    get_rak(data.id);
	});	

	$('#cmb-alasan').on('select2:select', function (e) {
	    var data = e.params.data;
        stok_opname['id_ket_selisih']=data.id;
	});	

	$('#cmb-rak').on('select2:select', function (e) {
	    var data = e.params.data;
	    $("#txt-pj_rak").val(data.nama_karyawan)
	});

	function tab(tab){
		if(tab==0){
			$('#browse').show();
			$('#detail1').hide();
			$('#detail2').hide();
		}
		else if(tab==2){
			$('#detail2').show();
			$('#detail1').hide();
			$('#browse').hide();
		}
		else{
			if($('#cmb-depo').val()=="" || $('#cmb-rak').val()==""){
				let msg = '';
		          if ($('#cmb-depo').val() == '') {
		            msg += 'Depo <br>';
		          }

		          if ($('#cmb-rak').val() == '') {
		            msg += 'Rak';
		          }
		          notif('warning',' Harap Pilih '+msg);
		          return false;
			}
			$('#browse').hide();
			$('#detail2').hide();
			$('#detail1').show();
			get_barang();
		}
	}

	function tutup(){
		$('#win-so').window('close');
	}

	function get_depo()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/input_stok_opname/get_data_depo"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-depo").select2({ 
               	data: data ,
				dropdownParent:$('#win-so')

               });

            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_alasan()
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/input_stok_opname/get_alasan"); ?>",
            type: "POST",
            dataType: 'json',
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-alasan").select2({ 
               	data: data ,
				dropdownParent:$('#win-so')

               });

            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_rak(id_unit)
    {
        // body...
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/input_stok_opname/get_data_rak"); ?>",
            type: "POST",
            dataType: 'json',
            data:{
            id_unit: id_unit,
            },
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
               $("#cmb-rak").select2({ 
               	data: data,
				dropdownParent:$('#win-so')
           	   });
            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error,something goes wrong');
            },
            complete: function(){
            }
        });
    }

    function get_barang()
    {
        let no_so = $("#txt-no_so").val();
        let depo = $("#cmb-depo").select2('data');
        let rak = $("#cmb-rak").select2('data');
        let id_lokasi = $("#cmb-rak").val();

        stok_opname['no_so']=no_so;
        stok_opname['id_lokasi']=id_lokasi;
	   	$('#label-daftar_barang').text(depo[0].text+' - '+rak[0].text);

        data={
          no_so : no_so,
          id_lokasi : 14,
          criteria : criteria,
          status : status,
        } 
        // data={
        //   no_so : "SO-202001-001",
        //   id_lokasi : 14,
        //   criteria : criteria,
        //   status : status,
        // } 
        $.ajax({
            url : "<?php echo base_url("farmasi/gudang/input_stok_opname/get_barang"); ?>",
            type: "POST",
            dataType: 'json',
            data:data,
            beforeSend: function (){               
            },
            success:function(data, textStatus, jqXHR){
	           $('#dtg-nama_item').datagrid('loadData', data.data);
        	   $('#label-selesai').text("Item Selesai : "+data.jml_item_selesai);
        	   $('#label-sisa').text("Item Sisa : "+data.jml_item_sisa);

            },
            error: function(jqXHR, textStatus, errorThrown){
                notif('error,something goes wrong');
            },
            complete: function(){
            }
        });
        $('#dtg-nama_item').datagrid('resize');
    }

    $("#chk-is_aktif").change(function() {
	    if(this.checked) {
	    	status=0;
			get_barang();
	    }else{
			status=1;
			get_barang();
	    }
	});

	// $('#txt-search').bind('keydown', function(e){
	//    if (e.keyCode == 13){
	//     criteria = $("#txt-search").val();
	//     get_barang();
	//     return false;
	//    }
	// });	
	function get_barang_key(){
		criteria = $("#txt-search").val();
		get_barang();
	}

	$('#txt-search').keyup(_.debounce(get_barang_key , 500));	

	$("#dtg-nama_item").datagrid({
     	onSelect: function(index, row) {
     		stok_opname['id_item']=row.id_item;
     		stok_opname['id_satuan']=row.id_satuan;
		        data={
		          id_item : stok_opname['id_item'],//5919,
		          id_unit : stok_opname['id_unit']
        		} 
 	   	        $.ajax({
	            url : "<?php echo base_url("farmasi/gudang/input_stok_opname/get_stok_sistem"); ?>",
	            type: "POST",
	            dataType: 'json',
	            data:data,
	            beforeSend: function (){               
	            },
	            success:function(data, textStatus, jqXHR){
	            	if(data.stok==false){
	            		notif('warning',"Tidak Ada Stok");
	            	}else{
		            	tab(2);
		            	$('#txt-stok_sistem').numberbox('setValue',data.stok);
		            	$('#txt-stok_fisik').numberbox('setValue','');
		            	$('#txt-selisih').numberbox('setValue','');
	
	        	   		$('#label-obat').text(row.nama_item);
	        	   		$('#label-kode').text('Kode : '+row.kd_item);
	        	   		$('#label-kelompok').text('Kelompok : '+row.nama_kel_item);
	        	   		$('#label-satuan').text('Satuan : '+row.id_satuan);
	        	   	}

	            },
	            error: function(jqXHR, textStatus, errorThrown){
	                notif('error,something goes wrong');
	            },
	            complete: function(){
	            }
	        });
		}
    });

    $('#txt-stok_fisik').numberbox({
            onChange: function(){
                set_selisih();
            },
            'precision' : 2,
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
            inputEvents: $.extend({}, $.fn.numberbox.defaults.inputEvents, {
                keypress: function (e) {
                    
                    /*var result = $.fn.numberbox.defaults.inputEvents.keypress.call(this, e);
                    if (e.keyCode == 35) {
//this doesn't work
                        $(e.data.target).textbox('setValue', '#');
                    }*/
                    // return result;
                }
            })
        })

    function set_selisih() {
    	let fisik = $('#txt-stok_fisik').val();
    	let sistem = $('#txt-stok_sistem').val();
        var selisih = fisik - sistem;
        if(selisih==0){
        	$('#cmb-alasan').val(0).change();
        	$('#cmb-alasan').attr('disabled', true);
        }else{
        	$('#cmb-alasan').attr('disabled', false);
        }
        $('#txt-selisih').numberbox('setValue', selisih);
        stok_opname['jml_sistem']=sistem;
        stok_opname['jml_fisik']=fisik;
        stok_opname['jml_selisih']=$('#txt-selisih').val();
        stok_opname['catatan']=$('#txt-stok_sistem').val();
        stok_opname['id_ket_selisih']=$('#cmb-alasan').val();
    }


    function simpan(){
    	if($('#txt-selisih').val()!=0 && $('#cmb-alasan').val()==0){
    		notif('warning',"Harap Pilih Keterangan Selisih");
    		return false;
    	}
    	if($('#txt-selisih').val()==0){
    		notif('warning',"Harap Isi Stok Fisik");
    		return false;
    	}
        stok_opname['catatan']=$('#txt-stok_sistem').val();
		$.ajax({
	            url : "<?php echo base_url("farmasi/gudang/input_stok_opname/simpan"); ?>",
	            type: "POST",
	            dataType: 'json',
	        data:{
				no_so         :stok_opname['no_so'],
				id_item       :stok_opname['id_item'],
				id_satuan     :stok_opname['id_satuan'],
				id_lokasi     :stok_opname['id_lokasi'],
				id_unit       :stok_opname['id_unit'],
				jml_sistem    :stok_opname['jml_sistem'],
				jml_fisik     :stok_opname['jml_fisik'],
				jml_selisih   :stok_opname['jml_selisih'],
				id_ket_selisih:stok_opname['id_ket_selisih'],
				catatan       :stok_opname['catatan']
            },
	            beforeSend: function (){               
	            },
	            success:function(data, textStatus, jqXHR){
	            	notif('success',data.message);
	            	tab(1);
	            },
	            error: function(jqXHR, textStatus, errorThrown){
	                notif('error,something goes wrong');
	            },
	            complete: function(){
	            }
	        });    	
    }


</script>
