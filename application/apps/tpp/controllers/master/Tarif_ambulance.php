<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tarif_ambulance extends CI_Controller
{

  function index()
  {
    $data = [
      'title'     => 'Tarif Ambulance',
      'urlData'   => site_url() . 'tpp/master/tarif_ambulance/',
      'main_view' => 'master/v_tarif_ambulance',
      'js'        => 'master/js_tarif_ambulance',
      'data1'     => '',
      'data2'     => '',
    ];
    $this->load->view('template_tpp', $data);
  }
  function ListTarif()
  {
    $this->req = $this->input->post();
    if (!$this->req['rows']) {
      $this->req['batas'] = $this->req['rows'];
    } else {
      $this->req['batas'] = 10;
    }

    if (!$this->req['page']) {
      $this->req['halaman'] = $this->req['page'];
    } else {
      $this->req['halaman'] = 1;
    }
    $Request = GetResponseApi("/tpp_ambulance/datatarifambulance", $this->req, "post");
    $data = SetPagination($Request->list, $Request->metadata);
    echo json_encode($data);
  }

  function Tarif()
  {
    $this->req = $this->input->post();
    $Request = GetResponseApi("/tpp_ambulance/tarif", $this->req, "post");
    // $data = SetPagination($Request->list, $Request->metadata);
    echo json_encode($Request);
  }
}
