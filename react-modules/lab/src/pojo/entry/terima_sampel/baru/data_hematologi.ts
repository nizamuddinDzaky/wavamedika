import Metadata from "../../../Metadata";

export interface detailDataHematologi {
  id?: number,
  cek?: boolean
  uraian?: string,
  qty?: number
};

export default class dataDetailHematologi {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataHematologi> = []
}
