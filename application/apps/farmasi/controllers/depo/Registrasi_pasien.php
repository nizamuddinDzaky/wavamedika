<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_pasien extends CI_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'depo/registrasi_pasien_js';
        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'depo/v_registrasi_pasien';
        // Load View
        $this->load->view('template', $this->data);
	}

	public function filter(){
		$param = $this->input->post();

        $data['jns_rawat'] = $param['jns_rawat'] ?? 0;
        $data['start_date'] = $param['start_date'] ?? '';
        $data['end_date'] = $param['end_date'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data); die();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/depo_farmasi/reg_pasien/search');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));

        // Optional, delete this line if your API is open
        $buffer = curl_exec($curl_handle);

        if (curl_errno($curl_handle)) {
            $error_msg = curl_error($curl_handle);
        }
        curl_close($curl_handle);

        if (isset($error_msg)) {
            var_dump(1);
            exit();
        }
        // var_dump($buffer);die();
        $result=json_decode($buffer);
        echo json_encode($result);
	}

}

/* End of file Registrasi_pasien.php */
/* Location: ./application/apps/farmasi/controllers/depo/Registrasi_pasien.php */