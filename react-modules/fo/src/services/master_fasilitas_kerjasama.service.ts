import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_masterfasilitas_masterfasilitas_pojo from '../pojo/master_fasilitas/mkt_masterfasilitas-masterfasilitas';
import mkt_masterfasilitas_delete_pojo from '../pojo/master_fasilitas/mkt_masterfasilitas-delete';
import mkt_masterfasilitas_insert_pojo from '../pojo/master_fasilitas/mkt_masterfasilitas-insert';

const mkt_masterfasilitas_masterfasilitas = async (data: any): Promise<mkt_masterfasilitas_masterfasilitas_pojo> => {
    const resp = await request.post('/mkt_masterfasilitas/masterfasilitas', data);
    return plainToClass(mkt_masterfasilitas_masterfasilitas_pojo, resp);
}
const mkt_masterfasilitas_delete = async (data: any): Promise<mkt_masterfasilitas_delete_pojo> => {
    const resp = await request.post('/mkt_masterfasilitas/delete', data);
    return plainToClass(mkt_masterfasilitas_delete_pojo, resp);
}
const mkt_masterfasilitas_insert = async (data: any): Promise<mkt_masterfasilitas_insert_pojo> => {
    const resp = await request.post('/mkt_masterfasilitas/insert', data);
    return plainToClass(mkt_masterfasilitas_insert_pojo, resp);
}

export default {
    mkt_masterfasilitas_masterfasilitas,
    mkt_masterfasilitas_delete,
    mkt_masterfasilitas_insert
}