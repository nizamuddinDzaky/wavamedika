<script type="text/javascript">
  var intervalJam, intervalDetik;
  $(document).ready(function() {
    console.log("ready!");
    moment.locale("id");
    var tgl_sekarang = moment().format("dddd , DD MMMM YYYY hh:mm");
    SetIntervalD(10);
    getDropDown($(".dropdown-loket"), "<?= base_url("tpp/ajax_tpp/ComboboxLoket") ?>")
  });

  function SetIntervalD(detik) {
    if (empty(detik)) detik = 10;
    clearInterval(intervalJam);
    clearInterval(intervalDetik);
    SetTimeOutData(detik)
    detik = detik * 1000;
    intervalJam = setInterval(function() {
      if (!empty($(".dropdown-loket").val())) {
        GetDaftar();
      }
    }, detik)
  }

  function SetTimeOutData(TimeOut) {
    if (empty(TimeOut)) TimeOut = 10;
    var detik = TimeOut;
    intervalDetik = setInterval(function() {
      // change date
      tgl_sekarang = moment().format("dddd , DD MMMM YYYY hh:mm");
      $(".tgl_sekarang").html(tgl_sekarang);
      // change data
      $(".count-down").html(detik);
      detik--;
      if (detik == "0") {
        detik = TimeOut;
      }
    }, 1000)
  }

  function GetDaftar() {
    $.ajax({
      url: '<?= $urlData ?>DataAntriDaftar',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "loket": $(".dropdown-loket").val(),
      },
      success: function(resp) {
        var html = "";
        var Bgclass = "";
        var ClassNow = "";
        var TitleData = "";
        var DataTampilan = setArray($("#FormNoAktif").serializeArray());
        if (resp.metadata.err_code == 0) {
          var count_data = resp.metadata.list_count - 1;
          $.each(resp.rows, function(index, val) {
            Bgclass = "";
            TitleData = "Nomor Antrian";
            if (val.stat_skip == "1") {
              Bgclass = "bg-secondary";
              // ClassNow = Bgclass ;
              TitleData = "Skip Nomor";
            }

            if (!empty(DataTampilan.id_antripendaftaran)) {
              if (DataTampilan.id_antripendaftaran == val.id_antripendaftaran) Bgclass += " bg-success";
              if (DataTampilan.next == val.id_antripendaftaran) Bgclass += " bg-warning";
            }

            if (index >= count_data) {
              nextData = "LAST";
              TitleData = "Data Terakhir";
            } else {
              nextData = resp.rows[index + 1].id_antripendaftaran;
            }

            html += ' <li class="list-group-item list-data ' + Bgclass + '" data-id_antripendaftaran="' + val.id_antripendaftaran + '" data-next="' + nextData + '" data-no_antri="' + val.no_antri + '" title="' + TitleData + '"><b>' + val.no_antri + '</b></li>';
          });
          $(".list_antrian").html(html);
        } else {
          // $.messager.alert("Peringatan!",resp.metadata.message, "danger"); 
        }
      },
      error: function() {
        // $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        console.log("Terjadi kesalahan ketika memproses data ");
      }
    })
  }

  function AntriAktif() {
    $.ajax({
      url: '<?= $urlData ?>AntriAktif',
      type: 'POST',
      dataType: 'JSON',
      data: {
        "loket": $(".dropdown-loket").val(),
        "no_antri": $(".no_antri_sekarang").html(),
      },
      success: function(resp) {},
      error: function() {
        $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
      }
    })
  }

  function UpdateCall() {
    if (!empty($("[name=id_antripendaftaran]").val())) {
      $.ajax({
        url: '<?= $urlData ?>UpdateCall',
        type: 'POST',
        dataType: 'JSON',
        data: {
          "loket": $(".dropdown-loket").val(),
          "id_antripendaftaran": $("[name=id_antripendaftaran]").val(),
        },
        success: function(resp) {
          GetDaftar();
        },
        error: function() {
          $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        }
      })

    } else {
      $.messager.alert("Peringatan!", "Pilih No Antrian Dahulu ", "danger");
    }
  }

  function UpdateSkip() {
    if (!empty($("[name=id_antripendaftaran]").val())) {
      $.ajax({
        url: '<?= $urlData ?>UpdateSkip',
        type: 'POST',
        dataType: 'JSON',
        data: {
          "id_antripendaftaran": $("[name=id_antripendaftaran]").val(),
        },
        success: function(resp) {
          GetDaftar()
        },
        error: function() {
          $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        }
      })
    }
    // else {
    //   $.messager.alert("Peringatan!", "Pilih No Antrian Dahulu ", "danger");
    // }
  }

  function UpdateRegister(TypeChange) {

    if (!empty($("[name=id_antripendaftaran]").val())) {
      if (empty(TypeChange)) {
        window.open('<?= base_url("tpp/entry/pasien_mrs") ?>', '_blank');
      } else {
        $.ajax({
          url: '<?= $urlData ?>UpdateRegister',
          type: 'POST',
          dataType: 'JSON',
          beforeSend: function() {
            $("[data-id_antripendaftaran=" + $("[name=id_antripendaftaran]").val() + "]").addClass('bg-secondary');
            // window.open("<?= base_url("tpp/entry/pasien_mrs") ?>","", "width=1000,height=800");
          },
          data: {
            "loket": $(".dropdown-loket").val(),
            "id_antripendaftaran": $("[name=id_antripendaftaran]").val(),
          },
          success: function(resp) {
            GetDaftar();
            ChangeDataAntri("button");
          },
          error: function() {
            $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
          }
        })
      }
    } else {
      $.messager.alert("Peringatan!", "Pilih No Antrian Dahulu ", "danger");
    }

  }

  function UpdateInaktif() {
    if (!empty($("[name=id_antripendaftaran]").val())) {
      $.ajax({
        url: '<?= $urlData ?>UpdateInaktif',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
          $("[data-id_antripendaftaran=" + $("[name=id_antripendaftaran]").val() + "]").hide();
        },
        data: {
          "loket": $(".dropdown-loket").val(),
          "id_antripendaftaran": $("[name=id_antripendaftaran]").val(),
        },
        success: function(resp) {
          GetDaftar();
        },
        error: function() {
          $.messager.alert("Peringatan!", "Terjadi kesalahan ketika memproses data ", "danger");
        }
      })
    }
  }

  function ChangeDataAntri(TypeChange) {
    if (empty(TypeChange)) { // JIka Pencet LIStNYA
      var dataDetail = $(".list_antrian").find(".list-terpilih").data();
      $("[data-id_antripendaftaran=" + dataDetail.next + "]").addClass('bg-warning');
      $.each(dataDetail, function(index, val) {
        $("#FormNoAktif").find("[name=" + index + "]").val(val);
      });
      $(".no_antri_sekarang").html(dataDetail.no_antri);

    } else { // jika melalui SKIP / NEXT
      var dataDetail = $("#FormNoAktif").serializeArray();
      // console.log(filter);
      dataDetail = setArray(dataDetail);
      if (!empty(dataDetail.id_antripendaftaran) && dataDetail.next != "LAST") {
        dataDetail = $(".list_antrian").find("[data-id_antripendaftaran=" + dataDetail.next + "]").click();
      } else if (dataDetail.next == "LAST") {
        $("#FormNoAktif").find("input").val("");
        $(".no_antri_sekarang").html("&nbsp;");
      } else {
        $.messager.alert("Peringatan!", "Pilih No Antrian Dahulu ", "danger");
      }
    }
  }

  $(".list_antrian").on('click', '.list-data', function(event) {
    $(".list-data").removeClass('list-terpilih').removeClass('bg-success').removeClass('bg-warning');
    $(this).addClass('list-terpilih bg-success');
    ChangeDataAntri();
  });

  $(".inaktif_antrian , .skip_antrian , .next_antrian ").click(function(event) {

    ChangeDataAntri("button");
  });

  $(".Refresh").click(function(event) {
    $("#resetDetik").submit();
  });

  $("#resetDetik").on("submit", function(e) {
    //stop submitting the form to see the disabled button effect
    e.preventDefault();
    SetIntervalD($("[name=detik]").val());
  });

  function setArray(DataArray) {
    var data_x = [];
    $.each(DataArray, function(index, item) {
      data_x[item.name] = item.value;
    });
    return data_x;
  }

  function empty(string) {
    return (string == undefined || string == "" || string == null);
  }

  $(".dropdown-loket").change(function() {
    let n = $(this).val();
    GetDaftar(n);
  })
</script>