<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_bmhp extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper('function_helper');
    }

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'gudang/permintaan_bmhp_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'gudang/v_permintaan_bmhp';

        // Load View
		$this->load->view('template', $this->data);
	}

	public function get_unit_asal()
	{
        $headers  = getHeaderToken();
        $data = [
        	'user_id' => $this->session->userdata('user_id')
        ];
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
        $API_UNIT = BASE_URL_API_LPS."master/depo_farmasi/list";
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $API_UNIT);
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

    public function filter_barang($value='')
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
        // print_r(json_encode($_POST));die;
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/list_barang');
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

    public function default_auth()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/list_default_sign');
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

        $result=json_decode($buffer,true);

        $detail= [];
        foreach ($result['list'] as $key => $list) {
            $detail[$key]['seq_no']=$list['seq_no'];
            $detail[$key]['sign_id']=$list['sign_id'];
            $detail[$key]['sign_name']=$list['sign_name'];
            $detail[$key]['is_default']=$list['is_default'];
            $detail[$key]['is_active']=$list['is_default'];
            $detail[$key]['user_id']=$this->session->userdata('user_id');
            $detail[$key]['user_name']=$list['user_name'];
        }
        $result['list']=$detail;

        echo json_encode($result);
    }

    public function simpan()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
        if($_POST['edit']==0)
        {
        	$API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/insert';
            // $data['auths']=$_POST['data']['auths'];
        }
        else
        {
        	$API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/update';	
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
        // echo BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/search';die;

    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/search');
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
        // print_r($buffer);die();
        $result=json_decode($buffer);
        echo json_encode($result);
    }

    public function getPerKode()
    {
    	$API = BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/get/'.$_POST['data'];
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
            $data['master'] =$result['master']['data'][0];
            $data['detail'] =$result['detail']['data'];
        }
        echo json_encode($data);
        // var_dump($data);die();
    }

    public function user_approve($seq_no)
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();

        // var_dump($_POST['data']);

        $data['seq_no']=$seq_no;
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_beli/list_user_approve');
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

        // $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/'.$_POST['status'];	
        // print_r($API);die();
        // echo json_encode($API);
        // echo json_encode($_POST['data']);
        $headers  = getHeaderToken();
        $curl_handle = curl_init();

        if($_POST['status']==1)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/open';
        }
        else if($_POST['status']==2)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/release';   
        }
        else if($_POST['status']==3)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/approve';   
        }
        else if($_POST['status']==4)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/receive';   
        }
        else if($_POST['status']==5)
        {
            $API=BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/status/reject';   
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

    public function hapus()
    {
    	$headers  = getHeaderToken();
        $curl_handle = curl_init();
     
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API_LPS.'gudang/farmasi/minta_bmhp/delete');
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

    public function cetak(){
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
            header("Content-Disposition: attachment; filename=Laporan_Permintaan_BMHP.xls");

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
        <div align="center"><b><u>LAPORAN PERMINTAAN BMHP'; 
        $html.='</u></b><br>';
        $html.='</div>';
        
        $html.='<table class="master" cellspacing="0" style="width: 100%;border:1px solid black;">
                    <tr>
                        <th align="left" width="8%">No. PM</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['no_pm'].'</th>
                        <th align="center" width="10%">Tgl. PM :</th>
                        <th align="left" width="10%">'.tanggal($master['tgl_pm']).'</th>
                        <th align="left" width="8%">Status</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['status_caption'].'</th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Asal</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['unit_asal'].'</th>
                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%">User</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.$master['updated_by'].'</th>
                        <th align="left" width="8%">Tgl. Update</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="15%">'.tanggal_time($master['date_upd']).'</th>
                    </tr>
                    <tr>
                        <th align="left" width="8%">Unit Tujuan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['unit_tujuan'].'</th>

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
                        <th align="left" width="8%">Keterangan</th>
                        <th align="center" width="2%">:</th>
                        <th align="left" width="20%">'.$master['ket_pm'].'</th>

                        <th align="center" width="10%"></th>
                        <th align="left" width="10%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                        <th align="left" width="8%"></th>
                        <th align="center" width="2%"></th>
                        <th align="left" width="15%"></th>
                    </tr>
                </table>';

        if(count($detail)>0)
        {
            $html.='<table class="atas" cellspacing="0" style="width: 100%;border:1px black solid;">
            <tr style="border:1px black solid;">
                <th align="center" width="7%"><b>No</b></th>
                <th align="center" width="15%"><b>Kode</b></th>
                <th align="center" width="39%" colspan="5"><b>Nama Item</b></th>
                <th align="center" width="13%"><b>Satuan</b></th>
                <th align="center" width="13%"><b>Jml. Stok</b></th>
                <th align="center" width="13%"><b>Permintaan</b></th>
            </tr>';
            $no=1;
            
            foreach ($detail as $key)
            {
                $html.='<tr style="border:1px black solid;">
                    <td class="border" align="center">'.$no .'</td>
                    <td class="border" align="left" >'.$key['kd_item'] .'</td>
                    <td class="border" align="left"  colspan="5">'.$key['nama_item'].' </td>
                    <td class="border" align="center">'.$key['nama_satuan']. '</td>
                    <td class="border" align="right" >'.angka($key['jml_stok']).'</td>
                    <td class="border" align="right">'.angka($key['jml_minta'],0).'</td>
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
        
            $pdf->Output("assets/laporan/"."Laporan_Permintaan_BMHP.pdf", "F");
            $return["success"] = TRUE;

            echo json_encode($return);
        }
    }

}

/* End of file Permintaan_bmhp.php */
/* Location: ./application/apps/farmasi/controllers/gudang/Permintaan_bmhp.php */