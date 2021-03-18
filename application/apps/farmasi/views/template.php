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
    <div class="preloader">
        <div class="loading form-group">
            <img src="<?php echo base_url('assets/img/loading.gif');?>" width="160" style="margin-left: 15%">
            <img src="<?php echo base_url('assets/img/logo-mini-lg.png');?>" width="90" style="margin-left: -50%">
        </div>
    </div>
    <div id="loader" style="display: none"></div>
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
    <div class="modal fade" id="alert">
        <div class="modal-dialog modal-dialog-centered modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Autorisasi!</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                            Password :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <input id="txt-passwordcek" class="form-control form-control-sm" type="password">
                        </div>
                        <input class="form-control form-control-sm" type="hidden" id="txt-tempStatus">
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-4 col-sm-12 form-control-sm kt-font-sm">
                            Keterangan :
                        </label>
                        <div class="col-lg-8 col-sm-12">
                            <textarea id="txt-desc" data-options="multiline:true" class="col-lg-12 form-control form-control-sm kt-font-sm" style="resize: none;"></textarea>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-8">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-4 col-sm-12 kt-padding" id="div-simpan">
                                <button onclick="cek_autor()" type="button" class="form-control form-control-sm btn btn-sm btn-primary kt-font-sm">
                                    <i class="la la-check"></i>
                                    Ya
                                </button>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-12 kt-padding">
                                <button id="btn-batal_autor" type="button" class="form-control form-control-sm btn btn-sm btn-secondary kt-font-sm" data-dismiss="modal">
                                    <i class="la la-times"></i>
                                    Tidak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="win-input_stok_opname" class="panel-window" data-title="Input Stok Opname" style="width: 40%; height: 70%" closed="true">
            <div class="kt-portlet">
                <div class="kt-portlet__body header-form">
                    <form class="kt-form col-lg-12 header-form" id="form-detail">
                        <h1>Form Input Stok Opname</h1>
                    </form>
                </div>
            </div>
    </div>
    
    <?php $this->load->view('template/script'); ?>
</body>
</html>
