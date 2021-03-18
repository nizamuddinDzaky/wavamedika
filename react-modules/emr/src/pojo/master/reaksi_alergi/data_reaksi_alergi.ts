import Metadata from "../../Metadata";

export interface detailDataReaksiAlergi {
  id?: number,
  uraian?: string,
  aktif?:boolean,
};


export default class listDataReaksiAlergi {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataReaksiAlergi> = []
}
