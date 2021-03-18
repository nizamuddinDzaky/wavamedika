<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_pendaftaran extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Pendaftaran',
    'urlData'   => site_url() . 'tpp/laporan/register_pendaftaran/',
    'main_view' => 'laporan/v_register_pendaftaran',
    'js'        => 'laporan/js_register_pendaftaran',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterPendaftaran() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_indeksmrs/view_indeksmrs", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y", ["jam_mrs" => "H:i", "jam_krs" => "H:i"]);
  }
  echo json_encode($data);
 }

 function RegisterPendaftaranRekap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_indeksmrs/view_indeksmrs_rekap", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

}
