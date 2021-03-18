import request from './api.service';
import { plainToClass } from 'class-transformer';
import tpp_datapasien_jnspasien_pojo from '../pojo/master_datapasien/tpp_datapasien-jnspasien';
import tpp_datapasien_kabupatenpx_pojo from '../pojo/master_datapasien/tpp_datapasien-kabupatenpx';
import tpp_datapasien_kecamatanpx_pojo from '../pojo/master_datapasien/tpp_datapasien-kecamatanpx';
import tpp_datapasien_view_datapasien_pojo from '../pojo/master_datapasien/tpp_datapasien-view_datapasien';
import tpp_indekspasien_view_datapasien_indeks_pojo from '../pojo/master_datapasien/tpp_indekspasien-view_datapasien_indeks';
import tpp_rencanakontrol_datarencanakontrol_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-datarencanakontrol';
import tpp_rencanakontrol_delete_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-delete';
import tpp_rencanakontrol_dokter_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-dokter';
import tpp_rencanakontrol_insert_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-insert';
import tpp_rencanakontrol_karcisantri_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-karcisantri';
import tpp_rencanakontrol_noantri_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-noantri';
import tpp_rencanakontrol_poli_pojo from '../pojo/master_datapasien/tpp_rencanakontrol-poli';
import tpp_riwayatpasien_view_datapasien_riwayat_pojo from '../pojo/master_datapasien/tpp_riwayatpasien-view_datapasien_riwayat';
import tpp_riwayatpasien_view_riwayatpasien_pojo from '../pojo/master_datapasien/tpp_riwayatpasien-view_riwayatpasien';
import tpp_riwayatpasien_view_riwayatpasien_rekap_pojo from '../pojo/master_datapasien/tpp_riwayatpasien-view_riwayatpasien_rekap';
import tpp_riwayatpasien_view_riwayatpasien_tindakan_pojo from '../pojo/master_datapasien/tpp_riwayatpasien-view_riwayatpasien_tindakan';


const tpp_datapasien_jnspasien = async () : Promise<tpp_datapasien_jnspasien_pojo> => {
    const resp = await request.get('/tpp_datapasien/jnspasien');
    return plainToClass(tpp_datapasien_jnspasien_pojo, resp);
}
const tpp_datapasien_kabupatenpx = async () : Promise<tpp_datapasien_kabupatenpx_pojo> => {
    const resp = await request.get('/tpp_datapasien/kabupatenpx');
    return plainToClass(tpp_datapasien_kabupatenpx_pojo, resp);
}
const tpp_datapasien_kecamatanpx = async () : Promise<tpp_datapasien_kecamatanpx_pojo> => {
    const resp = await request.get('/tpp_datapasien/kecamatanpx');
    return plainToClass(tpp_datapasien_kecamatanpx_pojo, resp);
}

/**
 * example
 * {
	"halaman":1,
	"batas":10,
	"no_mr":"_",
	"nama":"fer",
    "kecamatan":"_",
    "kabupaten":"_",
    "sex":"_",
    "id_jnspasien":1,
    "thn1":1990,
    "thn2":2020
    }

 */
