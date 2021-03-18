import Metadata from "../../Metadata";

export interface detailDataPenggunaanFilm {
  id?: number,
  jns_rad?: string,
  film?: string,
};

export default class listDataPenggunaanFilm {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataPenggunaanFilm> = []
}
