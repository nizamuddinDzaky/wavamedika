import Metadata from "../Metadata";

export interface detail {
  kecamatan?: string
};

export default class kecamatan {
  metadata: Metadata = {
    err_code: 0,
    list_count: 10
  };
  list: Array<detail> = []
}
