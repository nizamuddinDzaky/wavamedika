<?php

function helper_dd($data)
{
    if ($data == null) {
        echo 'null atau array kosong' ;
    } else {
        echo '<pre>';
        print_r($data);
    }
    die();
}

function convert_to_bulan($date)
{
     $bulan='';
    switch ($date) {
        case 1:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }

    return $bulan;
}

function convert_date_to_indonesia($date)
{
    $tanggal = date('j', strtotime($date));
    $nomor_bulan = date('n', strtotime($date));
    $tahun = date('Y', strtotime($date));

    switch ($nomor_bulan) {
        case 1:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }

    return $tanggal.' '.$bulan.' '.$tahun;
}

function convert_datetime_to_indonesia($date)
{
    $tanggal = date('j', strtotime($date));
    $nomor_bulan = date('n', strtotime($date));
    $tahun = date('Y', strtotime($date));
    $pukul = date('H:i:s', strtotime($date));

    switch ($nomor_bulan) {
        case 1:
            $bulan = 'Januari';
            break;
        case 2:
            $bulan = 'Februari';
            break;
        case 3:
            $bulan = 'Maret';
            break;
        case 4:
            $bulan = 'April';
            break;
        case 5:
            $bulan = 'Mei';
            break;
        case 6:
            $bulan = 'Juni';
            break;
        case 7:
            $bulan = 'Juli';
            break;
        case 8:
            $bulan = 'Agustus';
            break;
        case 9:
            $bulan = 'September';
            break;
        case 10:
            $bulan = 'Oktober';
            break;
        case 11:
            $bulan = 'November';
            break;
        case 12:
            $bulan = 'Desember';
            break;
    }

    return $tanggal.' '.$bulan.' '.$tahun.' '.$pukul.' WIB';
}

function convert_number_to_rupiah($value, $decimal = 3)
{
    if ((float)$value == 0) {
        return '0';
    } elseif ((float)$value < 0) {
        // return '(Rp. '.number_format($value, 2, ',', '.').')';
        return '('.number_format($value*(-1), 0, ',', '.').')';
    } else {
        // return 'Rp. '.number_format($value, 2, ',', '.');
        return number_format($value, $decimal, ',', '.');
    }
}

function tanggal($tanggal){
    return str_replace('-', '/',date("d-m-Y", strtotime($tanggal)))   ;                      
}

function tanggal_time($tanggal){
    return str_replace('-', '/',date("d-m-Y h:i", strtotime($tanggal)))   ;                      
}

function tanggal_time_detail($tanggal){
    return str_replace('-', '/',date("d-m-Y h:i:s", strtotime($tanggal)))   ;                      
}

function angka($value, $decimal = 0)
{

    if ((float)$value == 0) {
        return '0';
    } elseif ((float)$value < 0) {
        // return '(Rp. '.number_format($value, 2, ',', '.').')';
        return '('.number_format($value*(-1), 0, ',', '.').')';
    } else {
        // return 'Rp. '.number_format($value, 2, ',', '.');
        return number_format($value, $decimal, ',', '.');
    }
}

function convert_number_to_rupiah_dua($value, $decimal = 2)
{
    if ((float)$value == 0) {
        return '0';
    } elseif ((float)$value < 0) {
        // return '(Rp. '.number_format($value, 2, ',', '.').')';
        return '('.number_format($value*(-1), 0, ',', '.').')';
    } else {
        // return 'Rp. '.number_format($value, 2, ',', '.');
        return number_format($value, $decimal, ',', '.');
    }
}

function convert_to_date($date)
{
    $d = explode('/', $date);

    return $d[2].'-'.$d[1].'-'.$d[0];
}

function convert_to_indonesia_date($date)
{
    return date('d/m/Y', strtotime($date));
}
function convert_to_indonesia_dateInd($date)
{
    return date('m/d/Y', strtotime($date));
}

function convert_to_indonesia_datetime($date)
{
    return date('d/m/Y H:i', strtotime($date));
}

function cek_email_valid($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
}

function generate_failed_response($failed_response, $data = [])
{
    $response = [
        'code' => $failed_response['code'],
        'message' => $failed_response['message'],
        'data' => $data
    ];

    echo json_encode($response);
    die();
}

function generate_success_response($message, $data = [])
{
    $response = [
        'code' => SUKSES,
        'message' => $message,
        'data' => $data
    ];

    echo json_encode($response);
    die();
}
