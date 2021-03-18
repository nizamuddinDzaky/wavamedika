import Metadata from "../Metadata";

export interface detail {
  no_mr?: string,
  jenis_pasien?: string,
  nama_lengkap?: string,
  umur?: string,
  alamat?: string,
  tgl_daftar?: string,
  gelar?: string,
  darah?: string,
  telepon?: string,
  hp?: string,
  agama?: any,
  suku_bangsa?: any,
  pendidikan?: any,
  pekerjaan?: any,
  stat_kawin?: any,
  kewarganegaraan?: any,
  nama_keluarga?: any,
  hub_pasien?: any,
  nama_pj?: any,
  alamat_pj?: any,
  telp_pj?: any,
  pekerjaan_keluarga?: any
};

export default class view_datapasien_indeks {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1,
    message: ''
  };
  list: Array<detail> = []
}
