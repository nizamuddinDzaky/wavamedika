<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_pemeriksaan_radiologi extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/jenis_pemeriksaan_radiologi_js';
        $this->data['main_view'] = 'master/v_jenis_pemeriksaan_radiologi';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/penunjang_medis/rad", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/penunjang_medis/rad", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/penunjang_medis/rad", $_POST['data'], false);

        echo json_encode($response);
    }

    public function list_jenis(){

        $response = sendRequest("GET", "mr", "master/penunjang_medis/rad/jenis",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'jenis' => $unit['jenis'],
            ];
        }
        echo json_encode($daftar);
    }

    public function list_golongan(){

        $response = sendRequest("GET", "mr", "master/penunjang_medis/rad/golongan",'', true);
        
        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'golongan' => $unit['golongan'],
            ];
        }
        echo json_encode($daftar);
    }

    public function list_kategori(){

        $response = sendRequest("GET", "mr", "master/penunjang_medis/rad/kategori",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'jenis_sampel' => $unit['jenis_sampel'],
            ];
        }
        echo json_encode($daftar);
    }
}
