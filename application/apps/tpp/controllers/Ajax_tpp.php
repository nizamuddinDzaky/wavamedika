<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_tpp extends CI_Controller {

 function tes() {
  debug('test');
 }

 public function index() {
  $this->load->model('M_api');
  if (/* $this->input->is_ajax_request() and */!empty($this->input->post("act"))) {
   if (method_exists($this, $this->input->post("act"))) {
    $act       = $this->input->post("act");
    $this->req = $this->input->post();
    print_r($this->$act());
   } else {
    print_r($this->M_api->msg(true, "Invalid Method"));
   }
  } else {
   print_r($this->M_api->msg(true, "Invalid Request"));
  }
 }

 public function ambildata($param) {
  return print_r($this->$param());
 }

 function JnsPasien() {
  $Request          = GetResponseApi("/tpp_mr/jnspasien", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value=""  selected>Pilih Jenis</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_jnspasien . "'>" . $value->jenis_pasien . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function GetJnsKegiatanKhusus() {
  $Request          = GetResponseApi("/tpp_mr/jnskegiatankhusus", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value=""  >Pilih Jenis</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_jnskegiatankhusus . "'>" . $value->nama_kegiatan . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function KelasBpjs() {
  $Request          = GetResponseApi("/tpp_mr/kelas", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value=""  selected>Pilih Kelas</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kelas . "'>" . $value->kelas . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function GetKabupaten() {
  $Request          = GetResponseApi("/tpp_mr/kabupatenpx", $this->input->post(), "post");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value=""  selected>Pilih Kabupaten</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kabupaten . "'>" . $value->kabupaten . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function GetKecamatan() {
  $Request          = GetResponseApi("/tpp_mr/kecamatanpx", $this->input->post(), "post");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value=""  selected>Pilih Kecamatan</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kecamatan . "'>" . $value->kecamatan . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function GetKelurahan() {
  // if (empty($this->req['propinsi'])) {
  //     $Request = GetResponseApi("/tpp_mr/kelurahan", $this->req, "get");
  // $Result['status'] = $Request->metadata;
  // $Result['lsdt'] = '<option value="" disabled selected>Pilih Kelurahan</option>';
  // if (!empty($Request->list)) {
  //     foreach ($Request->list as $index => $value) {
  //         $Result['lsdt'] .= "<option value='" . $value->kelurahan . "'
  //                         propinsi = '" . $value->propinsi . "'
  //                         kabupaten = '" . $value->kabupaten . "'
  //                         kecamatan = '" . $value->kecamatan . "'
  //         >" . $value->kelurahan . "</option>";
  //     }
  // }
  // } else {
  $Request          = GetResponseApi("/tpp_mr/kelurahanpx", $this->input->post(), "post");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Kelurahan</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kelurahan . "'>" . $value->kelurahan . "</option>";
   }
  }
  // }


  echo json_encode($Result);
 }

 function ComboUnit() {
  $Request          = GetResponseApi("/tpp_mrs/unit", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Unit</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_unit . "'>" . $value->nama_unit . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboRuang() {
  $Request          = GetResponseApi("/tpp_mrs/kamar", $this->input->post(), "post");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Ruang</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_kamar . "'>" . $value->nama_kamar . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboDokter() {
  $Request          = GetResponseApi("/tpp_mrs/dokter", $this->input->post(), "post");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Dokter</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_karyawan . "'>" . $value->nama_lengkap . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboPerujuk() {
  $Request          = GetResponseApi("/tpp_perujuk/jenisperujuk", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Jenis Perujuk</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->jr . "'>" . $value->jenis . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboTarif() {
  $Request          = GetResponseApi("/tpp_mrs/tarif", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Tarif</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_tarif . "'>" . $value->uraian . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboPaket() {
  $Request          = GetResponseApi("/tpp_mrs/paket", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected>Pilih Paket</option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->id_jnsbiaya . "'>" . $value->uraian . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboInstansi() {
  $Request          = GetResponseApi("/tpp_mrs/instansi", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected></option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kode_instansi . "' data-nama='" . $value->nama_instansi . "'>" . $value->kode_instansi . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboAsuransi() {
  $Request          = GetResponseApi("/tpp_mrs/asuransi", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected></option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kode_instansi . "' data-nama='" . $value->nama_instansi . "'>" . $value->kode_instansi . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboAdmission() {
  $Request          = GetResponseApi("/tpp_mrs/admission", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected></option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kode_instansi . "' data-nama='" . $value->nama_instansi . "'>" . $value->kode_instansi . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function ComboKelasMrs() {
  $Request          = GetResponseApi("/tpp_mr/kelas", $this->input->post(), "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = '<option value="" selected></option>';
  if (!empty($Request->list)) {
   foreach ($Request->list as $index => $value) {
    $Result['lsdt'] .= "<option value='" . $value->kelas . "'>" . $value->kelas . "</option>";
   }
  }
  echo json_encode($Result);
 }

 function getSelectKecPerujuk($type = "") {
  $Request          = GetResponseApi("/tpp_perujuk/kecamatanperujuk", [], "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = "";
  foreach ($Request->list as $key => $value) {
   $Result['lsdt'] .= "<option value='$value->kc'>" . $value->kecamatan . "</option>";
  }
  echo json_encode($Result);
 }

 function getSelectKotaKab($type = "") {
  $Request          = GetResponseApi("/tpp_datapasien/kabupatenpx", [], "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = "";
  foreach ($Request->list as $key => $value) {
   $Result['lsdt'] .= "<option value='$value->k1'>" . $value->k1 . "</option>";
  }
  echo json_encode($Result);
 }

 function ComboDokterTindakan() {
  $Request          = GetResponseApi("/tpp_pakettindakan/dokter", [], "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = "<option value=''> Pilih Dokter</option>";
  foreach ($Request->list as $key => $value) {
   $Result['lsdt'] .= "<option value='$value->id_karyawan' data-nama='" . $value->nama . "'>" . $value->nama . "</option>";
  }
  echo json_encode($Result);
 }

 function ComboPetugas() {
  $Request          = GetResponseApi("/tpp_pakettindakan/petugas", [], "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = "<option value=''>Pilih Petugas</option>";
  foreach ($Request->list as $key => $value) {
   $Result['lsdt'] .= "<option value='$value->id_karyawan' data-nama='" . $value->nama . "'>" . $value->nama . "</option>";
  }
  echo json_encode($Result);
 }

 function ComboboxLoket() {
  $Request          = GetResponseApi("/tpp_antridaftar/loket", [], "get");
  $Result['status'] = $Request->metadata;
  $Result['lsdt']   = "<option value=''>Pilih Loket</option>";
  foreach ($Request->list as $key => $value) {
   $Result['lsdt'] .= "<option value='$value->loket' >" . $value->loket . "</option>";
  }
  echo json_encode($Result);
 }

}
