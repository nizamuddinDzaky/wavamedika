import Metadata from "../../Metadata";

export interface detailDataPemeriksaanLab {
  id?: number,
  nama_pemeriksaan?: string,
  qty?: number
};

export default class dataPemeriksaan {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataPemeriksaanLab> = []
}
