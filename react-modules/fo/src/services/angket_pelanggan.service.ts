import request from './api.service';
import { plainToClass } from 'class-transformer';
import mkt_angketpelanggan_delete_kekurangan_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-delete_kekurangan';
import mkt_angketpelanggan_insert_kekurangan_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-insert_kekurangan';
import mkt_angketpelanggan_insert_solusi_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-insert_solusi';
import mkt_angketpelanggan_kamar_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-kamar';
import mkt_angketpelanggan_kategori_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-kategori';
import mkt_angketpelanggan_kelas_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-kelas';
import mkt_angketpelanggan_update_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-update';
import mkt_angketpelanggan_update_kekurangan_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-update_kekurangan';
import mkt_angketpelanggan_view_dataangketpelanggan_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-view_dataangketpelanggan';
import mkt_angketpelanggan_view_datakekurangan_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-view_datakekurangan';
import mkt_angketpelanggan_view_datasolusi_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-view_datasolusi';
import mkt_angketpelanggan_view_mrs_pojo from '../pojo/angket_pelanggan/mkt_angketpelanggan-view_mrs';
import mkt_dataangketpelanggan_delete_pojo from '../pojo/angket_pelanggan/mkt_dataangketpelanggan-delete';
import mkt_dataangketpelanggan_insert_pojo from '../pojo/angket_pelanggan/mkt_dataangketpelanggan-insert';
import mkt_dataangketpelanggan_view_angketpelanggan_pojo from '../pojo/angket_pelanggan/mkt_dataangketpelanggan-view_angketpelanggan';
import mkt_dataangketpelanggan_view_dataangketpelanggan_pojo from '../pojo/angket_pelanggan/mkt_dataangketpelanggan-view_dataangketpelanggan';
import mkt_datapasienangketpelanggan_admission_pojo from '../pojo/angket_pelanggan/mkt_datapasienangketpelanggan-admission';
import mkt_datapasienangketpelanggan_asuransi_pojo from '../pojo/angket_pelanggan/mkt_datapasienangketpelanggan-asuransi';
import mkt_datapasienangketpelanggan_instansi_pojo from '../pojo/angket_pelanggan/mkt_datapasienangketpelanggan-instansi';
import mkt_datapasienangketpelanggan_view_datapasienangketpelanggan_pojo from '../pojo/angket_pelanggan/mkt_datapasienangketpelanggan-view_datapasienangketpelanggan';
import tpp_lapregpesankamar_kelas_pojo from '../pojo/angket_pelanggan/tpp_lapregpesankamar-kelas';

