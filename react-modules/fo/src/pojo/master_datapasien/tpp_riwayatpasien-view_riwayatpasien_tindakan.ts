import Metadata from "../Metadata";

export interface detail {
  id_transaksi: number,
  tanggal: string,
  jam: string,
  uraian: string,
  oleh: any,
  qty: number,
  operator: number,
  bayar: any,
  panggilan: any,
  jenis_billing: any,
  jumlah: string
};

export default class view_riwayatpasien_tindakan {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
