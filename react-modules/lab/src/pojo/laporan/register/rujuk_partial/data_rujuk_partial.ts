import Metadata from "../../../Metadata";

export interface detailDataRujukPartial {
  id?: number,
  tanggal?: string,
  no_rm?: string,
  no_mrs?: string,
  no_lab?:number,
  nama_pasien?: string,
  sex?: string,
  umur ?:number,
  alamat?:string,
  pemeriksaan?: string,
  jumlah ?: number,
  nama_unit?: string,
  asuransi?:string,
  rujuk_partial?:string
};

export default class dataRujukPartial {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataRujukPartial> = []
}
