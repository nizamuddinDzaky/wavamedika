import Metadata from "../../Metadata";

export interface detailDataVerifikasiCOBPasien {
    id?: number,
    tgl_invoice?: string,
    no_billing?: string,
    no_rm?: string,
    nama_pasien?: string,
    asuransi?: string,
    instansi?: string,
    admission?:string,
    status_kamar?: string,
    total_invoice?: string,
    dibayar_pasien?: string,
    kamar?: string,
    unit?: string,
};

export default class dataVerifikasiCOBPasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataVerifikasiCOBPasien> = []
}