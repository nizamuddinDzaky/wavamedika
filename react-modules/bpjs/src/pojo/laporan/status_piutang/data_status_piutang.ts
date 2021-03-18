import Metadata from "../../Metadata";

export interface detailDataStatusPiutang {
    id?: number,
    tgl?: string,
    tgl_krs?: string,
    no_invoice?: string,
    no_billing?: string,
    no_rm?: string,
    nama_pasien?: string,
    jenis?: string,
    kamar?: string,
    status_kamar?: string,
    ri_rj?: string,
    jenis_invoice?: string,
    instansi?: string,
    admission?: string,
    jml_invoice?: string,
    deposit?: string,
    bayar_ksr?: string,
    bayar_keu?: string,
    bayar_bpjs?: string,
    refund_ksr?: string,
    refund_keu?: string,
    potongan?: string,
    saldo?: string,
    alamat?: string,
    no_sep?: string,
};

export default class dataStatusPiutang {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataStatusPiutang> = []
}