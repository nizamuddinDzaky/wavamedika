import Metadata from "../Metadata";

export interface detail {
  kecamatan?: string
};

export default class kecamatanpx {
  metadata: Metadata = {
    err_code: 0,
    list_count: 22,
    message: ''
  };
  list: Array<detail> = []
}
