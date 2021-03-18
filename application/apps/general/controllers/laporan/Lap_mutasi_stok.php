<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_mutasi_stok extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->helper('function_helper');
	}

	public function index()
	{
        $this->data['js'] = 'laporan/lap_mutasi_stok_js';
        $this->data['main_view'] = 'laporan/v_lap_mutasi_stok';
        $this->load->view('template', $this->data);
	}

	public function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_API_LPS.'laporan/mutasi/umum/'.$param['url'];
		
		$type_buffer          = $param['buffer']??false;
		
		$data['rpt_period']   = $param['rpt_period'];
		$data['rpt_type']     = $param['rpt_type'];
		$data['start_date']   = $param['start_date'];
		$data['end_date']     = $param['end_date'];
		$data['month_period'] = $param['month_period'];
		$data['year_period']  = $param['year_period'];

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
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));
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

    public function cetak_minta_mutasi_nota()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

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
        
            $pdf->Output("assets/laporan/"."Laporan Permintaan Mutasi Per No. Permintaan.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_minta_mutasi_item()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

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
        
            $pdf->Output("assets/laporan/"."Laporan Permintaan Mutasi Per Item.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_mutasi_ruang_nota()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

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
        <div align="center"><b><u>LAPORAN PERMINTAAN MUTASI PER NO. MUTASI'; 
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
                        <th align="left" width="8%">No. Mutasi</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['no_mutasi'].'</th>
                        <th align="center" width="10%">Tgl. Mutasi :</th>
                        <th align="left" width="10%">'.tanggal($key['tgl_mutasi']).'</th>
                        <th align="left" width="8%">No. PM</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$key['no_pm'].'</th>
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
                        <th align="left" width="8%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$key['status_caption'].'</th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Tujuan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['unit_tujuan'].'</th>

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
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['ket_mutasi'].'</th>

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
                        <th align="center" width="10%"><b>Kode</b></th>
                        <th align="center" width="63%" colspan="7"><b>Nama Item</b></th>
                        <th align="center" width="7%"><b>Satuan</b></th>
                        <th align="center" width="10%"><b>Jml. Minta</b></th>
                        <th align="center" width="10%"><b>Jml. Mutasi</b></th>
                    </tr>';
                    $no=1;
                    
                	foreach ($result['data'][$i]['detail'] as $key)
                    {
	                    $html.='<tr style="border:1px black solid;">
	                    	<th align="left" width="10%">'.$key['kd_item'] .'</th>
	                        <th align="left" width="63%" colspan="7">'.$key['nama_item'].' </th>
	                        <th align="center" width="7%">'.$key['nama_satuan'].'</th>
	                        <th align="right" width="10%">'.angka($key['jml_minta'],0).'</th>
	                        <th align="right" width="10%">'.angka($key['jml_mutasi'],0).'</th>
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
        // print_r($html);die ;
        if ($param['type_file']==2)
        {
            # code...
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Mutasi Ruangan Per No. Mutasi.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

    public function cetak_mutasi_ruang_item()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

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
        <div align="center"><b><u>LAPORAN MUTASI RUANGAN PER ITEM'; 
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
                        <th align="center" width="8%"><b>No. Mutasi</b></th>
                        <th align="center" width="5%"><b>Tgl. Mutasi</b></th>
                        <th align="center" width="10%"><b>Unit Asal</b></th>
                        <th align="center" width="10%"><b>Unit Tujuan</b></th>
                        <th align="center" width="9%"><b>No. PM</b></th>
                        <th align="center" width="6%"><b>Kode</b></th>
                        <th align="center" width="21%"><b>Nama Item</b></th>
                        <th align="center" width="4%"><b>Satuan</b></th>
                        <th align="center" width="7%"><b>Jml. Permintaan</b></th>
                        <th align="center" width="7%"><b>Jml. Mutasi</b></th>
                        <th align="center" width="8%"><b>User</b></th>
                        <th align="center" width="7%"><b>Tgl. Update</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $html.='<tr style="border:1px black solid;">
                        <th align="left" width="8%">'.$key['no_mutasi'] .'</th>
                        <th align="center" width="5%">'.tanggal($key['tgl_mutasi']).'</th>
                        <th align="left" width="10%">'.$key['unit_asal']. '</th>
                        <th align="left" width="10%">'.$key['unit_tujuan']. '</th>
                        <th align="left" width="9%">'.$key['no_pm'] .'</th>
                        <th align="left" width="6%">'.$key['kd_item']. '</th>
                        <th align="left" width="21%">'.$key['nama_item']. '</th>
                        <th align="left" width="4%">'.$key['nama_satuan']. '</th>
                        <th align="right" width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_minta']).'</th>
                        <th align="right" width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_mutasi']).'</th>
                        <th align="left" width="8%">'.$key['user_fullname'].'</th>
                        <th align="center" width="7%">'.tanggal_time($key['date_upd']).'</th>
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
        
            $pdf->Output("assets/laporan/"."Laporan Mutasi Ruangan Per Item.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }

    public function cetak_retur_mutasi_nota()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

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
        <div align="center"><b><u>LAPORAN RETUR MUTASI RUANGAN PER NO. RETUR'; 
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
                        <th align="left" width="8%">No. Retur</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['no_rt_mutasi'].'</th>
                        <th align="center" width="10%">Tgl. Retur :</th>
                        <th align="left" width="10%">'.tanggal($key['tgl_rt_mutasi']).'</th>
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
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Tujuan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['unit_tujuan'].'</th>
                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.tanggal_time($key['date_upd']).'</th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['ket_rt_mutasi'].'</th>
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
                        <th align="center" width="15%"><b>No. Mutasi</b></th>
                        <th align="center" width="14%"><b>Kode</b></th>
                        <th align="center" width="44%"><b>Nama Item</b></th>
                        <th align="center" width="14%"><b>Satuan</b></th>
                        <th align="center" width="13%"><b>Jml. Retur</b></th>
                    </tr>';
                    $no=1;
                    
                	foreach ($result['data'][$i]['detail'] as $key)
                    {
	                    $html.='<tr style="border:1px black solid;">
	                    	<th align="center">'.$key['no_mutasi'] .'</th>
	                        <th align="left">'.$key['kd_item'].' </th>
	                        <th align="left">'.$key['nama_item'].'</th>
	                        <th align="center">'.$key['nama_satuan'].'</th>
	                        <th align="right">'.angka($key['jml_retur'],0).'</th>
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
        // print_r($html);die ;

        if ($param['type_file']==2)
        {
            # code...
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Retur Mutasi Ruangan Per No. Retur.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }

    public function cetak_retur_mutasi_item()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 47, 10);
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
        <div align="center"><b><u>LAPORAN RETUR MUTASI RUANGAN PER ITEM'; 
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
                        <th align="center" width="8%"><b>No. Retur</b></th>
                        <th align="center" width="5%"><b>Tgl. Retur</b></th>
                        <th align="center" width="10%"><b>Unit Asal</b></th>
                        <th align="center" width="10%"><b>Unit Tujuan</b></th>
                        <th align="center" width="9%"><b>No. Mutasi</b></th>
                        <th align="center" width="6%"><b>Kode</b></th>
                        <th align="center" width="25%"><b>Nama Item</b></th>
                        <th align="center" width="4%"><b>Satuan</b></th>
                        <th align="center" width="7%"><b>Jml. Retur</b></th>
                        <th align="center" width="8%"><b>User</b></th>
                        <th align="center" width="7%"><b>Tgl. Update</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $html.='<tr style="border:1px black solid;">
                        <th align="left" width="8%">'.$key['no_rt_mutasi'] .'</th>
                        <th align="center" width="5%">'.tanggal($key['tgl_rt_mutasi']).'</th>
                        <th align="left" width="10%">'.$key['unit_asal']. '</th>
                        <th align="left" width="10%">'.$key['unit_tujuan']. '</th>
                        <th align="left" width="9%">'.$key['no_mutasi'] .'</th>
                        <th align="left" width="6%">'.$key['kd_item']. '</th>
                        <th align="left" width="25%">'.$key['nama_item']. '</th>
                        <th align="center" width="4%">'.$key['nama_satuan']. '</th>
                        <th align="right" width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_retur']).'</th>
                        <th align="center" width="8%">'.$key['user_fullname'].'</th>
                        <th align="center" width="7%">'.tanggal_time($key['date_upd']).'</th>
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
        
            $pdf->Output("assets/laporan/"."Laporan Retur Mutasi Ruangan Per Item.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }

    public function cetak_retur_ed_nota()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

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
        <div align="center"><b><u>LAPORAN DEPO RETUR (BARANG ED) PER NO. RETUR'; 
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
                        <th align="left" width="8%">No. Retur</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['no_rt_mutasi'].'</th>
                        <th align="center" width="10%">Tgl. Retur :</th>
                        <th align="left" width="10%">'.tanggal($key['tgl_rt_mutasi']).'</th>
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
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Tujuan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['unit_tujuan'].'</th>
                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.tanggal_time($key['date_upd']).'</th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['ket_rt_mutasi'].'</th>
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
                        <th align="center" width="10%"><b>Kode</b></th>
                        <th align="center" width="50%" colspan="6"><b>Nama Item</b></th>
                        <th align="center" width="7%"><b>Satuan</b></th>
                        <th align="center" width="10%"><b>Jml. Retur</b></th>
                        <th align="center" width="13%"><b>Tgl. Kedaluwarsa</b></th>
                        <th align="center" width="10%"><b>No. Batch</b></th>
                    </tr>';
                    $no=1;
                    
                	foreach ($result['data'][$i]['detail'] as $key)
                    {
	                    $html.='<tr style="border:1px black solid;">
	                    	<th align="left" width="10%">'.$key['kd_item'].' </th>
	                        <th align="left" width="50%" colspan="6">'.$key['nama_item'].'</th>
	                        <th align="center" width="7%">'.$key['nama_satuan'].'</th>
	                        <th align="right" width="10%">'.angka($key['jml_retur'],0).'</th>
	                        <th align="center" width="13%">'.tanggal($key['tgl_ed']).'</th>
	                        <th align="center" width="10%">'.$key['no_batch'].'</th>
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
        // print_r($html);die ;

        if ($param['type_file']==2)
        {
            # code...
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Depo Retur (Barang ED) Per No. Retur.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }

    public function cetak_retur_ed_item()
    {
    	set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();

        $param            = $this->input->post();
        $lap              = $param['url'];
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
            header("Content-Disposition: attachment; filename=Laporan_mutasi_barang.xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 47, 10);
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
        <div align="center"><b><u>LAPORAN DEPO RETUR (BARANG ED) PER ITEM'; 
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
                        <th align="center" width="8%"><b>No. Retur</b></th>
                        <th align="center" width="5%"><b>Tgl. Retur</b></th>
                        <th align="center" width="10%"><b>Unit Asal</b></th>
                        <th align="center" width="10%"><b>Unit Tujuan</b></th>
                        <th align="center" width="6%"><b>Kode</b></th>
                        <th align="center" width="22%"><b>Nama Item</b></th>
                        <th align="center" width="4%"><b>Satuan</b></th>
                        <th align="center" width="6%"><b>Jml. Retur</b></th>
                        <th align="center" width="8%"><b>Tgl. Kedaluwarsa</b></th>
                        <th align="center" width="6%"><b>No. Batch</b></th>
                        <th align="center" width="8%"><b>User</b></th>
                        <th align="center" width="7%"><b>Tgl. Update</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $html.='<tr style="border:1px black solid;">
                        <th align="left" width="8%">'.$key['no_rt_mutasi'] .'</th>
                        <th align="center" width="5%">'.tanggal($key['tgl_rt_mutasi']).'</th>
                        <th align="left" width="10%">'.$key['unit_asal']. '</th>
                        <th align="left" width="10%">'.$key['unit_tujuan']. '</th>
                        <th align="left" width="6%">'.$key['kd_item']. '</th>
                        <th align="left" width="22%">'.$key['nama_item']. '</th>
                        <th align="left" width="4%">'.$key['nama_satuan']. '</th>
                        <th align="right" width="6%" formatter: appGridNumberFormatter>'.angka($key['jml_retur']).'</th>
						<th align="center" width="8%">'.tanggal($key['tgl_ed']).'</th>
						<th align="left" width="6%">'.$key['no_batch'].'</th>
                        <th align="center" width="8%">'.$key['user_fullname'].'</th>
                        <th align="center" width="7%">'.tanggal_time($key['date_upd']).'</th>
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
        
            $pdf->Output("assets/laporan/"."Laporan Depo Retur (Barang ED) Per Item.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }
}

/* End of file Lap_mutasi_barang.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Lap_mutasi_barang.php */