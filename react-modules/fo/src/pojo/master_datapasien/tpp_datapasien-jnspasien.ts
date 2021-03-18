import Metadata from "../Metadata";

export interface detail {
  id_jnspasien?: string,
  jenis_pasien?: string,
};

export default class jnspasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
