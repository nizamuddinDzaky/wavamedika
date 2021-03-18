<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {

	public function index()
	{
                $this->data['module'] = 'farmasi';
                $this->data['js'] = 'master/item_farmasi_js';
                $this->data['main_view'] = 'master/v_item_farmasi';
                $this->load->view('template', $this->data);
	}
}
