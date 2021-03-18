import Metadata from "../Metadata";

export interface detailListTransaction {
    id_transaksi: number;
    uraian: string;
    oleh: string;
    qty: number;
    tanggal?: string;
    jam?: string;
    nama_operator?: string;
    bayar?: string;
    operator?: number;
    posting?: string;
};

export default class listTransaction {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailListTransaction> = []
}
