import request from './api.service';
import { plainToClass } from 'class-transformer';
import listMRS from "../pojo/transaction/transaction.listmrsaktif";
import listTransaction from '../pojo/transaction/transaction.listtransaksi';
import listTindakan from '../pojo/transaction/transaction.tindakan';
import listPetugas from '../pojo/transaction/transaction.petugas';
import insertTransaction from '../pojo/transaction/transaction.insert';
import delTransaction from '../pojo/transaction/transaction.delete';

const slug = '/giz_transaksi';

const listmrsaktif = async (): Promise<listMRS> => {
    const resp = await request.get(`${slug}/listmrsaktif`);
    const newData = JSON.parse(resp);
    return plainToClass(listMRS, newData);
};

/*
  example payload
  {
    "id_mrs": 200200008
  }
 */
const listtransaksi = async (id_mrs: number): Promise<listTransaction> => {
  const body = {
      id_mrs: id_mrs
  };

  const resp = await request.post(`${slug}/listtransaksi`, body);
  // const newData = JSON.parse(resp);
  return plainToClass(listTransaction, resp);
};

const tindakan = async (): Promise<listTindakan> => {
  const resp = await request.get(`${slug}/tindakan`);
  // const newData = JSON.parse(resp);
  return plainToClass(listTindakan, resp);
};

const petugas = async (): Promise<listPetugas> => {
  const resp = await request.get(`${slug}/petugas`);
  // const newData = JSON.parse(resp);
  return plainToClass(listPetugas, resp);
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
const insert = async (data: any): Promise<insertTransaction> => {
  const resp = await request.post(`${slug}/insert`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertTransaction, resp);
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
const deleteTransaction = async (data: any): Promise<delTransaction> => {
  const resp = await request.post(`${slug}/delete`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(delTransaction, resp);
};

export default {
    listmrsaktif,
    listtransaksi,
    tindakan,
    petugas,
    insert,
    deleteTransaction
}
