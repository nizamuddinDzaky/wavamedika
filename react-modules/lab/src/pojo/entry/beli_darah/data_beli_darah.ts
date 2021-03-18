import Metadata from "../../Metadata";

export interface detailBeliDarah {
    id?: number;
    tgl?: string;
    jam?: string;
    jenis_tarif?: string;
    jenis_transfusi?: string;
    qty?: number;
    jumlah?: string;
    golda?: string;
    oleh?: string;

};

export default class dataBeliDarah {
    metadata: Metadata = {
        message: '',
        response_status: 0,
        current_page: 1,
        total_page: 0,
        total_row_current_page: 0,
        total_data: 0,
    };
    list: Array<detailBeliDarah> = []
}
