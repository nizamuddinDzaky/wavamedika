<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

 public function index() {
    $mod = getModule();
    $this->data['mod'] = $mod;
    $session = array(
        'list_module' => json_encode($mod) 
    );
    $this->session->set_userdata($session);
    // ARR_MODULE = $mod;
    // print_r($autoload['language']);die;
    $this->load->view('v_dashboard', $this->data);
 }

 public function coba($value='')
 {
 	$session = array(
        'module_id' => $_POST['modul_id'], 
        'module_page' => $_POST['page']
    );
 	$this->session->set_userdata($session);
 	header("Location: ".base_url($_POST['page']));
 }

}
