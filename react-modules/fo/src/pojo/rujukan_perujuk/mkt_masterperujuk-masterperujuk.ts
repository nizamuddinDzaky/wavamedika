import Metadata from "../Metadata";

export interface detail {
  id_perujuk?: number,
  kode_perujuk?: string,
  aktif?: string,
  jenis?: string,
  nama_perujuk?: string,
  sex?: string,
  luar?: string,
  id_karyawan?: number,
  alamat?: string,
  kelurahan?: string,
  kecamatan?: string,
  kabupaten?: string,
  propinsi?: string,
  kode_pos?: any,
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
  editor?: number,
  updated?: string,
  nama_rekening?: string,
  target?: string,
  poin_saldo?: string,
  jml_saldo?: string
};

export default class masterperujuk {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    row_count: 0
  };
  list: Array<detail> = []
}
