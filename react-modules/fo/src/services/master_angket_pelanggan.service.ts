import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_masterangketpelanggan_masterangketpelanggan_pojo from '../pojo/master_angket/mkt_masterangketpelanggan-masterangketpelanggan';
import mkt_masterangketpelanggan_insert_pojo from '../pojo/master_angket/mkt_masterangketpelanggan-insert';
import mkt_masterangketpelanggan_delete_pojo from '../pojo/master_angket/mkt_masterangketpelanggan-delete';

const mkt_masterangketpelanggan_masterangketpelanggan = async (data: any): Promise<mkt_masterangketpelanggan_masterangketpelanggan_pojo> => {
    const resp = await request.post('/mkt_masterangketpelanggan/masterangketpelanggan', data);
    return plainToClass(mkt_masterangketpelanggan_masterangketpelanggan_pojo, resp);
}
const mkt_masterangketpelanggan_delete = async (data: any): Promise<mkt_masterangketpelanggan_delete_pojo> => {
    const resp = await request.post('/mkt_masterangketpelanggan/delete', data);
    return plainToClass(mkt_masterangketpelanggan_delete_pojo, resp);
}
const mkt_masterangketpelanggan_insert = async (data: any): Promise<mkt_masterangketpelanggan_insert_pojo> => {
    const resp = await request.post('/mkt_masterangketpelanggan/insert', data);
    return plainToClass(mkt_masterangketpelanggan_insert_pojo, resp);
}

export default {
    mkt_masterangketpelanggan_masterangketpelanggan,
    mkt_masterangketpelanggan_delete,
    mkt_masterangketpelanggan_insert
}