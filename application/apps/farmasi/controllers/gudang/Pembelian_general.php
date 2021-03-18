<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_general extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'gudang/pembelian_general_js';
        $this->data['main_view'] = 'gudang/v_pembelian_general';
        $this->load->view('template', $this->data);
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
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/beli_tunai/search');
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
        // var_dump($buffer);

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function filter_supplier()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'master/supplier/list');
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

    public function filter_uang_muka()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/beli_tunai/list_uang_muka');
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

    public function filter_barang()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/beli_tunai/list_barang');
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

    public function get_gudang(){
        $API = BASE_URL_API_LPS."master/gudang_farmasi/list";
        
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
            'text' => 'Pilih Gudang',
        ];

        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function getPembelian()
    {
        $API = BASE_URL_API_LPS."gudang/umum/beli_tunai/get/".$_POST['data'];
        
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
        }
        echo json_encode($data);
    }

    public function simpan()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();

        if (isset($_POST['master']['no_bpb'])) {
        	$url = BASE_URL_API_LPS.'gudang/umum/beli_tunai/update';
        }else{
        	$url = BASE_URL_API_LPS.'gudang/umum/beli_tunai/insert';
        }

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
        echo json_encode($result);
    }

    public function hapus()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/beli_tunai/delete');
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

    public function verifikasi()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/beli_tunai/status/'.$_POST['status']);
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

}

/* End of file Pembelian_general.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Pembelian_general.php */