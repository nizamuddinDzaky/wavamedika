<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_ugd extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register UGD',
    'urlData'   => site_url() . 'tpp/laporan/register_ugd/',
    'main_view' => 'laporan/v_register_ugd',
    'js'        => 'laporan/js_register_ugd',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterUgd() {
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
  $Request = GetResponseApi("/tpp_lapregugd/view_lapregugd", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

 function RegisterUgdRekap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_lapregugd/view_lapregugd_rekap", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

}
