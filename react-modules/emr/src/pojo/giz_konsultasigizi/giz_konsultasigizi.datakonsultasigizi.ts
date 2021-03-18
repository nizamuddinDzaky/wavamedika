import Metadata from "../Metadata";

// interface detail {
//     id_transaksi: number;
//     tanggal: Date;
//     jam: Date;
//     uraian: string;
//     oleh: string;
//     qty: number;
//     nama_operator: string;
//     bayar?: string;
//     operator: number;
//     posting?: string;
// };

export default class dataKonsultasiGizi {
    metadata: Metadata = {
        err_code: 0,
        message: '',
        list_count: 0
    };
    list: Array<any> = []
}
