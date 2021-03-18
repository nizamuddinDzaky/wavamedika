<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang_donasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
        $this->data['js'] = 'gudang/penerimaan_barang_donasi_js';
        $this->data['main_view'] = 'gudang/v_penerimaan_barang_donasi';
		$this->load->view('template', $this->data);
	}

	public function filter_supplier()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $url = BASE_URL_API_LPS.'master/supplier/list';
        // echo json_encode($_POST);die;
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

    public function filter_po()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $url = BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/list_barang';
        // echo json_encode($_POST);die;
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

    function get_gudang()
    {
       	$headers  = getHeaderToken();
       	$curl_handle = curl_init();

       	$data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/gudang_farmasi/list');
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

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // echo json_encode($_POST);die;
        if($_POST['edit']==0)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/insert';
        }
        else
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/update';   
        }
        // echo $API;die;
        
        
        // var_dump($data); die();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST));

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

    public function filter()
    {
        $param = $this->input->post();

        $data['status'] = $param['status'] ?? 0;
        $data['start_date'] = $param['start_date'] ?? '';
        $data['end_date'] = $param['end_date'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        // echo BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/search'; die();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/search');
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
        // var_dump($buffer);die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function getPerKode($value='')
    {
        $API = BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/get/'.$_POST['data'];
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
        // echo $API;die();
        $data = [];
        if (count($result['master'])> 0)
        {
            $data['master']=$result['master'][0];
            $data['detail']=$result['detail'];
        }
        echo json_encode($data);
    }

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/delete');
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

    public function status()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $API=BASE_URL_API_LPS.'gudang/farmasi/bpb_donasi/status/'.$_POST['status'];
        // echo $API;die;
        // echo json_encode($API);die;
        // echo json_encode();
     
        curl_setopt($curl_handle, CURLOPT_URL, $API);
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

        // var_dump($_POST['data']);
        // var_dump($buffer);die();

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        // $result = $this->filter();

        $param            = $this->input->post();

        $master           = $param['master'];
        $detail           = $param['detail'];

        // var_dump($master);
        // var_dump($detail);die();

        $param['type_file']=1;//pdf

        if ($param['type_file']==2)
        {
            # code...
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Penerimaan_Barang_Donasi.xls");

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
        <div align="center"><b><u>LAPORAN PENERIMAAN BARANG DONASI'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="4%">No. BPB</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['no_bpb'].'</th>
                        <th align="left" width="6%">Tgl. Dokumen</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_faktur_sup']).'</th>
                        <th align="left" width="5%">Tgl. BPB</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="49%">'.tanggal($master['tgl_bpb']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="4%">Gudang</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['nama_gudang'].'</th>
                        <th align="left" width="6%">No. Dokumen</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['no_faktur_sup'].'</th>
                        <th align="left" width="5%">Status</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="15%">'.$master['status_caption'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="4%">Donatur</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['partner_name'].'</th>
                        <th align="left" width="6%">Keterangan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['ket_bpb'].'</th>
                        <th align="left" width="5%">User</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="15%">'.$master['updated_by'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="4%">Alamat</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['partner_address'].'</th>
                        <th align="left" width="6%">Tgl. Update</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal_time($master['date_upd']).'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
            <tr>
                <th align="center" width="4%"><b>No</b></th>
                <th align="center" width="8%"><b>Kode</b></th>
                <th align="center" width="17%"><b>Nama Item</b></th>
                <th align="center" width="8%"><b>Satuan</b></th>
                <th align="center" width="8%"><b>Rasio</b></th>
                <th align="center" width="7%"><b>Jumlah</b></th>
                <th align="center" width="10%"><b>Jml. Satuan Kecil</b></th>
                <th align="center" width="8%"><b>Satuan Kecil</b></th>
                <th align="center" width="7%"><b>HPP</b></th>
                <th align="center" width="7%"><b>Sub Total</b></th>
                <th align="center" width="8%"><b>Kedaluwarsa</b></th>
                <th align="center" width="8%"><b>No. Batch</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no .'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="center">'.$key['nama_satuan'].'</td>
                    <td class="border" align="center">'.$key['rasio'].'</td>
                    <td class="border" align="right">'.angka($key['jml_bpb'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_satuan_kecil'],0).'</td>
                    <td class="border" align="center">'.$key['nama_satuan_kecil'].'</td>
                    <td class="border" align="right">'.angka($key['harga'],0).'</td>
                    <td class="border" align="right">'.angka($key['total'],0).'</td>
                    <td class="border" align="center">'.tanggal($key['tgl_ed']).'</td>
                    <td class="border" align="center">'.$key['no_batch'].'</td>
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
        
            $pdf->Output("assets/laporan/"."Laporan_Penerimaan_Barang_Donasi.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }
}


/* End of file Penerimaan_barang_donasi.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Penerimaan_barang_donasi.php */