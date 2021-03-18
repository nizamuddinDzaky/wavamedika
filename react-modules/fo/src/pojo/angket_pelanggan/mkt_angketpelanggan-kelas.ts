import Metadata from "../Metadata";

export interface detail {
  kelas?: string
};

export default class kelas {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ''
  };
  list: Array<detail> = []
}
