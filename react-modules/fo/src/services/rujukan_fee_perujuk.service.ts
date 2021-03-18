import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_lapfeeperujuk_insert_pencairan_pojo from '../pojo/rujukan_fee_perujuk/mkt_lapfeeperujuk-insert_pencairan';
import mkt_lapfeeperujuk_insert_penerimaan_pojo from '../pojo/rujukan_fee_perujuk/mkt_lapfeeperujuk-insert_penerimaan';
import mkt_lapfeeperujuk_view_lapfeeperujuk_pojo from '../pojo/rujukan_fee_perujuk/mkt_lapfeeperujuk-view_lapfeeperujuk';
import mkt_lapfeeperujuk_view_lapfeeperujuk_penerimaan_pojo from '../pojo/rujukan_fee_perujuk/mkt_lapfeeperujuk-view_lapfeeperujuk_penerimaan';

const mkt_lapfeeperujuk_insert_pencairan = async (data: any): Promise<mkt_lapfeeperujuk_insert_pencairan_pojo> => {
    const resp = await request.post('/mkt_lapfeeperujuk/insert_pencairan', data);
    return plainToClass(mkt_lapfeeperujuk_insert_pencairan_pojo, resp);
}
const mkt_lapfeeperujuk_insert_penerimaan = async (data: any): Promise<mkt_lapfeeperujuk_insert_penerimaan_pojo> => {
    const resp = await request.post('/mkt_lapfeeperujuk/insert_penerimaan', data);
    return plainToClass(mkt_lapfeeperujuk_insert_penerimaan_pojo, resp);
}
const mkt_lapfeeperujuk_view_lapfeeperujuk = async (data: any): Promise<mkt_lapfeeperujuk_view_lapfeeperujuk_pojo> => {
    const resp = await request.post('/mkt_lapfeeperujuk/view_lapfeeperujuk', data);
    return plainToClass(mkt_lapfeeperujuk_view_lapfeeperujuk_pojo, resp);
}
const mkt_lapfeeperujuk_view_lapfeeperujuk_penerimaan = async (data: any): Promise<mkt_lapfeeperujuk_view_lapfeeperujuk_penerimaan_pojo> => {
    const resp = await request.post('/mkt_lapfeeperujuk/view_lapfeeperujuk_penerimaan', data);
    return plainToClass(mkt_lapfeeperujuk_view_lapfeeperujuk_penerimaan_pojo, resp);
}

export default {
    mkt_lapfeeperujuk_insert_pencairan,
    mkt_lapfeeperujuk_insert_penerimaan,
    mkt_lapfeeperujuk_view_lapfeeperujuk,
    mkt_lapfeeperujuk_view_lapfeeperujuk_penerimaan
}