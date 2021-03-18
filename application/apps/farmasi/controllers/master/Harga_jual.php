<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_jual extends MY_Controller {

	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
    }
	public function index()
    {
        $this->data['js'] = 'master/harga_jual_js';
        $this->data['main_view'] = 'master/v_harga_jual';
		$this->load->view('template', $this->data);
	}

	public function getKelompok()
    {
        $param = $this->input->post();
        $param['user_id']   = $this->session->userdata['user_id'] ?? '';

        $response = sendRequest("POST", 'lps', "master/harga_jual/list_kel_item", $param,true);
        $daftar_unit = [];

        foreach ($response['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_kel_item'],
                'text' => $unit['nama_kel_item'],
            ];
        }
        echo json_encode($daftar_unit);
	}

	public function getSupplier()
	{
		$headers  = getHeaderToken();
       	$API = BASE_URL_API_LPS.'master/harga_jual/list_supplier/'.$_POST['id'];

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
        // print_r($result)
        foreach ($result['data'] as $unit) {
            $data[] = (object) [
                'id' => $unit['partner_id'],
                'text' => $unit['partner_name'],
            ];
        }
        echo json_encode($data);
	}

	public function getDepo()
	{
		$headers  = getHeaderToken();
       	$API = BASE_URL_API_LPS.'master/harga_jual/list_depo/'.$_POST['id'];

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
        // print_r($result)
        foreach ($result['data'] as $unit) {
            $data[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($data);
	}

	public function filter()
    {
        $param = $this->input->post();

        $response = sendRequest("POST", 'lps', "master/harga_jual/search", $param);
        
        echo json_encode($response);
        // echo json_encode($this->getData($this->input->post()));
    }

    public function filterHargaBeli()
    {
        $param = $this->input->post();

        // $data['id_item'] = $param['id_item'] ?? 0;
        // $data['page'] = $param['page'] ?? 1;
        // $data['page_row'] = $param['rows'] ?? 10;
        // $data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data); die();

        $headers  = getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/master/harga_jual/list_hna');
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
        // var_dump($buffer);die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function filterHargaPokok()
    {
        $param = $this->input->post();

        // $data['id_item'] = $param['id_item'] ?? 0;
        // $data['page'] = $param['page'] ?? 1;
        // $data['page_row'] = $param['rows'] ?? 10;
        // $data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data); die();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/master/harga_jual/list_hpp');
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
        // var_dump($buffer);die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function filterHargaJualHNA()
    {
    	$param = $this->input->post();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/master/harga_jual/list_ubah_harga');
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

        $result= json_decode($buffer);;
        echo json_encode($result);
    }

    public function getData($param)
    {
    	// $param = $this->input->post();
    	$data['status'] = $param['status'] ?? 0;
        $data['start_date'] = $param['start_date'] ?? '';
        $data['end_date'] = $param['end_date'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data); die();

        $headers  = getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'/master/harga_jual/search');
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
        // var_dump($buffer);die();
        // var_dump($buffer);die();
        return json_decode($buffer);
    }

    public function cetakPDF($value='')
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $param = $this->input->post();
        $data = $this->getData($param);
        // print_r($data->data[0]->id_item);die;
        $this->load->library('Pdf');
        // $thi

        if ($param['type_file']==2)
        {
            # code...
            // print_r($param);
            // print_r($data);die;
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$param['file_name'].".xls");
        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(3, 45, 3);
            // $pdf->AddPage("P", "A6");
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
                border:0.6px solid black;
                font-size: 8px;
            }
            td{
              border: 0.6px solid black;
            }
        </style>
        <div align="center"><b><u>DAFTAR HARGA JUAL BARANG FARMASI</b></u><br>
        Tanggal, '.convert_date_to_indonesia(date("m/d/Y")).'</div><br>';
        $hue .= '<table class="master" cellspacing="0" style="width: 100%;;">
                    <tr>
                    	<th align="center" rowspan="2" width="4%"><b>No</b></th>
                        <th colspan="6" align="center" width="54%"><b>Item</b></th>
                        <th colspan="3" align="center" width="21%"><b>Karyawan</b></th>
                        <th colspan="3" align="center" width="21%"><b>Umum</b></th>
                    </tr>
                    <tr>
                        <th align="center" width="6%"><b>Kode</b></th>
                        <th align="center" width="15%"><b>Nama Item</b></th>
                        <th align="center" width="7%"><b>Satuan</b></th>
                        <th align="center" width="10%"><b>Harga Dasar Jual</b></th>
                        <th align="center" width="9%"><b>HNA Rata-Rata</b></th>
                        <th align="center" width="7%"><b>Kelompok</b></th>

                        <th align="center" width="7%"><b>Margin (%)</b></th>
                        <th align="center" width="7%"><b>Rawat Jalan</b></th>
                        <th align="center" width="7%"><b>Rawat Inap</b></th>

                        <th align="center" width="7%"><b>Margin (%)</b></th>
                        <th align="center" width="7%"><b>Rawat Jalan</b></th>
                        <th align="center" width="7%"><b>Rawat Inap</b></th>
                    </tr>';

			foreach ($data->data as $key => $value) {
				$hue.='<tr>
						<td align="center">'.($key+1).'</td>
                        <td align="center">'.$value->id_item.'</td>
                        <td align="left">'.$value->nama_item.'</td>
                        <td align="center">'.$value->id_satuan.'</td>
                        <td align="right">'.angka($value->hna).'</td>
                        <td align="right">'.angka($value->hna_rata2).'</td>
                        <td align="center">'.$value->nama_kel_item.'</td>

                        <td align="center">'.angka($value->karyawan_p_margin).'</td>
                        <td align="right">'.angka($value->karyawan_harga_rj).'</td>
                        <td align="right">'.angka($value->karyawan_harga_ri).'</td>

                        <td align="center">'.angka($value->umum_p_margin).'</td>
                        <td align="right">'.angka($value->umum_harga_rj).'</td>
                        <td align="right">'.angka($value->umum_harga_ri).'</td>
                    </tr>';
			}

        $hue .='</table>';
        if ($param['type_file']==2)
        {
            echo $hue;
        }
        else
        {
	        $pdf->writeHTML($hue, true, false, true, false);
	        $pdf->Output("assets/file/".$param['file_name'], "F");
	        $return["success"] = TRUE;
	        $return['file_name'] = $param['file_name'];
	        echo json_encode($return);
	    }

    }

}

/* End of file Harga_jual.php */
/* Location: ./application/apps/farmasi/controllers/master/Harga_jual.php */