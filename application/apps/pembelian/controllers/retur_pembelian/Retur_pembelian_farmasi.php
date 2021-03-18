<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_pembelian_farmasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
        $this->data['js'] = 'retur_pembelian/retur_pembelian_farmasi_js';
        $this->data['main_view'] = 'retur_pembelian/v_retur_pembelian_farmasi';
        $this->data['id'] = $this->input->get('id');
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

    public function filter_barang()
    {
        $param = $this->input->post();
        // echo BASE_URL_API_LPS. 'pembelian/farmasi/retur_beli/list_barang';die;
        // echo json_encode($param);die;
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';


        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS. 'pembelian/farmasi/retur_beli/list_barang');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($param));
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

        // echo json_encode($_POST);die();
        if($_POST['edit']==0)
        {
            $API=BASE_URL_API_LPS.'pembelian/farmasi/retur_beli/insert';
        }
        else
        {
            $API=BASE_URL_API_LPS.'pembelian/farmasi/retur_beli/update';   
        }
        // echo $API;die;
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
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/retur_beli/search');
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

    public function getPerKode()
    {
        $API = BASE_URL_API_LPS.'pembelian/farmasi/retur_beli/get/'.$_POST['data'];
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
            $data['detail']=$result['detail'];
            /*$data['autor']=$result['auth'];*/
        }
        echo json_encode($data);
    }

    public function status()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $API=BASE_URL_API_LPS.'pembelian/farmasi/retur_beli/status/'.$_POST['status'];
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

    public function hapus()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'pembelian/farmasi/retur_beli/delete');
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
            header("Content-Disposition: attachment; filename=Laporan_Retur_Pembelian_Farmasi.xls");

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
        <div align="center"><b><u>LAPORAN RETUR PEMBELIAN FARMASI'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="5%">No. Retur</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="18%">'.$master['no_rt_pb'].'</th>

                        <th align="left" width="5%">Tgl. Retur</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.tanggal($master['tgl_rt_pb']).'</th>

                        <th align="left" width="6%">Jenis Barang</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="51%">'.$master['status_barang_caption'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Supplier</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="18%">'.$master['partner_name'].'</th>
                        
                        <th align="left" width="5%">Status</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['status_caption'].'</th>

                        <th align="left" width="6%">Jenis Retur</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['jns_retur_caption'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="5%">Alamat</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="18%">'.$master['ket_supplier'].'</th>

                        <th align="left" width="5%">User</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="12%">'.$master['created_by'].'</th>

                        <th align="left" width="6%">PPN</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="21%">'.$master['jns_ppn'].'</th>
                    </tr>
                    <tr>                        
                        <th align="left" width="5%">Keterangan</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="18%">'.$master['catatan'].'</th>

                        <th align="left" width="5%">Tgl. Update</th>
                        <th align="center" width="1%">:</th>
                        <th align="left" width="18%">'.tanggal_time($master['date_upd']).'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
            <tr>
            <th align="center" width="4%"><b>No</b></th>
                <th align="center" width="8%"><b>No. BPB</b></th>
                <th align="center" width="8%"><b>Kode</b></th>
                <th align="center" width="17%"><b>Nama Item</b></th>
                <th align="center" width="7%"><b>Satuan BPB</b></th>
                <th align="center" width="6%"><b>Jumlah BPB</b></th>
                <th align="center" width="7%"><b>Jml. Retur</b></th>
                <th align="center" width="7%"><b>Harga</b></th>
                <th align="center" width="6%"><b>Disc. (%)</b></th>
                <th align="center" width="7%"><b>Disc. (Harga)</b></th>
                <th align="center" width="8%"><b>Sub Total</b></th>
                <th align="center" width="8%"><b>No. Batch</b></th>
                <th align="center" width="7%"><b>Tgl. PO</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no.'</td>
                    <td class="border" align="left" >'.$key['no_bpb'] .'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="center">'.$key['nama_satuan'].'</td>
                    <td class="border" align="right">'.angka($key['jml_retur'],0).'</td>
                    <td class="border" align="right">'.angka($key['jml_bpb'],0).'</td>
                    <td class="border" align="right">'.angka($key['harga'],0).'</td>
                    <td class="border" align="right">'.angka($key['p_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['tot_diskon'],0).'</td>
                    <td class="border" align="right">'.angka($key['total'],0).'</td>
                    <td class="border" align="left">'.$key['no_batch'].'</td>
                    <td class="border" align="center">'.tanggal($key['tgl_ed']).'</td>
                    
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
        
            $pdf->Output("assets/laporan/"."Laporan_Retur_Pembelian_Farmasi.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

}

/* End of file Retur_pembelian_farmasi.php */
/* Location: ./application/apps/pembelian/controllers/retur_pembelian/Retur_pembelian_farmasi.php */