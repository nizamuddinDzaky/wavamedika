import Metadata from "../../Metadata";

export interface detailDataPasienLab {
  id?: number,
  nomor_rm?: string,
  nama_lengkap?: string,
  sex?: string,
  umur?: string,
  desa?: string,
  kecamatan?: string,
  tmp_lahir?: string,
  tgl_lahir?: string,
  telepon?: string,
  catatan?: string,
  riwayat?: Array<number>
};

export default class dataPasien {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPasienLab> = []
}
