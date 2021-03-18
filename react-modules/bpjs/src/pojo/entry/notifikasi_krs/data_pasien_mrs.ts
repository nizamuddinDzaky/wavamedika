import Metadata from "../../Metadata";

export interface detailMRS {
    id_mrs?: number;
    no_mr?: number;
    tgl_mrs?: string;
    nama_lengkap?: string;
    umur?: string;
    sex?: string;
    kecamatan?: string;
    kamar?: string;
    status?: string;
    kelas?: string;
};

export default class PasienMRS {
    metadata: Metadata = {
        message: '',
        response_status: 0,
        current_page: 1,
        total_page: 0,
        total_row_current_page: 0,
        total_data: 0,
    };
    list: Array<detailMRS> = []
}
