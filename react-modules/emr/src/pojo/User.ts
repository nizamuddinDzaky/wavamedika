import Metadata from "./Metadata";

export interface detailUser {
    id_karyawan?: number;
    nama_lengkap?: string;
    tpp?: number;
    ugd?: number;
    poli?: number;
    kaber?: number;
    perina?: number;
    hd?: number;
    lab?: number;
    rad?: number;
    ok?: number;
    gizi?: number;
    ri?: number;
    kasir?: number;
    mr?: number;
    fo?: number;
    general?: number;
    gudang?: number;
    hrd?: number;
    admin?: number;
    bimroh?: string;
    aktifasi?: string;
    bpjs?: string;
    budget?: string;
    budget_all?: string;
    emr?: string;
    fisioterapi?: string;
    gaji?: string;
    gaji_all?: string;
    innos?: string;
    laundry?: string;
    manajemen?: string;
    pajak?: string;
    parkir?: string;
    simrs?: string;
    supervisor?: string;
    surat?: string;
    karyawan?: number;

};

export default class listUser {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailUser> = []
}
