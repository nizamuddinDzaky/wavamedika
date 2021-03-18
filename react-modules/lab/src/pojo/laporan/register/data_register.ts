import Metadata from "../../Metadata";

export interface detailDataRegister {
  id?: number,
  tanggal?: string,
  tanggal_mrs?: string,
  no_mrs?: string,
  no_rm?: string,
  no_lab?: string,
  nama_pasien?: string,
  sex_pasien?: string,
  umur_pasien?: number,
  alamat_pasien?: string,
  pemeriksaan?: string,
  jenis?: string,
  unit?: string,
  golongan?: string,
  status?: string,
  rujuk?: string,
};

export default class dataRegister {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataRegister> = []
}
