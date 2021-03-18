<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_pasien_mrs extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }
	public function index()
	{
		$this->data['js'] = 'depo/index_pasien_mrs_js';
        $this->data['main_view'] = 'depo/v_index_pasien_mrs';
        $this->load->view('template', $this->data);
	}

	public function Filter()
    {
        $param = $this->input->post();

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        // echo json_encode($data); die();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/idx_pasien_mrs/search');
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
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function load_detail()
    {
        $param = $this->input->post();

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['no_mr'] = $param['no_mr'] ?? '';
        $data['type'] = $param['type'] ?? '';

        // echo json_encode($data); die();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'depo_farmasi/idx_pasien_mrs/list');
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
        $result=json_decode($buffer);
        // echo json_encode($result);
        if($param['type']==1)
        {
            echo json_encode($result);
        }
        else
        {
            return $result;
        }
    }

    public function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->load_detail();
        // print_r($result);die;

        $param            = $this->input->post();
        /*$lap              = $param['url'];*/
        $nama_pasien	= $param['nama_pasien'];
        $no_mr			= $param['no_mr'];
        

        $this->load->library('Pdf');
        $pdf = tcpdf();
        //initialize document
        $pdf->setMargins(10, 30, 10);
        // $pdf->AddPage("P", "A6");
        $pdf->AddPage("P", "F4");
        $pdf->SetFont("helvetica", "", 9);    

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
                font-size: 7px;
            }
           .master table, 
           .master thead, 
           .master tr, 
           .master th {
                font-size: 7px;
            }
            .border{
            	border:0.5px solid black;
            }
        </style>
        <div align="center"><b><u>Index Pasien MRS'; 
        $html.='</u></b></div><br>';
        $html.='<table class="master" cellspacing="0">
            <tr>
                <th align="left" width="15%">No RM</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%">'.$no_mr.'</th>
                
            </tr>
            <tr>
                <th align="left" width="15%">Nama Pasien</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%">'.$nama_pasien.'</th>
            </tr>
        </table>
        ';

        $tanggal = '';
        $no_nota = '';
        foreach ($result->data as $key => $value) {
        	if ($tanggal != tanggal($value->tgl_nota)) {
        		$tanggal = tanggal($value->tgl_nota);
        		$html.='<br><br>';
        		$html.='<b>'.$tanggal.'</b><br>';
        		$html .= '<table class="master" cellspacing="0">
				            <tr>
				                <th class="border" align="left" align="center" rowspan="2"><b>No Nota</b></th>
				                <th class="border" align="left" align="center" rowspan="2"><b>Nama Obat/Alkes</b></th>
				                <th class="border" align="left" align="center" colspan="3"><b>Qty</b></th>
				                <th class="border" align="left" align="center" rowspan="2"><b>Signa</b></th>
				            </tr>
				            <tr>
				                <th class="border" align="left" align="center"><b>7</b></th>
				                <th class="border" align="left" align="center"><b>23</b></th>
				                <th class="border" align="left" align="center"><b>Total</b></th>
				            </tr>';
				$html .='</table>';
        	}
        	if ($no_nota != $value->no_nota) {
        		$no_nota = $value->no_nota;
        	}
        	$total = (float)$value->jml_23 + (float)$value->jml_7;
        	$html .= '<table class="atas" cellspacing="0" style="width: 100%;border:0.5px solid black;">';
        	$html.='<tr >
                            <td class="border" align="center">'.$no_nota.'</td>
                            <td class="border" align="left">'.$value->nama_item.'</td>
                            <td class="border" align="center">'.angka($value->jml_7).'</td>
                            <td class="border" align="center">'.angka($value->jml_23).'</td>
                            <td class="border" align="center">'.angka($total).'</td>
                            <td class="border" align="center">'.$value->signa.'</td>
                        </tr>'; 
            $html .='</table>';
        }

        $pdf->writeHTML($html, true, false, true, false);
    
        $pdf->Output("assets/laporan/"."Laporan Index Pasien MRS.pdf", "F");
        $return["success"] = TRUE;

        echo json_encode($return);   
    }
}

/* End of file Index_pasien_mrs.php */
/* Location: ./application/apps/farmasi/controllers/depo/Index_pasien_mrs.php */