import Metadata from "../../Metadata";

export interface detailKaryawan {
  id_karyawan: number,
  nama: string
};

export default class listKaryawan {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailKaryawan> = []
}
