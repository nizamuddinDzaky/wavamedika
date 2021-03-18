import Metadata from "../Metadata";

export interface detailDataMRSPMKP {
  id_mrs: number,
  no_mr: string,
  nama_lengkap: string,
  sex: string,
  umur: string,
  kecamatan: string,
  id_kamar: number,
  nama_kamar: string,
  id_unit?: number
};

export default class dataMRS {
    metadata: Metadata = {
        err_code: 0,
        message: '',
        list_count: 0
    };
    list: Array<detailDataMRSPMKP> = []
}
