<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_farmasi extends MY_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'master/item_farmasi_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'master/v_item_farmasi';

        // Load View
		$this->load->view('template', $this->data);
	}

	public function filter()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

		$data['status']     = $param['status'] ?? 0;
		$data['page']       = $param['page'] ?? 1;
		$data['page_row']   = $param['rows'] ?? 10;
		$data['criteria']   = $param['criteria'] ?? '';
        $response = sendRequest("POST", 'lps', 'master/item_farmasi/search',$data);

        echo json_encode($response);
    }

    public function getItem()
    {
        $response = sendRequest("GET", 'lps', 'master/item_farmasi/get/'.$_POST['data'],'',true);
        
        $data = [];
        if (count($response['master'])> 0)
        {
			$data['master']    =$response['master'][0];
			$data['lokasi']    =$response['lokasi'];
			$data['komposisi'] =$response['komposisi'];
			$data['supplier']  =$response['supplier'];
        }
        echo json_encode($data);
    }

    public function simpan()
    {
        if (isset($_POST['master']['id_item'])) {
            $url = 'master/item_farmasi/update';
        }else{
            $url = 'master/item_farmasi/insert';
        }
        $response = sendRequest("POST", 'lps', $url,$_POST);

        echo json_encode($response);
    }

    public function hapus()
    {

        $response = sendRequest("POST", 'lps', 'master/item_farmasi/delete',$_POST['data']);

        echo json_encode($response);
    }

    public function filter_supplier()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

		$data['page']       = $param['page'] ?? 1;
		$data['page_row']   = $param['rows'] ?? 10;
		$data['criteria']   = $param['criteria'] ?? '';
        
        $response = sendRequest("POST", 'lps', 'master/supplier/list',$data);
        
        echo json_encode($response);
    }

    public function getLokasi()
    {
        $response = sendRequest("POST", 'lps', 'master/lokasi_barang/list_unit','',true);

        $daftar = [];
        $daftar[]=[
            'id'     => '',
            'text'   => 'Pilih Lokasi',
            'detail' => [],
        ];

        foreach ($response['list'] as $item) {
            $daftar[] = (object) [
				'id'     => $item['id_unit'],
				'text'   => $item['nama_unit'],
				'detail' => $item['detail'],

            ];
        }
        echo json_encode($daftar);
    }

    public function getProdusen()
    {
        $response = sendRequest("POST", 'lps', 'master/produsen/list','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Produsen',
        ];

        foreach ($response['list'] as $item) {
            $daftar[] = (object) [
				'id'   => $item['id_produsen'],
				'text' => $item['nama_produsen'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getKelompok()
    {
        $response = sendRequest("POST", 'lps', 'master/kel_item/list_farmasi','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Kelompok',
        ];

        foreach ($response['data'] as $item) {
            $daftar[] = (object) [
				'id'   => $item['id_kel_item'],
				'text' => $item['nama_kel_item'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getGolongan()
    {
        $response = sendRequest("POST", 'lps', 'master/gol_obat/list','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Golongan',
        ];

        foreach ($response['data'] as $item) {
            $daftar[] = (object) [
				'id'   => $item['id_gol_obat'],
				'text' => $item['nama_gol_obat'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getJenis()
    {
        $response = sendRequest("POST", 'lps', 'master/jns_obat/list','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Jenis',
        ];

        foreach ($response['data'] as $item) {
            $daftar[] = (object) [
				'id'   => $item['id_jns_obat'],
				'text' => $item['nama_jns_obat'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getKategori()
    {
        $response = sendRequest("POST", 'lps', 'master/kategori_obat/list','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Kategori',
        ];

        foreach ($response['data'] as $item) {
            $daftar[] = (object) [
				'id'    => $item['id_kat_obat'],
				'text'  => $item['nama_kat_obat'],
				'jenis' => $item['jenis'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getTerapi()
    {
        $response = sendRequest("POST", 'lps', 'master/kelas_terapi/list','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Terapi',
        ];

        foreach ($response['data'] as $item) {
            $daftar[] = (object) [
				'id'    => $item['id_kelas_terapi'],
				'text'  => $item['nama_kelas_terapi'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getBentuk()
    {
        $response = sendRequest("POST", 'lps', 'master/bentuk_sediaan/list','',true);
        
        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Bentuk',
        ];

        foreach ($response['data'] as $item) {
            $daftar[] = (object) [
				'id'    => $item['id_bentuk_sd'],
				'text'  => $item['nama_bentuk_sd'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getSatuan()
    {
        $response = sendRequest("POST", 'lps', 'master/satuan/list','',true);

        $daftar = [];
        $daftar[]=[
			'id'   => '',
			'text' => 'Pilih Satuan',
        ];

        foreach ($response['list'] as $item) {
            $daftar[] = (object) [
				'id'    => $item['id_satuan'],
				'text'  => $item['nama_satuan'],
            ];
        }
        echo json_encode($daftar);
    }

    public function getSatuanKomposisi()
    {
        $response = sendRequest("POST", 'lps', 'master/satuan/list_sediaan','',true);

        $daftar = [];
        foreach ($response['list'] as $item) {
            $daftar[] = (object) [
                'id_satuan_sd'   => $item['id_satuan'],
                'nama_satuan_sd' => $item['nama_satuan']
            ];
        }
        echo json_encode($daftar);
    }

    public function getSatuanKomposisiComboGrid()
    {
        $response = sendRequest("POST", 'lps', 'master/satuan/list_sediaan','',true);

        // $API = BASE_URL_API_LPS."master/satuan/list_sediaan";
        
        // $headers=getHeaderToken();

        // $curl_handle = curl_init();
        // curl_setopt($curl_handle, CURLOPT_URL, $API);
        // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl_handle, CURLOPT_POST, 1);
        // curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // $buffer = curl_exec($curl_handle);

        // if (curl_errno($curl_handle)) {
        //     $error_msg = curl_error($curl_handle);
        // }
        // curl_close($curl_handle);

        // if (isset($error_msg)) {
        //     var_dump(1);
        //     exit();
        // }

        // $result=json_decode($buffer,true);

        $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode(array('total' => count($response['list']),'rows' => $result['list'])));
    }
}

/* End of file Item_farmasi.php */
/* Location: ./application/apps/farmasi/controllers/master/Item_farmasi.php */