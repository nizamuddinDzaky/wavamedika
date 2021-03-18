<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_dokter extends CI_Controller {
	var $headers;
	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
        $this->headers = getHeaderToken();
    }

	function index()
	{
		$this->data['js'] = 'laporan/kegiatan_dokter_js';
        $this->data['main_view'] = 'laporan/v_kegiatan_dokter';
        $this->load->view('template', $this->data);
	}

	function filter()
    {
        $param = $this->input->post();
        $param["nama_unit"]   = $param['nama_unit'] ?? "";
        $param["nama_ruang"]  =  $param['nama_ruang'] ?? "";
        $param["nama_dokter"] = $param['nama_dokter'] ?? "";
        $response = sendRequest("GET", "mr", "laporan/kegiatan_dokter/rekap",$param);
        echo json_encode($response);
    }

	function get_unit()
    {
        $response = sendRequest("GET", "mr", "laporan/kegiatan_dokter/list_unit","", true);
        $daftar_unit   = [];
        foreach ($response['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['kode'],
                'text' => $unit['nama_unit']
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_ruang()
    {
        $response = sendRequest("GET", "mr", "laporan/kegiatan_dokter/list_ruang","", true);
        $daftar_ruang   = [];
        foreach ($response['data'] as $unit) {
            $daftar_ruang[] = (object) [
                'id'   => $unit['kode'],
                'text' => $unit['nama_unit']
            ];
        }
        echo json_encode($daftar_ruang);
    }

    function get_dokter()
    {
        $response = sendRequest("GET", "mr", "laporan/kegiatan_dokter/list_dokter","", true);
        $daftar_dokter   = [];
        foreach ($response['data'] as $unit) {
            $daftar_dokter[] = (object) [
                'id'   => $unit['kode'],
                'text' => $unit['nama']
            ];
        }
        echo json_encode($daftar_dokter);
    }
}

/* End of file kegiatan_dokter.php */
/* Location: ./application/apps/farmasi/controllers/depo/kegiatan_dokter.php */