import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_lapregantripoli_dokter_pojo from '../pojo/antrian_registrasi_kontrol/mkt_lapregantripoli-dokter';
import mkt_lapregkontrol_view_lapregkontrol_pojo from '../pojo/antrian_registrasi_kontrol/mkt_lapregkontrol-view_lapregkontrol';
import mkt_lapregkontrol_view_lapregkontrol_rekap_pojo from '../pojo/antrian_registrasi_kontrol/mkt_lapregkontrol-view_lapregkontrol_rekap';

const mkt_lapregantripoli_dokter = async (): Promise<mkt_lapregantripoli_dokter_pojo> => {
    const resp = await request.get('/mkt_lapregantripoli/dokter');
    return plainToClass(mkt_lapregantripoli_dokter_pojo, resp);
}
const mkt_lapregkontrol_view_lapregkontrol = async (data: any): Promise<mkt_lapregkontrol_view_lapregkontrol_pojo> => {
    const resp = await request.post('/mkt_lapregkontrol/view_lapregkontrol', data);
    return plainToClass(mkt_lapregkontrol_view_lapregkontrol_pojo, resp);
}
const mkt_lapregkontrol_view_lapregkontrol_rekap = async (data: any): Promise<mkt_lapregkontrol_view_lapregkontrol_rekap_pojo> => {
    const resp = await request.post('/mkt_lapregkontrol/view_lapregkontrol_rekap', data);
    return plainToClass(mkt_lapregkontrol_view_lapregkontrol_rekap_pojo, resp);
}

export default {
    mkt_lapregantripoli_dokter,
    mkt_lapregkontrol_view_lapregkontrol,
    mkt_lapregkontrol_view_lapregkontrol_rekap
}