<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Voucher_parkir extends CI_Controller
{

  function index()
  {
    $data = [
      'title'     => 'Voucher Parkir',
      'urlData'   => site_url() . 'tpp/entry/voucher_parkir/',
      'main_view' => 'entry/v_voucher_parkir',
      'js'        => 'entry/voucher_parkir_js',
      'data1'     => '',
      'data2'     => '',
    ];
    $this->load->view('template_tpp', $data);
  }


  function ListVoucher()
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

    $Request = GetResponseApi("/tpp_datavoucher/datavoucher", $this->req, "get");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y", ["tgl_input" => "d/m/Y H:i"]);
    }
    echo json_encode($data);
  }

  function ListVoucherIsi()
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
    // $this->req["no_voucher"] = "P190000" ;
    $Request = GetResponseApi("/tpp_datavoucher/trvoucher", $this->req, "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y", ["tgl_input" => "d/m/Y H:i"]);
    }
    echo json_encode($data);
  }

  function CekNoVoucher()
  {
    $Request = GetResponseApi("/tpp_voucher/datavoucher", $this->input->post(), "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y", ["tanggal" => "d/m/Y"]);
    }
    echo json_encode($data);
  }

  function CekNoMrs()
  {
    $Request = GetResponseApi("/tpp_voucher/datamrs", $this->input->post(), "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y", ["tanggal" => "d/m/Y"]);
    }
    echo json_encode($data);
  }

  function SimpanInsert()
  {
    $Request = GetResponseApi("/tpp_voucher/insert", $this->input->post(), "post");
    echo json_encode($Request);
  }

  function SimpanReset()
  {
    $Request = GetResponseApi("/tpp_voucher/update", $this->input->post(), "post");
    echo json_encode($Request);
  }
}
