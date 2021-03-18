import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataKondisiSample from "../../pojo/master/kondisi_sample/data_kondisi_sample";

const slug = '/lab/master';

const datakondisisample = async (data: any, page: number): Promise<listDataKondisiSample> => {
    const resp = await request.post(`${slug}/kondisi-sampel?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataKondisiSample, resp);
};

const tambahkondisisample = async (data: any): Promise<listDataKondisiSample> => {
    const resp = await request.post(`${slug}/kondisi-sampel/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataKondisiSample, resp);
};

const ubahkondisisample = async (data: any): Promise<listDataKondisiSample> => {
    const resp = await request.post(`${slug}/kondisi-sampel/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataKondisiSample, resp);
};

const hapuskondisisample = async (data: any): Promise<listDataKondisiSample> => {
    const resp = await request.post(`${slug}/kondisi-sampel/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataKondisiSample, resp);
};

export default {
    datakondisisample,
    tambahkondisisample,
    ubahkondisisample,
    hapuskondisisample
}
