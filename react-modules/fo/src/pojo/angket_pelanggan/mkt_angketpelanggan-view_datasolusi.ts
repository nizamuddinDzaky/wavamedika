import Metadata from "../Metadata";

export interface detail {
  id_angketpelanggan_kategori?: number,
  id_angketpelanggan?: number,
  kategori?: string,
  kategori_bk?: string,
  perbaikan?: string,
  solusi?: string,
  penanganan?: string,
  operator?: number,
  tgl_input?: string

};

export default class view_datasolusi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 2,
    message: ''
  };
  list: Array<detail> = []
}
