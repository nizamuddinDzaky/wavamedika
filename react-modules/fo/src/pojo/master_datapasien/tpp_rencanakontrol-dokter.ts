import Metadata from "../Metadata";

export interface detail {
  id_karyawan?: number,
  nama_lengkap?: string,
};

export default class dokter {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
