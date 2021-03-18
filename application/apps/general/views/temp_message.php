<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $this->load->view('template/head');
    ?>
</head>
<!-- <body class="hold-transition skin-blue sidebar-mini"> -->
<body style="background-image: url('<?php echo base_url('assets/media/demos/demo4/header.jpg');?>'); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-page--fluid kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
    <?php $this->load->view('template/head-mobile'); ?>
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                <?php $this->load->view('template/navbar'); ?>
                <?php $this->load->view('template/content-body'); ?>
                <?php $this->load->view('template/footer'); ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('template/script'); ?>
</body>
</html>
