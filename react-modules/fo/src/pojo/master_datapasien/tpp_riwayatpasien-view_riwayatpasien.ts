import Metadata from "../Metadata";

export interface detail {
  id_regunit: number,
  tgl_masuk: string,
  tgl_krs: string,
  cara_masuk: string,
  diagnosa: string,
  dokter: string,
  kunjungan: string,
  kunjungan_unit: string,
  kunjungan_kasus: string,
  unit: string,
  id_mrs: number,
  tindak_lanjut: any,
  keadaan_keluar: any,
  kamar: string,
  catatan_diagnosa: string,
  lengkap: string,
  pembayaran: string,
  stat_awal: string,
  stat_akhir: string,
  icd: any,
  asuransi: string,
  instansi: string,
  admission: string,
  dx_emr: string,
  nama_perujuk: string,
  jenis_perujuk: string
};

export default class view_riwayatpasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
