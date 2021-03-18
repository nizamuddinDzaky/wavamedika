import React, {useEffect, useRef, useState} from 'react';
// import kesalahanService from '../../../services/giz_kesalahan.service';
import {getDaysArray} from "../../../../utils/date.utils";
import Table from "../../../../components/Table/Table";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, NumberBox, Tooltip} from "rc-easyui";
import customForm from "../../../../assets/js/customForm";
import CustomDialog from "../../../../components/Dialog/CustomDialog";
import {NotifySuccess} from "../../../../services/notification.service";
import FormControlLabel from "@material-ui/core/FormControlLabel/FormControlLabel";
import Switch from "@material-ui/core/Switch/Switch";
import {  detailDataPPnKeluaran } from '../../../../pojo/laporan/data_PPnKeluaran';
import moment from "moment";

interface Props {
    month?: number;
    year?: number;
    hidePagination?: boolean;
}

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [

    {
        id: 'tanggal',
        title: 'Tanggal',
        width: '10%',
        align: 'center',
        editable: false,
        editor: ({ row,error }: any) => (
            <>
                <TextBox tabIndex="3"
                        value={row?.tanggal}/>
            </>
        ),
        editRules: ['required'],
    
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: '20%',
        align: 'center',
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
        id: 'keterangan',
        title: 'Keterangan',
        width: '20%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                          value={row?.keterangan}/>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: '20%',
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
    {
        id: 'ppn',
        title: 'PPn Keluaran',
        width: '20%',
        align: 'left',
        editable: false,
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
        
];


const DataKeterangan: React.FC<Props> = (props: Props) => {

    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            tanggal: '01-01-2020',
            jenis: 'Golda',
            no_bukti: '0123894',
            keterangan: 'Kimia Farma',
            faktur: 14000,
            jumlah: 15000,
            ppn:1000,
            invoice:'IN12345678',
            npwp: '1234568789',
            efaktur: 'E12345678',
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataPPnKeluaran>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataPPnKeluaran>({});

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
                title={'Data Keterangan'}
                columns={tindakanColumn}
                disableNumber
                filterable={true}
                data={data}
                loading={loading}
                isPaginate={!hidePagination}
                total={meta.list_count}
                pageNumber={pageNumber}
                pageSize={pageSize}
                onTableAction={onTableAction}
                selection={selection}
                height={400}
            />
        </>
    )

};

export default DataKeterangan;
