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
  instansi?: string,
  catatan_diagnosa?: any,
  total?: any
};

export default class view_indeksinstansi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10,
    row_count: 0
  };
  list: Array<detail> = []
}
