<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_pendaftaran extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register Pendaftaran',
            'urlData'   => site_url() . 'tpp/laporan/register_pendaftaran/',
            'main_view' => 'laporan/v_register_pendaftaran',
            'js'        => 'laporan/js_register_pendaftaran',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}