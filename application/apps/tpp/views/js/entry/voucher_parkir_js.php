<script type="text/javascript">
  $(document).ready(function() {
    console.log("ready!");
    GetDataTable();
  });


  function OpenAdd() {
    $("#AddVoucher").find("input,textarea").not('[datax]').val("");
    $("#AddVoucher").window("open");
  }

  function OpenReset() {
    $("#ResetVoucher").find("input,textarea").not('[datax]').val("");
    $("#ResetVoucher").find(".keterangan").html("");
    $("#ResetVoucher").window("open");
  }

  function CariVoucher(no_voucher, heading) {
    // if (empty(no_voucher)) return false;
    $.ajax({
      url: '<?= $urlData ?>CekNoVoucher',
      type: 'POST',
      dataType: 'JSON',
      data: {
        no_voucher: no_voucher,
      },
      success: function(resp) {
        if (!empty(resp.rows)) {
          $(heading).find(".keterangan").html(resp.rows[0].nama_voucher);
        } else {
          $(heading).find(".keterangan").html("");
        }
      },
      error: function(xml, textStatus) {
        alert("Terjadi Kesalahan Ketika Mencari Data");
      }
    })
  };

  function CariNomrs(no_mrs, heading) {
    if (empty(no_mrs)) return false;
    $.ajax({
      url: '<?= $urlData ?>CekNoMrs',
      type: 'POST',
      dataType: 'JSON',
      data: {
        id_mrs: no_mrs,
      },
      success: function(resp) {
        if (!empty(resp.rows)) {
          $(heading).find(".identitas").val(resp.rows[0].keterangan);
        } else {
          if (!empty(rows.metadata)) {
            $(heading).find(".identitas").val("");
          } else {
            $(heading).find(".identitas").val("");
          }
        }
      },
      error: function(xml, textStatus) {
        alert("Terjadi Kesalahan Ketika Mencari Data");
      }
    })
  };

  function GetDataTable() {
    $('#dg').datagrid({
      url: '<?= $urlData ?>ListVoucher',
      method: 'post',
      queryParams: {},
      onSelect: function(index, row) {
        if (index != '-1') {
          data_pasien = row;
          GetDataListVoucher()
        }
      }
    });
  }

  function GetDataListVoucher() {
    if (!empty(data_pasien)) {
      $('#ListVoucherData').datagrid({
        url: '<?= $urlData ?>LIstVoucherIsi',
        method: 'post',
        queryParams: {
          "no_voucher": data_pasien.no_voucher
        },
      });
    }
  }

  function empty(string) {
    return (string == undefined || string == "" || string == null);
  }


  function setArray(DataArray) {
    var data_x = [];
    $.each(DataArray, function(index, item) {
      data_x[item.name] = item.value;
    });
    return data_x;
  }

  $("#InsertData").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#InsertData", "SimpanInsert", function(respon) {
        GetDataTable();
        OpenAdd();
        $.messager.confirm('Confirm', respon.metadata.message + ' \n Aktifasi Voucher Lagi?', function(r) {
          if (!r) {
            $("#AddVoucher").window("close")
          }
        });
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

  $("#ResetData").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#ResetData", "SimpanReset", function(respon) {
        GetDataTable();
        OpenReset();
        $.messager.confirm('Confirm', respon.metadata.message + ' \n Reset Voucher Lagi?', function(r) {
          if (!r) {
            $("#ResetVoucher").window("close")
          }
        });
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

  function SimpanInsert() {
    $("#InsertData").submit()
  }

  function SimpanReset() {
    $("#ResetData").submit()
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
        if (response.metadata.error) {
          $.messager.alert("Peringatan!", response.metadata.message, "danger");
          $.messager.progress("close");
        } else {
          $.messager.progress("close");
          //Jika Suskses maka menjalankan fungsi berikut
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

  $(".no_voucher").on("change keyup", function() {
    $(".no_voucher-p").val("P" + $(this).val())
  })

  $(".no_voucher").change(function() {
    CariVoucher($(".no_voucher-p").val(), '#AddVoucher')
  })

  $(".no_mrs").change(function() {
    CariNomrs($(this).val(), '#AddVoucher')
  })
</script>