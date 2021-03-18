<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Infeksi_nosokomial extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/infeksi_nosokomial_js';
        $this->data['main_view'] = 'master/v_infeksi_nosokomial';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/infeksi_nosokomial", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/infeksi_nosokomial", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/infeksi_nosokomial", $_POST['data'], false);

        echo json_encode($response);
    }

    public function list_jenis(){

        $response = sendRequest("GET", "mr", "master/infeksi_nosokomial/jenis",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'jenis' => $unit['jenis'],
            ];
        }
        echo json_encode($daftar);
    }

    public function list_satuan(){

        $response = sendRequest("GET", "mr", "master/infeksi_nosokomial/satuan  ",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'satuan' => $unit['satuan'],
            ];
        }
        echo json_encode($daftar);
    }
}
