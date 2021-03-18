import Metadata from "../Metadata";

export interface detail {
  cara_masuk?: string,
  cm?: string
};

export default class caramasuk {
  metadata: Metadata = {
    err_code: 0,
    list_count: 5,
    message: ''
  };
  list: Array<detail> = []
}
