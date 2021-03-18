import Metadata from "../Metadata";

export interface detail {
  id_rencanakontrol?: number,
  id_mrs?: number,
  id_mr?: number,
  id_kamar?: number,
  tgl_rencana?: string,
  hari?: string,
  jam?: string,
  poli?: number,
  dokter?: number,
  keterangan?: string,
  operator?: number,
  tgl_input?: string,
  kontrol?: string,
  id_regunit?: number,
  hari_kontrol?: string,
  no_antri?: number,
  operator_kontrol?: number,
  tgl_inputkontrol?: string,
  stat_berkas?: string,
  tgl_berkas?: string,
  operator_berkas?: number,
  kelas?: any,
  no_update?: any,
  isi_sms?: string,
  tanggal_sms?: string,
  operator_sms?: string,
  tgl_sms?: string,
  petugas_sms?: any,
  op_sms?: any,
  tgl_inputsms?: string
};

export default class datarencanakontrol {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
