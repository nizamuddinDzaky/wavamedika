import Metadata from "../Metadata_CUD";

export interface detail {
  code?: number
};

export default class delete_linkasuransi {
  metadata: Metadata = {
    error: false,
    code: 0,
    message: '',
    list_count: 0
  };
    list: Array<detail> = []
}
