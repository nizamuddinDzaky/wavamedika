import request from './api.service';
import { plainToClass } from 'class-transformer';
import tpp_nomorkosong_datanomorkosong_pojo from '../pojo/antrian_nomor_kosong/tpp_nomorkosong-datanomorkosong';
import tpp_nomorkosong_delete_pojo from '../pojo/antrian_nomor_kosong/tpp_nomorkosong-delete';
import tpp_nomorkosong_dokter_pojo from '../pojo/antrian_nomor_kosong/tpp_nomorkosong-dokter';
import tpp_nomorkosong_insert_pojo from '../pojo/antrian_nomor_kosong/tpp_nomorkosong-insert';
import tpp_nomorkosong_update_pojo from '../pojo/antrian_nomor_kosong/tpp_nomorkosong-update';

const tpp_nomorkosong_datanomorkosong = async (): Promise<tpp_nomorkosong_datanomorkosong_pojo> => {
    const resp = await request.get('/tpp_nomorkosong/datanomorkosong');
    return plainToClass(tpp_nomorkosong_datanomorkosong_pojo, resp);
}
const tpp_nomorkosong_delete = async (data: any): Promise<tpp_nomorkosong_delete_pojo> => {
    const resp = await request.post('/tpp_nomorkosong/delete', data);
    return plainToClass(tpp_nomorkosong_delete_pojo, resp);
}
const tpp_nomorkosong_dokter = async (): Promise<tpp_nomorkosong_dokter_pojo> => {
    const resp = await request.get('/tpp_nomorkosong/dokter');
    return plainToClass(tpp_nomorkosong_dokter_pojo, resp);
}
const tpp_nomorkosong_insert = async (data: any): Promise<tpp_nomorkosong_insert_pojo> => {
    const resp = await request.post('/tpp_nomorkosong/insert', data);
    return plainToClass(tpp_nomorkosong_insert_pojo, resp);
}
const tpp_nomorkosong_update = async (data: any): Promise<tpp_nomorkosong_update_pojo> => {
    const resp = await request.post('/tpp_nomorkosong/update', data);
    return plainToClass(tpp_nomorkosong_update_pojo, resp);
}

export default {
    tpp_nomorkosong_datanomorkosong,
    tpp_nomorkosong_delete,
    tpp_nomorkosong_dokter,
    tpp_nomorkosong_insert,
    tpp_nomorkosong_update
}