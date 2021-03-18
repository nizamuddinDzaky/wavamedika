<script type="text/javascript">
  var Hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

  $(document).ready(function() {
    console.log("ready!");
    GetJenisKamar()
    GetKlinikPoli()
    GetJnsPasien()
    GetDataPasien()
  });

  $("#btn-filter").click(function() {
    GetDataPasien()
  })

  function GetDataPasien() {
    filter = $("#FilterPasien");
    $('#tblPasien').datagrid('loadData', {
      "total": 0,
      "rows": []
    });
    $('#tblPasien').datagrid({
      url: '<?= base_url() . "/tpp/master/data_pasien/ListPasien" ?>',
      method: 'post',
      queryParams: {
        "no_mr": filter.find("[name=no_rm]").val(),
        "nama": filter.find("[name=nama]").val(),
        "kecamatan": filter.find("[name=kec]").val(),
        "kabupaten": filter.find("[name=kab]").val(),
        "sex": filter.find("[name=sex]").val(),
        "id_jnspasien": filter.find("[name=id_jnspasien]").val(),
        "thn1": filter.find("[name=thn1]").val(),
        "thn2": filter.find("[name=thn2]").val()

      }
    });
  }

  $("#btn-tambah").click(function() {
    window.open('<?= base_url("tpp/entry/pasien_baru") ?>', '_blank');
  })

  $("#btn-ubah").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    } else {
      // window.open("<?= base_url("tpp/master/data_pasien/edit/") ?>" + dataPasien.id_mr, "", "width=1050,height=580");
      window.open("<?= base_url("tpp/master/data_pasien/edit/") ?>" + dataPasien.id_mr, "_self");
    }

  })

  $("#btn-info").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    $('#PanelInfo').dialog('open').dialog('center').dialog('setTitle', 'Info Pasien');
    $.ajax({
      url: '<?= $urlData ?>IndexPasien',
      type: 'POST',
      dataType: 'JSON',
      data: {
        id_mr: dataPasien.id_mr
      },
      beforeSend: function() {
        $("#PanelInfo").find('.before-loading').removeClass('d-none');
        $("#PanelInfo").find('.after-loading').addClass('d-none');
      },
      success: function(resp) {
        var status = resp.metadata;
        if (status.err_code == 0) {
          $.each(resp.rows[0], function(index, val) {
            $("#PanelInfo").find('.' + index).html(val);
          });
          $("#PanelInfo").find('.after-loading').removeClass('d-none');
          $("#PanelInfo").find('.before-loading').addClass('d-none');
        } else {
          $.messager.alert("Peringatan!", status.message, "danger");
          $('#PanelInfo').window('close');
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        $('#PanelInfo').window('close');
      }
    })
  });

  $("#btn-index").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    $('#PanelIndexPasien').window('open');
    $.ajax({
      url: '<?= $urlData ?>IndexPasien',
      type: 'POST',
      dataType: 'JSON',
      data: {
        id_mr: dataPasien.id_mr
      },
      beforeSend: function() {
        $("#PanelIndexPasien").find('.before-loading').removeClass('d-none');
        $("#PanelIndexPasien").find('.after-loading').addClass('d-none');
      },
      success: function(resp) {
        var status = resp.metadata;
        if (status.err_code == 0) {
          $.each(resp.rows[0], function(index, val) {
            $("#PanelIndexPasien").find('.' + index).html(val);
          });
          $("#PanelIndexPasien").find('.after-loading').removeClass('d-none');
          $("#PanelIndexPasien").find('.before-loading').addClass('d-none');
        } else {
          $.messager.alert("Peringatan!", status.message, "danger");
          $('#PanelIndexPasien').window('close');
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        $('#PanelIndexPasien').window('close');
      }
    })
  });

  $("#btn-riwayat").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    $('#PanelRiwayatPasien').window('open');
    RiwayatPasien(dataPasien.id_mr);
    GetDataNotifikasi(dataPasien.id_mr);
    GetDataRekap(dataPasien.id_mr);
    $('#TindakanPasien').datagrid('loadData', {
      "total": 0,
      "rows": []
    });
  });

  function GetDataRekap(id_mr) {
    $('#RekapPasien').datagrid({
      url: '<?= $urlData ?>/RiwayatPasienRekap',
      method: 'post',
      autoRowHeight: true,
      queryParams: {
        "id_mr": id_mr
      },
      onRowContextMenu: function(e, index, row) {

      }
    });
  }

  function GetDataNotifikasi(id_mr) {
    $('#Notifikasi').datagrid({
      url: '<?= $urlData ?>RiwayatPasienNotifikasi',
      method: 'post',
      autoRowHeight: true,
      queryParams: {
        "id_mr": id_mr
      },
      onRowContextMenu: function(e, index, row) {

      }
    });
  }

  function RiwayatPasien(id_mr) {
    $('#RiwayatPassienTb').datagrid({
      url: '<?= $urlData ?>RiwayatPasien',
      method: 'post',
      autoRowHeight: true,
      queryParams: {
        "id_mr": id_mr
      },
      onSelect: function(index, row) {
        if (index != '-1') {
          GetDataTindakan(row.id_mrs)
        }
      }
    });
  }

  function GetDataTindakan(id_mrs) {
    $('#TindakanPasien').datagrid({
      url: '<?= $urlData ?>RiwayatPasienTindakan',
      method: 'post',
      autoRowHeight: true,
      queryParams: {
        "id_mrs": id_mrs
      },
      onRowContextMenu: function(e, index, row) {

      }
    });
  }

  $("#btn-stiker").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    $('#PanelStiker').dialog('open').dialog('center').dialog('setTitle', 'Stiker');
  });

  function PrintStriker() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    var striker = $("[name=stiker]:checked").val();
    if (striker == "form") {
      window.open("<?= site_url() ?>tpp/master/data_pasien/print_striker_form?id_mr=" + dataPasien.id_mr, "", "width=1050,height=580");
    } else if (striker == "gelang") {
      window.open("<?= site_url() ?>tpp/master/data_pasien/print_striker_gelang?id_mr=" + dataPasien.id_mr, "", "width=1050,height=580");
    } else {
      window.open("<?= site_url() ?>tpp/master/data_pasien/print_striker_cover?id_mr=" + dataPasien.id_mr, "", "width=1050,height=580");
    }
  }

  $("#btn-prioritas").click(function(event) {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    window.open("<?= site_url() ?>tpp/master/data_pasien/print_wava_prioritas?id_mr=" + dataPasien.id_mr, "", "width=1050,height=580");
  });

  $("#btn-membercard").click(function(event) {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    window.open("<?= site_url() ?>tpp/master/data_pasien/print_member_card?id_mr=" + dataPasien.id_mr, "", "width=1050,height=580");
  });

  $("#btn-print").click(function(event) {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    window.open("<?= site_url() ?>tpp/master/data_pasien/print_striker_haji?id_mr=" + dataPasien.id_mr, "", "width=1050,height=580");
  });

  $("#btn-pesankamar").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    let panelKamar = $('#PanelPesanKamar');
    panelKamar.dialog('open').dialog('center');
    panelKamar.find("input,select,textarea").val("").trigger("change");
    panelKamar.find(".telepon").val(dataPasien.telepon)
    panelKamar.find(".id_mr").val(dataPasien.id_mr)
  });

  function GetJenisKamar() {
    getDropDown($("#PanelPesanKamar").find(".dropdown-jnsKamar"), '<?= base_url("tpp/master/data_pasien/ComboJnsKamar") ?>', "",
      function(resp) {
        $("#PanelPesanKamar").find(".dropdown-jnsKamar").select2({
          dropdownParent: $("#PanelPesanKamar")
        })
      }
    )
  }

  $("#PanelPesanKamar").find(".dropdown-jnsKamar").change(function() {
    GetKelasKamar($(this).val())
  })

  const GetKelasKamar = (valuejenis, AfterFunc) => {
    let filter = {
      jenis: valuejenis
    }
    if (empty2(valuejenis)) {
      $("#PanelPesanKamar").find(".dropdown-dokter").select2({
        disabled: true,
        placeholder: "Pilih Kelas dahulu"
      })
    } else {
      getDropdownStatis($("#PanelPesanKamar").find(".dropdown-kelas"), '<?= base_url("tpp/master/data_pasien/ComboKelasKamar") ?>', filter, function() {
        $("#PanelPesanKamar").find(".dropdown-kelas").select2({
          disabled: false,
          dropdownParent: $("#PanelPesanKamar")
        })
        if (!empty2(AfterFunc)) {
          AfterFunc()
        }
      })
    }
  }



  $("#FormPesanKamar").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#FormPesanKamar", "PesanKamar", function(respon) {
        GetDataPasien();
        let Panel = $("#PanelPesanKamar")
        Panel.find('input,select,textarea').val("").trigger("change");
        Panel.dialog("close");
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

  function PesanKamar() {
    $("#FormPesanKamar").submit()
  }

  function GetKlinikPoli() {
    getDropDown($("#panelPesanPoli").find(".dropdown-klinik"), '<?= base_url("tpp/master/data_pasien/ComboKlinikPoli") ?>', "",
      function(resp) {
        $("#panelPesanPoli").find(".dropdown-klinik").select2({
          dropdownParent: $("#panelPesanPoli")
        })
      }
    )
  }

  const GetDokterPoli = (valuekamar, AfterFunc) => {
    let filter = {
      id_kamar: valuekamar
    }
    if (empty2(valuekamar)) {
      $("#panelPesanPoli").find(".dropdown-dokter").select2({
        disabled: true,
        placeholder: "Pilih Klinik dahulu"
      })
    } else {
      getDropdownStatis($("#panelPesanPoli").find(".dropdown-dokter"), '<?= base_url("tpp/master/data_pasien/ComboDokterPoli") ?>', filter, function() {
        $("#panelPesanPoli").find(".dropdown-dokter").select2({
          disabled: false,
          dropdownParent: $("#panelPesanPoli")
        })
        if (!empty2(AfterFunc)) {
          AfterFunc()
        }
      })
    }
  }

  $("#panelPesanPoli").find(".dropdown-klinik").change(function() {
    GetDokterPoli($(this).val())
  })

  $("#panelPesanPoli").find(".dropdown-dokter").change(function() {
    GetNoAntri($(this).val())
  })

  function GetNoAntri(dokter = "") {
    if (!empty2(dokter)) {
      $.ajax({
        type: "POST",
        url: "<?= $urlData ?>NomorAntri",
        data: {
          "dokter": dokter,
          "tanggal": $("#panelPesanPoli").find(".calendar-value").val(),
        },
        dataType: "JSON",
        success: function(response) {
          $.messager.progress("close");
          if (response.metadata.err_code != 0) {
            $.messager.alert("Peringatan!", response.metadata.message, "danger");
          } else {
            var x_data = response.rows[0];
            $("#panelPesanPoli").find(".poli-antri").val(x_data.no_antri);
          }
        },
        error: function(JqErr, textStatus, Xhrattr) {
          $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
          $.messager.progress("close");
          $("#panelPesanPoli").find(".poli-antri").val("");
        }
      })
    } else {
      $("#panelPesanPoli").find(".poli-antri").val("");
    }
  }

  $('.easyui-calendar.tanggal').calendar({
    onChange: function(DateNow, DateOld) {
      $('.calendar-value').val(DateNow.getFullYear() + "-" + ((DateNow.getMonth() + 1 < 10 ? "0" + (DateNow.getMonth() + 1) : (DateNow.getMonth() + 1))) + "-" + DateNow.getDate());
      $("#panelPesanPoli").find('.hari').val(Hari[DateNow.getDay()]);
      GetNoAntri($('.dokter-poli').val());
    }
  });

  $("#btn-pesanpoli").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    let panelPoli = $('#panelPesanPoli');
    panelPoli.dialog('open');
    panelPoli.find("input,select,textarea").val("").trigger("change");
    $('.easyui-calendar.tanggal').calendar({
      current: new Date()
    })
    GetRencanaKontrol(dataPasien.id_mr)
    $('.calendar-value').val("<?= date("Y-m-d") ?>");
    var Keterangan_poli = dataPasien.sex + " | " + dataPasien.umur;
    Keterangan_poli += (dataPasien.kecamatan != "" ? " | " + dataPasien.kecamatan : "");
    panelPoli.find('.hari').val(Hari[<?= date("N") ?>]);
    panelPoli.find('h5.keterangan').html(Keterangan_poli);
    panelPoli.find('.nama_lengkap').html(dataPasien.nama_lengkappx);
    panelPoli.find('.id_mr').val(dataPasien.id_mr);
    panelPoli.find('.id_mrs').val(dataPasien.id_mrs);
    panelPoli.find(".jam").datetimepicker({
      format: "hh:ii",
      showMeridian: true,
      todayHighlight: true,
      autoclose: true,
      startView: 1,
      minView: 0,
      maxView: 1,
      forceParse: 0,
      pickerPosition: 'bottom-right',
      container: $("#panelPesanPoli")
    })
    panelPoli.find(".jam").datetimepicker('setDate', new Date())
  });

  $("#PesanPoli").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      let dataPasien = $("#tblPasien").datagrid("getSelected");
      SimpanData("#PesanPoli", "PesanPoli", function(respon) {
        $("#btn-pesanpoli").click();
        GetRencanaKontrol(dataPasien.id_mr)
        $("#PanelPoli").find('.hari').val(Hari[<?= date("N") ?>]);
        $('.easyui-calendar.tanggal').calendar({
          current: new Date()
        })
        $('.calendar-value').val("<?= date("Y-m-d") ?>");
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

  function GetRencanaKontrol(id_mr) {
    $('#RencanaKontrol').datagrid({
      url: '<?= $urlData ?>RencanaKontrol',
      method: 'post',
      autoRowHeight: true,
      queryParams: {
        "id_mr": id_mr // +" or id_mr !=1 "
      },
      onRowContextMenu: function(e, index, row) {

      }
    });
  }

  function PesanPoli() {
    $("#PesanPoli").submit()
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

  const GetJnsPasien = () => {
    getDropDown($(".dropdown-id_jnspasien"), '<?= base_url("tpp/ajax_tpp/JnsPasien") ?>', "",
      function(resp) {
        $("#GantiRm").find(".select2").select2({
          dropdownParent: $("#GantiRm")
        })
      }
    )
  }

  $("#btn-gantirm").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    $('#GantiRm').dialog('open').dialog("center");
    $('#GantiRm').find(".select2").select2({
      dropdownParent: $("#GantiRm")
    })
    var Panel = $("#GantiRm");
    Panel.find('input,textarea,select').val("").trigger("change");
    Panel.find(".tahun").val("<?= date("Y") ?>");
    var Keterangan_x = dataPasien.sex + " | " + dataPasien.umur;
    Keterangan_x += (dataPasien.kecamatan != "" ? " | " + dataPasien.kecamatan : "");
    Panel.find('h5.keterangan').html(Keterangan_x);
    Panel.find('.nama_lengkap').html(dataPasien.nama_lengkappx);
    Panel.find(".tgl_ganti").datetimepicker('setDate', new Date())
    $.ajax({
      url: '<?= $urlData ?>DataGantiRm',
      type: 'POST',
      dataType: 'JSON',
      data: {
        id_mr: dataPasien.id_mr
      },
      beforeSend: function() {
        Panel.find('.before-loading').removeClass('d-none');
        Panel.find('.after-loading').addClass('d-none');
      },
      success: function(resp) {
        var status = resp.metadata;
        Panel.find('.id_mr').val(dataPasien.id_mr);
        if (status.err_code == 0) {
          $.each(resp.rows[0], function(index, val) {
            Panel.find('.' + index).val(val);
          });

          Panel.find('.after-loading').removeClass('d-none');
          Panel.find('.before-loading').addClass('d-none');
        } else {
          $.messager.alert("Peringatan!", status.message, "danger");
          Panel.window('close');
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        Panel.window('close');
      }
    })
  });


  function GetNoBaru() {
    var Panel = $("#GantiRm");
    if (Panel.find("[name=id_jnspasien]").val() == "") {
      $.messager.alert("Peringatan!", "Jenis Pasien Harus Diisi ", "danger");
    } else {
      $.ajax({
        type: "POST",
        url: "<?= $urlData ?>NoRmBaru",
        data: {
          "id_jnspasien": Panel.find("[name=id_jnspasien]").val(),
          "thn": Panel.find("[name=tahun]").val(),
        },
        dataType: "JSON",
        beforeSend: function() {
          $.messager.progress({
            text: 'Loading..'
          });
        },
        success: function(response) {
          $.messager.progress("close");
          if (response.metadata.err_code != 0) {
            $.messager.alert("Peringatan!", response.metadata.message, "danger");
            $.messager.progress("close");
          } else {
            $.messager.progress("close");
            //Jika Suskses maka menjalankan fungsi berikut
            Panel.find('.no_mr_baru').val(response.rows[0].concat);
          }
        },
        error: function(JqErr, textStatus, Xhrattr) {
          $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
          $.messager.progress("close");
        }
      });
    }
  }

  function GantiRm() {
    $("#GantiNoRm").submit()
  }

  $("#GantiNoRm").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      let dataPasien = $("#tblPasien").datagrid("getSelected");
      SimpanData("#GantiNoRm", "UpdateNoRm", function(respon) {
        GetDataPasien();
        let Panel = $("#GantiRm");
        Panel.find('input,textarea,select').not('[name=thn]').val("");
        Panel.window("close");
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


  $(window).scroll(function() {
    var height = $(window).scrollTop();
    $('.easyui-window').window('center');
  });

  $(window).resize(function() {
    var windowWidth = $(window).width();
    var windowHeight = $(window).height();

    if (windowWidth > 600) {
      $('.easyui-window').window({
        width: windowWidth * 90 / 100,
        height: windowHeight * 90 / 100
      });
    } else {
      $('.easyui-window').window({
        width: windowWidth * 98 / 100,
        height: windowHeight * 98 / 100
      });
    }

    $('.easyui-window').window('center');
  }).resize();

  if ($.fn.calendar) {
    $.fn.calendar.defaults.firstDay = 1;
    $.fn.calendar.defaults.weeks = ['M', 'S', 'S', 'R', 'K', 'J', 'S'];
    $.fn.calendar.defaults.months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
  }
</script>