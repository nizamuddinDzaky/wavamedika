<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_mutasi_rop extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
        // data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/permintaan_mutasi_rop_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_permintaan_mutasi_rop';
        
       	// Load view
		$this->load->view('template', $this->data);
    }
    public function get_unit_asal()
    {

        $headers     = getHeaderToken();
        $data        = ['user_id' => $this->session->userdata('user_id')];
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/unit_akses/list_farmasi');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));

        // Optional, delete this line if your API is open
        $buffer = curl_exec($curl_handle);
        $result=json_decode($buffer,true);
        $daftar_unit = [];
        $daftar_unit[]=[
            'id' => '',
            'text' => 'Pilih unit Asal',
        ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function get_unit_tujuan()
    {
        $API = BASE_URL_API_LPS."master/depo_farmasi/list";
        
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
            'id' => '',
            'text' => 'Pilih unit Tujuan',
        ];

        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function filter()
    {
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['status'] = $param['status'] ?? 0;
        $data['start_date'] = $param['start_date'] ?? '';
        $data['end_date'] = $param['end_date'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'gudang/farmasi/minta_mutasi/rop/search');
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

    public function getPermintaan()
    {
        $API = BASE_URL_API_LPS."gudang/farmasi/minta_mutasi/rop/get/".$_POST['data'];
        
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

    public function search_item()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/rop/list_barang');
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

    public function simpan()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();

        if (isset($_POST['master']['no_pm'])) {
        	$url = BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/rop/update';
        }else{
        	$url = BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/rop/insert';
        }

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
        $headers     = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/rop/delete');
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

    public function verifikasi()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_mutasi/rop/status/'.$_POST['status']);
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

        // var_dump($buffer); die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function cetak(){
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        // $result = $this->filter();

        $param            = $this->input->post();

        $master           = $param['master'];
        $detail           = $param['details'];

        // var_dump($master);
        // var_dump($detail);die();

        $param['type_file']=1;//pdf

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Permintaan_Mutasi_ROP.xls");

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
        <div align="center"><b><u>LAPORAN PERMINTAAN MUTASI ROP'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="5%">No. PM</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="14%">'.$master['no_pm'].'</th>
                        <th align="left" width="5%">Tgl. PM</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="72%">'.tanggal($master['tgl_pm']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Unit Asal</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="14%">'.$master['unit_asal'].'</th>
                        <th align="left" width="5%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['status_caption'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Unit Tujuan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="14%">'.$master['unit_tujuan'].'</th>
                        <th align="left" width="5%">User</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['updated_by'].'</th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="14%">'.$master['ket_pm'].'</th>
                        <th align="left" width="5%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.tanggal_time($master['date_upd']).'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%;border:0.6px solid black;">
            <tr style="border:1px black solid;">
                <th align="center" width="4%"><b>No</b></th>
                <th align="center" width="9%"><b>Kode</b></th>
                <th align="center" width="23%"><b>Nama Item</b></th>
                <th align="center" width="8%"><b>Satuan</b></th>
                <th align="center" width="8%"><b>Jenis</b></th>
                <th align="center" width="8%"><b>Pemakaian</b></th>
                <th align="center" width="7%"><b>Stok</b></th>
                <th align="center" width="9%"><b>Safety Stok (SS)</b></th>
                <th align="center" width="8%"><b>Rekam Order</b></th>
                <th align="center" width="8%"><b>Permintaan</b></th>
                <th align="center" width="8%"><b>Tgl. Kebutuhan</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no .'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="center">'.$key['nama_satuan']. '</td>
                    <td class="border" align="center" >'.$key['nama_kel_item'].'</td>
                    <td class="border" align="right">'.angka($key['jml_mutasi'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_stok'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_ss'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_rekam_order'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_minta'],0).'</td>
                    <td class="border" align="center">'.tanggal($key['tgl_kebutuhan']).'</td>
                </tr>';
                
                $no++;
            }
            $html.='</table><br></br>';
        }
        $html.='<br></br>';
            
        // $pdf->Header();
        // echo $html;

        if ($param['type_file']==2)
        {
            echo $html;
        }
        else
        {
            $pdf->writeHTML($html, true, false, true, false);
        
            $pdf->Output("assets/laporan/"."Laporan_Permintaan_Mutasi_ROP.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }
}
