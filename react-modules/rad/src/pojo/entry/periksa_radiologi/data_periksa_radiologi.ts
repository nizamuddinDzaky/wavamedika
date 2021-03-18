import Metadata from "../../Metadata";

export interface detailDataPeriksaRadiologi {
  id?: number,
  pemeriksaan?: string,
  rujuk?: string,
  jenis?: string,
  qty?: string,
  jumlah?: string,
  harga?: string,
  cito ?: string,
  no_reg?: string,
};

export default class dataPeriksaRadiologi {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPeriksaRadiologi> = []
}
