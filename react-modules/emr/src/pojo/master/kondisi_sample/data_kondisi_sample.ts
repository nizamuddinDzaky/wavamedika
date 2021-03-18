import Metadata from "../../Metadata";

export interface detailDataKondisiSample {
  id?: number,
  uraian?: string,
  aktif?:boolean,
};


export default class listDataKondisiSample {
    metadata: Metadata = {
        err_code: 0,
        list_count: 0
    };
    list: Array<detailDataKondisiSample> = []
}
