import Metadata from "../../Metadata";

export interface detailDataPDPKasir {
  id?: number,
  tanggal?: string,
  no_invoice?: string,
  no_bill?: number,
  no_rm?: number,
  nama_pasien?: string,
  kamar?: string,
  ri_rj?: string,
  stat_kamar?: string,
  instansi?: string,
  admisi?: string,
  bpjs?: string,
  klaim_bpjs?: number,
  jam?: string,
  operator?: string,
  asuransi?: string,
  total?: number,
  lunas?:boolean,
};

export default class dataPDPKasir {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataPDPKasir> = []
}
