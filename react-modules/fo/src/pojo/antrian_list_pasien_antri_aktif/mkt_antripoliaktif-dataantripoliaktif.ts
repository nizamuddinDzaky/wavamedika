import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  no_mr?: string,
  nama_lengkap?: string,
  no_antri?: number,
  tgl_mrs?: string,
  kode?: string

};

export default class dataantripoliaktif {
  metadata: Metadata = {
    err_code: 0,
    list_count: 54
  };
  list: Array<detail> = []
}
