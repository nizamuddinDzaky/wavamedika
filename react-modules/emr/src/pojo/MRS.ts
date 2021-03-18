import Metadata from "./Metadata";

export interface detailMRS {
    id_mrs: number;
    no_mr: number;
    tgl_mrs: string;
    nama_lengkap: string;
    umur: string;
    sex: string;
    kecamatan: string;
    kamar: string;
    status: string;
    kelas?: string;
    id_kamar: number;
    id_unit: number;
    id_regunit: number;
    nama_keluarga: string;
    nama_perujuk: string;
    asuransi: string;
    instansi: string;
    admission: string;
    catatan_diagnosa?: string;
    icd?: string;
    nama_icd?: string;
    nama_unit: string;
    ri_rj?: string;
    karyawan?: string;
    penyakit?: string;
    rencana_pulang?: string;
    id_mr: number;
    jatah_kelas: string;
    no_peserta: string;
    los: number;
    stat_kelas: string;
    id_privasi?: number;
    dirahasiakan?: string;
    ibu_kandung: string;
};

export default class listMRS {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailMRS> = []
}
