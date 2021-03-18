import request from './api.service';
import { plainToClass } from 'class-transformer';
import viewLapRegGizi from '../pojo/giz_lapreggizi/giz_lapreggizi.view_lapreggizi';
import viewLapRegGiziRekap from '../pojo/giz_lapreggizi/giz_lapreggizi.view_lapreggizi_rekap';
import viewLaprekapdietBentuk from '../pojo/giz_lapreggizi/giz_lapreggizi.view_laprekapdiet_bentuk';
import viewLaprekapdietJenis from '../pojo/giz_lapreggizi/giz_lapreggizi.view_laprekapdiet_jenis';
import viewLaprekapdietKelas from '../pojo/giz_lapreggizi/giz_lapreggizi.view_laprekapdiet_kelas';
import indeksMRS from '../pojo/giz_lapreggizi/tpp_indeksmrs.unit';

const slug = '/giz_lapreggizi';

/*
  example payload
  {
    "halaman":1,
    "batas":10,
    "tgl1":"2020-01-01",
    "tgl2":"2020-03-10",
    "unit":"_"
  }

*/
const view_lapreggizi = async (data: any): Promise<viewLapRegGizi> => {
  const resp = await request.post(`${slug}/view_lapreggizi`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(viewLapRegGizi, resp);
};

/*
  example payload
  {
    "halaman":1,
    "batas":10,
    "tgl1":"2020-01-01",
    "tgl2":"2020-03-10",
    "unit":"_"
  }
*/
const view_lapreggizi_rekap = async (data: any): Promise<viewLapRegGiziRekap> => {
  const resp = await request.post(`${slug}/view_lapreggizi_rekap`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(viewLapRegGiziRekap, resp);
};

const unit = async (): Promise<indeksMRS> => {
  const resp = await request.get(`/tpp_indeksmrs/unit`);
  // const newData = JSON.parse(resp);
  return plainToClass(indeksMRS, resp);
};

/*
  example payload
  {
    "bulan":3,
    "tahun":2020
  }
*/
const view_laprekapdiet_kelas = async (data: any): Promise<viewLaprekapdietKelas> => {
  const resp = await request.post(`${slug}/view_laprekapdiet_kelas`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(viewLaprekapdietKelas, resp);
};

/*
  example payload
  {
    "bulan":3,
    "tahun":2020
  }
*/
const view_laprekapdiet_bentuk = async (data: any): Promise<viewLaprekapdietBentuk> => {
  const resp = await request.post(`${slug}/view_laprekapdiet_bentuk`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(viewLaprekapdietBentuk, resp);
};

/*
  example payload
  {
    "bulan":3,
    "tahun":2020
  }
*/
const view_laprekapdiet_jenis = async (data: any): Promise<viewLaprekapdietJenis> => {
  const resp = await request.post(`${slug}/view_laprekapdiet_jenis`, data);
  // const newData = JSON.parse(resp);
  return plainToClass(viewLaprekapdietJenis, resp);
};

export default {
  view_lapreggizi,
  view_lapreggizi_rekap,
  unit,
  view_laprekapdiet_kelas,
  view_laprekapdiet_bentuk,
  view_laprekapdiet_jenis
}
