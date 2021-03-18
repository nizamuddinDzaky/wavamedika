import Metadata from "../Metadata";

export interface detail {
  tanggal_sms?: string,
  isi_sms?: string
};

export default class view_sms {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
