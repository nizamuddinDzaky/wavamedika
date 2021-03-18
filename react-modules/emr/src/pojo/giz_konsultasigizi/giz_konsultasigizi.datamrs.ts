import Metadata from "../Metadata";

export interface detailMRS {
    id_mrs: number;
    no_mr: number;
    nama_lengkap: string,
    sex: string,
    umur: string,
    kecamatan: string,
    id_kamar: number,
    nama_kamar: string
};

export default class listMRS {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailMRS> = []
}
