import request from '../api.service';
import { plainToClass } from 'class-transformer';
import listTarifNamaPemeriksaan from "../../pojo/master/other/data_tarif_nama_pemeriksaan";
import listTarifJenisPemeriksaan from "../../pojo/master/other/data_tarif_jenis_pemeriksaan";

const slug = '/keu/master';

const datatarifnamapemeriksaan = async (): Promise<listTarifNamaPemeriksaan> => {
    const resp = await request.get(`${slug}/tarif/cb-nama-pemeriksaan-rad`);
    // const newData = JSON.parse(resp);
    return plainToClass(listTarifNamaPemeriksaan, resp);
};

const datatarifjenispemeriksaan = async (): Promise<listTarifJenisPemeriksaan> => {
    const resp = await request.get(`${slug}/tarif/cb-jenis-pemeriksaan-rad`);
    // const newData = JSON.parse(resp);
    return plainToClass(listTarifJenisPemeriksaan, resp);
};

export default {
    datatarifnamapemeriksaan,
    datatarifjenispemeriksaan,
}
