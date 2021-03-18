import Metadata from "../Metadata";

export interface detail {
  id_jnsangketpelanggan?: number,
  uraian?: string,
  aktif?: string,
  indeks?: number
};

export default class masterangketpelanggan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ""
  };
  list: Array<detail> = []
}
