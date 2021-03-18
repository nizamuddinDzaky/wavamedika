<script type="text/javascript">
   $(document).ready(function () {
    console.log("ready!");
//    GetDataTable();
//    GetDataRekap();
    $('#select_unit').select2();
    $('#select_cara_masuk').select2();
   });
   var tabelDetail = $('#tabel_detail');
   $('#btn-ubah').click(function () {
    var row = tabelDetail.datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     Panel = $('#winEditData');
     Panel.window('open').window('center');
    }
   });
   $('#btn-infopasien').click(function () {
    var row = tabelDetail.datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     Panel = $('#winInfoPasien');
     Panel.window('open').window('center');
    }
   });
   $('#btn-printkarcis').click(function () {
    var row = tabelDetail.datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     Panel = $('#winPrintKarcis');
     Panel.window('open').window('center');
    }
   });
   $('#btn-printsticker').click(function () {
    var row = tabelDetail.datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     Panel = $('#winPrintSticker');
     Panel.window('open').window('center');
    }
   });
   $('#btn-printrekap').click(function () {
    var row = tabelDetail.datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     Panel = $('#winPrintRekap');
//     Panel.window('open').window('center');
     alert('Cetak Rekap');
    }
   });
   $('#btn-membercard').click(function () {
    var row = tabelDetail.datagrid('getSelected');
    if (row <= 0) {
     swal.fire('Peringatan!', 'Data Belum Dipilih!', 'warning');
    } else {
     Panel = $('#winMemberCard');
     Panel.window('open').window('center');
    }
   });
   function GetDataTable() {
    var filter = $("#form-header-filter").serializeArray();
    var filter_data = setArray(filter);
    $('#tabel_detail').datagrid({
     url: '<?= $urlData ?>registerpendaftaran',
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

   function GetDataRekap() {
    var filter = $("#form-header-filter").serializeArray();
    var filter_data_rekap = setArray(filter);
    $('#tabel_rekap').datagrid({
     url: '<?= $urlData ?>registerpendaftaranrekap',
     method: 'post',
     rownumbers: true,
     pageSize: "10",
     singleSelect: true,
     autoRowHeight: true,
     queryParams: filter_data_rekap,
     emptyMsg: 'no records found',
     onRowContextMenu: function (e, index, row) {

     }
    });
   }

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
   $("#btnFilter").click(function () {
    if (!$("#form-header-filter").form("validate")) {
     $.messager.alert("Peringatan!", "Isi Form Dengan Benar ", "info");
     $("#form-header-filter").form("resetValidation");
    } else {
     GetDataTable();
     GetDataRekap();
    }
   })

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