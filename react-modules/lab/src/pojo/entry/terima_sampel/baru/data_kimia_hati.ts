import Metadata from "../../../Metadata";

export interface detailDataKimiaHati {
  id?: number,
  cek?: boolean
  uraian?: string,
  qty?: number
};

export default class dataDetailKimiaHati {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataKimiaHati> = []
}
