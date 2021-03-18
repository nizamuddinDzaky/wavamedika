import request from '../api.service';
import { plainToClass } from 'class-transformer';
import datapasien_riwayat from "../../pojo/master/data_pasien/data_riwayat_pasien";

const tpp_riwayatpasien_view_datapasien_riwayat = async (data: any) : Promise<datapasien_riwayat> => {
    const resp = await request.post('/tpp_riwayatpasien/view_datapasien_riwayat', data);
    return plainToClass(datapasien_riwayat, resp);
}

const tpp_riwayatpasien_view_riwayatpasien_rekap = async (data: any) : Promise<datapasien_riwayat> => {
    const resp = await request.post('/tpp_riwayatpasien/view_riwayatpasien_rekap', data);
    return plainToClass(datapasien_riwayat, resp);
}

const tpp_riwayatpasien_view_riwayatpasien = async (data: any) : Promise<datapasien_riwayat> => {
    const resp = await request.post('/tpp_riwayatpasien/view_riwayatpasien', data);
    return plainToClass(datapasien_riwayat, resp);
}

const tpp_riwayatpasien_view_riwayatpasien_tindakan = async (data: any) : Promise<datapasien_riwayat> => {
    const resp = await request.post('/tpp_riwayatpasien/view_riwayatpasien_tindakan', data);
    return plainToClass(datapasien_riwayat, resp);
}

export default {
    tpp_riwayatpasien_view_datapasien_riwayat,
    tpp_riwayatpasien_view_riwayatpasien_rekap,
    tpp_riwayatpasien_view_riwayatpasien,
    tpp_riwayatpasien_view_riwayatpasien_tindakan
}