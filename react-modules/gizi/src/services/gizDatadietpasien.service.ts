import request from './api.service';
import { plainToClass } from 'class-transformer';
import dataDietBaru from '../pojo/giz_datadietpasien/giz_datadietpasien.datadietbaru';
import dataDietPagi from '../pojo/giz_datadietpasien/giz_datadietpasien.datadietpagi';
import dataDietSiang from '../pojo/giz_datadietpasien/giz_datadietpasien.datadietsiang';
import dataDietSore from '../pojo/giz_datadietpasien/giz_datadietpasien.datadietsore';
import dataDietPasien from '../pojo/giz_datadietpasien/giz_datadietpasien.datadietpasien';
import indeksMRS from '../pojo/giz_datadietpasien/tpp_indeksmrs.unit';

const slug = '/giz_datadietpasien';

/*
  example payload
  {
    "tanggal":"2020-01-01",
    "unit":"IGD"
  }
*/
const datadietpasien = async (data: any): Promise<dataDietPasien> => {
  const resp = await request.post(`${slug}/datadietpasien`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataDietPasien, resp);
};

const unit = async (): Promise<indeksMRS> => {
  const resp = await request.get(`/tpp_indeksmrs/unit`);
  // const newData = JSON.parse(resp);
  return plainToClass(indeksMRS, resp);
};

/*
  example payload
  {
    "tanggal":"2020-01-01",
    "unit":"_"
  }
*/
const datadietpagi = async (data: any): Promise<dataDietPagi> => {
  const resp = await request.post(`${slug}/datadietpagi`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataDietPagi, resp);
};

/*
  example payload
  {
    "tanggal":"2020-01-01",
    "unit":"_"
  }
*/
const datadietsiang = async (data: any): Promise<dataDietSiang> => {
  const resp = await request.post(`${slug}/datadietsiang`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataDietSiang, resp);
};

/*
  example payload
  {
    "tanggal":"2020-01-01",
    "unit":"_"
  }
*/
const datadietsore = async (data: any): Promise<dataDietSore> => {
  const resp = await request.post(`${slug}/datadietsore`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataDietSore, resp);
};

/*
  example payload
  {
    "id_riwayatdiet":1
  }
*/
const datadietbaru = async (data: any): Promise<dataDietBaru> => {
  const resp = await request.post(`${slug}/datadietbaru`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(dataDietBaru, resp);
};

export default {
  datadietpasien,
  unit,
  datadietpagi,
  datadietsiang,
  datadietsore,
  datadietbaru
}
