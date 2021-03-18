import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataPaket from "../../pojo/master/jenis_paket/data_paket_lab";
import listDataPemeriksaan from "../../pojo/master/jenis_paket/data_pemeriksaan_lab";

const slug = '/lab/master';

const datadaftarpaket = async (): Promise<listDataPaket> => {
    const resp = await request.get(`${slug}/jenis-paket`);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPaket, resp);
};

const tambahdaftarpaket = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

const ubahdaftarpaket = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

const hapusdaftarpaket = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

const datadaftarpemeriksaan = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket-detail`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

const tambahdaftarpemeriksaan = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket-detail/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

const ubahdaftarpemeriksaan = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket-detail/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

const hapusdaftarpemeriksaan = async (data: any): Promise<listDataPemeriksaan> => {
    const resp = await request.post(`${slug}/jenis-paket-detail/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPemeriksaan, resp);
};

export default {
    datadaftarpaket,
    tambahdaftarpaket,
    ubahdaftarpaket,
    hapusdaftarpaket,
    datadaftarpemeriksaan,
    tambahdaftarpemeriksaan,
    ubahdaftarpemeriksaan,
    hapusdaftarpemeriksaan
}
