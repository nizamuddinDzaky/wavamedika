<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_rencana_pulang extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Pasien Rencana Pulang',
    'urlData'   => site_url() . 'tpp/laporan/pasien_rencana_pulang/',
    'main_view' => 'laporan/v_pasien_rencana_pulang',
    'js'        => 'laporan/js_pasien_rencana_pulang',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function PasienRencanaPulang() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_rencanapulang/view_datarencanapulang", $this->req, "get");
  $data      = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

}
