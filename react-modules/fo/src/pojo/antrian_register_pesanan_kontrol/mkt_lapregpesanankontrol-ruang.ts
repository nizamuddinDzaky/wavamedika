import Metadata from "../Metadata";

export interface detail {
  km?: string,
  nama_kamar?: string
};

export default class ruang {
  metadata: Metadata = {
    err_code: 0,
    list_count: 25,
    message: ''
  };
  list: Array<detail> = []
}
