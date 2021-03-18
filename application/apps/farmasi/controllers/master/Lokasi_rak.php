<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi_rak extends CI_Controller {

	public function index()
	{
        $this->data['js'] = 'master/lokasi_rak_js';
        $this->data['main_view'] = 'master/v_lokasi_rak';
		$this->load->view('template', $this->data);
	}

	function filter(){
        $param = $this->input->post();
        $param['id_unit'] = $param['id_unit'] ?? 0;
        $param['criteria'] = $param['criteria'] ?? '';
        $param['page'] = $param['page'] ?? 1;
        $param['page_row'] = $param['rows'] ?? 10;

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'master/lokasi_barang/search');
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
        	$API_LOKASI_BARANG=BASE_URL_API_LPS.'master/lokasi_barang/insert';
        }else{
        	$API_LOKASI_BARANG=BASE_URL_API_LPS.'master/lokasi_barang/update';	
        }

        // var_dump($API_LOKASI_BARANG);
        // echo json_encode($_POST['edit']);
        // echo json_encode($_POST['data']);
        // die();
     
        curl_setopt($curl_handle, CURLOPT_URL, $API_LOKASI_BARANG);
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

    public function getBarang(){
        $headers  = getHeaderToken();
        $API_BARANG = BASE_URL_API_LPS.'master/lokasi_barang/get/'.$_POST['data'];

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_BARANG);
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

    public function get_unit_all(){
        $headers  = getHeaderToken();
        $API_UNIT_ALL = BASE_URL_API_LPS."master/unit/list_all";

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_UNIT_ALL);
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
        //echo $API_BANK_TUJUAN; die()
        $daftar_unit = [];
        // $daftar_unit[]=[
        //     'id'   => '',
        //     'text' => 'Pilih Produsen',
        // ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_unit(){
        $headers  = getHeaderToken();
        $API_UNIT = BASE_URL_API_LPS."master/unit/list";

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_UNIT);
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
            'id'   => '',
            'text' => 'Pilih Unit',
        ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_karyawan(){
        $headers  = getHeaderToken();
        $API_KARYAWAN = BASE_URL_API_LPS."master/pegawai/list";

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_KARYAWAN);
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
        $daftar_karyawan = [];
        foreach ($result['list'] as $karyawan) {
            $daftar_karyawan[] = (object) [
                'id' => $karyawan['id_karyawan'],
                'text' => $karyawan['nama'],
            ];
        }
        echo json_encode($daftar_karyawan);
    }

    public function hapus(){
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/lokasi_barang/delete');
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

/* End of file Lokasi_penyimpanan.php */
/* Location: ./application/apps/farmasi/controllers/master/Lokasi_penyimpanan.php */