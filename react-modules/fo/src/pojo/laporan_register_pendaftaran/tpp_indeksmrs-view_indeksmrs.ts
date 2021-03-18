import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  no_mr?: string,
  nama_lengkap?: string,
  sex?: string,
  umur?: string,
  kecamatan?: string,
  unit?: string,
  cara_masuk?: string,
  kunjungan?: string,
  pembayaran?: string,
  alamat_perujuk?: string,
  operator?: any,
  tgl_mrs?: string,
  id_mr?: number,
  nama_perujuk?: string,
  jam_mrs?: string,
  shift?: string,
  jatah_kelas?: string,
  asuransi?: string,
  instansi?: any,
  admission?: string,
  tgl_krs?: any,
  jam_krs?: any,
  nama_kamar?: string,
  dokter?: string
};

export default class view_indeksmrs {
  metadata: Metadata = {
    err_code: 0,
    list_count: 15,
    message: ''
  };
  list: Array<detail> = []
}
