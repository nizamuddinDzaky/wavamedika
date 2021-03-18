import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  k?: string
};

export default class kategori {
  metadata: Metadata = {
    err_code: 0,
    list_count: 5,
    message: ''
  };
  list: Array<detail> = []
}
