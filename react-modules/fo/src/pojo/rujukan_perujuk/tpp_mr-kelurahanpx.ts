import Metadata from "../Metadata";

export interface detail {
  kelurahan?: string
};

export default class kelurahanpx {
  metadata: Metadata = {
    err_code: 0,
    list_count: 9,
    message: ''
  };
  list: Array<detail> = []
}
