export default interface Metadata {
    err_code?: number;
    message?: string;
    list_count?: number; // kalau ada ? berarti not required
    row_count?: number;
}
