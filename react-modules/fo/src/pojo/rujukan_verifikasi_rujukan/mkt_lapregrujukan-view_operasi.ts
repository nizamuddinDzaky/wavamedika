import Metadata from "../Metadata";

// export interface detail {
//   list: Array<detail> = []
// };

export default class view_operasi {
  metadata: Metadata = {
    err_code: 1,
    message: '',
    list_count: 0
  };
  list: Array<any> = []
}
