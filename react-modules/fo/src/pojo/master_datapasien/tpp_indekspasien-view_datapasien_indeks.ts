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
  agama?: string,
  suku_bangsa?: string,
  pendidikan?: string,
  pekerjaan?: string,
  stat_kawin?: string,
  kewarganegaraan?: string,
  nama_keluarga?: string,
  hub_pasien?: string,
  nama_pj?: string,
  alamat_pj?: string,
  telp_pj?: string,
  pekerjaan_keluarga?: string
};

export default class view_datapasien_indeks {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
