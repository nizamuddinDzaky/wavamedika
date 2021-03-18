import Metadata from "../Metadata";

export interface detailDataPajakKaryawan {
  id?: number,
  no_NPWP?: string,
  bulan?: string,
  tahun?: number,
  pembetulan?: string,
  nama_karyawan?: string,
  sex_karyawan?: string,
  status_karyawan?: string,
  anak_karyawan?: number,
  jabatan_karyawan?: string,
  posisi_karyawan?: string,
  bruto?: string,
  pph?: string,
  kode_pajak?: string,
  iuran?: number,
  kode_negara?: string
};

export default class dataPajakKaryawan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPajakKaryawan> = []
}
