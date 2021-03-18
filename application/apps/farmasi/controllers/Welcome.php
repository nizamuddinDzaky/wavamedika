<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
        $this->data['js'] = 'welcome_js';
        
        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'welcome';

        // Load View
		$this->load->view('template', $this->data);
    }
    
}
