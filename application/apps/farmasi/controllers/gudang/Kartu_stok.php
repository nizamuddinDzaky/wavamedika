<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_stok extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
    }

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/kartu_stok_js';
        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_kartu_stok';
        // Load View
        $this->load->view('template', $this->data);
	}

	function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
		$param['start_date'] = $param['start_date'];
		$param['end_date']   = $param['end_date'] ;
		$param['id_unit']    = $param['id_unit'] ;
		$param['criteria']   = $param['criteria'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/mutasi/farmasi/kartu_stok');
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

    function filter_detail()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
        $param['start_date'] = $param['start_date'];
        $param['end_date']   = $param['end_date'] ;
        $param['id_unit']    = $param['id_unit'] ;
        $param['id_item']    = $param['id_item'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/mutasi/farmasi/kartu_stok_detail');
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

    function filter_detail2()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        $param['start_date'] = $param['start_date'];
        $param['end_date']   = $param['end_date'] ;
        $param['id_unit']    = $param['id_unit'] ;
        $param['id_item']    = $param['id_item'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/mutasi/farmasi/kartu_stok_detail');
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

        $result=json_decode($buffer,true);
        return $result;
    }

    function filter_detail_stok()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
        $param['start_date'] = $param['start_date'];
        $param['end_date']   = $param['end_date'] ;
        $param['id_unit']    = $param['id_unit'] ;
        $param['id_item']    = $param['id_item'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/mutasi/farmasi/kartu_stok_unit');
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

    function filter_detail_stok2()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
        $param['start_date'] = $param['start_date'];
        $param['end_date']   = $param['end_date'] ;
        $param['id_unit']    = $param['id_unit'] ;
        $param['id_item']    = $param['id_item'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/mutasi/farmasi/kartu_stok_unit');
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

        $result=json_decode($buffer,true);
        return $result;
    }

    function get_data_unit()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/list_unit_farmasi');
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => 0,
            'text' => 'All',
        ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    function filter2()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
        $param['start_date'] = $param['start_date'];
        $param['end_date']   = $param['end_date'] ;
        $param['id_unit']    = $param['id_unit'] ;
        $param['criteria']   = $param['criteria'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/mutasi/farmasi/kartu_stok');
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

        $result=json_decode($buffer,true);
        return $result;
        // echo json_encode($result);
    }

    function print_transaksi1() {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter2();
        // print_r($result);die();
        $ket=$this->ket_laporan();
        // print_r($ket);
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 30, 10);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("P", "F4");
            $pdf->SetFont("helvetica", "", 9);
        }
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.5px solid black;
                font-size: 6px;
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
                font-size: 6px;
            }
        </style>
        <div align="center"><b><u>Kartu Stok'; 
        $hue.='</u></b><br>';
        $hue.='Tanggal '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        $hue.='</div><br>';
            $i=0;
        if ($ket['type_file']==2)
        {

                $hue.='<table border="1" style="width: 100%;">';
        }
        else{
                $hue.='<table class="atas" border="1" style="width: 100%;">';
        }
                $hue.='<tr>
                        <th align="center" width="3%"><b>No.</b></th>
                        <th align="center" width="8%"><b>Kode</b></th>
                        <th align="center" width="30%"><b>Deskripsi</b></th>
                        <th align="center" width="10%"><b>Jenis</b></th>
                        <th align="center" width="8%"><b>Satuan</b></th>
                        <th align="center" width="8%"><b>Bentuk Sediaan</b></th>
                        <th align="center" width="8%"><b>Stok Awal</b></th>
                        <th align="center" width="8%"><b>Masuk</b></th>
                        <th align="center" width="8%"><b>Keluar</b></th>
                        <th align="center" width="8%"><b>Stok Akhir</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $hue.='<tr>
                        <td align="center"   width="3%">'.$no.'</td>
                        <td align="left" width="8%">'.$key['kd_item'].' </td>
                        <td align="left"   width="30%">'.$key['nama_item']. '</td>
                        <td align="left"   width="10%">'.$key['nama_kel_item']. '</td>
                        <td align="left"   width="8%">'.$key['nama_satuan']. '</td>
                        <td align="left"   width="8%">'.$key['nama_bentuk_sd']. '</td>
                        <td align="right"  width="8%">'.angka($key['stok_awal']).'</td>
                        <td align="right"  width="8%">'.angka($key['masuk']).'</td>
                        <td align="right"  width="8%">'.angka($key['keluar']).'</td>
                        <td align="right" width="8%">'.angka($key['stok_akhir']).'</td>
                    </tr>'; 
                    $no++;
                    }
                    $hue.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';

        // $pdf->Header();
        // echo $hue;
        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }

    }

    function print_detail() {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        // print_r($_POST);die();
        $result = $this->filter_detail2();
        // print_r($result);die();
        $ket=$this->ket_laporan();
        // print_r($ket);
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 30, 10);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("P", "F4");
            $pdf->SetFont("helvetica", "", 9);
        }
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.5px solid black;
                font-size: 6px;
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
                font-size: 6px;
            }
        </style>
        <div align="center"><b><u>Transaksi Kartu Stok Per Item'; 
        $hue.='</u></b><br>';
        $hue.='Tanggal '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        $hue.='</div><br>';
                $hue.='
                <table class="master" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr>
                        <th align="left" width="11%">Kode /Nama Item</th>
                        <th width="3%">:</th>
                        <th align="left" width="41%">'.$ket['kd_item'].' /'.$ket['nama_item'].'</th>
                        <th width="20%"></th>
                        <th align="right" width="11%">Stok Awal</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="11%">'.angka($ket['stok_awal']).'</th>
                    </tr><tr>
                        <th align="left" width="11%">Jenis</th>
                        <th width="3%">:</th>
                        <th align="left" width="41%">'.$ket['nama_kel_item'].'</th>
                        <th width="20%"></th>
                        <th align="right" width="11%">Masuk</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="11%">'.angka($ket['masuk']).'</th>
                    </tr><tr>
                        <th align="left" width="11%">Satuan</th>
                        <th width="3%">:</th>
                        <th align="left" width="11%">'.$ket['nama_satuan'].'</th>
                        <th width="50%"></th>
                        <th align="right" width="11%">Keluar</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="11%">'.angka($ket['keluar']).'</th>
                    </tr><tr>
                        <th align="left" width="11%">Bentuk Sediaan</th>
                        <th width="3%">:</th>
                        <th align="left" width="11%">'.$ket['nama_bentuk_sd'].'</th>
                        <th width="50%"></th>
                        <th align="right" width="11%">Stok Akhir</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="11%">'.angka($ket['stok_akhir']).'</th>
                    </tr>
                </table>';
                $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th align="center" width="11%"><b>Unit</b></th>
                        <th align="center" width="11%"><b>Tanggal</b></th

                        >
                        <th align="center" width="25%"><b>Keterangan</b></th>
                        <th align="center" width="11%"><b>No. Referensi</b></th>
                        <th align="center" width="11%"><b>No. RM</b></th>
                        <th align="center" width="15%"><b>Nama Pasien</b></th>
                        <th align="center" width="8%"><b>Masuk</b></th>
                        <th align="center" width="8%"><b>Keluar</b></th>
                    </tr>';
                    $no=1;
                    $tot_masuk=0;
                    $tot_keluar=0;
                    foreach ($result['data'] as $key) {
                    $hue.='<tr>
                        <th align="left"   width="11%">'.$key['nama_unit'].' </th>
                        <th align="center" width="11%">'.tanggal_time($key['tgl_stok']).'</th>
                        <th align="left"   width="25%">'.$key['trans_desc']. '</th>
                        <th align="left"   width="11%">'.$key['no_ref']. '</th>
                        <th align="left"   width="11%">'.$key['no_rm']. '</th>
                        <th align="right"  width="15%">'.$key['nama_pasien'].'</th>
                        <th align="right"  width="8%">'.angka($key['masuk']).'</th>
                        <th align="right"  width="8%">'.angka($key['keluar']).'</th>
                    </tr>'; 
                    $tot_masuk  += $key['masuk'];
                    $tot_keluar += $key['keluar'];

                    $no++;
                    }
                    $hue.='
                    <tr>
                        <th align="right"  colspan="6" style="border: 1px solid black"><b>TOTAL</b></th>
                        <th align="right"  width="8%">'.angka($tot_masuk).'</th>
                        <th align="right"  width="8%">'.angka($tot_keluar).'</th>
                    </tr>
                    </table>
                    <br></br>
                    <br></br>
                    <br></br>';

        // $pdf->Header();
        // echo $hue;
        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }

    }

    function print_stok() {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        // print_r($_POST);die();
        $result = $this->filter_detail_stok2();
        // print_r($result);die();
        $ket=$this->ket_laporan();
        // print_r($ket);
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 30, 10);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("P", "F4");
            $pdf->SetFont("helvetica", "", 9);
        }
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.5px solid black;
                font-size: 6px;
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
                font-size: 6px;
            }
        </style>
        <div align="center"><b><u>Transaksi Kartu Stok Unit Per Item'; 
        $hue.='</u></b><br>';
        $hue.='Tanggal '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        $hue.='</div><br>';
                $hue.='
                <table class="master" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr>
                        <th align="left" width="11%">Kode</th>
                        <th width="2%">:</th>
                        <th align="left" width="41%">'.$ket['kd_item'].'</th>
                        <th width="20%"></th>
                        <th align="right" width="11%">Stok Awal</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="12%">'.angka($ket['stok_awal']).'</th>
                    </tr><tr>
                        <th align="left" width="11%">Nama Item</th>
                        <th width="2%">:</th>
                        <th align="left" width="41%">'.$ket['nama_item'].'</th>
                        <th width="20%"></th>
                        <th align="right" width="11%">Masuk</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="12%">'.angka($ket['masuk']).'</th>
                    </tr><tr>
                        <th align="left" width="11%">Satuan</th>
                        <th width="2%">:</th>
                        <th align="left" width="20%">'.$ket['nama_satuan'].'</th>
                        <th align="right" width="11%">Jenis</th>
                        <th width="2%">:</th>
                        <th align="left" width="11%">'.$ket['nama_kel_item'].'</th>
                        <th width="17%"></th>
                        <th align="right" width="11%">Keluar</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="12%">'.angka($ket['keluar']).'</th>
                    </tr><tr>
                        <th align="left" width="11%">Bentuk Sediaan</th>
                        <th width="2%">:</th>
                        <th align="left" width="11%">'.$ket['nama_bentuk_sd'].'</th>
                        <th width="50%"></th>
                        <th align="right" width="11%">Stok Akhir</th>
                        <th align="center" width="3%">:</th>
                        <th align="left" width="12%">'.angka($ket['stok_akhir']).'</th>
                    </tr>
                </table>';
                $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th align="center" width="60%"><b>Nama Unit</b></th>
                        <th align="center" width="10%"><b>Stok Awal</b></th>
                        <th align="center" width="10%"><b>Masuk</b></th>
                        <th align="center" width="10%"><b>Keluar</b></th>
                        <th align="center" width="10%"><b>Stok Akhir</b></th>
                    </tr>';
                    $no=1;
                    $tot_stok_awal=0;
                    $tot_stok_akhir=0;
                    $tot_masuk=0;
                    $tot_keluar=0;
                    foreach ($result['data'] as $key) {
                    $hue.='
                    <tr>
                        <th align="left"    width="60%">'.$key['nama_unit'].' </th>
                        <th align="right"   width="10%">'.angka($key['stok_awal']).'</th>
                        <th align="right"   width="10%">'.angka($key['masuk']).'</th>
                        <th align="right"   width="10%">'.angka($key['keluar']).'</th>
                        <th align="right"   width="10%">'.angka($key['stok_akhir']).'</th>
                    </tr>'; 
                    $tot_stok_awal += $key['stok_awal'];
                    $tot_stok_akhir += $key['stok_akhir'];
                    $tot_masuk += $key['masuk'];
                    $tot_keluar += $key['keluar'];
                    }
                    $hue.='
                    <tr>
                        <th align="right"  ><b>TOTAL</b></th>
                        <th align="right"  width="10%">'.angka($tot_stok_awal).'</th>
                        <th align="right"  width="10%">'.angka($tot_masuk).'</th>
                        <th align="right"  width="10%">'.angka($tot_keluar).'</th>
                        <th align="right"  width="10%">'.angka($tot_stok_akhir).'</th>
                    </tr>
                    </table>
                    <br></br>
                    <br></br>
                    <br></br>';

        // $pdf->Header();
        // echo $hue;
        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }

    }

    function ket_laporan(){
        $data = [];                     
        $param                  = $this->input->post();
        $data['start_date']     = $param['start_date'];
        $data['end_date']       = $param['end_date'] ;
        $data['id_unit']        = $param['id_unit'] ;
        $data['criteria']       = $param['criteria']??"";
        $data['file_cetak']     = $param['file_cetak']??"";
        $data['type_file']      = $param['type_file']??"";
        //master
        $data['kd_item']        = $param['master'][0]['kd_item']??"";
        $data['nama_item']      = $param['master'][0]['nama_item']??"";
        $data['keluar']         = $param['master'][0]['keluar']??"";
        $data['masuk']          = $param['master'][0]['masuk']??"";
        $data['nama_bentuk_sd'] = $param['master'][0]['nama_bentuk_sd']??"";
        $data['nama_kel_item']  = $param['master'][0]['nama_kel_item']??"";
        $data['nama_satuan']    = $param['master'][0]['nama_satuan']??"";
        $data['stok_akhir']     = $param['master'][0]['stok_akhir']??"";
        $data['stok_awal']      = $param['master'][0]['stok_awal']??"";

        return $data;
    }

}

/* End of file Kartu_stok.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Kartu_stok.php */