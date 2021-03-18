import request from './api.service';
import { plainToClass } from 'class-transformer';
import tpp_mrsaktif_datamrsaktif_pojo from '../pojo/laporan_list_pasien_mrs_aktif/tpp_mrsaktif-datamrsaktif';
import tpp_mrsaktif_unit_pojo from '../pojo/laporan_list_pasien_mrs_aktif/tpp_mrsaktif-unit';
import tpp_privasipasien_view_dataprivasi_pojo from '../pojo/laporan_list_pasien_mrs_aktif/tpp_privasipasien-view_dataprivasi';

const tpp_mrsaktif_datamrsaktif = async (data: any): Promise<tpp_mrsaktif_datamrsaktif_pojo> => {
    const resp = await request.post('/tpp_mrsaktif/datamrsaktif', data);
    return plainToClass(tpp_mrsaktif_datamrsaktif_pojo, resp);
}
const tpp_mrsaktif_unit = async (): Promise<tpp_mrsaktif_unit_pojo> => {
    const resp = await request.get('/tpp_mrsaktif/unit');
    return plainToClass(tpp_mrsaktif_unit_pojo, resp);
}
const tpp_privasipasien_view_dataprivasi = async (data: any): Promise<tpp_privasipasien_view_dataprivasi_pojo> => {
    const resp = await request.post('/tpp_privasipasien/view_dataprivasi', data);
    return plainToClass(tpp_privasipasien_view_dataprivasi_pojo, resp);
}

export default {
    tpp_mrsaktif_datamrsaktif,
    tpp_mrsaktif_unit,
    tpp_privasipasien_view_dataprivasi
}