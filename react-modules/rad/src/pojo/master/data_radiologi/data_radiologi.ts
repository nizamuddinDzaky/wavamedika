import Metadata from "../../Metadata";

export interface detailDataRadiologi {
  id?: number,
  nama_pemeriksakan?: string,
  status?: boolean,
  jenis?: string,
  golongan?: string,
  kode?: string,
  vvip?:number,
  vip?: number,
  vipb?: number,
  i?: number,
  ia?: number,
  ib?: number,
  ii?: number,
  iia?: number,
  iib?: number,
  iii?: number,
  iiia?: number,
  iiib?: number,
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
    list: Array<detailDataRadiologi> = []
}
