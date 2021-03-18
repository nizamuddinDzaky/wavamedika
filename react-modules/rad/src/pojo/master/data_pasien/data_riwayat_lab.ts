import Metadata from "../../Metadata";

export interface detailDataRiwayatLab {
  id?: number,
  nomor_mrs?: string,
  tgl_mrs?: string,
  unit?: string,
  pembayaran?: string
};

export default class dataRiwayat {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataRiwayatLab> = []
}
