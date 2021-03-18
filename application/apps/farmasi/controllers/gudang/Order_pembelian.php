<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_pembelian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

    public function index()
    {
        $this->data['js'] = 'gudang/order_pembelian_js';
        $this->data['main_view'] = 'gudang/v_order_pembelian';
        $this->load->view('template', $this->data);
    }

    public function filter_no_pp()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $url = BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/list_barang';
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

    public function filter_barang()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $url = BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/list_detail_barang';
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

    public function termin_bayar()
    {
        $URL = BASE_URL_API_LPS."pembelian/farmasi/order_pembelian/list_termin_bayar";
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
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
        $termin_bayar = [];
        $termin_bayar[]=[
            'id' => '',
            'text' => '',
        ];

        foreach ($result['data'] as $payment) {
            $termin_bayar[] = (object) [
                'id' => $payment['id_termin_bayar'],
                'text' => $payment['nama_termin_bayar'],
                'rexita' => $payment['tempo'],
            ];
        }
        echo json_encode($termin_bayar);
    }

    public function termin_kirim()
    {
        $URL = BASE_URL_API_LPS."pembelian/farmasi/order_pembelian/list_termin_kirim";
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $URL);
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
        $termin_kirim = [];
        $termin_kirim[]=[
            'id' => '',
            'text' => '',
        ];

        foreach ($result['data'] as $delivery) {
            $termin_kirim[] = (object) [
                'id' => $delivery['id_termin_kirim'],
                'text' => $delivery['nama_termin_kirim'],
                'rexita' => $delivery['tempo'],
            ];
        }
        echo json_encode($termin_kirim);
    }

    // public function termin_bayar()
    // {
    //  $url = BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/list_termin_bayar';

        
 //        echo json_encode($result['data']);
    // }

    // public function termin_kirim()
    // {
    //  $url = BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/list_termin_kirim';

        
 //        echo json_encode($result['data']);
    // }

    public function default_auth($value='')
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/list_default_sign');
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


        $result=json_decode($buffer,true);
        /*foreach ($result['data'] as $key => $value) {
            
        }*/
        echo json_encode($result);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // echo json_encode($_POST);die();
        if($_POST['edit']==0)
        {
            $API=BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/insert';
        }
        else
        {
            $API=BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/update';   
        }
        
        // var_dump($data); die();
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST));
        // var_dump(json_encode($_POST'));
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

        // echo json_encode($data); die();

        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/search');
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
        $API = BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/get/'.$_POST['data'];
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
            $data['detail']=$result['detail']['details'];
            $data['autor']=$result['auth'];
        }
        echo json_encode($data);
    }

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/delete');
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

        $API=BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/status/'.$_POST['status'];
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

    public function close_po()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // echo json_encode($_POST['data']);die();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/order_pembelian/close');
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
            header("Content-Disposition: attachment; filename=Laporan_Order_Pembelian_Farmasi.xls");

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
        <div align="center"><b><u>LAPORAN ORDER PEMBELIAN FARMASI'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="5%">No. PO</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['no_po'].'</th>

                        <th align="left" width="5%">Tgl. PO</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.tanggal($master['tgl_po']).'</th>

                        <th align="left" width="4%">No. PP</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['no_pp'].'</th>

                        <th align="left" width="6%">Delivery</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="28%">'.$master['nama_termin_kirim'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Supplier</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['partner_name'].'</th>
                        
                        <th align="left" width="5%">Status</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.$master['status_caption'].'</th>

                        <th align="left" width="4%">Jenis</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['jns_po'].'</th>

                        <th align="left" width="6%">Tgl. Kirim</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_kirim']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Alamat</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['ket_supplier'].'</th>

                        <th align="left" width="5%">User</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.$master['created_by'].'</th>

                        <th align="left" width="4%">PPN</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['jns_ppn'].'</th>

                        <th align="left" width="6%">Jatuh Tempo</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_jatuh_tempo']).'</th>
                    </tr>
                    <tr>                        
                        <th align="left" width="5%">Keterangan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="27%">'.$master['ket_po'].'</th>

                        <th align="left" width="5%">Tgl. Update</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="10%">'.tanggal_time($master['date_upd']).'</th>

                        <th align="left" width="4%">Payment</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="11%">'.$master['nama_termin_bayar'].'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
            <tr>
            <th align="center" width="4%"><b>No</b></th>
                <th align="center" width="8%"><b>Kode</b></th>
                <th align="center" width="24%"><b>Nama Item</b></th>
                <th align="center" width="8%"><b>Jumlah PP</b></th>
                <th align="center" width="8%"><b>Satuan PP</b></th>
                <th align="center" width="8%"><b>Satuan</b></th>
                <th align="center" width="8%"><b>Jumlah</b></th>
                <th align="center" width="8%"><b>Harga</b></th>
                <th align="center" width="8%"><b>Disc. (%)</b></th>
                <th align="center" width="8%"><b>Disc. (Harga)</b></th>
                <th align="center" width="8%"><b>Sub Total</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no.'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="right">'.angka($key['jml_minta'],0).'</td>
                    <td class="border" align="center">'.$key['nama_satuan_minta'].'</td>
                    <td class="border" align="center">'.$key['id_satuan_po'].'</td>
                    <td class="border" align="right">'.angka($key['jml_po'],0).'</td>
                    <td class="border" align="right">'.angka($key['harga'],0).'</td>
                    <td class="border" align="right">'.angka($key['p_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['tot_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['total'],0).'</td>
                    
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
        
            $pdf->Output("assets/laporan/"."Laporan_Order_Pembelian_Farmasi.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }
}

/* End of file Order_pembelian.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Order_pembelian.php */