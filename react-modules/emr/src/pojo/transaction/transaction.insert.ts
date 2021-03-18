import Metadata from "../Metadata_CUD";

interface detail {
    code: number;
};

export default class insertTransaction {
    metadata: Metadata = {
        error: false,
        code: 0,
        message: '',
        list_count: 0
    };
    list: Array<detail> = []
}
