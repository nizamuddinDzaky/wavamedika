import Metadata from "../../Metadata";

export interface detailDataDaftarPasien {
  id?: number,
  tanggal?: string,
  no_mrs?: number,
  no_billing?: number,
  nama_pasien?: string,
  no_rm?: number,
  sex?: string,
  tanggal_lahir?: string,
  umur ?: number,
  alamat ?: string,
  nama_pemeriksaan ?: string,
  pemeriksaan ?: string,
  golongan ?: string,
  unit ?: string,
  rujuk ?: string,
  kategori_film ?: string,
  penggunaan_film ?: string,
  kv ?: number,
  mas ?: number,
  diagnosa ?: string,
  hasil_baca ?: string,
  dokter ?: string,
  asuransi ?: string,
  pembayaran ?: string,
  jam_input ?: string,
  jam_baca ?: string,
};


export default class listDataDaftarPasien {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataDaftarPasien> = []
}
