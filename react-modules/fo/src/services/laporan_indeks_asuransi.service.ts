import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_indeksasuransi_asuransi_pojo from '../pojo/laporan_indeks_asuransi/mkt_indeksasuransi-asuransi';
import mkt_indeksasuransi_unit_pojo from '../pojo/laporan_indeks_asuransi/mkt_indeksasuransi-unit';
import mkt_indeksasuransi_view_indeksasuransi_pojo from '../pojo/laporan_indeks_asuransi/mkt_indeksasuransi-view_indeksasuransi';
import mkt_indeksasuransi_view_indeksasuransi_rekap_pojo from '../pojo/laporan_indeks_asuransi/mkt_indeksasuransi-view_indeksasuransi_rekap';

const mkt_indeksasuransi_asuransi = async (): Promise<mkt_indeksasuransi_asuransi_pojo> => {
    const resp = await request.get('/mkt_indeksasuransi/asuransi');
    return plainToClass(mkt_indeksasuransi_asuransi_pojo, resp);
}
const mkt_indeksasuransi_unit = async (): Promise<mkt_indeksasuransi_unit_pojo> => {
    const resp = await request.get('/mkt_indeksasuransi/unit');
    return plainToClass(mkt_indeksasuransi_unit_pojo, resp);
}
const mkt_indeksasuransi_view_indeksasuransi = async (data: any): Promise<mkt_indeksasuransi_view_indeksasuransi_pojo> => {
    const resp = await request.post('/mkt_indeksasuransi/view_indeksasuransi', data);
    return plainToClass(mkt_indeksasuransi_view_indeksasuransi_pojo, resp);
}
const mkt_indeksasuransi_view_indeksasuransi_rekap = async (data: any): Promise<mkt_indeksasuransi_view_indeksasuransi_rekap_pojo> => {
    const resp = await request.post('/mkt_indeksasuransi/view_indeksasuransi_rekap', data);
    return plainToClass(mkt_indeksasuransi_view_indeksasuransi_rekap_pojo, resp);
}

export default {
    mkt_indeksasuransi_asuransi,
    mkt_indeksasuransi_unit,
    mkt_indeksasuransi_view_indeksasuransi,
    mkt_indeksasuransi_view_indeksasuransi_rekap
}