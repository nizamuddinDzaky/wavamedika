<!-- begin:: Header -->
<div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
  <div class="kt-container ">

    <!-- begin:: Brand -->
    <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
      <a class="kt-header__brand-logo" href="<?php echo base_url('Dashboard')?>">
        <img alt="Logo" src="<?php echo base_url('assets/media/logos/logo-4.png');?>" class="kt-header__brand-logo-default">
        <img alt="Logo" src="<?php echo base_url('assets/media/logos/logo-4-sm.png');?>" class="kt-header__brand-logo-sticky">
      </a>
    </div>

    <!-- end:: Brand -->

    <!-- begin: Header Menu -->
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
      <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
        <ul class="kt-menu__nav ">

          <!-- Dashboard -->
          <!-- <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="<?php echo base_url('Dashboard')?>" class="kt-menu__link">
              <span class="kt-menu__link-text">Dashboard</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('Welcome')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Example Dashboard</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('Welcome/pendaftaran')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pendaftaran</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('Welcome/panelSample')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Panel Sample</span>
                  </a>
                </li>
              </ul>
            </div>
          </li> -->

          <!-- master -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Master</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Data_pasien')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Data Pasien</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Dokter')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Dokter</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Jenis</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_kegiatan_khusus')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Kegiatan Khusus</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_diagnosa')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Diagnosa</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_persalinan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Persalinan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_pelayanan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Pelayanan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_rujukan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Rujukan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_gizi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Gizi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_metode_kb')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Metode KB</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_skm')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis SKM</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_formulir')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet-
                          -dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Formulir</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_darah')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Darah</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Perujuk')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Perujuk</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Unit_rs')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Unit RS</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Kamar')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Kamar</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Lokasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Lokasi</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Dokter_jpf')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Dokter JPF</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Diagnosa')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Diagnosa</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Imunisasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Imunisasi</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Infeksi_nosokomial')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Infeksi Nosokomial</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Obat')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Obat</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Tindakan_medis')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Tindakan Medis (ICD-9 CM)</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/master/Tindakan_lain')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Tindakan Lain (Kaber)</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Penunjang Medis</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_pemeriksaan_radiologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Pemeriksaan Radiologi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_pemeriksaan_laboratorium')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Pemeriksaan Laboratorium</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">EMR</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/master/Jenis_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis Alergi</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>

          <!-- register -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Register</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pendaftaran</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Mr_baru')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">MR Baru</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Register_pendaftaran')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Register Pendaftaran</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Ganti_no_rm')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Ganti No. RM</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Pasien_kontrol')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pasien Kontrol</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Pesanan_antri_poliklinik')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pesanan Antri Poliklinik</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Update_mrs')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Update MRS</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Rawat Jalan</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Ugd')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">UGD</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Poliklinik')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">PoliKlinik</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Kamar_bersalin')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kamar Bersalin</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Operasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Operasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Hemodialisa')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Hemodialisa</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Rawat Inap</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Perinatologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Perinatologi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Rawat_inap')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rawat Inap</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Penunjang</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Radiologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Radiologi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Laboratorium')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Laboratorium</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Fisioterapi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Fisioterapi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Konsultasi_gizi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Konsultasi Gizi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Kesehatan_khusus')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kesehatan Khusus</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Transfusi_darah')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Transfusi Darah</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pelepasan Informasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Resume_medis_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Resume Medis Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Skm_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">SKM Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Medical_checkup')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Medical Check Up</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pemberkasan</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Distribusi_berkas')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Distribusi Berkas</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Peminjaman_berkas')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Peminjaman Berkas</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Pengembalian_berkas')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pengembalian Berkas</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Kelengkapan_formulir')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kelengkapan Formulir</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Analisa Kuantitatif</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Kelengkapan_formulir')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kelengkapan Formulir</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/register/Analisa_kuantitatif')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Analisa Kuantitatif</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/register/Infeksi_nosokomial')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Infeksi Nosokomial</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/register/Imunisasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Imunisasi</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/register/Kb')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">KB</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/register/Input_pemusnahan_brm')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Input Pemusnahan BRM</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <!-- laporan -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Laporan</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/laporan/Pasien_mrs_aktif')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pasien MRS Aktif</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/laporan/Pasien_rawat_inap')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pasien Rawat Inap</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Kemenkes</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_perinatologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kegiatan Perinatologi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_pembedahan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kegiatan Pembedahan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_farmasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kegiatan Farmasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_poliklinik')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kegiatan Poliklinik</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_gizi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kegiatan Gizi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_radiologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kegiatan Radiologi</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Rekapitulasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Rekapitulasi_pelayanan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekapitulasi Pelayanan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Pasien_rawat_inap')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekapitulasi Unit</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kegiatan_perinatologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekapitulasi Per Poliklinik</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Indeks</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Distribusi_rm')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Distribusi RM</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Dokter')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Dokter</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Penyakit_icd')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penyakit (ICD)</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Tindakan_medis')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Tindakan Medis (ICD-9CM)</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kematian')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kematian</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Jpf')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">JPF</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Masuk_dan_keluar')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Masuk dan Keluar</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Kerjasama')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kerjasama</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Sebaran_daerah')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Sebaran Daerah</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Penyakit dan Tindakan</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Morbiditas_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Morbiditas_pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Diagnosa_terbesar')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Diagnosa Terbesar</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Tindakan_medis_terbesar')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Tindakan Medis Terbesar</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pemeriksaan</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Radiologi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Radiologi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Laboratorium')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Laboratorium</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Pemeriksaan_lab')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pemeriksaan Lab</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/laporan/Sensus_harian')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Sensus Harian</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/laporan/Sensus_harian')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Baber Johnson</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('mr/laporan/Kegiatan_dokter')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Kegiatan Dokter</span>
                  </a>
                </li>
            </div>
          </li>

          <!-- utilitas -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Utilitas</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <!-- <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Stok</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Mutasi_stok')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Mutasi Stok</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('mr/laporan/Koreksi_stok')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Koreksi Stok</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li> -->
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- end: Header Menu -->
    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar kt-grid__item">
      <!--begin: Notification Bar -->
