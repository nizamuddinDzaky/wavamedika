import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_instansi_cmb_dataadmission_pojo from '../pojo/master_asuransi/mkt_instansi-cmb_dataadmission';
import mkt_instansi_dataadmission_pojo from '../pojo/master_asuransi/mkt_instansi-dataadmission';
import mkt_instansi_datafasilitasasuransi_pojo from '../pojo/master_asuransi/mkt_instansi-datafasilitasasuransi';
import mkt_instansi_delete_fasilitasasuransi_pojo from '../pojo/master_asuransi/mkt_instansi-delete_fasilitasasuransi';
import mkt_instansi_delete_kartuasuransi_pojo from '../pojo/master_asuransi/mkt_instansi-delete_kartuasuransi';
import mkt_instansi_delete_linkadmission_pojo from '../pojo/master_asuransi/mkt_instansi-delete_linkadmission';
import mkt_instansi_insert_pojo from '../pojo/master_asuransi/mkt_instansi-insert';
import mkt_instansi_insert_fasilitasasuransi_pojo from '../pojo/master_asuransi/mkt_instansi-insert_fasilitasasuransi';
import mkt_instansi_insert_kartuasuransi_pojo from '../pojo/master_asuransi/mkt_instansi-insert_kartuasuransi';
import mkt_instansi_insert_linkadmission_pojo from '../pojo/master_asuransi/mkt_instansi-insert_linkadmission';
import mkt_instansi_view_instansi_pojo from '../pojo/master_asuransi/mkt_instansi-view_instansi';
import mkt_masterasuransi_delete_asuransitarif_pojo from '../pojo/master_asuransi/mkt_masterasuransi-delete_asuransitarif';
import mkt_masterasuransi_insert_asuransitarif_pojo from '../pojo/master_asuransi/mkt_masterasuransi-insert_asuransitarif';
import mkt_masterasuransi_jenistindakan_pojo from '../pojo/master_asuransi/mkt_masterasuransi-jenistindakan';
import mkt_masterasuransi_kartuasuransi_pojo from '../pojo/master_asuransi/mkt_masterasuransi-kartuasuransi';
import mkt_masterasuransi_masterasuransi_pojo from '../pojo/master_asuransi/mkt_masterasuransi-masterasuransi';
import mkt_masterasuransi_masterasuransitarif_pojo from '../pojo/master_asuransi/mkt_masterasuransi-masterasuransitarif';

const mkt_instansi_cmb_dataadmission = async (): Promise<mkt_instansi_cmb_dataadmission_pojo> => {
    const resp = await request.get('/mkt_instansi/dataadmission');
    return plainToClass(mkt_instansi_cmb_dataadmission_pojo, resp);
}
const mkt_instansi_dataadmission = async (data: any): Promise<mkt_instansi_dataadmission_pojo> => {
    const resp = await request.post('/mkt_instansi/dataadmission', data);
    return plainToClass(mkt_instansi_dataadmission_pojo, resp);
}
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
const mkt_instansi_delete_linkadmission = async (data: any): Promise<mkt_instansi_delete_linkadmission_pojo> => {
    const resp = await request.post('/mkt_instansi/delete_linkadmission', data);
    return plainToClass(mkt_instansi_delete_linkadmission_pojo, resp);
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
const mkt_instansi_insert_linkadmission = async (data: any): Promise<mkt_instansi_insert_linkadmission_pojo> => {
    const resp = await request.post('/mkt_instansi/insert_linkadmission', data);
    return plainToClass(mkt_instansi_insert_linkadmission_pojo, resp);
}
const mkt_instansi_view_instansi = async (data: any): Promise<mkt_instansi_view_instansi_pojo> => {
    const resp = await request.post('/mkt_instansi/view_instansi', data);
    return plainToClass(mkt_instansi_view_instansi_pojo, resp);
}
const mkt_masterasuransi_delete_asuransitarif = async (data: any): Promise<mkt_masterasuransi_delete_asuransitarif_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/delete_asuransitarif', data);
    return plainToClass(mkt_masterasuransi_delete_asuransitarif_pojo, resp);
}
const mkt_masterasuransi_insert_asuransitarif = async (data: any): Promise<mkt_masterasuransi_insert_asuransitarif_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/insert_asuransitarif', data);
    return plainToClass(mkt_masterasuransi_insert_asuransitarif_pojo, resp);
}
const mkt_masterasuransi_jenistindakan = async (): Promise<mkt_masterasuransi_jenistindakan_pojo> => {
    const resp = await request.get('/mkt_masterasuransi/jenistindakan');
    return plainToClass(mkt_masterasuransi_jenistindakan_pojo, resp);
}
const mkt_masterasuransi_kartuasuransi = async (data: any): Promise<mkt_masterasuransi_kartuasuransi_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/kartuasuransi', data);
    return plainToClass(mkt_masterasuransi_kartuasuransi_pojo, resp);
}
const mkt_masterasuransi_masterasuransi = async (data: any): Promise<mkt_masterasuransi_masterasuransi_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/masterasuransi', data);
    return plainToClass(mkt_masterasuransi_masterasuransi_pojo, resp);
}
const mkt_masterasuransi_masterasuransitarif = async (data: any): Promise<mkt_masterasuransi_masterasuransitarif_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/masterasuransitarif', data);
    return plainToClass(mkt_masterasuransi_masterasuransitarif_pojo, resp);
}

export default {
    mkt_instansi_cmb_dataadmission,
    mkt_instansi_dataadmission,
    mkt_instansi_datafasilitasasuransi,
    mkt_instansi_delete_fasilitasasuransi,
    mkt_instansi_delete_kartuasuransi,
    mkt_instansi_delete_linkadmission,
    mkt_instansi_insert,
    mkt_instansi_insert_fasilitasasuransi,
    mkt_instansi_insert_kartuasuransi,
    mkt_instansi_insert_linkadmission,
    mkt_instansi_view_instansi,
    mkt_masterasuransi_delete_asuransitarif,
    mkt_masterasuransi_insert_asuransitarif,
    mkt_masterasuransi_jenistindakan,
    mkt_masterasuransi_kartuasuransi,
    mkt_masterasuransi_masterasuransi,
    mkt_masterasuransi_masterasuransitarif
}