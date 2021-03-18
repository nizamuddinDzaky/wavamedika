import Metadata from "../Metadata";

export interface detail {
  kode_instansi?: string,
  nama_instansi?: string
};

export default class view_datapasienangketpelanggan {
  metadata: Metadata = {
    list_count: 0,
    err_code: 0,
    message: ''
  };
  list: Array<detail> = []
}
