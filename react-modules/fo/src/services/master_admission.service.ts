import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_instansi_datafasilitasasuransi_pojo from '../pojo/master_admission/mkt_instansi-datafasilitasasuransi';
import mkt_instansi_delete_fasilitasasuransi_pojo from '../pojo/master_admission/mkt_instansi-delete_fasilitasasuransi';
import mkt_instansi_delete_kartuasuransi_pojo from '../pojo/master_admission/mkt_instansi-delete_kartuasuransi';
import mkt_instansi_insert_pojo from '../pojo/master_admission/mkt_instansi-insert';
import mkt_instansi_insert_fasilitasasuransi_pojo from '../pojo/master_admission/mkt_instansi-insert_fasilitasasuransi';
import mkt_instansi_insert_kartuasuransi_pojo from '../pojo/master_admission/mkt_instansi-insert_kartuasuransi';
import mkt_instansi_view_instansi_pojo from '../pojo/master_admission/mkt_instansi-view_instansi';
import mkt_masteradmission_kartuadmission_pojo from '../pojo/master_admission/mkt_masteradmission-kartuadmission';
import mkt_masteradmission_masteradmission_pojo from '../pojo/master_admission/mkt_masteradmission-masteradmission';
import mkt_masterasuransi_kartuasuransi_pojo from '../pojo/master_admission/mkt_masterasuransi-kartuasuransi';

const mkt_instansi_datafasilitasasuransi = async (data: any): Promise<mkt_instansi_datafasilitasasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/datafasilitasasuransi', data);
    return plainToClass(mkt_instansi_datafasilitasasuransi_pojo, resp);
}
const mkt_instansi_delete_fasilitasasuransi = async (data: any): Promise<mkt_instansi_delete_fasilitasasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/delete_fasilitasasuransi', data);
    return plainToClass(mkt_instansi_delete_fasilitasasuransi_pojo, resp);
}
const mkt_instansi_delete_kartuasuransi = async (data: any): Promise<mkt_instansi_delete_kartuasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/delete_kartuasuransi', data);
    return plainToClass(mkt_instansi_delete_kartuasuransi_pojo, resp);
}
const mkt_instansi_insert = async (data: any): Promise<mkt_instansi_insert_pojo> => {
    const resp = await request.post('/mkt_instansi/insert', data);
    return plainToClass(mkt_instansi_insert_pojo, resp);
}
const mkt_instansi_insert_fasilitasasuransi = async (data: any): Promise<mkt_instansi_insert_fasilitasasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/insert_fasilitasasuransi', data);
    return plainToClass(mkt_instansi_insert_fasilitasasuransi_pojo, resp);
}
const mkt_instansi_insert_kartuasuransi = async (data: any): Promise<mkt_instansi_insert_kartuasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/insert_kartuasuransi', data);
    return plainToClass(mkt_instansi_insert_kartuasuransi_pojo, resp);
}
const mkt_instansi_view_instansi = async (data: any): Promise<mkt_instansi_view_instansi_pojo> => {
    const resp = await request.post('/mkt_instansi/view_instansi', data);
    return plainToClass(mkt_instansi_view_instansi_pojo, resp);
}
const mkt_masteradmission_kartuadmission = async (data: any): Promise<mkt_masteradmission_kartuadmission_pojo> => {
    const resp = await request.post('/mkt_masteradmission/kartuadmission', data);
    return plainToClass(mkt_masteradmission_kartuadmission_pojo, resp);
}
const mkt_masteradmission_masteradmission = async (data: any): Promise<mkt_masteradmission_masteradmission_pojo> => {
    const resp = await request.post('/mkt_masteradmission/masteradmission', data);
    return plainToClass(mkt_masteradmission_masteradmission_pojo, resp);
}
const mkt_masterasuransi_kartuasuransi = async (data: any): Promise<mkt_masterasuransi_kartuasuransi_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/kartuasuransi', data);
    return plainToClass(mkt_masterasuransi_kartuasuransi_pojo, resp);
}

export default {
    mkt_instansi_datafasilitasasuransi,
    mkt_instansi_delete_fasilitasasuransi,
    mkt_instansi_delete_kartuasuransi,
    mkt_instansi_insert,
    mkt_instansi_insert_fasilitasasuransi,
    mkt_instansi_insert_kartuasuransi,
    mkt_instansi_view_instansi,
    mkt_masteradmission_kartuadmission,
    mkt_masteradmission_masteradmission,
    mkt_masterasuransi_kartuasuransi
}