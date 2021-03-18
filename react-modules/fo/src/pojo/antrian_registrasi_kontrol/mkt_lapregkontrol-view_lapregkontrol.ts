import Metadata from "../Metadata";

export interface detail {
  id_rencanakontrol?: number,
  id_mrs?: number,
  no_mr?: string,
  nama_lengkap?: string,
  sex?: string,
  umur?: number,
  kecamatan?: string,
  alamat?: string,
  tgl_rencana?: string,
  poli?: string,
  dokter?: string,
  unit?: string,
  nama_keluarga?: string,
  telepon?: string,
  kontrol?: number,
  operator?: string,
  unit_asal?: any,
  no_antri?: number,
  no_update?: number

};

export default class view_lapregkontrol {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10,
    row_count: 40
  };
  list: Array<detail> = []
}
