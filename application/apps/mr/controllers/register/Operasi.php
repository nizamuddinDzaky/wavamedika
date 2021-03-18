<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operasi extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register Operasi',
            'urlData'   => site_url() . 'tpp/laporan/register_operasi/',
            'main_view' => 'laporan/v_register_operasi',
            'js'        => 'laporan/js_register_operasi',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}