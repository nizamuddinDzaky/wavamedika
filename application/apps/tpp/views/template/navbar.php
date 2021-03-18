<?php
$uri1    = $this->uri->segment(1);
$uri2    = $this->uri->segment(2);
$uri3    = $this->uri->segment(3);
$uri4    = $this->uri->segment(4);
$uri5    = $this->uri->segment(5);
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

          <!-- Dashboard -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="<?php echo site_url('dashboard') ?>" class="kt-menu__link">
              <span class="kt-menu__link-text">Dashboard</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>

            <?php
            $modul   = "tpp/";
            $arrMenu = [
              'master'  => [
                'Data Pasien'     => site_url() . $modul . 'master/data_pasien',
                'Lokasi'          => site_url() . $modul . 'master/lokasi',
                'Tarif Ambulance' => site_url() . $modul . 'master/tarif_ambulance',
                'Nomor Kosong'    => site_url() . $modul . 'master/nomor_kosong',
                'Golongan'        => site_url() . $modul . 'master/golongan',
              ],
              'entry'   => [
                'Pasien Baru'        => site_url() . $modul . 'entry/pasien_baru',
                'Pasien MRS'         => site_url() . $modul . 'entry/pasien_mrs',
                'No. Antrian'        => site_url() . $modul . 'entry/no_antrian',
                'Voucher Parkir'     => site_url() . $modul . 'entry/voucher_parkir',
                'Hapus Biling (MRS)' => site_url() . $modul . 'entry/hapus_billing',
              ],
              'laporan' => [
                'List Pasien MRS Aktif'    => site_url() . $modul . 'laporan/mrs_aktif',
                'List Kamar Kosong'        => site_url() . $modul . 'laporan/list_kamar_kosong',
                'Update No. Antri'         => site_url() . $modul . 'laporan/update_no_antri',
                'Register Pendaftaran'     => site_url() . $modul . 'laporan/register_pendaftaran',
                'Pesanan Antri Poliklinik' => site_url() . $modul . 'laporan/pesanan_antri_poliklinik',
                'Pesanan Antri Kamar'      => site_url() . $modul . 'laporan/pesanan_antri_kamar',
                'Register UGD'             => site_url() . $modul . 'laporan/register_ugd',
                'Register Poliklinik'      => site_url() . $modul . 'laporan/register_poliklinik',
                'Register Kamar Bersalin'  => site_url() . $modul . 'laporan/register_kamar_bersalin',
                'Register Perinatologi'    => site_url() . $modul . 'laporan/register_perinatologi',
                'Register Operasi'         => site_url() . $modul . 'laporan/register_operasi',
                'Register Update MRS'      => site_url() . $modul . 'laporan/register_update_mrs',
                'Register Ganti No. RM'    => site_url() . $modul . 'laporan/register_ganti_no_rm',
                'Pasien Rawat Inap'        => site_url() . $modul . 'laporan/pasien_rawat_inap',
              ],
            ];
            foreach ($arrMenu as $key => $val) {
              $open = $uri2 == $key ? "kt-menu__item--open" : "";
            ?>
          <li class="<?= $open ?> kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text"><?php echo ucfirst($key) ?></span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <?php foreach ($val as $k => $v) { ?>
                  <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo $v ?>" class="kt-menu__link ">
                      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                        <span></span>
                      </i>
                      <span class="kt-menu__link-text"><?php echo $k ?></span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>

    <!-- end: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar kt-grid__item">

      <!--begin: User bar -->
      <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
          <span class="fa-stack fa-3x" style="margin-top: 10px">
            <span style="color: White;">
              <i class="fa fa-envelope fa-stack-2x" style="font-size: 2.3rem;width: 145%"></i>
            </span>
            <div style="position: absolute;
                 top: -1px;
                 right: 6px;
                 width: 17px;
                 height: 10px;
                 color: #fff;
                 font-size: 11px;
                 font-family: Arial;
                 font-weight: bold;
                 text-align: center;
                 line-height: 0;
                 padding: 8px 3px;
                 /*background-color: #da3225;*/
                 /*background-color: blue;*/
                 background-color: #7367f0;
                 border-radius: 50%;
                 /*box-shadow: 0 0 0 2px #32333b;*/
                 " id="tot-prod">3</div>
          </span>

          <!--test -->

        </div>
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
          <span class="kt-header__topbar-username">Admin</span>
          <span class="kt-header__topbar-welcome">Online,</span>
          <span class="kt-header__topbar-icon"><b>A</b></span>
          <img alt="Pic" src="<?php echo base_url('assets/media/users/300_21.jpg'); ?>" class="kt-hidden">
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" style="">

          <!--end: Head -->

          <!--begin: Navigation -->
          <div class="kt-notification">
            <a href="#" class="kt-notification__item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url('assets/img/user0.jpg') ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <a href="#" class="kt-notification__item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url('assets/img/user1.jpg') ?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <a href="#" class="kt-notification__item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url('assets/img/user2.jpg') ?>" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('tpp/mailbox') ?>" style="text-align: center;" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>

          <!--end: Navigation -->
        </div>
      </div>
      <!--end: User bar -->
    </div>

    <!-- end:: Header Topbar -->
  </div>
</div>

<!-- end:: Header