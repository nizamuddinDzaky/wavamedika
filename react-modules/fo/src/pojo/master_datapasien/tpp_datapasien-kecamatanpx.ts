import Metadata from "../Metadata";

export interface detail {
  k1?: string,
  k2?: string,
};

export default class kecamatanpx {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
