<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_poliklinik extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Poliklinik',
    'urlData'   => site_url() . 'tpp/laporan/register_poliklinik/',
    'main_view' => 'laporan/v_register_poliklinik',
    'js'        => 'laporan/js_register_poliklinik',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterPoliklinik() {
  $this->req = $this->input->post();
  if (!empty($this->req['rows'])) {
   $this->req['batas'] = $this->req['rows'];
  } else {
   $this->req['batas'] = 10;
  }

  if (!empty($this->req['page'])) {
   $this->req['halaman'] = $this->req['page'];
  } else {
   $this->req['halaman'] = 1;
  }
  $Request = GetResponseApi("/tpp_lapregpoli/view_lapregpoli", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

 function RegisterPoliklinikRekap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_lapregpoli/view_lapregpoli_rekap", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

}
