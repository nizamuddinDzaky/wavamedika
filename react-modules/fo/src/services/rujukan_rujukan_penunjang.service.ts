import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_laprujukanpenunjang_view_laprujukanpenunjang_pojo from '../pojo/rujukan_rujukan_penunjang/mkt_laprujukanpenunjang-view_laprujukanpenunjang';

const mkt_laprujukanpenunjang_view_laprujukanpenunjang = async (data: any): Promise<mkt_laprujukanpenunjang_view_laprujukanpenunjang_pojo> => {
    const resp = await request.post('/mkt_laprujukanpenunjang/view_laprujukanpenunjang', data);
    return plainToClass(mkt_laprujukanpenunjang_view_laprujukanpenunjang_pojo, resp);
}

export default {
    mkt_laprujukanpenunjang_view_laprujukanpenunjang
}