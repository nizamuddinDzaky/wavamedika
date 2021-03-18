import Metadata from "../Metadata";

export interface detail {
  nama_rs?: string,
  klinik?: string,
  dokter?: string,
  no_antri?: number,
  tanggal?: string,
  nama_lengkap?: string,
  no_mr?: string
};

export default class karcisantri {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
