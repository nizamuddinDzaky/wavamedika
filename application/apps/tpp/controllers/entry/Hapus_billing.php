<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hapus_billing extends CI_Controller
{

  function index()
  {
    $data = [
      'title'     => 'Hapus Billing',
      'urlData'   => site_url() . 'tpp/entry/hapus_billing/',
      'main_view' => 'entry/v_hapus_billing',
      'js'        => 'entry/hapus_billing_js',
      'data1'     => '',
      'data2'     => '',
    ];
    $this->load->view('template_tpp', $data);
  }

  function DataMrs()
  {

    if (!$this->input->is_ajax_request()) return;
    $Request = GetResponseApi("/tpp_hapusmrs/datamrs", $this->input->post(), "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i", ["tanggal" => "d/m/Y"]);
    }
    echo json_encode($data);
  }

  function ComboUnit()
  {
    if (!$this->input->is_ajax_request()) return;
    $Request = GetResponseApi("/tpp_hapusmrs/jnskaryawan", $this->input->post(), "get");
    $Result['status'] = $Request->metadata;
    $Result['lsdt']     = "<option value=''>Pilih Unit</option>";
    foreach ($Request->list as $key => $value) {
      $Result['lsdt']  .= "<option value='$value->id_jnskaryawan' >" . $value->kategori . "</option>";
    }
    echo json_encode($Result);
  }

  function ComboKaryawan()
  {
    if (!$this->input->is_ajax_request()) return;
    $Request = GetResponseApi("/tpp_hapusmrs/karyawan", $this->input->post(), "post");
    $Result['status'] = $Request->metadata;
    $Result['lsdt']     = "<option value=''>Pilih Dokter</option>";
    foreach ($Request->list as $key => $value) {
      $Result['lsdt']  .= "<option value='$value->id_karyawan' >" . $value->nama . "</option>";
    }
    echo json_encode($Result);
  }

  function HapusMrs()
  {
    if (!$this->input->is_ajax_request()) return;
    $Request = GetResponseApi("/tpp_hapusmrs/delete", $this->input->post(), "post");
    echo json_encode($Request);
  }
}
