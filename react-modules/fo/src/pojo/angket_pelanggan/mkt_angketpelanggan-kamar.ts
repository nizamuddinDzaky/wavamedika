import Metadata from "../Metadata";

export interface detail {
  id_kamar?: number,
  nama_kamar?: string
};

export default class kamar {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ''
  };
  list: Array<detail> = []
}
