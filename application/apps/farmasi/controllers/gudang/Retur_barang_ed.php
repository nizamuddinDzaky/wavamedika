<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur_barang_ed extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
        $this->data['js'] = 'gudang/retur_barang_ed_js';
        $this->data['main_view'] = 'gudang/v_retur_barang_ed';
		$this->load->view('template', $this->data);
	}

	public function filter()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
   
        $param['status']     = $param['status'] ?? 0;
        $param['start_date'] = $param['start_date'] ?? 1;
        $param['end_date']   = $param['end_date'] ?? 1;
        $param['criteria']   = $param['criteria'] ?? '';
        $param['page_row']   = $param['page_row'] ?? 10;
        $param['criteria']   = $param['criteria'] ?? '';
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/search');
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

    public function Filter_barang()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        $data['tgl_retur_mutasi_ed']   = $param['tgl_retur_mutasi_ed'] ?? '';
        $data['start_date']   = $param['start_date'] ?? '';
        $data['end_date']   = $param['end_date'] ?? '';
        $data['page']         = $param['page'] ?? 1;
        $data['page_row']     = $param['page_row'] ?? 10;
        $data['criteria']     = $param['criteria'] ?? '';
        $data['id_unit_stok'] = $param['id_unit_stok'] ?? '';
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/list_barang');
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

    public function Filter_barang_no_mutasi()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        // print_r($param);die();
        // print_r($param);die();

        $data['tgl_rt_mutasi'] = $param['data']['tgl_rt_mutasi'] ;
        $data['id_unit_stok']  = $param['data']['id_unit_stok'] ;
        $data['criteria']      = $param['data']['criteria'] ;
        $data['page_row']      = $param['data']['page_row'] ;
        $data['page']          = $param['data']['page'] ;
        // print_r($data);die();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/list_barang');
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
        // print_r($result);
        echo json_encode($result);
    }


    public function getPerKode()
    {
        $API = BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/get/'.$_POST['data'];
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
        }
        echo json_encode($data);
    }

    function get_data_unit()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        $data['user_id']=$this->session->userdata['user_id'];
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'master/unit_akses/list_farmasi');
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
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['edit']==0)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/insert';
        }
        else
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/update';   
        }


        $data['master']  = $_POST['data']['master'];
        $data['details'] = $_POST['data']['details'];

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
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/delete');
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

    public function user_approve($seq_no)
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        // var_dump($_POST['data']);

        $data['seq_no']=$seq_no;
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/list_user_approve');
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
        $daftar = [];
        foreach ($result['list'] as $data) {
            $daftar[] = (object) [
                'user_id' => $data['user_id'],
                'user_name' => $data['user_name'],
                'user_fullname' => $data['user_fullname']
            ];
        }
        echo json_encode($daftar);
        // echo json_encode($result);
    }

    public function status()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['status']==1)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/status/open';
        }
        else if($_POST['status']==2)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/status/release';   
        }
        // echo json_encode($API);
        // echo json_encode($_POST['data']);
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

    public function no_batch()
    {
        //   $row = array();
        // $row[] = array(
        //     "no_batch"=>"PPFN-202001-001",
        //                   array("no_pp"=>"PPFN-202001-001",
        //     "tgl_pp"=>"12/12/2020",
        //     "depo"=>"FARMASI IRNA",
        //     "ket"=>"Permintaan Barang Baru",
        //     "status"=>"Release",
        //     "user"=>"Rizal Apt",
        //     "tgl_update"=>"20/02/2020 09:34"),
        //                               array("no_pp"=>"PPFN-202001-001",
        //     "tgl_pp"=>"12/12/2020",
        //     "depo"=>"syafri wira",
        //     "ket"=>"Permintaan Barang Baru",
        //     "status"=>"Release",
        //     "user"=>"Rizal Apt",
        //     "tgl_update"=>"20/02/2020 09:34")
            
        // );
        // $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode(array('total' => count($row),'rows' => $row)));
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        // print_r($param);die();
        $param['id_item']     = $param['id_item'] ;
        $param['criteria'] = $param['criteria'] ;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/retur_mutasi_ed/list_no_batch');
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
        // print_r($result);
        // echo json_encode($result);
        $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode(array('total' => count($result['data']),'rows' => $result['data'])));

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
            header("Content-Disposition: attachment; filename=Laporan_Retur_Barang_ED.xls");

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
        <div align="center"><b><u>LAPORAN RETUR BARANG ED'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%; border:0.6px solid black;">
                    <tr>
                        <th align="left" width="8%">No. Retur</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="18%">'.$master['no_rt_mutasi'].'</th>
                        <th align="left" width="8%">Tgl. Retur</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="18%">'.tanggal($master['tgl_rt_mutasi']).'</th>
                        <th align="left" width="8%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="35%">'.tanggal_time($master['date_upd']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Asal</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="18%">'.$master['unit_stok'].'</th>
                        <th align="left" width="8%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['status_caption'].'</th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="18%">'.$master['ket_rt_mutasi'].'</th>
                        <th align="left" width="8%">User</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['updated_by'].'</th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%; border:0.6px solid black;">
            <tr>
                <th align="center" width="5%"><b>No</b></th>
                <th align="center" width="10%"><b>Kode</b></th>
                <th align="center" width="26%"><b>Nama Item</b></th>
                <th align="center" width="10%"><b>Satuan</b></th>
                <th align="center" width="10%"><b>Jml. Stok</b></th>
                <th align="center" width="10%"><b>Jml. Retur</b></th>
                <th align="center" width="10%"><b>Harga</b></th>
                <th align="center" width="10%"><b>Tgl. ED</b></th>
                <th align="center" width="10%"><b>No. Batch</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr>
                    <td class="border" align="center">'.$no .'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left">'.$key['nama_item'].' </td>
                    <td class="border" align="center">'.$key['nama_satuan']. '</td>
                    <td class="border" align="right">'.angka($key['hpp'],0).'</td>
                    <td class="border" align="right" >'.angka($key['jml_retur'],0).'</td>
                    <td class="border" align="right">'.angka($key['hpp'],0).'</td>
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
        
            $pdf->Output("assets/laporan/"."Laporan_Retur_Barang_ED.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

}

/* End of file Retur_barang_ed.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Retur_barang_ed.php */