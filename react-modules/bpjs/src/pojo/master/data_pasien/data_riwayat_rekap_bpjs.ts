import Metadata from "../../Metadata";

export interface detailDataRiwayatRekap {
  id?: number,
  rekap?: string,
  jml?: string,
};

export default class dataRiwayatRekap {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataRiwayatRekap> = []
}
