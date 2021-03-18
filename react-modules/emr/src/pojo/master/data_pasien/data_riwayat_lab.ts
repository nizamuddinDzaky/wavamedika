import Metadata from "../../Metadata";

export interface detailDataRiwayatLab {
  id?: number,
  nomor_mrs?: string,
  tgl_mrs?: string,
  unit?: string,
  pembayaran?: string
};

export default class dataRiwayat {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataRiwayatLab> = []
}
