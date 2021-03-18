<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_antri_poliklinik extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'register/pesanan_antri_poliklinik_js';
        $this->data['main_view'] = 'register/v_pesanan_antri_poliklinik';
		$this->load->view('template', $this->data);
	}
}