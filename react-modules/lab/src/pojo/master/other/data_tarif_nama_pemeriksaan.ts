import Metadata from "../../Metadata";

export interface detailDataTarifNamaPemeriksaan {
  id_tarif?: number,
  nama_pemeriksaan?: string
};

export default class listTarifNamaPemeriksaan {
    metadata: Metadata = {
      message: '',
      response_status: 0,
      current_page: 1,
      total_page: 0,
      total_row_current_page: 0,
      total_data: 0,
    };
    list: Array<detailDataTarifNamaPemeriksaan> = []
}
