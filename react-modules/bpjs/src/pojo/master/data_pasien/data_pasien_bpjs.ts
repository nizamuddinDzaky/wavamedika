import Metadata from "../../Metadata";

export interface detailDataPasienBPJS {
    id_mr?: number,
    sex?: string,
    no_mr?: string,
    nama_lengkappx?: string,
    umur?: string,
    tmp_lahir?: string,
    tgl_lahir?: string,
    kelurahan?: string,
    kecamatan?: string,
    telepon?: string,
    operator?: string,
    lengkap?: string,
    catatan?: string,
    handphone?: string,
    editor?: number,
    updated?: string,
    no_mribu?: any,
    nama_ibu?: string,
    kegiatan_khusus?: any

    id_jnspasien?: string,
    jenis_pasien?: string,

    kc1?: string,
    kc2?: string,

    kb1?: string,
    kb2?: string,
};

export default class dataPasien {
    metadata: Metadata = {
        message: '',
        response_status: 0,
        current_page: 1,
        total_page: 0,
        total_row_current_page: 0,
        total_data: 0,
    };
    list: Array<detailDataPasienBPJS> = []
}