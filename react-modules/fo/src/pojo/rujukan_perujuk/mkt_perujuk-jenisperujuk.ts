import Metadata from "../Metadata";

export interface detail {
  nama_perujuk?: string,
  kode_p?: string
};

export default class jenisperujuk {
  metadata: Metadata = {
    err_code: 0,
    list_count: 7
  };
  list: Array<detail> = []
}
