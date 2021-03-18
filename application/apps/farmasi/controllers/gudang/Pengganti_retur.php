<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengganti_retur extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

    public function index()
	{
        $this->data['js'] = 'gudang/pengganti_retur_js';
        $this->data['main_view'] = 'gudang/v_pengganti_retur';
        $this->load->view('template', $this->data);
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

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/search');
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

    public function filter_supplier()
    {
        $param = $this->input->post();
        
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/supplier/list');
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

    public function filter_retur_pembelian()
    {
        $param = $this->input->post();
        
        $data['id_partner'] = $param['id_partner'] ?? '';
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/list_retur');
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

    public function filter_barang_retur()
    {
        $param = $this->input->post();
        
        $data['no_rt_pb'] = $param['no_rt_pb'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/list_barang_retur');
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

    public function getRetur()
    {
        $API = BASE_URL_API_LPS."gudang/farmasi/ganti_retur/get/".$_POST['data'];
        
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

        if (isset($_POST['master']['no_bpb'])) {
            $url = BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/update';
        }else{
            $url = BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/insert';
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
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/delete');
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
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/ganti_retur/status/'.$_POST['status']);
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

    public function get_gudang()
    {
        $API = BASE_URL_API_LPS."master/gudang_farmasi/list";
        
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
            'text' => 'Pilih Gudang',
        ];

        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id' => $unit['id_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function cetak()
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $result = $this->input->post();

        // echo json_encode($result); die();

        $master = $result['master'];
        $detail = $result['details'];
    
        $this->load->library('Pdf');
        $pdf = tcpdf();
        //initialize document
        $pdf->setMargins(10, 30, 10);
        // $pdf->AddPage("P", "A6");
        $pdf->AddPage("P", "F4");
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
        <div align="center"><b><u>LAPORAN PENGGANTI RETUR NO. BPB '.$master['no_bpb'].' '; 
        $html.='</u></b><br>';
        
        $html.='</div><br>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%;border:1px black solid;">
            <tr>
                <th align="left" width="8%">No. BPB</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%">'.$master['no_bpb'].'</th>
                <th align="center" width="10%">Tanggal :</th>
                <th align="left" width="10%">'.tanggal($master['tgl_bpb']).'</th>
                <th align="left" width="8%">No. Retur</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="15%">'.$master['no_rt_pb'].'</th>
                <th align="left" width="8%">Tgl. Retur</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="15%">'.tanggal($master['tgl_rt_pb']).'</th>
            </tr>
            <tr>
                <th align="left" width="8%">Gudang</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%">'.$master['nama_gudang'].'</th>
                <th align="center" width="10%"></th>
                <th align="left" width="10%"></th>
                <th align="left" width="8%">Status</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="15%">'.$master['status_caption'].'</th>
                <th align="left" width="8%"></th>
                <th align="center" width="2%"></th>
                <th align="left" width="15%"></th>
            </tr>
            <tr>
                <th align="left" width="8%">Supplier</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%">'.$master['partner_name'].'</th>
                <th align="center" width="10%"></th>
                <th align="left" width="10%"></th>
                <th align="left" width="8%">User</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="15%">'.$master['updated_by'].'</th>
                <th align="left" width="8%">Tgl. Updtae</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="15%">'.tanggal_time($master['date_upd']).'</th>
            </tr>
            <tr>
                <th align="left" width="8%">Alamat</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%" colspan="3">'.$master['partner_address'].'</th>

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
                <th align="left" width="8%">Catatan</th>
                <th align="center" width="2%">:</th>
                <th align="left" width="20%" colspan="3">'.$master['ket_bpb'].'</th>

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
        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
            <tr style="border:1px black solid;">
                <th align="center" width="8%"><b>Kode</b></th>
                <th align="center" width="44%" colspan="5"><b>Nama Item</b></th>
                <th align="center" width="10%"><b>Jml. Retur</b></th>
                <th align="center" width="7%"><b>Satuan</b></th>
                <th align="center" width="10%"><b>Jml. Ganti</b></th>
                <th align="center" width="11%"><b>Tgl. Kedaluwarsa</b></th>
                <th align="center" width="10%"><b>No. Batch</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr style="border:1px black solid;">
                    <th align="left" width="8%">'.$key['kd_item'] .'</th>
                    <th align="left" width="44%" colspan="5">'.$key['nama_item'].' </th>
                    <th align="right" width="10%">'.angka($key['jml_rt'],0).'</th>
                    <th align="left" width="7%">'.$key['nama_satuan_rt']. '</th>
                    <th align="right" width="10%">'.angka($key['jml_ganti'],0).'</th>
                    <th align="center" width="11%">'.tanggal($key['tgl_ed']).'</th>
                    <th align="left" width="10%">'.$key['no_batch'] .'</th>
                </tr>'; 
                $no++;
            }
            $html.='</table><br></br>';
        }
        $html.='
        <br></br>';
            
        // $pdf->Header();
        // echo $html;

        $pdf->writeHTML($html, true, false, true, false);
    
        $pdf->Output("assets/laporan/"."Pengganti Retur No. BPB ".$master['no_bpb'].".pdf", "F");
        $return["success"] = TRUE;

        echo json_encode($return);
    }

}

/* End of file Pengganti_retur.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Pengganti_retur.php */