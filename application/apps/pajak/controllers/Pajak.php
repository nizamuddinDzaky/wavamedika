<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak extends CI_Controller {

    public function index() {
        $this->load->view('v_pajak');
    }

}
