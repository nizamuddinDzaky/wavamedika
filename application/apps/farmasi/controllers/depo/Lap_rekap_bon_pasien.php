<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_rekap_bon_pasien extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
        $this->headers = getHeaderToken();
    }

	function index()
	{
		$this->data['js'] = 'depo/lap_rekap_bon_pasien_js';
        $this->data['main_view'] = 'depo/v_lap_rekap_bon_pasien';
        $this->load->view('template', $this->data);
	}

	function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        $param['criteria']   = $param['criteria'] ?? '';
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'laporan/farmasi/bon_pasien/search');
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

    function getPerKode($cek='')
    {
        $API = BASE_URL_API_LPS.'laporan/farmasi/bon_pasien/get/'.$_POST['data'];
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
        if($cek==1){
        	return $result;

        }else{
	        $data = [];
	        if (count($result)> 0)
	        {
				$data['master']     =$result['data'][0];
				$data['data_nota']  =$result['data_nota']['data'];
				$data['data_retur'] =$result['data_retur']['data'];
	        }
	    	echo json_encode($data);
        }

        // print_r($result);die();
        
    }

    function cetak($cek='')
    {
        if($cek==1){
            $API = BASE_URL_API_LPS.'laporan/farmasi/bon_pasien/cetak_reguler/'.$_POST['data'];
        }else{
            $API = BASE_URL_API_LPS.'laporan/farmasi/bon_pasien/cetak_asuransi/'.$_POST['data'];
        }
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
        return $result;

        

        // print_r($result);die();
        
    }

    function cetak_reg()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->cetak(1);
        $master = $result['master'][0];
        $data_nota = $result['detail'];
        // print_r($result);


        $this->load->library('Pdf');
        $pdf = tcpdf();
        $pdf->SetPrintHeader(false);
        //initialize document
        $pdf->setMargins(2, 0, 1);
        // $pdf->AddPage("P", "A6");
        $pdf->AddPage("P", "NOTA");
        $pdf->SetFont("helvetica", "", 8);
    
        
        $html='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
				border-top:0.5px dashed black;
				border-bottom:0.5px dashed black;
                font-size: 8px;
            }

           .bawah table, 
           .bawah thead, 
           .bawah tr, 
           .bawah th {
                border:0.5px solid white;
                font-size: 8px;
            }
           .master table, 
           .master thead, 
           .master tr, 
           .master th {
                font-size: 8px;
            }
            .border {
                border:0.6px solid black
            }
            .bawahgaris{
				border-bottom:0.5px dashed black;
            }
        </style>
            <img src="assets/img/header-wava3.png">
            <table class="bawahgaris" cellspacing="0" style="width: 100%; ">
                    <tr>
                        <td></td>
                    </tr>
            </table>
            <br>
        <div align="center"><b><u>REKAPITULASI PEMAKAIAN OBAT/ALKES'; 
        $html.='</u></b>';
        $html.='</div>';
            $i=0;
                    $no=1;

            $html.='
        		<table class="master" cellspacing="0" style="width: 100%; ">
	                <tr>
	                    <th align="left" width="25%">No. Billing</th>
	                    <th align="left" width="30%">: '.$master['id_mrs'].'</th>
	                    <th align="left" width="15%">Tgl. Mrs</th>
	                    <th align="left" width="20%">: '.tanggal($master['tgl_mrs']).'</th>
	                </tr>
	                <tr>
	                    <th align="left" width="25%">Nama Pasien</th>
	                    <th align="left" width="30%">: '.$master['nama_pasien'].'</th>
	                    <th align="left" width="15%">No. RM</th>
	                    <th align="left" width="20%">: '.$master['no_mr'].'</th>
	                </tr>
	                <tr>
	                    <th align="left" width="25%">Kamar /Kelas</th>
	                    <th align="left" width="85%">: '.$master['kelas'].'</th>
	                </tr>
	                <tr>
	                    <th align="left" width="25%">Dokter</th>
	                    <th align="left" width="85%">: '.$master['nama_dokter'].'</th>
	                </tr>
                </table>
                ';
                $sebelum=1;
                            
        	$html.='<table class="atas" cellspacing="0" style="width: 100%;">';
            $html.='
                        <tr>
                            <th align="center" width="7%" >No</th>
                            <th align="center" width="46%">Nama Obat/Alkes</th>
                            <th align="center" width="12%">Sat</th>
                            <th align="center" width="12%">QTY</th>
                            <th align="center" width="12%">QTY Rtr</th>
                            <th align="center" width="12%">QTY Akh</th>
                        </tr>';
                        $jumlah = count($data_nota);
                        // print_r($jumlah);
            foreach ($data_nota as $key) {
            	if($no==$jumlah){
				$html.='
	                    <tr>
	                            <td class="bawahgaris" align="center" width="6%">'.$no.'</td>
	                            <td class="bawahgaris" align="left" width="46%">'.$key['nama_item'].'</td>
	                            <td class="bawahgaris" align="left" width="12%">'.$key['nama_satuan'].'</td>
	                            <td class="bawahgaris" align="right" width="12%">'.angka($key['jml'],0).'</td>
                                <td class="bawahgaris" align="right" width="12%">'.angka($key['jml_retur'],0).'</td>
	                            <td class="bawahgaris" align="right" width="12%">'.angka($key['jml_akh'],0).'</td>
	                    </tr>
	                    ';
	                    break;
            	}
	            $html.='
	                    <tr>
	                            <td align="center" width="6%">'.$no.'</td>
	                            <td align="left" width="46%">'.$key['nama_item'].'</td>
	                            <td align="left" width="12%">'.$key['nama_satuan'].'</td>
	                            <td align="right" width="12%">'.angka($key['jml'],0).'</td>
                                <td align="right" width="12%">'.angka($key['jml_retur'],0).'</td>
	                            <td align="right" width="12%">'.angka($key['jml_akh'],0).'</td>
	                    </tr>
	                    ';
                $no++;
            }
            $user=$this->session->userdata('user_fullname');
	            $html.='
			            <tr>
                                <td align="right" width="58%"></td>
	                            <td align="right" width="22%"><b>Total JRS :</b></td>
	                            <td align="right" width="20%"><b>'.angka($master['jrs'],0).'</b></td>
						</tr>
						<tr>
							<td align="right" width="58%">Dicetak Oleh '.$user. ' pada</td>
							<td></td>
                            <td></td>
						</tr>
	                    <tr>
                            <td align="right" width="58%">'.tanggal_time_detail(date("d-m-Y h:i:s")).'</td>
	                        <td align="right" width="22%"><b>Total PPN :</b></td>
	                        <td align="right" width="20%"><b>'.angka($master['tot_ppn'],0).'</b></td>
	                    </tr>
                        <tr>
                            <td align="right" width="59%"></td>
                            <td></td>
                            <td></td>
                        </tr>
	                    <tr>
                            <td align="right" width="58%"></td>
                            <td align="right" width="22%"><b>Grand Total :</b></td>
                            <td align="rightt" width="20%"><b>'.angka($master['grand_total'],0).'</b></td>
	                    </tr>
	                    ';
                    $html.='
                    </table>';
            
        
        // $pdf->Header();
        // echo $html;
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Rekap Bon per Pasien.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        
    }

    function cetak_asuransi()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        // $result = $this->cetak(2);
        $result=$this->cetak(2);
        $master = $result['master'][0];
        $data_nota = $result['detail'];
        // print_r($result);


        $this->load->library('Pdf');
        $pdf = tcpdf();
        $pdf->SetPrintHeader(false);
        //initialize document
        $pdf->setMargins(2, 0, 1);
        // $pdf->AddPage("P", "A6");
        $pdf->AddPage("P", "NOTA");
        $pdf->SetFont("helvetica", "", 7);
    
        
        $html='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border-bottom:0.5px dashed black;
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
            .border {
                border:0.6px solid black
            }
            .bawahgaris{
                border-bottom:0.5px dashed black;
            }
            .atasgaris{
                border-top:0.5px dashed black;
            }
            .atasbawahgaris{
                border-bottom:0.5px dashed black;
                border-top:0.5px dashed black;
            }
        </style>
            <img src="assets/img/header-wava3.png">
            <table class="bawahgaris" cellspacing="0" style="width: 100%; ">
                    <tr>
                        <td></td>
                    </tr>
            </table>
            <br>
        <div align="center"><b><u>REKAPITULASI PEMAKAIAN OBAT/ALKES'; 
        $html.='</u></b>';
        $html.='</div>';
            $i=0;

            $html.='
                <table class="master" cellspacing="0" style="width: 100%; ">
                    <tr>
                        <th align="left" width="25%">No. Billing</th>
                        <th align="left" width="30%">: '.$master['id_mrs'].'</th>
                        <th align="left" width="15%">Tgl. Mrs</th>
                        <th align="left" width="20%">: '.tanggal($master['tgl_mrs']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="25%">Nama Pasien</th>
                        <th align="left" width="30%">: '.$master['nama_pasien'].'</th>
                        <th align="left" width="15%">No. RM</th>
                        <th align="left" width="20%">: '.$master['no_mr'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="25%">Kamar /Kelas</th>
                        <th align="left" width="85%">: '.$master['kelas'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="25%">Dokter</th>
                        <th align="left" width="85%">: '.$master['nama_dokter'].'</th>
                    </tr>
                </table>
                <br>
                <br>
                ';
                $sebelum=1;
                $jumlah = count($data_nota);
                            
            $html.='<table class="atas" cellspacing="0" style="width: 100%;">';
            foreach ($data_nota as $key) {
                if($key['no_urut']==1){
                    $no=1;
                    $html.='
                                <tr>
                                    <th colspan="7"><b>'.$key['nama_kel_item'].'</b></th>
                                </tr>
                                <tr>
                                    <th align="center" width="7%" >No</th>
                                    <th align="center" width="34%">Nama Obat/Alkes</th>
                                    <th align="center" width="10%">Sat</th>
                                    <th align="center" width="12%">QTY</th>
                                    <th align="center" width="8%">QTY Rtr</th>
                                    <th align="center" width="12%">QTY Akh</th>
                                    <th align="center" width="16%">Sub Total</th>
                                </tr>';

                }

                else{
                    // if($no==$jumlah){
                    // $html.='
                    //         <tr>
                    //             <td class="bawahgaris" align="center" width="6%">'.$no.'</td>
                    //             <td class="bawahgaris" align="left" width="34%">'.$key['nama_item'].'</td>
                    //             <td class="bawahgaris" align="left" width="12%">'.$key['nama_satuan'].'</td>
                    //             <td class="bawahgaris" align="right" width="12%">'.angka($key['jml'],0).'</td>
                    //             <td class="bawahgaris" align="right" width="12%">'.angka($key['jml_retur'],0).'</td>
                    //             <td class="bawahgaris" align="right" width="12%">'.angka($key['jml_akhir'],0).'</td>
                    //             <td class="bawahgaris" align="right" width="12%">'.angka($key['sub_total'],0).'</td>
                    //         </tr>
                            
                    //         ';
                    //         break;
                    // }
                    if($key['no_urut']==3){
                        $html .='
                                <tr>
                                    <td class="atasgaris" colspan="5" align="right"><b>'.$key['nama_kel_item'].' :</b></td>
                                    <td class="atasgaris" colspan="2" align="right"><b>'.angka($key['sub_total'],0).'</b></td>
                                </tr>';
                    }else{
                        $html.='
                                <tr >
                                        <td align="center" width="6%">'.$no.'</td>
                                        <td align="left" width="34%">'.$key['nama_item'].'</td>
                                        <td align="left" width="10%">'.$key['nama_satuan'].'</td>
                                        <td align="right" width="12%">'.angka($key['jml'],0).'</td>
                                        <td align="right" width="8%">'.angka($key['jml_retur'],0).'</td>
                                        <td align="right" width="12%">'.angka($key['jml_akhir'],0).'</td>
                                        <td align="right" width="16%">1.000.000</td>
                                </tr>
                                ';

                    }
                    $no++;
                }
            }
            $user=$this->session->userdata('user_fullname');
                $html.='
                        <tr>
                                <td class="atasgaris" align="right" width="58%"></td>
                                <td class="atasgaris" align="right" width="22%"><b>Total JRS :</b></td>
                                <td class="atasgaris" align="right" width="20%"><b>'.angka($master['jrs'],0).'</b></td>
                        </tr>
                        <tr>
                            <td align="right" width="58%">Dicetak Oleh '.$user. ' pada</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="right" width="58%">'.tanggal_time_detail(date("d-m-Y h:i:s")).'</td>
                            <td align="right" width="22%"><b>Total PPN :</b></td>
                            <td align="right" width="20%"><b>'.angka($master['tot_ppn'],0).'</b></td>
                        </tr>
                        <tr>
                            <td align="right" width="59%"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="right" width="58%"></td>
                            <td align="right" width="22%"><b>Grand Total :</b></td>
                            <td align="rightt" width="20%"><b>'.angka($master['grand_total'],0).'</b></td>
                        </tr>
                        ';
                    $html.='
                    </table>';
            
        
        // $pdf->Header();
        // echo $html;
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Rekap Bon per Pasien.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        
    }

}

/* End of file Rekap_bon_pasien.php */
/* Location: ./application/apps/farmasi/controllers/depo/Rekap_bon_pasien.php */