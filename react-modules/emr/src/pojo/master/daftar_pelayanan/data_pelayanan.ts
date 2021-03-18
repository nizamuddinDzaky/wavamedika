import Metadata from "../../Metadata";

export interface detailDataPelayanan {
  id?: number,
  nama_layanan?: string,
  metode?: string
};

export default class dataDiet {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataPelayanan> = []
}
