import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  tgl_masuk?: string,
  perbaikan?: string,
  nama?: string,
  kamar?: string,
  solusi?: string,
  penanganan?: string,
  kategori_bk?: string
};

export default class view_laptanggapanpelanggan_rekap {
  metadata: Metadata = {
    err_code: 0,
    list_count: 3
  };
  list: Array<detail> = []
}
