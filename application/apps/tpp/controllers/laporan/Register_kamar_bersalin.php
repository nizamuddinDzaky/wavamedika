<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_kamar_bersalin extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Kamar Bersalin',
    'urlData'   => site_url() . 'tpp/laporan/register_kamar_bersalin/',
    'main_view' => 'laporan/v_register_kamar_bersalin',
    'js'        => 'laporan/js_register_kamar_bersalin',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterKamarBersalin() {
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
  $Request = GetResponseApi("/tpp_lapregkaber/view_lapregkaber", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

 function RegisterKamarBersalinRekap() {
  $this->req = $this->input->post();

  $Request = GetResponseApi("/tpp_lapregkaber/view_lapregkaber_rekap", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

}
