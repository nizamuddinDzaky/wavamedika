import Metadata from "../Metadata";

export interface detail {
  dokter?: number,
  tanggal?: string,
};

export default class noantri {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
