import request from './api.service';
import { plainToClass } from 'class-transformer';
import dataRencanaPulang from '../pojo/giz_datarencanapulang/datarencanapulang';

const slug = '/giz_datarencanapulang';

const datarencanapulang = async (): Promise<dataRencanaPulang> => {
  const resp = await request.get(`${slug}/datarencanapulang`);
  // const newData = JSON.parse(resp);
  return plainToClass(dataRencanaPulang, resp);
};

export default {
  datarencanapulang
}
