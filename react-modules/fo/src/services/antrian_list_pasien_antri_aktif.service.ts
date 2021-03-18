import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_antripoliaktif_dataantripoliaktif_pojo from '../pojo/antrian_list_pasien_antri_aktif/mkt_antripoliaktif-dataantripoliaktif';

const mkt_antripoliaktif_dataantripoliaktif = async (): Promise<mkt_antripoliaktif_dataantripoliaktif_pojo> => {
    const resp = await request.get('/mkt_antripoliaktif/dataantripoliaktif');
    return plainToClass(mkt_antripoliaktif_dataantripoliaktif_pojo, resp);
}

export default {
    mkt_antripoliaktif_dataantripoliaktif
}