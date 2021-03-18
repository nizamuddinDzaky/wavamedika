<?php
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
$uri3 = $this->uri->segment(3);
$uri4 = $this->uri->segment(4);
$uri5 = $this->uri->segment(5);
?>

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
   <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
    <ul class="kt-menu__nav ">
     <li class="kt-menu__item kt-menu__item--<?= $uri2 == "master" ? "open" : "" ?> kt-menu__item--submenu kt-menu__item--rel "
         data-ktmenu-submenu-toggle="click"
         aria-haspopup="true">
      <a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Master</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
      <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
       <ul class="kt-menu__subnav">
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/master/data_pasien') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Data Pasien</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/master/lokasi') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Lokasi</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/master/tarif_ambulance') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tarif Ambulance</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/master/nomor_kosong') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Nomor Kosong</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/master/golongan') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Golongan</span></a></li>
       </ul>
      </div>
     </li>
     <li class="kt-menu__item kt-menu__item--<?= $uri2 == "entry" ? "open" : "" ?> kt-menu__item--submenu kt-menu__item--rel"
         data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Entry</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
      <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
       <ul class="kt-menu__subnav">
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/entry/pasien_baru') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pasien Baru</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/entry/pasien_mrs') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pasien MRS</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/entry/no_antrian') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">No. Antrian</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/entry/voucher_parkir') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Voucher Parkir</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/entry/hapus_billing') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Hapus Billing (MRS)</span></a></li>
       </ul>
      </div>
     </li>
     <li class="kt-menu__item  kt-menu__item--<?= $uri2 == "laporan" ? "open" : "" ?> kt-menu__item--submenu kt-menu__item--rel"
         data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">Laporan</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
      <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
       <ul class="kt-menu__subnav">
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/mrs_aktif') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Pasien MRS Aktif</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/list_kamar_kosong') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">List Kamar Kosong</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/update_no_antri') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Update No. Antri</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_pendaftaran') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Pendaftaran</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/pesanan_antri_poliklinik') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pesanan Antri Poliklinik</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/pesanan_antri_kamar') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pesanan Antri Kamar</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_ugd') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register UGD</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_poliklinik') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Poliklinik</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_kamar_bersalin') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Kamar Bersalin</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_perinatologi') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Perinatologi</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_operasi') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Operasi</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_update_mrs') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Update MRS</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/register_ganti_norm') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Register Ganti No. RM</span></a></li>
        <li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url('tpp/laporan/pasien_rawat_inap') ?>" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Pasien Rawat Inap</span></a></li>
       </ul>
      </div>
     </li>


    </ul>
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