import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_lapregrujukan_view_icopim_pojo from '../pojo/rujukan_verifikasi_rujukan/mkt_lapregrujukan-view_icopim';
import mkt_lapregrujukan_view_lapregrujukan_pojo from '../pojo/rujukan_verifikasi_rujukan/mkt_lapregrujukan-view_lapregrujukan';
import mkt_lapregrujukan_view_operasi_pojo from '../pojo/rujukan_verifikasi_rujukan/mkt_lapregrujukan-view_operasi';
import mkt_lapregrujukan_view_perujuk_pojo from '../pojo/rujukan_verifikasi_rujukan/mkt_lapregrujukan-view_perujuk';
import mkt_verifikasirujukan_insert_pojo from '../pojo/rujukan_verifikasi_rujukan/mkt_verifikasirujukan-insert';
import mkt_verifikasirujukan_view_verifikasirujukan_pojo from '../pojo/rujukan_verifikasi_rujukan/mkt_verifikasirujukan-view_verifikasirujukan';
import tpp_indekspasien_view_datapasien_indeks_pojo from '../pojo/rujukan_verifikasi_rujukan/tpp_indekspasien-view_datapasien_indeks';

/**
 * 
 * @param data 
 * {
		"id_mrs":200500011
       
}
 */
const mkt_lapregrujukan_view_icopim = async (data: any) : Promise<mkt_lapregrujukan_view_icopim_pojo> => {
    const resp = await request.post('/mkt_lapregrujukan/view_icopim', data);
    return plainToClass(mkt_lapregrujukan_view_icopim_pojo, resp);
}
/**
 * 
 * @param data 
 * {
		"halaman":1,
        "batas":10,
        "tgl1":"2020-01-01",
        "tgl2":"2020-06-01",
        "jns_tanggal":"MRS",
        "stat_verifikasi":"BELUM",
        "pembayaran":"_"
}
 */
const mkt_lapregrujukan_view_lapregrujukan = async (data: any) : Promise<mkt_lapregrujukan_view_lapregrujukan_pojo> => {
    const resp = await request.post('/mkt_lapregrujukan/view_lapregrujukan', data);
    return plainToClass(mkt_lapregrujukan_view_lapregrujukan_pojo, resp);
}
/**
 * 
 * @param data 
 * {
		"id_mrs":200500011
       
}
 */
const mkt_lapregrujukan_view_operasi = async (data: any) : Promise<mkt_lapregrujukan_view_operasi_pojo> => {
    const resp = await request.post('/mkt_lapregrujukan/view_operasi', data);
    return plainToClass(mkt_lapregrujukan_view_operasi_pojo, resp);
}
/**
 * 
 * @param data 
 * {
		"kode_perujuk":"B02771"
       
}
 */
const mkt_lapregrujukan_view_perujuk = async (data: any) : Promise<mkt_lapregrujukan_view_perujuk_pojo> => {
    const resp = await request.post('/mkt_lapregrujukan/view_perujuk', data);
    return plainToClass(mkt_lapregrujukan_view_perujuk_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	"id_mrs":"200500011",
	"surat_rujukan":"Ada",
        "verifikasi_rujukan":"Ya",
        "alasan":"alasan saja",
        "operator":972
}
 */
const mkt_verifikasirujukan_insert = async (data: any) : Promise<mkt_verifikasirujukan_insert_pojo> => {
    const resp = await request.post('/mkt_verifikasirujukan/insert', data);
    return plainToClass(mkt_verifikasirujukan_insert_pojo, resp);
}
/**
 * 
 * @param data 
 * {
		"id_mrs":"200500011"
       
}
 */
const mkt_verifikasirujukan_view_verifikasirujukan = async (data: any) : Promise<mkt_verifikasirujukan_view_verifikasirujukan_pojo> => {
    const resp = await request.post('/mkt_verifikasirujukan/view_verifikasirujukan', data);
    return plainToClass(mkt_verifikasirujukan_view_verifikasirujukan_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	"id_mr":61
}
 */
const tpp_indekspasien_view_datapasien_indeks = async () : Promise<tpp_indekspasien_view_datapasien_indeks_pojo> => {
    const resp = await request.get('/tpp_indekspasien/view_datapasien_indeks');
    return plainToClass(tpp_indekspasien_view_datapasien_indeks_pojo, resp);
}


export default {
    mkt_lapregrujukan_view_icopim,
    mkt_lapregrujukan_view_lapregrujukan,
    mkt_lapregrujukan_view_operasi,
    mkt_lapregrujukan_view_perujuk,
    mkt_verifikasirujukan_insert,
    mkt_verifikasirujukan_view_verifikasirujukan,
    tpp_indekspasien_view_datapasien_indeks
}
