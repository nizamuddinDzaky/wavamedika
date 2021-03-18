import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_lapregpesanankontrol_dokter_pojo from '../pojo/antrian_register_pesanan_kontrol/mkt_lapregpesanankontrol-dokter';
import mkt_lapregpesanankontrol_ruang_pojo from '../pojo/antrian_register_pesanan_kontrol/mkt_lapregpesanankontrol-ruang';
import mkt_lapregpesanankontrol_view_lapregpesanankontrol_pojo from '../pojo/antrian_register_pesanan_kontrol/mkt_lapregpesanankontrol-view_lapregpesanankontrol';
import mkt_sms_update_pojo from '../pojo/antrian_register_pesanan_kontrol/mkt_sms-update';
import mkt_sms_view_sms_pojo from '../pojo/antrian_register_pesanan_kontrol/mkt_sms-view_sms';

const mkt_lapregpesanankontrol_dokter = async (): Promise<mkt_lapregpesanankontrol_dokter_pojo> => {
    const resp = await request.get('/mkt_lapregpesanankontrol/dokter');
    return plainToClass(mkt_lapregpesanankontrol_dokter_pojo, resp);
}
const mkt_lapregpesanankontrol_ruang = async (): Promise<mkt_lapregpesanankontrol_ruang_pojo> => {
    const resp = await request.get('/mkt_lapregpesanankontrol/ruang');
    return plainToClass(mkt_lapregpesanankontrol_ruang_pojo, resp);
}
const mkt_lapregpesanankontrol_view_lapregpesanankontrol = async (data: any): Promise<mkt_lapregpesanankontrol_view_lapregpesanankontrol_pojo> => {
    const resp = await request.post('/mkt_lapregpesanankontrol/view_lapregpesanankontrol', data);
    return plainToClass(mkt_lapregpesanankontrol_view_lapregpesanankontrol_pojo, resp);
}
const mkt_sms_update = async (data: any): Promise<mkt_sms_update_pojo> => {
    const resp = await request.post('/mkt_sms/update', data);
    return plainToClass(mkt_sms_update_pojo, resp);
}
const mkt_sms_view_sms = async (data: any): Promise<mkt_sms_view_sms_pojo> => {
    const resp = await request.post('/mkt_sms/view_sms', data);
    return plainToClass(mkt_sms_view_sms_pojo, resp);
}

export default {
    mkt_lapregpesanankontrol_dokter,
    mkt_lapregpesanankontrol_ruang,
    mkt_lapregpesanankontrol_view_lapregpesanankontrol,
    mkt_sms_update,
    mkt_sms_view_sms
}