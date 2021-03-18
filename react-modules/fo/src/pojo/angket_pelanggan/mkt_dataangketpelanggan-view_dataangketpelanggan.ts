import Metadata from "../Metadata";

export interface detail {
  tgl_masuk?: string,
  nama?: string,
  alamat?: string,
  kamar?: string,
  sex?: string,
  usia?: string,
  kode_pos?: number,
  tgl_input?: string,
  operator?: string,
  bln?: string,
  thn?: string,
  id_angketpelanggan?: number,
  kelas?: string
};

export default class view_dataangketpelanggan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1,
    row_count: 1
  };
  list: Array<detail> = []
}
