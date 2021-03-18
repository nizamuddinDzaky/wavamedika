import Metadata from "../Metadata";

export interface detailViewLapRegGizi {
    tgl_konsultasi: string,
    id_gizi: number,
    id_mrs: number,
    no_mr?: number,
    nama_lengkap?: string,
    sex?: string,
    umur?: string,
    alamat?: string,
    cara_masuk?: string,
    kunjungan?: any,
    tgl_mrs: string,
    konsultasi?: string,
    dari_unit: string,
    nama_unit: string,
    asuransi?: any,
    instansi?: any,
    admission?: any,
    kelas: string,
    pembayaran?: any

};

export default class viewLapRegGizi {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        row_count: 0
    };
    list: Array<detailViewLapRegGizi> = []
}
