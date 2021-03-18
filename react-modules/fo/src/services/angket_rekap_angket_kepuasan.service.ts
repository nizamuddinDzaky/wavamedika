import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_lapangketpelanggan_view_lapangketkepuasan_pojo from '../pojo/angket_rekap_angket_kepuasan/mkt_lapangketpelanggan-view_lapangketkepuasan';

const mkt_lapangketpelanggan_view_lapangketkepuasan = async (): Promise<mkt_lapangketpelanggan_view_lapangketkepuasan_pojo> => {
    const resp = await request.get('/mkt_lapangketpelanggan/view_lapangketkepuasan');
    return plainToClass(mkt_lapangketpelanggan_view_lapangketkepuasan_pojo, resp);
}

export default {
    mkt_lapangketpelanggan_view_lapangketkepuasan
}