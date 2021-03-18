import Metadata from "../Metadata";

export interface detail {
  nama_perujuk?: string,
  kode_perujuk?: string,
  jenis?: string,
  kabupaten?: string,
  kecamatan?: string,
  kelurahan?: string,
  telepon?: string
};

export default class view_perujuk {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
