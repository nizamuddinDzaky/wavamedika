import Metadata from "../Metadata";

export interface detail {
  kode_instansi?: string,
  nama_instansi?: string
};

export default class admission {
  metadata: Metadata = {
    err_code: 0,
    list_count: 19,
    message: ''
  };
  list: Array<detail> = []
}
