import Metadata from "../../Metadata";

export interface detailDataFaktorEksposi {
  id?: number,
  nama_pemeriksakan?: string,
  kategori?: string,
  kv?: number,
  ma?:number,
  sec?:number
};

export default class listDataFaktorEksposi {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataFaktorEksposi> = []
}
