import Metadata from "../../Metadata";

export interface detailDataEntryKRS {
    id?: number,
    tgl_input?: string,
    no_rm?: string,
    nama_pasien?: string,
    alamat?: string,
    keterangan?: string,
    aktif?: string,
};

export default class dataEntryKRS {
    metadata: Metadata = {
        message: '',
        response_status: 0,
        current_page: 1,
        total_page: 0,
        total_row_current_page: 0,
        total_data: 0,
    };
    list: Array<detailDataEntryKRS> = []
}
