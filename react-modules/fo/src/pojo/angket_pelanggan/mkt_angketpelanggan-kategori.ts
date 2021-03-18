import Metadata from "../Metadata";

export interface detail {
  k?: string
};

export default class kategori {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ''
  };
  list: Array<detail> = []
}
