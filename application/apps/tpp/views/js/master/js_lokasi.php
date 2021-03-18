<script type="text/javascript">
  $(document).ready(function() {});

  $('#sel_propinsi').select2({
    //      placeholder: '-- Propinsi',
    //      required: true,
  });
  $('#sel_kabupaten').select2({
    placeholder: '-- Kabupaten',
    //      required: true,
  });
  $('#sel_kecamatan').select2({
    placeholder: '-- Kecamatan',
    //      required: true,
  });

  $('#btn-tambah').click(function(event) {
    $('#tambahData').window('open');
  });

  $('#btn-ubah').click(function(event) {
    let DataGrid = $("#dg").datagrid("getSelected");
    if (empty2(DataGrid)) {
      return;
    }
    $('#editData').find("input").val("").trigger("change")
    $('#editData').window('open').dialog('center');
    // console.log(DataGrid)
    $.each(DataGrid, function(index, val) {
      $("#editData").find("[name=" + index + "]").val(val);
    })

  });

  function Hapus() {
    var row = $('#dg').datagrid('getSelected');
    if (empty(row)) {
      return
    }
    $.messager.confirm('Hapus', 'Anda Yakin akan menghapus data "' + row.kelurahan + '" ?', function(r) {
      if (r) {
        $.messager.progress();
        $.ajax({
          type: "post",
          url: "<?= $urlData ?>DeleteLokasi",
          data: {
            "id_lokasi": row.id_lokasi
          },
          dataType: "JSON",
          success: function(resp) {
            $.messager.progress("close");
            if (!resp.metadata.error) {
              GetDataTable();
            } else {
              $.messager.alert("Peringatan!", resp.metadata.message, "danger");
            }
          },
          error: function() {
            $.messager.progress("close");
            $.messager.alert("Peringatan!", "Periksa Koneksi Anda Kembali", "danger");
          }
        });
      }
    });
  }


  $(".dropdown-propinsi").change(function() {
    let propinsi = $(this).val()
    if (empty(propinsi)) {
      $(".dropdown-kabupaten").select2({
        disabled: true,
        placeholder: "Pilih Kabupaten"
      });
      $(".dropdown-kabupaten").val("").trigger("change");
      // GetKelurahan("", "", "", "<?= base_url("tpp/ajax_tpp") ?>", "")
    } else {
      GetKabupaten(propinsi, "<?= base_url("tpp/ajax_tpp/GetKabupaten") ?>", "")
    }
  })

  $(".dropdown-kabupaten").change(function() {
    let propinsi = $(this).parent().parent().parent().find(".dropdown-propinsi").val()
    let kabupaten = $(this).val()
    if (empty(kabupaten)) {
      $(".dropdown-kecamatan").select2({
        disabled: true,
        placeholder: "Pilih Kecamatan"
      });
      $(".dropdown-kecamatan").val("").trigger("change");
    } else {
      GetKecamatan(propinsi, kabupaten, "<?= base_url("tpp/ajax_tpp/GetKecamatan") ?>", "", function() {
        $(".dropdown-kelurahan").select2({
          disabled: true,
          placeholder: "Pilih Kelurahan"
        });
        $(".dropdown-kelurahan").val("").trigger("change");
      })
    }
  })

  $(".easyui-dialog").each(function(index, val) {
    let id = $(this).attr("id");
    $(this).find('select').select2({
      dropdownParent: $("#" + id)
    })
  })

  $(".dropdown-kecamatan").change(function() {
    let propinsi = $(this).parent().parent().parent().find(".dropdown-propinsi").val()
    let kabupaten = $(this).parent().parent().parent().find(".dropdown-kabupaten").val()
    let kelurahan = $(this).parent().parent().parent().find(".dropdown-kelurahan").val()
    let kecamatan = $(this).val()
    if (empty(kecamatan)) {
      $(".dropdown-kelurahan").select2({
        disabled: true,
        placeholder: "Pilih Kelurahan"
      });
      $(".dropdown-kelurahan").val("").trigger("change");
    } else {
      // GetKelurahan(propinsi, kabupaten, kecamatan, "<?= base_url("tpp/ajax_tpp/GetKelurahan") ?>", "")
    }
  })

  function setArray(DataArray) {
    var data_x = [];
    $.each(DataArray, function(index, item) {
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

  $("#form-header").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      GetDataTable()
    },
    errorPlacement: function(error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent()); // radio/checkbox?
      } else if (element.hasClass("select2") || element.hasClass("select")) {
        error.insertAfter(element.next("span")); // select2
      } else {
        error.insertAfter(element); // default
      }
    }
  });

  $("#formTambah").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#formTambah", "AddLokasi", function(respon) {
        let Panel = $("#tambahData")
        Panel.find('input,textarea,select').not('[name=thn]').val("");
        Panel.dialog("close");
        GetDataTable();
      })
    },
    errorPlacement: function(error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent()); // radio/checkbox?
      } else if (element.hasClass("select2") || element.hasClass("select")) {
        error.insertAfter(element.next("span")); // select2
      } else {
        error.insertAfter(element); // default
      }
    }
  });

  $("#formEdit").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#formEdit", "UpdateLokasi", function(respon) {
        let Panel = $("#editData")
        Panel.find('input,textarea,select').not('[name=thn]').val("");
        Panel.dialog("close");
        GetDataTable();
      })
    },
    errorPlacement: function(error, element) {
      if (element.parent(".input-group").length) {
        error.insertAfter(element.parent()); // radio/checkbox?
      } else if (element.hasClass("select2") || element.hasClass("select")) {
        error.insertAfter(element.next("span")); // select2
      } else {
        error.insertAfter(element); // default
      }
    }
  });

  function GetDataTable() {
    $('#dg').datagrid({
      url: '<?= $urlData ?>ListLokasi',
      method: 'post',
      title: '<?= $title ?>',
      pagination: true,
      rownumbers: true,
      pageSize: "10",
      singleSelect: true,
      queryParams: {
        "act": "ListLokasi",
        "propinsi": $(".dropdown-propinsi").val(),
        "kabupaten": $(".dropdown-kabupaten").val(),
        "kecamatan": $(".dropdown-kecamatan").val()
        // "kelurahan": "Sisir"

      },
    });
  }

  function SimpanData(form, act, sukses = "") {
    $.ajax({
      type: "POST",
      url: "<?= $urlData ?>" + act,
      data: $(form).serialize(),
      dataType: "JSON",
      beforeSend: function() {
        $.messager.progress({
          text: 'Loading..'
        });
      },
      success: function(response) {
        $.messager.progress("close");
        if (response.metadata.error || response.metadata.err_code) {
          $.messager.progress("close");
          $.messager.alert("Peringatan!", response.metadata.message, "danger");

        } else {
          $.messager.progress("close");
          //Jika Suskses maka menjalankan fungsi berikut
          $.messager.alert("Suksess!", response.metadata.message, "info");
          if (sukses != "") {
            sukses(response);
          }
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        $.messager.progress("close");
      }
    });
  }
</script>