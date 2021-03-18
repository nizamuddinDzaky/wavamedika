<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyerahan_obat extends CI_Controller {

	public function index()
	{
		$this->data['js'] = 'depo/penyerahan_obat_js';
        $this->data['main_view'] = 'depo/v_penyerahan_obat';
        $this->load->view('template', $this->data);
	}

	public function filter()
	{
		$URL = BASE_URL_API_LPS."depo_farmasi/ambil_obat";
        $headers=getHeaderToken();
        // print_r();die;
        // echo json_encode($_POST);die;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

	public function ambil_obat_grid()
	{
		$URL = BASE_URL_API_LPS."depo_farmasi/ambil_obat_nota";
        $headers=getHeaderToken();
        // print_r();die;

        $curl_handle = curl_init();
        // echo json_encode($_POST['data']);die;
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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

	public function btn_ambil_obat()
	{
		$URL = BASE_URL_API_LPS."depo_farmasi/ambil_obat";
        $headers=getHeaderToken();
        // print_r();die;

        $curl_handle = curl_init();
        // echo json_encode($_POST['data']);die;
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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
	
	public function filter_depo()
	{
		$URL = BASE_URL_API_LPS."master/depo_nota";
        $headers=getHeaderToken();
        // print_r();die;

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST));

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

/* End of file Penyerahan_obat.php */
/* Location: ./application/apps/farmasi/controllers/depo/Penyerahan_obat.php */