import Metadata from "../../Metadata";

export interface detailDataRekap {
  id?: number,
  nama_rekap?: string,
  jumlah?: number,
  
};

export default class dataRekap {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataRekap> = []
}
