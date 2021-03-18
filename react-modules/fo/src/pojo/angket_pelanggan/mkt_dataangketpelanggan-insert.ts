import Metadata from "../Metadata_CUD";

export interface detail {
  code?: number
};

export default class insert {
  metadata: Metadata = {
    error: false,
    code: 0,
    id: 8,
    message: '',
    list_count: 1
  };
  list: Array<detail> = []
}
