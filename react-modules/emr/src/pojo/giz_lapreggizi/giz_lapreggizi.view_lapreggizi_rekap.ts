import Metadata from "../Metadata";

export interface detailRekapitulasiGizi {
    rekapitulasi: string,
    jml: string
};

export default class viewLapRegGiziRekap {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0,
        row_count: 0
    };
    list: Array<detailRekapitulasiGizi> = []
}
