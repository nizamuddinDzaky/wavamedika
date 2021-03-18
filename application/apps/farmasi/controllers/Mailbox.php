<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends CI_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'mailbox_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'v_mailbox';

        // Load View
		$this->load->view('temp_message', $this->data);
	}

	public function notif()
	{
		$cURLConnection = curl_init();
		$headers=getHeaderToken();
		curl_setopt($cURLConnection, CURLOPT_URL, 'http://36.92.178.100:9000/access/users/notif');
		curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, $headers);

		$phoneList = curl_exec($cURLConnection);
		curl_close($cURLConnection);
		echo $phoneList;
	}

	public function inbox()
	{
        $curl_handle = curl_init();

		$API="http://36.92.178.100:9000/access/users/message";
		$headers=getHeaderToken();
        // echo $API;die;
        // echo json_encode($_POST['data']);die;
        // echo json_encode();
     
        curl_setopt($curl_handle, CURLOPT_URL, $API);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER,  $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo $buffer;
	}

	public function approval()
	{
        $curl_handle = curl_init();

		$API="http://36.92.178.100:9000/access/users/approval";
		$headers=getHeaderToken();
        // echo $API;die;
        // echo json_encode($_POST['data']);die;
        // echo json_encode();
     
        curl_setopt($curl_handle, CURLOPT_URL, $API);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER,  $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo $buffer;
	}

	public function markInbox()
	{
		$curl_handle = curl_init();

		$API="http://36.92.178.100:9000/access/users/message/mark";
		$headers=getHeaderToken();
        // echo $API;die;
        // echo json_encode($_POST['data']);die;
        // echo json_encode();
     
        curl_setopt($curl_handle, CURLOPT_URL, $API);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER,  $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo $buffer;
	}

	public function markApproval()
	{
		$curl_handle = curl_init();

		$API="http://36.92.178.100:9000/access/users/message/mark";
		$headers=getHeaderToken();
        // echo $API;die;
        // echo json_encode($_POST['data']);die;
        // echo json_encode();
     
        curl_setopt($curl_handle, CURLOPT_URL, $API);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER,  $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo $buffer;
	}

}

/* End of file Mailbox.php */
/* Location: ./application/apps/farmasi/controllers/Mailbox.php */