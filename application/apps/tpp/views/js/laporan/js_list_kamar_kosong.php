<script type="text/javascript">
   $(document).ready(function () {
    console.log("ready!");
    $('#select_unit').select2({
     placeholder: '-- Pilih Unit',
//      required: true,
    });
    GetDataTable();
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
   })
   function GetDataTable() {
    filter = $("#form-header-filter").serializeArray();
    console.log(filter);
    filter_data = setArray(filter);
    $('#dgs').datagrid({
     url: '<?= $urlData ?>listkamarkosong',
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