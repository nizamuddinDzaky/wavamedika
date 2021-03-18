import Metadata from "../../Metadata";

export interface detailDataPTKP {
  id?: number,
  kode?: string,
  uraian?: string,
  jumlah?: number,
};

export default class listDataPTKP {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPTKP> = []
}
