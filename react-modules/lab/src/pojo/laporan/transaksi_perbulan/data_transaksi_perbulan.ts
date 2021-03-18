import Metadata from "../../Metadata";

export interface detailDataTransaksiPerBulan {
  id?: number,
  tanggal?: string,
  no_mrs?: string,
  no_rm?: string,
  no_lab?: string,
  nama_pasien?: string,
  sex_pasien?: string,
  umur_pasien?: number,
  alamat_pasien?: string,
  pemeriksaan?: string,
  jumlah?: number,
  nama_unit?: string,
  asuransi?: string,
};

export default class dataTransaksiPerBulan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataTransaksiPerBulan> = []
}
