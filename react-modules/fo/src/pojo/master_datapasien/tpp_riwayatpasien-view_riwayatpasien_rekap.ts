import Metadata from "../Metadata";

export interface detail {
  rekapitulasi: string,
  jumlah: number
};

export default class view_riwayatpasien_rekap {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
