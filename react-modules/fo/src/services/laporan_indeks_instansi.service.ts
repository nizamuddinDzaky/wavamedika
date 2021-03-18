import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_indeksinstansi_instansi_pojo from '../pojo/laporan_indeks_instansi/mkt_indeksinstansi-instansi';
import mkt_indeksinstansi_unit_pojo from '../pojo/laporan_indeks_instansi/mkt_indeksinstansi-unit';
import mkt_indeksinstansi_view_indeksinstansi_pojo from '../pojo/laporan_indeks_instansi/mkt_indeksinstansi-view_indeksinstansi';
import mkt_indeksinstansi_view_indeksinstansi_rekap_pojo from '../pojo/laporan_indeks_instansi/mkt_indeksinstansi-view_indeksinstansi_rekap';

const mkt_indeksinstansi_instansi = async (): Promise<mkt_indeksinstansi_instansi_pojo> => {
    const resp = await request.get('/mkt_indeksinstansi/instansi');
    return plainToClass(mkt_indeksinstansi_instansi_pojo, resp);
}
const mkt_indeksinstansi_unit = async (): Promise<mkt_indeksinstansi_unit_pojo> => {
    const resp = await request.get('/mkt_indeksinstansi/unit');
    return plainToClass(mkt_indeksinstansi_unit_pojo, resp);
}
const mkt_indeksinstansi_view_indeksinstansi = async (data: any): Promise<mkt_indeksinstansi_view_indeksinstansi_pojo> => {
    const resp = await request.post('/mkt_indeksinstansi/view_indeksinstansi', data);
    return plainToClass(mkt_indeksinstansi_view_indeksinstansi_pojo, resp);
}
const mkt_indeksinstansi_view_indeksinstansi_rekap = async (data: any): Promise<mkt_indeksinstansi_view_indeksinstansi_rekap_pojo> => {
    const resp = await request.post('/mkt_indeksinstansi/view_indeksinstansi_rekap', data);
    return plainToClass(mkt_indeksinstansi_view_indeksinstansi_rekap_pojo, resp);
}

export default {
    mkt_indeksinstansi_instansi,
    mkt_indeksinstansi_unit,
    mkt_indeksinstansi_view_indeksinstansi,
    mkt_indeksinstansi_view_indeksinstansi_rekap
}