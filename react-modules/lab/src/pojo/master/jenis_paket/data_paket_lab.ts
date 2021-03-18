import Metadata from "../../Metadata";

export interface detailDataPaketLab {
  id?: number,
  nama_paket?: string,
  pemeriksaan?: Array<number>
};

export default class listDataPaket {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPaketLab> = []
}
