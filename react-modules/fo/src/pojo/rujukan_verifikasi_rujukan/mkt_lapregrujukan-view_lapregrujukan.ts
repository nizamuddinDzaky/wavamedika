import Metadata from "../Metadata";

export interface detail {
  stat_verifikasi?: string,
  id_mrs?: number,
  no_mr?: string,
  nama_lengkap?: string,
  kode_perujuk?: string,
  nama_perujuk?: string,
  tgl_mrs?: string,
  tgl_krs?: string,
  unit?: string,
  kecamatan?: string,
  dokter?: string,
  keadaan_keluar?: any,
  pembayaran?: string,
  asuransi?: string,
  instansi?: any,
  admission?: string,
  surat_rujukan?: any,
  alasan?: any,
  tindak_lanjut?: any,
  nama_kamar?: string,
  operasi?: any,
  id_perujuk?: number
};

export default class view_lapregrujukan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    row_count: 0
  };
  list: Array<detail> = []
}