const tpp_datapasien_view_datapasien = async (data: any) : Promise<tpp_datapasien_view_datapasien_pojo> => {
    const resp = await request.post('/tpp_datapasien/view_datapasien', data);
    return plainToClass(tpp_datapasien_view_datapasien_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	 "id_mr":54
}
 */
const tpp_indekspasien_view_datapasien_indeks = async (data: any) : Promise<tpp_indekspasien_view_datapasien_indeks_pojo> => {
    const resp = await request.post('/tpp_indekspasien/view_datapasien_indeks', data);
    return plainToClass(tpp_indekspasien_view_datapasien_indeks_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	"id_mr":54
}

 */
const tpp_rencanakontrol_datarencanakontrol = async (data: any) : Promise<tpp_rencanakontrol_datarencanakontrol_pojo> => {
    const resp = await request.post('/tpp_rencanakontrol/datarencanakontrol', data);
    return plainToClass(tpp_rencanakontrol_datarencanakontrol_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	     "id_rencanakontrol":10,
             "operator":972
}
 */
const tpp_rencanakontrol_delete = async (data: any) : Promise<tpp_rencanakontrol_delete_pojo> => {
    const resp = await request.post('/tpp_rencanakontrol/delete', data);
    return plainToClass(tpp_rencanakontrol_delete_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	"id_kamar":59
    }
 */
const tpp_rencanakontrol_dokter = async (data: any) : Promise<tpp_rencanakontrol_dokter_pojo> => {
    const resp = await request.post('/tpp_rencanakontrol/dokter', data);
    return plainToClass(tpp_rencanakontrol_dokter_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	 "id_mr":55,
        "id_mrs":null,
        "id_kamar":58,
        "tgl_rencana":"2020-02-15",
        "hari":"Sabtu",
        "jam":null,
        "poli":1,
        "dokter":1,
        "keterangan":"Pesan Poli Feri",
        "operator":1
}

 */
const tpp_rencanakontrol_insert = async (data: any) : Promise<tpp_rencanakontrol_insert_pojo> => {
    const resp = await request.post('/tpp_rencanakontrol/insert', data);
    return plainToClass(tpp_rencanakontrol_insert_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	     "id_rencanakontrol":10
}
 */
const tpp_rencanakontrol_karcisantri = async (data: any) : Promise<tpp_rencanakontrol_karcisantri_pojo> => {
    const resp = await request.post('/tpp_rencanakontrol/karcisantri', data);
    return plainToClass(tpp_rencanakontrol_karcisantri_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	"dokter":1,
	"tanggal": "2020-01-30"
}
 */
const tpp_rencanakontrol_noantri = async (data: any) : Promise<tpp_rencanakontrol_noantri_pojo> => {
    const resp = await request.post('/tpp_rencanakontrol/noantri', data);
    return plainToClass(tpp_rencanakontrol_noantri_pojo, resp);
}
const tpp_rencanakontrol_poli = async () : Promise<tpp_rencanakontrol_poli_pojo> => {
    const resp = await request.get('/tpp_rencanakontrol/poli');
    return plainToClass(tpp_rencanakontrol_poli_pojo, resp);
}
/**
 * example payload
 *  {
	    "id_mr":54
    }
 */
const tpp_riwayatpasien_view_datapasien_riwayat = async (data: any) : Promise<tpp_riwayatpasien_view_datapasien_riwayat_pojo> => {
    const resp = await request.post('/tpp_riwayatpasien/view_datapasien_riwayat', data);
    return plainToClass(tpp_riwayatpasien_view_datapasien_riwayat_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	 "id_mr":55
    }
 */
const tpp_riwayatpasien_view_riwayatpasien = async (data: any) : Promise<tpp_riwayatpasien_view_riwayatpasien_pojo> => {
    const resp = await request.post('/tpp_riwayatpasien/view_riwayatpasien', data);
    return plainToClass(tpp_riwayatpasien_view_riwayatpasien_pojo, resp);
}

/**
 * {
	 "id_mr":55
    }
 */
const tpp_riwayatpasien_view_riwayatpasien_rekap = async (data: any) : Promise<tpp_riwayatpasien_view_riwayatpasien_rekap_pojo> => {
    const resp = await request.post('/tpp_riwayatpasien/view_riwayatpasien_rekap', data);
    return plainToClass(tpp_riwayatpasien_view_riwayatpasien_rekap_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	 "id_mrs":"200200007",
	 "unit":"_"
    }
 */
const tpp_riwayatpasien_view_riwayatpasien_tindakan = async (data: any) : Promise<tpp_riwayatpasien_view_riwayatpasien_tindakan_pojo> => {
    const resp = await request.post('/tpp_riwayatpasien/view_riwayatpasien_tindakan', data);
    return plainToClass(tpp_riwayatpasien_view_riwayatpasien_tindakan_pojo, resp);
}

export default {
    tpp_datapasien_jnspasien,
    tpp_datapasien_kabupatenpx,
    tpp_datapasien_kecamatanpx,
    tpp_datapasien_view_datapasien,
    tpp_indekspasien_view_datapasien_indeks,
    tpp_rencanakontrol_datarencanakontrol,
    tpp_rencanakontrol_delete,
    tpp_rencanakontrol_dokter,
    tpp_rencanakontrol_insert,
    tpp_rencanakontrol_karcisantri,
    tpp_rencanakontrol_noantri,
    tpp_rencanakontrol_poli,
    tpp_riwayatpasien_view_datapasien_riwayat,
    tpp_riwayatpasien_view_riwayatpasien,
    tpp_riwayatpasien_view_riwayatpasien_rekap,
    tpp_riwayatpasien_view_riwayatpasien_tindakan
}
