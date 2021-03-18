<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mrs_aktif extends CI_Controller {

 function index() {
  $data = [
    'title'     => 'MRS Aktif',
    'urlData'   => site_url() . 'tpp/laporan/mrs_aktif/',
    'main_view' => 'laporan/v_mrs_aktif',
    'js'        => 'laporan/js_mrs_aktif',
    'data1'     => '',
    'data2'     => '',
  ];
  $this->load->view('template_tpp', $data);
 }

 function ListMrsAktif() {
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
  $Request = GetResponseApi("/tpp_mrsaktif/datamrsaktif", $this->req, "post");
  $data    = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = [];
   $data["rows"] = FormateDate($data['rows'], "d/m/Y H:i");
  }
  echo json_encode($data);
 }

 function MrsPrivasiView() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_privasipasien/view_dataprivasi", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  echo json_encode($data);
 }

 function MrsPrivasiInsert() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_privasipasien/insert", $this->req, "post");
  echo json_encode($Request);
 }

 function MreStatKamar() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_statuskamar/update", $this->req, "post");
  echo json_encode($Request);
 }

 function InfoPasien() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_indekspasien/view_datapasien_indeks", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

 function DataPesanKamar() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_pesankamar/view_datapasien_pesankamar", $this->req, "post");
  $data      = SetPagination($Request->list, $Request->metadata);
  if (!empty($data['rows'])) {
   $custom_date  = []; // exsampel in api_helpoer
   $data["rows"] = FormateDate($data['rows'], "d/m/Y");
  }
  echo json_encode($data);
 }

 function PesanKamar() {
  $this->req = $this->input->post();
  $Request   = GetResponseApi("/tpp_pesankamar/insert", $this->req, "post");
  echo json_encode($Request);
 }

 function print_sticker_form() {
  $data         = [
    'title' => 'Stiker',
  ];
  $data['data'] = "";
  $Request      = GetResponseApi("/tpp_datapasien/view_datapasien_stiker", $this->input->get(), "post");
  // echo json_encode($Request);
  // return 0 ;
  if ($Request->metadata->err_code != "0") {
   $error = empty($Request->metadata->message) ? "Terjadi Kesalahan Ketika Load Data" : $Request->metadata->message;
   echo "<script> alert(" . $error . ");
      window.close() ;
      </script>";
   return;
  } else {
   $Request      = $Request->list[0];
   $data['data'] = "<table cellspacing=10 width='80%'>";
   for ($a = 0; $a < 10; $a++) {
    $data['data'] .= "<tr>";
    for ($i = 0; $i < 3; $i++) {
     $data["data"] .= "<td width='30%'>
            <table  style='width:100% ; font-size:14px!important ; text-transform:uppercase' >
              <tr>
                <td style='text-transform:uppercase'>
                  " . $Request->no_mr . "<br>
                  " . $Request->nama_lengkap . "<br><br>
                  " . date("d/m/Y", strtotime($Request->tgl_lahir)) . "
                </td>
              </tr>
            </table>
            </td>
          ";
    }
    $data['data'] .= "</tr>";
   }
   $data['data'] .= "</table>";
  }
  $this->load->view("print_laporan", $data);
 }

 function print_sticker_gelang() {
  $data         = [
    'title' => 'Stiker',
  ];
  $data['data'] = "";
  $Request      = GetResponseApi("/tpp_datapasien/view_datapasien_stiker", $this->input->get(), "post");
  // echo json_encode($Request);
  // return 0 ;
  if ($Request->metadata->err_code != "0") {
   $error = empty($Request->metadata->message) ? "Terjadi Kesalahan Ketika Load Data" : $Request->metadata->message;
   echo "<script> alert(" . $error . ");
      window.close() ;
      </script>";
   return;
  } else {
   $Request      = $Request->list[0];
   $data["data"] = "
        <table border=0>
          <tr>
            <td>
                 " . $Request->no_mr . "<br>
                " . $Request->nama_lengkap . "<br>
                  " . date("d/m/Y", strtotime($Request->tgl_lahir)) . "
             </td>
          </tr>
        </table>

      ";
  }
  $this->load->view("print_laporan", $data);
 }

 function print_sticker_cover() {
  $data         = [
    'title' => 'Stiker',
  ];
  $data['data'] = "";
  $Request      = GetResponseApi("/tpp_datapasien/view_datapasien_stiker", $this->input->get(), "post");
  // echo json_encode($Request);
  // return 0 ;
  if ($Request->metadata->err_code != "0") {
   $error = empty($Request->metadata->message) ? "Terjadi Kesalahan Ketika Load Data" : $Request->metadata->message;
   echo "<script> alert(" . $error . ");
      window.close() ;
      </script>";
   return;
  } else {
   $Request      = $Request->list[0];
   $data["data"] = "
        <table border=0>
          <tr>
            <td>
                 " . $Request->no_mr . " &nbsp; &nbsp; &nbsp; <sup>" . date("d/m/Y", strtotime($Request->tgl_lahir)) . "</sup><br>
                " . $Request->nama_lengkap . "<br>

             </td>
          </tr>
        </table>

      ";
  }
  $this->load->view("print_laporan", $data);
 }

}
