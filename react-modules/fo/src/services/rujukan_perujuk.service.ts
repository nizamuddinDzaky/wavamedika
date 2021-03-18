import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_masterperujuk_jenisperujuk_pojo from '../pojo/rujukan_perujuk/mkt_masterperujuk-jenisperujuk';
import mkt_masterperujuk_kecamatan_pojo from '../pojo/rujukan_perujuk/mkt_masterperujuk-kecamatan';
import mkt_masterperujuk_kelurahan_pojo from '../pojo/rujukan_perujuk/mkt_masterperujuk-kelurahan';
import mkt_masterperujuk_masterperujuk_pojo from '../pojo/rujukan_perujuk/mkt_masterperujuk-masterperujuk';
import mkt_masterperujuk_rewardpoin_pojo from '../pojo/rujukan_perujuk/mkt_masterperujuk-rewardpoin';
import mkt_perujuk_insert_pojo from '../pojo/rujukan_perujuk/mkt_perujuk-insert';
import mkt_perujuk_jenisperujuk_pojo from '../pojo/rujukan_perujuk/mkt_perujuk-jenisperujuk';
import mkt_perujuk_view_datakaryawan_pojo from '../pojo/rujukan_perujuk/mkt_perujuk-view_datakaryawan';
import mkt_perujuk_view_karyawan_pojo from '../pojo/rujukan_perujuk/mkt_perujuk-view_karyawan';
import mkt_perujuk_view_perujuk_pojo from '../pojo/rujukan_perujuk/mkt_perujuk-view_perujuk';
import tpp_mr_kabupatenpx_pojo from '../pojo/rujukan_perujuk/tpp_mr-kabupatenpx';
import tpp_mr_kecamatanpx_pojo from '../pojo/rujukan_perujuk/tpp_mr-kecamatanpx';
import tpp_mr_kelurahanpx_pojo from '../pojo/rujukan_perujuk/tpp_mr-kelurahanpx';
import tpp_mr_propinsipx_pojo from '../pojo/rujukan_perujuk/tpp_mr-propinsipx';

const mkt_masterperujuk_jenisperujuk = async (): Promise<mkt_masterperujuk_jenisperujuk_pojo> => {
    const resp = await request.get('/mkt_masterperujuk/jenisperujuk');
    return plainToClass(mkt_masterperujuk_jenisperujuk_pojo, resp);
}
const mkt_masterperujuk_kecamatan = async (): Promise<mkt_masterperujuk_kecamatan_pojo> => {
    const resp = await request.get('/mkt_masterperujuk/kecamatan');
    return plainToClass(mkt_masterperujuk_kecamatan_pojo, resp);
}
const mkt_masterperujuk_kelurahan = async (): Promise<mkt_masterperujuk_kelurahan_pojo> => {
    const resp = await request.get('/mkt_masterperujuk/kelurahan');
    return plainToClass(mkt_masterperujuk_kelurahan_pojo, resp);
}
const mkt_masterperujuk_masterperujuk = async (data: any): Promise<mkt_masterperujuk_masterperujuk_pojo> => {
    const resp = await request.post('/mkt_masterperujuk/masterperujuk', data);
    return plainToClass(mkt_masterperujuk_masterperujuk_pojo, resp);
}
const mkt_masterperujuk_rewardpoin = async (data: any): Promise<mkt_masterperujuk_rewardpoin_pojo> => {
    const resp = await request.post('/mkt_masterperujuk/rewardpoin', data);
    return plainToClass(mkt_masterperujuk_rewardpoin_pojo, resp);
}
const mkt_perujuk_insert = async (data: any): Promise<mkt_perujuk_insert_pojo> => {
    const resp = await request.post('/mkt_perujuk/insert', data);
    return plainToClass(mkt_perujuk_insert_pojo, resp);
}
const mkt_perujuk_jenisperujuk = async (): Promise<mkt_perujuk_jenisperujuk_pojo> => {
    const resp = await request.get('/mkt_perujuk/jenisperujuk');
    return plainToClass(mkt_perujuk_jenisperujuk_pojo, resp);
}
const mkt_perujuk_view_datakaryawan = async (data: any): Promise<mkt_perujuk_view_datakaryawan_pojo> => {
    const resp = await request.post('/mkt_perujuk/view_datakaryawan', data);
    return plainToClass(mkt_perujuk_view_datakaryawan_pojo, resp);
}
const mkt_perujuk_view_karyawan = async (data: any): Promise<mkt_perujuk_view_karyawan_pojo> => {
    const resp = await request.post('/mkt_perujuk/view_karyawan', data);
    return plainToClass(mkt_perujuk_view_karyawan_pojo, resp);
}
const mkt_perujuk_view_perujuk = async (data: any): Promise<mkt_perujuk_view_perujuk_pojo> => {
    const resp = await request.post('/mkt_perujuk/view_perujuk', data);
    return plainToClass(mkt_perujuk_view_perujuk_pojo, resp);
}
const tpp_mr_kabupatenpx = async (data: any): Promise<tpp_mr_kabupatenpx_pojo> => {
    const resp = await request.post('/tpp_mr/kabupatenpx', data);
    return plainToClass(tpp_mr_kabupatenpx_pojo, resp);
}
const tpp_mr_kecamatanpx = async (data: any): Promise<tpp_mr_kecamatanpx_pojo> => {
    const resp = await request.post('/tpp_mr/kecamatanpx', data);
    return plainToClass(tpp_mr_kecamatanpx_pojo, resp);
}
const tpp_mr_kelurahanpx = async (data: any): Promise<tpp_mr_kelurahanpx_pojo> => {
    const resp = await request.post('/tpp_mr/kelurahanpx', data);
    return plainToClass(tpp_mr_kelurahanpx_pojo, resp);
}
const tpp_mr_propinsipx = async (): Promise<tpp_mr_propinsipx_pojo> => {
    const resp = await request.get('/tpp_mr/propinsipx');
    return plainToClass(tpp_mr_propinsipx_pojo, resp);
}

export default {
    mkt_masterperujuk_jenisperujuk,
    mkt_masterperujuk_kecamatan,
    mkt_masterperujuk_kelurahan,
    mkt_masterperujuk_masterperujuk,
    mkt_masterperujuk_rewardpoin,
    mkt_perujuk_insert,
    mkt_perujuk_jenisperujuk,
    mkt_perujuk_view_datakaryawan,
    mkt_perujuk_view_karyawan,
    mkt_perujuk_view_perujuk,
    tpp_mr_kabupatenpx,
    tpp_mr_kecamatanpx,
    tpp_mr_kelurahanpx,
    tpp_mr_propinsipx
}