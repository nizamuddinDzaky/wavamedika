<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_paket extends CI_Controller {

	public function index()
	{
		$this->data['js'] = 'master/barang_paket_js';
        $this->data['main_view'] = 'master/v_barang_paket';
		$this->load->view('template', $this->data);
	}

	public function simpan()
	{
		$headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['edit_paket']==0)
        {
            $API=BASE_URL_API_LPS.'master/paket_item/paket/insert';   
        }
        else
        {
            $API=BASE_URL_API_LPS.'master/paket_item/paket/update';
        }


        /*$data['master']  = $_POST['data'];*/
        // echo json_encode($_POST['data']);
        // var_dump("aaa");die();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
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

	public function filter()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();
        $param       = $this->input->post();
   
        $param['criteria']   = $param['criteria'] ?? '';
        $param['page_row']   = $param['page_row'] ?? 10;
        $param['page']   = $param['page'] ?? 1;
        $param['status']   = $param['status'] ?? 1;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/paket_item/search');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($param));

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

    public function hapus_paket()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/paket_item/paket/delete');
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

    public function filter_barang()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();
        $param       = $this->input->post();
   
        $param['criteria']   = $param['criteria'] ?? '';
        $param['page_row']   = $param['page_row'] ?? 10;
        $param['page']   = $param['page'] ?? 1;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/item_farmasi/search');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($param));

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

    public function simpan_detail()
	{
		$headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['edit_detail']==0)
        {
            $API=BASE_URL_API_LPS.'master/paket_item/item/insert';   
        }
        else
        {
            $API=BASE_URL_API_LPS.'master/paket_item/item/update';
        }


        /*$data['master']  = $_POST['data'];*/
        // echo json_encode($_POST['data']);
        // var_dump("aaa");die();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
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

	public function hapus_detail()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/paket_item/item/delete');
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

/* End of file Paket_barang_farmasi.php */
/* Location: ./application/apps/farmasi/controllers/master/Paket_barang_farmasi.php */