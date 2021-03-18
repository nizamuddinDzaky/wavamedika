<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_darah extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/jenis_darah_js';
        $this->data['main_view'] = 'master/v_jenis_darah';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/jns_darah", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/jns_darah", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/jns_darah", $_POST['data'], false);

        echo json_encode($response);
    }
}
