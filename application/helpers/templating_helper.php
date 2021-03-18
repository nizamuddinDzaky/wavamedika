<?php

function bodyStart() {
 $CI = &get_instance();
 $html = '
    <body style="background-image: url("' . base_url('assets/media/demos/demo4/header.jpg') . '");
      background-position: center top; background-size: 100% 350px;"
      class="kt-page--loading-enabled kt-page--loading kt-page--fluid kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">
       ' . $CI->load->view('template/header_mobile') . '
    <div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
         ' . $CI->load->view('template/navbar/tpp') . '
        <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
          <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
            ' . $CI->load->view('template/subheader');
 return $html;
}

function bodyEnd() {
 $CI = &get_instance();
 $html = '
    <iframe id="printPdf" name="printPdf" hidden="true"></iframe>
    </div>
    </div>
    ' . $CI->load->view('template/footer') . '
    </div>
    </div>
    </div>
    ';
 return $html;
}
