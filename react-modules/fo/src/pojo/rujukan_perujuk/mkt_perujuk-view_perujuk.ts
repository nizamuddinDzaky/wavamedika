import Metadata from "../Metadata";

export interface detail {
  id_perujuk?: number,
  kode_perujuk?: string,
  aktif?: string,
  jenis?: string,
  nama_perujuk?: string,
  sex?: string,
  luar?: number,
  id_karyawan?: number,
  alamat?: string ,
  kelurahan?: string,
  kecamatan?: string,
  kabupaten?: string,
  propinsi?: string,
  kode_pos?: number,
  telepon?: string,
  hp?: string,
  rekening_bank?: string,
  cab_rek?: string,
  status_fee?: string,
  operator?: number,
  tgl_input?: string,
  telepon2?: string,
  telepon3?: string,
  bank?: string,
  kode_p?: string,
  editor?: any,
  updated?: any,
  nama_rekening?: string,
  target?: string,
  poin_saldo?: string,
  jml_saldo?: string
};

export default class view_perujuk {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
