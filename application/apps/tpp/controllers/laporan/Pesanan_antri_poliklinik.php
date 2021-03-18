<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_antri_poliklinik extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Pesanan Antri Poliklinik',
    'urlData'   => site_url() . 'tpp/laporan/pesanan_antri_poliklinik/',
    'main_view' => 'laporan/v_pesanan_antri_poliklinik',
    'js'        => 'laporan/js_pesanan_antri_poliklinik',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function proses_mrs() {
  $data = [
    'title'     => 'Proses MRS',
    'urlData'   => site_url() . 'tpp/laporan/pesanan_antri_poliklinik/',
    'main_view' => 'laporan/v_pesanan_antri_poliklinik_proses_mrs',
    'js'        => 'laporan/js_pesanan_antri_poliklinik_proses_mrs',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function PesanAntriPoli() {
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
  $Request = GetResponseApi("/tpp_lapregantripoli/view_lapregantripoli", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

}
