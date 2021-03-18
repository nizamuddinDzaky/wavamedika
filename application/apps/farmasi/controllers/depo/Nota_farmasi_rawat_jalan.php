<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota_farmasi_rawat_jalan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('function_helper');
	}

	public function index()
	{
        $this->data['js'] = 'depo/nota_farmasi_rawat_jalan_js';
        $this->data['main_view'] = 'depo/v_nota_farmasi_rawat_jalan';
        $this->load->view('template', $this->data);
	}

    public function get_konfigurasi()
    {
        $API = BASE_URL_API_LPS."config/nota_rj";
        
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

        $result=json_decode($buffer);

        echo json_encode($result);
    }

	public function get_dokter()
    {
        $API = BASE_URL_API_LPS."master/dokter/list";
        
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

        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '',
            'text' => 'Pilih Dokter',
        ];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'            => $unit['id_karyawan'],
                'text'          => $unit['nama_karyawan'],
                'id_karyawan'   => $unit['id_karyawan'],
                'nama_karyawan' => $unit['nama_karyawan'],
                'nik'           => $unit['nik'],
                'jenis'         => $unit['jenis'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_kamar()
    {
        $API = BASE_URL_API_LPS."master/kamar/list/".$_POST['data'];
        
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

        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '',
            'text' => 'Pilih Klinik/Ruang',
        ];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'         => $unit['id_kamar'],
                'text'       => $unit['kamar_display'],
                'id_kamar'   => $unit['id_kamar'],
                'nama_kamar' => $unit['nama_kamar'],
                'id_unit'    => $unit['id_unit'],
                'nama_unit'  => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_signa($param)
    {
        $API = BASE_URL_API_LPS."master/signa/".$param;
        
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

        $daftar_unit = [];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'signa' => $unit['signa'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_unit_default()
    {
        $API = BASE_URL_API_LPS."master/depo_nota";
        
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

        $result=json_decode($buffer);

        echo json_encode($result);
    }

    public function filter()
    {
        $param = $this->input->post();
        
        $data['status_proses'] = $param['status'] ?? 0;
        $data['tgl1']          = $param['start_date'] ?? '';
        $data['tgl2']          = $param['end_date'] ?? '';
        $data['page']          = $param['page'] ?? 1;
        $data['page_row']      = $param['rows'] ?? 10;
        $data['criteria']      = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/nota/nota_rj');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

    public function filter_no_billing($cari)
    {
        $headers=getHeaderToken();

        $curl_handle = curl_init();

        if ($cari==1)
        {
            # code...
            $API = BASE_URL_API_LPS."master/mrs/".$_POST['data'];
        }
        else
        {
            $param = $this->input->post();
            
            $data['jns_rawat'] = "RJ";
            $data['page']      = $param['page'] ?? 1;
            $data['page_row']  = $param['rows'] ?? 10;
            $data['criteria']  = $param['criteria'] ?? '';

            $API = BASE_URL_API_LPS."master/mrs_aktif";

            curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
        }
        
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

        $result=json_decode($buffer);

        echo json_encode($result);
    }

    public function get_eresep()
    {
        $API = BASE_URL_API_LPS."depo_farmasi/nota/e_resep/".$_POST['data'];
        
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

        $result=json_decode($buffer);

        echo json_encode($result);
    }

    public function get_eresep_detail()
    {
        $API = BASE_URL_API_LPS."depo_farmasi/nota/e_resep_det/".$_POST['data'];
        
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

        $result=json_decode($buffer);

        echo json_encode($result);
    }

    public function cari_item()
    {
        $param = $this->input->post();

        // var_dump($param);
        $data['jns_nota']        = $param['jns_nota'] ?? 1;
        $data['jns_rawat']       = $param['jns_rawat'] ?? 'RJ';
        $data['status_karyawan'] = $param['status_karyawan'] ?? '';
        $data['id_unit']         = $param['id_unit'] ?? '';
        $data['criteria']        = $param['criteria'] ?? '';

        // echo json_encode($data);

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/nota/cari_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_GET));
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

        $result=json_decode($buffer,true);

        $daftar_unit = [];

        if (isset($result['data']))
        {
            # code...
            foreach ($result['data'] as $unit) {
                $daftar_unit[] = (object) [
                    'id_item' => $unit['id_item'],
                    'kd_item' => $unit['kd_item'],
                    'nama_item' => $unit['nama_item'],
                    'id_satuan' => $unit['id_satuan'],
                    'id_kel_item' => $unit['id_kel_item'],
                    'is_for_rs' => $unit['is_for_rs'],
                    'is_for_nas' => $unit['is_for_nas'],
                    'stok' => $unit['stok'],
                    'harga_jual' => $unit['harga_jual'],
                ];
            }
        }

        echo json_encode($daftar_unit);
    }

    public function cari_item_datagrid()
    {
        $param = $this->input->post();

        // var_dump($param);
        $data['jns_nota']        = $param['jns_nota'] ?? 1;
        $data['jns_rawat']       = $param['jns_rawat'] ?? '';
        $data['status_karyawan'] = $param['status_karyawan'] ?? '';
        $data['id_unit']         = $param['id_unit'] ?? '';
        $data['criteria']        = $param['criteria'] ?? '';

        // echo json_encode($data);

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/nota/cari_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_GET));
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

        $result=json_decode($buffer,true);

        $daftar_unit = [];

        if (isset($result['data']))
        {
            # code...
            $daftar_unit = $result;            
        }

        echo json_encode($daftar_unit);
    }

    public function cari_item_combogrid()
    {
        $param = $this->input->post();

        // var_dump($param);
        $data['jns_nota']        = $param['jns_nota'] ?? 1;
        $data['jns_rawat']       = $param['jns_rawat'] ?? 'RJ';
        $data['status_karyawan'] = $param['status_karyawan'] ?? '';
        $data['id_unit']         = $param['id_unit'] ?? '';
        $data['criteria']        = $param['criteria'] ?? '';

        // echo json_encode($data);

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/nota/cari_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

        $result=json_decode($buffer,true);

        if (isset($result['data']))
        {
            $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode(array('total' => count($result['data']),'rows' => $result['data'])));
        }
        else
        {
            $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode(array('total' => 0,'rows' => [])));   
        }
    }

    public function filter_paket_item()
    {
        $param = $this->input->post();

        if (isset($param['criteria'])) {
            $url = BASE_URL_API_LPS.'master/paket_item/master';
        }else{
            $url = BASE_URL_API_LPS.'master/paket_item/detail';
        }
        
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

    public function getPerNota()
    {
        $API = BASE_URL_API_LPS."depo_farmasi/nota/nota_rj/".$_POST['data'];
        
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

        echo json_encode($result);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $url = BASE_URL_API_LPS.'depo_farmasi/nota/nota_rj';

        if (isset($_POST['master']['no_nota'])) {
            $method = "PUT";
        }else{
            $method = "POST";
        }

        // echo json_encode($_POST); die();

        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $method);
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
        $API = BASE_URL_API_LPS."depo_farmasi/nota/nota_rj/".$_POST['data'];
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
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

        $result=json_decode($buffer);

        echo json_encode($result);
    }

    public function ganti_unit()
    {
        # code...
        $param = $this->input->post();
        $this->session->set_userdata('id_unit', $param['id']);
        $this->session->set_userdata('nama_unit', $param['nama']);
        echo json_encode(200);
    }
}

/* End of file Nota_farmasi_rawat_jalan.php */
/* Location: ./application/apps/farmasi/controllers/depo/Nota_farmasi_rawat_jalan.php */