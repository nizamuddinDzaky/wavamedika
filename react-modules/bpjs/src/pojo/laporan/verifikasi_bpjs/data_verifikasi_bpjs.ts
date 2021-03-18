import Metadata from "../../Metadata";

export interface detailDataVerifikasiBPJS {
    id?: number,
    tgl_invoice?: string,
    no_billing?: string,
    jatah_kelas?: string,
    status_kamar?:string,
    kelas?: string,
    kd_ina_cbg?: string,
    nama_pasien?: string,
    deposit?: string,
    total_klaim?: string,
    total_invoice?: string,
    selisih?: string,
};

export default class dataVerifikasiBPJS {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataVerifikasiBPJS> = []
}