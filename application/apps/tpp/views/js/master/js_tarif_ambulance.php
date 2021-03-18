<script type="text/javascript">
  $(document).ready(function() {
    console.log("ready!");
    GetDataTable()
  });

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

  $(".dropdown-kelurahan").change(function() {
    if (empty($(this).val())) {

    } else {
      GetTarif()
    }
  })

  function GetTarif() {
    $.ajax({
      type: "POST",
      dataType: "JSON",
      url: "<?= $urlData ?>Tarif",
      data: $("#form-header").serialize(),
      success: function(response) {
        data = response.list;
        response = response.metadata;
        if (response.error) {
          $(".tarif-ambulance").html(response.message);
        } else {
          if (data[0].ambulance == null) {
            $(".tarif-ambulance").html("Data Tidak DItemukan");
          } else {
            $(".tarif-ambulance").html(data[0].ambulance);
          }
        }
      }
    });
  }

  function GetDataTable() {
    $('#dg').datagrid({
      url: '<?= $urlData ?>ListTarif',
      method: 'post',
      queryParams: {
        "act": "ListTarif"
      }
    });
  }

  let empty = (string) => {
    return string == undefined || string == "" || string == null;
  };
</script>