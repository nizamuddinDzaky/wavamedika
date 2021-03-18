<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_mrs extends CI_Controller
{

  function index()
  {
    $data = [
      'title'     => 'Pasien MRS',
      'urlData'   => site_url() . 'tpp/entry/pasien_mrs/',
      'main_view' => 'entry/v_pasien_mrs',
      'js'        => 'entry/pasien_mrs_js',
      'data1'     => '',
      'data2'     => '',
      'dataKabupaten' => $this->getSelectKotaKab(),
      'dataKecamatan' => $this->getSelectKec(),
    ];
    $this->load->view('template_tpp', $data);
  }

  function GetNoMrs()
  {
    $Request = GetResponseApi("/tpp_mrs/nomrs", $this->input->post(), "get");
    echo json_encode($Request);
  }

  function PasienNomr()
  {
    $Request = GetResponseApi("/tpp_mrs/view_datapasien", $this->input->post(), "post");
    if (!empty($Request->metadata) && $Request->metadata->err_code == "0") {
      $params['id_mr'] = $Request->list[0]->id_mr;
      $Request->statuspasien = GetResponseApi("/tpp_mrs/statuspasien", $params, "post");
      $Request->ketbayar = GetResponseApi("/tpp_mrs/bayarterakhir", $params, "post");
      $Request->kamar = GetResponseApi("/tpp_mrs/kamar", $params, "post");
      $Request->catatanpenting = GetResponseApi("/tpp_mrs/catatanpenting", $params, "post");
      $Request->statuspenyakit = GetResponseApi("/tpp_mrs/statuspenyakit", $params, "post");
    }
    echo json_encode($Request);
  }

  function InsertMrs()
  {
    $this->req = $this->input->post();
    if (empty($this->req['karyawan'])) {
      $this->req['karyawan'] = null;
    }
    if (empty($this->req['cob'])) {
      $this->req['cob'] = 0;
    }
    if (empty($this->req['cek_penunjang'])) {
      $this->req['cek_penunjang'] = 0;
    }

    $date = explode("/", $this->req["tgl_mrs"]);
    $this->req['tgl_mrs'] = $date["2"] . "-" . $date["1"] . "-" . $date["0"];
    $this->req['jam_mrs'] = $this->req['tgl_mrs'] . " " . $this->req['jam_mrs'] . ":00";
    $this->req['biaya_kartu'] = null;
    $this->req['no_mr'] = $this->req["no_rm"];

    if (!empty($this->req['id_mrs'])) {
      unset($this->req['id_mrs']);
    }

    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    // $this->check($this->req);

    $Request = GetResponseApi("/tpp_mrs/insert", $this->req, "post");
    echo json_encode($Request);
  }

  function InsertTindakan()
  {
    $this->req = $this->input->post();
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $Request = GetResponseApi("/tpp_pakettindakan/insert", $this->req, "post");
    echo json_encode($Request);
  }

  function UpdatePetugas()
  {
    $this->req = $this->input->post();
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $Request = GetResponseApi("/tpp_pakettindakan/update_petugas", $this->req, "post");
    echo json_encode($Request);
  }

  function ListPasien()
  {
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

    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $Request = GetResponseApi("/tpp_datapasien/view_datapasien", $this->req, "post");
    $data    = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date  = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y");
    }
    echo json_encode($data);
  }

  function ListPerujuk()
  {
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

    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $Request = GetResponseApi("/tpp_perujuk/dataperujuk", $this->req, "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y");
    }
    echo json_encode($data);
  }

  function DetailPerujuk()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $Request = GetResponseApi("/tpp_perujuk/view_perujuk", $this->input->post(), "post");
    echo json_encode($Request);
  }


  function getPembayaran()
  {
    $this->req = $this->input->post();
    $Request['tindakan'] = GetResponseApi("/tpp_pakettindakan/view_datatindakan", $this->req, "post");
    $Request['lab'] = GetResponseApi("/tpp_pakettindakan/view_datalaboratorium", $this->req, "post");
    $Request['radio'] = GetResponseApi("/tpp_pakettindakan/view_dataradiologi", $this->req, "post");

    $data['tindakan'] = SetPagination($Request['tindakan']->list, $Request['tindakan']->metadata);
    $data['lab'] = SetPagination($Request['lab']->list, $Request['lab']->metadata);
    $data['radio'] = SetPagination($Request['radio']->list, $Request['radio']->metadata);

    $data['total'] = 0;
    $data['total'] += $this->HitungTotalBayar($Request['tindakan']->list);
    $data['total'] += $this->HitungTotalBayar($Request['lab']->list);
    $data['total'] += $this->HitungTotalBayar($Request['radio']->list);
    echo json_encode($data);
  }

  private function RemoveArray($array, $keys)
  {
    error_reporting(0);
    foreach ($keys as $key => $value) {
      unset($array[$value]);
    }
    return $array;
  }

  private function HitungTotalBayar($data)
  {
    $total = 0;
    foreach ($data as $key => $value) {
      $harga = str_replace("$", "", $value->tarif);
      $harga = str_replace(",", "", $harga);
      $total += (float) $harga;
    }
    return $total;
  }

  function check($data)
  {
    $x = [];
    $data_asli = json_decode('{
      "id_mr": 71,
       "no_mr": "12000022",
       "id_kamar": 63,
       "id_unit": 13,
       "dokter" : 34,
       "id_perujuk":0,
       "kunjungan": "Lama",
       "jam_mrs": "2020-05-27 08:20:20",
       "perujuk": "null",
       "alamat_perujuk": "alamat_perujuk",
       "pj_biaya": "pj_biaya",
       "alamat_pjbiaya": "alamat_pjbiaya",
       "nama_perujuk": "nama_perujuk",
       "biaya_kartu" : 0,
       "instansi": "i",
       "asuransi": "a",
       "admission": "a",
       "ks_instansi": 0,
       "ks_asuransi": 0,
       "pembayaran": "pembayaran",
       "no_peserta": "no_peserta",
       "no_sjp":"1234",
       "cara_masuk": "cara_masuk",
       "operator" : 972,
       "id_tarif": 818,
       "id_jnsbiaya" : 54,
       "karyawan": 0,
       "jatah_kelas": "II",
       "cob": 0,
       "cek_penunjang" :0
}', true);

    // debug($data_asli);
    foreach ($data as $key => $value) {
      if (array_key_exists($key, $data_asli)) {
        $x['ada'][] = $key;
      } else {
        $x['tidak'][] = $key;
      }
    }
    foreach ($data_asli as $key => $value) {
      if (!array_key_exists($key, $data)) {
        $x['Tambahidewe'][] = $key;
      }
    }
    $x['sw'] = count($data_asli);
    debug($x);
  }

  private function getSelectKotaKab($type = "")
  {
    $Request = GetResponseApi("/tpp_datapasien/kabupatenpx", [], "get");
    $data    = "";
    foreach ($Request->list as $key => $value) {
      $data .= "<option value=''>" . $value->k1 . "</option>";
    }
    return $data;
  }

  function NomorAntri()
  {
    $Request = GetResponseApi("/tpp_rencanakontrol/noantri", $this->input->post(), "post");
    $data = SetPagination($Request->list, $Request->metadata);
    if (!empty($data['rows'])) {
      $custom_date = []; // exsampel in api_helpoer
      $data["rows"] = FormateDate($data['rows'], "d/m/Y");
    }
    echo json_encode($data);
  }

  private function getSelectKec($type = "")
  {
    $Request = GetResponseApi("/tpp_datapasien/kecamatanpx", [], "get");
    $data    = "";
    foreach ($Request->list as $key => $value) {
      $data .= "<option value='$value->k1'>" . $value->k1 . "</option>";
    }
    return $data;
  }
}
