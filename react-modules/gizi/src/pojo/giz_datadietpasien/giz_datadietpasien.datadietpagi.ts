import Metadata from "../Metadata";

// interface detail {
//     rekapitulasi: string,
//     jml: string
// };

export default class dataDietPagi {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ''
    };
    list: Array<any> = []
}
