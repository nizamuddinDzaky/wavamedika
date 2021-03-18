import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  baik?: number,
  kurang?: number
};

export default class view_laptanggapanpelanggan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 3
  };
  list: Array<detail> = []
}
