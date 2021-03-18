
<!-- end::Global Config -->
<script type="text/javascript" src="<?= base_url("assets") ?>/easyui/jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/scripts.bundle.js'); ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?= base_url("assets") ?>/easyui/jquery.easyui.min.js"></script>

<script src='<?php echo base_url('assets/plugins/pdfMake/pdfmake.min.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/pdfMake/vfs_fonts.js'); ?>'></script>
<script src='<?php echo base_url('assets/plugins/printJs/print.min.js'); ?>'></script>

<!-- xlsx -->
<!-- <script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script> -->

<!--end::Global Theme Bundle -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-4-autocomplete/dist/bootstrap-4-autocomplete.min.js" crossorigin="anonymous"></script> -->

<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/accounting.min.js'); ?>" type="text/javascript"></script>
<!--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>-->
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo base_url('assets/js/custom.global.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/custom.tpp.js?'); ?>" type="text/javascript"></script>

<script>
 $(document).ready(function () {
  $("#btnCari").click(); // untuk get  data
  $("#btnTutupFilter").click(function () {
   $('#collapseOne4').collapse('toggle');
  });
  $(".btnFilter").click(function () {
   $('#collapseOne4').collapse('toggle');
  });
  $('input[type=date-formatted]').each(function () {
   var format_date = "yyyy-mm-dd";
   if ($(this).data("format") !== null || $(this).data("format") !== undefined || $(this).data("format") !== '') {
    format_date = $(this).data("format");
   }

   if ($(this).val() === null || $(this).val() === undefined || $(this).val() === '') {
//    $(this).val(moment().format("YYYY-MM-DD"));
    $(this).val(moment().format("DD/MM/YYYY"));
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
  })
 });

 var KTAppOptions = {
  "colors": {
   "state": {
    "brand": "#366cf3",
    "light": "#ffffff",
    "dark": "#282a3c",
    "primary": "#5867dd",
    "success": "#34bfa3",
    "info": "#36a3f7",
    "warning": "#ffb822",
    "danger": "#fd3995"
   },
   "base": {
    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
   }
  }
 };
 function setArray(DataArray) {
  var data_x = [];
  $.each(DataArray, function (index, item) {
   data_x[item.name] = item.value;
  });
  return data_x;
 }
</script>
<!--end::Page Scripts -->