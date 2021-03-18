<!-- begin:: Header -->
<div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
  <div class="kt-container ">

    <!-- begin:: Brand -->
    <div class="kt-header__brand kt-grid__item" id="kt_header_brand">
      <a class="kt-header__brand-logo kt-menu__link" href="<?php echo base_url('Dashboard')?>">
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
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="<?php echo base_url('Dashboard')?>" class="kt-menu__link">
              <span class="kt-menu__link-text">Dashboard</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
          </li>

          <!-- hak akses -->
          <li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">Hak Akses</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
              <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('admin/role')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">Role</span>
                  </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                  <a href="<?php echo base_url('admin/user')?>" class="kt-menu__link ">
                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                      <span></span>
                    </i>
                    <span class="kt-menu__link-text">User</span>
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

      <!--begin: User bar -->
      <!--notif -->
      <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
          <span class="fa-stack fa-3x" style="margin-top: 10px">
              <span style="color: White;">
                <i class="fa fa-bell fa-stack-2x" style="font-size: 2.3rem;width: 145%"></i>
              </span>
                  <div style=" position: absolute;
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
                          " id="tot-prod">5
                  </div>
          </span> 
      </div>

      <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false">
          <span class="kt-header__topbar-username">Admin</span>
          <span class="kt-header__topbar-welcome">Online,</span>
          <span class="kt-header__topbar-icon"><b>A</b></span>
          <img alt="Pic" src="<?php echo base_url('assets/media/users/300_21.jpg');?>" class="kt-hidden">
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" style="">

          <!--begin: Head -->
          <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo base_url('assets/media/misc/bg-1.jpg');?>)">
            <div class="kt-user-card__avatar">
              <img class="kt-hidden" alt="Pic" src="<?php echo base_url('assets/media/users/300_25.jpg');?>">

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
            <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-mail kt-font-warning"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title kt-font-bold">
                  My Messages
                </div>
                <div class="kt-notification__item-time">
                  Inbox and tasks
                </div>
              </div>
            </a>
            <a href="custom/apps/user/profile-2.html" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-rocket-1 kt-font-danger"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title kt-font-bold">
                  My Activities
                </div>
                <div class="kt-notification__item-time">
                  Logs and notifications
                </div>
              </div>
            </a>
            <a href="custom/apps/user/profile-3.html" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-hourglass kt-font-brand"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title kt-font-bold">
                  My Tasks
                </div>
                <div class="kt-notification__item-time">
                  latest tasks and projects
                </div>
              </div>
            </a>
            <a href="custom/apps/user/profile-1/overview.html" class="kt-notification__item">
              <div class="kt-notification__item-icon">
                <i class="flaticon2-cardiogram kt-font-warning"></i>
              </div>
              <div class="kt-notification__item-details">
                <div class="kt-notification__item-title kt-font-bold">
                  Billing
                </div>
                <div class="kt-notification__item-time">
                  billing &amp; statements <span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill kt-badge--rounded">2 pending</span>
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

<!-- end:: Header