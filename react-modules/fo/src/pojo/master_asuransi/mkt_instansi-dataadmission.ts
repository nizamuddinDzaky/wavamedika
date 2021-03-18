import Metadata from "../Metadata";

export interface detail {
  id_instansilink?: number,
  kode_instansi?: string,
  instansi?: string,
  keterangan?: string,
  operator?: number,
  tgl_input?: string,
  editor?: any,
  tgl_update?: string
};

export default class dataadmission {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
  };
    list: Array<detail> = []
}
