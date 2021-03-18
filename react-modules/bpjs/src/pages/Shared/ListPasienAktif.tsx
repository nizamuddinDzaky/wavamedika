import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../components/Table/Table";
import Metadata from "../../pojo/Metadata";
import MRSService from "../../services/MRS.service";
import {detailMRS} from "../../pojo/MRS";
import moment from "moment";


interface IProps {
    hidePagination?: boolean;
    toolbar?: any;
    selectionMode?: string;
    onSelect?: (params: detailMRS) => void;
    onDoubleClickCell?: () => void
}


const tindakanColumn = [
    {
        id: 'id_mrs',
        title: 'No MRS',
        width: "18px",
    },
    {
        id: 'tgl_mrs',
        title: 'Tanggal MRS',
        width: "18px",
    },
    {
        id: 'no_mr',
        title: 'No MR',
        width: "18px",
    },
    {
        id: 'nama_lengkap',
        title: 'Nama Lengkap',
        width: "30px",
    },
    {
        id: 'status',
        title: 'Status',
        width: "15px",
    },
    {
        id: 'sex',
        title: 'Sex',
        width: "8px",
    },
    {
        id: 'umur',
        title: 'Umur',
        width: "20px",
    },
    {
        id: 'kamar',
        title: 'Ruang',
        width: "20px",
    },
    {
        id: 'kelas',
        title: 'Kelas',
        width: "20px",
    },
    {
        id: 'kecamatan',
        title: 'Kecamatan',
        width: "25px",
    },
    {
        id: 'keluarga',
        title: 'Keluarga',
        width: "15px",
    }

];


const ListPasienAktif: React.FC<IProps> = (props: IProps) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailMRS>>([]);
    const [meta, setMeta] = useState<Metadata>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    const [selection, setSelection] = useState();

    const getListMRS = async () => {
        try {
            setLoading(true);
            const resp = await MRSService.getListMRS();
            resp.list.map((element) => {
                element.tgl_mrs = moment(element.tgl_mrs).format('DD/MM/YYYY');
                return element
            })

            setData(resp.list);
            setMeta(resp.metadata);
            setLoading(false);

        } catch (e) {
            console.log(e);
            setLoading(false);
        }
    };

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.setPageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListMRS();
        }
    };

    const onSelectionChange = useCallback((e: detailMRS) => {
        setSelection(e);

        if(props.onSelect) {
            props.onSelect(e);
        }
    }, [props]);

    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            getListMRS();
        }
    }, []);

    return(
        <>
            <Table
                title={'Daftar Pasien Yang Masuk Rumah Sakit'}
                columns={tindakanColumn}
                data={data}
                loading={loading}
                toolbar={props.toolbar}
                isPaginate={!hidePagination}
                total={meta.list_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                selectionMode={props.selectionMode}
                selection={selection}
                onSelectionChange={onSelectionChange}
                onDoubleClickCell={props.onDoubleClickCell}
                height={400}
            />
        </>
    )
};

export default ListPasienAktif;
