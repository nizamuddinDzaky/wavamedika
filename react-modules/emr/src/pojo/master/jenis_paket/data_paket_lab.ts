import Metadata from "../../Metadata";

export interface detailDataPaketLab {
  id?: number,
  nama_paket?: string,
  pemeriksaan?: Array<number>
};

export default class datapaket {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataPaketLab> = []
}
