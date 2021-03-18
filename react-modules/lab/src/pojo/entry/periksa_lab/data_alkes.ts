import Metadata from "../../Metadata";

export interface detailDataAlkes {
  id?: number,
  nama_alkes?: string,
  qty?: number,
  satuan?: number,
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
    list: Array<detailDataAlkes> = []
}
