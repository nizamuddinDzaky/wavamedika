<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

	public function index()
	{
        $data = [
            'module'        => 'tpp',
            'title'         => 'Lokasi',
            'urlData'       => site_url() . 'tpp/master/lokasi/',
            'main_view'     => 'master/v_lokasi',
            'js'            => 'master/js_lokasi',
            'fieldData'     => [
                "id_lokasi" => "ID",
                "propinsi"  => "Propinsi",
                "kabupaten" => "Kabupaten",
                "kecamatan" => "Kecamatan",
                "kelurahan" => "Kelurahan",
                "kode_pos"  => "Kode Pos"
            ],
            'dataPropinsi'  =>   $this->getDataPropinsi(),
            'dataKabupaten' => '', //$this->getDataKabupaten(),
            'dataKecamatan' => '' //$this->getDataKecamatan(),
          ];

       $this->load->view('template', $data);
    }
    
    private function getDataPropinsi($type = "")
    {
        $Request = GetResponseApi("/tpp_mr/propinsipx", [], "get");
        $data    = "<option selected hidden value=''>-- Propinsi</option>";
        foreach ($Request->list as $key => $v) {
        $data .= "<option value='" . $v->propinsi . "'>" . $v->propinsi . "</option>";
        }
        return $data;
    }
}