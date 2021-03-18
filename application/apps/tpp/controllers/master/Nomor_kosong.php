<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nomor_kosong extends CI_Controller {

 function index() {
  $data = [
    'title'      => 'Nomor Kosong',
    'urlData'    => site_url() . 'tpp/master/nomor_kosong/',
    'main_view'  => 'master/v_nomor_kosong',
    'js'         => 'master/js_nomor_kosong',
    'fieldData'  => [
      'dokter' => 'Dokter',
      'antri'  => 'Antrian',
    ],
    'dataDokter' => $this->getDokter(),
    'data2'      => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 private function getDokter() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_nomorkosong/dokter", $this->req, "get");
  array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  return json_encode($Request->list);
  $data      = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kelurahan . "'>" . $value->kelurahan . "</option>";
  }
  echo $data;
 }

 function ListNoKosong() {
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
  $Request = GetResponseApi("/tpp_nomorkosong/datanomorkosong", $this->req, "get");
  $data    = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

 function UpdateNoKosong() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_nomorkosong/update", $this->req, "post");
  echo json_encode($Request);
 }

 function DeleteNoKosong() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_nomorkosong/delete", $this->req, "post");
  echo json_encode($Request);
 }

 function AddNoKosong() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_nomorkosong/insert", $this->req, "post");
  echo json_encode($Request);
 }

}
