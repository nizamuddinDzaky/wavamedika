import Metadata from "../../Metadata";

export interface detailDataGolonganDarah {
  id?: number,
  nama_golonganDarah?: string,
  aktif?: boolean,
};


export default class listDataGolonganDarah {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataGolonganDarah> = []
}
