import Metadata from "../../Metadata";

export interface detailDataNotifikasiKRSPasien {
    id?: number,
    tgl_input?: string,
    no_rm?: string,
    nama_pasien?: string,
    alamat?: string,
    keterangan?: string,
    aktif?: string,
};

export default class dataNotifikasiKRSPasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataNotifikasiKRSPasien> = []
}