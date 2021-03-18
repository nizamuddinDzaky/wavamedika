<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>
   <?php echo isset($title) ? $title : ''; ?> | TPP.</title>
  <meta name="description" content="Latest updates and statistic charts">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--begin::Fonts -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"> -->
  <!--end::Fonts -->
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/easyui/") ?>default/easyui.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/easyui/") ?>icon.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/easyui/") ?>color.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url("assets/easyui/") ?>demo.css">
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
   .kt-portlet, .kt-iconbox {
    background-color:#0f9e98 !important;
   }
   .kt-iconbox__content, .kt-iconbox__title a {
    color:#fff !important;
   }
   .kt_footer, .kt-footer--extended {
    background-color:transparent !important;
   }
   .kt-header-menu-wrapper{
    margin-left:1em;
   }
   div {
      /*border: 1px solid black;*/
    }
  </style>
 </head>
 <!-- <body class="hold-transition skin-blue sidebar-mini"> -->
 <body style="background-image: url('<?php echo base_url('assets/media/demos/demo4/header.jpg'); ?>'); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-page--fluid kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

  <!-- begin:: Header Mobile -->
  <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
   <div class="kt-header-mobile__logo">
    <a href="index.html">
     <img alt="Logo" src="<?php echo base_url('assets/media/logos/logo-4-sm.png'); ?>" />
    </a>
   </div>
   <div class="kt-header-mobile__toolbar">

    <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
   </div>
  </div>

  <!-- end:: Header Mobile -->


  <div class="kt-grid kt-grid--hor kt-grid--root">
   <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">




     <!-- begin:: Header -->
     <div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
      <div class="kt-container ">

       <!-- begin:: Brand -->
       <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
        <a class="kt-header__brand-logo" href="#">
         <img alt="Logo" src="<?php echo base_url('assets/media/logos/logo-4.png'); ?>" class="kt-header__brand-logo-default">
         <img alt="Logo" src="<?php echo base_url('assets/media/logos/logo-4-sm.png'); ?>" class="kt-header__brand-logo-sticky">
        </a>
       </div>

       <!-- end:: Brand -->

       <!-- begin: Header Menu -->
       <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
       <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu col-lg-12">
         <ul class="kt-menu__nav">
          <li class="kt-menu__item kt-header__topbar-welcome">Mersi Hospital</li>
         </ul>
            <div class="form-group row" style="margin-left: 5%; margin-top: 12px;">
                <div class="form-group col-lg-12 col-sm-12">
                    <input placeholder="Cari Modul..." class="form-control form-control-sm" type="text" id="txt-search" onclick="enter();" style="background-color: #ededed; border-color: #ededed; width: 100%;">
                    <!-- <span class="fa fa-search form-control-feedback"></span> -->
                </div>
                <div class="col-lg-1 col-sm-12" hidden="true">
                    <button type="button" class="form-control-sm btn btn-secondary kt-search-custom" id="btn-cari" onclick="checkInput()" style="background: #ffffff;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
       </div>

       <!-- end: Header Menu -->

       <!-- begin:: Header Topbar -->
       <div class="kt-header__topbar kt-grid__item">

        <!--begin: User bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
         <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
          <span class="kt-header__topbar-welcome">Hi,</span>
          <span class="kt-header__topbar-username">Sean</span>
          <span class="kt-header__topbar-icon"><b>S</b></span>
          <img alt="Pic" src="<?php echo base_url('assets/media/users/300_21.jpg'); ?>" class="kt-hidden">
         </div>
         <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" style="">

          <!--begin: Head -->
          <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url('assets/media/misc/bg-1.jpg'); ?>)">
           <div class="kt-user-card__avatar">
            <img class="kt-hidden" alt="Pic" src="<?php echo base_url('assets/media/users/300_25.jpg'); ?>">

            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
            <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
           </div>
           <div class="kt-user-card__name">
            Sean Stone
           </div>
           <div class="kt-user-card__badge">
            <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
           </div>
          </div>

          <!--end: Head -->

          <!--begin: Navigation -->
          <div class="kt-notification">
           <a href="custom/apps/user/profile-1/personal-information.html" class="kt-notification__item">
            <div class="kt-notification__item-icon">
             <i class="flaticon2-calendar-3 kt-font-success"></i>
            </div>
            <div class="kt-notification__item-details">
             <div class="kt-notification__item-title kt-font-bold">
              My Profile
             </div>
             <div class="kt-notification__item-time">
              Account settings and more
             </div>
            </div>
           </a>

           <div class="kt-notification__custom kt-space-between">
            <a href="custom/user/login-v2.html" target="_blank" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
            <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>
           </div>
          </div>

          <!--end: Navigation -->
         </div>
        </div>

        <!--end: User bar -->
       </div>

       <!-- end:: Header Topbar -->
      </div>
     </div>

     <!-- end:: Header -->


    <!-- begin:: Content -->
    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
        <div class="col-xl-12 order-lg-2 order-xl-1 container-mobile">
            <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile " style="background-color: transparent !important">
                <ul id="form" class="kt-portlet__head kt-portlet__head--break-sm py-4" style="border-bottom: none !important" >
                    <li class="row">
                        <?php
                            
                            foreach ($mod as $m) {
                        ?>
                        <div class="col-lg-4" id="<?php echo $m['modul'];?>">
                            <div class=" kt-portlet kt-iconbox">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__icon">
                                            <i class="fab fa-accessible-icon" style="font-size: 3.5rem !important;"></i>
                                        </div>
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link redirect" href="javascript:void(0)" data-page="<?= $m['url']?>" data-modul_id = "<?= $m['module_id']?>"><?php echo $m['modul']; ?></a>
                                            </h3>
                                            <div class="kt-iconbox__content">
                                                <?php echo $m['desc']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                    </li>
                </ul>
            </div>
        </div>  
        <form action="" method="post" id="form_excel" hidden="true">
            <div>
                <input type="text" id="modul_id" name="modul_id">
                <input type="text" id="page" name="page">
                <!-- <input type="text" id="url" name="url">
                <input type="text" id="jns_laporan" name="jns_laporan">
                <input type="text" id="rpt_type" name="rpt_type">
                <input type="text" id="rpt_period" name="rpt_period">
                <input type="text" id="start_date" name="start_date">
                <input type="text" id="end_date" name="end_date">
                <input type="text" id="month_period" name="month_period">
                <input type="text" id="year_period" name="year_period">
                <input type="text" id="year_period_text" name="year_period_text">
                <input type="text" id="file_cetak" name="file_cetak"> -->
            </div> 
        </form>
    <!-- end content -->

      <!-- begin:: Footer -->
        <div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer">
          <div class="kt-footer__bottom">
            <div class="kt-container ">
              <div class="kt-footer__wrapper">
                <div class="kt-footer__logo">
                  <a class="kt-header__brand-logo" href="?page=index&amp;demo=demo2">
                    <img alt="Logo" src="<?php echo base_url('assets/media/logos/logo-4-sm.png');?>" class="kt-header__brand-logo-sticky">
                  </a>
                  <div class="kt-footer__copyright">
                    2020&nbsp;©&nbsp;
                    <a class="footer-link" href="http://keenthemes.com/metronic" target="_blank">IDEAS - MERSI HOSPITAL</a>
                  </div>
                </div>
                <!-- <div class="kt-footer__menu">
                  <a href="http://keenthemes.com/metronic" target="_blank">Purchase Lisence</a>
                  <a href="http://keenthemes.com/metronic" target="_blank">Team</a>
                  <a href="http://keenthemes.com/metronic" target="_blank">Contact</a>
                </div> -->
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    </div>
    <script type="text/javascript" src="<?= base_url("assets/easyui/") ?>jquery.min.js"></script>
    <script type="text/javascript">
      $('.redirect').click(function () {
        $('#form_excel').attr('action', "<?= base_url() ?>dashboard/coba");
        var modul_id = $(this).data('modul_id');
        var page = $(this).data('page');
        $('#modul_id').val(modul_id);
        $('#page').val(page);
        if (page == '') {
          alert('Belum Ada Url');
          return false;
        }
        $('#form_excel').submit();
      })

        function enter() {
            $('#txt-search').keyup(function(event) {
              if(event.keyCode===13){
                $('#btn-cari').click();
              }
            });

            $('#btn-cari').click(function(event) {
                // alert("masuok aa");
            });
        }

        function checkInput() {
            var query = document.getElementById('txt-search').value;
            sembunyi(query.toUpperCase());
            window.find(query);
            return true;
        }

        function checkInput1(){
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("txt-search");
            filter = input.value.toUpperCase();
            ul = document.getElementById("form");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++){
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                }
                else{
                    li[i].style.display = "none";
                }
            }
        }

      function sembunyi(id){
        $('#ADMIN').hide();
        $('#AKRE').hide();
        $('#AKTIF').hide();
        $('#AKUN').hide();
        $('#AKUNC').hide();
        $('#ALKES').hide();
        $('#BIMROH').hide();
        $('#BPJS').hide();
        $('#BUDGET').hide();
        $('#EDP').hide();
        $('#EMR').hide();
        $('#FARMASI').hide();
        $('#FISIO').hide();
        $('#FO').hide();
        $('#GENERAL').hide();
        $('#GIZI').hide();
        $('#HD').hide();
        $('#HRD').hide();
        $('#INNOS').hide();
        $('#INSTANSI').hide();
        $('#INVENTARIS').hide();
        $('#JADWAL').hide();
        $('#KABER').hide();
        $('#KARYAWAN').hide();
        $('#KASIR').hide();
        $('#LAB').hide();
        $('#LAUNDRY').hide();
        $('#MR').hide();
        $('#NIFAS').hide();
        $('#OBAT').hide();
        $('#OK').hide();
        $('#PARKIR').hide();
        $('#PEMBELIAN').hide();
        $('#PERINA').hide();
        $('#POLI').hide();
        $('#RAD').hide();
        $('#RI').hide();
        $('#SUPERV').hide();
        $('#SURAT').hide();
        $('#TPP').hide();
        $('#UGD').hide();
        if(id!=""){
          var nyala='#'+id;
          $(nyala).show();
        }
        if(id==""){
          $('#ADMIN').show();
          $('#AKRE').show();
          $('#AKTIF').show();
          $('#AKUN').show();
          $('#AKUNC').show();
          $('#ALKES').show();
          $('#BIMROH').show();
          $('#BPJS').show();
          $('#BUDGET').show();
          $('#EDP').show();
          $('#EMR').show();
          $('#FARMASI').show();
          $('#FISIO').show();
          $('#FO').show();
          $('#GENERAL').show();
          $('#GIZI').show();
          $('#HD').show();
          $('#HRD').show();
          $('#INNOS').show();
          $('#INSTANSI').show();
          $('#INVENTARIS').show();
          $('#JADWAL').show();
          $('#KABER').show();
          $('#KARYAWAN').show();
          $('#KASIR').show();
          $('#LAB').show();
          $('#LAUNDRY').show();
          $('#MR').show();
          $('#NIFAS').show();
          $('#OBAT').show();
          $('#OK').show();
          $('#PARKIR').show();
          $('#PEMBELIAN').show();
          $('#PERINA').show();
          $('#POLI').show();
          $('#RAD').show();
          $('#RI').show();
          $('#SUPERV').show();
          $('#SURAT').show();
          $('#TPP').show();
          $('#UGD').show();
        }
      }
    </script>
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
   
   <!-- <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
   <!--begin::Global Theme Bundle(used by all pages) -->
   <script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js'); ?>" type="text/javascript"></script>
   <script src="<?php echo base_url('assets/js/scripts.bundle.js'); ?>" type="text/javascript"></script>

   <script type="text/javascript" src= "<?= base_url("assets/easyui/") ?>jquery.easyui.min.js"></script>

   <!--end::Global Theme Bundle -->

   <!--begin::Page Vendors(used by this page) -->
   <script src="<?php echo base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js'); ?>" type="text/javascript"></script>
   <script src="<?php echo base_url('assets/js/accounting.min.js'); ?>" type="text/javascript"></script>
   <!--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>-->
   <!--end::Page Vendors -->

   <script src='<?php echo base_url('assets/plugins/pdfMake/pdfmake.min.js'); ?>'></script>
   <script src='<?php echo base_url('assets/plugins/pdfMake/vfs_fonts.js'); ?>'></script>
   <script src='<?php echo base_url('assets/plugins/printJs/print.min.js'); ?>'></script>
   <!-- xlsx -->
   <!-- <script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script> -->
   <!--begin::Page Scripts(used by this page) -->
   <script src="<?php echo base_url('assets/js/custom.global.js'); ?>" type="text/javascript"></script>
   <script src="<?php echo base_url('assets/js/custom.tpp.js?'); ?>" type="text/javascript"></script>

   <?php
   if (isset($js)) {
    $this->load->view('js/' . $js);
   }
   ?>
   <!--end::Page Scripts -->
 </body>
</html>
