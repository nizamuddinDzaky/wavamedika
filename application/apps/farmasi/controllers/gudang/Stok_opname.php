<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_opname extends CI_Controller {
	var $headers;
	function __construct() {
        parent::__construct();
        $this->load->helper('function_helper');  
        $this->headers = getHeaderToken();
    }

	public function index()
	{
        $this->data['js'] = 'gudang/stok_opname_js';
        $this->data['main_view'] = 'gudang/v_stok_opname';
        $this->load->view('template', $this->data);
	}

	public function filter()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

		$data['status']     = $param['status'];
		$data['bulan']   = $param['bulan'] ;
		$data['tahun']   = $param['tahun'] ;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS.'gudang/farmasi/so');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

	public function generate_so()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

		$data['bulan']   = $param['bulan'] ;
		$data['tahun']   = $param['tahun'] ;
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS.'gudang/farmasi/so');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

    function getPerKode()
    {
        $curl_handle = curl_init();
        $param = $this->input->post();
        $param['no_so']    = $param['no_so'];
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS."gudang/farmasi/so/".$param['no_so']."/byid");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        $data = [];
        if (count($result['master'])> 0)
        {
            $data['master']=$result['master'][0];
            $data['detail']=$result['detail'];
        }
        echo json_encode($data);
    }

    function get_data_pj()
    {
        $curl_handle = curl_init();

        $data['user_id']= $this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/karyawanunit/farmasi');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        $result        = json_decode($buffer,true);
        $daftar_pj   = [];
        $daftar_pj[] =[
            'id'   => '',
            'text' => 'Pilih PJ Depo',
        ];
        foreach ($result['data'] as $pj) {
            $daftar_pj[] = (object) [
                'id'   => $pj['id_karyawan'],
                'text' => $pj['nama'],
            ];
        }
        echo json_encode($daftar_pj);
    }

    public function simpan()
    {
        $curl_handle = curl_init();        
        $data  = $_POST;
        // $data['auths']=$_POST['data']['auths'];

        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS.'gudang/farmasi/so');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    function status()
    {

        $curl_handle = curl_init();
        $data  = $_POST;

        // echo json_encode($API);
        // echo json_encode($_POST['data']);
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/so/status');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    function hapus(){

    	$curl_handle = curl_init();
        $param = $this->input->post();
        $param['no_so']    = $param['no_so'];
        curl_setopt($curl_handle, CURLOPT_URL,BASE_URL_API_LPS."gudang/farmasi/so/".$param['no_so']);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $this->headers);
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
        // print_r($result['roles']);
        // print_r($result);
        echo json_encode($result);
    }

    function print_transaksi1()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $ket=$this->ket_laporan();
        $master = $ket['master'];
        $detail = $ket['detail'];

            $this->load->library('Pdf');
            $pdf = tcpdf();
            //initialize document
            $pdf->setMargins(10, 30, 10);
            // $pdf->AddPage("P", "A6");
            $pdf->AddPage("L", "F4");
            $pdf->SetFont("helvetica", "", 9);
        
        
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
        <br><br><br>
        <div align="center"><b><u>STOK OPNAME'; 
        $html.='</u></b><br>';
            $html.='Periode '.$master['periode'].'';
        
        $html.='</div><br>';
            $i=0;
                $html.='<table class="master" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr>
                        <th align="left" width="8%">No. PM</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['no_so'].'</th>
                        <th align="center" width="40%"></th>
                        <th align="left" width="8%">Catatan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['catatan'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Depo</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['nama_unit'].'</th>
                        <th align="center" width="40%"></th>
                        <th align="left" width="8%">PJ Depo</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['nama_pj_depo'].'</th>
                    </tr>
                    
                </table>
                ';
                $html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
                    <tr style="border:1px black solid;">
                        <th align="center" width="8%"><b>Lokasi</b></th>
                        <th align="center" width="8%"><b>Kode</b></th>
                        <th align="center" width="21%" colspan="2"><b>Nama Item</b></th>
                        <th align="center" width="5%"><b>Satuan</b></th>
                        <th align="center" width="6%"><b>Jml. Sistem</b></th>
                        <th align="center" width="6%"><b>Jml. Fisik</b></th>
                        <th align="center" width="6%"><b>Jml. Selisih</b></th>
                        <th align="center" width="10%"><b>Alasan</b></th>
                        <th align="center" width="10%"><b>Catatan</b></th>
                        <th align="center" width="10%"><b>Dibuat Oleh</b></th>
                        <th align="center" width="10%"><b>Tgl. Dibuat</b></th>
                    </tr>';
                    $no=1;
                    
                    foreach ($detail as $key)
                    {
                        $html.='<tr style="border:1px black solid;">
                            <th align="left"    width="8%">'.$key['nama_lokasi'] .'</th>
                            <th align="left"    width="8%" colspan="6">'.$key['kd_item'].' </th>
                            <th align="left"  width="21%">'.$key['nama_item']. '</th>
                            <th align="left"   width="5%">'.$key['id_satuan'].'</th>
                            <th align="right"   width="6%">'.$key['jml_sistem'].'</th>
                            <th align="right"  width="6%">'.$key['jml_fisik'].'</th>
                            <th align="right"  width="6%">'.$key['jml_selisih'].'</th>
                            <th align="left"  width="10%">'.$key['nama_ket_selisih'].'</th>
                            <th align="left"  width="10%">'.$key['catatan'].'</th>
                            <th align="left"  width="10%">'.$key['user_fullname'].'</th>
                            <th align="center"  width="10%">'.tanggal_time($key['date_ins']).'</th>
                        </tr>'; 
                        $no++;
                    }
                    $html.='</table><br></br>';
                
                $html.='
                <br></br>';
                $i++; 
            

        // $pdf->Header();
        // echo $html;

            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/file/"."Stok Opname ".$master['no_so'].".pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        
    }

    function ket_laporan(){
        $data = [];                     
        $param            = $this->input->post();
        $data['master']              = $param['master'];
        $data['detail']             = $param['detail'];

        return $data;
    }

}

/* End of file Stok_opname.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Stok_opname.php */