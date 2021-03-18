import Metadata from "../../Metadata";

export interface detailDataKondisiSampel {
  id?: number,
  tanggal?: string,
  no_mrs?: string,
  nama_pasien?: string,
  tanggal_mrs?: string,
  no_reg?:string,
  sex_pasien?: string,
  gol_periksa?:string,
  kondisi_sampel?:string,
  nama_unit?:string,
};

export default class dataKondisiSampel {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataKondisiSampel> = []
}
