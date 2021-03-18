import request from '../api.service';
import { plainToClass } from 'class-transformer';
import dataPasien from "../../pojo/master/data_pasien/data_pasien_bpjs";

const tpp_datapasien_jnspasien = async () : Promise<dataPasien> => {
    const resp = await request.get('/tpp_datapasien/jnspasien');
    return plainToClass(dataPasien, resp);
}
const tpp_datapasien_kabupatenpx = async () : Promise<dataPasien> => {
    const resp = await request.get('/tpp_datapasien/kabupatenpx');
    return plainToClass(dataPasien, resp);
}
const tpp_datapasien_kecamatanpx = async () : Promise<dataPasien> => {
    const resp = await request.get('/tpp_datapasien/kecamatanpx');
    return plainToClass(dataPasien, resp);
}

const tpp_datapasien_view_datapasien = async (data: any) : Promise<dataPasien> => {
    const resp = await request.post('/tpp_datapasien/view_datapasien', data);
    return plainToClass(dataPasien, resp);
}

export default {
    tpp_datapasien_jnspasien,
    tpp_datapasien_kabupatenpx,
    tpp_datapasien_kecamatanpx,
    tpp_datapasien_view_datapasien,
}