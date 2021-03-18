import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listTarifNamaPemeriksaan from "../../pojo/master/other/data_tarif_nama_pemeriksaan";

const slug = '/keu/master';

const datatarifnamapemeriksaan = async (): Promise<listTarifNamaPemeriksaan> => {
    const resp = await request.get(`${slug}/tarif/cb-nama-pemeriksaan-lab`);
    // const newData = JSON.parse(resp);
    return plainToClass(listTarifNamaPemeriksaan, resp);
};

export default {
    datatarifnamapemeriksaan,
}
