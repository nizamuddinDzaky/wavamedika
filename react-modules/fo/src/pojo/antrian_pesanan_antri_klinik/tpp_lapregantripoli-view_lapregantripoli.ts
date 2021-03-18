import Metadata from "../Metadata";

export interface detail {
  id_rencanakontrol?: number,
  id_unit?: number,
  id_kamar?: number,
  id_karyawan?: number,
  sex?: string,
  tgl_rencana?: string,
  hari?: string,
  poli?: string,
  dokter?: string,
  kontrol?: number,
  no_antri?: number,
  umur?: any,
  id_mrs?: any,
  pembayaran?: any,
  id_mr?: number,
  no_mr?: string,
  kecamatan?: string,
  kelas?: any,
  telepon?: string,
  hp?: string,
  alamat?: string,
  nama_lengkap?: string,
  nama_unit?: any,
  stat_berkas?: any,
  tgl_sms?: any,
  tgl_input?: string,
  operator_sms?: any,
  operator?: string
};

export default class view_lapregantripoli {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10,
    row_count: 40

  };
  list: Array<detail> = []
}
