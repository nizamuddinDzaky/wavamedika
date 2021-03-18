<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perinatologi extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register Perinatologi',
            'urlData'   => site_url() . 'tpp/laporan/register_perinatologi/',
            'main_view' => 'laporan/v_register_perinatologi',
            'js'        => 'laporan/js_register_perinatologi',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}