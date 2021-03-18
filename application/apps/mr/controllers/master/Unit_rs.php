<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_rs extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/unit_rs_js';
        $this->data['main_view'] = 'master/v_unit_rs';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $response = sendRequest("GET", "mr", "master/unit/list", '', false);

        echo json_encode($response);  
    }
}

/* End of file Produsen.php */
/* Location: ./application/apps/farmasi/controllers/master/Produsen.php */