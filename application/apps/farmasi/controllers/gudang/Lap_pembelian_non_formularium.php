<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pembelian_non_formularium extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
		$this->data['js'] = 'gudang/lap_pembelian_non_formularium_js';
        $this->data['main_view'] = 'gudang/v_lap_pembelian_non_formularium';
        $this->load->view('template', $this->data);
	}

	public function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_FARMASI.'laporan/pembelian/farmasi/non_formularium';
        // echo $url;die;
        $type_buffer          = $param['buffer']??false;
        
        $data['rpt_period']   = $param['rpt_period'];
        $data['rpt_type']     = $param['rpt_type'];
        $data['start_date']   = $param['start_date'];
        $data['end_date']     = $param['end_date'];
        $data['month_period'] = $param['month_period'];
        $data['year_period']  = $param['year_period'];
       /* $data['id_unit_asal']      = $param['id_unit_asal'];
        $data['id_unit_tujuan']      = $param['id_unit_tujuan'];*/
        // echo json_encode($headers);die;

        if ($param['rpt_type']==1)
        {
            # code...
            $data['page_row'] = $param['rows']??1;
            $data['page']     = $param['page']??10;
        }

        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // echo json_encode($data);die();
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
        // print_r($buffer);die;
        $result=json_decode($buffer,$type_buffer);
        
        if($param['rpt_type']==1)
        {
            echo json_encode($result);
        }
        else
        {
            // echo "astagh";die;
            return $result;
            // print_r($result);die;
        }
    }

    public function check_data()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();
        if (isset($result['data'])) {
            $return["success"] = TRUE;
            echo json_encode($return);
        }
    }

    public function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();
        // echo "string";die;
        // print_r($result);die;

        $param            = $this->input->post();
        /*$lap              = $param['url'];*/
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];
        /*$name_unit_asal = $param['name_unit_asal'];
        $name_unit_tujuan = $param['name_unit_tujuan'];*/



        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan Pemakaian Depo.xls");

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
        <div align="center"><b><u>Laporan Pembelian Non Formularium'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $html.='</div><br>';
        $html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;" border="1">
        <tr>
            <th align="center"><b>Kode</b></th>
            <th align="center"><b>Nama Obat/Alkes</b></th>
            <th align="center"><b>Satuan</b></th>
            <th align="center"><b>Jenis</b></th>
            <th align="center"><b>Jumlah</b></th>
            <th align="center"><b>ID Dokter</b></th>
            <th align="center"><b>Nama Dokter</b></th>
        </tr>';
        $no=1;
        $sub_total = 0;
        if (isset($result['data'])) {
            foreach ($result['data'] as $val)
            {
                $html.='<tr>
                    <td align="center">'.$val['kd_item'].'</td>
                    <td align="left">'.$val['nama_item'].'</td>
                    <td align="center">'.$val['nama_satuan'].'</td>
                    <td align="center">'.$val['nama_kel_item'].'</td>
                    <td align="right">'.angka($val['jml']).'</td>
                    <td align="center">'.angka($val['id_dokter']).'</td>
                    <td align="left">'.$val['nama_dokter'].'</td>
                </tr>';
            }
            $html.='</table><br></br>';
        }
        if ($param['type_file']==2)
        {
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Pembelian Non Formularium.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }

}

/* End of file Lap_pembelian_non_formularium.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Lap_pembelian_non_formularium.php */