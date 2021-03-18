import Metadata from "../Metadata";

export interface detailJenisDiet {
  id_jnsdiet?: number,
  aktif?: string,
  jns_diet?: string,
  keterangan?: string,
  warna?: string,
  kode_warna?: string,
  operator?: number,
  tgl_input?: Date

};

export default class jenisDiet {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailJenisDiet> = []
}
