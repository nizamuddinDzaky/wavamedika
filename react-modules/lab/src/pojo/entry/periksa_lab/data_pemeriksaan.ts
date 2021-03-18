import Metadata from "../../Metadata";

export interface detailDataPemeriksaan {
  id?: number,
  pemeriksaan?: string,
  cito?: string,
  qty?: number,
  oleh?: string,
  tanggal?: string,
  jumlah?: number,
  lab?: string,
  specimen?: string,
  hari_selesai?: string,
  tanggal_selesai?: string,
  catatan?: string,
};

export default class dataPemeriksaan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPemeriksaan> = []
}
