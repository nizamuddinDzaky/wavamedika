<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_bhp extends CI_Controller {

	public function index()
	{
		$this->data['js'] = 'transaksi/permintaan_bhp_js';
        $this->data['main_view'] = 'transaksi/v_permintaan_bhp';
		$this->load->view('template', $this->data);
	}

	public function get_unit_asal()
	{
        $headers  = getHeaderToken();
        $data = [
        	'user_id' => $this->session->userdata('user_id')
        ];
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

    public function get_unit_tujuan()
    {
        $API_UNIT = BASE_URL_API_LPS."master/depo_farmasi/list";
        $headers=getHeaderToken();

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

    public function filter_barang($value='')
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
        // print_r(json_encode($_POST));die;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/list_barang');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST));


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

    public function default_auth()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/list_default_sign');
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

        $result=json_decode($buffer,true);

        $detail= [];
        foreach ($result['list'] as $key => $list) {
            $detail[$key]['seq_no']=$list['seq_no'];
            $detail[$key]['sign_id']=$list['sign_id'];
            $detail[$key]['sign_name']=$list['sign_name'];
            $detail[$key]['is_default']=$list['is_default'];
            $detail[$key]['is_active']=$list['is_default'];
            $detail[$key]['user_id']=$this->session->userdata('user_id');
            $detail[$key]['user_name']=$list['user_name'];
        }
        $result['list']=$detail;

        echo json_encode($result);
    }

    public function simpan()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
        if($_POST['edit']==0)
        {
        	$API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/insert';
            // $data['auths']=$_POST['data']['auths'];
        }
        else
        {
        	$API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/update';	
        }

        $data['master']  = $_POST['data']['master'];
        $data['details'] = $_POST['data']['details'];
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
    	$param = $this->input->post();

        $data['status'] = $param['status'] ?? 0;
        $data['start_date'] = $param['start_date'] ?? '';
        $data['end_date'] = $param['end_date'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data); die();
        // echo BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/search';die;

    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/minta_bmhp/search');
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
        // print_r($buffer);die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function getPerKode()
    {
    	$API = BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/get/'.$_POST['data'];
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
        // print_r($result);die();
        $data = [];
        if (count($result['master'])> 0)
        {
            $data['master'] =$result['master']['data'][0];
            $data['detail'] =$result['detail']['data'];
        }
        echo json_encode($data);
    }

    public function user_approve($seq_no)
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();

        // var_dump($_POST['data']);

        $data['seq_no']=$seq_no;
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/minta_beli/list_user_approve');
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

        $result=json_decode($buffer,true);
        $daftar = [];
        foreach ($result['list'] as $data) {
            $daftar[] = (object) [
                'user_id' => $data['user_id'],
                'user_name' => $data['user_name'],
                'user_fullname' => $data['user_fullname']
            ];
        }
        echo json_encode($daftar);
        // echo json_encode($result);
    }

    public function status()
    {

        // $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/'.$_POST['status'];	
        // print_r($API);die();
        // echo json_encode($API);
        // echo json_encode($_POST['data']);
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['status']==1)
        {
            $API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/status/open';
        }
        else if($_POST['status']==2)
        {
            $API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/status/release';   
        }
        else if($_POST['status']==3)
        {
            $API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/status/approve';   
        }
        else if($_POST['status']==4)
        {
            $API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/status/receive';   
        }
        else if($_POST['status']==5)
        {
            $API=BASE_URL_API_LPS.'gudang/umum/minta_bmhp/status/reject';   
        }
     
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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function hapus()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/umum/minta_bmhp/delete');
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

/* End of file Permintaan_bhp.php */
/* Location: ./application/apps/general/controllers/transaksi/Permintaan_bhp.php */