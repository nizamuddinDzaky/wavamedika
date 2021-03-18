import Metadata from "../Metadata";

export interface detail {
  kepuasan?: string,
  jumlah?: string
};

export default class view_lapkepuasan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 3
  };
  list: Array<detail> = []
}
