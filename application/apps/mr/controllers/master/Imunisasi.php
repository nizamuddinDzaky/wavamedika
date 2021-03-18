<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imunisasi extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/imunisasi_js';
        $this->data['main_view'] = 'master/v_imunisasi';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/jns_imunisasi", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/jns_imunisasi", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/jns_imunisasi", $_POST['data'], false);

        echo json_encode($response);
    }

    public function list_jenis(){

        $response = sendRequest("GET", "mr", "master/jns_imunisasi/jenis",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'jenis' => $unit['jenis'],
            ];
        }
        echo json_encode($daftar);
    }
}
