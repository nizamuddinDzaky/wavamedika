import Metadata from "../../Metadata";

export interface detailDataRegister {
    id?: number,
    nama_pasien?: string,
    no_rm?: string,
    tgl_lhr_pasien?: string,
    no_billing?: string,
    no_bpjs?: string,
    no_sjp_sep?: string,
    jatah_kelas?: string,
    tgl_mrs?: string,
    tgl_krs?: string,
    sex_pasien?: string,
    kamar?: string,
    kelas?: string,
    jpf?: string,
    nama_dokter?: string,
    keadaan_out?: string,
    berat_lhr?: string,
    kd_ina_cbg?: string,
  };
  
  export default class dataRegister {
      metadata: Metadata = {
          err_code: 0,
          list_count: 0
      };
      list: Array<detailDataRegister> = []
  }