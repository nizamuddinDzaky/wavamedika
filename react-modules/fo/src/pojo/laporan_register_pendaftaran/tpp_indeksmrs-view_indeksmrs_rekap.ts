import Metadata from "../Metadata";

export interface detail {
  rekapitulasi?: string,
  jml?: string
};

export default class view_indeksmrs_rekap {
  metadata: Metadata = {
    err_code: 0,
    list_count: 38,
    message: ''
  };
  list: Array<detail> = []
}
