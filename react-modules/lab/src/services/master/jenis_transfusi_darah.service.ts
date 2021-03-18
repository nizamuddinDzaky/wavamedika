import request from '../api.service';
import { plainToClass } from 'class-transformer';
import dataJenisTransfusiDarah from '../../pojo/master/jenis_transfusi_darah/data_jenis_transfusi_darah';

const slug = '/lab/master';

const datajenistransfusidarah = async (data: any, page: number): Promise<dataJenisTransfusiDarah> => {
    const resp = await request.post(`${slug}/transfusi-darah?page=`+page, data);
    // const newData = JSON.parse(resp);
    return plainToClass(dataJenisTransfusiDarah, resp);
};

const tambahjenistransfusidarah = async (data: any): Promise<dataJenisTransfusiDarah> => {
    const resp = await request.post(`${slug}/transfusi-darah/tambah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(dataJenisTransfusiDarah, resp);
};

const ubahjenistransfusidarah = async (data: any): Promise<dataJenisTransfusiDarah> => {
    const resp = await request.post(`${slug}/transfusi-darah/ubah`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(dataJenisTransfusiDarah, resp);
};

const hapusjenistransfusidarah = async (data: any): Promise<dataJenisTransfusiDarah> => {
    const resp = await request.post(`${slug}/transfusi-darah/hapus`, data);
    // const newData = JSON.parse(resp);
    return plainToClass(dataJenisTransfusiDarah, resp);
};

export default {
    datajenistransfusidarah,
    tambahjenistransfusidarah,
    ubahjenistransfusidarah,
    hapusjenistransfusidarah
}