import Metadata from "../Metadata";

export interface detail {
  id_instansifoto?: number,
  kode_instansi?: string,
  keterangan?: string,
  foto?: string,
  operator?: number,
  tgl_input?: string,
  editor?: any,
  updated?: any
};

export default class kartuadmission {
  metadata: Metadata = {
    err_code: 0,
    message: '',
    list_count: 1

  };
  list: Array<detail> = []
}
