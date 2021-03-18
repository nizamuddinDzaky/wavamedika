import Metadata from "../Metadata";

export interface detail {
  id_karyawan?: number,
  nama?: string
};

export default class dokter {
  metadata: Metadata = {
    err_code: 0,
    list_count: 49,
    message: ''
  };
  list: Array<detail> = []
}
