<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_baru extends CI_Controller
{

  function index()
  {
    $data = [
      'title'     => 'Pasien Baru',
      'urlData'   => site_url() . 'tpp/entry/module/ajax',
      'main_view' => 'entry/v_pasien_baru',
      'js'        => 'entry/pasien_baru_js',
      'data1'     => '',
      'data2'     => '',
    ];
    $this->load->view('template_tpp', $data);
  }

  function DetailIbu()
  {
    $Request = GetResponseApi("/tpp_mr/view_dataibu", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function InsertPasien()
  {
    $this->req = $this->input->post();
    if (empty($this->req['suku_lain'])) {
      $this->req['suku_lain'] = "";
    }
    if (empty($this->req['id_jnskegiatankhusus'])) {
      $this->req['id_jnskegiatankhusus'] = "";
    }
    if (empty($this->req['lengkap'])) {
      $this->req['lengkap'] = "";
    }
    $this->req = $this->ChangeDate($this->req);

    $Request = GetResponseApi("/tpp_mr/insert", $this->req, "post");
    echo json_encode($Request);
  }

  private function ChangeDate($data = [])
  {
    foreach ($data as $key => $val) {
      if (preg_match("/(tgl)/", $key) && !empty($val)) {
        $date = explode("/", $data[$key]);
        $data[$key] = $date["2"] . "-" . $date["1"] . "-" . $date["0"];;
      }
    }
    return $data;
  }
}
