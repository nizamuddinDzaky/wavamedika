import Metadata from "../../Metadata";

export interface detailDataTerimaSampel {
  id?: number,
  nomor_lab?: string,
  nama_pasien?: string,
  ambil?: string,
  no_rm?: number,
  tanggal?: string,
  jam?: string,
  pengambilan?: string,
  umur?: number,
  alamat?: string,
  unit?: string,
  no_mrs?: number,
  dokter?: string,
};

export default class dataTerimaSampel {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataTerimaSampel> = []
}
