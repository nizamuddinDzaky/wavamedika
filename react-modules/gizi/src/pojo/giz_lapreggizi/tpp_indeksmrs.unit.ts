import Metadata from "../Metadata";

export interface detailIndeksMRS {
    nama_unit: string,
    u: string
};

export default class indeksMRS {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        message: ''
    };
    list: Array<detailIndeksMRS> = []
}
