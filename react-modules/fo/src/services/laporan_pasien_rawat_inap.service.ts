import request from './api.service';
import { plainToClass } from 'class-transformer';
import tpp_lapmrsri_view_lapmrsri_pojo from '../pojo/laporan_pasien_rawat_inap/tpp_lapmrsri-view_lapmrsri';

const tpp_lapmrsri_view_lapmrsri = async (): Promise<tpp_lapmrsri_view_lapmrsri_pojo> => {
    const resp = await request.get('/tpp_lapmrsri/view_lapmrsri');
    return plainToClass(tpp_lapmrsri_view_lapmrsri_pojo, resp);
}

export default {
    tpp_lapmrsri_view_lapmrsri
}