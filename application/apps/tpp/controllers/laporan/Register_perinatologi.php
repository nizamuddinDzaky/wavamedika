<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_perinatologi extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Perinatologi',
    'urlData'   => site_url() . 'tpp/laporan/register_perinatologi/',
    'main_view' => 'laporan/v_register_perinatologi',
    'js'        => 'laporan/js_register_perinatologi',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterPerinatologi() {
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
  $Request = GetResponseApi("/tpp_lapregperina/view_lapregperina", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

 function RegisterPerinatologiRekap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_lapregperina/view_lapregperina_rekap", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

}