<!--       <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
          <span class="kt-header__topbar-icon kt-pulse kt-pulse--warning">
            <i class="far fa-bell"></i>
            <div style="position: absolute;
              top: 1px;
              right: 0px;
              width: 20px;
              height: 20px;
              color: #fff;
              font-size: 12px;
              font-family: Arial;
              font-weight: bold;
              text-align: center;
              line-height: 0.4;
              padding: 8px 3px;
              background-color: #ed6b75;
              border-radius: 50%;
              " id="tot-prod">6
            </div>
          </span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-l">
          <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
            <span class="kt-font-bold" style="margin-left: 20px;">13 pending</span> notifications
            <a href="<?php echo base_url('farmasi/mailbox')?>" class="pull-right" style="margin-right: 20px;">view all</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-psd kt-font-success"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  New report has been received
                </div>
                <div class="kt-notification__item-time">
                  23 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon-download-1 kt-font-danger"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  You Have Approval Pending
                </div>
                <div class="kt-notification__item-time">
                  25 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-line-chart kt-font-success"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  New order has been received
                </div>
                <div class="kt-notification__item-time">
                  2 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-box-1 kt-font-brand"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  New customer is registered
                </div>
                <div class="kt-notification__item-time">
                  3 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-chart2 kt-font-danger"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  Data Retur has been approved
                </div>
                <div class="kt-notification__item-time">
                  3 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon-download-1 kt-font-danger"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  Finance report has been generated
                </div>
                <div class="kt-notification__item-time">
                  25 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-line-chart kt-font-success"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  New order has been received
                </div>
                <div class="kt-notification__item-time">
                  2 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-box-1 kt-font-brand"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  New customer is registered
                </div>
                <div class="kt-notification__item-time">
                  3 hrs ago
                </div>
              </div>
            </a>
            <a href="#" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-chart2 kt-font-danger"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title">
                  Application has been approved
                </div>
                <div class="kt-notification__item-time">
                  3 hrs ago
                </div>
              </div>
            </a>
          </div>
        </div>
      </div> -->
      <!--end: Notification Bar-->

      <!--begin: Message Bar -->
      <!-- <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
          <span class="kt-header__topbar-icon  kt-pulse kt-pulse--warning">
            <i class="far fa-envelope-open"></i>
            <div style="position: absolute;
              top: 1px;
              right: 0px;
              width: 20px;
              height: 20px;
              color: #fff;
              font-size: 12px;
              font-family: Arial;
              font-weight: bold;
              text-align: center;
              line-height: 0.4;
              padding: 8px 3px;
              background-color: #ed6b75;
              border-radius: 50%;
              " id="tot-message">
            </div>
          </span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-l">
          <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200" id="div-notif-message">
            <div style="margin-left: 20px;">You have
              <span class="kt-font-bold">7 New</span> Messages
              <a href="<?php echo base_url('farmasi/mailbox')?>" class="pull-right" style="margin-right: 20px;">view all</a>
            </div>
            <div class="dropdown-divider"></div>
          </div>
        </div>
      </div> -->
      <!--end: Message Bar-->

      <!--begin: Clipboard List Bar -->
      <!-- <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
          <span class="kt-header__topbar-icon  kt-pulse kt-pulse--warning">
            <i class="far fa-calendar-alt"></i>
            <div style="position: absolute;
              top: 1px;
              right: 0px;
              width: 20px;
              height: 20px;
              color: #fff;
              font-size: 12px;
              font-family: Arial;
              font-weight: bold;
              text-align: center;
              line-height: 0.4;
              padding: 8px 3px;
              background-color: #ed6b75;
              border-radius: 50%;
              " id="tot-notif">
            </div>
          </span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-l">
          <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200" id="div-notif-approval">
            <div style="margin-left: 20px;">You have
              <span class="kt-font-bold">13 pending</span> task
              <a href="<?php echo base_url('farmasi/mailbox')?>" class="pull-right" style="margin-right: 20px;">view all</a>
            </div>
            <div class="dropdown-divider"></div>
            
          </div>
        </div>
      </div> -->
      <!--end: Clipboard List Bar-->

      <!--begin: User bar -->
      <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
          <span class="kt-header__topbar-welcome">Hi,</span>
          <span class="kt-header__topbar-username">Sean</span>
          <img src="<?php echo base_url('assets/img/user0.jpg')?>" alt="User Avatar" class="img-size-50 mr-3 img-circle kt-font-success">
          <img alt="Pic" src="<?php echo base_url('assets/media/users/300_21.jpg');?>" class="kt-hidden">
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-l" style="">
          <!--begin: Head -->
          <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url('assets/media/misc/bg-1.jpg');?>)">
            <div class="kt-user-card__avatar">
              <img class="kt-hidden" alt="Pic" src="<?php echo base_url('assets/media/users/300_25.jpg');?>">
              <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
              <!-- <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span> -->
              <img src="<?php echo base_url('assets/img/user0.jpg')?>" alt="User Avatar" class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success img-size-50 mr-3 img-circle kt-font-success">
            </div>
            <div class="kt-user-card__name">
              Sean Stone
            </div>
            <!-- <div class="kt-user-card__badge">
              <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
            </div> -->
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
                  Profile
                </div>
                <div class="kt-notification__item-time">
                  Account settings and more
                </div>
              </div>
            </a>
            <a href="<?php echo base_url('farmasi/mailbox')?>" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-mail kt-font-warning"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title kt-font-bold">
                  Inbox
                </div>
                <div class="kt-notification__item-time">
                  Messages
                </div>
              </div>
            </a>
            <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-rocket-1 kt-font-danger"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title kt-font-bold">
                  Approval
                </div>
                <div class="kt-notification__item-time">
                  Task and Notifications
                </div>
              </div>
            </a>
            <div class="kt-notification__custom kt-space-between">
              <a href="<?php echo base_url('Login')?>" class="btn btn-label btn-label-brand btn-sm btn-bold">Logout</a>
              <!-- <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a> -->
            </div>
          </div>
          <!--end: Navigation -->
        </div>
      </div>
      <!--end: User bar -->

      <!--begin: Logout Bar-->
      <div class="kt-header__topbar-item">
        <div class="kt-header__topbar-wrapper" data-offset="10px,10px">
          <span class="kt-header__topbar-icon kt-pulse kt-pulse--warning">
            <a id="logout" href="<?php echo base_url('Login')?>">
              <i href="<?php echo base_url('Login')?>" class="flaticon-logout"></i>
            </a>
          </span>
        </div>
      </div>
      <!--end: Logout Bar-->
    </div>
    <!-- end:: Header Topbar -->
  </div>
</div>
<!-- end:: Header