<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('v_login');
	}

 	public function ceklogin()
    {
        $url = BASE_URL_LOGIN;
        // echo "$url";die;
        // append the header putting the secret key and hash
        $headers=getHeader();
        
        $parampost = $this->input->post();
        
        $param['username'] = $parampost['username'];
        $param['password'] = $parampost['password'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($param));
        $buffer = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);

        if (isset($error_msg)) {
            // var_dump(1);
            var_dump($error_msg);
            exit();
        }

        $result=json_decode($buffer,true);

        if($result['status_code']==200)
        {
	        $session = array(
                    'logged_in'     => TRUE,
                    'token'         => $result['token'],
                    'user_fullname' => $result['user_fullname'],
                    'user_id'       => $result['user_id'],
                    'id_unit'       => $result['id_unit_def'],
                    'nama_unit'     => $result['nama_unit_def'],
			);
    	}
    	else
    	{
			$session = array(
			        'logged_in' => FALSE,
			);    		
    	}

    	$this->session->set_userdata($session);

    	echo json_encode($result);
    }

}
