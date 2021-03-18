import request from './api.service';
import { plainToClass } from 'class-transformer';
import listDataTarif from "../pojo/data_tarif/transaction.datatarif";

const slug = '/giz_datatarif';

const datatarif = async (): Promise<listDataTarif> => {
    const resp = await request.get(`${slug}/datatarif`);
    // const newData = JSON.parse(resp);
    return plainToClass(listDataTarif, resp);
};

export default {
    datatarif,
}
