import Metadata from "../Metadata";

export interface detail {
  id_mr: number,
  no_mr: number,
  nama_lengkappx: string
};

export default class view_datapasien_riwayat {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
