<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemakaian_gas_medik extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');
    }

	function index()
	{
		$this->data['js'] = 'depo/pemakaian_gas_medik_js';
        $this->data['main_view'] = 'depo/v_pemakaian_gas_medik';
        $this->load->view('template', $this->data);
	}

	function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/mrs_aktif');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

    function get_ruang()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/unit_rawat_user');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        $daftar_ruang   = [];
        foreach ($result['data'] as $unit) {
            $daftar_ruang[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_ruang);
    }

    function get_klinik()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/kamar/list/0');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        $daftar_ruang   = [];
        foreach ($result['data'] as $unit) {
            $daftar_ruang[] = (object) [
                'id'   => $unit['id_kamar'].'-'.$unit['id_unit'],
                'text' => $unit['kamar_display'],
                'id_kamar' => $unit['id_kamar'],
                'id_unit' => $unit['id_unit'],
            ];
        }
        echo json_encode($daftar_ruang);
    }

    function get_dokter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/dokter/list');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        $daftar_dokter   = [];
        foreach ($result['data'] as $unit) {
            $daftar_dokter[] = (object) [
				'id'    => $unit['id_karyawan'],
				'text'  => $unit['nama_karyawan'],
				'nik'   => $unit['nik'],
				'jenis' => $unit['jenis'],
            ];
        }
        echo json_encode($daftar_dokter);
    }

    function get_gasmed()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'config/gasmed');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        echo json_encode($result);
    }

    function get_harga()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $data = $_POST;
        $data['user_id']=$this->session->userdata['user_id'];
		// print_r($data);
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/nota/harga_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        echo json_encode($result);
    }

    function getPerKode()
    {
        $API = BASE_URL_API_LPS.'depo_farmasi/gasmed/list/'.$_POST['data'];
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
        if (count($result['mrs'])> 0)
        {
            $data['gasmed']=$result['gasmed'];
            $data['mrs']=$result['mrs'];
        }
        echo json_encode($data);
    }

    function getPerNota()
    {
        $API = BASE_URL_API_LPS.'depo_farmasi/gasmed/'.$_POST['data'];
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
        echo json_encode($result['data']);
    }

    function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        // print_r($_POST);die();
        if($_POST['edit']==0)
        {
	        $API=BASE_URL_API_LPS.'depo_farmasi/gasmed/'.$_POST['tipe'];   
        }
        else
        {
            $API=BASE_URL_API_LPS.'depo_farmasi/gasmed';   
        }
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        if($_POST['edit']==1){
        	curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
        }
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

    function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/gasmed/'.$_POST['data']['no_nota']);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
    	curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
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

    function filter_cetak()
    {
        $API = BASE_URL_API_LPS.'depo_farmasi/gasmed/cetak_nota/'.$_POST['no_nota'];
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));

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
            # code...
            // echo json_encode($result);
            return $result;

    }

    function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter_cetak();
        $data   = $result['data'];
        // print_r($data);
        $this->load->library('Pdf');
        $pdf = tcpdf();
        //initialize document
        $pdf->SetPrintHeader(false);

        $pdf->setMargins(2, 5, 2);
        // $pdf->AddPage("P", "A6");
        $pdf->AddPage("P", "GASMED");
        $pdf->SetFont("helvetica", "", 8);
    
        $html='
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
                .bottomdash{
                    border-bottom-style: dashed;
                }
                .topdash{
                    border-top-style: dashed;
                }
                div.kanan {
                  text-align: right;
                }
        </style>
        
        <img src="assets/img/header-wava2.png">
        <br><br>

		<table>
			<tr>
				<td colspan="5" align="center" class="topdash bottomdash">'.$data['judul_cetak'].'</td>
			</tr>
			<tr>
				<td width="15%">No. Nota</td>
				<td width="33%">: '.$data['no_nota'].'</td>
				<td width="12%">Tanggal</td>
				<td colspan="2">: '.tanggal($data['tgl_nota']).'</td>
			</tr>
			<tr>
				<td class="bottomdash">No. Billing</td>
				<td class="bottomdash">:'.$data['id_mrs'].'</td>
				<td class="bottomdash">No. RM</td>
				<td class="bottomdash" width="17%">: '.$data['no_mr'].'</td>
				<td class="bottomdash" width="23%">Kelas : '.$data['kelas'].'</td>
			</tr>
		</table>
        <br><br>

		<table >
			<tr>
				<td width="20%">Nama Pasien </td>
				<td width="80%">: '.$data['nama_pasien'].'</td>
			</tr>
			<tr>
				<td>Alamat </td>
				<td>: '.$data['alamat'].'</td>
			</tr>
			<tr>
				<td>Unit/Kamar </td>
				<td>: '.$data['kamar_display'].'</td>
			</tr>
			<tr>
				<td class="bottomdash">Dokter </td>
				<td class="bottomdash">: '.$data['nama_dokter'].'</td>
			</tr>
		</table>
        <br><br>

		<table>
			<tr>
				<td width="20%">Jam Awal </td>
				<td width="2%">:</td>
				<td width="30%">'.tanggal_time($data['tgl_awal_gm']).'</td>
			</tr>
			<tr>
				<td>Jam Akhir</td>
				<td width="2%">:</td>
				<td>'.tanggal_time($data['tgl_akhir_gm']).'</td>
			</tr>
			<tr>
				<td>Jml. Menit </td>
				<td width="2%">:</td>
				<td>'.angka($data['jml_menit'],0).' Menit</td>
			</tr>
			<tr>
				<td>Qty (Ltr.) </td>
				<td width="2%">:</td>
				<td align="right">'.angka($data['jml'],0).'</td>
			</tr>
		</table>
        <br><br>

		<table>
			<tr>
				<td width="20%">Harga </td>
				<td width="2%">:</td>
				<td align="right" width="30%"> '.angka($data['harga'],0).'</td>
			</tr>
			<tr>
				<td>Sub Total</td>
				<td width="2%">:</td>
				<td align="right">'.angka($data['sub_total']).'</td>
			</tr>
			<tr>
				<td>PPN</td>
				<td width="2%">:</td>
				<td align="right">'.angka($data['tot_ppn'],0).'</td>
			</tr>
			<tr>
				<td><b>TOTAL</b></td>
				<td width="2%">:</td>
				<td align="right"><b>'.angka($data['total'],0).'</b></td>
			</tr>
		</table>
		<br><br>

		<table>
			<tr>
				<td width="55%"></td>
				<td align="center" width="45%">Petugas</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td align="center">'.$data['nama_user'].'</td>
			</tr>
			<tr>
				<td></td>
				<td align="center">Tanggal : '.tanggal_time($data['tgl_cetak']).'</td>
			</tr>
		</table>
        '; 
        
        // $pdf->Header();
        // echo $html;
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Pemakaian Gas Medik ".$data['no_nota'].".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
    }

}

/* End of file Pemakaian_gas_medik.php */
/* Location: ./application/apps/farmasi/controllers/depo/Pemakaian_gas_medik.php */