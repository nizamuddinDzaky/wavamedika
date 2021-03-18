import Metadata from "../Metadata";

export interface detail {
  nama_unit?: string
};

export default class unit {
  metadata: Metadata = {
    err_code: 0,
    list_count: 38,
    message: ''
  };
  list: Array<detail> = []
}
