import Metadata from "../../Metadata";

export interface detailDataListPemeriksaan {
  id?: number,
  tanggal?: string,
  no_lab?: number,
  hasil_pemeriksaan?: string,
};

export default class dataListPemeriksaan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataListPemeriksaan> = []
}
