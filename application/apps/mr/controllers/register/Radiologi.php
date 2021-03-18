<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Radiologi extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'register/radiologi_js';
        $this->data['main_view'] = 'register/v_radiologi';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();

        if ($param['mode']=='detail') {
            # code...
            $data['page_row']     = $param['page_row'] ?? 10;
            $data['page']         = $param['page'] ?? 1;
        }
        
        $data['start_date']   = $param['start_date'] ?? '';
        $data['end_date']     = $param['end_date'] ?? '';
        
        $response = sendRequest("GET", "mr", "register/radiologi/".$param['mode'], $data, false);

        echo json_encode($response);  
    }
}