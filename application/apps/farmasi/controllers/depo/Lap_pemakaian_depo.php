<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pemakaian_depo extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }
    public function index()
    {
        $this->data['js'] = 'depo/lap_pemakaian_depo_js';
        $this->data['main_view'] = 'depo/v_lap_pemakaian_depo';
        $this->load->view('template', $this->data);
    }

    public function get_unit_asal()
    {
        $headers  = getHeaderToken();
        $data = [
            'user_id' => $this->session->userdata('user_id')
        ];
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/list_unit_stok/farmasi');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));

        // Optional, delete this line if your API is open
        $buffer = curl_exec($curl_handle);
        $result=json_decode($buffer,true);
        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '',
            'text' => 'Pilih unit Asal',
        ];
        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_unit_tujuan()
    {
        $API_UNIT = BASE_URL_API_LPS."master/list_unit_stok/farmasi";
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_UNIT);
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
            'id' => '',
            'text' => 'Pilih unit Tujuan',
        ];

        foreach ($result['data'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_API_LPS.'laporan/mutasi/farmasi/pemakaian_depo';
        // echo $url;die;
        $type_buffer          = $param['buffer']??false;
        
        $data['rpt_period']   = $param['rpt_period'];
        $data['rpt_type']     = $param['rpt_type'];
        $data['start_date']   = $param['start_date'];
        $data['end_date']     = $param['end_date'];
        $data['month_period'] = $param['month_period'];
        $data['year_period']  = $param['year_period'];
        $data['id_unit_asal']      = $param['id_unit_asal'];
        $data['id_unit_tujuan']      = $param['id_unit_tujuan'];
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
        $name_unit_asal = $param['name_unit_asal'];
        $name_unit_tujuan = $param['name_unit_tujuan'];



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
            .border{
                border: 0.6px solid black;
            }
        </style>
        <div align="center"><b><u>Laporan Pemakaian Depo'; 
        $html.='</u></b><br>';
        if($tipe==1){
            $html.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($tipe==2){
            $html.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $html.='Tahun '.$year_period.'';
        }
        $html.='</div><br>';
        $html.='<table class="master" cellspacing="0" style="width: 100%; border: 0.6px solid black;">
                    <tr>
                        <th align="left" width="8%">Unit Asal</th>
                        <th align="left" width="32%">: '.$name_unit_asal.'</th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Tujuan</th>
                        <th align="left" width="32%">: '.$name_unit_tujuan.'</th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="10%"></th>
                    </tr>
                </table>
                ';
        $html.='<table class="atas" cellspacing="0" style="width: 100%;">
        <tr>
            <th class="border" align="center" width="13%"><b>No. Pengeluaran</b></th>
            <th class="border" align="center" width="10%"><b>Tgl. Keluar</b></th>
            <th class="border" align="center" width="10%"><b>Kode</b></th>
            <th class="border" align="center" width="29%"><b>Nama Item</b></th>
            <th class="border" align="center" width="8%"><b>Satuan</b></th>
            <th class="border" align="center" width="10%"><b>Jumlah</b></th>
            <th class="border" align="center" width="10%"><b>HPP</b></th>
            <th class="border" align="center" width="10%"><b>Subtotal</b></th>
        </tr>';
        $no=1;
        $sub_total = 0;
        if(count($result['data'])>0) {
            foreach ($result['data'] as $val)
            {
                $html.='<tr>
                    <td class="border" align="center" >'.$val['no_mutasi'].'</td>
                    <td class="border" align="center" >'.tanggal($val['tgl_mutasi']).'</td>
                    <td class="border" align="center" >'.$val['kd_item'].'</td>
                    <td class="border" align="left" >'.$val['nama_item'].'</td>
                    <td class="border" align="center" >'.$val['nama_satuan'].'</td>
                    <td class="border" align="center" >'.angka($val['jml_mutasi']).'</td>
                    <td class="border" align="center" >'.angka($val['hpp']).'</td>
                    <td class="border" align="center" >'.angka($val['sub_total']).'</td>
                </tr>';
                $sub_total+=$val['sub_total'];
            }
            $html.='<tr>
                <td class="border" align="right" colspan="7"><b>Total :</b></td>
                <td class="border" align="center"><b>'.$sub_total.'</b></td>
            </tr>';
            $html.='</table><br></br>';
        }
        if ($param['type_file']==2)
        {
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan Pemakaian Depo.pdf", "F");
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

/* End of file Lap_pemakaian_depo.php */
/* Location: ./application/apps/farmasi/controllers/depo/Lap_pemakaian_depo.php */