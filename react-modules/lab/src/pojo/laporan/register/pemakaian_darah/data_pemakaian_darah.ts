import Metadata from "../../../Metadata";

export interface detailDataPemakaianDarah {
  id?: number,
  tanggal?: string,
  no_rm?: string,
  nama_pasien?: string,
  no_mrs?: string,
  jumlah ?: number,
  total_harga ?: number,
  pemeriksaan?: string,
  operator ?: string,
  transfusi ?:string,
  golongan_darah?: string,
  nama_unit?: string,
  cara_masuk ?: string,
  reaksi_alergi ?:string,
  batal_beli?:string
};

export default class dataPemakaianDarah {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPemakaianDarah> = []
}
