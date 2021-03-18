import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_lapangketpelanggan_view_lapkepuasan_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_lapkepuasan';
import mkt_lapangketpelanggan_view_lapkepuasan_bulanan_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_lapkepuasan_bulanan';
import mkt_lapangketpelanggan_view_lapkepuasan_mingguan_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_lapkepuasan_mingguan';
import mkt_lapangketpelanggan_view_lapquestioner_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_lapquestioner';
import mkt_lapangketpelanggan_view_lapquestioner_mingguan_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_lapquestioner_mingguan';
import mkt_lapangketpelanggan_view_laptanggapanpelanggan_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_laptanggapanpelanggan';
import mkt_lapangketpelanggan_view_laptanggapanpelanggan_mingguan_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_laptanggapanpelanggan_mingguan';
import mkt_lapangketpelanggan_view_laptanggapanpelanggan_rekap_pojo from '../pojo/angket_rekap_angket_pelanggan/mkt_lapangketpelanggan-view_laptanggapanpelanggan_rekap';

const mkt_lapangketpelanggan_view_lapkepuasan = async (data: any): Promise<mkt_lapangketpelanggan_view_lapkepuasan_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_lapkepuasan', data);
    return plainToClass(mkt_lapangketpelanggan_view_lapkepuasan_pojo, resp);
}
const mkt_lapangketpelanggan_view_lapkepuasan_bulanan = async (data: any): Promise<mkt_lapangketpelanggan_view_lapkepuasan_bulanan_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_lapkepuasan_bulanan', data);
    return plainToClass(mkt_lapangketpelanggan_view_lapkepuasan_bulanan_pojo, resp);
}
const mkt_lapangketpelanggan_view_lapkepuasan_mingguan = async (data: any): Promise<mkt_lapangketpelanggan_view_lapkepuasan_mingguan_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_lapkepuasan_mingguan', data);
    return plainToClass(mkt_lapangketpelanggan_view_lapkepuasan_mingguan_pojo, resp);
}
const mkt_lapangketpelanggan_view_lapquestioner = async (data: any): Promise<mkt_lapangketpelanggan_view_lapquestioner_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_lapquestioner', data);
    return plainToClass(mkt_lapangketpelanggan_view_lapquestioner_pojo, resp);
}
const mkt_lapangketpelanggan_view_lapquestioner_mingguan = async (data: any): Promise<mkt_lapangketpelanggan_view_lapquestioner_mingguan_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_lapquestioner_mingguan', data);
    return plainToClass(mkt_lapangketpelanggan_view_lapquestioner_mingguan_pojo, resp);
}
const mkt_lapangketpelanggan_view_laptanggapanpelanggan = async (data: any): Promise<mkt_lapangketpelanggan_view_laptanggapanpelanggan_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_laptanggapanpelanggan', data);
    return plainToClass(mkt_lapangketpelanggan_view_laptanggapanpelanggan_pojo, resp);
}
const mkt_lapangketpelanggan_view_laptanggapanpelanggan_mingguan = async (data: any): Promise<mkt_lapangketpelanggan_view_laptanggapanpelanggan_mingguan_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_laptanggapanpelanggan_mingguan', data);
    return plainToClass(mkt_lapangketpelanggan_view_laptanggapanpelanggan_mingguan_pojo, resp);
}
const mkt_lapangketpelanggan_view_laptanggapanpelanggan_rekap = async (data: any): Promise<mkt_lapangketpelanggan_view_laptanggapanpelanggan_rekap_pojo> => {
    const resp = await request.post('/mkt_lapangketpelanggan/view_laptanggapanpelanggan_rekap', data);
    return plainToClass(mkt_lapangketpelanggan_view_laptanggapanpelanggan_rekap_pojo, resp);
}

export default {
    mkt_lapangketpelanggan_view_lapkepuasan,
    mkt_lapangketpelanggan_view_lapkepuasan_bulanan,
    mkt_lapangketpelanggan_view_lapkepuasan_mingguan,
    mkt_lapangketpelanggan_view_lapquestioner,
    mkt_lapangketpelanggan_view_lapquestioner_mingguan,
    mkt_lapangketpelanggan_view_laptanggapanpelanggan,
    mkt_lapangketpelanggan_view_laptanggapanpelanggan_mingguan,
    mkt_lapangketpelanggan_view_laptanggapanpelanggan_rekap
}