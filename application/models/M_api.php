<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model {

  protected $url, $action, $param;
  protected $output;

  public function __construct() {
    parent::__construct();

    $this->load->library("curl");
    $this->load->config("config_api");
  }

  public function set($action, $param, $disable_page = false) {
    if (is_array($param)) {
      $this->param = $param;
    }
    /* if($disable_page==false){
      if(preg_match("/(list)/", $action) and empty($param["Page"])) {
      $this->param["Page"]  = 1;
      }
      if(preg_match("/(list)/", $action) and empty($param["Limit"])) {
      $this->param["Limit"] = 10;
      }
      } */
    if ($this->config->item("api_developing")) {
      $this->param['operator'] = 1;
    }


    $this->param["ip_address"] = $this->ip_address();
    $this->action = $action;
  }

  public function exec($set_method = "post", $type_output = "object") {
    $this->url = $this->config->item("api_url") . "/" . $this->action;
    $this->output = $this->curl_start($set_method);

    if ($this->config->item("api_log_request")) {
      log_message("debug", "url : {$this->url}, param : " . json_encode($this->param));
    }
    if ($this->config->item("api_log_response")) {
      log_message("debug", "output : {$this->output}");
    }

    // return json_encode($this->param, true);

    switch ($type_output) {
      case "array":
        return json_decode($this->output, true);
        break;
      case "json":
        return $this->output;
        break;
      default:
        return json_decode($this->output);
        break;
    }
  }

  public function curl_start($set_method) {
    if (empty($this->session->userdata("token"))) {
      $session_login = "";
    } else {
      $session_login = $this->session->serdata("token");
    }
    $header = [
            // "accept: application/json",
            // "X-DreamFactory-API-Key: {$this->config->item("api_key")}",
            // "X-DreamFactory-Session-Token: ".$session_login.""
    ];
    $this->curl->create($this->url);
    $this->curl->option(CURLOPT_POST, true);
    $this->curl->option(CURLOPT_HTTPHEADER, $header);
    $this->curl->option(CURLOPT_RETURNTRANSFER, true);
    $this->curl->option(CURLOPT_SSL_VERIFYPEER, false);
    $this->curl->option(CURLOPT_FAILONERROR, false);

    if ($set_method == "post") {
      unset($this->param['act']);
      $this->curl->post(json_encode($this->param));
      return $this->curl->execute();
    }
    if ($set_method == "get") {
      $this->curl->get($this->param);
      return $this->curl->execute();
    }
    if ($set_method == "put") {
      $this->curl->put($this->param);
      return $this->curl->execute();
    }
    if ($set_method == "patch") {
      $this->curl->patch($this->param);
      return $this->curl->execute();
    }
    if ($set_method == "delete") {
      $this->curl->delete($this->param);
      return $this->curl->execute();
    }
  }

  public function msg($IsError, $message, $json_output = true) {
    if ($IsError) {
      $data = ["metadata" => ["err_code" => 1, "message" => $message, "list_count" => 0], "list" => array()];
    } else {
      if (is_array($message)) {
        $data = ["IsError" => false, "Data" => $message];
      } else {
        $data = ["IsError" => false, "Output" => $message];
      }
    }
    if ($json_output) {
      return json_encode($data);
    }
    return $data;
  }

  public function ip_address() {
    $ipaddress_local = getHostByName(getHostName());
    $ipaddress_online = $this->input->ip_address();
    return ($ipaddress_online == "::1") ? $ipaddress_local : $ipaddress_online;
  }

}
