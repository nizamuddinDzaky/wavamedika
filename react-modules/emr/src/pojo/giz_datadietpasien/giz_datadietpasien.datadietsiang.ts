import Metadata from "../Metadata";

// interface detail {
//     rekapitulasi: string,
//     jml: string
// };

export default class dataDietSiang {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ''
    };
    list: Array<any> = []
}
