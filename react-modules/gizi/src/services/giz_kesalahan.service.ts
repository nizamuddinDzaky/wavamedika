import request from './api.service';
import { plainToClass } from 'class-transformer';
import dataKesalahan from '../pojo/giz_kesalahan/datakesalahan';
import dataKomplain from '../pojo/giz_kesalahan/datakomplain';
import deleteDtlKesalahan from '../pojo/giz_kesalahan/delete_dtlkesalahan';
import deleteDtlKomplain from '../pojo/giz_kesalahan/delete_dtlkomplain';
import deleteKesalahan from '../pojo/giz_kesalahan/delete_kesalahan';
import deleteKomplain from '../pojo/giz_kesalahan/delete_komplain';
import insertDtlKesalahan from '../pojo/giz_kesalahan/insert_dtlkesalahan';
import insertDtlKomplain from '../pojo/giz_kesalahan/insert_dtlkomplain';
import insertKesalahan from '../pojo/giz_kesalahan/insert_kesalahan';
import insertKomplain from '../pojo/giz_kesalahan/insert_komplain';
import listKaryawan from '../pojo/giz_kesalahan/listkaryawan';

const slug = '/giz_kesalahan';

/*
  example payload
  {
    "id_jnskaryawan":1,
    "bulan":3,
    "tahun":2020
  }
*/
const datakesalahan = async (data: any): Promise<dataKesalahan> => {
  const resp = await request.post(`${slug}/datakesalahan`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataKesalahan, resp);
};

/*
  example payload
  {
    "id_jnskaryawan":1,
    "bulan":3,
    "tahun":2020
  }
*/
const datakomplain = async (data: any): Promise<dataKomplain> => {
  const resp = await request.post(`${slug}/datakomplain`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataKomplain, resp);
};

const listkaryawan = async (): Promise<listKaryawan> => {
  const resp = await request.get(`${slug}/listkaryawan`);
  // const newData = JSON.parse(resp);
  return plainToClass(listKaryawan, resp);
};

/*
  example payload
  {
    "id_karyawan":972,
    "bulan":1,
    "tahun":2020,
    "jenis":"Tambah",
    "operator":972
  }
*/
const insert_kesalahan = async (data: any): Promise<insertKesalahan> => {
  const resp = await request.post(`${slug}/insert_kesalahan`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertKesalahan, resp);
};

/*
  example payload
  {
    "id_kesalahan":1,
    "operator":972
  }
*/
const delete_kesalahan = async (data: any): Promise<deleteKesalahan> => {
  const resp = await request.post(`${slug}/delete_kesalahan`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deleteKesalahan, resp);
};

/*
  example payload
  {
    "bulan":1,
    "tahun":2020,
    "operator":972
  }
*/
const insert_komplain = async (data: any): Promise<insertKomplain> => {
  const resp = await request.post(`${slug}/insert_komplain`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertKomplain, resp);
};

/*
  example payload
  {
    "id_komplain":1,
    "operator":972
  }
*/
const delete_komplain = async (data: any): Promise<deleteKomplain> => {
  const resp = await request.post(`${slug}/delete_komplain`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deleteKomplain, resp);
};

/*
  example payload
  {
    "id_kesalahan":1,
    "id_karyawan":972,
    "indeks":1,
    "bulan":1,
    "tahun":2020,
    "masalah":"masalah",
    "solusi":"solusi",
    "operator":972
  }
*/
const insert_dtlkesalahan = async (data: any): Promise<insertDtlKesalahan> => {
  const resp = await request.post(`${slug}/insert_dtlkesalahan`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertDtlKesalahan, resp);
};

/*
  example payload
  {
    "id_kesalahandet":2,
    "operator":972
  }
*/
const delete_dtlkesalahan = async (data: any): Promise<deleteDtlKesalahan> => {
  const resp = await request.post(`${slug}/delete_dtlkesalahan`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deleteDtlKesalahan, resp);
};

/*
  example payload
  {
    "id_komplain":1,
    "indeks":1,
    "bulan":1,
    "tahun":2020,
    "masalah":"masalah",
    "solusi":"solusi",
    "operator":972
  }
*/
const insert_dtlkomplain = async (data: any): Promise<insertDtlKomplain> => {
  const resp = await request.post(`${slug}/insert_dtlkomplain`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertDtlKomplain, resp);
};

/*
  example payload
  {
    "id_komplaindet":1,
    "operator":972
  }
*/
const delete_dtlkomplain = async (data: any): Promise<deleteDtlKomplain> => {
  const resp = await request.post(`${slug}/delete_dtlkomplain`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deleteDtlKomplain, resp);
};

export default {
  datakesalahan,
  datakomplain,
  listkaryawan,
  insert_kesalahan,
  delete_kesalahan,
  insert_komplain,
  delete_komplain,
  insert_dtlkesalahan,
  delete_dtlkesalahan,
  insert_dtlkomplain,
  delete_dtlkomplain
}
