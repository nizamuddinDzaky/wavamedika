import Metadata from "../Metadata";

export interface detail {
  kabupaten?: string
};

export default class kabupatenpx {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10,
    message: ''
  };
  list: Array<detail> = []
}
