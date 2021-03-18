import Metadata from "../Metadata";

export interface detail {
  id_instansifasilitas?: number,
  kode_instansi?: string,
  id_fasilitas?: number,
  keterangan?: string,
  operator?: number,
  tgl_input?: string,
  editor?: any,
  updated?: any
};

export default class datafasilitasasuransi {
  metadata: Metadata = {
    err_code: 0,
    list_count: 3
  };
  list: Array<detail> = []
}
