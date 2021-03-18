import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataRujukPartial from "../../pojo/master/rs_rujuk_partial/data_rs_rujuk_partial";

const slug = '/lab/master';

const datarujukpartial = async (data: any, page: number): Promise<listDataRujukPartial> => {
    const resp = await request.post(`${slug}/rujuk-partial?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataRujukPartial, resp);
};

const tambahrujukpartial = async (data: any): Promise<listDataRujukPartial> => {
    const resp = await request.post(`${slug}/rujuk-partial/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataRujukPartial, resp);
};

const ubahrujukpartial = async (data: any): Promise<listDataRujukPartial> => {
    const resp = await request.post(`${slug}/rujuk-partial/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataRujukPartial, resp);
};

const hapusrujukpartial = async (data: any): Promise<listDataRujukPartial> => {
    const resp = await request.post(`${slug}/rujuk-partial/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataRujukPartial, resp);
};

export default {
    datarujukpartial,
    tambahrujukpartial,
    ubahrujukpartial,
    hapusrujukpartial
}
