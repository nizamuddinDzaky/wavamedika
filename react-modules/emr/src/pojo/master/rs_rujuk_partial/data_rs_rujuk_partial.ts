import Metadata from "../../Metadata";

export interface detailDataRsRujukPartial {
  id?: number,
  nama_rs?: string,
  status?: boolean
};

export default class dataDiet {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataRsRujukPartial> = []
}
