import Metadata from "../Metadata";

export interface detail {
  unit?: string
};

export default class unit {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ''
  };
  list: Array<detail> = []
}
