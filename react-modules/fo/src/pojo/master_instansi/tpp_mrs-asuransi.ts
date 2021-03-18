import Metadata from "../Metadata";

export interface detail {
  kode_instansi?: string,
  nama_instansi?: string
};

export default class asuransi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ''
  };
    list: Array<detail> = []
}
