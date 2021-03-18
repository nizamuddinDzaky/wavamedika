import Metadata from "../../Metadata";

export interface detailDataTindakLanjut {
  id?: number,
  tgl?: string,
  jam?: string,
  tindak?: string,
};

export default class dataTindakLanjut {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataTindakLanjut> = []
}
