<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_operasi extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Operasi',
    'urlData'   => site_url() . 'tpp/laporan/register_operasi/',
    'main_view' => 'laporan/v_register_operasi',
    'js'        => 'laporan/js_register_operasi',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterOperasi() {
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
  $Request = GetResponseApi("/tpp_lapregoperasi/view_lapregoperasi", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

 function RegisterOperasiRekap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_lapregoperasi/view_lapregoperasi_rekap", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

}
