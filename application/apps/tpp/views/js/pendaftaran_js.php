<!-- Script easy ui -->
<script type="text/javascript">
   $(document).ready(function () {
    $(function ($) {

     // For Action
     $(function () {
      $('#tambah').click(function () {
       $('#win').window('open');
      });
     });


     // Sweet Alert (title, body, icon)
     $('#alert_test').click(function () {
      swal.fire('Good Job!', 'Container body...', 'warning');
     });
     $('#cc').combobox({
      valueField: 'coa_id',
      textField: 'coa_name',
      url: '<?php echo base_url("welcome/get_kas_bank"); ?>',

      required: false,
      width: '100%',
      onChange: function (newValue, oldValue) {
       // console.log(newValue);
       // console.log(oldValue);
      },

     });

     //download excel
     $('#download_excel').click(function () {
      var createXLSLFormatObj = [];
      var xlsRows = [];
      $.ajax({
       type: 'POST',
       url: '<?php echo base_url("welcome/getuser"); ?>',
       data: {},
       success: function (data) {
        /* XLS Head Columns */
        var xlsHeader = ["id", "firstname", "lastname", "phone", "email"];
        xlsRows = data.rows

        // table header
        createXLSLFormatObj.push(xlsHeader);
        $.each(xlsRows, function (index, value) {
         var innerRowData = [];
         $.each(value, function (ind, val) {

          innerRowData.push(val);
         });
         createXLSLFormatObj.push(innerRowData);
        });

        /* File Name */
        var filename = "File_XLS.xlsx";

        /* Sheet Name */
        var ws_name = "FileSheet";

        // if (typeof console !== 'undefined') console.log(new Date());
        var wb = XLSX.utils.book_new(),
            ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);

        /* Add worksheet to workbook */
        XLSX.utils.book_append_sheet(wb, ws, ws_name);

        /* Write workbook and Download */
        // if (typeof console !== 'undefined') console.log(new Date());
        XLSX.writeFile(wb, filename);
        // if (typeof console !== 'undefined') console.log(new Date());

       }
      });

     });
    });
   });
</script>
<!-- end script -->