import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataPTKP from "../../pojo/master/PTKP/data_PTKP";

const slug = '/pjk/master';

const dataptkp = async (data: any, page: number): Promise<listDataPTKP> => {
    const resp = await request.post(`${slug}/ptkp?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPTKP, resp);
};

const tambahptkp = async (data: any): Promise<listDataPTKP> => {
    const resp = await request.post(`${slug}/ptkp/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPTKP, resp);
};

const ubahptkp = async (data: any): Promise<listDataPTKP> => {
    const resp = await request.post(`${slug}/ptkp/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPTKP, resp);
};

const hapusptkp = async (data: any): Promise<listDataPTKP> => {
    const resp = await request.post(`${slug}/ptkp/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataPTKP, resp);
};

export default {
    dataptkp,
    tambahptkp,
    ubahptkp,
    hapusptkp
}
