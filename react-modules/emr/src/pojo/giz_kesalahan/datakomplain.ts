import Metadata from "../Metadata";

export interface detailDataKomplain {
  id_kesalahan: number,
  id_jnskaryawan: number,
  bulan: number,
  tahun: number,
  k01: string,
  k02: string,
  k03: string,
  k04: string,
  k05: string,
  k06: string,
  k07: string,
  k08: string,
  k09: string,
  k10: string,
  k11: string,
  k12: string,
  k13: string,
  k14: string,
  k15: string,
  k16: string,
  k17: string,
  k18: string,
  k19: string,
  k20: string,
  k21: string,
  k22: string,
  k23: string,
  k24: string,
  k25: string,
  k26: string,
  k27: string,
  k28: string,
  k29: string,
  k30: string,
  k31: string,
  operator: number,
  tgl_input: Date,
  editor?: any,
  updated?: any
};

export default class dataKomplain {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataKomplain> = []
}
