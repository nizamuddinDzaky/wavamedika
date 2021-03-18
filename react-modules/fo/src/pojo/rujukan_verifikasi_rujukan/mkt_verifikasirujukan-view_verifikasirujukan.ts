import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  pembayaran?: string,
  asuransi?: string,
  instansi?: string,
  admission?: string
};

export default class view_verifikasirujukan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1
  };
  list: Array<detail> = []
}
