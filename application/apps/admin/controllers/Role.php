<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'role_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'v_role';

        // Load View
		$this->load->view('template', $this->data);
	}

    public function filter()
    {
        $param = $this->input->post();
        
        $data['data_status'] = $param['data_status'] ?? 0;
        $data['page'] = $param['page'] ?? 1;
        $data['page_row'] = $param['rows'] ?? 10;
        $data['criteria'] = $param['criteria'] ?? '';

        $headers=getHeaderToken();

        // var_dump($headers);

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

    public function get()
    {
        $param = $this->input->post();
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles/'.$param['role_id'].'/byid');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
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

        if (count($result['rows'])> 0)
        {
            $data['master']=$result['rows'][0];
        }

        echo json_encode($data);
    }

    public function getAkses()
    {
        $param = $this->input->post();

        $data['criteria']=$param['criteria'];
                
        $headers=getHeaderToken();

        //ketika menampilkan daftar yang akan ditambahkan
        //$param['akses']=modulesadd/transadd/unitsadd

        //ketika menampilkan data yang bershasil ditambahkan
        //$param['akses']=modules/trans/units

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles/'.$param['role_id'].'/'.$param['akses']);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

    public function getAksesMenu()
    {
        $data = $this->input->post();

        $param = $data["data"];

        $detail = $data["detail"];
        
        $headers=getHeaderToken();

        //ketika menampilkan daftar yang akan ditambahkan
        //$param['akses']=modulesadd/transadd/unitsadd

        //ketika menampilkan data yang bershasil ditambahkan
        //$param['akses']=modules/trans/units

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles/'.$param['role_id'].'/'.$param['id_item'].'/'.$param['akses']);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $param['metode']);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);

        if ($param['metode']=="PATCH")
        {
            # code...
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($detail));
        }

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
        
        if ($param['metode']=='GET')
        {
            # code...
            for ($i=0; $i < sizeof($result['rows']) ; $i++)
            { 
                # code...
                if ($result['rows'][$i]['is_granted']==true)
                {
                    # code...
                    $value='<img src='. base_url('assets/img/centang_toska.png').'>';
                }
                else
                {
                    $value='<img src='. base_url('assets/img/uncentang.png').'>';   
                }

                $result['rows'][$i]['icon']=$value;
            }
            
        }

        echo json_encode($result);
    }

    public function simpanAkses()
    {
        $param = $this->input->post();
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles/'.$param['role_id'].'/'.$param['akses']);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);

        if ($param['akses']=="menus")
        {
            # code...
            $data=(object)$param['detailitem'];
            $data=json_encode($data);
        }
        else
        {
            $data=json_encode($param['detailitem']);   
        }

        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,$data);
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

    public function deleteAkses()
    {
        $param = $this->input->post();
        
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles/'.$param['role_id'].'/'.$param['akses']);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        
        if ($param['akses']=="menus")
        {
            # code...
            $data=(object)$param['detailitem'];
            $data=json_encode($data);
        }
        else
        {
            $data=json_encode($param['detailitem']);   
        }

        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,$data);

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
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $_POST['method']);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));
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

    public function delete()
    {
        $headers=getHeaderToken();

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_ADMIN.'roles');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($_POST['data']));
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

}

/* End of file Role.php */
/* Location: ./application/apps/admin/controllers/Role.php */