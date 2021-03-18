import Metadata from "../Metadata";

export interface detailDataPPnKeluaran {
  id?: number,
  tanggal?: string,
  jenis?: string,
  keterangan?: string,
  jumlah?: number,
  ppn?: number,
};

export default class dataPPnKeluaran {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPPnKeluaran> = []
}
