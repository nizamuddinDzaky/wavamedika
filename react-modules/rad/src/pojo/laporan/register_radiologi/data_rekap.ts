import Metadata from "../../Metadata";

export interface detailDataRekap {
  id?: number,
  rekap?: string,
  jumlah?: number,
};


export default class listDataRekap {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataRekap> = []
}
