import request from './api.service';
import { plainToClass } from 'class-transformer';
import dataDiet from '../pojo/giz_masterdiet/datadiet';
import deleteDiet from '../pojo/giz_masterdiet/delete_diet';
import insertDiet from '../pojo/giz_masterdiet/insert_diet';
import insertJenisDiet from '../pojo/giz_masterdiet/insert_jenisdiet';
import jenisDiet from '../pojo/giz_masterdiet/jenisdiet';

const slug = '/giz_masterdiet';

/*
  example payload
  {
    "diet":"BBHSF",
    "keterangan":"Bubur Halus sampai dengan Flatus",
    "operator":972
  }
*/
const insert_diet = async (data: any): Promise<insertDiet> => {
  const resp = await request.post(`${slug}/insert_diet`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertDiet, resp);
};

const datadiet = async (): Promise<dataDiet> => {
  const resp = await request.get(`${slug}/datadiet`);
  // const newData = JSON.parse(resp);
  return plainToClass(dataDiet, resp);
};

/*
  example payload
  {
    "id_diet":23,
    "operator":972
  }
*/
const delete_diet = async (data: any): Promise<deleteDiet> => {
  const resp = await request.post(`${slug}/delete_diet`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deleteDiet, resp);
};

/*
  example payload
  {
    "id_jnsdiet":23,
    "operator":972
  }
*/
const delete_jenisdiet = async (data: any): Promise<deleteDiet> => {
  const resp = await request.post(`${slug}/delete_jenisdiet`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(deleteDiet, resp);
};

const jenisdiet = async (): Promise<jenisDiet> => {
  const resp = await request.get(`${slug}/jenisdiet`);
  // const newData = JSON.parse(resp);
  return plainToClass(jenisDiet, resp);
};

/*
  example payload
  {
    "diet":"BBHSF",
    "keterangan":"Bubur Halus sampai dengan Flatus",
    "operator":972
  }
*/
const insert_jenisdiet = async (data: any): Promise<insertJenisDiet> => {
  const resp = await request.post(`${slug}/insert_jenisdiet`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(insertJenisDiet, resp);
};

export default {
  insert_diet,
  datadiet,
  delete_diet,
  delete_jenisdiet,
  jenisdiet,
  insert_jenisdiet
}
