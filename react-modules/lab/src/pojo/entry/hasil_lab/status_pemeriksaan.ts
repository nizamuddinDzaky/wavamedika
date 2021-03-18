import Metadata from "../../Metadata";

export interface detailDataStatusPemeriksaan {
  id?: number,
  no_lab?: number,
  selesai_operator?: string,
  waktu_selesai?: string,
};

export default class dataStatusPemeriksaan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataStatusPemeriksaan> = []
}
