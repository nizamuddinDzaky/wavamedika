<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_stok_opname extends CI_Controller {
	var $headers;
	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
        $this->headers = getHeaderToken();
    }

	public function index()
	{
		$this->data['js'] = 'gudang/input_stok_opname_js';
        $this->data['main_view'] = 'gudang/v_input_stok_opname';
		$this->load->view('template', $this->data);
	}

	function get_data_depo()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/so/depo');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);        
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => '',
            'text' => 'Pilih depo',
            'no_so' => 'no_so',
        ];
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['unit_display'],
                'no_so' => $unit['no_so'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_alasan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/so/ket_selisih');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);        
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        // $daftar_unit[] =[
        //     'id'   => '',
        //     'text' => 'Pilih Keterangan',
        // ];
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_ket_selisih'],
                'text' => $unit['nama_ket_selisih']
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_data_rak()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
		$data['user_id']  = $this->session->userdata['user_id'];
		$param['id_unit'] = $param['id_unit'];
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/so/depo/'.$param['id_unit'].'/rak');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);        
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => '',
            'text' => 'Pilih Rak',
            'nama_karyawan' => 'nama_karyawan',

        ];
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_lokasi'],
                'text' => $unit['nama_lokasi'],
                'nama_karyawan' => $unit['nama_karyawan'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_barang()
    {
        $curl_handle = curl_init();
        $param = $this->input->post();
        // $param['user_id']    = $param['data'];
        $headers=getHeaderToken();
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS.'gudang/farmasi/so/item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

        $result=json_decode($buffer,true);
        // $roles= [];
        // foreach ($result['rows'][0]['roles'] as $key => $list) {
        //     $roles[]     =$list['role_id'];
        // }
        // $result['roles']=$roles;
        // print_r($result['roles']);
        // print_r($result);
        echo json_encode($result);
        // print_r($result);
        // $API = 'http://36.92.178.100:9000/access/users/'.$_POST['data'].'/byid';
        // $result = json_decode($this->curl->simple_get($API), true);
        // print_r($result);die();
        // $data = [];
        // if (count($result['master'])> 0)
        // {
        //     $data['master']=$result['master'][0];
        //     $data['detail']=$result['detail'];
        //     $data['autor']=$result['auth'];
        // }
        // echo json_encode($data);
    }

    function get_stok_sistem()
    {
        $curl_handle = curl_init();
        $param = $this->input->post();
        // $param['user_id']    = $param['data'];
        $headers=getHeaderToken();
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS.'gudang/farmasi/so/stok_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

        $result=json_decode($buffer,true);
        // $roles= [];
        // foreach ($result['rows'][0]['roles'] as $key => $list) {
        //     $roles[]     =$list['role_id'];
        // }
        // $result['roles']=$roles;
        // print_r($result['roles']);
        // print_r($result);
        echo json_encode($result);
        // print_r($result);
        // $API = 'http://36.92.178.100:9000/access/users/'.$_POST['data'].'/byid';
        // $result = json_decode($this->curl->simple_get($API), true);
        // print_r($result);die();
        // $data = [];
        // if (count($result['master'])> 0)
        // {
        //     $data['master']=$result['master'][0];
        //     $data['detail']=$result['detail'];
        //     $data['autor']=$result['auth'];
        // }
        // echo json_encode($data);
    }

    function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $data = $this->input->post();
        // $data['auths']=$_POST['data']['auths'];
        $data['user_id']=$this->session->userdata['user_id'];
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS.'gudang/farmasi/so/input_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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
        echo json_encode($result);
    }

}

/* End of file Input_stok_opname.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Input_stok_opname.php */