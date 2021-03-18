<?php

function kirimApi($row) {
  $CI = &get_instance();
  return $CI->output
                  ->set_status_header(200)
                  ->set_content_type('application/json')
                  ->set_output(
                          json_encode(
                                  [
                                      'total' => count($row),
                                      'rows' => $row
                                  ]
                          )
  );
}

function getSelectDokter() {
  $Request = GetResponseApi("/tpp_nomorkosong/dokter", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->id_karyawan . "'>" . $value->nama . "</option>";
  }

  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Dokter:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="id_dokter"
               class="form-control form-control-sm"
               id="select2_1">
               <option value="_">Pilih Dokter</option>
        ' . $data . '
       </select>
      </div>
   ';
}

function getSelectTglAwal() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Awal:</label>
    <div class="col-lg-2 col-sm-12">
        <input class="form-control form-control-sm" name="tgl1" data-format="dd/mm/yyyy" type="date-formatted" id="start-date-input">
    </div>
   ';
}

function getSelectTglAkhir() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">Tgl Akhir:</label>
    <div class="col-lg-2 col-sm-12">
        <input class="form-control form-control-sm" name="tgl2" data-format="dd/mm/yyyy" type="date-formatted" id="stop-date-input">
    </div>

   ';
}

function getSelectRuangan() {
  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Ruangan:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="ruangan"
               class="form-control form-control-sm" id="select_ruangan">
        <option value="*">Semua</option>
        <option value="1">Ruang A</option>
        <option value="1">Ruang B</option>
        <option value="1">Ruang C</option>
        <option value="1">Ruang D</option>
       </select>
      </div>
   ';
}

function getSelectUnit() {
  $Request = GetResponseApi("/tpp_mrs/unit", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->id_unit . "'>" . $value->nama_unit . "</option>";
  }

  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Unit:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="unit"
               class="form-control form-control-sm" id="select_unit">
        ' . $data . '
       </select>
      </div>
  ';
}

function getSelectUnitMrsAktif() {
  $Request = GetResponseApi("/tpp_mrsaktif/unit", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->nama_unit . "'>" . $value->nama_unit . "</option>";
  }

  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Unit:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="unit"
               class="form-control form-control-sm" id="select_unit">
               <option value="_">Semua Unit</option>
        ' . $data . '
       </select>
      </div>
  ';
}

function getSelectJenisKamar() {
  $Request = GetResponseApi("/tpp_kamarkosong/unit", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->u . "'>" . $value->nama_unit . "</option>";
  }
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Unit:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="unit"
               class="form-control form-control-sm" id="select_unit">
        ' . $data . '
       </select>
      </div>
  ';
}

function getSelectKelas() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Unit:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="unit"
               class="form-control form-control-sm" id="select_unit">
        <option value="*">Semua</option>
        <option value="1">I</option>
        <option value="2">IB</option>
        <option value="3">II</option>
        <option value="4">III</option>
        <option value="5">VIP-B</option>
        <option value="6">VIP-C</option>
        <option value="7">VVIP</option>
       </select>
      </div>
  ';
}

function getSelectKunjungan() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Kunjungan:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="kunjungan"
               class="form-control form-control-sm" id="select_kunjungan">
        <option value="*">Semua</option>
        <option value="1">Baru</option>
        <option value="2">Lama</option>
       </select>
      </div>
  ';
}

function getSelectCaraMasuk() {

  $Request = GetResponseApi("/tpp_lapregperina/caramasuk", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->cm . "'>" . $value->cm . "</option>";
  }
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Cara Masuk:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="cara_masuk"
               class="form-control form-control-sm" id="select_caramasuk">
        <option value="_">Semua</option>
        ' . $data . '
       </select>
      </div>
  ';
}

function getSelectShift() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Shift:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="shift"
               class="form-control form-control-sm" id="select_shift">
        <option value="*">Semua</option>
        <option value="1">Pagi</option>
        <option value="2">Siang</option>
        <option value="3">Sore</option>
       </select>
      </div>
  ';
}

