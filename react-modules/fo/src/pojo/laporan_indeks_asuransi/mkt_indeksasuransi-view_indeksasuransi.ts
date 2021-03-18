import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  no_mr?: string,
  nama_lengkap?: string,
  sex?: string,
  umur?: string,
  tgl_mrs?: string,
  tgl_krs?: string,
  alamat?: string,
  unit?: string,
  asuransi?: string,
  instansi?: any,
  admission?: string,
  id_regunit?: number
};

export default class view_indeksasuransi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10,
    row_count: 0
  };
  list: Array<detail> = []
}
