import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_instansi_dataasuransi_pojo from '../pojo/master_instansi/mkt_instansi-dataasuransi';
import mkt_instansi_datafasilitasasuransi_pojo from '../pojo/master_instansi/mkt_instansi-datafasilitasasuransi';
import mkt_instansi_delete_fasilitasasuransi_pojo from '../pojo/master_instansi/mkt_instansi-delete_fasilitasasuransi';
import mkt_instansi_delete_kartuasuransi_pojo from '../pojo/master_instansi/mkt_instansi-delete_kartuasuransi';
import mkt_instansi_delete_linkasuransi_pojo from '../pojo/master_instansi/mkt_instansi-delete_linkasuransi';
import mkt_instansi_insert_pojo from '../pojo/master_instansi/mkt_instansi-insert';
import mkt_instansi_insert_fasilitasasuransi_pojo from '../pojo/master_instansi/mkt_instansi-insert_fasilitasasuransi';
import mkt_instansi_insert_kartuasuransi_pojo from '../pojo/master_instansi/mkt_instansi-insert_kartuasuransi';
import mkt_instansi_insert_linkasuransi_pojo from '../pojo/master_instansi/mkt_instansi-insert_linkasuransi';
import mkt_instansi_view_instansi_pojo from '../pojo/master_instansi/mkt_instansi-view_instansi';
import mkt_masterasuransi_kartuasuransi_pojo from '../pojo/master_instansi/mkt_masterasuransi-kartuasuransi';
import mkt_masterinstansi_delete_instansitarif_pojo from '../pojo/master_instansi/mkt_masterinstansi-delete_instansitarif';
import mkt_masterinstansi_insert_instansitarif_pojo from '../pojo/master_instansi/mkt_masterinstansi-insert_instansitarif';
import mkt_masterinstansi_jenistindakan_pojo from '../pojo/master_instansi/mkt_masterinstansi-jenistindakan';
import mkt_masterinstansi_kartuinstansi_pojo from '../pojo/master_instansi/mkt_masterinstansi-kartuinstansi';
import mkt_masterinstansi_masterinstansi_pojo from '../pojo/master_instansi/mkt_masterinstansi-masterinstansi';
import mkt_masterinstansi_masterinstansitarif_pojo from '../pojo/master_instansi/mkt_masterinstansi-masterinstansitarif';
import tpp_mrs_asuransi_pojo from '../pojo/master_instansi/tpp_mrs-asuransi';

const mkt_instansi_dataasuransi = async (data: any): Promise<mkt_instansi_dataasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/dataasuransi', data);
    return plainToClass(mkt_instansi_dataasuransi_pojo, resp);
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
const mkt_instansi_delete_linkasuransi = async (data: any): Promise<mkt_instansi_delete_linkasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/delete_linkasuransi', data);
    return plainToClass(mkt_instansi_delete_linkasuransi_pojo, resp);
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
const mkt_instansi_insert_linkasuransi = async (data: any): Promise<mkt_instansi_insert_linkasuransi_pojo> => {
    const resp = await request.post('/mkt_instansi/insert_linkasuransi', data);
    return plainToClass(mkt_instansi_insert_linkasuransi_pojo, resp);
}
const mkt_instansi_view_instansi = async (data: any): Promise<mkt_instansi_view_instansi_pojo> => {
    const resp = await request.post('/mkt_instansi/view_instansi', data);
    return plainToClass(mkt_instansi_view_instansi_pojo, resp);
}
const mkt_masterasuransi_kartuasuransi = async (data: any): Promise<mkt_masterasuransi_kartuasuransi_pojo> => {
    const resp = await request.post('/mkt_masterasuransi/kartuasuransi', data);
    return plainToClass(mkt_masterasuransi_kartuasuransi_pojo, resp);
}
const mkt_masterinstansi_delete_instansitarif = async (data: any): Promise<mkt_masterinstansi_delete_instansitarif_pojo> => {
    const resp = await request.post('/mkt_masterinstansi/delete_instansitarif', data);
    return plainToClass(mkt_masterinstansi_delete_instansitarif_pojo, resp);
}
const mkt_masterinstansi_insert_instansitarif = async (data: any): Promise<mkt_masterinstansi_insert_instansitarif_pojo> => {
    const resp = await request.post('/mkt_masterinstansi/insert_instansitarif', data);
    return plainToClass(mkt_masterinstansi_insert_instansitarif_pojo, resp);
}
const mkt_masterinstansi_jenistindakan = async (): Promise<mkt_masterinstansi_jenistindakan_pojo> => {
    const resp = await request.get('/mkt_masterinstansi/jenistindakan');
    return plainToClass(mkt_masterinstansi_jenistindakan_pojo, resp);
}
const mkt_masterinstansi_kartuinstansi = async (data: any): Promise<mkt_masterinstansi_kartuinstansi_pojo> => {
    const resp = await request.post('/mkt_masterinstansi/kartuinstansi', data);
    return plainToClass(mkt_masterinstansi_kartuinstansi_pojo, resp);
}
const mkt_masterinstansi_masterinstansi = async (data: any): Promise<mkt_masterinstansi_masterinstansi_pojo> => {
    const resp = await request.post('/mkt_masterinstansi/masterinstansi', data);
    return plainToClass(mkt_masterinstansi_masterinstansi_pojo, resp);
}
const mkt_masterinstansi_masterinstansitarif = async (data: any): Promise<mkt_masterinstansi_masterinstansitarif_pojo> => {
    const resp = await request.post('/mkt_masterinstansi/masterinstansitarif', data);
    return plainToClass(mkt_masterinstansi_masterinstansitarif_pojo, resp);
}
const tpp_mrs_asuransi = async (): Promise<tpp_mrs_asuransi_pojo> => {
    const resp = await request.get('/tpp_mrs/asuransi');
    return plainToClass(tpp_mrs_asuransi_pojo, resp);
}

export default {
    mkt_instansi_dataasuransi,
    mkt_instansi_datafasilitasasuransi,
    mkt_instansi_delete_fasilitasasuransi,
    mkt_instansi_delete_kartuasuransi,
    mkt_instansi_delete_linkasuransi,
    mkt_instansi_insert,
    mkt_instansi_insert_fasilitasasuransi,
    mkt_instansi_insert_kartuasuransi,
    mkt_instansi_insert_linkasuransi,
    mkt_instansi_view_instansi,
    mkt_masterasuransi_kartuasuransi,
    mkt_masterinstansi_delete_instansitarif,
    mkt_masterinstansi_insert_instansitarif,
    mkt_masterinstansi_jenistindakan,
    mkt_masterinstansi_kartuinstansi,
    mkt_masterinstansi_masterinstansi,
    mkt_masterinstansi_masterinstansitarif,
    tpp_mrs_asuransi
}