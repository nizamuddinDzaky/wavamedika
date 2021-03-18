<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register_ganti_no_rm extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Register Ganti No. RM',
    'urlData'   => site_url() . 'tpp/laporan/register_ganti_no_rm/',
    'main_view' => 'laporan/v_register_ganti_no_rm',
    'js'        => 'laporan/js_register_ganti_no_rm',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function RegisterGantiRm() {
  $this->req = $this->input->post();
  if (!empty($this->req['rows'])) {
   $this->req['batas'] = $this->req['rows'];
  } else {
   $this->req['batas'] = 10;
  }

  if (!empty($this->req['page'])) {
   $this->req['halaman'] = $this->req['page'];
  } else {
   $this->req['halaman'] = 1;
  }
  $Request = GetResponseApi("/tpp_lapreggantinomr/view_lapreggantinomr", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

 function RegisterGantiRmRekap() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_lapreggantinomr/view_lapreggantinomr_rekap", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

 function testing() {
  $data = '
   "no_mr": "12000052",
            "tgl_mrs": "2020-06-17 14:11:59.271613",
            "nama_lengkap": "ABU JANDA, Tn.",
            "umur": "45 th.",
            "sex": "L",
            "kecamatan": "Abiansemal",
            "kamar": "Klinik Bedah",
            "status": null,
            "kelas": "II",
            "nama_keluarga": "",
            "nama_perujuk": "",
            "asuransi": "",
            "instansi": "",
            "admission": "",
            "catatan_diagnosa": null,
            "icd": null,
            "nama_icd": null,
            "unit": "KLINIK RAWAT JALAN",
            "ri_rj": "RJ",
            "karyawan": null,
            "penyakit": null,
            "rencana_pulang": "2020-06-22 00:00:00",
            "id_mr": 131,
            "jatah_kelas": "",
            "id_mrs": 200600011
   ';
 }

}
