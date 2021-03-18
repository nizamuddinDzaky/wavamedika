import Metadata from "../Metadata";

export interface detail {
  id_mrs?: number,
  nama_lengkap?: string,
  id_privasi?: number,
  semua?: any,
  keluarga?: any,
  handai_taulan?: any,
  orang_lain?: any,
  media_massa?: any,
  keterangan?: string,
  tidak_dirahasiakan?: any,
  dirahasiakan?: string,
  dibatasi?: any
};

export default class view_dataprivasi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 1,
    message: ''
  };
  list: Array<detail> = []
}
