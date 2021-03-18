import Metadata from "../Metadata";

export interface detail {
  nl?: string,
  n?: string
};

export default class kelas {
  metadata: Metadata = {
    err_code: 0,
    list_count: 11,
    message: ''
  };
  list: Array<detail> = []
}
