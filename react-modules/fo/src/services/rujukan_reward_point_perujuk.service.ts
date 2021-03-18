import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_masterperujuk_rewardpoin_pojo from '../pojo/rujukan_reward_point_perujuk/mkt_masterperujuk-rewardpoin';

const mkt_masterperujuk_rewardpoin = async (data: any): Promise<mkt_masterperujuk_rewardpoin_pojo> => {
    const resp = await request.post('/mkt_masterperujuk/rewardpoin', data);
    return plainToClass(mkt_masterperujuk_rewardpoin_pojo, resp);
}

export default {
    mkt_masterperujuk_rewardpoin
}