import Metadata from "../Metadata";

export interface detail {
  id_instansitarif?: number,
  kode_instansi?: string,
  kode_tindakan?: string,
  nama_tindakan?: string,
  jenis?: string,
  tarif?: string
  vvip?: string,
  vip?: string,
  vipb?: string,
  i?: string,
  ii?: string,
  iii?: string,
  iiia?: string,
  iiib?: string,
  aktif?: string,
  operator?: number,
  tgl_input?: string
};

export default class masterasuransitarif {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
