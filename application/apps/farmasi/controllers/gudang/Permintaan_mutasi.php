<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_mutasi extends CI_Controller {

	public function index()
	{
        // data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/permintaan_mutasi_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_permintaan_mutasi';
        
       	// Load view
		$this->load->view('template', $this->data);
    }
    public function get_unit_asal()
    {

        $headers  = getHeaderToken();
        $data = ['user_id' => $this->session->userdata('user_id')];
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/unit_akses/list_farmasi');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));

        // Optional, delete this line if your API is open
        $buffer = curl_exec($curl_handle);
        $result=json_decode($buffer,true);
        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '',
            'text' => 'Pilih unit Asal',
        ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_unit_tujuan(){
        $API = BASE_URL_API_LPS."master/depo_farmasi/list";
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
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
            'text' => 'Pilih unit Tujuan',
        ];

        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function search_item()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();

        $param = $this->input->post();

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';
        $data['tgl_pm'] = $param['tgl_pm'] ?? '';
        $data['id_unit_asal'] = $param['id_unit_asal'] ?? 0;
        $data['id_unit_tujuan'] = $param['id_unit_tujuan'] ?? 0;

        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/list_barang');
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

        $result=json_decode($buffer);
        echo json_encode($result); die();
        $data=[];
        if ($result->row_count>0) {
            foreach ($result->data as $key => $item) {
            	$data[]=[
            		"id_item" => $item->id_item,
    				"nama_item" => $item->nama_item,
    				"kd_item" => $item->kd_item,
    				"nama_satuan" => $item->nama_satuan,
    				"nama_kel_item" => $item->nama_kel_item,
    				"jml" => $item->jml,
            	];
            }
        }

        echo json_encode($data);
    }

    public function simpan()
    {
    	// echo json_encode($_POST);die;
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();

        if (isset($_POST['master']['no_pm'])) {
        	$url = BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/update';
        }else{
        	$url = BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/insert';
        }

        // echo json_encode($_POST);die;
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


        $result=json_decode($buffer);
        echo json_encode($result); die();
        $a=array('error' =>$result->metadata->error,'message' =>$result->metadata->message);

        echo json_encode($a);
    }

    public function filter()
    {
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['status'] = $param['status'] ?? 0;
        $data['start_date'] = $param['start_date'] ?? '';
        $data['end_date'] = $param['end_date'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'gudang/farmasi/minta_mutasi/search');
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

        // die($buffer);
        $result=json_decode($buffer);
        echo json_encode($result); die();
        // print_r($result);die;
        $data=[];
        if ($result->metadata->list_count > 0) {
            $data = $result->list;
        }

        echo json_encode($data);
    }

    public function hapus(){
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/delete');
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
        // var_dump($buffer); die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function getPermintaan()
    {
    	$API = BASE_URL_API_LPS."gudang/farmasi/minta_mutasi/get/".$_POST['data'];
        
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

        $data = [];
        if (count($result['master'])> 0)
        {
            $data['master']=$result['master'][0];
            $data['details']=$result['detail'];
            $data['auth']=$result['auth'];
        }
        echo json_encode($data); die();

        // echo json_encode($result);die();
        $master['no_pm'] = $result['master']['data'][0]['no_pm'];
        $master['tgl_pm'] = $result['master']['data'][0]['tgl_pm'];
        $master['id_unit_asal'] = $result['master']['data'][0]['id_unit_asal'];
        $master['id_unit_tujuan'] = $result['master']['data'][0]['id_unit_tujuan'];
        $master['ket_pm'] = $result['master']['data'][0]['ket_pm'];
        $master["status_caption"] = $result['master']['data'][0]['status_caption'];
        $detail = [];
        foreach ($result['detail']['data'] as $key => $item) {
        	$detail[]=[
        		"id_item" => $item['id_item'],
				"nama_item" => $item['nama_item'],
				"kd_item" => $item['kd_item'],
				"nama_satuan" => $item['nama_satuan'],
				"nama_kel_item" => $item['nama_kel_item'],
				"jml" => $item['jml_stok'],
				"permintaan" => $item['jml_minta'],
        	];
        }
        $auths = [];
        foreach ($result['auth'] as $key => $item) {
        	$auths[]=[
        		"sign_id" => $item['sign_id'],
				"sign_name" => $item['sign_name'],
				"status_caption" => $item['status_caption'],
				"user_name" => $item['user_name'],
				"comment" => $item['comment'],
				"sign_date" => $item['sign_date'],
				"from_date" => $item['from_date'],
				"respon_time" => $item['respon_time'],
				"from_date" => $item['from_date'],
                "user_id_approve" => $item['user_id_approve'],
                "approve_name" => $item['approve_name']
        	];
        }

        // print_r($auths );die;
        $data['auth'] = $auths;
        $data['master'] = $master;
        $data['details'] = $detail;
        echo json_encode($data);
    }

    public function verifikasi()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // var_dump($_POST['status']); die();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/status/'.$_POST['status']);
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

    public function penangungJawab()
    {

    	$headers  = getHeaderToken();
        $data = [
        	'seq_no' => 1
        ];
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS."gudang/farmasi/minta_mutasi/list_user_approve");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));

        // Optional, delete this line if your API is open
        $buffer = curl_exec($curl_handle);
        $result=json_decode($buffer);

    	// $API = BASE_URL_API_LPS."gudang/farmasi/minta_mutasi/list_user_approve";
        $daftar_unit = [];
        if ($result->metadata->list_count > 0) {
	        foreach ($result->list as $unit) {
	            $daftar_unit[] = (object) [
	                'user_id' => $unit->user_id,
	                'users_approve_name' => $unit->user_name,
	            ];
	        }
        }
        echo json_encode($daftar_unit);
    }

    public function getAuth()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS."gudang/farmasi/minta_mutasi/list_default_sign");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

        $buffer = curl_exec($curl_handle);
        $result=json_decode($buffer);
        echo json_encode($result); die();

        $data=[];
        if ($result->metadata->list_count > 0 ) {
            foreach ($result->list as $auth) {
                $data[]=[
                    'seq_no'=> $auth->seq_no,
                    'sign_id'=> $auth->sign_id,
                    'sign_name'=> $auth->sign_name,
                    'is_default'=> $auth->is_default,
                    'user_id'=> $this->session->userdata('user_id'),
                    'user_name'=> $auth->user_name,
                    'user_fullname'=> $auth->user_fullname,
                    'is_active'=> true
                ];
            }
        }

        echo json_encode($data);
    }
}
