import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  no_mr?: string,
  tgl_mrs?: string,
  nama_lengkap?: string,
  umur?: string,
  sex?: string,
  kecamatan?: string,
  kamar?: string,
  status?: any,
  kelas?: any,
  id_kamar?: number,
  id_unit?: number,
  id_regunit?: number,
  nama_keluarga?: string,
  nama_perujuk?: string,
  asuransi?: string,
  instansi?: string,
  admission?: string,
  catatan_diagnosa?: any,
  icd?: any,
  nama_icd?: any,
  ri_rj?: string,
  karyawan?: any,
  penyakit?: any,
  rencana_pulang?: any,
  id_mr?: number,
  jatah_kelas?: any,
  no_peserta?: any,
  los?: string,
  stat_kelas?: string,
  id_privasi?: number,
  dirahasiakan?: string,
  dokter?: any,
  cc?: number,
  nama_unit?: string,
  golongan?: string,
  cob?: string,
  dpjp?: string
};

export default class datamrsaktif {
  metadata: Metadata = {
    err_code: 0,
    list_count: 3,
    message: ''
  };
  list: Array<detail> = []
}
