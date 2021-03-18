<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo "";
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title><?php echo isset($title) ? $title . " | " : ''; ?>WAVA Husada MersiHospital</title>
  <meta name="description" content="Mersihospital">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--begin::Fonts -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"> -->

  <!--end::Fonts -->

  <link rel="stylesheet" type="text/css" href="<?= base_url("assets") ?>/easyui/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets") ?>/easyui/icon.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets") ?>/easyui/color.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets") ?>/easyui/demo.css">

  <!--begin::Page Vendors Styles(used by this page) -->
  <link href="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css'); ?>" rel="stylesheet" type="text/css" />

  <!--end::Page Vendors Styles -->

  <!--begin::Global Theme Styles(used by all pages) -->
  <link href="<?php echo base_url('assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/printJs/print.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet" type="text/css" />

  <!--end::Global Theme Styles -->

  <!--begin::Layout Skins(used by all pages) -->

  <!--end::Layout Skins -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/media/logos/favicon.ico'); ?>" />
  <style>
   html, body {
    max-width: 100%;
    overflow-x: hidden;
   }
   .kt-container-form{
    margin: 0px !important;
   }
   .kt-footer{
    background: none !important;
   }
   .filter-box{
    border: 0px;
   }
   .filter-box .card .card-header {
    /*background: #20c997;*/
   }
  </style>
  <?php $this->load->view($content); ?>

  <!--
</body>
</html>

