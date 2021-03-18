import request from './api.service';
import { plainToClass } from 'class-transformer';
import delKonsultasiGizi from '../pojo/giz_konsultasigizi/giz_konsultasigizi.delete';
import dataMRS from '../pojo/giz_konsultasigizi/giz_konsultasigizi.datamrs';
import dataKonsultasiGizi from '../pojo/giz_konsultasigizi/giz_konsultasigizi.datakonsultasigizi';
import insertKonsultasiGizi from '../pojo/giz_konsultasigizi/giz_konsultasigizi.insert';
import dataDaftarKonsultasi from "../pojo/giz_konsultasigizi/giz_konsultasigizi.daftarkonsultasi";

const slug = '/giz_konsultasigizi';

  /*
  example payload
  {
    "id_mrs": 200200007
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
    "id_mrs": 200200007,
    "id_kamar":1
  }
*/
const datakonsultasigizi = async (data: any): Promise<dataKonsultasiGizi> => {
  const resp = await request.post(`${slug}/datakonsultasigizi`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataKonsultasiGizi, resp);
};

/*
  example payload
  {
		"id_mrs": 200200008,
		"oleh":4,
		"operator":972,
		"id_tarif":10,
		"qty":1
  }
 */
const insert = async (data: any): Promise<insertKonsultasiGizi> => {
  const resp = await request.post(`${slug}/insert`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertKonsultasiGizi, resp);
};

/*
  example payload
  {
		"id_mrs": 200200008,
		"oleh":4,
		"operator":972,
		"id_tarif":10,
		"qty":1
  }
 */
const deleteTransaction = async (data: any): Promise<delKonsultasiGizi> => {
  const resp = await request.post(`${slug}/delete`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(delKonsultasiGizi, resp);
};


const daftarKonsultasi = async (): Promise<dataDaftarKonsultasi> => {
    const resp = await request.get(`${slug}/konsultasi`);
    // const newData = JSON.parse(resp);
    return plainToClass(dataDaftarKonsultasi, resp);
};

export default {
  datamrs,
  datakonsultasigizi,
  insert,
  deleteTransaction,
  daftarKonsultasi
}
