import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_laptanggapanpelanggan_kategori_pojo from '../pojo/angket_rekap_angket_pelanggan_pertahun/mkt_laptanggapanpelanggan-kategori';
import mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_bulanan_pojo from '../pojo/angket_rekap_angket_pelanggan_pertahun/mkt_laptanggapanpelanggan-view_laptanggapanpelanggan_bulanan';

const mkt_laptanggapanpelanggan_kategori = async (): Promise<mkt_laptanggapanpelanggan_kategori_pojo> => {
    const resp = await request.get('/mkt_laptanggapanpelanggan/kategori');
    return plainToClass(mkt_laptanggapanpelanggan_kategori_pojo, resp);
}
const mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_bulanan = async (data: any): Promise<mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_bulanan_pojo> => {
    const resp = await request.post('/mkt_laptanggapanpelanggan/view_laptanggapanpelanggan_bulanan', data);
    return plainToClass(mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_bulanan_pojo, resp);
}

export default {
    mkt_laptanggapanpelanggan_kategori,
    mkt_laptanggapanpelanggan_view_laptanggapanpelanggan_bulanan
}