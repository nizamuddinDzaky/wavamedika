import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
// import MRSService from "../../../../services/MRS.service";
import {detailDataNPWP} from "../../../../pojo/entry/data_NPWPKaryawan";
import moment from "moment";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";

interface IProps {
    hidePagination?: boolean;
    toolbar?: any;
    selectionMode?: string;
    onSelect?: (params: detailDataNPWP) => void;
    onDoubleClickCell?: () => void
}

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [

    {
        id: 'no_NPWP',
        title: 'NPWP',
        width: '15%',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.no_NPWP}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    
    },
    {
        id: 'nama_karyawan',
        title: 'Nama',
        width: '20%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.nama_karyawan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'sex_karyawan',
        title: 'Sex',
        width: '5%',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.sex_karyawan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'status_karyawan',
        title: 'Status',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.status_karyawan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'anak_karyawan',
        title: 'Anak',
        width: '8%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.anak_karyawan}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'jabatan_karyawan',
        title: 'Jabatan',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.jabatan_karyawan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'posisi_karyawan',
        title: 'Posisi',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.posisi_karyawan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'kode_PTKP',
        title: 'Kode PTKP',
        width: '7%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.posisi_karyawan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    
    {
        id: 'jumlah_PTKP',
        title: 'PTJP (Rp.)',
        width: '15%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.jumlah_PTKP}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
        
];


const ListKaryawan: React.FC<IProps> = (props: IProps) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            tanggal: '01-01-2020',
            jenis: 'Golda',
            no_bukti: '0123894',
            supplier: 'Kimia Farma',
            faktur: 14000,
            jumlah: 15000,
            ppn:1000,
            invoice:'IN12345678',
            npwp: '1234568789',
            efaktur: 'E12345678',
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataNPWP>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataNPWP>({});

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

    const onSelectionChange = useCallback((e: detailDataNPWP) => {
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

export default ListKaryawan;
