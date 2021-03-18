import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  rencana?: string,
  kontrol?: string
};

export default class view_lapregkontrol_rekap {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0
  };
  list: Array<detail> = []
}
