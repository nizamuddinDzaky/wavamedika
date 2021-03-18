<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mr_baru extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Pasien Baru',
            'urlData'   => site_url() . 'tpp/entry/module/ajax',
            'main_view' => 'entry/v_pasien_baru',
            'js'        => 'entry/pasien_baru_js',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}