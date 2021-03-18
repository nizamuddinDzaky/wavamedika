<script type="text/javascript">
   $(document).ready(function () {
    console.log("ready!");
    $('#select_kelas').select2({
//     placeholder: '-- Pilih Kelas',
    });
    $('#select_kamar_mk').select2({
//     placeholder: '-- Pilih Kelas',
    });
    $('#select_jenis').select2({
//     placeholder: '-- Pilih Jenis',
    });
    GetDataTable()
   });

   $('#btn-catatan').click(function () {
    var Panel = $("#winCatatan");
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     Panel.window('open').window('center');
     data_pasien = row;
     $.ajax({
      url: '<?= $urlData ?>datakamarpasien',
      type: 'POST',
      dataType: 'JSON',
      data: {
       id_mr: data_pasien.id_mr
      },
      beforeSend: function () {
       Panel.find('form').form("clear");
       Panel.find('.before-loading').removeClass('d-none');
       Panel.find('.after-loading').addClass('d-none');
      },
      success: function (resp) {
       console.log(resp);
       var status = resp.metadata;
       Panel.find('.after-loading').removeClass('d-none');
       Panel.find('.before-loading').addClass('d-none');
       Panel.find('.no_mrs').html(data_pasien.id_mrs)
       Panel.find('.nama_pasien').html(data_pasien.nama_lengkap)
       Panel.find("input[name=id_mrs]").not('.easyui-radiobutton').not('.easyui-checkbox').val(data_pasien.id_mrs);
       $('.easyui-checkbox').checkbox({
        'checked': false,
        'disabled': false
       });
       $('.easyui-radiobutton').radiobutton("uncheck");
       if (status.err_code == 0) {

        Panel.find('.keterangan').textbox("setValue", resp.rows[0].keterangan);
        $.each(resp.rows[0], function (index, val) {
         if (!empty(val)) {
          Panel.find(".checkBox").find("." + index + "").checkbox("check");
          Panel.find(".radioButton").find("." + index + "").radiobutton("check");
          Panel.find("input[name=" + index + "]").not('.easyui-radiobutton').not('.easyui-checkbox').not(".easyui-textbox").val(val);
         }
        });
       }
      },
      error: function (JqErr, textStatus, Xhrattr) {
       swal.fire(
           'Peringatan!',
           'Error Proses Data!',
           'error'
           );
       Panel.window('close');
      }
     });
    }
   });

   $('#btn-indexpx').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     data_pasien = row;
     $('#winIndexPx').window('open').window('center');
     $.ajax({
      url: '<?= $urlData ?>IndexPasien',
      type: 'POST',
      dataType: 'JSON',
      data: {
       id_mr: data_pasien.id_mr
      },
      beforeSend: function () {
       $("#winIndexPx").find('.before-loading').removeClass('d-none');
       $("#winIndexPx").find('.after-loading').addClass('d-none');
      },
      success: function (resp) {
       var status = resp.metadata;
       if (status.err_code == 0) {
        $.each(resp.rows[0], function (index, val) {
         $("#winIndexPx").find('.' + index).html(val);
        });
        $("#winIndexPx").find('.after-loading').removeClass('d-none');
        $("#winIndexPx").find('.before-loading').addClass('d-none');
       } else {
        $.messager.alert("Peringatan!", status.message, "danger");
        $('#winIndexPx').window('close');
       }
      },
      error: function (JqErr, textStatus, Xhrattr) {
       $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
       $('#winIndexPx').window('close');
      }
     })
    }
   });

   $('#btn-masukkamar').click(function () {
    var Panel = $("#winPesanKamar");
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     Panel.window('open').window('center');
     $.ajax({
      url: '<?= $urlData ?>DataPesanKamar',
      type: 'POST',
      dataType: 'JSON',
      data: {
       id_mr: row.id_mr
      },
      beforeSend: function () {

      },
      success: function (resp) {
       var status = resp.metadata;
       if (status.err_code == 0) {
        dataPx = resp.rows[0];
        Panel.find('.mk_id_mr').val(row.id_mr);
        Panel.find('.mk_id_pesankamar').val(row.id_pesankamar);
        Panel.find('.mk_telepon2').val(row.telepon2);
        Panel.find('.mk_dari_kamar').val(row.dari_kamar);
        Panel.find('.mk_no_antriaktif').val(row.no_antriaktif);
        Panel.find('.mk_keterangan').val(row.keterangan);

        Panel.find('.mk_id_mrs').val(dataPx.id_mrs);
        Panel.find('.mk_nama_kamar').val(dataPx.nama_kamar);
        Panel.find('.mk_jenis').val(dataPx.jenis);
        Panel.find('.mk_dari_kelas').val(dataPx.dari_kelas);
        Panel.find('.mk_kelas_jenis').val(dataPx.kelas_jenis);
        Panel.find('.mk_telepon').val(dataPx.telepon);
       } else {
        swal.fire(
            'Error!',
            'Data Error!',
            'error'
            );
        Panel.window('close');
       }
      },
      error: function (JqErr, textStatus, Xhrattr) {
       swal.fire(
           'Error!',
           'Data Error!',
           'error'
           );
       $('#winIndexPx').window('close');
      }
     })
    }
   });

   $("#btnFilter").click(function () {
    if (!$("#form-header-filter").form("validate")) {
     $.messager.alert("Peringatan!", "Isi Form Dengan Benar ", "info");
     $("#form-header-filter").form("resetValidation");
    } else {
     GetDataTable();
    }
   });

   $('input[type=date-formatted]').each(function () {
    var format_date = "yyyy-mm-dd";
    if ($(this).data("format") !== null || $(this).data("format") !== undefined || $(this).data("format") !== '') {
     format_date = $(this).data("format");
    }

    if ($(this).val() === null || $(this).val() === undefined || $(this).val() === '') {
     $(this).val(moment().format("YYYY-MM-DD"));
    }

    $(this).datetimepicker({
     format: format_date,
     todayHighlight: true,
     setDate: 'today',
     autoclose: true,
     startView: 2,
     minView: 2,
     forceParse: 0,
     pickerPosition: 'bottom-left'
    });
   });

   function GetDataTable() {
    var filter = $("#form-header-filter").serializeArray();
    var filter_data = setArray(filter);
    $('#dgs').datagrid({
     url: '<?= $urlData ?>pesanantrikamar',
     method: 'POST',
     queryParams: filter_data,
     onRowContextMenu: function (e, index, row) {
      e.preventDefault();
      data_pasien = row;
     }
    }
    );
   }

   function updateMasukKamar() {
    var Panel = $("#winPesanKamar");
    var formData = $("#formPesanKamar");
    if (!formData.form("validate")) {
     swal.fire('Peringatan!', 'Isi Form Dengan Benar!', 'warning');
     formData.form("resetValidation");
    } else {
     SimpanData(formData, "PesanKamarCatatan", function (respon) {
      GetDataTable();
      Panel.find('.easyui-textbox').not('[name=thn]').textbox("setValue", "");
      Panel.window("close");
     })
    }
   }

   function updateCatatan() {
    var Panel = $("#winCatatan");
    var formData = $("#formCatatan");
    if (!formData.form("validate")) {
     swal.fire('Peringatan!', 'Isi Form Dengan Benar!', 'warning');
     formData.form("resetValidation");
    } else {
     SimpanData(formData, "PesanKamarCatatan", function (respon) {
      GetDataTable();
      Panel.find('.easyui-textbox').not('[name=thn]').textbox("setValue", "");
      Panel.window("close");
     })
    }
   }

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