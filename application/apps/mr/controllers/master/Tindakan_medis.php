<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindakan_medis extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/tindakan_medis_js';
        $this->data['main_view'] = 'master/v_tindakan_medis';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/icd_cm", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/icd_cm", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/icd_cm", $_POST['data'], false);

        echo json_encode($response);
    }
}

/* End of file Produsen.php */
/* Location: ./application/apps/farmasi/controllers/master/Produsen.php */