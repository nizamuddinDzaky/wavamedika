import Metadata from "../Metadata";

export interface detailDataTarif {
    id_tarif: number,
    uraian: string,
    id_jnsbiaya: number,
    jenis: string,
    depo: number

};

export default class listDataTarif {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataTarif> = []
}
