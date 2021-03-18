import Metadata from "../Metadata";

export interface detail {
  id_lokasi?: number,
  propinsi?: string,
  kabupaten?: string,
  kecamatan?: string,
  kelurahan?: string,
  kode_pos?: number
};

export default class datalokasi {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
