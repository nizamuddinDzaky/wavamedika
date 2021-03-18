<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_update_mrs extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Update MRS',
    'urlData'   => site_url() . 'tpp/laporan/register_update_mrs/',
    'main_view' => 'laporan/v_register_update_mrs',
    'js'        => 'laporan/js_register_update_mrs',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterUpdateMrs() {
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
  $Request = GetResponseApi("/tpp_lapregupdatemrs/view_lapregupdatemrs", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

}
