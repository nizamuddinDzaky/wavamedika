import Metadata from "../Metadata";

export interface detail {
  id_perujuk?: number,
  nama_perujuk?: string,
  poin_saldo?: string,
  jml_saldo?: string,
  kode_perujuk?: string
};

export default class rewardpoin {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    row_count: 0
  };
  list: Array<detail> = []
}
