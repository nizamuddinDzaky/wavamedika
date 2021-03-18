import Metadata from "../Metadata";

export interface detail {
  kelurahan?: string
};

export default class kelurahan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10
  };
  list: Array<detail> = []
}
