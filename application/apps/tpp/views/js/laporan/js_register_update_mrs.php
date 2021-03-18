<script type="text/javascript">
   $(document).ready(function () {
    console.log("ready!");
    GetDataTable();
   });

   $('input[type=date-formatted]').each(function () {
    var format_date = "yyyy-mm-dd";
    if ($(this).data("format") !== null || $(this).data("format") !== undefined || $(this).data("format") !== '') {
     format_date = $(this).data("format");
    }

    if ($(this).val() === null || $(this).val() === undefined || $(this).val() === '') {
     $(this).val(moment().format("YYYY-MM-DD"));
    }

    $(this).datetimepicker({
     format: format_date,
     todayHighlight: true,
     setDate: 'today',
     autoclose: true,
     startView: 2,
     minView: 2,
     forceParse: 0,
     pickerPosition: 'bottom-left'
    });
   });

   function GetDataTable() {
    var filter = $("#form-header-filter").serializeArray();
    var filter_data = setArray(filter);

    $('#dgs').datagrid({
     url: '<?= $urlData ?>registerupdatemrs',
     method: 'post',
     rownumbers: true,
     pageSize: "10",
     pageNumber: 1,
     singleSelect: true,
     autoRowHeight: true,
     queryParams: filter_data,
     onRowContextMenu: function (e, index, row) {
      e.preventDefault();
     }
    });
   }

   $("#btnFilter").click(function () {
    if (!$("#form-header-filter").form("validate")) {
     $.messager.alert("Peringatan!", "Isi Form Dengan Benar ", "info");
     $("#form-header-filter").form("resetValidation");
    } else {
     GetDataTable();
    }
   });

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