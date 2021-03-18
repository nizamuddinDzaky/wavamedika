import Metadata from "../../../Metadata";

export interface detailDataFaktur {
  id?: number,
  no_faktur?: number,
  no_lab?: number,
  tanggal?: string,
  no_mrs?: number,
  no_rm?: number,
  nama_pasien?: string,
  kelas?: string,
  ruang?: string,
  alamat?: string,
};

export default class dataDetailFaktur {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataFaktur> = []
}
