<script type="text/javascript">
   $(document).ready(function () {
    console.log("ready!");
    $('#select_dokter-antri').select2({
//     placeholder: '-- Pilih Dokter',
//      required: true,
    });
    GetDataTable();
   });
   $('#btn-ubahnoantri').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     Panel = $('#winUbahNoAntri');
     $('#winUbahNoAntri').window('open').window('center');
     $.ajax({
      url: '<?= $urlData ?>updateantrianview',
      type: 'POST',
      dataType: 'JSON',
      data: {
       id_mrs: data_pasien.id_mrs
      },
      beforeSend: function () {
       Panel.find('form').form("clear");
       Panel.find('.before-loading').removeClass('d-none');
       Panel.find('.after-loading').addClass('d-none');
      },
      success: function (resp) {
       var status = resp.metadata;
       Panel.find('.after-loading').removeClass('d-none');
       Panel.find('.before-loading').addClass('d-none');
       Panel.find("input[name=id_mrs]").not('.easyui-radiobutton').not('.easyui-checkbox').val(data_pasien.id_mrs);
       if (status.err_code == 0) {
        resp = resp.rows[0];
        Panel.find('.nama_dokter').textbox("setValue", resp.nama_dokter);
        Panel.find('.no_antri').textbox("setValue", resp.no_antri);
        Panel.find('[name=dokter]').val(resp.dokter)
        Panelfind('[name=id_mrs]').val(resp.id_mrs)
       }
      },
      error: function (JqErr, textStatus, Xhrattr) {
       $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
       Panel.window('close');
      }
     })
    }
   });

   function SimpanAntrian() {
    var Panel = $("#winUbahNoAntri");
    if (!$("#FormUpdateNoAntri").form("validate")) {
     $.messager.alert("Peringatan!", "Isi Form Dengan Benar ", "info");
     $("#FormUpdateNoAntri").form("resetValidation");
    } else {
     SimpanData("#FormUpdateNoAntri", "UpdateAntrian", function (respon) {
      GetDataTable();
      Panel.window("close");
     })
    }
   }

   $("#btnFilter").click(function () {
    console.log($("#form-header-filter").form("validate"));
    if (!$("#form-header-filter").form("validate")) {
     $.messager.alert("Peringatan!", "Isi Form Dengan Benar ", "info");
     $("#form-header-filter").form("resetValidation");
    } else {
     $('#dgs').datagrid('gotoPage', 1);
     GetDataTable();
    }
   });

   function SimpanData(form, act, sukses = "") {
    $.ajax({
     type: "POST",
     url: "<?= $urlData ?>" + act,
     data: $(form).serialize(),
     dataType: "JSON",
     beforeSend: function () {
      $.messager.progress({
       text: 'Loading..'
      });
     },
     success: function (response) {
      $.messager.progress("close");
      if (response.metadata.error != 0) {
       swal.fire('Error!', response.metadata.message, 'error');
      } else {
       swal.fire('Sukses!', response.metadata.message, 'success');
       if (sukses != "") {
        sukses(response);
       }
      }
     },
     error: function (JqErr, textStatus, Xhrattr) {
//      $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
//      $.messager.progress("close");
      swal.fire('Error!', 'Terjadi kesalahan ketika memproses data', 'error');

     }
    });
   }

   function GetDataTable() {
    filter = $("#form-header-filter").serializeArray();
    console.log(filter);
    filter_data = setArray(filter);
    $('#dgs').datagrid({
     url: '<?= $urlData ?>updatenomoraktif',
     method: 'POST',
     queryParams: filter_data,
     onRowContextMenu: function (e, index, row) {
      e.preventDefault();
      data_pasien = row;
     }
    }
    );
   }

   function setArray(DataArray) {
    var data_x = [];
    $.each(DataArray, function (index, item) {
     data_x[item.name] = item.value;
    });
    return data_x;
   }

   function myformatter(date) {
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    // return y+'/'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    return (d < 10 ? ('0' + d) : d) + '/' + (m < 10 ? ('0' + m) : m) + '/' + y;
   }

   function myparser(s) {
    if (!s)
     return new Date();
    var ss = (s.split('/'));
    var y = parseInt(ss[2], 10);
    var m = parseInt(ss[1], 10);
    var d = parseInt(ss[0], 10);
    if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
     return new Date(y, m - 1, d);
    } else {
     return new Date();
    }
   }

   function empty(string) {
    return (string == undefined || string == "" || string == null);
   }
</script>