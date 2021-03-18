import Metadata from "../../Metadata";

export interface detailDataWaktuTunggu {
  id?: number,
  tanggal?: string,
  no_mrs?: string,
  nama_pasien?: string,
  tanggal_mrs?: string,
  no_reg?:string,
  no_lab?:string,
  sex_pasien?: string,
  jenis?: string,
  jam_datang?: string,
  jam_selesai?: string,
  lama_periksa?: string,
  golongan?: string,
  pemeriksaan?: string,
  nama_unit?: string,
  rujuk?: string,
};

export default class dataWaktuTunggu {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataWaktuTunggu> = []
}
