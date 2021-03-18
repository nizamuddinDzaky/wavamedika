import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
import MRSService from "../../../../services/MRS.service";
import {detailMRS} from "../../../../pojo/entry/beli_darah/data_pasien_mrs";
import moment from "moment";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";

interface IProps {
    hidePagination?: boolean;
    toolbar?: any;
    selectionMode?: string;
    onSelect?: (params: detailMRS) => void;
    onDoubleClickCell?: () => void
}

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'id_mrs',
        title: 'No MRS',
        width: "18px",
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'tgl_mrs',
        title: 'Tanggal MRS',
        width: "18px",
    },
    {
        id: 'no_mr',
        title: 'No MR',
        width: "16px",
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
        align: 'center'
    },
    {
        id: 'umur',
        title: 'Umur',
        width: "17px",
        align: 'center',
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'kamar',
        title: 'Ruang',
        width: "25px",
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

    const dataDummy = [
        {
            id_mrs: 112355,
            tanggal: '01-01-2020',
            tgl_mrs: '01-01-2020',
            no_mr:200700001,
            kelas:'12011233',
            nama_lengkap:'THAARIQ FAJRA M., An',
            sex:'L',
            umur:'12',
            status:'Rutin',
            kamar:'Klinik Bedah Umum',
            kecamatan:'Gedangan',
            keluarga:'Besar'
        },
        {
            id_mrs: 112234,
            tanggal: '01-01-2020',
            tgl_mrs: '04-01-2020',
            no_mr:155200001,
            kelas:'32211233',
            nama_lengkap:'ATURASU SUMAKU., An',
            sex:'L',
            umur:'45',
            status:'Rutin',
            kamar:'Klinik Bedah Umum',
            kecamatan:'Taman',
            keluarga:'Besar'
        },
        {
            id_mrs: 112889,
            tanggal: '01-01-2020',
            tgl_mrs: '16-01-2020',
            no_mr:516400001,
            kelas:'88441233',
            nama_lengkap:'VARIRU SPLAS., An',
            sex:'L',
            umur:'20',
            status:'Rutin',
            kamar:'Klinik Bedah Umum',
            kecamatan:'Sepanjang',
            keluarga:'Besar'
        },
        {
            id_mrs: 112086,
            tanggal: '01-01-2020',
            tgl_mrs: '22-01-2020',
            no_mr:985200001,
            kelas:'12018911',
            nama_lengkap:'GOODIE BAGGU., An',
            sex:'L',
            umur:'15',
            status:'Rutin',
            kamar:'Klinik Bedah Umum',
            kecamatan:'Sedati',
            keluarga:'Besar'
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailMRS>>(dataDummy);
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

    const onSelectionChange = useCallback((e: detailMRS) => {
        setSelection(e);

        if(props.onSelect) {
            props.onSelect(e);
        }
    }, [props]);

    const onTableAction = (e: any) => {
        setPageSize(e?.pageSize);
        setPageNumber(e?.setPageNumber);


        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            getListMRS();
        }
    };


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
                disableNumber
                filterable={true}
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
