import Metadata from "../Metadata";

export interface detail {
  kategori?: string,
  jumlah?: string,
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

export default class view_laptanggapanpelanggan_bulanan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 4
  };
  list: Array<detail> = []
}
