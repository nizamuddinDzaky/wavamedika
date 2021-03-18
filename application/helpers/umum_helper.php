<?php

function debug($data) {
  echo "<pre>";
  print_r($data);
  echo "</pre>";
  exit;
}

function GetResponseApi($url, $parameter, $method = "post") {
  $CI = &get_instance();
  $CI->load->model("M_Api");
  $CI->M_Api->set($url, $parameter);
  $data = $CI->M_Api->exec($method);
  if (empty($data)) {
    $data = $CI->M_Api->msg(true, "Terjadi Kesalahan ketika memproses data", false);
  }

  return $data;
}

function getAssets() {
  return base_url() . "assets/";
}
