<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_rawat_inap extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Pasien Rawat Inap',
    'urlData'   => site_url() . 'tpp/laporan/pasien_rawat_inap/',
    'main_view' => 'laporan/v_pasien_rawat_inap',
    'js'        => 'laporan/js_pasien_rawat_inap',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function PasienRawatInap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_lapmrsri/view_lapmrsri", $this->req, "get");
  $data      = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

}
