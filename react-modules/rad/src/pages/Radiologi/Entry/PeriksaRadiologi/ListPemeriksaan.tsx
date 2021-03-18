import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../../../../rad/src/components/Table/Table";
import Metadata from "../../../../../../rad/src/pojo/Metadata";
// import MRSService from "../../../../services/MRS.service";
import moment from "moment";
import {LinkButton, TextBox, Tooltip, NumberBox, CheckBox} from "rc-easyui";
import { detailDataPeriksaRadiologi } from '../../../../pojo/entry/periksa_radiologi/data_periksa_radiologi';

interface IProps {
    hidePagination?: boolean;
    toolbar?: any;
    selectionMode?: string;
    onSelect?: (params: detailDataPeriksaRadiologi) => void;
    onDoubleClickCell?: () => void
}

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [

    {
        id: 'pemeriksaan',
        title: 'Pemeriksaan',
        width: '15%',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <TextBox tabIndex="3"
                        value={row?.pemeriksaan}/>
            </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'cito',
        title: 'Cito',
        width: '7%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                    <CheckBox
                          value={row?.cito}/>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'no_reg',
        title: 'Sex',
        width: '15%',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <NumberBox
                          value={row?.no_reg}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'rujuk',
        title: 'Rujuk Ke',
        width: '15%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.rujuk}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: '15%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.jenis}/>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'qty',
        title: 'Qty',
        width: '8%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.qty}/>
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
        id: 'harga',
        title: 'Harga',
        width: '15%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.harga}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: '15%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.jumlah}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
        
];


const ListPemeriksaan: React.FC<IProps> = (props: IProps) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataPeriksaRadiologi>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataPeriksaRadiologi>({});

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

    const onSelectionChange = useCallback((e: detailDataPeriksaRadiologi) => {
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
                title={'Pemeriksaan'}
                columns={tindakanColumn}
                disableNumber
                data={data}
                loading={loading}
                toolbar={props.toolbar}
                isPaginate={!hidePagination}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                selectionMode={props.selectionMode}
                selection={selection}
                onSelectionChange={onSelectionChange}
                onDoubleClickCell={props.onDoubleClickCell}
                minHeight={300}
            />
        </>
    )
};

export default ListPemeriksaan;
