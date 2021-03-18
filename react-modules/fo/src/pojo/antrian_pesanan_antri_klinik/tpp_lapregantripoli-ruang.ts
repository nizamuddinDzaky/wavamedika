import Metadata from "../Metadata";

export interface detail {
  km?: string,
  nama_kamar?: string

};

export default class ruang {
  metadata: Metadata = {
    err_code: 0,
    message: '',
    list_count: 26

  };
  list: Array<detail> = []
}
