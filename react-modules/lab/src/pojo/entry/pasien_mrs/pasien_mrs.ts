import Metadata from "../../Metadata";

export interface detailDataPasienMRS {
    id?: number,
    tgl_mrs?: string,
    no_billing?: string,
    nama_pasien?: string,
    no_rm?: string,
    status?: string, // lunas/piutang
    kamar?: string,
    kelas?: string,
    jatah_kelas?: string,
    staus_kamar?: string,
    los?: string,
    nama_keluarga?: string,
    alamat_pasien?: string,
    sex_pasien?: string,
    umur_pasien?: number,
    admission?: string,
    instansi?: string,
    asuransi?: string,
  };
  
  export default class dataPasienMRS {
    metadata: Metadata = {
        message: '',
        response_status: 0,
        current_page: 1,
        total_page: 0,
        total_row_current_page: 0,
        total_data: 0,
      };
      list: Array<detailDataPasienMRS> = []
  }