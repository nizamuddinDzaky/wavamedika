import Metadata from "../../Metadata";

export interface detailDataPasienRencanaPulang {
  id?: number,
  no_mrs?: number,
  nama_lengkap?: string,
  no_rm?: number,
  rencana_pulang?: string,
  kamar?: string,
  kelas?: string,
  status ?: string,
  umur?: string,
  sex?: string,
  kecamatan?: string,
  tanggal_mrs ?: string,
  ICD?: string,
  diagnosa_utama?: string,
  penyakit?: string,
  asuransi?: string,
  instansi?: string,
  admission?: string
};

export default class dataDiet {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPasienRencanaPulang> = []
}
