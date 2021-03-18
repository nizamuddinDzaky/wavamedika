import Metadata from "../Metadata";

export interface detailDataDiet {
  id_diet?: number,
  aktif?: string,
  diet?: string,
  keterangan?: string,
  operator?: number,
  tgl_input?: Date
};

export default class dataDiet {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataDiet> = []
}
