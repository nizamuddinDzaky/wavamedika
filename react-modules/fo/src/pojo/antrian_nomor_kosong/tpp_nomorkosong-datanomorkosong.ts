import Metadata from "../Metadata";

export interface detail {
  id_antrian?: number,
  dokter?: string,
  antri?: number
};

export default class datanomorkosong {
  metadata: Metadata = {
    err_code: 0,
    list_count: 38,
    message: ''
  };
  list: Array<detail> = []
}
