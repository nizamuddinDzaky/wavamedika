<?php

defined('BASEPATH') or exit('No direct script access allowed');

class List_kamar_kosong extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'List Kamar Kosong',
    'urlData'   => site_url() . 'tpp/laporan/list_kamar_kosong/',
    'main_view' => 'laporan/v_list_kamar_kosong',
    'js'        => 'laporan/js_list_kamar_kosong',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function ListKamarKosong() {
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
  $Request = GetResponseApi("/tpp_kamarkosong/datakamarkosong", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

}
