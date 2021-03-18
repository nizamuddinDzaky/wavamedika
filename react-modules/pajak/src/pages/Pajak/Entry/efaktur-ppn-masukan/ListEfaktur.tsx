import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
import MRSService from "../../../../services/MRS.service";
import {detailDataEfaktur} from "../../../../pojo/entry/data_Efaktur";
import moment from "moment";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";

interface IProps {
    hidePagination?: boolean;
    toolbar?: any;
    selectionMode?: string;
    onSelect?: (params: detailDataEfaktur) => void;
    onDoubleClickCell?: () => void
}

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [

    {
        id: 'tanggal',
        title: 'tanggal',
        width: '7%',
        align: 'left',
        editable: false,
        editor: ({ row,error }: any) => (
          <>
                <TextBox value={row?.tanggal}></TextBox>
           </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'jenis',
        title: 'jenis',
        width: '8%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.jenis}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'no_bukti',
        title: 'Nomor Bukti',
        width: '10%',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.no_bukti}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'supplier',
        title: 'Supplier',
        width: '20%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.supplier}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'faktur',
        title: 'Faktur',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.faktur}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.faktur}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'ppn',
        title: 'PPn',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <NumberBox tabIndex="3"
                        value={row?.ppn}/>
            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'invoice',
        title: 'No Invoice Hutang',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.invoice}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'npwp',
        title: 'NPWP',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.npwp}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'efaktur',
        title: 'No eFaktur',
        width: '10%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.efaktur}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
        
];


const ListEfaktur: React.FC<IProps> = (props: IProps) => {
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
        {
            id: 2,
            tanggal: '01-02-2020',
            jenis: 'EMR',
            no_bukti: '0122214',
            supplier: 'Phoparos',
            faktur: 18000,
            jumlah: 20000,
            ppn:1000,
            invoice:'IN123455555',
            npwp: '1234321456',
            efaktur: 'E12389884',
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataEfaktur>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataEfaktur>({});

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

    const onSelectionChange = useCallback((e: detailDataEfaktur) => {
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
                title={'PPn Masukan'}
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

export default ListEfaktur;
