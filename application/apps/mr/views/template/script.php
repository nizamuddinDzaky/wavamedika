<script>
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
</script>
<!-- end::Global Config -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.9.1.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/tabs.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tabs-jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/tabs-ajax.min.js');?>"></script>
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/scripts.bundle.js');?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url('assets/easyui/jquery.easyui.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/easyui/datagrid-detailview.js');?>"></script>
<!-- <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> -->

<!-- message-script -->
<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/adminlte.min.js');?>"></script> -->


<!-- <script type="text/javascript" src='<?php echo base_url('assets/plugins/swal-forms/live-demo/sweet-alert.js');?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/plugins/swal-forms/swal-forms.js');?>'></script> -->
<!--end::Global Theme Bundle -->
<!-- start script select 2 -->
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> -->

<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/accounting.min.js');?>" type="text/javascript"></script>
<!--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>-->
<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo base_url('assets/js/custom.global.js');?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/js/custom.tpp.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/utils.js');?>" type="text/javascript"></script>
<script type="text/javascript">
  $(function(){
    $(".preloader").fadeOut(1300);
  })
</script>

<?php
if (isset($js)) {
  if (empty($module)) {
    $this->load->view('js/' . $js);
  } else {
    $this->load->view($module . '/js/' . $js);
  }
}
?>
<!--end::Page Scripts -->