const mkt_angketpelanggan_delete_kekurangan = async (data: any): Promise<mkt_angketpelanggan_delete_kekurangan_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/delete_kekurangan', data);
    return plainToClass(mkt_angketpelanggan_delete_kekurangan_pojo, resp);
}
const mkt_angketpelanggan_insert_kekurangan = async (data: any): Promise<mkt_angketpelanggan_insert_kekurangan_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/insert_kekurangan', data);
    return plainToClass(mkt_angketpelanggan_insert_kekurangan_pojo, resp);
}
const mkt_angketpelanggan_insert_solusi = async (data: any): Promise<mkt_angketpelanggan_insert_solusi_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/insert_solusi', data);
    return plainToClass(mkt_angketpelanggan_insert_solusi_pojo, resp);
}
const mkt_angketpelanggan_kamar = async (): Promise<mkt_angketpelanggan_kamar_pojo> => {
    const resp = await request.get('/mkt_angketpelanggan/kamar');
    return plainToClass(mkt_angketpelanggan_kamar_pojo, resp);
}
const mkt_angketpelanggan_kategori = async (): Promise<mkt_angketpelanggan_kategori_pojo> => {
    const resp = await request.get('/mkt_angketpelanggan/kategori');
    return plainToClass(mkt_angketpelanggan_kategori_pojo, resp);
}
const mkt_angketpelanggan_kelas = async (): Promise<mkt_angketpelanggan_kelas_pojo> => {
    const resp = await request.get('/mkt_angketpelanggan/kelas');
    return plainToClass(mkt_angketpelanggan_kelas_pojo, resp);
}
const mkt_angketpelanggan_update = async (data: any): Promise<mkt_angketpelanggan_update_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/update', data);
    return plainToClass(mkt_angketpelanggan_update_pojo, resp);
}
const mkt_angketpelanggan_update_kekurangan = async (data: any): Promise<mkt_angketpelanggan_update_kekurangan_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/update_kekurangan', data);
    return plainToClass(mkt_angketpelanggan_update_kekurangan_pojo, resp);
}
const mkt_angketpelanggan_view_dataangketpelanggan = async (data: any): Promise<mkt_angketpelanggan_view_dataangketpelanggan_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/view_dataangketpelanggan', data);
    return plainToClass(mkt_angketpelanggan_view_dataangketpelanggan_pojo, resp);
}
const mkt_angketpelanggan_view_datakekurangan = async (data: any): Promise<mkt_angketpelanggan_view_datakekurangan_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/view_datakekurangan', data);
    return plainToClass(mkt_angketpelanggan_view_datakekurangan_pojo, resp);
}
const mkt_angketpelanggan_view_datasolusi = async (data: any): Promise<mkt_angketpelanggan_view_datasolusi_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/view_datasolusi', data);
    return plainToClass(mkt_angketpelanggan_view_datasolusi_pojo, resp);
}
const mkt_angketpelanggan_view_mrs = async (data: any): Promise<mkt_angketpelanggan_view_mrs_pojo> => {
    const resp = await request.post('/mkt_angketpelanggan/view_mrs', data);
    return plainToClass(mkt_angketpelanggan_view_mrs_pojo, resp);
}
const mkt_dataangketpelanggan_delete = async (data: any): Promise<mkt_dataangketpelanggan_delete_pojo> => {
    const resp = await request.post('/mkt_dataangketpelanggan/delete', data);
    return plainToClass(mkt_dataangketpelanggan_delete_pojo, resp);
}
const mkt_dataangketpelanggan_insert = async (data: any): Promise<mkt_dataangketpelanggan_insert_pojo> => {
    const resp = await request.post('/mkt_dataangketpelanggan/insert', data);
    return plainToClass(mkt_dataangketpelanggan_insert_pojo, resp);
}
const mkt_dataangketpelanggan_view_angketpelanggan = async (data: any): Promise<mkt_dataangketpelanggan_view_angketpelanggan_pojo> => {
    const resp = await request.post('/mkt_dataangketpelanggan/view_angketpelanggan', data);
    return plainToClass(mkt_dataangketpelanggan_view_angketpelanggan_pojo, resp);
}
const mkt_dataangketpelanggan_view_dataangketpelanggan = async (data: any): Promise<mkt_dataangketpelanggan_view_dataangketpelanggan_pojo> => {
    const resp = await request.post('/mkt_dataangketpelanggan/view_dataangketpelanggan', data);
    return plainToClass(mkt_dataangketpelanggan_view_dataangketpelanggan_pojo, resp);
}
const mkt_datapasienangketpelanggan_admission = async (): Promise<mkt_datapasienangketpelanggan_admission_pojo> => {
    const resp = await request.get('/mkt_datapasienangketpelanggan/admission');
    return plainToClass(mkt_datapasienangketpelanggan_admission_pojo, resp);
}
const mkt_datapasienangketpelanggan_asuransi = async (): Promise<mkt_datapasienangketpelanggan_asuransi_pojo> => {
    const resp = await request.get('/mkt_datapasienangketpelanggan/asuransi');
    return plainToClass(mkt_datapasienangketpelanggan_asuransi_pojo, resp);
}
const mkt_datapasienangketpelanggan_instansi = async (): Promise<mkt_datapasienangketpelanggan_instansi_pojo> => {
    const resp = await request.get('/mkt_datapasienangketpelanggan/instansi');
    return plainToClass(mkt_datapasienangketpelanggan_instansi_pojo, resp);
}
const mkt_datapasienangketpelanggan_view_datapasienangketpelanggan = async (data: any): Promise<mkt_datapasienangketpelanggan_view_datapasienangketpelanggan_pojo> => {
    const resp = await request.post('/mkt_datapasienangketpelanggan/view_datapasienangketpelanggan', data);
    return plainToClass(mkt_datapasienangketpelanggan_view_datapasienangketpelanggan_pojo, resp);
}
const tpp_lapregpesankamar_kelas = async (): Promise<tpp_lapregpesankamar_kelas_pojo> => {
    const resp = await request.get('/tpp_lapregpesankamar/kelas');
    return plainToClass(tpp_lapregpesankamar_kelas_pojo, resp);
}

export default {
    mkt_angketpelanggan_delete_kekurangan,
    mkt_angketpelanggan_insert_kekurangan,
    mkt_angketpelanggan_insert_solusi,
    mkt_angketpelanggan_kamar,
    mkt_angketpelanggan_kategori,
    mkt_angketpelanggan_kelas,
    mkt_angketpelanggan_update,
    mkt_angketpelanggan_update_kekurangan,
    mkt_angketpelanggan_view_dataangketpelanggan,
    mkt_angketpelanggan_view_datakekurangan,
    mkt_angketpelanggan_view_datasolusi,
    mkt_angketpelanggan_view_mrs,
    mkt_dataangketpelanggan_delete,
    mkt_dataangketpelanggan_insert,
    mkt_dataangketpelanggan_view_angketpelanggan,
    mkt_dataangketpelanggan_view_dataangketpelanggan,
    mkt_datapasienangketpelanggan_admission,
    mkt_datapasienangketpelanggan_asuransi,
    mkt_datapasienangketpelanggan_instansi,
    mkt_datapasienangketpelanggan_view_datapasienangketpelanggan,
    tpp_lapregpesankamar_kelas
}