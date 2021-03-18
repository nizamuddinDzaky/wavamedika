import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  no_mr?: string,
  tgl_mrs?: string,
  nama_lengkap?: string,
  no_unit?: string,
  indeks?: any,
  jml?: number,
  catatan_diagnosa?: any,
  umur?: string,
  sex?: string,
  kecamatan?: string,
  kamar?: string,
  status?: any,
  kelas?: string,
  id_kamar?: number,
  id_unit?: number,
  id_regunit?: number,
  unit?: string,
  nama_perujuk?: string,
  asuransi?: string,
  instansi?: string,
  admission?: string,
  icd?: any,
  nama_icd?: any,
  karyawan?: any,
  hari?: number,
  dokter?: string,
  dr_ruangan?: any,
  rencana_pulang?: any,
  nama_operasi?: any
};

export default class view_lapmrsri {
  metadata: Metadata = {
    err_code: 0,
    list_count: 255,
    message: ''
  };
  list: Array<detail> = []
}
