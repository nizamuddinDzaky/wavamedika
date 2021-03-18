<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_pemakaian_pasien extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');
    }

	function index()
	{
		$this->data['js'] = 'depo/retur_pemakaian_pasien_js';
        $this->data['main_view'] = 'depo/v_retur_pemakaian_pasien';
        $this->load->view('template', $this->data);
	}

	function filter(){
		$param = $this->input->post();
        $param['criteria']   = $param['criteria'] ?? '';

        $response = sendRequest("GET", 'lps', "depo_farmasi/retur_nota", $param);

        echo json_encode($response);

	}
    function filter_billing(){
        $param = $this->input->post();
        $param['criteria']   = $param['criteria'] ?? '';
        $response = sendRequest("GET", 'lps', "master/mrs_aktif", $param);

        echo json_encode($response);

    }

    function filter_item(){
        $param = $this->input->post();
        $param['criteria']   = $param['criteria'] ?? '';

        $response = sendRequest("GET", 'lps', "depo_farmasi/retur_nota/cari_item", $param);

        echo json_encode($response);

    }

    function cek_billing(){
        $param = $this->input->post();

        $response = sendRequest("GET", 'lps', "master/mrs/".$param['data'], "",true);
        // print_r($response);
        if($response['row_count']==0){
            echo json_encode($response);
        }else{
            $response['data'] = $response['data'][0];
            echo json_encode($response);
        }

    }

	function getPerKode()
    {
		$response = sendRequest("GET", 'lps', 'depo_farmasi/retur_nota/'.$_POST['data'].'/byid',"",true);
        $data = [];
        if (count($response['master'])> 0)
        {
            $data['master']=$response['master'];
            $data['detail']=$response['detail'];
        }
        echo json_encode($data);
	}
	
	function simpan()
    {
		$method;
		$API;
		$API='depo_farmasi/retur_nota'; 
        if($_POST['edit']==0)
        {
            $method = "POST";  
        }
        else
        {
			$method = "PUT";  
        }
        // print_r($_POST);
        $data['master']  = $_POST['data']['master'];
        $data['detail'] = $_POST['data']['detail'];
        // $data['auths']=$_POST['data']['auths'];
        $response = sendRequest($method, 'lps', $API, $data);
        
        echo json_encode($response);
    }

    function filter_cetak()
    {
        $response = sendRequest("GET",'lps', 'depo_farmasi/retur_nota/'.$_POST['no_retur'].'/cetak_nota','',true);
        return $response;

    }

    function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        
        $response = sendRequest("DELETE", 'lps', 'depo_farmasi/retur_nota/'.$_POST['no_retur'],'');

        echo json_encode($response);
    }

    function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter_cetak();
        $master = $result['master'];
        // print_r($master);
        $detail = $result['detail'];
        // print_r($detail);
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
                .bottomsolid{
                    border-bottom-style: solid;
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
                <td colspan="5" class="topdash bottomdash" align="center"><b><i>RETUR PEMAKAIAN OBAT/ALKES</i></b></td>
            </tr>
            <tr>
                <td width="15%">No. Nota</td>
                <td width="33%">: '.$master['no_retur'].'</td>
                <td width="12%">Tanggal</td>
                <td colspan="2">: '.tanggal($master['tgl_retur']).'</td>
            </tr>
            <tr>
                <td class="bottomdash">No. Billing</td>
                <td class="bottomdash">:'.$master['id_mrs'].'</td>
                <td class="bottomdash">No. RM</td>
                <td class="bottomdash" width="17%">: '.$master['no_mr'].'</td>
                <td class="bottomdash" width="23%">Kelas : '.$master['kelas'].'</td>
            </tr>
        </table>
        <br>
        <table >
            <tr>
                <td width="20%">Nama Pasien </td>
                <td width="80%">: '.$master['nama_pasien'].'</td>
            </tr>
            <tr>
                <td>Alamat </td>
                <td>: '.$master['alamat'].'</td>
            </tr>
            <tr>
                <td>Unit/Kamar </td>
                <td>: '.$master['kamar_display'].'</td>
            </tr>
            <tr>
                <td class="bottomdash">Dokter </td>
                <td class="bottomdash">: '.$master['nama_dokter'].'</td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td class="topdash bottomdash" width="7%"><b>NO</b></td>
                <td class="topdash bottomdash" width="62%"><b>NAMA OBAT/ALKES</b></td>
                <td class="topdash bottomdash" width="15%"><b>QTY</b></td>
                <td class="topdash bottomdash" width="15%"><b>SATUAN</b></td>
            </tr>';
        $no=1;
        foreach ($detail as $key) {
        $html.='
             <tr>
                <td>'.$no.'</td>
                <td>'.$key['nama_item'].'</td>
                <td align="center">'.angka($key['jml']).'</td>
                <td align="center">'.$key['id_satuan'].'</td>
            </tr>';
            $no++;
        }

        $html .='
        </table>
        <table>
            <tr>
                <td width="70%" class="topdash"></td>
                <td width="10%" align="right" class="topdash">JRS : </td>
                <td width="20%" align="right" class="topdash">0</td>
            </tr>    
            <tr>
                <td width="70%" class="bottomdash"></td>
                <td width="10%" align="right" class="bottomdash">PPN : </td>
                <td width="20%" align="right" class="bottomdash">0</td>
            </tr>    
        </table>
        <br>
        <table>
            <tr>
                <td width="61%" ></td>
                <td width="14%" align="right" class="bottomsolid"><b>TOTAL    : </b></td>
                <td width="25%" align="right" class="bottomsolid"><b>'.angka($master['total']).'</b></td>
            </tr>    
        </table>
        <br><br>
        <table>
            <tr>
                <td width="55%"></td>
                <td align="center" width="45%">Petugas Farmasi</td>
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
                <td align="center">'.$master['nama_user'].'</td>
            </tr>
            <tr>
                <td></td>
                <td align="center">Tanggal : '.tanggal_time($master['tgl_cetak']).'</td>
            </tr>
        </table>
        '; 
        
        // $pdf->Header();
        // echo $html;
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Retur Pemakaian ObatAlkes ".$master['no_retur'].".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
    }


}

/* End of file Retur_pemakaian_pasien.php */
/* Location: ./application/apps/farmasi/controllers/depo/Retur_pemakaian_pasien.php */