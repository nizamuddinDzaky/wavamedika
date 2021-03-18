<script type="text/javascript">
  $(document).ready(function() {
    console.log("ready!");
    GetUnit();
  });

  $(".no_biling").change(function() {
    dataMrs($(this).val())
  })

  function dataMrs(id_mrs) {
    $.ajax({
      url: '<?= $urlData ?>DataMrs',
      type: 'POST',
      beforeSend: function() {
        $("#FormHapus").find("input , select").not(".no_biling").val("").trigger("change");
      },
      dataType: 'JSON',
      data: {
        id_mrs: id_mrs
      },
      success: function(resp) {
        if (!empty2(resp.rows)) {
          $.each(resp.rows[0], function(index, val) {
            $("." + index).val(val).trigger("change");
          });
        }
      }
    })
  }

  function HapusMrs() {
    $("#FormHapus").submit();
  }

  $("#FormHapus").validate({
    focusInvalid: true,
    submitHandler: function(form) {
      SimpanData("#FormHapus", "HapusMrs", function(respon) {
        $.messager.alert("Pemberitahuan !", respon.metadata.message, "info");
        $(".Refresh").click();
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

  $("form").on("submit", function(e) {
    e.preventDefault(); // disable submit form
  });

  const GetUnit = (AfterFunc) => {
    getDropDown($(".unit"), '<?= $urlData . "ComboUnit" ?>', "", function() {
      if (!empty2(AfterFunc)) {
        AfterFunc()
      }
    })
  }

  $(".unit").change(function() {
    GetDokter($(this).val())
  })

  $(".dropdown-dokter").select2({
    disabled: true,
    placeholder: "Pilih Unit Dahulu"
  })

  const GetDokter = (id_unit, AfterFunc) => {
    let filter = {
      id_jnskaryawan: id_unit
    }
    if (empty2(id_unit)) {
      $(".dropdown-dokter").select2({
        disabled: true,
        placeholder: "Pilih Unit"
      })
    } else {
      getDropdownStatis($(".dropdown-dokter"), '<?= $urlData . "ComboKaryawan" ?>', filter, function() {
        $(".dropdown-dokter").select2({
          disabled: false,
        })
        if (!empty2(AfterFunc)) {
          AfterFunc()
        }
      })
    }
  }

  $(".Refresh").click(function() {
    $("#FormHapus").find("input").val("").trigger("change")
    $("#FormHapus").find("select").val("").trigger("change")
  })
</script>