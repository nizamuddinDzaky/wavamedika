export default interface Metadata {
    err_code?: number;
    message?: string;
    response_status?: number; // kalau ada ? berarti not required
    current_page?: number;
    list_count?: number;
    total_page?: number;
    total_row_current_page?: number;
    total_data?: number;
}
