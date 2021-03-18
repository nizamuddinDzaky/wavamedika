import Metadata from "../Metadata";

export interface detail {
  kode_instansi?: string,
  nama_instansi?: string
};

export default class cmb_dataadmission {
  metadata: Metadata = {
    err_code: 0,
    message: '',
    list_count: 0,
  };
    list: Array<detail> = []
}
