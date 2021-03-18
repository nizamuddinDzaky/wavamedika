import Metadata from "../Metadata";

export interface detail {
  jenis?: string
};

export default class jenisperujuk {
  metadata: Metadata = {
    err_code: 0,
    list_count: 12
  };
  list: Array<detail> = []
}
