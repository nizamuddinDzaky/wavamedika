import Metadata from "../Metadata";

export interface detail {
  id_angketpelanggan_det?: number,
  id_angketpelanggan?: number,
  id_jnsangketpelanggan?: number,
  keterangan?: any,
  operator?: number,
  tgl_input?: string,
  updated?: any,
  uraian?: string
};

export default class view_dataangketpelanggan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 0,
    message: ''
  };
  list: Array<detail> = []
}
