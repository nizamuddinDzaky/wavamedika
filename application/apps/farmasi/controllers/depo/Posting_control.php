<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting_control extends CI_Controller {

	public function index()
	{
		$this->data['js'] = 'depo/posting_control_js';
        $this->data['main_view'] = 'depo/v_posting_control';
        $this->load->view('template', $this->data);
	}

	public function filter()
    {
        $URL = BASE_URL_API_LPS."depo_farmasi/posting/list";
        $headers=getHeaderToken();
        // print_r($headers);die;
        // echo json_encode($headers);die;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
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

    public function proses()
    {
        $URL = BASE_URL_API_LPS."depo_farmasi/posting/proses";
        $headers=getHeaderToken();
        // // print_r();die;
        // echo json_encode($headers);die;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
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

}

/* End of file Posting_control.php */
/* Location: ./application/apps/farmasi/controllers/depo/Posting_control.php */