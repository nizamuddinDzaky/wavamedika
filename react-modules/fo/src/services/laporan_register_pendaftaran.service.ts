import request from './api.service';
import { plainToClass } from 'class-transformer';
import tpp_indeksmrs_caramasuk_pojo from '../pojo/laporan_register_pendaftaran/tpp_indeksmrs-caramasuk';
import tpp_indeksmrs_unit_pojo from '../pojo/laporan_register_pendaftaran/tpp_indeksmrs-unit';
import tpp_indeksmrs_view_indeksmrs_pojo from '../pojo/laporan_register_pendaftaran/tpp_indeksmrs-view_indeksmrs';
import tpp_indeksmrs_view_indeksmrs_rekap_pojo from '../pojo/laporan_register_pendaftaran/tpp_indeksmrs-view_indeksmrs_rekap';
import tpp_indekspasien_view_datapasien_indeks_pojo from '../pojo/laporan_register_pendaftaran/tpp_indekspasien-view_datapasien_indeks';

const tpp_indeksmrs_caramasuk = async (): Promise<tpp_indeksmrs_caramasuk_pojo> => {
    const resp = await request.get('/tpp_indeksmrs/caramasuk');
    return plainToClass(tpp_indeksmrs_caramasuk_pojo, resp);
}
const tpp_indeksmrs_unit = async (): Promise<tpp_indeksmrs_unit_pojo> => {
    const resp = await request.get('/tpp_indeksmrs/unit');
    return plainToClass(tpp_indeksmrs_unit_pojo, resp);
}
const tpp_indeksmrs_view_indeksmrs = async (data: any): Promise<tpp_indeksmrs_view_indeksmrs_pojo> => {
    const resp = await request.post('/tpp_indeksmrs/view_indeksmrs', data);
    return plainToClass(tpp_indeksmrs_view_indeksmrs_pojo, resp);
}
const tpp_indeksmrs_view_indeksmrs_rekap = async (data: any): Promise<tpp_indeksmrs_view_indeksmrs_rekap_pojo> => {
    const resp = await request.post('/tpp_indeksmrs/view_indeksmrs_rekap', data);
    return plainToClass(tpp_indeksmrs_view_indeksmrs_rekap_pojo, resp);
}
const tpp_indekspasien_view_datapasien_indeks = async (data: any): Promise<tpp_indekspasien_view_datapasien_indeks_pojo> => {
    const resp = await request.post('/tpp_indekspasien/view_datapasien_indeks', data);
    return plainToClass(tpp_indekspasien_view_datapasien_indeks_pojo, resp);
}

export default {
    tpp_indeksmrs_caramasuk,
    tpp_indeksmrs_unit,
    tpp_indeksmrs_view_indeksmrs,
    tpp_indeksmrs_view_indeksmrs_rekap,
    tpp_indekspasien_view_datapasien_indeks
}