<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_antri_kamar extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'Pesanan Antri Kamar',
    'urlData'   => site_url() . 'tpp/laporan/pesanan_antri_kamar/',
    'main_view' => 'laporan/v_pesanan_antri_kamar',
    'js'        => 'laporan/js_pesanan_antri_kamar',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function PesanAntriKamar() {
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
  $Request = GetResponseApi("/tpp_lapregpesankamar/view_lapregpesankamar", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
   foreach ($data['rows'] as $index => $val) {
    $tgl_pesan_ex                    = explode(" ", $val->tgl_pesan);
    $data['rows'][$index]->tgl_pesan = $tgl_pesan_ex[0];
    $data['rows'][$index]->jam       = $tgl_pesan_ex[1];
   }
  }
  echo json_encode($data);
 }

 function IndexPasien() {
  if (!$this->input->is_ajax_request()) {
   exit('No direct script access allowed');
  }
  $Request = GetResponseApi("/tpp_indekspasien/view_datapasien_indeks", $this->input->post(), "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

 function DataKamarPasien() {
  $Request = GetResponseApi("/tpp_lapregpesankamar/view_datapesankamar", $this->input->post(), "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

 function DataPesanKamar() {
  $Request = GetResponseApi("/tpp_pesankamar/view_datapasien_pesankamar", $this->input->post(), "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

 function PesanKamarCatatan() {
  $Request = GetResponseApi("/tpp_pesankamar/update", $this->input->post(), "post");
  echo json_encode($Request);
 }

 public function getajax() {
  if (/* $this->input->is_ajax_request() and */!empty($this->input->post("act"))) {
   if (method_exists($this, $this->input->post("act"))) {
    $act       = $this->input->post("act");
    $this->req = $this->input->post();
    print_r($this->$act());
   } else {
    print_r($this->Api->msg(true, "Invalid Method"));
   }
  } else {
   print_r($this->Api->msg(true, "Invalid Request"));
  }
 }

 public function ambildata($param) {
  return print_r($this->$param());
 }

 private function get_kecamatan() {
  $Request = GetResponseApi("/tpp_datapasien/kecamatanpx", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->k1 . "'>" . $value->k1 . "</option>";
  }
  return $data;
 }

 private function get_kabupaten() {
  $Request = GetResponseApi("/tpp_datapasien/kabupatenpx", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->k1 . "</option>";
  }
  return $data;
 }

 private function get_jnspasien() {
  $Request = GetResponseApi("/tpp_mr/jnspasien", $this->req, "get");
  return $Request->list;
  $data    = "<option value='' hidden selected> Pilih Jenis Pasien</option>";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->id_jnspasien . "'>" . $value->jenis_pasien . "</option>";
  }
  return $data;
 }

 private function get_provinsi() {
  $Request = GetResponseApi("/tpp_mr/propinsipx", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->propinsi . "</option>";
  }
  return $data;
 }

 private function get_kegiatan_khusus() {
  $Request = GetResponseApi("/tpp_mr/jnskegiatankhusus", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_kegiatan . "</option>";
  }
  return $data;
 }

 private function get_gelar() {
  $Request = GetResponseApi("/tpp_mr/gelarpx", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->gelar . "</option>";
  }
  return $data;
 }

 private function get_kelas() {
  $Request = GetResponseApi("/tpp_mr/kelas", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->kelas . "</option>";
  }
  return $data;
 }

 private function get_tempat_lahir() {
  $Request = GetResponseApi("/tpp_mr/tmplahirpx", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->tmp_lahir . "</option>";
  }
  return $data;
 }

 private function get_unit() {
  $Request = GetResponseApi("/tpp_mrs/unit", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_unit . "</option>";
  }
  return $data;
 }

 private function get_perujuk() {
  $Request = GetResponseApi("/tpp_mrs/perujuk", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_perujuk . "</option>";
  }
  return $data;
 }

 private function get_tarif() {
  $Request = GetResponseApi("/tpp_mrs/tarif", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->uraian . "</option>";
  }
  return $data;
 }

 private function get_paket() {
  $Request = GetResponseApi("/tpp_mrs/paket", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->uraian . "</option>";
  }
  return $data;
 }

 private function get_instansi() {
  $Request = GetResponseApi("/tpp_mrs/instansi", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_instansi . "</option>";
  }
  return $data;
 }

 private function get_ansuransi() {
  return json_encode($Request = GetResponseApi("/tpp_mrs/asuransi", $this->req, "get"));
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_instansi . "</option>";
  }
  return $data;
 }

 private function get_admission() {
  $Request = GetResponseApi("/tpp_mrs/admission", $this->req, "get");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_instansi . "</option>";
  }
  return $data;
 }

 private function get_data() {
  return $Request = GetResponseApi("/tpp_datapasien/view_datapasien", $this->req, "post");
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option>" . $value->nama_instansi . "</option>";
  }
  return $data;
 }

 private function get_kecamatan_dinamis() {
  $Request = GetResponseApi("/tpp_mr/kecamatanpx", $this->req, "post");
  array_unshift($Request->list, ["kecamatan" => "", "selected" => true]);
  return json_encode($Request->list);
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kecamatan . "'>" . $value->kecamatan . "</option>";
  }
  return $data;
 }

 private function get_kabupaten_dinamis() {
  $Request = GetResponseApi("/tpp_mr/kabupatenpx", $this->req, "post");
  array_unshift($Request->list, ["kabupaten" => "", "selected" => true]);
  return json_encode($Request->list);
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kabupaten . "'>" . $value->kabupaten . "</option>";
  }
  return $data;
 }

 private function get_kelurahan_dinamis() {
  $Request = GetResponseApi("/tpp_mr/kelurahanpx", $this->req, "post");
  array_unshift($Request->list, ["kelurahan" => "", "selected" => true]);
  return json_encode($Request->list);
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kelurahan . "'>" . $value->kelurahan . "</option>";
  }
  return $data;
 }

 private function get_dokter() {
  $Request = GetResponseApi("/tpp_nomorkosong/dokter", $this->req, "get");
  array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  return json_encode($Request->list);
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kelurahan . "'>" . $value->kelurahan . "</option>";
  }
  return $data;
 }

 private function JenisKelasIndex() {
  $Request = GetResponseApi("/tpp_pesankamar/kelas", $this->req, "post");
  array_unshift($Request->list, ["kelas" => "", "selected" => true]);
  return json_encode($Request->list);
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kelurahan . "'>" . $value->kelurahan . "</option>";
  }
  return $data;
 }

 private function DokterPoli() {
  $Request = GetResponseApi("/tpp_rencanakontrol/dokter", $this->req, "post");
  array_unshift($Request->list, ["id_karyawan" => "", "nama_lengkap" => "Pilih Dokter", "selected" => true]);
  return json_encode($Request->list);
  $data    = "";
  foreach ($Request->list as $key => $value) {
   $data .= "<option value='" . $value->kelurahan . "'>" . $value->kelurahan . "</option>";
  }
  return $data;
 }

 private function JenisKamar() {
  $Request = GetResponseApi("/tpp_pesankamar/jeniskamar", [], "get");
  return json_encode($Request->list);
 }

 private function RuangKamarMasuk() {
  $Request = GetResponseApi("/tpp_pesankamar/kamar", [], "get");
  return json_encode($Request->list);
 }

 private function JnsPasien() {
  $Request = GetResponseApi("/tpp_mr/jnspasien", $this->req, "get");
  return json_encode($Request->list);
 }

 private function GetJnsKegiatanKhusus() {
  $Request = GetResponseApi("/tpp_mr/jnskegiatankhusus", $this->req, "get");
  return json_encode($Request->list);
 }

 private function KelasBpjs() {
  $Request = GetResponseApi("/tpp_mr/kelas", $this->req, "get");
  return json_encode($Request->list);
 }

 private function TempatLahirPx() {
  $Request = GetResponseApi("/tpp_mr/tmplahirpx", $this->req, "get");
  return json_encode($Request->list);
 }

 private function GolonganPasien() {
  $Request = GetResponseApi("/tpp_golonganpx/datagolonganpx", $this->req, "get");
  return json_encode($Request->list);
 }

}
