import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  tgl_masuk?: string,
  perbaikan?: string,
  nama?: string,
  kamar?: string,
  solusi?: string,
  penanganan?: string,
  tgl1?: string,
  tgl2?: string
};

export default class view_laptanggapanpelanggan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 3
  };
  list: Array<detail> = []
}
