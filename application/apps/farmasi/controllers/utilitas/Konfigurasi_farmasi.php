<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi_farmasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('function_helper');
	}

	public function index()
	{
		$this->data['js'] = 'utilitas/konfigurasi_farmasi_js';
        $this->data['main_view'] = 'utilitas/v_konfigurasi_farmasi';
		$this->load->view('template', $this->data);
	}

	public function get_depo()
    {
        $API = BASE_URL_API_LPS."master/list_unit_stok/depo_farmasi";
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        $buffer = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {
            $error_msg = curl_error($curl_handle);
        }
        curl_close($curl_handle);

        if (isset($error_msg)) {
            var_dump(1);
            exit();
        }

        $result=json_decode($buffer,true);

        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '',
            'text' => 'Pilih Depo',
        ];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
				'id'   => $unit['id_unit'],
				'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function cari_item()
    {
        $param = $this->input->post();

        // var_dump($param);
		$data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data);

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/item_farmasi/cari_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_GET));
        $buffer = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {
            $error_msg = curl_error($curl_handle);
        }
        curl_close($curl_handle);

        if (isset($error_msg)) {
            var_dump(1);
            exit();
        }

        // var_dump($buffer);

        $result=json_decode($buffer,true);

        $daftar = [];
        $daftar[]=[
            'id' => '',
            'text' => '',
        ];
        // print_r($result['data']);die;
        if (isset($result['data']))
        {
        	foreach ($result['data'] as $unit) {
	            $daftar[] = (object) [
	                'id' => $unit['id_item'],
	                'kd_item' => $unit['kd_item'],
	                'text' => $unit['nama_item'],
	                'id_satuan' => $unit['id_satuan'],
	            ];
	        }
        }

        echo json_encode($daftar);
    }

    public function getKonfigurasi()
    {
        $API = BASE_URL_API_LPS."config/all";
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        $buffer = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {
            $error_msg = curl_error($curl_handle);
        }
        curl_close($curl_handle);

        if (isset($error_msg)) {
            var_dump(1);
            exit();
        }


        $result=json_decode($buffer,true);

        echo json_encode($result);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $url = BASE_URL_API_LPS.'config/all';

        // echo json_encode($_POST['data']); die();

        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST));

        $buffer = curl_exec($curl_handle);


        if (curl_errno($curl_handle)) {
            $error_msg = curl_error($curl_handle);
        }
        curl_close($curl_handle);

        if (isset($error_msg)) {
                var_dump(1);
                exit();
        }

        $result=json_decode($buffer);
        echo json_encode($result);
    }
}

/* End of file Konfigurasi_farmasi.php */
/* Location: ./application/apps/farmasi/controllers/utilitas/Konfigurasi_farmasi.php */