function getSelectStatus() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Status:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="status"
               class="form-control form-control-sm" id="select_shift">
        <option value="_">Semua</option>
        <option value="V">Lengkap</option>
        <option value="X">Tidak Lengkap</option>
        </select>
      </div>
  ';
}

function getSelectProv() {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_mr/propinsipx", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value='" . $value->propinsi . "' >" . $value->propinsi . "</option>";
  }

  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Propinsi:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="propinsi" style="width: 150px;"
               class="form-control form-control-sm dropdown-propinsi easyui-combobox"
               id="select_prop">
               <option value="">Pilih Propinsi</option>
        ' . $data . '
       </select>
      </div>
  ';
}

function getSelectProv_salah() {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_mr/propinsipx", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value='" . $value->propinsi . "' >" . $value->propinsi . "</option>";
  }

  return '
  <div class="form-group row">
     <label for="propinsi" class="col-4 col-form-label">Propinsi</label>
       <div class="col-8">
         <select name="propinsi" class="form-control form-control-sm dropdown-propinsi" id="select_prop">
         <option value="">-- Pilih Propinsi</option>
         ' . $data . '
      </select>
    </div>
  </div>
  ';
}

function getSelectKotaKab_bak($type = "") {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_datapasien/kabupatenpx", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option>" . $value->k1 . "</option>";
  }
  if (!empty($type)) {
    return ' <select name="kecamatan"
               class="form-control form-control-sm"
               id="select_kec">
        ' . $data . '
       </select>';
  }

  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Kabupaten:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="kab"
               class="form-control form-control-sm" id="select_kab">
         ' . $data . '
        </select>
      </div>
  ';
}

function getSelectKotaKab($type = "") {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_datapasien/kabupatenpx", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option>" . $value->k1 . "</option>";
  }
  if (!empty($type)) {
    return ' <select name="kecamatan"
               class="form-control form-control-sm"
               id="select_kab">
        ' . $data . '
       </select>';
  }

  return '
  <div class="form-group row">
   <label for="kotakab" class="col-4 col-form-label">Kabupaten</label>
     <div class="col-8">
      <select name="kab" class="form-control form-control-sm" id="select_kab">
       <option value="">-- Pilih Kabupaten</option>
       ' . $data . '
      </select>
     </div>
    </div>
  ';
}

function getSelectKec_bak($type = "") {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_datapasien/kecamatanpx", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value='" . $value->k1 . "'>" . $value->k1 . "</option>";
  }

  if (!empty($type)) {
    return ' <select name="kecamatan"
               class="form-control form-control-sm"
               id="select_kec">
        ' . $data . '
       </select>';
  }

  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Kecamatan:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="kec"
               class="form-control form-control-sm"
               id="select_kec">
        ' . $data . '
       </select>
      </div>
  ';
}

function getSelectKec($type = "") {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_datapasien/kecamatanpx", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value='" . $value->k1 . "'>" . $value->k1 . "</option>";
  }

  if (!empty($type)) {
    return ' <select name="kecamatan"
               class="form-control form-control-sm"
               id="select_kec">
        ' . $data . '
       </select>';
  }

  return '
  <div class="form-group row">
   <label for="kotakab" class="col-4 col-form-label">Kecamatan</label>
     <div class="col-8">
      <select name="kec" class="form-control form-control-sm" id="select_kec">
       <option value="">-- Pilih Kabupaten</option>
       ' . $data . '
      </select>
     </div>
    </div>
  ';
}

function getJnsPasien_bak($type = "") {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_datapasien/jnspasien", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value='" . $value->id_jnspasien . "'>" . $value->jenis_pasien . "</option>";
  }

  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Jenis:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="id_jnspasien"
               class="form-control form-control-sm"
               id="jns_pasien">
               <option value="">Pilih Jenis</option>
        ' . $data . '
       </select>
      </div>
  ';
}

