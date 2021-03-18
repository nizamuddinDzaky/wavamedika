import Metadata from "../Metadata";

export interface detail {
  id_fasilitas?: number,
  nama_fasilitas?: string,
  keterangan?: string,
  tgl_input?: string,
  tgl_update?: string,
  operator?: number,
  editor?: number
};

export default class masterfasilitas {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
