<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_mrs extends CI_Controller {

	public function index()
	{
        $data = [
            'module'    => 'tpp',
            'title'     => 'Register Update MRS',
            'urlData'   => site_url() . 'tpp/laporan/register_update_mrs/',
            'main_view' => 'laporan/v_register_update_mrs',
            'js'        => 'laporan/js_register_update_mrs',
            'data1'     => '',
            'data2'     => '',
          ];

       $this->load->view('template', $data);
	}
}