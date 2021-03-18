import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataPenggunaanFilm from "../../pojo/master/penggunaan_film/data_penggunaan_film";

const slug = '/rad/master';

const datapenggunaanfilm = async (data: any, page: number): Promise<listDataPenggunaanFilm> => {
    const resp = await request.post(`${slug}/penggunaan-film?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPenggunaanFilm, resp);
};

const tambahpenggunaanfilm = async (data: any): Promise<listDataPenggunaanFilm> => {
    const resp = await request.post(`${slug}/penggunaan-film/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPenggunaanFilm, resp);
};

const ubahpenggunaanfilm = async (data: any): Promise<listDataPenggunaanFilm> => {
    const resp = await request.post(`${slug}/penggunaan-film/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPenggunaanFilm, resp);
};

const hapuspenggunaanfilm = async (data: any): Promise<listDataPenggunaanFilm> => {
    const resp = await request.post(`${slug}/penggunaan-film/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPenggunaanFilm, resp);
};

export default {
    datapenggunaanfilm,
    tambahpenggunaanfilm,
    ubahpenggunaanfilm,
    hapuspenggunaanfilm
}
