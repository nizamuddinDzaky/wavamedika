<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_koreksi_stok extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }
    public function index()
    {
        $this->data['js'] = 'gudang/lap_koreksi_stok_js';
        $this->data['main_view'] = 'gudang/v_lap_koreksi_stok';
        $this->load->view('template', $this->data);
    }

    public function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_API_LPS.'laporan/koreksi_stok/farmasi/'.$param['url'];
        // echo $url;die;
        $type_buffer          = $param['buffer']??false;
        
        $data['rpt_period']   = $param['rpt_period'];
        $data['rpt_type']     = $param['rpt_type'];
        $data['start_date']   = $param['start_date'];
        $data['end_date']     = $param['end_date'];
        $data['month_period'] = $param['month_period'];
        $data['year_period']  = $param['year_period'];
        $data['id_unit']      = $param['id_unit'];
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

    public function get_data_unit()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/list_unit_stok/farmasi');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function cetak_so_rekap()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();
        // echo "string";die;
        // var_dump($result);die;

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
            header("Content-Disposition: attachment; filename=Laporan Rekap Koreksi Stok.xls");

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
                border:0.6px solid black;
            }
        </style>
        <div align="center"><b><u>Rekap Koreksi Stok'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $html.='</div><br>';

        $html.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th class="border" align="center" colspan="5" width="60%"><b>Data Item</b></th>
                        <th class="border" align="center" colspan="2" width="20%"><b>Selisih SO</b></th>
                        <th class="border" align="center" colspan="2" width="20%"><b>Nilai Koreksi Stok</b></th>
                    </tr>
                    <tr>
                        <th class="border" align="center" width="15%"><b>Unit</b></th>
                        <th class="border" align="center" width="8%"><b>Kode</b></th>
                        <th class="border" align="center" width="21%"><b>Nama Item</b></th>
                        <th class="border" align="center" width="8%"><b>Satuan</b></th>
                        <th class="border" align="center" width="8%"><b>Jenis</b></th>
                        <th class="border" align="center" width="10%"><b>Lebih</b></th>
                        <th class="border" align="center" width="10%"><b>Kurang</b></th>
                        <th class="border" align="center" width="10%"><b>Lebih</b></th>
                        <th class="border" align="center" width="10%"><b>Kurang</b></th>
                    </tr>';
        foreach ($result['data'] as $key => $value) {
                $html.='<tr>
                            <td class="border" align="left"> '.$value['nama_unit'].'</td>
                            <td class="border" align="center"> '.$value['kd_item'].'</td>
                            <td class="border" align="left"> '.$value['nama_item'].'</td>
                            <td class="border" align="center"> '.$value['nama_satuan'].'</td>
                            <td class="border" align="center"> '.angka($value['jenis']).'</td>
                            <td class="border" align="center"> '.angka($value['jml_selisih_lebih']).'</td>
                            <td class="border" align="center"> '.angka($value['jml_selisih_kurang']).'</td>
                            <td class="border" align="center"> '.angka($value['nilai_selisih_lebih']).'</td>
                            <td class="border" align="center"> '.angka($value['nilai_selisih_kurang']).'</td>
                        </tr>'; 
        }

        $html.='</table><br></br>';
        if ($param['type_file']==2)
        {
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Rekap Koreksi Stok.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }


    public function cetak_so_item()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();
        // echo "string";die;
        // var_dump($result);die;

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
            header("Content-Disposition: attachment; filename=Laporan Koreksi Stok Per Item.xls");

        }

        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(5, 45, 5);
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
                border: 0.6px solid black;
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
                border:0.6px solid black;
            }
        </style>
        <div align="center"><b><u>Koreksi Stok Per Item'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $html.='</div><br>';

        $html.='<table class="atas" cellspacing="0" style="width: 100%">
                    <tr>
                        <th class="border" align="center" width="6%"><b>Periode</b></th>
                        <th class="border" align="center" width="7%"><b>N0. SO</b></th>
                        <th class="border" align="center" width="9%"><b>Unit</b></th>
                        <th class="border" align="center" width="4%"><b>Kode</b></th>
                        <th class="border" align="center" width="11%"><b>Nama Item</b></th>
                        <th class="border" align="center" width="4%"><b>Satuan</b></th>
                        <th class="border" align="center" width="5%"><b>Jml. Sistem</b></th>
                        <th class="border" align="center" width="5%"><b>Jml. Fisik</b></th>
                        <th class="border" align="center" width="6%"><b>Jml. Selisih Lebih</b></th>
                        <th class="border" align="center" width="6%"><b>Jml. Selisih Kurang</b></th>
                        <th class="border" align="center" width="8%"><b>Keterangan</b></th>
                        <th class="border" align="center" width="3%"><b>HPP</b></th>
                        <th class="border" align="center" width="6%"><b>Nilai Selisih Lebih</b></th>
                        <th class="border" align="center" width="6%"><b>Nilai Selisih Kurang</b></th>
                        <th class="border" align="center" width="8%"><b>Dibuat Oleh</b></th>
                        <th class="border" align="center" width="6%"><b>Tgl. SO</b></th>
                    </tr>';

                    foreach ($result['data'] as $key => $val) {
                        $html.='<tr>
                            <td class="border" align="center">'.$val['periode'].'</td>
                            <td class="border" align="left">'.$val['no_so'].'</td>
                            <td class="border" align="left">'.$val['nama_unit'].'</td>
                            <td class="border" align="center">'.$val['kd_item'].'</td>
                            <td class="border" align="left">'.$val['nama_item'].'</td>
                            <td class="border" align="center">'.$val['nama_satuan'].'</td>
                            <td class="border" align="center">'.angka($val['jml_sistem']).'</td>
                            <td class="border" align="center">'.angka($val['jml_fisik']).'</td>
                            <td class="border" align="center">'.angka($val['jml_selisih_lebih']).'</td>
                            <td class="border" align="center">'.angka($val['jml_selisih_kurang']).'</td>
                            <td class="border" align="left">'.$val['nama_ket_selisih'].'</td>
                            <td class="border" align="center">'.angka($val['hpp']).'</td>
                            <td class="border" align="center">'.angka($val['nilai_selisih_lebih']).'</td>
                            <td class="border" align="center">'.angka($val['nilai_selisih_kurang']).'</td>
                            <td class="border" align="center">'.$val['user_fullname'].'</td>
                            <td class="border" align="center">'.tanggal($val['tgl_so_det']).'</td>
                        </tr>'; 
                    }
        $html.='</table><br></br>';

        if ($param['type_file']==2)
        {
            # code...
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Koreksi Stok Per Item.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
        }
    }


    public function cetak_so_nota()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter();
        // echo "string";die;
        // var_dump($result);die;

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
            header("Content-Disposition: attachment; filename=Laporan Koreksi Stok Per No. Stok Opname.xls");

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
            .border{
              border: 0.6px solid black;
            }
        </style>
        <div align="center"><b><u>Koreksi Stok Per No. Stok Opname'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $html.='</div><br>';
        foreach ($result['data'] as $key => $value) {
            $html.='<table class="master" cellspacing="0" style="width: 100%; border: 0.6px solid black;">
                    <tr>
                        <th align="left" width="15%">No. SO</th>
                        <th align="left" width="20%">: '.$value['no_so'].'</th>
                        <th align="center" width="12%"></th>
                        <th align="center" width="7%">Periode :</th>
                        <th align="left" width="12%">'.$value['periode'].'</th>
                        <th align="center" width="7%"></th>
                        <th align="right" width="7%">Catatan :</th>
                        <th colspan="2" align="left" width="20%">'.$value['catatan'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="15%">Unit Asal</th>
                        <th align="left" width="20%">: '.$value['nama_unit'].'</th>
                        <th align="center" width="12%"></th>
                        <th align="center" width="7%"></th>
                        <th align="center" width="12%"></th>
                        <th align="center" width="7%"></th>
                        <th align="center" width="7%"></th>
                        <th colspan="2" align="center" width="20%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="15%">Penanggung Jawab</th>
                        <th align="left" width="20%">: '.$value['user_fullname'].'</th>
                        <th align="center" width="12%"></th>
                        <th align="center" width="7%"></th>
                        <th align="center" width="12%"></th>
                        <th align="center" width="7%"></th>
                        <th align="center" width="7%"></th>
                        <th colspan="2" align="center" width="20%"></th>
                    </tr>
                </table>
                ';

                if(count($value['detail'])>0)
                {
                    $html.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th class="border" align="center" width="8%"><b>Kode</b></th>
                        <th class="border" align="center" width="22%"><b>Nama Item</b></th>
                        <th class="border" align="center" width="7%"><b>Satuan</b></th>
                        <th class="border" align="center" width="9%"><b>Jml. Sistem</b></th>
                        <th class="border" align="center" width="9%"><b>Jml. Fisik</b></th>
                        <th class="border" align="center" width="9%"><b>Jml. Selisih</b></th>
                        <th class="border" align="center" width="14%"><b>Keterangan</b></th>
                        <th class="border" align="center" width="9%"><b>Tanggal</b></th>
                        <th class="border" align="center" width="13%"><b>User</b></th>
                    </tr>';
                    $no=1;
                    
                    foreach ($value['detail'] as $val)
                    {
                        $html.='<tr>
                            <td class="border" align="center">'.$val['kd_item'].'</td>
                            <td class="border" align="left">'.$val['nama_item'].'</td>
                            <td class="border" align="center">'.$val['nama_satuan'].'</td>
                            <td class="border" align="center">'.angka($val['jml_sistem']).'</td>
                            <td class="border" align="center">'.angka($val['jml_fisik']).'</td>
                            <td class="border" align="center">'.angka($val['jml_selisih']).'</td>
                            <td class="border" align="center">'.$val['nama_ket_selisih'].'</td>
                            <td class="border" align="center">'.tanggal($val['tgl_so_det']).'</td>
                            <td class="border" align="center">'.$val['user_fullname'].'</td>
                        </tr>'; 
                    }
                    $html.='</table><br></br>';
                }
                $html.='
                <br></br>';
                // $i++; 
        }

        if ($param['type_file']==2)
        {
            # code...
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Koreksi Stok Per No. Stok Opname.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);   
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
}

/* End of file Lap_koreksi_stok.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Lap_koreksi_stok.php */