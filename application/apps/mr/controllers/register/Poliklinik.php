<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poliklinik extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register Poliklinik',
            'urlData'   => site_url() . 'tpp/laporan/register_poliklinik/',
            'main_view' => 'laporan/v_register_poliklinik',
            'js'        => 'laporan/js_register_poliklinik',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}