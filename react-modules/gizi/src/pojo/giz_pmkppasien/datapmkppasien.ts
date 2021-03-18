import Metadata from "../Metadata";

export interface detailPMKPPasien {
  id_indikatorpasien?: number,
  id_mrs?: number,
  id_unit?: number,
  tgl_input?: string,
  indikator_unit?: string,
  pilihan?: any,
  verif?: any
};

export default class dataPmkpPasien {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailPMKPPasien> = []
}
