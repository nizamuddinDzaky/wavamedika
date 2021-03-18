<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outstanding_po_general extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
		$this->data['js'] = 'laporan/outstanding_po_general_js';
        $this->data['main_view'] = 'laporan/v_outstanding_po_general';
		$this->load->view('template', $this->data);
	}

	public function filter_supplier()
    {
        $param = $this->input->post();
        // echo json_encode($param);die;
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'master/supplier/list');
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

    public function filter()
    {
        $headers  = getHeaderToken();;
        $curl_handle = curl_init();
        
        $param = $this->input->post();

        $url = BASE_URL_FARMASI.'laporan/pembelian/umum/po/outstanding';
        // echo $url;die;
        $type_buffer          = $param['buffer']??false;
        
        $data['rpt_period']   = $param['rpt_period'];
        $data['rpt_type']     = $param['rpt_type'];
        $data['start_date']   = $param['start_date'];
        $data['end_date']     = $param['end_date'];
        $data['month_period'] = $param['month_period'];
        $data['year_period']  = $param['year_period'];
        $data['partner_id']   = $param['partner_id'];

        if ($param['rpt_type']==1)
        {
            $data['page_row'] = $param['rows']??1;
            $data['page']     = $param['page']??10;
        }

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

    public function cetak($value=''){
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $param = $this->input->post();
        $data = $this->filter();
        // print_r($data['data']);die;
        $this->load->library('Pdf');
        // $thi
        $tipe             = $param['rpt_period'];
        $start_date       = $param['start_date'];
        $end_date         = $param['end_date'];
        $month_period     = $param['month_period'];
        $year_period      = $param['year_period'];
        $year_period_text = $param['year_period_text'];
        if ($param['type_file']==2){
            # code...
            // print_r($param);die;
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$param['file_name'].".xls");

        }
        else{
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 15, 10);
            // $pdf->AddPage("P", "F4");
            $pdf->AddPage("P", "F4");
            $pdf->SetFont("helvetica", "", 9);
        }

        $hue='
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
            .border{
                border:0.6px solid black;
            }

        </style>
        <br><br><br><br>
        <div align="center"><b><u>LAPORAN OUTSTANDING ORDER PEMBELIAN';
        $hue.='</u></b><br>';
        if($param['rpt_period']==1){
            $hue.='Tanggal '.convert_date_to_indonesia($start_date).' s/d '.convert_date_to_indonesia($end_date).'';
        }else if($param['rpt_period']==2){
            $hue.='Bulan '.convert_to_bulan($month_period).' Tahun '.$year_period.'';
        }else{
            $hue.='Tahun '.$year_period.'';
        }
        $hue.='</div><br>';

        $hue .= '<table class="atas" id="dtg-lap_persediaan" cellspacing="0" style="width: 100%;">
                    
                    <tr>
                        <th class="border" halign="center" align="center" width="5%"><b>No</b></th>
                        <th class="border" halign="center" align="center" width="20%"><b>Supplier</b></th>
                        <th class="border" halign="center" align="center" width="12%"><b>No. PO</b></th>
                        <th class="border" halign="center" align="center" width="9%"><b>Tgl. PO</b></th>
                        <th class="border" halign="center" align="center" width="9%"><b>Kode</b></th>
                        <th class="border" halign="center" align="center" width="11%"><b>Nama Item</b></th>
                        <th class="border" halign="center" align="center" width="7%"><b>Satuan</b></th>
                        <th class="border" halign="center" align="center" width="7%"><b>Jml. PO</b></th>
                        <th class="border" halign="center" align="center" width="7%"><b>Jml. Terima</b></th>
                        <th class="border" halign="center" align="center" width="7%"><b>Sisa</b></th>
                        <th class="border" halign="center" align="center" width="7%"><b>Sisa (Rp)</b></th>
                    </tr>';
            foreach ($data['data'] as $key => $value) {
            $hue.='<tr>
                        <td class="border" halign="center" align="center">'.($key+1).'</td>
                        <td class="border" halign="center" align="center">'.$value['partner_name'].'</td>
                        <td class="border" halign="center" align="center">'.$value['no_po'].'</td>
                        <td class="border" halign="center" align="center">'.tanggal($value['tgl_po']).'</td>
                        <td class="border" halign="center" align="center">'.$value['kd_item'].'</td>
                        <td class="border" halign="center" align="center">'.$value['nama_item'].'</td>

                        <td class="border" halign="center" align="right">'.angka($value['nama_satuan']).'</td>
                        <td class="border" halign="center" align="right">'.angka($value['jml_po']).'</td>

                        <td class="border" halign="center" align="right">'.angka($value['jml_bpb']).'</td>
                        <td class="border" halign="center" align="right">'.angka($value['total']).'</td>
                        <td class="border" halign="center" align="right">'.angka($value['tot_persen']).'</td>
                </tr>';
            }

        $hue .='</table>';
        if ($param['type_file']==2){
            echo $hue;
        }
        else{
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$param['file_name'], "F");
            $return["success"] = TRUE;
            $return['file_name'] = $param['file_name'];
            echo json_encode($return);
        }
    }

}

/* End of file Outstanding_po_general.php */
/* Location: ./application/apps/general/controllers/laporan/Outstanding_po_general.php */