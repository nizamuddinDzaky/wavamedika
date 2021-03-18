<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fisioterapi extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'register/fisioterapi_js';
        $this->data['main_view'] = 'register/v_fisioterapi';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
		$param['page_row'] = $param['page_row'] ?? 10;
		$param['page']     = $param['page'] ?? 1;
		$mode="detail";
		if($param['mode']==1){
			$mode='rekap';
		}
     
        $response = sendRequest("GET", "mr", "register/fisioterapi/".$mode, $param, false);

        echo json_encode($response);  
    }
}