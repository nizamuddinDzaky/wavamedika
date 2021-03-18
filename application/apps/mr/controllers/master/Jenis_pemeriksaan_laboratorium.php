<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jenis_pemeriksaan_laboratorium extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/jenis_pemeriksaan_laboratorium_js';
        $this->data['main_view'] = 'master/v_jenis_pemeriksaan_laboratorium';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/penunjang_medis/lab", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/penunjang_medis/lab", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/penunjang_medis/lab", $_POST['data'], false);

        echo json_encode($response);
    }

    public function list_jenis(){

        $response = sendRequest("GET", "mr", "master/penunjang_medis/lab/jenis",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'jenis' => $unit['jenis'],
            ];
        }
        echo json_encode($daftar);
    }
}
