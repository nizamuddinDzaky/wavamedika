import Metadata from "../../Metadata";

export interface detailDataPasienLab {
  id?: number,
  nomor_rm?: string,
  nama_lengkap?: string,
  sex?: string,
  umur?: string,
  desa?: string,
  kecamatan?: string,
  tmp_lahir?: string,
  tgl_lahir?: string,
  telepon?: string,
  catatan?: string,
  riwayat?: Array<number>
};

export default class dataPasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataPasienLab> = []
}
