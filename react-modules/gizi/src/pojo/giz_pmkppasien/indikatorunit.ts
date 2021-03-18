import Metadata from "../Metadata";

export interface detailIndikatorUnit {
  id_pmkp: number,
  indikator_sasaran: string
};

export default class indikatorUnit {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailIndikatorUnit> = []
}
