<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pasien extends CI_Controller {

	public function index()
	{
        $data = [
            'module'        => 'tpp',
            'title'         => 'Data Pasien',
            'urlData'       => site_url() . 'tpp/master/data_pasien/',
            'main_view'     => 'master/v_data_pasien',
            'js'            => 'master/js_data_pasien',
            'dataKabupaten' => '', //$this->getSelectKotaKab(),
            'dataKecamatan' => '' // $this->getSelectKec(),
          ];

       $this->load->view('template', $data);
	}
}