import Metadata from "../Metadata";

export interface detail {
  instansi?: string
};

export default class instansi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 4,
    message: ''
  };
  list: Array<detail> = []
}