function getJnsPasien($type = "") {
  $CI = &get_instance();
  $Request = GetResponseApi("/tpp_datapasien/jnspasien", [], "get");
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value='" . $value->id_jnspasien . "'>" . $value->jenis_pasien . "</option>";
  }

  return $data;
}

function getSelectDesa() {
  return '
  <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Desa:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="desa"
               class="form-control form-control-sm" id="select_desa">
        <option value="1">Klayatan</option>
        <option value="2">Pakisaji</option>
        <option value="3">Janti</option>
        <option value="4">Dieng</option>
        <option value="5">Blimbing</option>
        <option value="6">Wagir</option>
        </select>
      </div>
  ';
}

function getBtn($class, $id, $text, $icon = '', $col = '1') {
  return '
   <div class="col-lg-' . $col . ' col-sm-12 kt-margin-t-20-mobile">
       <button
        type="button"
        id="' . $id . '"
        class="form-control form-control-sm btn btn-sm btn-' . $class . '">
        <i class="la la-' . $icon . '"></i>
        ' . $text . '
       </button>
      </div>
   ';
}

function getOptionList($val) {
  switch ($val) {
    case "title":
      $val = '
        <option value="Tn.">Tn.</option>
        <option value="Ny.">Ny.</option>
        <option value="Sdra.">Sdra.</option>
        <option value="Sdri.">Sdri.</option>
        <option value="An.">An.</option>
        <option value="By.">By.</option>
        <option value="By.Ny">By.Ny.</option>
        ';
      break;
    case "gelar":
      $val = '
        <option value="Amd.">Amd.</option>
        <option value="dr.">dr.</option>
        <option value="Dra.">Dra.</option>
        <option value="Drs.">Drs.</option>
        <option value="H.">H.</option>
        <option value="Hj.">Hj.</option>
       ';
      break;
    case "darah":
      $val = '
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="AB">AB</option>
        <option value="O">O</option>
       ';
      break;
    case "kelas":
      $val = '
        <option value="VVIP">VVIP</option>
        <option value="VVIB">VIPB</option>
        <option value="VVIC">VVIC</option>
        <option value="I">I</option>
        <option value="II">II</option>
        <option value="III">III</option>
       ';
      break;
    case "jeniskelamin":
      $val = '
        <option value="L">Laki-Laki</option>
        <option value="P">Perempuan</option>
       ';
      break;
    case "identitas":
      $val = '
        <option value="KTP">KTP</option>
        <option value="SIM">SIM</option>
       ';
      break;
  }
  return $val;
}

function getSelectDokterAntri() {
  $Request = GetResponseApi("/tpp_antridokter/dokter", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->nl . "'>" . $value->nama . "</option>";
  }

  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Dokter:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="dokter"
               class="form-control form-control-sm"
               id="select2_1">
               <option value="">Pilih Dokter</option>
        ' . $data . '
       </select>
      </div>
   ';
}

function getSelectDokterPoli() {
  $Request = GetResponseApi("/tpp_lapregantripoli/dokter", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->nl . "'>" . $value->nama_lengkap . "</option>";
  }

  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Dokter:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="dokter"
               class="form-control form-control-sm"
               id="select2_1">
         ' . $data . '
       </select>
      </div>
   ';
}

function getSelectPoliteknikRuang() {
  $Request = GetResponseApi("/tpp_lapregantripoli/ruang", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->km . "'>" . $value->nama_kamar . "</option>";
  }

  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Ruang:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="ruang"
               class="form-control form-control-sm"
               id="select2_1">
               <option value="101">101</option>
        ' . $data . '
       </select>
      </div>
   ';
}

function getSelectJenisAntriKamar() {
  $Request = GetResponseApi("/tpp_lapregpesankamar/jenis", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->km . "'>" . $value->j . "</option>";
  }

  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Jenis:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="jenis"
               class="form-control form-control-sm"
               id="select2_1">
         ' . $data . '
       </select>
      </div>
   ';
}

