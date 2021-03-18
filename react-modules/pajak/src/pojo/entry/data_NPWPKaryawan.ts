import Metadata from "../Metadata";

export interface detailDataNPWP {
  id?: number,
  no_NPWP?: number,
  nama_karyawan?: string,
  sex_karyawan?: string,
  status_karyawan?: string,
  anak_karyawan?: number,
  jabatan_karyawan?: string,
  posisi_karyawan?: string,
  kode_PTKP?: string,
  jumlah_PTKP?: number
};

export default class dataNPWP {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataNPWP> = []
}
