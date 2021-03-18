import Metadata from "../Metadata";

export interface detail {
  id_karyawan?: number,
  nama?: string,
  sex?: string,
  alamat?: string,
  propinsi?: string,
  kabupaten?: string,
  kecamatan?: string,
  kelurahan?: string,
  hp?: string
};

export default class view_karyawan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
