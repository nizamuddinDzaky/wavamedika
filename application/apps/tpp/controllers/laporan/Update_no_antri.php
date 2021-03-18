<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Update_no_antri extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Update No. Antri',
    'urlData'   => site_url() . 'tpp/laporan/update_no_antri/',
    'main_view' => 'laporan/v_update_no_antri',
    'js'        => 'laporan/js_update_no_antri',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function UpdateNomorAktif() {
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
  $Request = GetResponseApi("/tpp_antridokter/dataantridokter", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

 function UpdateAntrianView() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_gantinoantri/view_datanoantri", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

 function UpdateAntrian() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_gantinoantri/update", $this->req, "post");
  echo json_encode($Request);
 }

}
