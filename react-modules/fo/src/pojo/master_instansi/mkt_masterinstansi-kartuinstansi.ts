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

export default class kartuinstansi {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ''
    };
    list: Array<detail> = []
}
