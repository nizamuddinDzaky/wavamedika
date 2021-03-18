import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listDataReaksiAlergi from "../../pojo/master/reaksi_alergi/data_reaksi_alergi";

const slug = '/lab/master';

const datareaksialergi = async (data: any, page: number): Promise<listDataReaksiAlergi> => {
    const resp = await request.post(`${slug}/reaksi-alergi?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataReaksiAlergi, resp);
};

const tambahreaksialergi = async (data: any): Promise<listDataReaksiAlergi> => {
    const resp = await request.post(`${slug}/reaksi-alergi/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataReaksiAlergi, resp);
};

const ubahreaksialergi = async (data: any): Promise<listDataReaksiAlergi> => {
    const resp = await request.post(`${slug}/reaksi-alergi/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataReaksiAlergi, resp);
};

const hapusreaksialergi = async (data: any): Promise<listDataReaksiAlergi> => {
    const resp = await request.post(`${slug}/reaksi-alergi/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataReaksiAlergi, resp);
};

export default {
    datareaksialergi,
    tambahreaksialergi,
    ubahreaksialergi,
    hapusreaksialergi
}
