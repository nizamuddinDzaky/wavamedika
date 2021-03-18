import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
// import MRSService from "../../../../services/MRS.service";
import moment from "moment";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import { detailMRS} from '../../../../pojo/entry/tindak_lanjut/MRS';

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
        title: 'No.MRS',
        width: '100px',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <TextBox tabIndex="3"
                        value={row?.id_mrs}/>
            </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'tgl_mrs',
        title: 'Tgl.MRS',
        width: '100px',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <TextBox tabIndex="3"
                        value={row?.tgl_MRS}/>
            </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'no_rm',
        title: 'Np.MR',
        width: '100px',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.no_rm}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    
    },
    {
        id: 'nama_lengkap',
        title: 'Nama Lengkap',
        width: '150px',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <TextBox tabIndex="3"
                        value={row?.nama_lengkap}/>
            </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'sex',
        title: 'Sex',
        width: '100px',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <TextBox tabIndex="3"
                        value={row?.sex}/>
            </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'status',
        title: 'Status',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.status}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'kamar',
        title: 'Kamar',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.kamar}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'umur',
        title: 'Umur',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.umur}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'kecamatan',
        title: 'Kecamatan',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.kecamatan}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
        
];


const ListPasien: React.FC<IProps> = (props: IProps) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id_mrs: 200612493,
            tgl_mrs: '01-01-2020',
            no_rm: 62000783,
            nama_lengkap: 'DJUMAIAYH, Ny.',
            sex: 'P',
            kelas: 'Atas',
            ruang: 'III/A',
            status: '',
            umur: 47 ,
            kecamatan:'Dampit',
            alamat:'Jln. Sidoarjo Tengah',
            kamar: 'Radiologi',
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailMRS>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailMRS>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    
    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

    const getListMRS = async () => {
        try {
            setLoading(true);
            // const resp = await MRSService.getListMRS();
            // resp.list.map((element) => {
            //     element.tgl_mrs = moment(element.tgl_mrs).format('DD/MM/YYYY');
            //     return element
            // })

            // setData(resp.list);
            // setMeta(resp.metadata);
            // setLoading(false);

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
            // getListMRS();
        }
    };


    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            // getListMRS();
        }
    }, []);

    return(
        <>
            <Table
                title={'Pajak Karyawan'}
                columns={tindakanColumn}
                disableNumber
                filterable={true}
                data={data}
                loading={loading}
                toolbar={props.toolbar}
                isPaginate={!hidePagination}
                // total={meta.list_count}
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

export default ListPasien;
