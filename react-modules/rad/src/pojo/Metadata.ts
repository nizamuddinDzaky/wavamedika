export default interface Metadata {
    message?: string;
    response_status?: number; // kalau ada ? berarti not required
    current_page?: number;
    total_page?: number;
    total_row_current_page?: number;
    total_data?: number;
}
