import Metadata from "../Metadata";

export interface detailPetugas {
    id_karyawan: number;
    nama: string;
    jenis: string;
};

export default class listPetugas {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailPetugas> = []
}
