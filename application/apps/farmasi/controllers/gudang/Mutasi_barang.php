<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_barang extends CI_Controller {

	public function index()
	{
        // data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/mutasi_barang_js';
        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_mutasi_barang';
        // Load View
		$this->load->view('template', $this->data);
    }

    public function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
        $param['status']     = $param['status'] ?? 0;
        $param['start_date'] = $param['start_date'] ?? 1;
        $param['end_date']   = $param['end_date'] ?? 1;
        $param['criteria']   = $param['criteria'] ?? '';
        $param['page_row']   = $param['page_row'] ?? 10;
        $param['criteria']   = $param['criteria'] ?? '';

        $response = sendRequest("POST", 'lps', "gudang/farmasi/mutasi/search", $param);

        echo json_encode($response);
    }

    public function Filter_barang()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        $data['tgl_mutasi']   = $param['tgl_mutasi'] ?? '';
        $data['start_date']   = $param['start_date'] ?? '';
        $data['end_date']   = $param['end_date'] ?? '';
        $data['page']         = $param['page'] ?? 1;
        $data['page_row']     = $param['page_row'] ?? 10;
        $data['criteria']     = $param['criteria'] ?? '';
        $data['id_unit_stok'] = $param['id_unit_stok'] ?? '';

        $response = sendRequest("POST", 'lps', "gudang/farmasi/mutasi/list_barang", $param);
        echo json_encode($response);
    }

    public function Filter_barang_no_mutasi()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        // print_r($param);die();
        // print_r($param);die();

        $data['no_pm']        = $param['data']['no_pm'] ;
        $data['tgl_mutasi']   = $param['data']['tgl_mutasi'] ;
        $data['id_unit_stok'] = $param['data']['id_unit_stok'] ;
        // print_r($data);die();
        $response = sendRequest("POST", 'lps', "gudang/farmasi/mutasi/list_barang_pm", $data);

        echo json_encode($response);
    }

    public function default_auth()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $response = sendRequest("POST", 'lps', "gudang/farmasi/mutasi/list_default_sign", $_POST['data'],true);

        // print_r($response);
        $detail= [];
        foreach ($response['data'] as $key => $list) {
            $detail[$key]['seq_no']     =$list['seq_no'];
            $detail[$key]['sign_id']    =$list['sign_id'];
            $detail[$key]['sign_name']  =$list['sign_name'];
            $detail[$key]['is_default'] =$list['is_default'];
            $detail[$key]['is_active']  =$list['is_default'];
            $detail[$key]['user_id']    =(float)$list['user_id'];
            $detail[$key]['user_name']  =$list['user_name'];
        }
        $response['data']=$detail;

        echo json_encode($response);
    }

    public function getPerKode()
    {
        $API = BASE_URL_API_LPS.'gudang/farmasi/mutasi/get/'.$_POST['data'];
        $headers=getHeaderToken();

        $response = sendRequest("GET", 'lps', 'gudang/farmasi/mutasi/get/'.$_POST['data'],"",true);

        $data = [];
        if (count($response['master'])> 0)
        {
            $data['master']=$response['master'][0];
            $data['detail']=$response['detail'];
            $data['autor']=$response['auth'];
        }
        echo json_encode($data);
    }

    function get_data_unit()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
        
        $response = sendRequest("POST", 'lps', 'master/unit_akses/list_farmasi',$data,true);

        
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => '',
            'text' => 'Pilih unit Asal',
        ];
        foreach ($response['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['edit']==0)
        {
            $API='gudang/farmasi/mutasi/insert';
            $data['auths']=$_POST['data']['auths'];
        }
        else
        {
            $API='gudang/farmasi/mutasi/update';   
        }

        $data['master']  = $_POST['data']['master'];
        $data['details'] = $_POST['data']['details'];
        // $data['auths']=$_POST['data']['auths'];
        $response = sendRequest("POST", 'lps', $API,$_POST['data']);
        
        echo json_encode($response);
    }

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        
        $response = sendRequest("POST", 'lps', 'gudang/farmasi/mutasi/delete',$_POST['data']);

        echo json_encode($response);
    }

    public function user_approve($seq_no)
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // var_dump($_POST['data']);

        $data['seq_no']=$seq_no;
        
        $response = sendRequest("POST", 'lps', 'gudang/farmasi/mutasi/list_user_approve',$data);

        
        $daftar = [];
        foreach ($response['list'] as $data) {
            $daftar[] = (object) [
                'user_id' => $data['user_id'],
                'user_name' => $data['user_name'],
                'user_fullname' => $data['user_fullname']
            ];
        }
        echo json_encode($daftar);
        // echo json_encode($response);
    }

    public function status()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['status']==1)
        {
            $API='gudang/farmasi/mutasi/status/open';
        }
        else if($_POST['status']==2)
        {
            $API='gudang/farmasi/mutasi/status/release';   
        }
        else if($_POST['status']==3)
        {
            $API='gudang/farmasi/mutasi/status/receive';   
        }
        else if($_POST['status']==4)
        {
            $API='gudang/farmasi/mutasi/status/reject';   
        }

        // echo json_encode($API);
        // echo json_encode($_POST['data']);
        $response = sendRequest("POST", 'lps', $API,$_POST['data']);
        
        echo json_encode($response);
    }
}
