import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_sms_update_pojo from '../pojo/antrian_pesanan_antri_klinik/mkt_sms-update';
import mkt_sms_view_sms_pojo from '../pojo/antrian_pesanan_antri_klinik/mkt_sms-view_sms';
import tpp_lapregantripoli_dokter_pojo from '../pojo/antrian_pesanan_antri_klinik/tpp_lapregantripoli-dokter';
import tpp_lapregantripoli_ruang_pojo from '../pojo/antrian_pesanan_antri_klinik/tpp_lapregantripoli-ruang';
import tpp_lapregantripoli_view_lapregantripoli_pojo from '../pojo/antrian_pesanan_antri_klinik/tpp_lapregantripoli-view_lapregantripoli';

const mkt_sms_update = async (data: any): Promise<mkt_sms_update_pojo> => {
    const resp = await request.post('/mkt_sms/update', data);
    return plainToClass(mkt_sms_update_pojo, resp);
}
const mkt_sms_view_sms = async (data: any): Promise<mkt_sms_view_sms_pojo> => {
    const resp = await request.post('/mkt_sms/view_sms', data);
    return plainToClass(mkt_sms_view_sms_pojo, resp);
}
const tpp_lapregantripoli_dokter = async (): Promise<tpp_lapregantripoli_dokter_pojo> => {
    const resp = await request.get('/tpp_lapregantripoli/dokter');
    return plainToClass(tpp_lapregantripoli_dokter_pojo, resp);
}
const tpp_lapregantripoli_ruang = async (): Promise<tpp_lapregantripoli_ruang_pojo> => {
    const resp = await request.get('/tpp_lapregantripoli/ruang');
    return plainToClass(tpp_lapregantripoli_ruang_pojo, resp);
}
const tpp_lapregantripoli_view_lapregantripoli = async (data: any): Promise<tpp_lapregantripoli_view_lapregantripoli_pojo> => {
    const resp = await request.post('/tpp_lapregantripoli/view_lapregantripoli', data);
    return plainToClass(tpp_lapregantripoli_view_lapregantripoli_pojo, resp);
}

export default {
    mkt_sms_update,
    mkt_sms_view_sms,
    tpp_lapregantripoli_dokter,
    tpp_lapregantripoli_ruang,
    tpp_lapregantripoli_view_lapregantripoli
}