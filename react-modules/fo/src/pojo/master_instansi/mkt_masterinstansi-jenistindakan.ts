import Metadata from "../Metadata";

export interface detail {
  jenis?: string
};

export default class jenistindakan {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detail> = []
}
