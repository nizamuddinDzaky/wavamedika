import Metadata from "../Metadata";

export interface detail {
  indeks?: number,
  keterangan?: string,
  m1?: string,
  m2?: string,
  m3?: string,
  m4?: string
};

export default class view_lapkepuasan_mingguan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
