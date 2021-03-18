<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_persalinan extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/jenis_persalinan_js';
        $this->data['main_view'] = 'master/v_jenis_persalinan';
		$this->load->view('template', $this->data);
	}

	function filter_jenis(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/jns_persalinan", $param, false);

        echo json_encode($response);  
    }

    public function simpan_jenis(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/jns_persalinan", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus_jenis(){

        $response = sendRequest("DELETE", "mr", "master/jns_persalinan", $_POST['data'], false);

        echo json_encode($response);
    }

    ///

    function filter_komplikasi(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/komplikasi_persalinan", $param, false);

        echo json_encode($response);  
    }

    public function simpan_komplikasi(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/komplikasi_persalinan", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus_komplikasi(){

        $response = sendRequest("DELETE", "mr", "master/komplikasi_persalinan", $_POST['data'], false);

        echo json_encode($response);
    }

    //

    function filter_jenis_sc(){
        $param = $this->input->post();
        $param['criteria'] = $param['criteria'] ?? '';

        $response = sendRequest("GET", "mr", "master/jns_sc", $param, false);

        echo json_encode($response);  
    }

    public function simpan_jenis_sc(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/jns_sc", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus_jenis_sc(){

        $response = sendRequest("DELETE", "mr", "master/jns_sc", $_POST['data'], false);

        echo json_encode($response);
    }
}
