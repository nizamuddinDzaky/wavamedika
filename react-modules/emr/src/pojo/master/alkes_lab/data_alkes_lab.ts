import Metadata from "../../Metadata";

export interface detailDataAlkesLab {
  id?: number,
  nama_alkes?: string,
  sat_besar?: string,
  qty?: number,
  sat_kecil?: string
};

export default class dataAlkes {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataAlkesLab> = []
}
