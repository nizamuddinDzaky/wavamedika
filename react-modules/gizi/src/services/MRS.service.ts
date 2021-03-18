import request from './api.service';
import { plainToClass } from 'class-transformer';
import listMRS from "../pojo/MRS";

const getListMRS = async (): Promise<listMRS> => {
    const resp = await request.get(`/giz_transaksi/listmrsaktif`);
    // const newData = JSON.parse(resp);
    return plainToClass(listMRS, resp);
};

export default {
    getListMRS
}
