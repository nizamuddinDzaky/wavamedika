import Metadata from "../Metadata";

export interface detail {
  indeks?: number,
  keterangan?: string,
  jan?: string,
  feb?: string,
  mar?: string,
  apr?: string,
  mei?: string,
  jun?: string,
  jul?: string,
  ags?: string,
  sep?: string,
  okt?: string,
  nop?: string,
  des?: string

};

export default class view_lapkepuasan_bulanan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
