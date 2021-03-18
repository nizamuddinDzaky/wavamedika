<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{

  function index()
  {
    $data = [
      'title'         => 'Lokasi',
      'urlData'       => site_url() . 'tpp/master/lokasi/',
      'main_view'     => 'master/v_lokasi',
      'js'            => 'master/js_lokasi',
      'fieldData'     => [
        "id_lokasi" => "ID",
        "propinsi"  => "Propinsi",
        "kabupaten" => "Kabupaten",
        "kecamatan" => "Kecamatan",
        "kelurahan" => "Kelurahan",
        "kode_pos"  => "Kode Pos"
      ],
      'dataPropinsi'  =>   $this->getDataPropinsi(),
      'dataKabupaten' => '', //$this->getDataKabupaten(),
      'dataKecamatan' => '' //$this->getDataKecamatan(),
    ];
    $this->load->view('template_tpp', $data);
  }

  function ListLokasi()
  {
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
    $Request = GetResponseApi("/tpp_lokasi/datalokasi", $this->req, "post");
    $data    = SetPagination($Request->list, $Request->metadata);
    echo json_encode($data);
  }

  function UpdateLokasi()
  {
    $Request = GetResponseApi("/tpp_lokasi/update", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function DeleteLokasi()
  {
    $Request = GetResponseApi("/tpp_lokasi/delete", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function AddLokasi()
  {
    $Request = GetResponseApi("/tpp_lokasi/insert", $this->input->post(), "post");
    echo json_encode($Request);
  }

  private function getDataPropinsi($type = "")
  {
    $Request = GetResponseApi("/tpp_mr/propinsipx", [], "get");
    $data    = "<option selected hidden value=''>-- Propinsi</option>";
    foreach ($Request->list as $key => $v) {
      $data .= "<option value='" . $v->propinsi . "'>" . $v->propinsi . "</option>";
    }
    return $data;
  }

  private function getDataKabupaten($type = "")
  {
    $Request = GetResponseApi("/tpp_datapasien/kabupatenpx", [], "get");
    $data    = "<option selected hidden value='0'>-- Kabupaten</option>";
    foreach ($Request->list as $key => $v) {
      $data .= "<option value='" . $v->k1 . "'>" . $v->k1 . "</option>";
    }
    return $data;
  }

  private function getDataKecamatan($type = "")
  {
    $Request = GetResponseApi("/tpp_datapasien/kecamatanpx", [], "get");
    $data    = "<option selected hidden value='0'>-- Kecamatan</option>";
    foreach ($Request->list as $key => $v) {
      $data .= "<option value='" . $v->k1 . "'>" . $v->k1 . "</option>";
    }
    return $data;
  }
}
