import Metadata from "../Metadata";

export interface detail {
  k1?: string,
  k2?: string,
};

export default class kabupatenpx {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
