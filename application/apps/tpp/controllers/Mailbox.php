<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends CI_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'mailbox_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'v_mailbox';

        // Load View
		$this->load->view('temp_message', $this->data);
	}

}

/* End of file Mailbox.php */
/* Location: ./application/apps/farmasi/controllers/Mailbox.php */