<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pembelian_general extends CI_Controller {
   var $myArray= [];

     function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
    }

	public function index()
	{
        $this->data['js'] = 'laporan/lap_pembelian_general_js';
        $this->data['main_view'] = 'laporan/v_lap_pembelian_general';
        $this->load->view('template', $this->data);
	}

    public function filter()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();
        $param       = $this->input->post();
        $ket         = $this->ket_laporan();
            
        curl_setopt($curl_handle, CURLOPT_URL, $this->url_cetak($ket['lap']));
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
        // return $result;
        echo json_encode($result);
    }

    public function filter2()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        $ket=$this->ket_laporan();
        curl_setopt($curl_handle, CURLOPT_URL, $this->url_cetak($ket['lap']));
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

        $result=json_decode($buffer,true);
        return $result;
        // echo json_encode($result);
    }

    function url_cetak($lap){
        $url="";
        if($lap==1){
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/minta_beli_nota';
        }elseif ($lap==2) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/minta_beli_item';
        }elseif ($lap==3) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/terima_beli_nota';
        }elseif ($lap==4) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/terima_beli_item';
        }elseif ($lap==5) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/beli_tunai_nota';
        }elseif ($lap==6) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/beli_tunai_item';
        }elseif ($lap==7) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/terima_donasi_nota';
        }elseif ($lap==8) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/terima_donasi_item';
        }elseif ($lap==9) {
            $url=BASE_URL_API_LPS.'laporan/pembelian/umum/ppn_masukan';
        }
        return $url;
    }
    //permintaan pembelian per nota
    function print_transaksi1() {
        // $API_JENIS_TRANSAKSI = BASE_URL_WS_ACCFIN."cash_trans/voucher_print/".$_POST['info'];
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->filter2();
        
        $ket=$this->ket_laporan();
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

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
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.5px solid black;
                font-size: 6px;
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
        <div align="center"><b><u>LAPORAN PERMINTAAN PEMBELIAN PER NOTA'; 
        $hue.='</u></b><br>';
        if($ket['tipe']==1){
            $hue.='Tanggal '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        }else if($ket['tipe']==2){
            $hue.='Bulan '.convert_to_bulan($ket['month_period']).' Tahun '.$ket['year_period'].'';
        }else{
            $hue.='Tahun '.$ket['year_period'].'';
        }
        $hue.='</div><br>';
            $i=0;
            foreach ($result['data'] as $key) {
                $hue.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black">
                    <tr>
                        <th align="left" width="8%">No. PP</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['no_pp'].'</th>';
                    if ($ket['type_file']==2)
                    {
                        $hue.='<th align="left" width="20%"></th>';
                    }
                $hue.=' <th align="center" width="10%">Tgl. PP :</th>
                        <th align="left" width="25%">'.tanggal($key['tgl_pp']).'</th>
                        <th align="left" width="8%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="25%">'.$key['status_caption'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Depo</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['nama_depo'].'</th>';
                    if ($ket['type_file']==2)
                    {
                        $hue.='<th align="left" width="20%"></th>';
                    }
                $hue.=' 
                        <th align="center" width="10%"></th>
                        <th align="left" width="25%"></th>
                        <th align="left" width="8%">User</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="25%">'.$key['user_fullname'].'</th>
                    </tr>  
                    <tr>
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$key['ket_pp'].'</th>';
                    if ($ket['type_file']==2)
                    {
                        $hue.='<th align="left" width="20%"></th>';
                    }
                $hue.=' 
                        <th align="center" width="10%"></th>
                        <th align="left" width="25%"></th>
                        <th align="left" width="8%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="25%">'.tanggal_time($key['date_upd']) .'</th>
                    </tr>    
                </table>
                ';
                $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th class="border" align="center" width="8%"><b>Kode</b></th>
                        <th class="border" align="center" width="47%" colspan="3"><b>Nama Item</b></th>
                        <th class="border" align="center" width="5%"><b>Satuan</b></th>
                        <th class="border" align="center" width="10%"><b>Jml. Stok</b></th>
                        <th class="border" align="center" width="10%"><b>Jml. Pemakaian</b></th>
                        <th class="border" align="center" width="10%"><b>Jml. Permintaan</b></th>
                        <th class="border" align="center" width="10%"><b>Tgl. Kebutuhan</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'][$i]['detail'] as $key) {
                    $hue.='<tr>
                        <td class="border" align="center" width="8%">'.$key['kd_item'] .'</td>
                        <td class="border" align="left" width="47%" colspan="3">'.$key['nama_item'].' </td>
                        <td class="border" align="center"   width="5%">'.$key['nama_satuan']. '</td>
                        <td class="border" align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml_stok'],0).'</td>
                        <td class="border" align="right"  width="10%">'.angka($key['jml_mutasi'],0).'</td>
                        <td class="border" align="right"  width="10%">'.angka($key['jml_minta'],0).'</td>
                        <td class="border" align="center"  width="10%">'.tanggal($key['tgl_kebutuhan']).'</td>
                    </tr>'; 
                    $no++;
                    }
                    $hue.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';
                $i++; 
            }

        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }

    }
    //permintaan pembelian per item
    function print_transaksi2() {
        // $API_JENIS_TRANSAKSI = BASE_URL_WS_ACCFIN."cash_trans/voucher_print/".$_POST['info'];
        $result = $this->filter2();
        $ket=$this->ket_laporan();

        // print_r($result);die;
        $ket=$this->ket_laporan();
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(3, 45, 3);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("L", "F4");
            $pdf->SetFont("helvetica", "", 9);
        }
        
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.6px solid black;
                font-size: 7px;
            }

            td{
                border:0.6px solid black;
            }
        </style>
        <div align="center"><b><u>LAPORAN PERMINTAAN PEMBELIAN PER ITEM';
        $hue.='</u></b><br>';
        if($ket['tipe']==1){
            $hue.='Tanggal '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        }else if($ket['tipe']==2){
            $hue.='Bulan '.convert_to_bulan($ket['month_period']).' Tahun '.$ket['year_period'].'';
        }else{
            $hue.='Tahun '.$ket['year_period'].'';
        }
        $hue.='</div><br>';
            $i=0;
                $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th align="center" width="7%"><b>No. PP</b></th>
                        <th align="center" width="5%"><b>Tgl. PP</b></th>
                        <th align="center" width="9%"><b>Depo</b></th>
                        <th align="center" width="3%"><b>Kode</b></th>
                        <th align="center" width="25%"><b>Nama Item</b></th>
                        <th align="center" width="4%"><b>Satuan</b></th>
                        <th align="center" width="7%"><b>Jml. Stok</b></th>
                        <th align="center" width="7%"><b>Jml. Pemakaian</b></th>
                        <th align="center" width="7%"><b>Jml. Permintaan</b></th>
                        <th align="center" width="7%"><b>Tgl. Kebutuhan</b></th>
                        <th align="center" width="11%"><b>User</b></th>
                        <th align="center" width="8%"><b>Tgl. Update</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $hue.='<tr>
                        <td align="center" width="7%">'.$key['no_pp'] .'</td>
                        <td align="center"   width="5%">'.tanggal($key['tgl_pp']).' </td>
                        <td align="left" width="9%">'.$key['nama_depo']. '</td>
                        <td align="center   " width="3%">'.$key['kd_item']. '</td>
                        <td align="left" width="25%">'.$key['nama_item']. '</td>
                        <td align="center" width="4%">'.$key['nama_satuan']. '</td>
                        <td align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_stok']).'</td>
                        <td align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_mutasi']).'</td>
                        <td align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['jml_minta']).'</td>
                        <td align="center" width="7%">'.tanggal($key['tgl_kebutuhan']).'</td>
                        <td align="center" width="11%">'.$key['user_fullname'].'</td>
                        <td align="center" width="8%">'.tanggal_time($key['date_upd']).'</td>
                    </tr>'; 
                    $no++;
                    }
                    $hue.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';

        // $pdf->Header();
        // echo $hue;
        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }
    }

    function print_transaksi3() {
        // $API_JENIS_TRANSAKSI = BASE_URL_WS_ACCFIN."cash_trans/voucher_print/".$_POST['info'];
        $result = $this->filter2();
        $ket    = $this->ket_laporan();

        // print_r($result);
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

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
        
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.5px solid black;
                font-size: 6px;
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
        <div align="center"><b><u>';
        if($ket['lap']==3){
            $hue.='LAPORAN PENERIMAAN PEMBELIAN PER NOTA';
        }else if($ket['lap']==3){
            $hue.='LAPORAN PEMBELIAN TUNAI PER NOTA';
        }else{
            $hue.='LAPORAN PENERIMAAN DONASI PER NOTA';
        }

        $hue.='</u></b><br>';
        if($ket['tipe']==1){
            $hue.='Tanggal '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        }else if($ket['tipe']==2){
            $hue.='Bulan '.convert_to_bulan($ket['month_period']).' Tahun '.$ket['year_period'].'';
        }else{
            $hue.='Tahun '.$ket['year_period'].'';
        }
        $hue.='</div><br>';
            $i=0;
            foreach ($result['data'] as $val) {
                $hue.='<table class="master" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr>
                        <th align="left" width="10%">No. BPB</th>
                        <th align="center" width="2%">:</th>
                        <th align="center" width="20%">'.$val['no_bpb'].'</th>
                        <th align="center" width="10%">Tgl. BPB :</th>
                        <th align="left" width="25%">'.tanggal($val['tgl_bpb']).'</th>';
                if($ket['lap']==3){
                $hue.='
                        <th align="left" width="8%">No. PO</th>
                        <th align="center" width="2%">:</th>
                        <th align="center" width="23%">'.$val['no_po'].'</th>';
                }else if($ket['lap']==5){
                    $hue.='
                        <th align="left" width="8%">No. Nota</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.$val['no_nota'].'</th>';//untuk pembelian per nota
                }else{
                    $hue.='
                        <th align="left" width="8%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.$val['status_caption'].'</th>';//untuk pembelian per nota
                }
                if($ket['lap']!=7){
                    $hue.='
                        </tr>
                        <tr>
                            <th align="left" width="10%">Depo</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="20%">nama depo</th>
                            <th align="center" width="10%"></th>
                            <th align="left" width="25%"></th>';
                }else{
                    $hue.='
                        </tr>
                        <tr>
                            <th align="left" width="10%">Nama Donatur</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="20%">'.$val['partner_name'].'</th>
                            <th align="center" width="10%"></th>
                            <th align="left" width="25%"></th>';
                }

                        
                if($ket['lap']==3){
                $hue.='
                        <th align="left" width="8%">No. Faktur</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.$val['no_faktur_sup'].'</th>';
                }else if($ket['lap']==5){
                    $hue.='
                        <th align="left" width="8%">No. Kasbon</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.$val['ct_no'].'</th>';//untuk pembelian per nota
                }else{
                    $hue.='
                        <th align="left" width="8%">User</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.$val['user_fullname'].'</th></tr>';//untuk pembelian per nota
                }
                if($ket['lap']!=7){
                    $hue.='
                        </tr>  
                        <tr>
                            <th align="left" width="10%">Nama Supplier</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="20%">'.$val['partner_name'].'</th>
                            <th align="center" width="10%"></th>
                            <th align="left" width="25%"></th>';
                }
                if($ket['lap']==3){
                $hue.='
                        <th align="left" width="8%">Tgl. Faktur</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.tanggal($val['tgl_faktur_sup']).'</th>';
                }else if($ket['lap']==5){
                    $hue.='
                        <th align="left" width="8%">Nilai Kasbon</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="23%">'.angka($val['ct_amount']).'</th>';//untuk pembelian per nota
                }  
                if($ket['lap']!=7){
                    $hue.=' 
                        </tr>
                        <tr>
                            <th align="left" width="10%">Keterangan</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="20%">'.$val['ket_bpb'].'</th>
                            <th align="center" width="10%"></th>
                            <th align="left" width="25%"></th>
                            <th align="left" width="8%">User</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="23%">'.$val['user_fullname'].'</th>
                        </tr> 
                        <tr>
                            <th align="left" width="10%"></th>
                            <th align="center" width="2%"></th>
                            <th align="left" width="20%"></th>
                            <th align="center" width="10%"></th>
                            <th align="left" width="25%"></th>
                            <th align="left" width="8%">Tgl. Update</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="23%">'.tanggal_time($val['date_upd']).'</th>
                        </tr>';
                }else{
                    $hue.='<tr>
                            <th align="left" width="10%">Keterangan</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="20%">'.$val['ket_bpb'].'</th>
                            <th align="center" width="10%"></th>
                            <th align="left" width="25%"></th>
                            <th align="left" width="8%">Tgl. Update</th>
                            <th align="center" width="2%">:</th>
                            <th align="left" width="23%">'.tanggal_time($val['date_upd']).'</th>
                        </tr> ';
                }
                    $hue.='
                </table>
                ';
                if($ket['lap']!=7){
                    $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th class="border" align="center" width="8%"><b>Kode</b></th>
                        <th class="border" align="center" width="37%"><b>Nama Item</b></th>
                        <th class="border" align="center" width="5%"><b>Satuan</b></th>
                        <th class="border" align="center" width="10%"><b>Jml.</b></th>
                        <th class="border" align="center" width="10%"><b>Harga</b></th>
                        <th class="border" align="center" width="10%"><b>Disk.(%)</b></th>
                        <th class="border" align="center" width="10%"><b>Diskon Harga</b></th>
                        <th class="border" align="center" width="10%"><b>Sub Total</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'][$i]['detail'] as $key) {
                    $hue.='<tr>
                        <td class="border" align="center" width="8%">'.$key['kd_item'] .'</td>
                        <td class="border" align="left" width="37%">'.$key['nama_item'].' </td>
                        <td class="border" align="center"   width="5%">'.$key['nama_satuan']. '</td>
                        <td class="border" align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml_bpb'],0).'</td>
                        <td class="border" align="right"  width="10%">'.angka($key['harga'],0).'</td>
                        <td class="border" align="right"  width="10%">'.angka($key['p_diskon'],0).'</td>
                        <td class="border" align="right"  width="10%">'.angka($key['tot_diskon'],0).'</td>
                        <td class="border" align="right"  width="10%">'.angka($key['total'],0).'</td>
                    </tr>'; 
                    $no++;
                    }
                    $hue.='
                    <tr>
                        <th align="right"  width="80%" style="border:1px solid white;border-top: 1px solid black;border-left: 1px solid black"></th>
                        <th align="right"  width="10%" style="border-bottom: 1px solid white" colspan="6">Sub Total :</th>
                        <th class="border" align="right"  width="10%">'.angka($val['subtotal'],0).'</th>
                    </tr>
                    <tr>
                        <th align="right"  width="80%" style="border:1px solid white;border-left: 1px solid black"></th>
                        <th align="right"  width="10%" style="border-bottom: 1px solid white;border-top: 1px solid white" colspan="6">PPN :</th>
                        <th class="border" align="right"  width="10%">'.angka($val['tot_ppn'],0).'</th>
                    </tr>
                    <tr>
                        <th align="right"  width="80%" style="border:1px solid white;border-left: 1px solid black"></th>
                        <th align="right"  width="10%" style="border-bottom: 1px solid white;border-top: 1px solid white" colspan="6">Biaya Lain :</th>
                        <th class="border" align="right"  width="10%">'.angka($val['biaya_lain'],0).'</th>
                    </tr>
                    <tr>
                        <th align="right"  width="80%" style="border:1px solid white;border-bottom: 1px solid black;border-left: 1px solid black"></th>
                        <th align="right"  width="10%" style="border-bottom: 1px solid black;border-top: 1px solid white" colspan="6">Total :</th>
                        <th class="border" align="right"  width="10%">'.angka($key['total'],0).'</th>
                    </tr>
                    </table>
                    <br></br>
                    <br></br>
                    <br></br>';
                $i++; 
                }
                else{
                    $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th align="center" width="10%"><b>Kode</b></th>
                        <th align="center" width="50%"><b>Nama Item</b></th>
                        <th align="center" width="10%"><b>Satuan</b></th>
                        <th align="center" width="10%"><b>Jumlah</b></th>
                        <th align="center" width="10%"><b>Kedaluwarsa</b></th>
                        <th align="center" width="10%"><b>No. Batch</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'][$i]['detail'] as $key) {
                    $hue.='<tr>
                        <th align="center" width="10%">'.$key['kd_item'] .'</th>
                        <th align="left" width="50%">'.$key['nama_item'].' </th>
                        <th align="center"   width="10%">'.$key['nama_satuan']. '</th>
                        <th align="right"  width="10%" formatter: appGridNumberFormatter>'.angka($key['jml_bpb'],0).'</th>
                        <th align="center"  width="10%">'.tanggal($key['tgl_ed']).'</th>
                        <th align="right"  width="10%">'.$key['no_batch'].'</th>
                    </tr>
                    </table>
                    <br></br>
                    <br></br>
                    <br></br>
                    '; 
                    $no++;
                    }
                }
                
            }

        // $pdf->Header();
       
        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }
    }

    //penerimaan pembelian per item
    function print_transaksi4() {
        // $API_JENIS_TRANSAKSI = BASE_URL_WS_ACCFIN."cash_trans/voucher_print/".$_POST['info'];
        $result = $this->filter2();
        $ket    = $this->ket_laporan();

        // print_r($result);die;   
        if ($ket['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=".$ket['file_cetak'].".xls");

        }
        else
        {
            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(3, 45, 3);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("L", "F4");
            $pdf->SetFont("helvetica", "", 9);
        }
        
        $hue='
        <style>
           .atas table, 
           .atas thead, 
           .atas tr, 
           .atas th {
                border:0.6px solid black;
                font-size: 7px;
            }
            .border{
                border:0.6px solid black;
            }
        </style>
        <div align="center"><b><u>';
        if($ket['lap']==4){
            $hue.='LAPORAN PENERIMAAN PEMBELIAN PER ITEM';
        }else if($ket['lap']==6){
            $hue.='LAPORAN PEMBELIAN TUNAI PER ITEM';
        }else if($ket['lap']==8){
            $hue.='LAPORAN PENERIMAAN BARANG DONASI PER ITEM';
        }else{
            $hue.='LAPORAN PPN MASUKAN';
        }
        $hue.='</u></b><br>';
            if($ket['tipe']==1){
            $hue.='Tanggal  '.convert_date_to_indonesia($ket['start_date']).' s/d '.convert_date_to_indonesia($ket['end_date']).'';
        }else if($ket['tipe']==2){
            $hue.='Bulan '.convert_to_bulan($ket['month_period']).' Tahun '.$ket['year_period'].'';
        }else{
            $hue.='Tahun '.$ket['year_period'].'';
        }
        $hue.='</div><br>';
            $i=0;
            if($ket['lap']==9){
                $hue.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="center" width="7%"><b>No. BPB</b></th>
                        <th align="center" width="5%"><b>Tgl. BPB</b></th>
                        <th align="center" width="7%"><b>No. PO</b></th>
                        <th align="center" width="6%"><b>No. Faktur</b></th>
                        <th align="center" width="5%"><b>Tgl. Faktur</b></th>
                        <th align="center" width="14%"><b>Nama Supplier</b></th>
                        <th align="center" width="7%"><b>Sub Total</b></th>
                        <th align="center" width="7%"><b>Diskon Nota</b></th>
                        <th align="center" width="5%"><b>Total PPN</b></th>
                        <th align="center" width="6%"><b>User</b></th>
                        <th align="center" width="7%"><b>Tgl. Update</b></th>
                    </tr>';
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $hue.='<tr>
                        <td class="border" align="center" width="7%">'.$key['no_bpb'] .'</td>
                        <td class="border" align="center"   width="5%">'.tanggal($key['tgl_bpb']).' </td>
                        <td class="border" align="center" width="7%">'.$key['no_po']. '</td>
                        <td class="border" align="left" width="6%">'.$key['no_faktur_sup']. '</td>
                        <td class="border" align="center" width="5%">'.tanggal($key['tgl_faktur_sup']).'</td>
                        <td class="border" align="left" width="14%">'.$key['partner_name']. '</td>
                        <td class="border" align="right"  width="7%">'.angka($key['subtotal']).'</td>
                        <td class="border" align="right"  width="7%">'.angka($key['diskon_nota']).'</td>
                        <td class="border" align="right"  width="5%" formatter: appGridNumberFormatter>'.angka($key['tot_ppn']).'</td>
                        <td class="border" align="left"  width="6%" formatter: appGridNumberFormatter>'.$key['user_fullname'].'</td>
                        <td class="border" align="center"  width="7%" formatter: appGridNumberFormatter>'.tanggal_time($key['date_upd']).'</td>
                        
                    </tr>'; 
                    $no++;
                    }
                    $hue.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';
            }else{
                $hue.='<table class="atas" cellspacing="0" style="width: 100%;">
                    <tr>
                        <th class="border" align="center" width="7%"><b>No. BPB</b></th>
                        <th class="border" align="center" width="5%"><b>Tgl. BPB</b></th>';
                if($ket['lap']==4){
                    $hue.='
                            <th class="border" align="center" width="7%"><b>No. PO</b></th>
                            <th class="border" align="center" width="6%"><b>No. Faktur</b></th>
                            <th class="border" align="center" width="5%"><b>Tgl. Faktur</b></th>';
                }else if($ket['lap']==6){
                    $hue.='
                            <th class="border" align="center" width="7%"><b>No. Nota</b></th>
                            <th class="border" align="center" width="6%"><b>No. Kasbon</b></th>
                            <th class="border" align="center" width="6%"><b>Nilai Kasbon</b></th>';
                }else if($ket['lap']==8){
                    $hue.='
                            <th class="border" align="center" width="13%"><b>Nama Donatur</b></th>
                            <th class="border" align="center" width="6%"><b>Kode</b></th>
                            <th class="border" align="center" width="30%"><b>Nama Item</b></th>
                            <th class="border" align="center" width="6%"><b>Satuan</b></th>
                            <th class="border" align="center" width="6%"><b>Jumlah</b></th>
                            <th class="border" align="center" width="6%"><b>Kedaluwarsa</b></th>
                            <th class="border" align="center" width="6%"><b>No.Batch</b></th>
                            <th class="border" align="center" width="8%"><b>User</b></th>
                            <th class="border" align="center" width="6%"><b>Tgl. Update</b></th></tr>
                            ';
                }
                if($ket['lap']!=8){
                $hue.='
                        <th class="border" align="center" width="11%"><b>Nama Supplier</b></th>
                        <th class="border" align="center" width="20%"><b>Nama Item</b></th>
                        <th class="border" align="center" width="6%"><b>Satuan</b></th>
                        <th class="border" align="center" width="5%"><b>Jml. BPB</b></th>
                        <th class="border" align="center" width="6%"><b>Harga</b></th>
                        <th class="border" align="center" width="7%"><b>Diskon(%)</b></th>
                        <th class="border" align="center" width="7%"><b>Total Diskon</b></th>
                        <th class="border" align="center" width="7%"><b>Total</b></th>
                    </tr>';
                }
                    $no=1;
                    foreach ($result['data'] as $key) {
                    $hue.='<tr>
                        <td class="border" align="center" width="7%">'.$key['no_bpb'] .'</td>
                        <td class="border" align="center"   width="5%">'.tanggal($key['tgl_bpb']).' </td>';
                    if($ket['lap']==4){
                    $hue.='
                        <td class="border" align="center" width="7%">'.$key['no_po']. '</td>
                        <td class="border" align="left" width="6%">'.$key['no_faktur_sup']. '</td>
                        <td class="border" align="center" width="5%">'.tanggal($key['tgl_bpb']).'</td>';
                    }else if($ket['lap']==6){
                    $hue.='
                        <td class="border" align="left" width="7%">'.$key['no_nota']. '</td>
                        <td class="border" align="left" width="6%">'.$key['ct_no']. '</td>
                        <td class="border" align="center" width="6%">'.angka($key['ct_amount']).'</td>';
                    }
                    else if($ket['lap']==8){
                    $hue.='
                        <td class="border" align="left" width="13%">'.$key['partner_name']. '</td>
                        <td class="border" align="center" width="6%">'.$key['kd_item']. '</td>
                        <td class="border" align="left" width="30%">'.$key['nama_item']. '</td>
                        <td class="border" align="center" width="6%">'.$key['nama_satuan']. '</td>
                        <td class="border" align="left" width="6%">'.$key['jml_bpb']. '</td>
                        <td class="border" align="center" width="6%">'.tanggal($key['tgl_ed']). '</td>
                        <td class="border" align="left" width="6%">'.$key['no_batch']. '</td>
                        <td class="border" align="left" width="8%">'.$key['user_fullname']. '</td>
                        <td class="border" align="center" width="6%">'.tanggal($key['date_upd']).'</td></tr>';
                    }
                    if($ket['lap']!=8){
                    $hue.='
                        <td class="border" align="left"  width="11%">'.$key['partner_name'].'</td>
                        <td class="border" align="left"  width="20%">'.$key['nama_item'].'</td>
                        <td class="border" align="center"  width="6%">'.$key['nama_satuan'].'</td>
                        <td class="border" align="right"  width="5%" formatter: appGridNumberFormatter>'.angka($key['jml_bpb']).'</td>
                        <td class="border" align="right"  width="6%" formatter: appGridNumberFormatter>'.angka($key['harga']).'</td>
                        <td class="border" align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['p_diskon']).'</td>
                        <td class="border" align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['tot_diskon']).'</td>
                        <td class="border" align="right"  width="7%" formatter: appGridNumberFormatter>'.angka($key['subtotal']).'</td>
                    </tr>'; 
                    }
                    $no++;
                    }
                    $hue.='</table>
                    <br></br>
                    <br></br>
                    <br></br>';
}
        // $pdf->Header();
        // echo $hue;
        if ($ket['type_file']==2)
        {
            echo $hue;
        }
        else
        {
            $pdf->writeHTML($hue, true, false, true, false);
            $pdf->Output("assets/file/".$ket['file_cetak'], "F");
            $return["success"] = TRUE;
            echo json_encode($return);
        }
    }

    function ket_laporan(){
        $data = [];                     
        $param            = $this->input->post();
        $data['lap']              = $param['url'];
        $data['tipe']             = $param['rpt_period'];
        $data['start_date']       = $param['start_date'];
        $data['end_date']         = $param['end_date'];
        $data['month_period']     = $param['month_period'];
        $data['year_period']      = $param['year_period'];
        $data['year_period_text'] = $param['year_period_text'];
        $data['file_cetak']       = $param['file_cetak']??"";
        $data['type_file']        = $param['type_file']??"";

        return $data;
    }

}

/* End of file Laporan_pembelian.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Laporan_pembelian.php */