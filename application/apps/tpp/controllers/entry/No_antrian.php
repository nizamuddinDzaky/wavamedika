<?php

defined('BASEPATH') or exit('No direct script access allowed');

class No_antrian extends CI_Controller
{

  function index()
  {
    $data = [
      'title'     => 'No. Antrian',
      'urlData'   => site_url() . 'tpp/entry/no_antrian/',
      'main_view' => 'entry/v_no_antrian',
      'js'        => 'entry/no_antrian_js',
      'data1'     => '',
      'data2'     => '',
    ];
    $this->load->view('template_tpp', $data);
  }
  function DataAntriDaftar()
  {
    $Request = GetResponseApi("/tpp_antridaftar/dataantridaftar", $this->input->post(), "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y", ["tanggal" => "d/m/Y"]);
    }
    echo json_encode($data);
  }

  function ComboboxLoket()
  {
    $Request = GetResponseApi("/tpp_antridaftar/loket", $this->input->post(), "get");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y");
    }
    echo json_encode($data["rows"]);
  }

  function AntriAktif()
  {
    $Request = GetResponseApi("/tpp_antridaftar/antriaktif", $this->input->post(), "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y");
    }
    echo json_encode($data);
  }

  function UpdateCall()
  {
    $Request = GetResponseApi("/tpp_antridaftar/update_call", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function UpdateSkip()
  {
    $Request = GetResponseApi("/tpp_antridaftar/update_skip", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function UpdateRegister()
  {
    $Request = GetResponseApi("/tpp_antridaftar/update_register", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function UpdateInaktif()
  {
    $Request = GetResponseApi("/tpp_antridaftar/update_inaktif", $this->input->post(), "post");
    echo json_encode($Request);
  }
}
