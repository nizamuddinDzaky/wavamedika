<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tpp extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Dashboard TPP',
    'main_view' => 'v_tpp',
  ];
  $this->load->view('template_tpp', $data);
 }

}
