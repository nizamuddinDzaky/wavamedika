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
          <?php
            foreach ($navbar as $key => $nav) {
              echo '<li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                      <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-text">'.$nav['title'].'</span>
                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                      </a>
                    </li>';
            }
          ?>

          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Master</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/Item_farmasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Barang Farmasi</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/Barang_paket')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Barang Paket</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/Barang_general')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Barang General</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Tenaga Medis</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/dokter')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Dokter</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/spesialisasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Spesialisasi</span>
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
                    <span class="kt-menu__link-text">Farmasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/distributor_farmasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Distributor Farmasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/item_farmasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Item Farmasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/item_paket')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Item Paket</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/satuan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Satuan</span>
                        </a>
                      </li>                      
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/supplier')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Supplier</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/Lokasi_rak')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Lokasi Rak</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/Produsen')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Produsen</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Klasifikasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/golongan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Golongan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/jenis')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Jenis</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/kategori')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kategori</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/kelas_terapi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kelas Terapi</span>
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
                    <span class="kt-menu__link-text">Tarif</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/harga_jual')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Harga Jual</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/potongan_biaya')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Potongan & Biaya</span>
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
                    <span class="kt-menu__link-text">Lokasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/lokasi_farmasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Depo</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/master/poliklinik')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Poliklinik</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/harga_jual')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Harga Jual</span>
                  </a>
                </li>
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo site_url('master/Dokter')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Dokter</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo site_url('master/Distributor_farmasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Distributor Farmasi</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo site_url('master/Item_farmasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Item Farmasi</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo site_url('master/Item_paket')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Item Paket</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo site_url('master/Satuan')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Satuan</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo site_url('master/Lokasi_farmasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Lokasi Farmasi</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/harga_jual')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Harga Jual</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/potongan_biaya')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Potongan & Biaya</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/spesialisasi')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Spesialisasi</span>
                  </a>
                </li> -->
                <!-- <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/master/poliklinik')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Poliklinik</span>
                  </a>
                </li> -->
              </ul>
            </div>
          </li>

          <!-- Gudang Farmasi -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Gudang Farmasi</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pembelian Farmasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Permintaan_pembelian')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Permintaan Pembelian [PP]</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Permintaan_pembelian_rop')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Permintaan Pembelian [ROP]</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Order_pembelian')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Order Pembelian [PO]</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/penerimaan_barang')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penerimaan Barang PO</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/penerimaan_barang_donasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penerimaan Barang Donasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Pembelian_tunai')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pembelian Tunai</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Pembelian_general')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pembelian General</span>
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
                    <span class="kt-menu__link-text">Retur Pembelian Farmasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Depo_retur')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Retur Barang ED</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/retur_pembelian')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Retur Supplier</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Pengganti_retur')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pengganti Retur</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/nomor_batch')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pencarian Nomor Batch</span>
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
                    <span class="kt-menu__link-text">Mutasi Barang Farmasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Permintaan_mutasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Permintaan Mutasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Permintaan_mutasi_rop')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Permintaan Mutasi ROP</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Permintaan_bmhp')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Permintaan BMHP</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Mutasi_barang')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Mutasi Barang</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Retur_mutasi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Retur Mutasi</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Retur_barang_ed')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Retur Barang ED</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/gudang/Stok_opname')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Stok Opname</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/gudang/input_stok_opname')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Input Stok Opname</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Kartu Persediaan Farmasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Stok_awal')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Stok Awal</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Kartu_stok')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kartu Stok</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Stok_tetap_ruangan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Stok Tetap Ruangan</span>
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
                    <span class="kt-menu__link-text">Kartu Stok</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Kartu_stok')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kartu Stok</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Kartu_stok_nominal')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Kartu Stok Nominal</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/gudang/Stok_tetap_ruangan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Stok Tetap Ruangan</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/gudang/posting_control')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Posting Control</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Laporan</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
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
                              <a href="<?php echo base_url('farmasi/gudang/Lap_mutasi_barang')?>" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Mutasi Barang</span>
                              </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                              <a href="<?php echo base_url('farmasi/gudang/Lap_koreksi_stok')?>" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Koreksi Stok</span>
                              </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                              <a href="<?php echo base_url('farmasi/gudang/Lap_fast_moving')?>" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Barang Fast Moving</span>
                              </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                              <a href="<?php echo base_url('farmasi/gudang/Lap_persediaan')?>" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Nilai Persediaan</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                      <li class="kt-menu__item kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pembelian</span>
                          <i class="kt-menu__hor-arrow la la-angle-right"></i>
                          <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                          <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true">
                              <a href="<?php echo base_url('farmasi/gudang/Lap_pembelian_farmasi')?>" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Pembelian Farmasi</span>
                              </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                              <a href="custom/apps/user/profile-1/personal-information.html" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Retur Pembelian Farmasi</span>
                              </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                              <a href="<?php echo base_url('farmasi/gudang/Lap_pembelian_non_formularium')?>" class="kt-menu__link ">
                                <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                                  <span></span>
                                </i>
                                <span class="kt-menu__link-text">Pembelian Non Formularium</span>
                              </a>
                            </li>
                          </ul>
                        </div>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>

          <!-- Depo Farmasi -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Depo Farmasi</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/depo/Registrasi_pasien')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Registrasi Pasien</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pelayanan Farmasi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo_farmasi/Registrasi_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Registrasi Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Nota_farmasi_rawat_jalan')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Nota Farmasi Rawat Jalan</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Penjualan_obat_bebas')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penjualan Obat Bebas</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Penyerahan_obat')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penyerahan Obat</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Bon_pemakaian_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Bon Pemakaian Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Retur_pemakaian_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Retur Pemakaian Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo_farmasi/Pemakaian_oksigen')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pemakaian Oksigen</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo_farmasi/Pemakaian_nitrogen')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pemakaian Nitrogen</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo_farmasi/import_obat_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Import Obat Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/pemakaian_depo')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pemakaian Depo</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/depo/Pemakaian_gas_medik')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Pemakaian Gas Medik</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Apotik</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo_farmasi/Penjualan_obat_bebas')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penjualan Obat Bebas</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Pemakaian_depo')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pemakaian Depo</span>
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
                    <span class="kt-menu__link-text">Farmasi Produksi</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo_farmasi/Pencampuran_obat_injeksi')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pencampuran Obat Injeksi</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/depo/Kartu_stok')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Kartu Stok</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/depo/posting_control')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Posting Control</span>
                  </a>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true">
                  <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Laporan</span>
                    <i class="kt-menu__hor-arrow la la-angle-right"></i>
                    <i class="kt-menu__ver-arrow la la-angle-right"></i>
                  </a>
                  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Lap_rekap_bon_pasien')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekap Bon Pasien</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Lap_rekap_bon_pasien_per_unit')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekap Bon Pasien Per Unit</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Lap_pemakaian_oksigen')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekap Pemakaian Oksigen</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Lap_rekap_pemakaian_nitrogen')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Rekap Pemakaian Nitrogen</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Lap_penjualan_depo')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Penjualan Depo</span>
                        </a>
                      </li>
                      <li class="kt-menu__item " aria-haspopup="true">
                        <a href="<?php echo base_url('farmasi/depo/Lap_pemakaian_depo')?>" class="kt-menu__link ">
                          <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                            <span></span>
                          </i>
                          <span class="kt-menu__link-text">Pemakaian Depo</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('farmasi/depo/Index_pasien_mrs')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Index Pasien MRS</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <!-- Utilitas -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Utilitas</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <!-- <a href="" class="kt-menu__link " onclick="buka_konfigurasi()"> -->
                  <a href="<?php echo base_url('farmasi/utilitas/Konfigurasi_farmasi')?>" class="kt-menu__link">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Konfigurasi</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="#" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Kode Transaksi</span>
                  </a>
                </li>
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
      <div class="kt-header__topbar-item dropdown">
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
            <!--  -->
          </div>
        </div>
      </div>
      <!--end: Message Bar-->

      <!--begin: Clipboard List Bar -->
      <div class="kt-header__topbar-item dropdown">
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
            <!--  -->
          </div>
        </div>
      </div>
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