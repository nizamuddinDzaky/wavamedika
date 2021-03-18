import Metadata from "../Metadata";

export interface detail {
  indeks?: number,
  uraian?: string,
  sb?:  number,
  b?:   number,
  k?:   number,
  sk?:  number
};

export default class view_lapquestioner {
  metadata: Metadata = {
    err_code: 0,
    list_count: 27
  };
  list: Array<detail> = []
}
