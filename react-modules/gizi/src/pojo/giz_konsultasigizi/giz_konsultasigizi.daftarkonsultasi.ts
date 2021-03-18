import Metadata from "../Metadata";

export interface detailDaftarKonsultasi {
    id_jnsgizi?: number;
    gizi?: string;
};

export default class dataDaftarKonsultasi {
    metadata: Metadata = {
        err_code: 0,
        message: '',
        list_count: 0
    };
    list: Array<detailDaftarKonsultasi> = []
}
