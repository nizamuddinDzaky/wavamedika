import Metadata from "../Metadata";

export interface detail {
  id_mr?: number,
  no_mr?: string,
  nama_lengkappx?: string,
  sex?: string,
  umur?: string,
  kelurahan?: string,
  kecamatan?: string,
  tmp_lahir?: string,
  tgl_lahir?: string,
  telepon?: string,
  operator?: number,
  catatan?: string,
  lengkap?: string,
  handphone?: string,
  editor?: number,
  updated?: string,
  no_mribu?: any,
  nama_ibu?: string,
  kegiatan_khusus?: any
};

export default class view_datapasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
