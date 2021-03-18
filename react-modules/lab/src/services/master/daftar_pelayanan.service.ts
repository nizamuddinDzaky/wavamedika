import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataDaftarPelayanan from "../../pojo/master/daftar_pelayanan/data_pelayanan";

const slug = '/lab/master';

const datadaftarpelayanan = async (data: any, page: number): Promise<listDataDaftarPelayanan> => {
    const resp = await request.post(`${slug}/metode-lab?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataDaftarPelayanan, resp);
};

const tambahdaftarpelayanan = async (data: any): Promise<listDataDaftarPelayanan> => {
    const resp = await request.post(`${slug}/metode-lab/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataDaftarPelayanan, resp);
};

const ubahdaftarpelayanan = async (data: any): Promise<listDataDaftarPelayanan> => {
    const resp = await request.post(`${slug}/metode-lab/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataDaftarPelayanan, resp);
};

const hapusdaftarpelayanan = async (data: any): Promise<listDataDaftarPelayanan> => {
    const resp = await request.post(`${slug}/metode-lab/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataDaftarPelayanan, resp);
};

export default {
    datadaftarpelayanan,
    tambahdaftarpelayanan,
    ubahdaftarpelayanan,
    hapusdaftarpelayanan
}
