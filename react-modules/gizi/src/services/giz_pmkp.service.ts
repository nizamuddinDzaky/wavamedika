import request from './api.service';
import { plainToClass } from 'class-transformer';
import dataMRS from '../pojo/giz_pmkppasien/datamrs';
import dataPmkpPasien from '../pojo/giz_pmkppasien/datapmkppasien';
import deletePmkp from '../pojo/giz_pmkppasien/delete';
import indikatorUnit from '../pojo/giz_pmkppasien/indikatorunit';
import insertPmkp from '../pojo/giz_pmkppasien/insert';

const slug = '/giz_pmkppasien';

/*
  example payload
  {
    "id_mrs":200200008,
    "operator":972
  }
*/
const datamrs = async (data: any): Promise<dataMRS> => {
  const resp = await request.post(`${slug}/datamrs`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataMRS, resp);
};

/*
  example payload
  {
    "id_unit":44
  }
*/
const indikatorunit = async (data: any): Promise<indikatorUnit> => {
  const resp = await request.post(`${slug}/indikatorunit`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(indikatorUnit, resp);
};

/*
  example payload
  {
    "id_mrs":200200008,
    "id_unit":44
  }
*/
const datapmkppasien = async (data: any): Promise<dataPmkpPasien> => {
  const resp = await request.post(`${slug}/datapmkppasien`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataPmkpPasien, resp);
};

/*
  example payload
  {
    "id_mrs":200200008,
    "id_unit":1,
    "operator":972,
    "id_pmkp":1,
    "pilihan":1
  }
*/
const insert = async (data: any): Promise<insertPmkp> => {
  const resp = await request.post(`${slug}/insert`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertPmkp, resp);
};

/*
  example payload
  {
    "id_mrs":200200008,
    "id_unit":1,
    "operator":972,
    "id_pmkp":1,
    "pilihan":1
  }
*/
const deleteDataPmkp = async (data: any): Promise<deletePmkp> => {
  const resp = await request.post(`${slug}/delete`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deletePmkp, resp);
};

export default {
  datamrs,
  indikatorunit,
  datapmkppasien,
  insert,
  deleteDataPmkp
}
