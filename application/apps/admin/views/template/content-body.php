<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
  <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
      <?php if(!empty($main_view)) {$this->load->view('main/'.$main_view);} ?>
      <iframe id="printPdf" name="printPdf" hidden="true"></iframe>
  </div>
</div>