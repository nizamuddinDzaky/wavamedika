<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'dashboard_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'v_dashboard';

        // Load View
		$this->load->view('template', $this->data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/apps/admin/controllers/Dashboard.php */