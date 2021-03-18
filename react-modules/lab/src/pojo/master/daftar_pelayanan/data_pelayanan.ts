import Metadata from "../../Metadata";

export interface detailDataPelayanan {
  id?: number,
  nama?: string,
  metode?: string
};

export default class listDataDaftarPelayanan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPelayanan> = []
}