function getSelectKelasAntriKamar() {
  $Request = GetResponseApi("/tpp_lapregpesankamar/kelas", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->nl . "'>" . $value->n . "</option>";
  }

  return '
   <label class="col-form-label col-lg-1 col-sm-12 form-control-sm">
       Kelas:
      </label>
      <div class="col-lg-2 col-sm-12">
       <select name="kelas"
               class="form-control form-control-sm"
               id="select2_1">
         ' . $data . '
       </select>
      </div>
   ';
}

function SetPagination_Old($row, $meta_data) {
  $total = 0;
  if ($meta_data->list_count != '0') {
    if (empty($meta_data->row_count)) {
      $total = count($row);
    } else
      $total = $meta_data->row_count;
  }
  return ["rows" => $row, "total" => $total, "metadata" => $meta_data];
}

function SetPagination($row, $meta_data) {
  $total = 0;
  if (!empty($meta_data->list_count)) {
    if (empty($meta_data->row_count)) {
      $total = count($row);
    } else
      $total = $meta_data->row_count;
  }
  return ["rows" => $row, "total" => $total, "metadata" => $meta_data];
}

function FormateDate($data, $format = "d/m/Y", $custom = []) {
  // example $custom = [
  // 	"key" => $format ,
  // 	"tgl_lahir" => "d-m-y" ,
  // ];
  foreach ($data as $index => $value) {
    foreach ($value as $key => $val) {
      if (preg_match("/(tgl)/", $key) && !empty($val)) {
        $data[$index]->$key = date($format, strtotime($val));
      }
      if (!empty($custom) && array_key_exists($key, $custom)) {
        $data[$index]->$key = date($custom[$key], strtotime($val));
      }
    }
  }
  return $data;
}

function getSelectKlinik() {
  $Request = GetResponseApi("/tpp_rencanakontrol/poli", [], "get");
  // array_unshift($Request->list, ["id_karyawan" => "", "nama" => "Pilih Dokter", "selected" => true]);
  $data = "";
  foreach ($Request->list as $key => $value) {
    $data .= "<option value ='" . $value->id_kamar . "'>" . $value->kamar . "</option>";
  }

  return $data;
}

function getHeaderToken()
{
  $secretKey = "";
  if (isset($_SESSION['token']))
  {
    $secretKey =  $_SESSION['token'];
  }
  // append the header putting the secret key and hash
  $headers=array();
  $headers[]  = 'Content-Type: application/json';
  $headers[]  = HEADER_HOST_DEV;
  $headers[]  = 'Authorization: Bearer ' . $secretKey;
  return $headers;
}

function navBarFromAPI($module_id)
{
  // print_r($module_id);die;
  $url = BASE_URL_API.'access/users/'.$module_id.'/menus';
  $headers     = getHeaderToken();
  /*print_r($headers);die;*/
  $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    /*curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($param));*/
    $buffer = curl_exec($ch);
    // print_r($url);die;
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }
    curl_close($ch);

    if (isset($error_msg)) {
        // var_dump(1);
        var_dump($error_msg);
        exit();
    }

    $result=json_decode($buffer,true);
    return $result['menus'];
}

function getNavBar($dataNavbar)
{
  $navbar = '';
  foreach ($dataNavbar as $key => $nav) {
     $navbar .= '<li class="kt-menu__item kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
            <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
              <span class="kt-menu__link-text">'.$nav['title'].'</span>
              <i class="kt-menu__ver-arrow la la-angle-right"></i>
            </a>';
      if (isset($nav['submenu'])) {
        $navbar .= generateSubMenu($nav['submenu'], 0);
      }
    $navbar.='</li>';
  }
  return $navbar;
}

