<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_bersalin extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register Kamar Bersalin',
            'urlData'   => site_url() . 'tpp/laporan/register_kamar_bersalin/',
            'main_view' => 'laporan/v_register_kamar_bersalin',
            'js'        => 'laporan/js_register_kamar_bersalin',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}