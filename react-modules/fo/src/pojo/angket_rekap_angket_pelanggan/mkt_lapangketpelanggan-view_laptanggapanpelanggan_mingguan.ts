import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  m1?: number,
  m2?: number,
  m3?: number,
  m4?: number
};

export default class view_laptanggapanpelanggan_mingguan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 2
  };
  list: Array<detail> = []
}
