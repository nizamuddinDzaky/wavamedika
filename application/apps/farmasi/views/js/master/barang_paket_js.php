<script type="text/javascript">
	var edit_paket = 0;
	var edit_detail = 0;
	$(function(){
		filter()
		// $('#win-cari_barang').window('open');
		$('#btn-tambah_paket').click(function(event) {
			reset_form_paket()
			edit_paket = 0;
			$('#win-daftar_paket').window('open');
		});

		$('#btn-ubah').click(function(event) {
			reset_form_paket();
			set_form_paket();
			edit_paket = 1;
			$('#win-daftar_paket').window('open');
		});

		$('#btn-tambah_detail_barang').click(function(event) {

			var row = $('#dtg-daftar_paket').datagrid('getSelected');
			if(row <= 0){
			  notif('warning','Data Belum Di Pilih');
			  return false;
			}

			reset_form_detail()
			$('#win-detail_barang').window('open');
		});
		$('#btn-cari_barang').click(function(event) {
			filter_barang()
			$('#win-cari_barang').window('open');
		});

		$('#dtg-daftar_paket').datagrid({
	        iconCls:'icon-',
	        singleSelect:true,
	        idField:'itemid',
	        onClickRow: function(index,row){
				$('#dtg-detail_paket').datagrid('loadData', row.details);
			},
	        /*onDblClickRow:function(index,row){
	            $('#dtg-detail_paket').datagrid('loadData', row.details);
	        }*/
	    });

	    $('#txt-jumlah').numberbox({
            'min' : 0,
            'required':true,
            'groupSeparator' :'.',
            'decimalSeparator' :',',
        })
	})

	function tutup(){
		$('#win-daftar_paket').window('close');
		$('#win-detail_barang').window('close');
		$('#win-cari_barang').window('close');
	}

	function reset_form_paket() {
		$('#txt-id').val('')
		$("#txt-id").attr('disabled','disabled');
		$('#txt-nama_paket').val('')
		$("#chk-is_aktif").prop("checked", false);
	}

	function simpan_paket() {
		var id_paket_item = $('#txt-id').val()
		var nama_paket_item = $('#txt-nama_paket').val()
		var is_aktif = $("#chk-is_aktif").prop("checked");

		if (nama_paket_item == "") {
			notif('warning', 'Nama Paket Tidak Boleh Kosong');
			return false;
		}

		var data = {
			id_paket_item : id_paket_item,
			nama_paket_item : nama_paket_item,
			is_aktif : is_aktif,
			user_id : 1
		}

		$.ajax({
          url : "<?php echo base_url('farmasi/master/Barang_paket/simpan'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit_paket:edit_paket,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            tutup()
            filter()
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
	}

	function filter() {
		$('#dtg-daftar_paket').datagrid('loadData',[]);
        var criteria   = $('#txt-search').val();
        var status = $('#cmb-status').val()
      
        data={
          criteria : criteria,
          page:1,
          status: status,
          page_row:10
        } 

        var dg = $('#dtg-daftar_paket').datagrid({
          url : "<?php echo base_url("farmasi/master/Barang_paket/filter"); ?>",
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

	function set_form_paket() {
		var row = $('#dtg-daftar_paket').datagrid('getSelected');
		if(row <= 0){
		  notif('warning','Data Belum Di Pilih');
		  return false;
		}
		$('#txt-id').val(row.id_paket_item);
		$('#txt-nama_paket').val(row.nama_paket_item);
		
		if (row.status_aktif == 'Aktif') {
			$("#chk-is_aktif").prop("checked", true);
		}else{
			$("#chk-is_aktif").prop("checked", false);
		}
	}

	function hapus_paket() {
		var row = $('#dtg-daftar_paket').datagrid('getSelected');
		if(row <= 0){
		  notif('warning','Data Belum Di Pilih');
		  return false;
		}

      
      data={
        id_paket_item : row.id_paket_item,
        user_id: "<?php echo $this->session->userdata['user_id'] ?>"
      } 

      swal.fire(cohapus()).then(function(result) {
          if (result.value) {
              $.ajax({
                url : "<?php echo base_url("farmasi/master/Barang_paket/hapus_paket"); ?>",
                type: "POST",
                dataType: 'json',
                data:{
                  data: data,
                  },
                beforeSend: function (){               
                 },
                success:function(data, textStatus, jqXHR){
                  notif('success',data.message);
                  filter();
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

    function reset_form_detail() {
    	$('#txt-nama_barang').val('');
    	$('#txt-jumlah').numberbox('setValue','');
    	$('#txt-signa1').val('');
    	$('#txt-signa2').val('');
    	$('#txt-id_item').val('');
    	$("#txt-nama_barang").attr('disabled','disabled');
    }

    function filter_barang() {
    	$('#dtg-barang').datagrid('loadData',[]);
        var criteria   = $('#txt-kriteria_barang').val();
      
        data={
          criteria : criteria,
          page:1,
          page_row:10
        } 

        var dg = $('#dtg-barang').datagrid({
          url : "<?php echo base_url("farmasi/master/Barang_paket/filter_barang"); ?>",
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

    function pilih_item() {
    	var row = $('#dtg-barang').datagrid('getSelected');
    	if(row <= 0){
		  notif('warning','Data Belum Di Pilih');
		  return false;
		}

		$('#txt-nama_barang').val(row.nama_item);
		$('#txt-id_item').val(row.id_item);
		$('#win-cari_barang').window('close');
    }

    function tutup_win_cari_barang(argument) {
    	$('#win-cari_barang').window('close');
    }

    function simpan_detail() {
    	var row = $('#dtg-daftar_paket').datagrid('getSelected');
    	var id_paket_item = row.id_paket_item;
    	var jumlah = $('#txt-jumlah').numberbox('getValue');
    	var signa1 = $('#txt-signa1').val();
    	var signa2 = $('#txt-signa2').val();
    	var id_item = $('#txt-id_item').val();
		if (id_item == "") {
			notif('warning', 'Nama Item Tidak Boleh Kosong');
			return false;
		}

		if (jumlah == "") {
			notif('warning', 'Jumlah Tidak Boleh Kosong');
			return false;
		}

		var data = {
			id_paket_item: id_paket_item,
			jumlah: jumlah,
			signa1: signa1,
			signa2: signa2,
			id_item: id_item,
			user_id : 1
		}

		$.ajax({
          url : "<?php echo base_url('farmasi/master/Barang_paket/simpan_detail'); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit_detail:edit_detail,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            tutup()
            filter()
            $('#dtg-detail_paket').datagrid('loadData', []);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 
	}

	function set_form_detail() {
		reset_form_detail();
		var row = $('#dtg-detail_paket').datagrid('getSelected');
		if(row <= 0){
		  notif('warning','Data Detail Belum Di Pilih');
		  return false;
		}
		edit_detail = 1;
		$('#win-detail_barang').window('open');

		$('#txt-nama_barang').val(row.nama_item);
    	$('#txt-jumlah').numberbox('setValue',row.jumlah);
    	$('#txt-signa1').val(row.signa1);
    	$('#txt-signa2').val(row.signa2);
    	$('#txt-id_item').val(row.id_item);
	}

	function hapus_detail() {
		var row = $('#dtg-detail_paket').datagrid('getSelected');
		var row_paket = $('#dtg-daftar_paket').datagrid('getSelected');
		if(row <= 0){
		  notif('warning','Data Detail Belum Di Pilih');
		  return false;
		}

      	data={
        id_paket_item : row_paket.id_paket_item,
        id_item : row.id_item,
        user_id: "<?php echo $this->session->userdata['user_id'] ?>"
      	} 

      	swal.fire(cohapus()).then(function(result) {
          	if (result.value) {
              	$.ajax({
	                url : "<?php echo base_url("farmasi/master/Barang_paket/hapus_detail"); ?>",
	                type: "POST",
	                dataType: 'json',
	                data:{
	                  data: data,
	                  },
	                beforeSend: function (){               
	                 },
	                success:function(data, textStatus, jqXHR){
	                  notif('success',data.message);
	                  $('#dtg-detail_paket').datagrid('loadData', []);
	                  filter();
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