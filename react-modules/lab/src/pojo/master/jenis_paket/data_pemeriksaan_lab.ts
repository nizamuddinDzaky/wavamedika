import Metadata from "../../Metadata";

export interface detailDataPemeriksaanLab {
  id?: number,
  nama_pemeriksaan?: string,
  qty?: number
};

export default class listDataPemeriksaan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPemeriksaanLab> = []
}
