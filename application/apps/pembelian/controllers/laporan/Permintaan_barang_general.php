<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_barang_general extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('function_helper');
	}

	function index()
	{
		$this->data['js'] = 'laporan/permintaan_barang_general_js';
        $this->data['main_view'] = 'laporan/v_permintaan_barang_general';
		$this->load->view('template', $this->data);
	}

	function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();
        $lap="";
        $path="laporan/mutasi/farmasi/";
        if($param['id_jns']==1){
        	$lap="minta_mutasi_nota";
        }else if($param['id_jns']==2){
        	$lap="minta_mutasi_item";
        }
        $url = BASE_URL_API_LPS.'laporan/mutasi/farmasi/'.$lap;
        if($param['id_jns']==3){
            $path = "laporan/umum/farmasi/";
        	$lap="minta_mutasi";

        }
		$type_buffer          = $param['buffer']??false;
        
        $response = sendRequest("POST", 'lps', $path.$lap, $param, $type_buffer);

        if($param['rpt_type']==1)
        {
        	echo json_encode($response);
        }
        else
        {
        	return $response;
        }
    }

	function cetak_1()//permintaan barang per nota
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();
        $param            = $this->input->post();
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Permintaan_Barang_Per_Nota.xls");

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
        </style>
        <div align="center"><b><u>LAPORAN PERMINTAAN MUTASI PER NO. PERMINTAAN'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $html.='</div><br>';
            $i=0;
            foreach ($result['data'] as $key) {
                $html.='<table class="master" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr>
                        <th align="left" width="8%">No. PM</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['no_pm'].'</th>
                        <th align="center" width="10%">Tgl. PM :</th>
                        <th align="left" width="10%">'.tanggal($key['tgl_pm']).'</th>
                        <th align="left" width="8%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$key['status_caption'].'</th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Asal</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['unit_asal'].'</th>
                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%">User</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$key['user_fullname'].'</th>
                        <th align="left" width="8%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.tanggal_time($key['date_upd']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Tujuan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['unit_tujuan'].'</th>

                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['ket_pm'].'</th>

                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                </table>
                ';
                if(count($result['data'][$i]['detail'])>0)
                {
               		$html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr style="border:1px black solid;">
                        <th align="center" width="8%"><b>Kode</b></th>
                        <th align="center" width="54%" colspan="6"><b>Nama Item</b></th>
                        <th align="center" width="7%"><b>Satuan</b></th>
                        <th align="center" width="10%"><b>Jml. Stok</b></th>
                        <th align="center" width="10%"><b>Jml. Minta</b></th>
                        <th align="center" width="11%"><b>Tgl. Kebutuhan</b></th>
                    </tr>';
                    $no=1;
                    
                	foreach ($result['data'][$i]['detail'] as $key)
                    {
	                    $html.='<tr style="border:1px black solid;">
	                    	<th align="left" width="8%">'.$key['kd_item'] .'</th>
	                        <th align="left" width="54%" colspan="6">'.$key['nama_item'].' </th>
	                        <th align="center" width="7%">'.$key['nama_satuan']. '</th>
	                        <th align="right" width="10%">'.angka($key['jml_stok'],0).'</th>
	                        <th align="right" width="10%">'.angka($key['jml_minta'],0).'</th>
	                        <th align="center" width="11%">'.tanggal($key['tgl_kebutuhan']).'</th>
	                    </tr>'; 
	                    $no++;
                    }
                    $html.='</table><br></br>';
                }
            	$html.='
                <br></br>';
                $i++; 
            }

        // $pdf->Header();
        // echo $html;

        if ($param['type_file']==2)
        {
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    function cetak_2()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

         $result = $this->filter();
        // print_r($result);
        $param            = $this->input->post();
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Permintaan_Barang_Per_Item.xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 40, 10);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("L", "F4");
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
                font-size: 6px;
            }
        </style>
        <div align="center"><b><u>LAPORAN PERMINTAAN MUTASI PER ITEM'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
                $html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr style="border:1px black solid;">
                        <th align="center" width="9%"><b>No. PM</b></th>
                        <th align="center" width="5%"><b>Tgl. PM</b></th>
                        <th align="center" width="10%"><b>Unit Asal</b></th>
                        <th align="center" width="10%"><b>Unit Tujuan</b></th>
                        <th align="center" width="6%"><b>Kode</b></th>
                        <th align="center" width="23%"><b>Nama Item</b></th>
                        <th align="center" width="4%"><b>Satuan</b></th>
                        <th align="center" width="5%"><b>Jml. Stok</b></th>
                        <th align="center" width="7%"><b>Jml. Permintaan</b></th>
                        <th align="center" width="7%"><b>Tgl. Kebutuhan</b></th>
                        <th align="center" width="8%"><b>User</b></th>
                        <th align="center" width="8%"><b>Tgl. Update</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $html.='<tr style="border:1px black solid;">
                        <th align="left" width="9%">'.$key['no_pm'] .'</th>
                        <th align="center" width="5%">'.tanggal($key['tgl_pm']).' </th>
                        <th align="left" width="10%">'.$key['unit_asal']. '</th>
                        <th align="left" width="10%">'.$key['unit_tujuan']. '</th>
                        <th align="left" width="6%">'.$key['kd_item']. '</th>
                        <th align="left" width="23%">'.$key['nama_item']. '</th>
                        <th align="left" width="4%">'.$key['nama_satuan']. '</th>
                        <th align="right"  width="5%" formatter: appGridNumberFormatter>'.angka($key['jml_stok']).'</th>
                        <th align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_minta']).'</th>
                        <th align="center" width="7%">'.tanggal($key['tgl_kebutuhan']).'</th>
                        <th align="left" width="8%">'.$key['user_fullname'].'</th>
                        <th align="center" width="8%">'.tanggal_time($key['date_upd']).'</th>
                    </tr>'; 
                    $no++;
                    }
                    $html.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';
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
        
            $pdf->Output("assets/laporan/"."Laporan ".$param['jns_laporan'].".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    function cetak_3()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

         $result = $this->filter();
        // print_r($result);
        $param            = $this->input->post();
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Outstanding_Permintaan_Barang.xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(5, 30, 5);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("P", "F4");
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
                font-size: 6px;
            }
        </style>
        <div align="center"><b><u>LAPORAN OUTSTANDING PERMINTAAN BARANG'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
                $html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr style="border:1px black solid;">
                        <th align="center" width="20%"><b>UNIT YANG MENGAJUKAN</b></th>
                        <th align="center" width="12%"><b>No. Permintaan</b></th>
                        <th align="center" width="8%"><b>Tanggal</b></th>
                        <th align="center" width="6%"><b>Kode</b></th>
                        <th align="center" width="24%"><b>Nama Item</b></th>
                        <th align="center" width="6%"><b>Satuan</b></th>
                        <th align="center" width="6%"><b>Jml. Minta</b></th>
                        <th align="center" width="6%"><b>Jml. Terima</b></th>
                        <th align="center" width="6%"><b>Sisa</b></th>
                        <th align="center" width="6%"><b>Sisa (%)</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $html.='
                    <tr style="border:1px black solid;">
                        <th align="left">'.$key['nama_unit'] .'</th>
                        <th align="center" >'.$key['no_pm'].' </th>
                        <th align="center">'.tanggal($key['tgl_pm']). '</th>
                        <th align="center">'.$key['kd_item']. '</th>
                        <th align="left">'.$key['nama_item']. '</th>
                        <th align="right">'.angka($key['nama_satuan']). '</th>
                        <th align="right">'.angka($key['jml_minta']). '</th>
                        <th align="right">'.angka($key['jml_terima']).'</th>
                        <th align="right">'.angka($key['total']).'</th>
                        <th align="right">'.angka($key['tot_persen']).'</th>
                    </tr>'; 
                    $no++;
                    }
                    $html.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';
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
        
            $pdf->Output("assets/laporan/"."Laporan ".$param['jns_laporan'].".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }


}

/* End of file Permintaan_barang_general.php */
/* Location: ./application/apps/pembelian/controllers/laporan/Permintaan_barang_general.php */