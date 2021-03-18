<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_rekap_bon_pasien_per_unit extends CI_Controller {
	var $headers;
	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
        $this->headers = getHeaderToken();
    }

	function index()
	{
		$this->data['js'] = 'depo/lap_rekap_bon_pasien_per_unit_js';
        $this->data['main_view'] = 'depo/v_lap_rekap_bon_pasien_per_unit';
        $this->load->view('template', $this->data);
	}

	function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/farmasi/bon_pasien/rekap_per_unit');
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

	function get_data_unit_asal()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=1;
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/list_unit_stok/farmasi');
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
        $daftar_unit[] =
        [
            'id'   => 0,
            'text' => 'All',
        ];
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['nama_unit']
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_data_unit_tujuan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=1;
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/unit/list');
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => 0,
            'text' => 'All',
        ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['nama_unit']
            ];
        }
        echo json_encode($daftar_unit);
    }

    function get_kategori()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=1;
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/kel_item/list_farmasi');
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => 0,
            'text' => 'All',
        ];
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_kel_item'],
                'text' => $unit['nama_kel_item']
            ];
        }
        echo json_encode($daftar_unit);
    }

    function filter_cetak()
    {
        # code...
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();


        $url = BASE_URL_API_LPS.'laporan/farmasi/bon_pasien/rekap_per_unit';
        
        $type_buffer               = $param['buffer']??false;
        $cek                       = $param['cek']??0;
        
        curl_setopt($curl_handle, CURLOPT_URL, $url);
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

        $result=json_decode($buffer,TRUE);
        
        if ($cek==1)
        {
            # code...
            echo json_encode($result);
        }
        else
        {
            return $result;
        }

    }

    function test(){
           $result = '{
    "success": true,
    "status_code": 200,
    "message": "",
    "master": {
        "tgl_input": "2016-02-17 08:20:02",
        "nama_dokter": "dr. Hendri Wiyono Sp.P",
        "no_sip": "503.2/214.2/KAB/DS/V/2018",
        "nama_unit": "KLINIK RAWAT JALAN",
        "nama_kamar": "Klinik Paru",
        "bed": "",
        "kelas": "II",
        "no_mr": "11407331",
        "id_mrs": 16024354,
        "nama_lengkap": "ENDRES",
        "tgl_lahir": "1938-07-17 00:00:00",
        "umur": "77 th 7 bln 0 hr"
    },
    "detail": [
        {
            "nr": "N",
            "nama_obat": "azitromicin 500",
            "aturan": "1x1",
            "aturan_buat": null,
            "qty_roman": ""
        },
        {
            "nr": "N",
            "nama_obat": "Antasida syrup",
            "aturan": "3xcth1",
            "aturan_buat": null,
            "qty_roman": ""
        },
        {
            "nr": "R1",
            "nama_obat": "tismalin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "aminophilin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "metilprednisolon 1/5",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "mucohexin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },{
            "nr": "R1",
            "nama_obat": "metilprednisolon 1/5",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "mucohexin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },{
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "tismalin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "aminophilin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },{
            "nr": "N",
            "nama_obat": "azitromicin 500",
            "aturan": "1x1",
            "aturan_buat": null,
            "qty_roman": ""
        },
        {
            "nr": "N",
            "nama_obat": "Antasida syrup",
            "aturan": "3xcth1",
            "aturan_buat": null,
            "qty_roman": ""
        },
        {
            "nr": "R1",
            "nama_obat": "tismalin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "aminophilin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "metilprednisolon 1/5",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "mucohexin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },{
            "nr": "R1",
            "nama_obat": "metilprednisolon 1/5",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "mucohexin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },{
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "tismalin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "R1",
            "nama_obat": "aminophilin 1/4",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        },
        {
            "nr": "r2",
            "nama_obat": "cimetidin 2/3",
            "aturan": "1 dd pulv 1",
            "aturan_buat": "m.f.l.a pulv dtd",
            "qty_roman": "XX"
        }
    ]
}';
$json = json_decode($result, true);
return $json;
                    }
    function wira(){
            $nextp=0;
            $nextp2=0;
            $result=$this->test();
            $master = $result['master'];
            $detail = $result['detail'];
            // print_r($result);
            $this->load->library('Pdf');
            $pdf = tcpdf();
            $pdf->SetPrintHeader(false);
            //initialize document
            $pdf->setMargins(5, 30, 5);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("P", "ERESEP");
            $pdf->SetFont("tahoma", "", 8);
            // $pdf->AddPage();
            $left_column = '
            <style>
                .atas table, 
                .atas thead, 
                .atas tr,
                .atas td, 
                .atas th {
                    border:0.5px solid black;
                    font-size: 8px;
                }

                .bawah table, 
                .bawah thead, 
                .bawah tr, 
                .bawah th {
                    border:0.5px solid white;
                    font-size: 6px;
                }
                .master table, 
                .master thead, 
                .master tr, 
                .master th {
                    font-size: 8px;
                }
                .border{
                    border:1px solid black;
                }
                div.kanan {
                  text-align: right;
                }
            </style>
            <img src="assets/img/header-wava2.png">
            <br>
            <br>
            <b>
            <table> 
                <tr>
                    <td style="border-top: 1px solid black" width="80%" width="20%" align="left"></td>
                    <td style="border-top: 1px solid black" width="80%" width="80%" align="left"></td>
                </tr>                <tr>
                    <td width="80%" width="20%" align="left">Tanggal</td>
                    <td width="80%" width="80%" align="left">: '.tanggal($master['tgl_input']).'</td>
                </tr>
                <tr>
                    <td width="20%" align="left">Dokter</td>
                    <td width="80%" align="left">: '.$master['nama_dokter'].'</td>
                </tr>
                <tr>
                    <td width="20%" align="left">SIP</td>
                    <td width="80%" align="left">: '.$master['no_sip'].'</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black" width="80%" width="20%" align="left"></td>
                    <td style="border-bottom: 1px solid black" width="80%" width="80%" align="left"></td>
                </tr>
            </table>
            <br>
            <br>
            <table>';
            $batas=count($detail);
            $tr=0;
            $no=0;
            $resep_sekarang="";
            $resep_sebelum="";
            foreach ($detail as $key=> $val) {
                $resep_sekarang=$val['nr'];
                if($val['nr']=='N'){
                    $left_column .='
                        <tr>
                            <td width="7%" align="center">R/</td>
                            <td width="73%" align="left">'.$val['nama_obat'].'</td>
                            <td width="20%" align="right">'.$val['qty_roman'].'</td>
                        </tr>
                        <tr >
                            <td style="border-bottom: 1px solid black" colspan="3" align="right">'.$val['aturan'].'</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>      
                    ';
                    $tr+=3;
                }else{
                    $resep_sekarang=$val['nr'];
                    if($val['nr']==$resep_sekarang && $val['nr']!=$resep_sebelum){
                        $left_column .='
                        <tr>
                            <td width="7%" align="center">R/</td>
                            <td width="73%" align="left"></td>
                            <td width="20%" align="right"></td>
                        </tr>';    
                        $tr++;
                    }
                    $left_column .='
                        <tr>
                            <td width="7%" align="center"></td>
                            <td width="80%" align="left">'.$val['nama_obat'].'</td>
                            <td width="20%" align="right"></td>
                        </tr>

                    ';
                    $tr+=2;
                    // print_r($detail[$val+1]['nr']);
                    if($no!=$batas-1){
                        $haha=$detail[$no+1]['nr'];
                    }
                    // print_r($haha);
                    if(($val['nr']==$resep_sekarang && $no==$batas-1) || ($val['nr']==$resep_sekarang && $resep_sekarang!=$haha)){
                        $left_column .='
                            <tr>
                                <td width="7%" align="center"></td>
                                <td width="73%" align="left">'.$val['aturan_buat'].'</td>
                                <td width="20%" align="right">'.$val['qty_roman'].'</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black" colspan="3" align="right">'.$val['aturan'].'</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>    
                        ';
                        $tr+=4;
                    }
                }
                $resep_sebelum=$val['nr'];
                $no++;
                
            }
            // $nextp=$no;
            $nextp2=$no-$nextp;
            // print_r($no);
            $left_column .=' 
            </table>
            <br>
            <br>
            <table style="width: 50%;" > 
                <tr>
                    <td align="center">TTD</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>  
                <tr>
                    <td></td>
                </tr>   
                <tr>
                    <td align="center">'.$master['nama_dokter'].'</td>
                </tr>
            </table><br><br><br>
            <table>
                <tr>
                    <td width="30%">No. RM</td>
                    <td width="70%">: <b>'.$master['no_mr'].'</b></td>
                </tr>
                <tr>
                    <td>No. Billing</td>
                    <td>: '.$master['id_mrs'].'</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>: '.$master['nama_lengkap'].'</td>
                </tr>
                <tr>
                    <td>Tgl. Lahir</td>
                    <td>: '.tanggal($master['tgl_lahir']).'</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>: '.$master['umur'].'</td>
                </tr>
                <tr>
                    <td>Berat bdn</td>
                    <td>: Gamau Bilang</td>
                </tr>
                <tr>
                    <td>Ruang</td>
                    <td>: '.$master['nama_kamar'].'</td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: '.$master['kelas'].'</td>
                </tr>
                <tr>
                    <td>Bed</td>
                    <td>: '.$master['bed'].'</td>
                </tr>
            </table>
            </b>
            ______________________________________________<br>
            <b>Kontrol Penyiapan Resep</b>
            <br>
            <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                <tr style="border:1px black solid;">
                    <th width="40%" align="center" ><b>Proses</b></th>
                    <th width="40%" align="center" ><b>Nama</b></th>
                    <th width="20%" align="center" ><b>Jam</b></th>
                </tr>
                <tr style="border:1px black solid;">
                    <td>Penerimaan Resep</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td>Pengkajian Resep</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td>Pengerjaan Resep</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td>Verifikasi Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td>Penyerahan Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td>Penerimaan Obat</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>';
            $right_column = '
            <style>
                .atas table, 
                .atas thead, 
                .atas tr,
                .atas td, 
                .atas th {
                    border:0.5px solid black;
                    font-size: 8px;
                }

                .bawah table, 
                .bawah thead, 
                .bawah tr, 
                .bawah th {
                    border:0.5px solid white;
                    font-size: 6px;
                }
                .master table, 
                .master thead, 
                .master tr, 
                .master th {
                    font-size: 8px;
                }
                .border{
                    border:1px solid black;
                }
                div.kanan {
                  text-align: right;
                } 
            </style>
            <div class="kanan">
                <b>Check List Telaah Resep</b>
            </div>
            <br>
                <b>A. Persyaratan Administratif Resep</b>
                <br>
            <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                <tr style="border:1px black solid;">
                    <th width="9%"  align="center" ><b>No</b></th>
                    <th width="70%" align="center" ><b>Persyaratan Administratif Resep</b></th>
                    <th width="11%" align="center" ><b>Ada</b></th>
                    <th width="14%" align="center" ><b>Tidak</b></th>
                </tr>
                <tr style="border:1px black solid;">
                    <td class="border" align="center">1</td>
                    <td><b>Nama Pasien</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">2</td>
                    <td>Jenis Kelamin Pasien</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">3</td>
                    <td>Tanggal Lahir Pasien</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">4</td>
                    <td>tinggi Badan dan Berat Badan Pasien</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">5</td>
                    <td>Nama Dokter</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">6</td>
                    <td>Nomer SIP Dokter</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">7</td>
                    <td>Paraf/ Tanda Tangan Dokter</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">8</td>
                    <td>Nama Klinik/ Ruangan Asal Resep</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">9</td>
                    <td>Tanggal Penulisan Resep</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td colspan="4">Tindak Lanjut :</td>
                </tr>
            </table>
            <br><br>
            <b>B. Persyaratan Farmasetis Resep</b>
            <br>
            <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                <tr style="border:1px black solid;">
                    <th width="9%"  align="center" ><b>No</b></th>
                    <th width="70%" align="center" ><b>Persyaratan Farmasetisi Resep</b></th>
                    <th width="11%" align="center" ><b>Ada</b></th>
                    <th width="14%" align="center" ><b>Tidak</b></th>
                </tr>
                <tr style="border:1px black solid;">
                    <td class="border" align="center">1</td>
                    <td>Nama Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">2</td>
                    <td>Bentuk Sediaan</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">3</td>
                    <td>Kekuatan Sediaan</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">4</td>
                    <td>Dosis Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">5</td>
                    <td>Jumlah Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">6</td>
                    <td>Stabilitas dan Ketersediaan</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">7</td>
                    <td>Aturan/ Cara & Teknik Penggunaan</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td colspan="4">Tindak Lanjut :</td>
                </tr>
            </table>
            <br><br>
            <b>C. Persyaratan Klinis Resep</b>
            <br>
            <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                <tr style="border:1px black solid;">
                    <th width="9%"  align="center" ><b>No</b></th>
                    <th width="70%" align="center" ><b>Persyaratan Klinis Resep</b></th>
                    <th width="11%" align="center" ><b>Ada</b></th>
                    <th width="14%" align="center" ><b>Tidak</b></th>
                </tr>
                <tr style="border:1px black solid;">
                    <td class="border" align="center">1</td>
                    <td>Duplikasi</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">2</td>
                    <td>Kontraindikasi</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">3</td>
                    <td>Alergi</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">4</td>
                    <td>Interaksi Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td colspan="4">Tindak Lanjut :</td>
                </tr>
            </table>
            <br><br>
            <div class="kanan">
                <b>Check List Penyerahan Obat</b>
            </div>
            <br>
            <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                <tr style="border:1px black solid;">
                    <th width="9%"  align="center" ><b>No</b></th>
                    <th width="70%" align="center" ><b>Kriteria Verifikasi</b></th>
                    <th width="11%" align="center" ><b>Ada</b></th>
                    <th width="14%" align="center" ><b>Tidak</b></th>
                </tr>
                <tr style="border:1px black solid;">
                    <td class="border" align="center">1</td>
                    <td>Benar Pasien</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">2</td>
                    <td>Benar Obat</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">3</td>
                    <td>Benar Dosis</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">4</td>
                    <td>Benar Rute Pemberian</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td align="center">5</td>
                    <td>Benar Waktu Pemberian</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border:1px black solid;">
                    <td colspan="4">Tindak Lanjut :</td>
                </tr>
            </table>
            ';
            
$first_column_width = 75;
$second_column_width = 75;
$column_space = 8;
// print_r($nextp);
$current_y_position = $pdf->getY();
$pdf->writeHTMLCell($first_column_width, 0, 2, 5, $left_column, 0, 0, 0);
$pdf->Cell(0); // THIS LINE SOLVES THE SECOND COLUMN SPACE PROBLEM
$pdf->writeHTMLCell($second_column_width, 0, $first_column_width+$column_space, 5, $right_column, 0, 0, 0);
if($tr>=77){
    $pdf->AddPage("P", "ERESEP");
    $pdf->writeHTMLCell($second_column_width, 0, $first_column_width+$column_space, 5, $right_column, 0, 0, 0);
    
}
// print_r($tr);
$ulang = ceil(($tr-77)/126);
for ($i=0; $i <$ulang-1 ; $i++) { 
    $pdf->AddPage("P", "ERESEP");
    $pdf->writeHTMLCell($second_column_width, 0, $first_column_width+$column_space, 5, $right_column, 0, 0, 0);
}

            $pdf->Output("assets/laporan/"."Laporan Rekap Bon per Unit.pdf", "F");

            $return["success"] = TRUE;

            echo json_encode($return);
    }

    function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter_cetak();
        $master = $result['data'][0];
        // print_r($result);
        $param            = $this->input->post();

        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];


        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Rekap Bon per Unit.xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 30, 10);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("L", "A5");
            $pdf->SetFont("helvetica", "", 9);
        }
        
        $html='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.5px solid black;
                font-size: 7px;
            }

           .bawah table, 
           .bawah thead, 
           .bawah tr, 
           .bawah th {
                border:0.5px solid white;
                font-size: 6px;
            }
           .master table, 
           .master thead, 
           .master tr, 
           .master th {
                font-size: 7px;
            }
            .border {
                border:0.6px solid black
            }
        </style>
        <div align="center"><b><u>REKAPITULASI PEMAKAIAN OBAT/ALKES PER UNIT'; 
        $html.='</u></b><br>';
            $html.='Unit Asal '.$result['data'][0]['depo'].' <br>';

        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $sebelum =0;
        $html.='</div><br>';
            $i=0;
                    $no=1;

        foreach ($result['data'] as $key) {
            if($key['no_urut']==2){
            $html.='<table class="master" cellspacing="0" style="width: 100%; ">
                <tr>
                    <th align="left" width="7%"><b>Ruang</b></th>
                    <th align="left" width="10%"><b>: '.$key['ruang'].'</b></th>
                </tr>
                </table>
                ';
                $sebelum=1;
            }
                
            $html.='<table class="atas" cellspacing="0" style="width: 100%;">';
                    if($sebelum==1 && $key['no_urut']==2){
                        $html.='
                        <tr>
                            <th class="border" align="center" width="3%"><b>No</b></th>
                            <th class="border" align="center" width="77%"><b>Nama Obat/Alkes</b></th>
                            <th class="border" align="center" width="10%"><b>QTY</b></th>
                            <th class="border" align="center" width="10%"><b>Satuan</b></th>
                        </tr>';
                    }
                    if($key['no_urut']==3){
                    $html.='
                    <tr >
                        <td align="left" width="3%">'.$no.'</td>
                        <td align="left" width="77%">'.$key['nama_item'].'</td>
                        <td align="right" width="10%">'.angka($key['jml'],0).'</td>
                        <td align="center" width="10%">'.$key['nama_satuan'].'</td>
                    </tr>
                    ';
                    $sebelum=2;
                    $no++;
                    }
                    $html.='
                    </table>';
            
        }
        // $pdf->Header();
        // echo $html;

        if ($param['type_file']==2)
        {
            # code...
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Rekap Bon per Unit.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }
}

/* End of file Lap_rekap_bon_pasien_per_unit.php */
/* Location: ./application/apps/farmasi/controllers/depo/Lap_rekap_bon_pasien_per_unit.php */