<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembelian_tunai extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/pembelian_tunai_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_pembelian_tunai';

        // Load View
        $this->load->view('template', $this->data);
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
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/search');
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

    public function filter_uang_muka()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/list_uang_muka');
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

    public function filter_barang()
	{
        $param = $this->input->post();
        // echo json_encode($param);die;

        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/list_barang');
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

    public function get_gudang(){
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

    public function getPembelian()
    {
        $API = BASE_URL_API_LPS."gudang/farmasi/beli_tunai/get/".$_POST['data'];
        
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
        	$url = BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/update';
        }else{
        	$url = BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/insert';
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
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/delete');
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

        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/beli_tunai/status/'.$_POST['status']);
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

    public function cetak()
    {
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
            header("Content-Disposition: attachment; filename=Laporan_Pembelian_Tunai.xls");

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
        <div align="center"><b><u>LAPORAN PEMBELIAN TUNAI'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="4%">No. BPB</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['no_bpb'].'</th>

                        <th align="left" width="5%">Tgl. BPB</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_bpb']).'</th>

                        <th align="left" width="5%">No. Nota</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.$master['no_faktur_sup'].'</th>

                        <th align="left" width="6%">PPN</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="9%">'.$master['jns_ppn'].'</th>

                        <th align="left" width="5%">Tgl. Update</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="18%">'.tanggal_time($master['date_upd']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="4%">Gudang</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['nama_gudang'].'</th>
                        
                        <th align="left" width="5%">Status</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['status_caption'].'</th>

                        <th align="left" width="5%">Tgl. Nota</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.tanggal($master['tgl_faktur_sup']).'</th>

                        <th align="left" width="6%">Total Kasbon</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="9%">'.convert_number_to_rupiah($master['ct_amount'],0).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="4%">Supplier</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['partner_name'].'</th>

                        <th align="left" width="5%">User</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['updated_by'].'</th>

                        <th align="left" width="5%">No. Kasbon</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.$master['ct_no'].'</th>

                        <th align="left" width="6%">Pemakaian</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="9%">'.convert_number_to_rupiah($master['total'],0).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="4%">Alamat</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['partner_address'].'</th>
                        
                        <th align="left" width="5%">Keterangan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['ket_bpb'].'</th>

                        <th align="left" width="5%">Tgl. Kasbon</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.tanggal($master['ct_date']).'</th>

                        <th align="left" width="6%">Sisa Kasbon</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="9%">'.convert_number_to_rupiah($master['cash_adv_blc'],0).'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
            <tr>
                <th align="center" width="4%"><b>No</b></th>
                <th align="center" width="6%"><b>Kode</b></th>
                <th align="center" width="12 %"><b>Nama Item</b></th>
                <th align="center" width="6%"><b>Satuan</b></th>
                <th align="center" width="9%"><b>Rasio</b></th>
                <th align="center" width="6%"><b>Jumlah</b></th>
                <th align="center" width="7%"><b>Harga satuan</b></th>
                <th align="center" width="6%"><b>Disc. (%)</b></th>
                <th align="center" width="7%"><b>Disc. (Harga)</b></th>
                <th align="center" width="7%"><b>Sub Total</b></th>
                <th align="center" width="8%"><b>Jml. Satuan Kecil</b></th>
                <th align="center" width="7%"><b>Satuan Kecil</b></th>
                <th align="center" width="7%"><b>Kedaluwarsa</b></th>
                <th align="center" width="8%"><b>No. Batch</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no.'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="center">'.$key['nama_satuan'].'</td>
                    <td class="border" align="center">'.$key['rasio'].'</td>
                    <td class="border" align="right">'.angka($key['jml_bpb'],0).'</td>
                    <td class="border" align="right">'.angka($key['harga'],0).'</td>
                    <td class="border" align="right">'.angka($key['p_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['tot_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['total'],0).'</td>
                    <td class="border" align="center">'.angka($key['jml_satuan_kecil']).'</td>
                    <td class="border" align="right">'.$key['nama_satuan_kecil'].'</td>
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
        
            $pdf->Output("assets/laporan/"."Laporan_Pembelian_Tunai.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

}

/* End of file Pembelian_tunai.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Pembelian_tunai.php */