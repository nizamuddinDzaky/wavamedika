import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_laptanggapanpelanggan_kategori_pojo from '../pojo/angket_rekap_tanggapan_pelanggan/mkt_laptanggapanpelanggan-kategori';
import mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_pojo from '../pojo/angket_rekap_tanggapan_pelanggan/mkt_laptanggapanpelanggan-view_laptanggapanpelanggan';

const mkt_laptanggapanpelanggan_kategori = async (): Promise<mkt_laptanggapanpelanggan_kategori_pojo> => {
    const resp = await request.get('/mkt_laptanggapanpelanggan/kategori');
    return plainToClass(mkt_laptanggapanpelanggan_kategori_pojo, resp);
}
const mkt_laptanggapanpelanggan_view_laptanggapanpelanggan = async (data: any): Promise<mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_pojo> => {
    const resp = await request.post('/mkt_laptanggapanpelanggan/view_laptanggapanpelanggan', data);
    return plainToClass(mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_pojo, resp);
}

export default {
    mkt_laptanggapanpelanggan_kategori,
    mkt_laptanggapanpelanggan_view_laptanggapanpelanggan
}