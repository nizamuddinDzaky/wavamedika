import request from './api.service';
import { plainToClass } from 'class-transformer';
import tpp_lokasi_datalokasi_pojo from '../pojo/master_lokasi/tpp_lokasi-datalokasi';
import tpp_lokasi_delete_pojo from '../pojo/master_lokasi/tpp_lokasi-delete';
import tpp_lokasi_insert_pojo from '../pojo/master_lokasi/tpp_lokasi-insert';
import tpp_lokasi_update_pojo from '../pojo/master_lokasi/tpp_lokasi-update';

/**
 * 
 * @param data 
 * {
        "propinsi":"Jawa Timur",
        "kabupaten":"Kota Batu",
        "kecamatan":"Batu",
	 "kelurahan":"Sisir"
	
}
 */
const tpp_lokasi_datalokasi = async (data: any) : Promise<tpp_lokasi_datalokasi_pojo> => {
    const resp = await request.post('//tpp_lokasi/datalokasi', data);
    return plainToClass(tpp_lokasi_datalokasi_pojo, resp);
}
/**
 * 
 * @param data 
 * {
        "id_lokasi":32503  
}
 */
const tpp_lokasi_delete = async (data: any) : Promise<tpp_lokasi_delete_pojo> => {
    const resp = await request.post('//tpp_lokasi/delete', data);
    return plainToClass(tpp_lokasi_delete_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	 "propinsi":"Jawa Timur",
        "kabupaten":"Kab. Malang",
        "kecamatan":"Kepanjen",
        "kelurahan":"Talangagung",
        "kode_pos":65163,
        "operator":1  
}
 */
const tpp_lokasi_insert = async (data: any) : Promise<tpp_lokasi_insert_pojo> => {
    const resp = await request.post('//tpp_lokasi/insert', data);
    return plainToClass(tpp_lokasi_insert_pojo, resp);
}
/**
 * 
 * @param data 
 * {
	 "id_lokasi":32497,
     	 "propinsi":"Jawa Timur",
        "kabupaten":"Kab. Malang",
        "kecamatan":"Kepanjen Edit",
        "kelurahan":"Talangagung Edit",
        "kode_pos":65163     
}
 */
const tpp_lokasi_update = async (data: any) : Promise<tpp_lokasi_update_pojo> => {
    const resp = await request.post('//tpp_lokasi/update', data);
    return plainToClass(tpp_lokasi_update_pojo, resp);
}

export default {
    tpp_lokasi_datalokasi,
    tpp_lokasi_delete,
    tpp_lokasi_insert,
    tpp_lokasi_update
}
