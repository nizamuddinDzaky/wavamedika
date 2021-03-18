import Metadata from "../../Metadata";

export interface detailDataVerifikasiInvoice {
    id?: number,
    tgl_invoice?: string,
    no_billing?: string,
    no_rm?: string,
    nama_pasien?: string,
    no_bpjs?: string,
    no_sep?: string,
    stat_kamar?:string,
    total_invoice?: string,
    status?: string,
    kd_ina_cbg?: string,
    jml_klaim?: string,
    kamar?: string,
    unit?: string,
};

export default class dataVerifikasiInvoice {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataVerifikasiInvoice> = []
}