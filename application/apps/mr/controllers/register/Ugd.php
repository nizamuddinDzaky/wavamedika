<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ugd extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register UGD',
            'urlData'   => site_url() . 'tpp/laporan/register_ugd/',
            'main_view' => 'laporan/v_register_ugd',
            'js'        => 'laporan/js_register_ugd',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}