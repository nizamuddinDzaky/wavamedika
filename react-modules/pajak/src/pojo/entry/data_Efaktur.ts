import Metadata from "../Metadata";

export interface detailDataEfaktur {
  id?: number,
  tanggal?: string,
  jenis?: string,
  no_bukti?: string,
  supplier?: string,
  faktur?: number,
  npwp?:string,
  jumlah?: number,
  ppn?: number,
  invoice?: string,
  efaktur?: string
};

export default class dataEfaktur {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataEfaktur> = []
}
