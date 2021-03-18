import Metadata from "../Metadata";

export interface detailTindakan {
    id_tarif: number;
    uraian: string;
    id_jnsbiaya: number;
};

export default class listTindakan {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailTindakan> = []
}
