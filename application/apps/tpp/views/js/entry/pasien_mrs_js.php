<script type="text/javascript">
  var detail_perujuk = [];
  var data_pasien = [];
  var data_pasienx = [];
  var totalBayar = 0;
  var NomorMRS = "";
  $(document).ready(function() {
    moment.locale("id");
    SetDefault()
  });

  const SetDefault = () => {
    $("#formInputMrs").find("select, input , textarea").val("").trigger("change")
    GetNoMrs()
    GetUnit(function() {
      GetJnsPerujuk(function() {
        $(".dropdown-perujuk").attr("readonly", true)
        $(".perujuk").select2({
          dropdownParent: $("#PanelPerujuk")
        })
      })
    })
    GetTarif()
    GetPaket()
    GetInstansi()
    GetAsuransi()
    GetAdmission()
    GetKelas()
    GetKecPerujuk(function() {
      $('.kec_perujuk').select2({
        dropdownParent: $("#PanelPerujuk")
      })
    })

    GetDokterTindakan(function() {
      $('.dropdown-dokter-tindakan').select2({
        dropdownParent: $("#PanelBiaya")
      })
    })

    GetDokterPetugas(function() {
      $('.dropdown-oleh').select2({
        dropdownParent: $("#editTindakan")
      })
    })

    $("[type=time-formatted]").datetimepicker("setDate", new Date())
    $("[type=date-only-formatted]").datetimepicker("setDate", new Date())
    var tgl_sekarang = moment().format("dddd , DD MMMM YYYY hh:mm:ss");
    $(".tanggal_sekarang").html(tgl_sekarang);

    $(".no_sjp ,.no_peserta").attr({
      "readonly": true,
    }).removeAttr("required")
    $(".asuransi , .admission , .instansi").val("").trigger("change").attr({
      "readonly": true,
    })

    $(".id_perujuk ,.alamat_perujuk ,.nama_perujuk").val("")

    $(".easyui-window").each(function() {
      let id = $(this).attr('id');
      $(this).find("select").select2({
        dropdownParent: $("#" + id)
      })
    })
  }

  const GetUnit = (AfterFunc) => {
    getDropDown($(".dropdown-jns-kunjungan"), '<?= base_url("tpp/ajax_tpp/ComboUnit") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  $(".dropdown-jns-kunjungan").change(function() {
    GetRuang($(this).val())
  })

  const GetRuang = (id_unit, AfterFunc) => {
    let filter = {
      id_unit: id_unit
    }
    if (empty(id_unit)) {
      $(".dropdown-ruang").select2({
        disabled: true,
        placeholder: "Pilih Unit dahulu"
      })
    } else {
      getDropdownStatis($(".dropdown-ruang"), '<?= base_url("tpp/ajax_tpp/ComboRuang") ?>', filter, function() {
        $(".dropdown-ruang").select2({
          disabled: false,
        })
        if (!empty(AfterFunc)) {
          AfterFunc()
        }
      })
    }
  }

  $(".dropdown-ruang").change(function() {
    GetDokter($(this).val())
  })

  const GetDokter = (id_kamar, AfterFunc) => {
    let filter = {
      id_kamar: id_kamar
    }
    if (empty(id_kamar)) {
      $(".dropdown-dokter").select2({
        disabled: true,
        placeholder: "Pilih Kamar dahulu"
      })
    } else {
      getDropdownStatis($(".dropdown-dokter"), '<?= base_url("tpp/ajax_tpp/ComboDokter") ?>', filter, function() {
        $(".dropdown-dokter").select2({
          disabled: false,
        })
        if (!empty(AfterFunc)) {
          AfterFunc()
        }
      })
    }
  }

  $(".dropdown-dokter").change(function() {
    GetNoAntri($(this).val())
  })

  const GetJnsPerujuk = (AfterFunc) => {
    getDropDown($(".dropdown-perujuk"), '<?= base_url("tpp/ajax_tpp/ComboPerujuk") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  $(".cara-masuk").change(function() {
    if ($(this).val() == "Sendiri" || $(this).val() == "") {
      $(".cari-perujuk").attr("disabled", true);
      $(".id_perujuk ,.alamat_perujuk ,.nama_perujuk").val("").trigger("change")
      $(".perujuk-f,.perujuk").val("").trigger("change").attr("readonly", true).removeAttr("required")
    } else {
      $(".cari-perujuk").removeAttr("disabled");
      $(".id_perujuk ,.alamat_perujuk ,.nama_perujuk").val("").trigger("change")
      $(".perujuk-f,.perujuk").val("").removeAttr("readonly").attr("required", true)
    }
  })

  $(".perujuk-f").on("select2:select", function() {
    $('.perujuk').val($(this).val()).trigger("change");
    return;
  })

  $(".perujuk").on("select2:select", function() {
    $('.perujuk-f').val($(this).val()).trigger("change");
    return;
  })

  $(".dropdown-paket").on("select2:select", function() {
    $('.paket-biaya').val($(this).val()).trigger("change");
    return;
  })

  const GetTarif = (AfterFunc) => {
    getDropDown($(".dropdown-tarif"), '<?= base_url("tpp/ajax_tpp/ComboTarif") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetPaket = (AfterFunc) => {
    getDropDown($(".dropdown-paket"), '<?= base_url("tpp/ajax_tpp/ComboPaket") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetKelas = (AfterFunc) => {
    getDropDown($(".dropdown-kelas"), '<?= base_url("tpp/ajax_tpp/ComboKelasMrs") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetInstansi = (AfterFunc) => {
    getDropDown($(".dropdown-instansi"), '<?= base_url("tpp/ajax_tpp/ComboInstansi") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetAsuransi = (AfterFunc) => {
    getDropDown($(".dropdown-asuransi"), '<?= base_url("tpp/ajax_tpp/ComboAsuransi") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetAdmission = (AfterFunc) => {
    getDropDown($(".dropdown-admission"), '<?= base_url("tpp/ajax_tpp/ComboAdmission") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetKab = (AfterFunc) => {
    getDropDown($(".dropdown-kab"), '<?= base_url("tpp/ajax_tpp/getSelectKotaKab") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetKecPerujuk = (AfterFunc) => {
    getDropDown($(".kec_perujuk"), '<?= base_url("tpp/ajax_tpp/getSelectKecPerujuk") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetDokterTindakan = (AfterFunc) => {
    getDropDown($(".dropdown-dokter-tindakan"), '<?= base_url("tpp/ajax_tpp/ComboDokterTindakan") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  const GetDokterPetugas = (AfterFunc) => {
    getDropDown($(".dropdown-oleh"), '<?= base_url("tpp/ajax_tpp/ComboPetugas") ?>', "", function() {
      if (!empty(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  $(".window-pasien").click(function(event) {
    $("#PanelPasien").window("open");
    $('#tblPasien').datagrid('loadData', {
      "total": 0,
      "rows": []
    });
    GetDataPasien();
  });

  $(".cari-perujuk").click(function(event) {
    $('#PanelPerujuk').window('open')
    GetDataPerujuk();
  });

  $(".dropdown-paket , .dropdown-kunjungan").change(function() {
    SetTarif()
  })

  const SetTarif = () => {
    let id_paket = $(".dropdown-paket").val()
    let kunjungan = $(".dropdown-kunjungan").val()

    if (kunjungan == 'Baru' && empty(id_paket)) { // jika paket kosong maka tarif dapat dapat dipilih
      $(".dropdown-tarif").removeAttr('readonly').val("817").trigger("change")
    } else if (kunjungan == 'Baru' && !empty(id_paket)) { // jika id_paket tersisi maka tarif jadi readonly
      $(".dropdown-tarif").attr('readonly', true).val("").trigger("change")
    } else if (kunjungan == 'Lama' && empty(id_paket)) {
      $(".dropdown-tarif").removeAttr('readonly').val("818").trigger("change")
    } else if (kunjungan == 'Lama' && !empty(id_paket)) {
      $(".dropdown-tarif").attr('readonly', true).val("").trigger("change")
    } else {
      $(".dropdown-tarif").removeAttr('readonly').val("").trigger("change")
    }

  }

  function GetDataPasien() {
    filter = $("#FilterPasien");

    $('#tblPasien').datagrid({
      url: '<?= base_url() . "/tpp/entry/pasien_mrs/ListPasien" ?>',
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

      },
      onDblClickRow: function(index, row) {
        if (index != '-1') {
          $('#tblPasien').datagrid('selectRow', index);
          data_pasien = row;
          console.log(data_pasien);
          $(".id_mr").val(data_pasien.id_mr)
          GetDetailPasien(data_pasien.no_mr);
          $("#PanelPasien").window("close");

        }
      }
    });
  }

  function GetDataPerujuk() {
    filter = $("#FilterPerujuk");

    $('#TablePerujuk').datagrid({
      url: '<?= $urlData . "/ListPerujuk" ?>',
      method: 'post',
      queryParams: {
        "nama_perujuk": filter.find(".nama_perujuk").val(),
        "jenis": filter.find(".perujuk").val(),
        "kecamatan": filter.find(".kec_perujuk").val(),
      },
      onDblClickRow: function(index, row) {
        if (index != '-1') {
          $('#dgx').datagrid('selectRow', index);
          data_perujuk = row;
          console.log(data_perujuk);
          GetDetailPerujuk(data_perujuk.id_perujuk);
          $(".perujuk-f").val(data_perujuk.jenis).trigger("change")
          $("#PanelPerujuk").window("close");

        }
      }
    });
  }

  $("#btnCari").click(function() {
    GetDataPasien();
  })

  $(".no_rm-pasien").change(function() {
    let value = $(this).val();
    if (!empty(value)) {
      GetDetailPasien(value);
    } else {
      $(".after-loading-pasien").find(".nama-pasien , .alamat-pasien ,.ket").html("");
    }
  })

  $(".pembayaran").change(function() {
    let value = $(this).val()
    if (value != "Kerja Sama") {
      $(".no_sjp ,.no_peserta").val("").trigger("change");
      $(".no_sjp ,.no_peserta").attr({
        "readonly": true,
      }).removeAttr("required")
      $(".asuransi , .admission , .instansi").val("").trigger("change").attr("readonly", true)
      $(".pj_biaya").val("").trigger("change");
    } else {
      $(".no_sjp ,.no_peserta").val("").trigger("change")
      $(".no_sjp ,.no_peserta").removeAttr("readonly").attr({
        "required": true
      })
      $(".asuransi , .admission , .instansi").val("").trigger("change").removeAttr("readonly")

      $('.ks_instansi,.ks_asuransi').val("").trigger("change");
      $('.nama_instansi,.nama_asuransi').val("").trigger("change");
    }
  })

  $(".get_pembayar").linkbutton({
    onClick: function() {
      GetPembayar();
    }
  })

  function GetPembayar() {
    var dataPembayar = {
      alamat: "",
      nama: ""
    };
    if (!empty(data_pasienx)) {
      dataPembayar = {
        alamat: data_pasienx.txtalamat,
        nama: data_pasienx.txtnama
      };
    }
    instansi = $(".instansi").val();
    asuransi = $(".asuransi").val();
    admission = $(".admission").val();
    if (!empty(instansi) || !empty(asuransi) || !empty(admission)) {
      var dataPembayar = {
        alamat: "",
        nama: ""
      };
      if (!empty(instansi)) {
        dataPembayar.nama += instansi;
      }
      if (!empty(asuransi)) {
        if (!empty(dataPembayar.nama)) dataPembayar.nama += " , ";
        dataPembayar.nama += asuransi;
      }
      if (!empty(admission)) {
        if (!empty(dataPembayar.nama)) dataPembayar.nama += " , ";
        dataPembayar.nama += admission;
      }

    }

    $(".pj_biaya").val(dataPembayar.nama);
    $(".alamat_pjbiaya").val(dataPembayar.alamat);

  }

  function GetDetailPasien(no_mr) {
    $.ajax({
      url: '<?= site_url() . 'tpp/entry/pasien_mrs/PasienNomr' ?>',
      type: 'POST',
      dataType: 'JSON',
      beforeSend: function() {
        $(".before-loading-pasien").removeClass('d-none');
        $(".after-loading-pasien").addClass('d-none');
      },
      data: {
        "no_mr": no_mr
      },
      success: function(resp) {
        $(".after-loading-pasien").removeClass('d-none');
        $(".before-loading-pasien").addClass('d-none');
        detail_pasien = $(".after-loading-pasien");
        if (resp == "null" || empty(resp) || resp.metadata.err_code != "0") {
          $.messager.alert("Peringatan!", resp.metadata.message, "danger");
          detail_pasien.find(".nama-pasien").html("")
          detail_pasien.find(".alamat-pasien").html("")
          detail_pasien.find(".ket").html("")
          $(".statpenyakit").val("")
          $(".catatan").val("")
          $(".id_mrs").html("")
          $("#PanelBiaya").find('.detail_pasien').html("")
        } else {
          detail = resp.list[0];
          data_pasienx = detail;
          $(".id_mrs").html(data_pasienx.id_mrs)
          detail_pasien.find(".nama-pasien").html(detail.txtnama)
          detail_pasien.find(".alamat-pasien").html(detail.txtalamat)
          detail_pasien.find(".ket").html(detail.txtumur)

          let tgl_lahir = moment(detail.tgl_lahir, "YYYY-MM-DD hh:mm:ss").format("DD-MM-YYYY");
          $("#PanelBiaya").find('.detail_pasien').html(no_mr + " - " + detail.txtnama + "(" + tgl_lahir + ")")

          if (!empty(resp.kamar.list)) {
            $(".txtkamar").val(resp.kamar.list[0].nama_kamar)
          } else {
            $(".txtkamar").val("")
          }

          if (!empty(resp.ketbayar.list)) {
            $(".ket-bayar-akhir").val(resp.ketbayar.list[0].pembayaran)
          } else {
            $(".ket-bayar-akhir").val("")
          }

          if (!empty(resp.statuspasien.list)) {
            $(".status_pasien").val(resp.statuspasien.list[0].status)
          } else {
            $(".status_pasien").val("Tidak Aktif")
          }

          $(".statpenyakit").val(resp.statuspenyakit.list[0].penyakit)
          $(".catatan").val(resp.catatanpenting.list[0].catatan)

          $(".no_rm-pasien").val(no_mr)
        }
      },
      error: function(xhl, textStatus) {
        $(".after-loading-pasien").removeClass('d-none');
        $(".before-loading-pasien").addClass('d-none');
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
      }
    })
  }

  function GetDetailPerujuk(id_perujuk) {
    $.ajax({
      url: '<?= $urlData . "/DetailPerujuk" ?>',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "id_perujuk": id_perujuk
      },
      success: function(resp) {
        detail_perujuk = resp.list[0];
        $.each(detail_perujuk, function(index, val) {
          if (index == "alamat") index = "alamat_perujuk";
          console.log(index + " : " + val)
          $("." + index).val(val).trigger("change");
        });
      },
      error: function(xhl, textStatus) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
      }
    })
  }

  function SimpanForm() {
    $("#formInputMrs").submit()
  }

  $("#formInputMrs").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#formInputMrs", "InsertMrs", function(respon) {
        $.messager.alert("Suksess!", "Data Berhasil Disimpan ", "info");
        // cetak ijo ijo
        $(".btn-refresh-pembayaran").attr({
          "onclick": "GetTindakan(" + $(".id_mrs").val() + "," + $(".id_jnsbiaya").val() + ")"
        })
        GetTindakan($(".id_mrs").val(), $(".id_jnsbiaya").val());
        $("#formInputMrs").form("reset");
        $(".after-loading-pasien").find("h3,h4,h5").html("");
        GetNoMrs();
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


  function SimpanData(form, act, sukses = "") {
    $.ajax({
      type: "POST",
      url: "<?= base_url("tpp/entry/pasien_mrs/") ?>" + act,
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

  $(".btn-reset-mrs").click(function(event) {
    $("#insert-mrs").form("reset");
    $(".mrs").val(NomorMRS);
  });

  function GetNoMrs() {
    $.ajax({
      type: "POST",
      url: "<?= base_url("tpp/entry/pasien_mrs/GetNoMrs") ?>",
      data: {},
      dataType: "JSON",
      beforeSend: function() {
        $.messager.progress({
          text: 'Loading..'
        });
      },
      success: function(response) {
        $.messager.progress("close");
        if (response.metadata.error || response.metadata.err_code) {
          $.messager.alert("Peringatan!", response.metadata.message, "danger");
          $.messager.progress("close");
        } else {
          $.messager.progress("close");
          NomorMRS = response.list[0].concat;
          $(".mrs").val(response.list[0].concat);
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        $.messager.progress("close");
      }
    });
  }

  function GetNoAntri(dokter = "") {
    var tgl_masuk = $(".tgl-mrs").val();
    if (empty(tgl_masuk)) {
      tgl_masuk = "<?= date("Y-m-d") ?>";
    } else {
      tgl_masuk = moment(tgl_masuk, "DD/MM/YYYY").format("YYYY-MM-DD");
    }


    if (!empty(dokter)) {
      $.ajax({
        type: "POST",
        url: "<?= base_url("tpp/entry/pasien_mrs/NomorAntri") ?>",
        data: {
          "dokter": dokter,
          "tanggal": tgl_masuk
        },
        dataType: "JSON",
        success: function(response) {
          $.messager.progress("close");
          if (response.metadata.err_code != 0) {
            $.messager.alert("Peringatan!", response.metadata.message, "danger");
          } else {
            var x_data = response.rows[0];
            $(".antri_poli").val(x_data.no_antri);
          }
        },
        error: function(JqErr, textStatus, Xhrattr) {
          $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
          $.messager.progress("close");
          $(".antri_poli").val("");
        }
      })
    } else {
      $("#PanelPoli").find(".poli-antri").val("");
    }
  }

  function GetTindakan(id_mrs, id_jnsbiaya) {
    $.ajax({
      type: "POST",
      url: "<?= base_url("tpp/entry/pasien_mrs/getPembayaran") ?>",
      data: {
        "id_mrs": id_mrs,
        "id_jnsbiaya": id_jnsbiaya
      },
      beforeSend: function() {
        $("#PanelBiaya").window('open');
        $.messager.progress({
          text: 'Loading..'
        });
      },
      dataType: "JSON",
      success: function(response) {
        $.messager.progress("close");
        $('#PanelBiaya').window('open')
        $(".before-loading-tindakan").removeClass('d-none');
        $(".after-loading-tindakan").addClass('d-none');
        $("#TabelLab").datagrid('loadData', response.lab.rows);
        $("#TabelRadio").datagrid('loadData', response.radio.rows);
        $("#TabelTindakan").datagrid('loadData', response.tindakan.rows);
        totalBayar = response.total;
        $(".tdetail").html(FormatRp(response.total))
        $(".tjasa").html(FormatRp(0))
        $(".tpaket").html(FormatRp(response.total))
        $(".tdiskon").html(FormatRp(0))
        $(".diskon_total").val("0")
        $(".tbayar").html(FormatRp(response.total))

      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        $.messager.progress("close");
        $(".antri_poli").val("");
      }
    })
  }

  $.extend($.fn.datebox.defaults, {
    formatter: function(date) {
      var y = date.getFullYear();
      var m = date.getMonth() + 1;
      var d = date.getDate();
      return (d < 10 ? ('0' + d) : d) + '/' + (m < 10 ? ('0' + m) : m) + '/' + y;
      //(d<10?('0'+d):d)+'.'+(m<10?('0'+m):m)+'.'+y; this works but would not allow me to choose other dates
    },
    parser: function(s) {
      if (!s) return new Date();
      var ss = s.split('/');
      var d = parseInt(ss[0], 10);
      var m = parseInt(ss[1], 10);
      var y = parseInt(ss[2], 10);
      if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
        return new Date(y, m - 1, d);
      } else {
        return new Date();
      }
    }
  });

  function empty(string) {
    return (string == undefined || string == "" || string == null);
  }


  function Open() {
    $("#PanelBiaya").window('open');
    GetTindakan(200600005, 54);

  }

  function FormatRp(bilangan) {
    var number_string = bilangan.toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah + ',00';
    return rupiah;
  }

  $(".dropdown-asuransi , .dropdown-instansi , .dropdown-admission").change(function() {
    let head = $(this).parent().parent().parent().parent()
    let nama_instansi = $('option:selected', this).data('nama');
    head.find(".nama_").val(nama_instansi).trigger("change");
  })

  $("#FilterPasien").validate({
    submitHandler: function(form) {
      GetDataPasien()
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

  $("#btn-edit-tindakan , #btn-edit-lab , #btn-edit-radio").click(function() {
    // $('#dlg').dialog('open');
    let data_grid = $(this).attr("table");
    // alert(data_grid)
    let row = $(data_grid).datagrid('getSelected');
    let index_row = $(data_grid).datagrid('getRowIndex', row);
    console.log(row)
    if (row) {
      $("#FormTindakan").attr({
        namaTable: data_grid,
        indexChange: index_row
      })
      $(".id_pakettindakan_tmp").val(row.id_pakettindakan_tmp)
      $(".tindakan").val(row.nama_tindakan)
      $(".dropdown-oleh").val(row.oleh).trigger("change") // change selected berdasarkan value nya 
      $('#editTindakan').dialog('open').dialog('center');
    }
  });

  $('#btn-simpan').click(function() {
    // jika button submit diluar dari form
    $('#FormTindakan').submit();
  })

  $("#FormBiaya").validate({
    submitHandler: function(form) {
      SimpanData("#FormBiaya", "InsertTindakan", function(respon) {
        $.messager.alert("Suksess!", respon.metadata.message, "info");
        let data_grid = $(this).attr("namaTable");
        let index_row = $(this).attr("indexChange");
        $(data_grid).datagrid('updateRow', {
          index: index_row,
          row: {
            dilakukan_oleh: $('option:selected', $("#FormTindakan").find(".dropdown-oleh")).data('nama')
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

  $("#FormTindakan").validate({
    submitHandler: function(form) {
      SimpanData("#FormTindakan", "UpdatePetugas", function(respon) {
        $.messager.alert("Suksess!", respon.metadata.message, "info");
        let data_grid = $("#FormTindakan").attr("namaTable");
        let index_row = $("#FormTindakan").attr("indexChange");
        $('#editTindakan').dialog('close');
        $(data_grid).datagrid('updateRow', {
          index: index_row,
          row: {
            dilakukan_oleh: $('option:selected', $("#FormTindakan").find(".dropdown-oleh")).data('nama'),
            oleh: $("#FormTindakan").find(".dropdown-oleh").val()
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

  $('#btn-batal').click(function() {
    // $('#dlg').dialog('open');
    $('#win-data_dokter').window('close');
  });

  $("#btn-info").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }
    $('#PanelInfo').dialog('open').dialog('center').dialog('setTitle', 'Info Pasien');
    $.ajax({
      url: '<?= base_url("tpp/master/data_pasien/") ?>IndexPasien',
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

  $("#btn-mrs").click(function() {
    let dataPasien = $("#tblPasien").datagrid("getSelected");
    if (empty2(dataPasien)) {
      return;
    }

    $(".id_mr").val(dataPasien.id_mr)
    GetDetailPasien(dataPasien.no_mr);
    $("#PanelPasien").window("close");
  })

  $("#btn-pilih-perujuk").click(function() {
    let data_perujuk = $("#TablePerujuk").datagrid("getSelected");
    if (empty2(data_perujuk)) {
      return;
    }
    console.log(data_perujuk);
    GetDetailPerujuk(data_perujuk.id_perujuk);
    $(".perujuk-f").val(data_perujuk.jenis).trigger("change")
    $("#PanelPerujuk").window("close");
  })

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
</script>