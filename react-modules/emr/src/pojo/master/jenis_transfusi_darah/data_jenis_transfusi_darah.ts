import Metadata from "../../Metadata";

export interface detailDataJenisTransfusiDarah {
  id?: number,
  nama_jenis_td?: string,
  status?: boolean
};

export default class dataDiet {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataJenisTransfusiDarah> = []
}
