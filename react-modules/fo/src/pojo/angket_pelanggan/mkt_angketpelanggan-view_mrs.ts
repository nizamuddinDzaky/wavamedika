import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  id_mr?: number,
  nama_lengkap?: string,
  umur?: string,
  sex?: string,
  alamat?: string,
  telepon?: string,
  id_kamar?: number,
  kelas?: string,
  nama_kamar?: string

};

export default class view_mrs {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1,
    message: ''
  };
  list: Array<detail> = []
}
