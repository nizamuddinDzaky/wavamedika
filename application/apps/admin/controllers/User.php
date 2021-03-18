<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		// data[js] digunakan apabila dalam page tersebut butuh js, file di simpan di views/js
        $this->data['js'] = 'user_js';

        // data['main_view] digunakan untuk mengambil isi dari content body, file disimpan di views/main
        $this->data['main_view'] = 'v_user';

        // Load View
		$this->load->view('template', $this->data);
	}

    public function filter()
    {
        // $headers  = ['Content-Type: application/json','Host:dev.api.mersi-hospital','Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ4eGs0dHNPVVlYQW4zREt0WE1aeFBMQ3I5VkdGbVlOSyIsImlhdCI6MTU5MzQxMjMwNywibmJmIjoxNTkzNDEyMzA5LCJleHAiOjE1OTM0NDExMDcsImRhdGEiOnsidXNlcl9pZCI6MywidXNlcl9uYW1lIjoiMDAwMDAwMDAiLCJ1c2VyX2Z1bGxuYW1lIjoiQ2FuZHJhIFNldGlhd2FuIn19.mohQHIWernAsIsxGvZpBdMb-erJ1TqasyjgTeZafGwk'];
        $curl_handle = curl_init();
        $param = $this->input->post();
        $param['data_status'] = $param['status'] ?? 0;
        $param['page_row']    = $param['page_row'] ?? 10;
        $param['criteria']    = $param['criteria'] ?? '';
        $param['page']        = $param['page'] ?? 1;
        $headers=getHeaderToken();

        curl_setopt($curl_handle, CURLOPT_URL,'http://36.92.178.100:9000/access/users');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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

    public function getPerKode()
    {
        $curl_handle = curl_init();
        $param = $this->input->post();
        $param['user_id']    = $param['data'];
        $headers=getHeaderToken();
        curl_setopt($curl_handle, CURLOPT_URL,"http://36.92.178.100:9000/access/users/".$param['user_id']."/byid");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        $roles= [];
        foreach ($result['rows'][0]['roles'] as $key => $list) {
            $roles[]     =$list['role_id'];
        }
        $result['roles']=$roles;
        // print_r($result['roles']);
        // print_r($result);
        echo json_encode($result);
        // print_r($result);
        // $API = 'http://36.92.178.100:9000/access/users/'.$_POST['data'].'/byid';
        // $result = json_decode($this->curl->simple_get($API), true);
        // print_r($result);die();
        // $data = [];
        // if (count($result['master'])> 0)
        // {
        //     $data['master']=$result['master'][0];
        //     $data['detail']=$result['detail'];
        //     $data['autor']=$result['auth'];
        // }
        // echo json_encode($data);
    }
    public function getroles()
    {
        $curl_handle = curl_init();
        $param = $this->input->post();
        $param['user_id']  = $param['user_id'];
        $param['criteria'] = $param['criteria'];
        $param['roles']    = $param['roles']?? '';

        $headers=getHeaderToken();
        curl_setopt($curl_handle, CURLOPT_URL,"http://36.92.178.100:9000/access/users/".$param['user_id']."/rolesadd");
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
        // $roles= [];
        // foreach ($result['role'] as $key => $list) {
        //     $detail[$key]['role_id']     =$list['role_id'];
        // }
        // $result['roles']=$roles;
        echo json_encode($result);
        // print_r($result);
        // $API = 'http://36.92.178.100:9000/access/users/'.$_POST['data'].'/byid';
        // $result = json_decode($this->curl->simple_get($API), true);
        // print_r($result);die();
        // $data = [];
        // if (count($result['master'])> 0)
        // {
        //     $data['master']=$result['master'][0];
        //     $data['detail']=$result['detail'];
        //     $data['autor']=$result['auth'];
        // }
        // echo json_encode($data);
    }

    function get_data_unit()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $param = $this->input->post();
        $data['user_id']="1";
        $data['criteria']=$param['criteria'];
        $headers=getHeaderToken();
        curl_setopt($curl_handle, CURLOPT_URL, 'http://36.92.178.100:9000/access/units');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
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
            'no_unit'   => '',
            'text' => 'Pilih unit Asal',
        ];
        foreach ($result['rows'] as $unit) {
            $daftar_unit[] = (object) [
                'id'   => $unit['id_unit'],
                'no_unit' => $unit['no_unit'],
                'text' => $unit['nama_unit'],
            ];
        }
        echo json_encode($daftar_unit);
    }

    public function simpan()
    {
        $headers  = getHeaderToken();
        $curl_handle = curl_init();
        $API='http://36.92.178.100:9000/access/users';   
        $headers=getHeaderToken();
        // var_dump(json_encode($_POST['data']));die();
        
        curl_setopt($curl_handle, CURLOPT_URL, $API);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "PUT");
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

}

/* End of file User.php */
/* Location: ./application/apps/admin/controllers/User.php */