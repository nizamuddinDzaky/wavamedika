import Metadata from "../Metadata";

export interface detail {
  propinsi?: string
};

export default class propinsipx {
  metadata: Metadata = {
    err_code: 0,
    list_count: 28,
    message: ''
  };
  list: Array<detail> = []
}
