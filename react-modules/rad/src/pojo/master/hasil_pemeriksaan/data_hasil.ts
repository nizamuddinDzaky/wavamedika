import Metadata from "../../Metadata";

export interface detailHasilPemeriksaan {
  id?: number,
  kategori?: string,
  jenis_hasil?: string,
  diagnosa_klinis?: string,
  kesimpulan?: string
};

export default class dataHasil {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailHasilPemeriksaan> = []
}
