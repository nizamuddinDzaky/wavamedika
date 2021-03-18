import Metadata from "../Metadata";

export interface detail {
  id_instansi?: number,
  kode_instansi?: string,
  aktif?: string,
  nama_instansi?: string,
  alamat?: string,
  kota?: string,
  telp?: string,
  fax?: string,
  kontak?: string,
  hp?: string,
  catatan?: string,
  email?: string,
  website?: string,
  jenis?: string,
  operator?: number,
  tgl_input?: string,
  editor?: number,
  updated?: string,
  alamat_klaim?: string,
  masa_berlaku?: string
};

export default class masterinstansi {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ""
    };
    list: Array<detail> = []
}
