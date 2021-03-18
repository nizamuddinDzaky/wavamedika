<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien_kontrol extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'register/pasien_kontrol_js';
        $this->data['main_view'] = 'register/v_pasien_kontrol';
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
     
        $response = sendRequest("GET", "mr", "register/pasien_kontrol/".$mode, $param, false);

        echo json_encode($response);  
    }

    function get_data_unit()
    {
        $data['user_id']=$this->session->userdata['user_id'];
        
        $response = sendRequest("GET", 'mr', 'master/poli/list_all',$data,true);

        
        $daftar_unit   = [];
        foreach ($response['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['nama_kamar'],
                'text' => $unit['nama_kamar'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_data_dokter()
    {
        $data['user_id']=$this->session->userdata['user_id'];
        
        $response = sendRequest("GET", 'mr', 'master/dokter/list_all',$data,true);

        
        $daftar_unit   = [];
        foreach ($response['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['nama'],
                'text' => $unit['nama'],
            ];
        }
        echo json_encode($daftar_unit);
    }
}