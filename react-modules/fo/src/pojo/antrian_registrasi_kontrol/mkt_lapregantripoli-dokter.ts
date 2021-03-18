import Metadata from "../Metadata";

export interface detail {
  nl?: string,
  nama_lengkap?: string

};

export default class dokter {
  metadata: Metadata = {
    err_code: 0,
    message: '',
    list_count: 0
  };
  list: Array<detail> = []
}
