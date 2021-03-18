<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Golongan extends CI_Controller {

  function index() {
    $data = [
        'title'     => 'Golongan Pasien',
        'urlData'   => site_url() . 'tpp/master/golongan/',
        'main_view' => 'master/v_golongan',
        'js'        => 'master/js_golongan',
        'data1'     => '',
        'data2'     => '',
    ];
    $this->load->view('template_tpp', $data);
  }

  function ListGolongan() {
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

    $Request = GetResponseApi("/tpp_golonganpx/datagolonganpx", $this->req, "get");
    $data    = SetPagination($Request->list, $Request->metadata);
    echo json_encode($data);
  }

  function getGolongan() {
    $Request = GetResponseApi("/tpp_golonganpx/datagolonganpx",
            $this->input->post('data'), "get");
    $data    = SetPagination($Request->list, $Request->metadata);
    echo json_encode($data);
  }

  function UpdateGolongan() {
    $this->req = $this->input->post();
    $Request   = GetResponseApi("/tpp_golonganpx/update", $this->req, "post");
    echo json_encode($Request);
  }

  function DeleteGolongan() {
    $this->req = $this->input->post();
    $Request   = GetResponseApi("/tpp_golonganpx/delete", $this->req, "post");
    echo json_encode($Request);
  }

  function addGolongan() {
    $this->req = $this->input->post();
    $Request   = GetResponseApi("/tpp_golonganpx/insert", $this->req, "post");
    echo json_encode($Request);
  }

}
