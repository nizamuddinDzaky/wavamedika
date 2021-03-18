<script type="text/javascript">
  var public_user_id;
  var roles = [];
	$(function(){
    get_select();
    filter();
		// $('#win').window('open');
		// $('#win-detail').window('open');
		tab(0);
		$('#btn-tambah').click(function(event) {
			// $('#win').window('open');
			// $('#tabel-role').hide();  
      reset_form();
      get_select();
			tab(1);
		});

		$('#btn-kembali').click(function(event) {
			// $('#win').window('close');
			tab(0);
		});

		$('#btn-simpan').click(function(event) {
      simpan();
			// $.messager.alert('Success','Tambah Role Berhasil');
			$('#tabel-role').show();
		});

		// $('#btn-tambah_detail').click(function() {
  //     getRole(public_user_id,roles);
		// 	// $('#win-detail').window('open');
		// });

		$('#btn-tutup').click(function(event) {
			$('#win-detail_akses_role  ').window('close');
		});

		$('#dg').datagrid({
			onDblClickRow:function(){
				view();
			}
		});

    $('#btn-tambah_detail').click(function(event) {
      $('#win-detail_akses_role').window('open');
      $('#txt-criteria_role').val('');
      filterModul();
    });
	})

    $('#cmb-data_unit').select2({
    dropdownParent : $('#detail'),
    placeholder: 'Pilih unit'
  });

  function get_select()
  {
      // body...
      $.ajax({
          url : "<?php echo base_url("admin/user/get_data_unit"); ?>",
          // url : "<?php echo base_url("farmasi/gudang/mutasi_barang/get_data_unit"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            criteria: "",
            },
          beforeSend: function (){               
          },
          success:function(data, textStatus, jqXHR){
             $("#cmb-data_unit").select2({ data: data });
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
      });
  }

  function simpan(mode){
        // var id_unit_asal = $('#cmb-data_unit option:selected').val();
        var user_id     = $('#txt-id').val();
        var user_pass   = $('#txt-password').val();
        var user_pass_2 = $('#txt-ulangi_password').val();
        var user_type   = $('#cmb-type option:selected').text();
        var is_active   = ($('input[name=chk-is_aktif]:checked').val()!=undefined);
        var unit_nama   = $('#cmb-data_unit option:selected').text();
        var unit_id_def = $('#cmb-data_unit option:selected').val();

        if(user_pass!=user_pass_2){
          swal.fire('Peringatan','Password Tidak Sama','warning');
          return false;
        }
        row = $('#dtg-daftar_akses_role').datagrid('getSelections');
        var details = [];
        for (var i=0; i<row.length; i++) {
            roles[roles.length]     =row[i]['role_id'];
        }
        console.log(roles);

        data={
          user_id    : user_id,
          user_pass  : user_pass,
          user_type  : user_type,
          is_active  : is_active,
          roles      : roles,
          nama_unit  : unit_nama,
          unit_id_def: unit_id_def
        }

         $.ajax({
          url : "<?php echo base_url("admin/user/simpan"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: data,
            edit:edit,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            if(mode==1){
              if(edit!=1){
                tab(0);
              }
              else{
                swal.fire("success",data.message,'success')
                tab(0);
              }
            }
            // else{

            // }
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 

  }

	function view(){
		$('#form-header').hide();
		$('#tabel1').hide();
		$('#form-btn').show();
		$('#form-detail').show();
		$('#tabel-role').show();
	}

	function tab(tab){
		if(tab==0){
			$('#form-header').show();
			$('#tabel1').show();
			$('#form-btn').hide();
			$('#form-detail').hide();
			$('#tabel-role').hide();
		}
		else{
			$('#form-header').hide();
			$('#tabel1').hide();
			$('#form-btn').show();
			$('#form-detail').show();
      $('#tabel-role').show();
		}
	}

	function filter()
    {
        $('#dtg-user').datagrid('loadData',[]);
        var status     = $('#cmb-status option:selected').val();
        var criteria   = $('#txt-criteria').val();
      
        data={
          status : status,
          criteria : criteria,
          page:1,
          page_row:10
        } 
        var dg = $('#dtg-user').datagrid({
          url : "<?php echo base_url("admin/user/filter"); ?>",
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

    $('#dtg-user').datagrid({
      singleSelect:true,
      onDblClickRow:function(index,row){
           btn_ubah();
    }
    });

    function btn_ubah()
    {
      edit = 1;
      var row = $('#dtg-user').datagrid('getSelected');
      if(row <= 0)
      {
          notif('warning','Data Belum Di Pilih');
          return false;
      }
      reset_form();
      getData(row.user_id);
    }

    function getData(user_id)
    {
        $.ajax({
          url : "<?php echo base_url("admin/user/getperkode"); ?>",
          type: "POST",
          dataType: 'json',
          data:{
            data: user_id,
            },
          beforeSend: function (){               
           },
          success:function(data, textStatus, jqXHR){
            // console.log(data);
            set_data(data);
            public_user_id = data.rows[0].user_id;
            roles = data.roles; 
            console.log(roles);
            tab(1);
          },
          error: function(jqXHR, textStatus, errorThrown){
              alert('Error,something goes wrong');
          },
          complete: function(){
          }
        }); 

    }

    function getRole(user_id,roles,criteria){
      // data={
      //     user_id : user_id,
      //     criteria: criteria,
      //     roles   : roles
      //   }
      dataAkses = [];

      $.ajax({
        url : "<?php echo base_url("admin/user/getroles"); ?>",
        type: "POST",
        dataType: 'json',
        async : false,
        data:{
          user_id : user_id,
          criteria: criteria,
          roles   : roles
          },
        beforeSend: function (){               
         },
        success:function(data, textStatus, jqXHR){
          dataAkses = data.rows;

          // $('#dtg-daftar_akses_role').datagrid('loadData',data.rows);
        },
        error: function(jqXHR, textStatus, errorThrown){
            notif('error','Error,something goes wrong');
        },
        complete: function(){
        }
    });

      return dataAkses;
        // var dg = $('#dtg-daftar_akses_role').datagrid({
        //   url        : "<?php echo base_url("admin/user/getroles"); ?>",
        //   method     : "POST",
        //   queryParams: data,
        //   loadFilter: function(data) {
        //     return {
        //       // total: data.paging ? data.paging.rec_count : 0, 
        //       rows : data.rows ? data.rows : []
        //     }
        //   }
        // });
    }

    function set_data(data)
    {
        detail_item=[];
        $('#txt-id').val(data.rows[0].user_id);
        if(data.rows[0].is_active==true){
              $('#chk-is_aktif').checkbox({
                  checked: true
              });
            }else{
              $('#chk-is_aktif').checkbox({
                  checked: false
              });
            }
        if(data.rows[0].user_type=='User'){
          $('#cmb-type').val(1).change();
        }else{
          $('#cmb-type').val(2).change();
        }
        $('#txt-nama_user').val(data.rows[0].user_name);
        // $('#txt-nik').val(data.rows[0].user_name);
        $('#txt-nama_lengkap').val(data.rows[0].user_fullname);
        $('#txt-email').val(data.rows[0].email);
        $('#txt-password').val(data.rows[0].user_pass);
        $('#txt-ulangi_password').val(data.rows[0].user_pass);
        $('#cmb-data_unit').val(data.rows[0].unit_id_def).change();
        $('#dtg-detail_role').datagrid('loadData',data.rows[0].roles);

        roles=data.roles;
    }

    function reset_form()
    {
        $('#chk-is_aktif').checkbox({
            checked: false
        });
        $('#cmb-type').val(1);
        $('#txt-nama_user').val('');
        $('#txt-nik').val('');
        $('#txt-nama_lengkap').val('');
        $('#txt-email').val('');
        $('#txt-password').val('');
        $('#txt-ulangi_password').val('');
        $('#txt-unit_default').val('');
        $('#dtg-detail_role').datagrid('loadData',[]);
        roles=[];
    }

    function filterModul()
    {
      // body...
      unselect('#dtg-daftar_akses_role');
      $('#dtg-daftar_akses_role').datagrid('loadData',[]);

    let role_id  = $('#txt-role_id').val();
    let criteria = $('#txt-criteria_role').val();

      let daftar = getRole(public_user_id,roles,criteria);

      $('#dtg-daftar_akses_role').datagrid('loadData',daftar);

      // if (daftar.length<1)
      // {
      //  notif("warning","Data Kosong");
      // }
      // else
      // {
      //  $('#dtg-daftar_akses_role').datagrid('loadData',daftar);
      // }
    }

    function unselect(datagrid)
    {
      // body...
      let rows = $(datagrid).datagrid('getRows');
        // alert(rows.length);
      for (i=0;i<rows.length;i++)
      {
        $(datagrid).datagrid('unselectRow', i);
      }
    }

    $('#btn-tambahkan_modul').click(function(){
      let rows = $('#dtg-daftar_akses_role').datagrid('getSelections');
      let detailitem = [];

      if (rows.length<1)
      {
        notif('warning','Belum ada data yang dipilih');
        return false;
      }

      // alert(rows.length);
    for (i=0;i<rows.length;i++)
    {
      detailitem.push(rows[i].role_id);
    }
    simpan(2);
    // simpanAkses(role_id,"modules",detailitem);
    getData(public_user_id);
    $('#txt-criteria_modul').val('');
    filterModul();

    // reloadDelay("modules",2000);
    // reloadDelay("modules",4000);
    });

    // function reloadDelay(akses,delay)
    // {
    //   setTimeout(function() {
    //   reloadAkses(akses);
    // }, delay);
    // }
</script>