<script type="text/javascript">
   var data_pasien, default_date = "<?= date("d/m/Y") ?>";

   $(document).ready(function () {
    console.log("ready!");
    $('#select_unit').select2({
     placeholder: '-- Pilih Unit',
//      required: true,
    });
    GetDataTable();
   });

   $(".jenis-kamar-index").combobox({
    onChange: function (nv, ov) {
     $(".jenis-kelas-index").combobox("clear");
     $(".jenis-kelas-index").combobox({
      url: url,
      method: 'post',
      queryParams: {
       act: "JenisKelasIndex",
       jenis: nv,
      },
      valueField: 'kelas',
      textField: 'kelas'
     });
    }
   });

   $('#btn-status_kamar').click(function () {
    var Panel = $("#winStatusKamar");
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
      url: '<?= $urlData ?>mrsprivasiview',
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
       $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
       Panel.window('close');
      }
     });
    }
   });

   $('#btn-privasi_pasien').click(function () {
    var Panel = $("#winPrivasiPasien");
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
      url: '<?= $urlData ?>mrsprivasiview',
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
       $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
       Panel.window('close');
      }
     });
    }
   });

   $('#btn-pesan_kamar').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     data_pasien = row;
     var Panel = $("#winPesanKamar");
     Panel.window('open').window('center');
     var ketPasien = data_pasien.sex + " | " + data_pasien.umur;
     ketPasien += (data_pasien.kecamatan != "" ? " | " + data_pasien.kecamatan : "");
     Panel.window('open').window('center');
     Panel.find('form').form("clear");
     Panel.find('.jenis-kelas-index').combobox("clear");
     Panel.find('.nama_lengkap').html(data_pasien.nama_lengkap);
     Panel.find('.keterangan').html(ketPasien);
     $.ajax({
      url: '<?= $urlData ?>datapesankamar',
      type: 'POST',
      dataType: 'JSON',
      data: {
       id_mr: data_pasien.id_mr
      },
      beforeSend: function () {
       Panel.find('.before-loading').removeClass('d-none');
       Panel.find('.after-loading').addClass('d-none');
      },
      success: function (resp) {
       var status = resp.metadata;
       if (status.err_code == 0) {
        $.each(resp.rows[0], function (index, val) {
         Panel.find('.easyui-textbox.' + index).textbox("setValue", val);
        });
        Panel.find('.id_mr').val(data_pasien.id_mr);
        Panel.find('.after-loading').removeClass('d-none');
        Panel.find('.before-loading').addClass('d-none');
       } else {
        swal.fire('Peringatan!', status.message, 'error');
        Panel.window('close');
       }
      },
      error: function (JqErr, textStatus, Xhrattr) {
       swal.fire('Error!', 'Terjadi Kesalahan Proses Data', 'error');
       Panel.window('close');
      }
     });

    }
   });

   $('#btn-info_pasien').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     data_pasien = row;
     var Panel = $("#winInfoPasien");
     var ketPasien = data_pasien.sex + " | " + data_pasien.umur;
     Panel.window('open').window('center');
     ketPasien += (data_pasien.kecamatan != "" ? " | " + data_pasien.kecamatan : "");
     Panel.window('open').window('center');
     Panel.find('form').form("clear");
     Panel.find('.nama_lengkap').html(data_pasien.nama_lengkappx);
     Panel.find('.keterangan').html(ketPasien);
     $.ajax({
      url: '<?= $urlData ?>infopasien',
      type: 'POST',
      dataType: 'JSON',
      data: {
       id_mr: data_pasien.id_mr
      },
      beforeSend: function () {
       Panel.find('.before-loading').removeClass('d-none');
       Panel.find('.after-loading').addClass('d-none');
      },
      success: function (resp) {
       var status = resp.metadata;
       if (status.err_code == 0) {
        $.each(resp.rows[0], function (index, val) {
         Panel.find('.' + index).html(val);
        });
        Panel.find('.after-loading').removeClass('d-none');
        Panel.find('.before-loading').addClass('d-none');
       } else {
        swal.fire('Peringatan!', status.message, 'error');
        Panel.window('close');
       }
      },
      error: function (JqErr, textStatus, Xhrattr) {
       swal.fire('Error!', 'Terjadi Kesalahan Proses Data', 'error');
       Panel.window('close');
      }
     });
    }
   });

   $('#btn-print_sticker').click(function () {
    var row = $('#dgs').datagrid('getSelected');
    if (row <= 0) {
     swal.fire(
         'Peringatan!',
         'Data Belum Dipilih!',
         'warning'
         );

    } else {
     data_pasien = row;
     var Panel = $("#winPrintSticker");
     Panel.window('open').window('center');
     var ketPasien = data_pasien.sex + " | " + data_pasien.umur;
     ketPasien += (data_pasien.kecamatan != "" ? " | " + data_pasien.kecamatan : "");
     Panel.window('open').window('center');
     Panel.find('form').form("clear");
     Panel.find('.nama_lengkap').html(data_pasien.nama_lengkap);
     Panel.find('.keterangan').html(ketPasien);
    }
   });

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

   function SimpanStatKamar() {
    var Panel = $("#winStatusKamar");
    var formData = $("#formStatusKamar");
    if (!formData.form("validate")) {
     swal.fire('Peringatan!', 'Isi Form Dengan Benar!', 'warning');
     formData.form("resetValidation");
    } else {
     SimpanData("#formStatusKamar", "mrestatkamar", function (respon) {
      GetDataTable();
      Panel.window("close");
     });
    }
   }

   function simpanPrivasi() {
    var Panel = $("#winPrivasiPasien");
    var formData = $("#formPrivasiPasien");
    if (!formData.form("validate")) {
     swal.fire('Peringatan!', 'Isi Form Dengan Benar!', 'warning');
     formData.form("resetValidation");
    } else {
     SimpanData(formData, "MrsPrivasiInsert", function (respon) {
      GetDataTable();
      Panel.window("close");
     });
    }
   }

   function PesanKamar() {
    var Panel = $("#PanelPesanKamar");
    var formData = $("#formPesanKamar");
    if (!formData.form("validate")) {
     swal.fire('Peringatan!', 'Isi Form Dengan Benar!', 'warning');
     formData.form("resetValidation");
    } else {
     SimpanData(formData, "PesanKamar", function (respon) {
      GetDataTable();
      Panel.find('.easyui-textbox').not('[name=thn]').textbox("setValue", "");
      Panel.window("close");
     })
    }
   }

   function printSticker() {
    var striker = $("[name=stiker]:checked").val();
    if (striker == "form") {
     window.open("<?= site_url() ?>tpp/laporan/mrs_aktif/print_sticker_form?id_mr=" + data_pasien.id_mr, "", "width=1050,height=580");
    } else if (striker == "gelang") {
     window.open("<?= site_url() ?>tpp/laporan/mrs_aktif/print_sticker_gelang?id_mr=" + data_pasien.id_mr, "", "width=1050,height=580");
    } else {
     window.open("<?= site_url() ?>tpp/laporan/mrs_aktif/print_sticker_cover?id_mr=" + data_pasien.id_mr, "", "width=1050,height=580");
    }
   }

//Default Function
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
     url: '<?= $urlData ?>listmrsaktif',
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