import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataGolonganDarah from "../../pojo/master/golongan_darah/data_golongan_darah";

const slug = '/lab/master';

const datagolongandarah = async (data: any, page: number): Promise<listDataGolonganDarah> => {
    const resp = await request.post(`${slug}/golongan-darah?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataGolonganDarah, resp);
};

const tambahgolongandarah = async (data: any): Promise<listDataGolonganDarah> => {
    const resp = await request.post(`${slug}/golongan-darah/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataGolonganDarah, resp);
};

const ubahgolongandarah = async (data: any): Promise<listDataGolonganDarah> => {
    const resp = await request.post(`${slug}/golongan-darah/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataGolonganDarah, resp);
};

const hapusgolongandarah = async (data: any): Promise<listDataGolonganDarah> => {
    const resp = await request.post(`${slug}/golongan-darah/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataGolonganDarah, resp);
};

export default {
    datagolongandarah,
    tambahgolongandarah,
    ubahgolongandarah,
    hapusgolongandarah
}
