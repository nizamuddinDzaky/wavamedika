import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataFaktorEksposi from "../../pojo/master/faktor_eksposi/data_faktor_eksposi";

const slug = '/rad/master';

const datafaktoreksposi = async (data: any, page: number): Promise<listDataFaktorEksposi> => {
    const resp = await request.post(`${slug}/faktor-eksposi?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataFaktorEksposi, resp);
};

const tambahfaktoreksposi = async (data: any): Promise<listDataFaktorEksposi> => {
    const resp = await request.post(`${slug}/faktor-eksposi/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataFaktorEksposi, resp);
};

const ubahfaktoreksposi = async (data: any): Promise<listDataFaktorEksposi> => {
    const resp = await request.post(`${slug}/faktor-eksposi/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataFaktorEksposi, resp);
};

const hapusfaktoreksposi = async (data: any): Promise<listDataFaktorEksposi> => {
    const resp = await request.post(`${slug}/faktor-eksposi/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataFaktorEksposi, resp);
};

export default {
    datafaktoreksposi,
    tambahfaktoreksposi,
    ubahfaktoreksposi,
    hapusfaktoreksposi
}
