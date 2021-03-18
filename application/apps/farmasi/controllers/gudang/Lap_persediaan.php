<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_persediaan extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
    }

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/lap_persediaan_js';
        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_lap_persediaan';
        // Load View
        $this->load->view('template', $this->data);
	}

	function getSupplier(){
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

        $result=json_decode($buffer,true);
        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '0',
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

    public function filter(){
        // echo json_encode($param); die();
        // var_dump($buffer);die();
        // $result=json_decode($buffer);
        echo json_encode($this->getData($this->input->post()));
    }

    public function getData($param){
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/laporan/mutasi/farmasi/persediaan');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
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
        return json_decode($buffer);
    }

    public function cetakPDF($value=''){
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $param = $this->input->post();
        $data = $this->getData($param);
        // print_r($data->data[0]->id_item);die;
        $this->load->library('Pdf');
        // $thi

        if ($param['type_file']==2){
            # code...
            // print_r($param);die;
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$param['file_name'].".xls");

        }
        else{
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(3, 30, 3);
            // $pdf->AddPage("P", "F4");
            $pdf->AddPage("L", "F4");
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
            td, th {
			  border: 1px solid #000000;
			  text-align: left;
			  padding: 8px;
			}

        </style>
        <br><br><br><br>
        <div align="center"><b><u>LAPORAN NILAI PERSEDIAAN';
        $hue.='</u></b><br>';
        $hue.='Tanggal '.convert_date_to_indonesia($param['start_date']).' s/d '.convert_date_to_indonesia($param['end_date']).'';
        $hue.='</div><br>';

        $hue .= '<table id="dtg-lap_persediaan" height="500" width="100%">
                    <tr>
                    	<th rowspan="2" align="center" width="4%"><b>No</b></th>
                        <th colspan="5" align="center" width="39%"><b>Item</b></th>
                        <th colspan="2" align="center"><b>Stok Awal</b></th>
                        <th colspan="4" align="center"><b>Stok Periode Ini</b></th>
                        <th colspan="2" align="center"><b>Stok Akhir</b></th>
                    </tr>
                    <tr>
                        <th halign="center" align="center" width="5%"><b>Kode</b></th>
                        <th halign="center" align="center" width="13%"><b>Nama Item</b></th>
                        <th halign="center" align="center" width="6.2%"><b>Satuan</b></th>
                        <th halign="center" align="center" width="7%"><b>Jenis</b></th>
                        <th halign="center" align="center"><b>Unit</b></th>

                        <th halign="center" align="center"><b>Jumlah</b></th>
                        <th halign="center" align="center"><b>Nilai Persediaan</b></th>

                        <th halign="center" align="center"><b>Jumlah Masuk</b></th>
                        <th halign="center" align="center"><b>Nilai Persediaan Masuk</b></th>
                        <th halign="center" align="center"><b>Jumlah Keluar</b></th>
                        <th halign="center" align="center"><b>Nilai Persediaan Keluar</b></th>

                        <th halign="center" align="center"><b>Jumlah</b></th>
                        <th halign="center" align="center"><b>Nilai Persediaan</b></th>
                    </tr>';
         	foreach ($data->data as $key => $value) {
			$hue.='<tr>
						<td halign="center" align="center">'.($key+1).'</td>
						<td halign="center" align="center">'.$value->id_item.'</td>
                        <td halign="center" align="left">'.$value->nama_item.'</td>
                        <td halign="center" align="center">'.$value->id_satuan.'</td>
                        <td halign="center" align="center">'.$value->nama_kel_item.'</td>
                        <td halign="center" align="center">'.$value->nama_unit.'</td>

                        <td halign="center" align="right">'.angka($value->stok_awal).'</td>
                        <td halign="center" align="right">'.angka($value->persediaan_awal).'</td>

                        <td halign="center" align="right">'.angka($value->masuk).'</td>
                        <td halign="center" align="right">'.angka($value->persediaan_masuk).'</td>
                        <td halign="center" align="right">'.angka($value->keluar).'</td>
                        <td halign="center" align="right">'.angka($value->persediaan_keluar).'</td>

                        <td halign="center" align="right">'.angka($value->stok_akhir).'</td>
                        <td halign="center" align="right">'.angka($value->persediaan_akhir).'</td>
                </tr>';
		}

		$hue .='</table>';
        if ($param['type_file']==2){
            echo $hue;
        }
        else{
	        $pdf->writeHTML($hue, true, false, true, false);
	        $pdf->Output("assets/file/".$param['file_name'], "F");
	        $return["success"] = TRUE;
	        $return['file_name'] = $param['file_name'];
	        echo json_encode($return);
	    }
    }

}

/* End of file Lap_persediaan.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Lap_persediaan.php */