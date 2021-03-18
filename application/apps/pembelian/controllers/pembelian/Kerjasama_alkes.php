<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerjasama_alkes extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
		$this->data['js'] = 'pembelian/kerjasama_alkes_js';
        $this->data['main_view'] = 'pembelian/v_kerjasama_alkes';
		$this->load->view('template', $this->data);
	}

	public function filter()
    {
        $param = $this->input->post();
        
        $data['tampil_semua'] = $param['tampil_semua'] ?? 0;
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/kerjasama/alkes/search');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
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

    public function filter_produsen()
    {
        $param = $this->input->post();
        
        // $data['page'] = $param['page'] ?? 1;
        // $data['page_row'] = $param['rows'] ?? 10;
        // $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/produsen/list');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
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

    public function filter_barang()
    {
        $param = $this->input->post();
        
		$data['id_produsen'] = $param['id_produsen'] ?? '';
		$data['page']        = $param['page'] ?? 1;
		$data['page_row']    = $param['rows'] ?? 10;
		$data['criteria']    = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/kerjasama/alkes/list_item');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
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

    public function getKerjasama()
    {
        $API = BASE_URL_API_LPS."pembelian/farmasi/kerjasama/alkes/get/".$_POST['data'];
        
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

        $data = [];
        if (count($result['master'])> 0)
        {
            $data['master']=$result['master'][0];
            $data['details']=$result['detail'];
        }
        echo json_encode($data);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if (isset($_POST['master']['no_kerjasama_item'])) {
            $url = BASE_URL_API_LPS.'pembelian/farmasi/kerjasama/alkes/update';
        }else{
            $url = BASE_URL_API_LPS.'pembelian/farmasi/kerjasama/alkes/insert';
        }

        // echo json_encode($_POST); die();

        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST));

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

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/kerjasama/alkes/delete');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
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

    public function filter_cetak()
    {
    	# code...
    	$headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_API_LPS.'pembelian/farmasi/kerjasama/cetak';
		
		$type_buffer               = $param['buffer']??false;
        $cek                       = $param['cek']??0;
		
		$data['no_kerjasama_item'] = $param['no_kerjasama_item'];
		$data['rpt_period']        = $param['rpt_period'];
		$data['start_date']        = $param['start_date'];
		$data['end_date']          = $param['end_date'];
		$data['month_period']      = $param['month_period'];
		$data['year_period']       = $param['year_period'];

		
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
        
        if ($cek==1)
        {
            # code...
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

        $result = $this->filter_cetak();
        $master = $result['data'][0];
        // print_r($result);
        $param            = $this->input->post();
        $no_kerjasama_item= $param['no_kerjasama_item'];
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
            header("Content-Disposition: attachment; filename=Laporan_kerjasama_pembelian_alkes.xls");

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
                font-size: 7px;
            }
            .border {
                border:0.6px solid black
            }
        </style>
        <div align="center"><b><u>LAPORAN KERJASAMA PEMBELIAN ALKES PRODUSEN'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $sebelum =0;
        $html.='</div><br>';
            $i=0;

        foreach ($result['data'] as $key) {
            if($key['no_urut']==1){
            $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black">
                <tr>
                    <th align="left" width="7%"><b>Nama Produsen</b></th>
                    <th align="left" width="10%"><b>: '.$key['nama_produsen'].'</b></th>
                    <th align="left" width="3%"></th>
                    <th align="center" width="60%"><b></b></th>
                    <th align="center" width="10%"><b>Tgl. Awal Berlaku</b></th>
                    <th align="center" width="10%"><b>: '.tanggal($key['tgl_awal']).'</b></th>
                </tr>
                <tr>
                    <th align="left" width="7%"><b>No. IKS</b></th>
                    <th align="left" width="10%"><b>: '.$key['no_iks'].'</b></th>
                    <th align="left" width="3%"></th>
                    <th align="center" width="60%"><b></b></th>
                    <th align="center" width="10%"><b>Tgl. Akhir Berlaku</b></th>
                    <th align="center" width="10%"><b>: '.tanggal($key['tgl_awal']).'</b></th>
                </tr>
                </table>
                ';
                $sebelum=1;
            }
                
            $html.='<table class="atas" cellspacing="0" style="width: 100%;">';
                    if($sebelum==1 && $key['no_urut']==2){
                        $html.='
                        <tr>
                            <td  align="left" width="40%"><b>'.$key['nama_item'].'</b></td>
                        </tr>
                            <tr>
                            <th class="border" align="center" width="40%"><b>Nama Supplier</b></th>
                            <th class="border" align="center" width="10%"><b>Jumlah</b></th>
                            <th class="border" align="center" width="10%"><b>Satuan</b></th>
                            <th class="border" align="center" width="10%"><b>Harga</b></th>
                            <th class="border" align="center" width="10%"><b>Diskon(%)</b></th>
                            <th class="border" align="center" width="20%"><b>Total Diskon</b></th>
                        </tr>';
                    }
                    if($key['no_urut']==2){
                    $html.='
                    <tr style="border:1px black solid;">
                        <td class="border" align="left" width="40%">'.$key['partner_name'].'</td>
                        <td class="border" align="right" width="10%">'.angka($key['jml'],0).'</td>
                        <td class="border" align="center" width="10%">'.$key['nama_satuan'].'</td>
                        <td class="border" align="right" width="10%">'.angka($key['harga'],0).'</td>
                        <td class="border" align="right" width="10%">'.angka($key['p_diskon_off'],0).'</td>
                        <td class="border" align="right" width="20%">'.angka($key['tot_diskon'],0).'</td>
                    </tr>
                    ';
                    $sebelum=2;
                    }
                    if($key['no_urut']==3){
                    $html.='
                    <tr style="border:1px black solid;">
                        <td class="border" align="right" colspan="5" width="80%"><b>SUB TOTAL :</b></td>
                        <td class="border" align="right" width="20%">'.angka($key['tot_diskon'],0).'</td>
                    </tr>';
                    $sebelum=3;
                    }
                    if($key['no_urut']==4){
                    $html.='
                    <tr style="border:1px black solid;">
                        <td class="border" align="right" colspan="5" width="80%"><b>TOTAL :</b></td>
                        <td class="border" align="right" width="20%">'.angka($key['tot_diskon'],0).'</td>
                    </tr>';
                    $sebelum=4;
                    }

                    $html.='
                    </table>';
            
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
        
            $pdf->Output("assets/laporan/"."Laporan Kerjasama Pembelian Alkes ".$no_kerjasama_item.".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }
}

/* End of file Kerjasama_alkes.php */
/* Location: ./application/apps/pembelian/controllers/pembelian/Kerjasama_alkes.php */