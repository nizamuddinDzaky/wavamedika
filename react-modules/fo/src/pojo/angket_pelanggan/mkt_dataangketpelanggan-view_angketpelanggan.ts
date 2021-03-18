import Metadata from "../Metadata";

export interface detail {
  code?: number,
  0: {
    id_angketpelanggan?: number,
    nama?: string,
    alamat?: string,
    kamar?: string,
    sex?: string,
    usia?: string,
    tgl_input?: string,
    id_kamar?: number,
    kelas?: string,
    tgl_masuk?: string,
    telepon?: string,
    dokter1?: string,
    dokter2?: string,
    kunjungan?: any,
    perbaikan?: any,
    kepuasan?: any,
    id_mrs?: number,
    lock?: any,
    operator?: number
  }
};

export default class view_angketpelanggan {
  metadata: Metadata = {
    error: false,
    code: 0,
    list_count: 1
  };
  list: Array<any> = []
}
