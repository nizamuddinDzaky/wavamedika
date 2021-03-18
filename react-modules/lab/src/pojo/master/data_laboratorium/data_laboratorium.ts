import Metadata from "../../Metadata";

export interface detailDataLaboratorium {
  id?: number,
  kode_tarif?: string,
  nama_pemeriksaan?: string,
  jenis?: string,
  golongan?: string,
  specimen?: string,
  rujuk_ke?: string,
  bahan?: string,
  hari_kerja?: string,
  waktu_hasil?: string,
  waktu_hari?: number,
  vvip?: number,
  vvipb?: number,
  vipa?: number,
  vipb?: number,
  vip?: number,
  vipc?: number,
  utama?: number,
  i?: number,
  ia?: number,
  ib?: number,
  ii?: number,
  iia?: number,
  iib?: number,
  iii?: number,
  bpjs_vip?: number,
  bpjs_1?: number,
  bpjs_2?: number,
  bpjs_3?: number,
  biaya?: string,
  sampel?: string,
  tarif_rujukan?: number,
};

export default class dataLaboratorium {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataLaboratorium> = []
}
