<script type="text/javascript">
  var detail_perujuk = [],
    data_pasien = [],
    data_pasienx = [],
    kelurahan = "",
    kecamatan = "",
    provinsi = "",
    kabupaten = "";
  $(".datepicker-tgl").datetimepicker({
    format: "dd/mm/yyyy",
    todayHighlight: true,
    autoclose: true,
    startView: 2,
    minView: 2,
    pickerPosition: 'bottom-left'
  })
  var changeDate = '';
  var TypeChange = '';


  $(document).ready(function() {
    moment.locale("id");
    SetDefault();
  });

  const ResetForm = () => {
    SetDefault(1)
  }

  const SimpanEditPasien = () => {
    $("#edit-pasien").submit()
  }

  $("#edit-pasien").validate({
    rules: {
      nama_lengkap: {
        // lettersonly: true,
        required: true
      },
      tmp_lahir: {
        // lettersonly: true,
        required: false
      },
      nama_pj: {
        // lettersonly: true,
        required: false
      },
      email: {
        required: false,
        email: false
      }
    },
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#edit-pasien", "EditPasien", "<?= base_url("tpp/entry/pasien_baru/ajax") ?>", function(respon) {
        $.messager.alert("Suksess!", respon.metadata.message, "info");
        window.open("<?= base_url("tpp/master/data_pasien") ?>", '_self');
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

  // jQuery.validator.addMethod("lettersonly", function(value, element) {
  //   return this.optional(element) || /^[a-z," ",A-Z,-_'"()`?/]+$/i.test(value);
  // }, "Hanya huruf dan karakter lain");

  function SimpanData(form, act, url, sukses = "") {
    $.ajax({
      type: "POST",
      url: "<?= base_url("tpp/master/data_pasien/") ?>" + act,
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

  function getAge(dateString) {
    var now = new Date();
    var today = new Date(now.getYear(), now.getMonth(), now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    var dob = new Date(dateString);

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";


    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
      var monthAge = monthNow - monthDob;
    else {
      yearAge--;
      var monthAge = 12 + monthNow - monthDob;
    }

    if (dateNow >= dateDob)
      var dateAge = dateNow - dateDob;
    else {
      monthAge--;
      var dateAge = 31 + dateNow - dateDob;

      if (monthAge < 0) {
        monthAge = 11;
        yearAge--;
      }
    }

    age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
    };

    console.log(age);
    $(".tahun").val(age.years);
    if (($(".bulan").val() != 0 || $(".hari").val() != 0) || TypeChange != 'tahun') {
      $(".bulan").val(age.months);
      $(".hari").val(age.days);
    }
  }

  function ChangeDate() {
    var tahun = $(".tahun").val();
    var bulan = $(".bulan").val();
    var hari = $(".hari").val();
    date = new Date(moment().subtract(hari, 'days').subtract(bulan, 'months').subtract(tahun, 'years').format('YYYY-MM-DD'));
    if (bulan == 0 && hari == 0 && tahun != 0) {
      var thisYear = (new Date()).getFullYear();
      var start = new Date("1/1/" + thisYear);
      TypeChange = 'tahun';
      date = new Date(moment(start.valueOf()).subtract(tahun, 'years').format('YYYY-MM-DD'))
    }

    $(".tgl_lahir").datetimepicker("setDate", date);
  }

  $(".tgl_lahir").change(function() {
    let date = $(this).val();
    var date_change = format(date);
    TypeChange = 'datepicker';
    if (date_change > new Date()) {
      TanggalError()
    } else {
      getAge(date_change);
    }
  })

  function format(inputDate) {
    inputDate = moment(inputDate, "DD/MM/YYYY").format("YYYY-MM-DD");
    var date = new Date(inputDate);
    return date;
  }

  $(".btn-sda").click(function(event) {
    provinsi = $(".dropdown-propinsi").val();
    kabupaten = $(".dropdown-kabupaten").val();
    kecamatan = $(".dropdown-kecamatan").val();
    kelurahan = $(".dropdown-kelurahan").val();
    $(".dropdown-propinsi_d").val(provinsi).trigger("change");
    GetKabupatenD(provinsi, "<?= base_url("tpp/ajax_tpp") ?>", kabupaten, function(resp) {
      GetKecamatanD(provinsi, kabupaten, "<?= base_url("tpp/ajax_tpp") ?>", kecamatan, function(resp) {
        GetKelurahanD(provinsi, kabupaten, kecamatan, "<?= base_url("tpp/ajax_tpp") ?>", kelurahan)
      })
    })
    $(".alamat_d").val($(".alamat").val())
    $(".rt_d").val($(".rt").val())
    $(".rw_d").val($(".rw").val())
    $(".kodepos_d").val($(".kodepos").val())
  });

  const TanggalError = () => {
    $.messager.alert("Peringatan!", "Tgl Lahir Tidak Bisa Melebihi Tgl Sekarang", "danger");
    $(".tgl_lahir").datetimepicker("setDate", new Date())
    // getAge(new Date())
  }

  const FindRmIbu = (norm) => {
    $.ajax({
      url: '<?= base_url("tpp/entry/pasien_baru/DetailIbu") ?>',
      type: 'POST',
      dataType: 'JSON',
      data: {
        no_mribu: norm
      },
      success: function(response) {
        if (!empty(response.metadata.error) || !empty(response.metadata.err_code)) {
          $(".ibu_kandung").val("");
          $(".id_mribu").val("");
        } else {
          //Jika Suskses maka menjalankan fungsi berikut
          $(".ibu_kandung").val(response.list[0].nama_lengkap).trigger("change");
          $(".id_mribu").val(response.list[0].id_mr).trigger("change");
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $(".ibu_kandung").val("");
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
      }
    })
  }

  const SetDefault = (reset) => {
    if (!empty(reset)) {
      $("input[type=text] , select ").val("").trigger("change");
    }
    let date_now = moment().format("DD/MM/YYYY");
    GetJnsPasien()
    GetJnsKegiatanKhusus()
    GetKelasBpjs()
    $(".kewarganegaraan").val("WNI").trigger("change")
    $(".tgl_lahir").datetimepicker("setDate", new Date())
    $(".tgl_daftar").datetimepicker("setDate", new Date())
    getDetail("<?= $id ?>")
  }

  const GetKelasBpjs = () => {
    getDropDown($(".dropdown-kelas_bpjs"), '<?= base_url("tpp/ajax_tpp/KelasBpjs") ?>')
  }

  const GetJnsPasien = () => {
    getDropDown($(".dropdown-id_jnspasien"), '<?= base_url("tpp/ajax_tpp/JnsPasien") ?>'), "",
      function(resp) {

      }
  }

  const GetJnsKegiatanKhusus = () => {
    getDropDown($(".dropdown-id_jnskegiatankhusus"), '<?= base_url("tpp/ajax_tpp/GetJnsKegiatanKhusus") ?>', "", function() {
      $('.dropdown-id_jnskegiatankhusus').val('').trigger("change");
      $('.dropdown-id_jnskegiatankhusus').select2({
        disabled: true,
        placeholder: 'Pilih Kegiatan Kusus'
      });
      $(".dropdown-id_jnspasien").val("1").trigger("change");
    })
  }

  $(".dropdown-id_jnspasien").change(function() {
    if ($(this).val() == "7") {
      $('.dropdown-id_jnskegiatankhusus').select2({
        disabled: false
      });
    } else {
      $('.dropdown-id_jnskegiatankhusus').val('').trigger("change");
      $('.dropdown-id_jnskegiatankhusus').select2({
        disabled: true,
        placeholder: 'Pilih Kegiatan Kusus'
      });
    }
  })


  $(".dropdown-suku_bangsa").on("change", function() {
    if ($(this).val() == "Lain-lain") {
      $(".suku_lain").val("").removeAttr("disabled");
    } else {
      $(".suku_lain").val("").attr("disabled", 'disabled');
    }
  })

  $(".no_mribu").change(function() {
    FindRmIbu($(this).val())
  })

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
      GetKelurahan(propinsi, kabupaten, kecamatan, "<?= base_url("tpp/ajax_tpp/GetKelurahan") ?>", "")
    }
  })

  $(".dropdown-propinsi_d").change(function() {
    let propinsi = $(this).val()
    if (empty(propinsi)) {
      $(".dropdown-kabupaten_d").select2({
        disabled: true,
        placeholder: "Pilih Kabupaten"
      });
      $(".dropdown-kabupaten_d").val("").trigger("change");
      // GetKelurahan("", "", "", "<?= base_url("tpp/ajax_tpp") ?>", "")
    } else {
      GetKabupatenD(propinsi, "<?= base_url("tpp/ajax_tpp/GetKabupaten") ?>", "")
    }
  })

  $(".dropdown-kabupaten_d").change(function() {
    let propinsi = $(this).parent().parent().parent().find(".dropdown-propinsi_d").val()
    let kabupaten = $(this).val()
    if (empty(kabupaten)) {
      $(".dropdown-kecamatan_d").select2({
        disabled: true,
        placeholder: "Pilih Kecamatan"
      });
      $(".dropdown-kecamatan_d").val("").trigger("change");
    } else {
      GetKecamatanD(propinsi, kabupaten, "<?= base_url("tpp/ajax_tpp/GetKecamatan") ?>", "", function() {
        $(".dropdown-kelurahan_d").select2({
          disabled: true,
          placeholder: "Pilih Kelurahan"
        });
        $(".dropdown-kelurahan_d").val("").trigger("change");
      })
    }
  })

  let empty = (string) => {
    return string == undefined || string == "" || string == null;
  };

  $(".dropdown-kecamatan_d").change(function() {
    let propinsi = $(this).parent().parent().parent().find(".dropdown-propinsi_d").val()
    let kabupaten = $(this).parent().parent().parent().find(".dropdown-kabupaten_d").val()
    let kelurahan = $(this).parent().parent().parent().find(".dropdown-kelurahan_d").val()
    let kecamatan = $(this).val()
    if (empty(kecamatan)) {
      $(".dropdown-kelurahan_d").select2({
        disabled: true,
        placeholder: "Pilih Kelurahan"
      });
      $(".dropdown-kelurahan_d").val("").trigger("change");
    } else {
      GetKelurahanD(propinsi, kabupaten, kecamatan, "<?= base_url("tpp/ajax_tpp/GetKelurahan") ?>", "")
    }
  })

  function getDetail(id_mr) {
    $.ajax({
      url: '<?= $urlData ?>DetailPasien',
      type: 'POST',
      dataType: 'JSON',
      data: {
        id_mr: id_mr
      },
      beforeSend: function() {
        $("#panelEdit").find('.before-loading').removeClass('d-none');
        $("#panelEdit").find('.after-loading').addClass('d-none');
      },
      success: function(resp) {
        var status = resp.metadata;
        if (status.err_code == 0) {
          provinsi = resp.rows[0].propinsi_d;
          kabupaten = resp.rows[0].kabupaten_d;
          kecamatan = resp.rows[0].kecamatan_d;
          kelurahan = resp.rows[0].kelurahan_d;

          $.each(resp.rows[0], function(index, val) {
            $("#panelEdit").find('.easyui-textbox.' + index).textbox("setValue", val);
            let indexed = index.match(/tgl/g);
            if (indexed) {
              $("." + index).datetimepicker("setDate", new Date(moment(val, "DD/MM/YYYY")))
            } else {
              $("." + index).val(val).trigger("change");
            }
          });
          if (resp.rows[0].lengkap == '1') {
            $('.easyui-checkbox.lengkap').checkbox("check");
          }
          let data = resp.rows[0];

          GetKabupaten(data.propinsi, "<?= base_url("tpp/ajax_tpp/GetKabupaten") ?>", data.kabupaten, function() {
            GetKecamatan(data.propinsi, data.kabupaten, "<?= base_url("tpp/ajax_tpp/GetKecamatan") ?>", data.kecamatan, function() {
              GetKelurahan(data.propinsi, data.kabupaten, data.kecamatan, "<?= base_url("tpp/ajax_tpp/GetKelurahan") ?>", data.kelurahan, function() {
                GetKabupatenD(data.propinsi_d, "<?= base_url("tpp/ajax_tpp/GetKabupaten") ?>", data.kabupaten_d, function() {
                  GetKecamatanD(data.propinsi_d, data.kabupaten_d, "<?= base_url("tpp/ajax_tpp/GetKecamatan") ?>", data.kecamatan_d, function() {
                    GetKelurahanD(data.propinsi_d, data.kabupaten_d, data.kecamatan_d, "<?= base_url("tpp/ajax_tpp/GetKelurahan") ?>", data.kelurahan_d)
                  })
                })
              })
            })
          })

          getAge(new Date(moment(resp.rows[0].tgl_lahir, "DD/MM/YYYY")))
          $("#panelEdit").find('.id_mr').val(data_pasien.id_mr);
          $("#panelEdit").find('.after-loading').removeClass('d-none');
          $("#panelEdit").find('.before-loading').addClass('d-none');
        } else {
          $.messager.alert("Peringatan!", status.message, "danger");
          window.open("<?= base_url("tpp/master/data_pasien") ?>", '_self');
        }
      },
      error: function(JqErr, textStatus, Xhrattr) {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        $('#panelEdit').window('close');
      }
    })
  }
</script>