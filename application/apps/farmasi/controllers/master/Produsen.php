<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produsen extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/produsen_js';
        $this->data['main_view'] = 'master/v_produsen';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['status'] = $param['data_status'] ?? 0;
        $param['criteria'] = $param['criteria'] ?? '';
        $param['page'] = $param['page'] ?? 1;
        $param['page_row'] = $param['rows'] ?? 10;

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'master/produsen/search');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($param));
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

    public function simpan(){
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['edit']==0){
            $API_PRODUSEN=BASE_URL_API_LPS.'master/produsen/insert';
        }else{
            $API_PRODUSEN=BASE_URL_API_LPS.'master/produsen/update';    
        }

        // echo json_encode($_POST['data']);
     
        curl_setopt($curl_handle, CURLOPT_URL, $API_PRODUSEN);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
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
        $result=json_decode($buffer);

        echo json_encode($result);
    }

    public function getProdusen(){
        $headers  = getHeaderToken();
        $API_PRODUSEN = BASE_URL_API_LPS.'/master/produsen/get/'.$_POST['data'];

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_PRODUSEN);
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

        $data = [];
        if (count($result['list'])> 0) {
            $data=$result['list'][0];
        }
        echo json_encode($data);
    }

    public function hapus(){
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/produsen/delete');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
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

        $result=json_decode($buffer);
        echo json_encode($result);
    }
}

/* End of file Produsen.php */
/* Location: ./application/apps/farmasi/controllers/master/Produsen.php */