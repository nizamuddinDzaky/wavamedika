<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_obat_bebas extends CI_Controller {

	public function index()
	{
		$this->data['js'] = 'depo/penjualan_obat_bebas_js';
        $this->data['main_view'] = 'depo/v_penjualan_obat_bebas';
        $this->load->view('template', $this->data);
	}

}

/* End of file Penjualan_obat_bebas.php */
/* Location: ./application/apps/farmasi/controllers/depo/Penjualan_obat_bebas.php */