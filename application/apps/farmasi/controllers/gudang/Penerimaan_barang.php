<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
        $this->data['js'] = 'gudang/penerimaan_barang_js';
        $this->data['main_view'] = 'gudang/v_penerimaan_barang';
		$this->load->view('template', $this->data);
	}

	public function filter()
    {
        $headers     = getHeaderToken();
        $curl_handle = curl_init();
        $param       = $this->input->post();
   
        $param['status']     = $param['status'] ?? 0;
        $param['start_date'] = $param['start_date'] ?? 1;
        $param['end_date']   = $param['end_date'] ?? 1;
        $param['criteria']   = $param['criteria'] ?? '';
        $param['page_row']   = $param['page_row'] ?? 10;
        $param['criteria']   = $param['criteria'] ?? '';
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/bpb/search');
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
        echo json_encode($result);
    }

    public function get_data_gudang()
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

        $result        = json_decode($buffer,true);
        $daftar_unit   = [];
        $daftar_unit[] =[
            'id'   => '',
            'text' => 'Pilih unit Asal',
        ];
        foreach ($result['list'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'text' => $unit['nama_unit'],
                // 'wira' => "aa",
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function Filter_supplier()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
		$data['status']   = $param['status'] ?? 1;
		$data['page_row'] = $param['page_row'] ?? 10;
		$data['page']     = $param['page'] ?? 1;
		$data['criteria'] = $param['criteria'] ?? '';
        
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/supplier/list');
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

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function Filter_nopo()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
		$data['page']       = $param['page'] ?? 1;
		$data['page_row']   = $param['page_row'] ?? 10;
		$data['criteria']   = $param['criteria'] ?? '';
		$data['id_partner'] = $param['id_partner'] ?? '';
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/bpb/list_po');
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

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function getPerKode()
    {
    	// print_r($_POST['data']);
        $API = BASE_URL_API_LPS.'gudang/farmasi/bpb/get/'.$_POST['data'];
        
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

        // print_r($result);die();
        $data = [];
        if (count($result['master'])> 0)
        {
            $data['master']=$result['master'][0];
            $data['detail']=$result['detail'];
        }
        echo json_encode($data);
    }

    public function Filter_barang_po()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
		$data['id_partner'] = $param['data']['id_partner'] ;
		$data['no_po']      = $param['data']['no_po'] ;
		$data['criteria']   = $param['data']['criteria'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/bpb/list_barang_po');
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

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['edit']==0)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/bpb/insert';   
        }
        else
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/bpb/update';
        }


        $data['master']  = $_POST['data']['master'];
        $data['details'] = $_POST['data']['details'];
        // echo json_encode($_POST['data']);
        // var_dump("aaa");die();
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

        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/bpb/delete');
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

        if($_POST['status']==1)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/bpb/status/open';
        }
        else if($_POST['status']==2)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/bpb/status/release';   
        }
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
            header("Content-Disposition: attachment; filename=Laporan_Penerimaan_Barang.xls");

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
        <div align="center"><b><u>LAPORAN PENERIMAAN BARANG'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="5%">No. BPB</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['no_bpb'].'</th>

                        <th align="left" width="5%">Tgl. BPB</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.tanggal($master['tgl_bpb']).'</th>

                        <th align="left" width="7%">No. PO</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['no_po'].'</th>

                        <th align="left" width="7%">PPN</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="7%">'.$master['ket_jns_ppn'].'</th>

                        <th align="left" width="5%">Keterangan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['ket_bpb'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Gudang</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['nama_gudang'].'</th>
                        
                        <th align="left" width="5%">Status</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.$master['status_caption'].'</th>

                        <th align="left" width="7%">No. Faktur</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['no_faktur_sup'].'</th>

                        <th align="left" width="7%">Tgl. Faktur</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_faktur_sup']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Supplier</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['partner_name'].'</th>

                        <th align="left" width="5%">User</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.$master['created_by'].'</th>

                        <th align="left" width="7%">Payment</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['nama_termin_bayar'].'</th>

                        <th align="left" width="7%">Jatuh Tempo</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_jatuh_tempo']).'</th>
                    </tr>
                    <tr>                        
                        <th align="left" width="5%">Alamat</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['ket_supplier'].'</th>

                        <th align="left" width="5%">Tgl. Update</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.tanggal_time($master['date_upd']).'</th>

                        <th align="left" width="7%">No. Surat Jalan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['no_surat_jalan'].'</th>

                        <th align="left" width="7%">Tgl. Surat Jalan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_surat_jalan']).'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
            <tr>
            <th align="center" width="3%"><b>No</b></th>
                <th align="center" width="4%"><b>Kode</b></th>
                <th align="center" width="11%"><b>Nama Item</b></th>
                <th align="center" width="5%"><b>Jumlah</b></th>
                <th align="center" width="6%"><b>Jml. Sisa PO</b></th>
                <th align="center" width="6%"><b>Satuan PO</b></th>
                <th align="center" width="6%"><b>Rasio</b></th>
                <th align="center" width="7%"><b>Harga</b></th>
                <th align="center" width="5%"><b>Disc. (%)</b></th>
                <th align="center" width="8%"><b>Disc. (Harga)</b></th>
                <th align="center" width="7%"><b>Sub Total</b></th>
                <th align="center" width="6%"><b>Jml. Terima</b></th>
                <th align="center" width="8%"><b>Jml. Satuan Kecil</b></th>
                <th align="center" width="6%"><b>Satuan Kecil</b></th>
                <th align="center" width="6%"><b>Tgl. ED</b></th>
                <th align="center" width="6%"><b>No. Batch</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no.'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="right">'.angka($key['jml_po'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_sisa_po'],0).'</td>
                    <td class="border" align="center">'.$key['id_satuan_po'].'</td>
                    <td class="border" align="center">'.$key['rasio'].'</td>
                    <td class="border" align="right">'.angka($key['harga'],0).'</td>
                    <td class="border" align="right">'.angka($key['p_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['tot_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['total'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_bpb'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_satuan_kecil'],0).'</td>
                    <td class="border" align="center">'.$key['nama_satuan_kecil'].'</td>
                    <td class="border" align="center">'.tanggal($key['tgl_ed']).'</td>
                    <td class="border" align="left">'.$key['no_batch'].'</td>
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
        
            $pdf->Output("assets/laporan/"."Laporan_Penerimaan_Barang.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

}

/* End of file Penerimaan_barang.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Penerimaan_barang.php */