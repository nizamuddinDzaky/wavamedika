import Metadata from "../../Metadata";

export interface detailDataRiwayatKunjunganPasien {
    no_rm?: string,
    id?: number,
    tgl_invoice?: string,
    no_invoice?: string,
    no_billing?: string,
    nama_pasien?: string,
    kamar_terakhir?: string,
    ri_rj?: string,
    status_kamar?:string,
    asuransi?: string,
    instansi?: string,
    admission?: string,
    jam?: string,
    operator?: string,
    total?: string,
    outstanding?: string,
    keterangan?: string,
};

export default class dataRiwayatKunjunganPasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataRiwayatKunjunganPasien> = []
}