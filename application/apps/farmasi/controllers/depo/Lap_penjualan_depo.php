<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_penjualan_depo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('function_helper');
	}

	public function index()
	{
		$this->data['js'] = 'depo/lap_penjualan_depo_js';
        $this->data['main_view'] = 'depo/v_lap_penjualan_depo';
        $this->load->view('template', $this->data);
	}

	public function get_depo()
    {
        $API = BASE_URL_API_LPS."master/list_unit_stok/farmasi";
        
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

        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => 0,
            'text' => 'ALL',
        ];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_kategori()
    {
        $API = BASE_URL_API_LPS."master/kel_item/list_farmasi";
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
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

        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => 0,
            'text' => 'ALL',
        ];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_kel_item'],
                'text' => $unit['nama_kel_item'],
            ];
        }
        echo json_encode($daftar_unit);
    }

	public function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_API_LPS.'laporan/penjualan/'.$param['url'];
		
		$type_buffer             = $param['buffer']??false;
		
		$data['rpt_period']      = $param['rpt_period'];
		$data['rpt_type']        = $param['rpt_type'];
		$data['start_date']      = $param['start_date'];
		$data['end_date']        = $param['end_date'];
		$data['month_period']    = $param['month_period'];
		$data['year_period']     = $param['year_period'];
		
		$data['id_depo']         = $param['id_depo'];
		$data['id_kel_item']     = $param['id_kel_item'];
		$data['status_karyawan'] = $param['status_karyawan'];

		if ($param['rpt_type']==1)
		{
			# code...
			$data['page_row'] = $param['rows']??1;
			$data['page']     = $param['page']??10;
		}
		// else
		// {
		// 	$data['page_row'] = $param['rows'];
		// 	$data['page']     = $param['page'];
		// }

		// echo json_encode($data);
        
        curl_setopt($curl_handle, CURLOPT_URL, $url);
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

        $result=json_decode($buffer,$type_buffer);
        
        if($param['rpt_type']==1)
        {
        	echo json_encode($result);
        }
        else
        {
        	return $result;
        }
    }

    public function cetak_per_brg()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN FARMASI PER OBAT'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
            $no=1;
            foreach ($result['data'] as $key)
            {
            	if ($result['data'][$i]['no_urut']==1&&$i==0)
            	{
            	    # code...
            	    $html.='<div><b>Jenis : '.$key['nama_kel_item'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
   
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++; 
                    continue;
            	}
            	if ($result['data'][$i]['no_urut']==2)
            	{
            		$html.='</table>';
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_satuan'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==3)
            	{
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_satuan'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table><br></br>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']==1)
            	{
            		$html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']!=1)
            	{
            	    $html.='<div><b>Jenis : '.$key['nama_kel_item'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
                    continue;
            	}
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_per_status_px()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN PER STATUS PASIEN'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
            $no=1;
            foreach ($result['data'] as $key)
            {
            	if ($result['data'][$i]['no_urut']==1&&$i==0)
            	{
            	    # code...
            	    $html.='<div><b>Status : '.$key['status_pasien'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
   
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++; 
                    continue;
            	}
            	if ($result['data'][$i]['no_urut']==2)
            	{
            		$html.='</table>';
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_satuan'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==3)
            	{
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_satuan'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table><br></br>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']==1)
            	{
            		$html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']!=1)
            	{
            	    $html.='<div><b>Status : '.$key['status_pasien'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
                    continue;
            	}
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_bpjs_irja()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN BPJS RAWAT JALAN'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
            $no=1;
            foreach ($result['data'] as $key)
            {
            	if ($result['data'][$i]['no_urut']==1&&$i==0)
            	{
            	    # code...
            	    $html.='<div><b>Status : '.$key['status_pasien'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
   
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++; 
                    continue;
            	}
            	if ($result['data'][$i]['no_urut']==2)
            	{
            		$html.='</table>';
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_satuan'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==3)
            	{
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_satuan'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table><br></br>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']==1)
            	{
            		$html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']!=1)
            	{
            	    $html.='<div><b>Status : '.$key['status_pasien'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
                    continue;
            	}
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_per_depo()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN PER DEPO'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';

        $i=0;
	    $html.='
	        <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
	            <tr style="border:1px black solid;">
	                <th align="center" width="2%"><b>No</b></th>
	                <th align="center" width="8%"><b>Kode</b></th>
	                <th align="center" width="24%"><b>Nama Obat/Alkes</b></th>
	                <th align="center" width="10%"><b>Produsen</b></th>
	                <th align="center" width="5%"><b>Satuan</b></th>
	                <th align="center" width="5%"><b>Status</b></th>
	                <th align="center" width="5%"><b>F. RAJAL</b></th>
	                <th align="center" width="5%"><b>F. RANAP</b></th>
	                <th align="center" width="5%"><b>ALKES</b></th>
	                <th align="center" width="5%"><b>F. UKO</b></th>
	                <th align="center" width="5%"><b>F. UGD</b></th>
	                <th align="center" width="5%"><b>Total</b></th>
	                <th align="center" width="8%"><b>Total HPP</b></th>
	                <th align="center" width="8%"><b>Total Penjualan</b></th>
	            </tr>';
	            $no=1;
	            foreach ($result['data'] as $key) {
			        if ($key['no_urut']==1)
			       	{
			            $html.='
				            <tr style="border:1px black solid;">
				                <th align="left" width="2%">'.$no.'</th>
				                <th align="left" width="8%">'.$key['kd_item']. '</th>
				                <th align="left" width="24%">'.$key['nama_item']. '</th>
				                <th align="left" width="10%">'.$key['nama_produsen']. '</th>
				                <th align="left" width="5%">'.$key['nama_satuan'] .'</th>
				                <th align="left" width="5%">'.$key['status_pasien']. '</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['rajal']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['ranap']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['alkes']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['uko']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['igd']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</th>
				                <th align="right" width="8%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</th>
				                <th align="right" width="8%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</th>
				            </tr>';
			       	}
		            else
		            {
		            	$html.='
				            <tr style="border:1px black solid;">
				                <th align="right" width="84%" colspan="12">'.$key['nama_item'].'</th>
				                <th align="right" width="8%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</th>
				                <th align="right" width="8%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</th>
				            </tr>';	
		            		
		             	$html.='</table><br></br>';
		            } 
	           		$no++;
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_resep_per_status()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN JUMLAH RESEP PER STATUS PASIEN'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';

        $i=0;
	    $html.='
	        <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
	            <tr style="border:1px black solid;">
	                <th align="center" width="2%"><b>No</b></th>
	                <th align="center" width="10%"><b>No. Nota</b></th>
	                <th align="center" width="10%"><b>Tgl. Trans</b></th>
	                <th align="center" width="10%"><b>No. Billing</b></th>
	                <th align="center" width="10%"><b>No. Resep</b></th>
	                <th align="center" width="14%"><b>Status</b></th>
	                <th align="center" width="14%"><b>Jenis Resep</b></th>
	                <th align="center" width="10%"><b>W. Trans</b></th>
	                <th align="center" width="10%"><b>W. Diserahkan</b></th>
	                <th align="center" width="10%"><b>Selisih</b></th>
	            </tr>';
	            $no=1;
	            foreach ($result['data'] as $key) {
			        
		            $html.='
			            <tr style="border:1px black solid;">
			                <th align="left" width="2%">'.$no.'</th>
			                <th align="left" width="10%">'.$key['no_nota']. '</th>
			                <th align="center" width="10%">'.tanggal($key['tgl_nota']). '</th>
			                <th align="left" width="10%">'.$key['id_billing'] .'</th>
			                <th align="left" width="10%">'.$key['no_resep']. '</th>
			                <th align="left" width="14%">'.$key['status_pasien']. '</th>
			                <th align="left" width="14%">'.$key['jns_resep']. '</th>
			                <th align="center" width="10%">'.tanggal_time($key['tgl_ambil']). '</th>
			                <th align="center" width="10%">'.tanggal_time($key['tgl_nota']). '</th>
			                <th align="left" width="10%">'.$key['selisih']. '</th>
			            </tr>'; 
			        $html.='</table><br></br>';
	           		$no++;
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_jasa_resep()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN JASA RESEP'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';

        $i=0;
	    $html.='
	        <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
	            <tr style="border:1px black solid;">
	                <th align="center" width="2%"><b>No</b></th>
	                <th align="center" width="10%"><b>Tgl. Transaksi</b></th>
	                <th align="center" width="10%"><b>No. Billing</b></th>
	                <th align="center" width="25%"><b>Status</b></th>
	                <th align="center" width="25%"><b>Jenis Resep</b></th>
	                <th align="center" width="10%"><b>Jml. Item</b></th>
	                <th align="center" width="10%"><b>Jasa Resep</b></th>
	            </tr>';
	            $no=1;
	            foreach ($result['data'] as $key) {
			        
		            $html.='
			            <tr style="border:1px black solid;">
			                <th align="left" width="2%">'.$no.'</th>
			                <th align="center" width="10%">'.tanggal($key['tgl_nota']). '</th>
			                <th align="left" width="10%">'.$key['id_billing'] .'</th>
			                <th align="left" width="25%">'.$key['status_pasien']. '</th>
			                <th align="left" width="25%">'.$key['jns_resep']. '</th>
			                <th align="right" width="10%">'.angka($key['jml_item']). '</th>
			                <th align="right" width="10%">'.angka($key['jrs']). '</th>
			            </tr>'; 
			        $html.='</table><br></br>';
	           		$no++;
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_per_dokter()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN PER DOKTER'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
            $no=1;
            foreach ($result['data'] as $key)
            {
            	if ($result['data'][$i]['no_urut']==1&&$i==0)
            	{
            	    # code...
            	    $html.='<div><b>Dokter : '.$key['nama_dokter'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
   
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++; 
                    continue;
            	}
            	if ($result['data'][$i]['no_urut']==2)
            	{
            		$html.='</table>';
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_dokter'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==3)
            	{
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_dokter'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table><br></br>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']==1)
            	{
            		$html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']!=1)
            	{
            	    $html.='<div><b>Dokter : '.$key['nama_dokter'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
                    continue;
            	}
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_obat_per_dokter()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN PER OBAT'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
            $no=1;
            foreach ($result['data'] as $key)
            {
            	if ($result['data'][$i]['no_urut']==1&&$i==0)
            	{
            	    # code...
            	    $html.='<div><b>Obat/ Alkes : '.$key['nama_item'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="3%"><b>No</b></th>
		                        <th align="center" width="35%"><b>Nama Dokter</b></th>
		                        <th align="center" width="10%"><b>Formularium</b></th>
		                        <th align="center" width="12%"><b>Status</b></th>
		                        <th align="center" width="10%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
   
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="3%">'.$no.'</td>
	                        <td align="left" width="35%">'.$key['nama_dokter']. '</td>
	                        <td align="left" width="10%">'.$key['for_rs']. '</td>
	                        <td align="left" width="12%">'.$key['status_pasien']. '</td>
	                        <td align="left" width="10%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++; 
                    continue;
            	}
            	if ($result['data'][$i]['no_urut']==2)
            	{
            		$html.='</table>';
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['status_pasien'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==3)
            	{
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['status_pasien'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table><br></br>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']==1)
            	{
            		$html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="3%">'.$no.'</td>
	                        <td align="left" width="35%">'.$key['nama_dokter']. '</td>
	                        <td align="left" width="10%">'.$key['for_rs']. '</td>
	                        <td align="left" width="12%">'.$key['status_pasien']. '</td>
	                        <td align="left" width="10%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']!=1)
            	{
            	    $html.='<div><b>Obat/ Alkes : '.$key['nama_item'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="3%"><b>No</b></th>
		                        <th align="center" width="35%"><b>Nama Dokter</b></th>
		                        <th align="center" width="10%"><b>Formularium</b></th>
		                        <th align="center" width="12%"><b>Status</b></th>
		                        <th align="center" width="10%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="3%">'.$no.'</td>
	                        <td align="left" width="35%">'.$key['nama_dokter']. '</td>
	                        <td align="left" width="10%">'.$key['for_rs']. '</td>
	                        <td align="left" width="12%">'.$key['status_pasien']. '</td>
	                        <td align="left" width="10%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
                    continue;
            	}
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

	public function cetak_per_produsen()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJULAN PER PRODUSEN'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';
            $i=0;
            $no=1;
            foreach ($result['data'] as $key)
            {
            	if ($result['data'][$i]['no_urut']==1&&$i==0)
            	{
            	    # code...
            	    $html.='<div><b>Produsen : '.$key['nama_produsen'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
   
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++; 
                    continue;
            	}
            	if ($result['data'][$i]['no_urut']==2)
            	{
            		$html.='</table>';
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_produsen'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==3)
            	{
            		$html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="">
		                        <th align="right" width="80%" colspan="6"><b>'.$key['nama_produsen'].'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_hpp']).'</b></th>
		                        <th align="right" width="10%"><b>'.angka($key['total_jual']).'</b></th>
		                    </tr>';
		            $html.='</table><br></br>';
		            $no=1;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']==1)
            	{
            		$html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
            		continue;
            	}
            	if ($result['data'][$i]['no_urut']==1&&$result['data'][$i-1]['no_urut']!=1)
            	{
            	    $html.='<div><b>Produsen : '.$key['nama_produsen'].'</b></div>';
            	    $html.='
            	    	<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
		                    <tr style="border:1px black solid;">
		                        <th align="center" width="2%"><b>No</b></th>
		                        <th align="center" width="6%"><b>Kode</b></th>
		                        <th align="center" width="35%"><b>Nama Obat</b></th>
		                        <th align="center" width="15%"><b>Produsen</b></th>
		                        <th align="center" width="12%"><b>Satuan</b></th>
		                        <th align="center" width="10%"><b>Jumlah</b></th>
		                        <th align="center" width="10%"><b>Total HPP</b></th>
		                        <th align="center" width="10%"><b>Total Penjualan</b></th>
		                    </tr>';
                    $html.='
                    	<tr style="border:1px black solid;">
	                        <td align="right" width="2%">'.$no.'</td>
	                        <td align="left" width="6%">'.$key['kd_item']. '</td>
	                        <td align="left" width="35%">'.$key['nama_item']. '</td>
	                        <td align="left" width="15%">'.$key['nama_produsen']. '</td>
	                        <td align="left" width="12%">'.$key['nama_satuan']. '</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</td>
	                        <td align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</td>
	                    </tr>';
	                $no++;
	                $i++;
                    continue;
            	}
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_rekap_jual()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN REKAPITULASI PENJUALAN FARMASI'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';

        $i=0;
        $grand_total=0;
	    $html.='
	        <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
	            <tr style="border:1px black solid;">
	                <th align="center" width="2%"><b>No</b></th>
	                <th align="center" width="69%"><b>Rekapitulasi</b></th>
	                <th align="center" width="29%"><b>Total</b></th>
	            </tr>';
	            $no=1;
	            foreach ($result['data'] as $key) {
			        
		            $html.='
			            <tr style="border:1px black solid;">
			                <th align="left" width="2%">'.$no.'</th>
			                <th align="left" width="69%">'.$key['nama_rpt'] .'</th>
			                <th align="right" width="29%">'.angka($key['total']). '</th>
			            </tr>';
			        $grand_total = $grand_total + $key['total'];
	           		$no++;
	            }
	    $html.='
            <tr style="border:1px black solid;">
                <th align="right" width="71%" colspan="2"><b>Grand Total</b></th>
                <th align="right" width="29%"><b>'.angka($grand_total). '</b></th>
            </tr>'; 
        $html.='</table><br></br>';

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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_per_nota()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN PENJUALAN FARMASI PER OBAT'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';

        $i=0;
        $grand_total = $result['total_jual'];
	    $html.='
	        <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
	            <tr style="border:1px black solid;">
	                <th align="center" width="8%"><b>No. Nota</b></th>
	                <th align="center" width="6%"><b>Tgl. Nota</b></th>
	                <th align="center" width="10%"><b>Status</b></th>
	                <th align="center" width="6%"><b>No. Billing</b></th>
	                <th align="center" width="20%"><b>Nama Pasien</b></th>
	                <th align="center" width="5%"><b>Jenis</b></th>
	                <th align="center" width="5%"><b>Kode</b></th>
	                <th align="center" width="20%"><b>Nama Obat/ Alkes</b></th>
	                <th align="center" width="5%"><b>Satuan</b></th>
	                <th align="center" width="5%"><b>Jumlah</b></th>
	                <th align="center" width="10%"><b>Total Penjualan</b></th>
	            </tr>';
	            $no=1;
	            foreach ($result['data'] as $key) {
			        
		            $html.='
			            <tr style="border:1px black solid;">
			                <th align="left" width="8%">'.$key['no_nota'].'</th>
			                <th align="center" width="6%">'.tanggal($key['tgl_nota']). '</th>
			                <th align="left" width="10%">'.$key['status_pasien'] .'</th>
			                <th align="left" width="6%">'.$key['id_mrs']. '</th>
			                <th align="left" width="20%">'.$key['nama_pasien']. '</th>
							<th align="left" width="5%">'.$key['nama_kel_item']. '</th>
							<th align="left" width="5%">'.$key['kd_item']. '</th>
							<th align="left" width="20%">'.$key['nama_item']. '</th>
							<th align="left" width="5%">'.$key['nama_satuan']. '</th>
			                <th align="right" width="5%">'.angka($key['jml']). '</th>
			                <th align="right" width="10%">'.angka($key['total_jual']). '</th>
			            </tr>';
	           		$no++;
	            }

         $html.='
	        <tr style="border:1px black solid;">
	            <th align="right" width="90%" colspan="10"><b>Grand Total</b></th>
	            <th align="right" width="10%"><b>'.angka($grand_total). '</b></th>
	        </tr>'; 
        $html.='</table><br></br>';

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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_rekap_depo()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        // echo json_encode($result); die();

        $param            = $this->input->post();
        $lap              = $param['url'];
        $depo             = $param['nama_depo'];
        $jns_laporan      = $param['jns_laporan'];
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];

        if ($param['id_depo']==0)
        {
        	# code...
        	$depo="SEMUA DEPO";
        }

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Penjualan Depo ".$jns_laporan.".xls");

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
        <div align="center"><b><u>LAPORAN REKAPITULASI PENJULAN PER DEPO'; 
        $html.='</u></b><br> DEPO : '.$depo.'<br> Periode ';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        
        $html.='</div><br>';

        $i=0;
	    $html.='
	        <table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
	            <tr style="border:1px black solid;">
	                <th align="center" width="2%"><b>No</b></th>
	                <th align="center" width="8%"><b>Kode</b></th>
	                <th align="center" width="35%"><b>Nama Obat/Alkes</b></th>
	                <th align="center" width="5%"><b>Satuan</b></th>
	                <th align="center" width="5%"><b>F. RAJAL</b></th>
	                <th align="center" width="5%"><b>F. RANAP</b></th>
	                <th align="center" width="5%"><b>ALKES</b></th>
	                <th align="center" width="5%"><b>F. UKO</b></th>
	                <th align="center" width="5%"><b>F. UGD</b></th>
	                <th align="center" width="5%"><b>Total</b></th>
	                <th align="center" width="10%"><b>Total HPP</b></th>
	                <th align="center" width="10%"><b>Total Penjualan</b></th>
	            </tr>';
	            $no=1;
	            foreach ($result['data'] as $key) {
			        if ($key['no_urut']==1)
			       	{
			            $html.='
				            <tr style="border:1px black solid;">
				                <th align="left" width="2%">'.$no.'</th>
				                <th align="left" width="8%">'.$key['kd_item']. '</th>
				                <th align="left" width="35%">'.$key['nama_item']. '</th>
				                <th align="left" width="5%">'.$key['nama_satuan'] .'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['rajal']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['ranap']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['alkes']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['uko']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['igd']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</th>
				                <th align="right" width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</th>
				                <th align="right" width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</th>
				            </tr>';
			       	}
		            else
		            {
		            	$html.='
				            <tr style="border:1px black solid;">
				                <th align="right" width="50%" colspan="4">'.$key['nama_item'].'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['rajal']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['ranap']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['alkes']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['uko']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['igd']).'</th>
				                <th align="right" width="5%" formatter: appGridNumberFormatter>'.angka($key['jml']).'</th>
				                <th align="right" width="10%" formatter: appGridNumberFormatter>'.angka($key['total_hpp']).'</th>
				                <th align="right" width="10%" formatter: appGridNumberFormatter>'.angka($key['total_jual']).'</th>
				            </tr>';	
		            		
		             	$html.='</table><br></br>';
		            } 
	           		$no++;
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
        
            $pdf->Output("assets/laporan/"."Laporan Penjualan Depo ".$jns_laporan.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

}

/* End of file Lap_penjualan_depo.php */
/* Location: ./application/apps/farmasi/controllers/depo/Lap_penjualan_depo.php */