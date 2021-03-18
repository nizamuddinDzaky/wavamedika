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
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataAlkesLab> = []
}
