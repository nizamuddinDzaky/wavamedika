import Metadata from "../Metadata";

export interface detail {
  id_karyawan?: number,
  nama?: string
};

export default class view_datakaryawan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 2
  };
  list: Array<detail> = []
}