function generateSubMenu($submenu, $flag)
{
  if ($flag == 0) {
    $align = 'left';
  }else{
    $align = 'right';
  }
  $str = '<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--'.$align.'">
            <ul class="kt-menu__subnav">';
  foreach ($submenu as $key => $sm) {
    if ($sm['page'] != '') {
      $page = base_url($sm['page']);
    }else{
      $page = 'javascript:;';
    }

    if (isset($sm['submenu'])) {
      $togle = 'data-ktmenu-submenu-toggle="hover"';
      $classLink = 'kt-menu__toggle';
    }else{
      $classLink = '';
      $togle = '';
    }

    $str .= '<li class="kt-menu__item  kt-menu__item--submenu" '.$togle.' aria-haspopup="true">
            <a href="'.$page.'" class="kt-menu__link '.$classLink.'">
              <i class="kt-menu__link-bullet kt-menu__link-bullet--'.$sm['bullet'].'">
                <span></span>
              </i>
            <span class="kt-menu__link-text">'.$sm['title'].'</span>';
    if (isset($sm['submenu'])) {
      $str .= '<i class="kt-menu__hor-arrow la la-angle-right"></i>';
    }
    $str .= '</a>';

    if (isset($sm['submenu'])) {
      $str .= generateSubMenu($sm['submenu'], 1);
    }

    $str.='</li>';
  }
  $str .= '</ul>
            </div>';
  return $str;
}

function checkAccess($arrMenu, $hasAccess, $module, $currentModule)
{
  // echo $this->router->fetch_module();die;
  foreach ($module as $key => $mod) {
    if (strpos($mod->url, $currentModule) !== false) {
      $hasAccess = true;
    }
  }
  if ($hasAccess) {
    return chekAksesSubMenu($arrMenu, $hasAccess);
  }else{
    return $hasAccess;
  }
  // print_r($module);die;
}

function chekAksesSubMenu($arrMenu, $hasAccess)
{
  foreach ($arrMenu as $key => $menu) {
    if (isset($menu['page'])) {
      if ($menu['page'] == substr(current_url(), strlen(base_url()))) {
        $hasAccess = true;
      }
    }
    if (isset($menu['submenu'])) {
      $hasAccess = chekAksesSubMenu($menu['submenu'], $hasAccess);
    }
  }
  return $hasAccess;
}

function getModule()
{
  $url = BASE_URL_MODULE;
  $headers=getHeaderToken();
      
  // print_r($headers);die;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  /*curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($param));*/
  $buffer = curl_exec($ch);

  if (curl_errno($ch)) {
      $error_msg = curl_error($ch);
  }
  curl_close($ch);

  if (isset($error_msg)) {
      // var_dump(1);
      var_dump($error_msg);
      exit();
  }

  $result=json_decode($buffer,true);
  /*print_r($result['rows']);die;*/
  $mod = array();
  foreach ($result['rows'] as $key => $value) {
    $mod[] = array(
      'modul' => $value['module_code'], 
      'desc' => $value['module_desc'], 
      'url' => $value['page'], 
      'module_id' => $value['module_id'], 
    );
  }
  return $mod;
}

function getHeader()
{
  // append the header putting the secret key and hash
  $headers=array();
  $headers[]  = 'Content-Type: application/json';
  $headers[]  = HEADER_HOST_DEV;
  return $headers;
}

function sendRequest($method, $module, $path, $data, $type=false) {
  $headers=array();
  $headers[]  = "Content-Type: application/json";
  $headers[]  = "Host: dev.api.mersi-hospital";

  if (isset($_SESSION['token'])) {
    $token =  $_SESSION['token'];
    $headers[]  = 'Authorization: Bearer ' . $token;
  }

  $curl_handle = curl_init();
  curl_setopt($curl_handle, CURLOPT_URL, BASE_URL_API.$module.'/'.$path);
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl_handle, CURLOPT_POST, TRUE);
  curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $method);
  curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl_handle, CURLOPT_POSTFIELDS,json_encode($data));
  $response = curl_exec($curl_handle);
  
  if (curl_errno($curl_handle)) {
      $error_msg = curl_error($curl_handle);
  }
  curl_close($curl_handle);

  if (isset($error_msg)) {
      var_dump(1);
      exit();
  }
  $result=json_decode($response,$type);
  
  return $result;

}