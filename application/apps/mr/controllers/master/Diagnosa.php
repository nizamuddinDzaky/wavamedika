<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosa extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/diagnosa_js';
        $this->data['main_view'] = 'master/v_diagnosa';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['criteria']     = $param['criteria'] ?? '';
        $data['page']          = $param['page'] ?? 1;
        $data['page_row']      = $param['rows'] ?? 10;

        $response = sendRequest("GET", "mr", "master/diagnosa", $param, false);

        echo json_encode($response);  
    }

    public function simpan(){
        
        if($_POST['edit']==0){
            $metode = "POST";
        }else{
            $metode = "PUT";  
        }
        
        $response = sendRequest($metode, "mr", "master/diagnosa", $_POST['data'], false);

        echo json_encode($response);
    }

    public function hapus(){

        $response = sendRequest("DELETE", "mr", "master/diagnosa", $_POST['data'], false);

        echo json_encode($response);
    }

    public function list_pelayanan(){

        $response = sendRequest("GET", "mr", "master/jns_pelayanan/list",'', true);

        $daftar   = [];

        foreach ($response['data'] as $unit) {
            $daftar[] = (object) [
                'id_jpf' => $unit['id_jpf'],
                'nama_jpf' => $unit['nama_jpf'],
                'jenis_jpf' => $unit['jenis_jpf'],
            ];
        }
        echo json_encode($daftar);
    }
}
