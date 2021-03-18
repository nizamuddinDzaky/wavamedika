<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

    public function index()
    {
        $this->data['js'] = 'master/jenis_js';
        $this->data['main_view'] = 'master/v_jenis';
        $this->load->view('template', $this->data);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        if ($_POST['is_created'] == 1) {
            $url = BASE_URL_API_LPS.'master/jns_obat/insert';
        }else{
            $url = BASE_URL_API_LPS.'master/jns_obat/update';
        }

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['master']));

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
        // print_r($result);die;
        $a=array('error' =>$result->success,'message' =>$result->message);

        echo json_encode($a);
    }

    public function filter()
    {
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['status']     = $param['status'] ?? 0;
        $data['page']       = $param['page'] ?? 1;
        $data['page_row']   = $param['rows'] ?? 10;
        $data['criteria']   = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'master/jns_obat/search');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
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

    public function getPerkode()
    {
        $headers  = getHeaderToken();
        $API = BASE_URL_API_LPS."master/jns_obat/get/".$_POST['data'];
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
        // print_r($result);
        echo json_encode($result['data'][0]);
    }

    public function hapus()
    {
        $headers  = getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/master/jns_obat/delete');
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

/* End of file Jenis.php */
/* Location: ./application/apps/farmasi/controllers/master/Jenis.php */