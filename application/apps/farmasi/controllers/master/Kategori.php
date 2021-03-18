<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$this->data['js'] = 'master/kategori_js';
        $this->data['main_view'] = 'master/v_kategori';
		$this->load->view('template', $this->data);
	}

	public function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        // $url = BASE_URL_API_LPS.'/farmasi/master/kel_item/coa_list';
        $url = BASE_URL_API_LPS.'master/kel_item/search';
        // echo json_encode($headers);die;
        // echo $url;die;
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
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
        // print_r($buffer);die;
        $result=json_decode($buffer);
        echo json_encode($result);
    }

	public function filter_coa()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        // $url = BASE_URL_API_LPS.'/farmasi/master/kel_item/coa_list';
        $url = BASE_URL_API_LPS.'master/kel_item/coa_list';
        // echo json_encode($headers);die;
        // echo $url;die;
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
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
        // print_r($buffer);die;
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // echo json_encode($_POST);die();
        if($_POST['edit']==0)
        {
            $API=BASE_URL_API_LPS.'master/kel_item/insert';
        }
        else
        {
            $API=BASE_URL_API_LPS.'master/kel_item/update';   
        }
        
        // var_dump($data); die();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));
        // var_dump(json_encode($_POST'));
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

    public function getPerKode()
    {
        $API = BASE_URL_API_LPS.'master/kel_item/get/'.$_POST['data'];
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
        echo json_encode($result['data'][0]);
    }

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     	echo json_encode($_POST['data']);die;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/kel_item/delete');
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

/* End of file Kategori.php */
/* Location: ./application/apps/general/controllers/master/Kategori.php */