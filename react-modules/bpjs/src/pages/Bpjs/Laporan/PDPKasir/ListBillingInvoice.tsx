import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';
import moment from 'moment';
import { detailDataPDPKasir } from '../../../../pojo/laporan/pdp_kasir/data_pdp_kasir';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";

const operators = ["nofilter", "equal", "notequal", "less", "greater"];



const tindakanColumn = [
    {
        id: 'tanggal',
        title: 'Tanggal',
        width: '100px',
        align: 'center',
        editable: true,
        frozen:true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="1" autoFocus
                        value={row?.tanggal}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_rm',
        frozen:true,
        title: 'No.RM',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="2"
                        value={row?.no_rm}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_invoice',
        title: 'No.Invoice',
        width: '120px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.no_invoice}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_bill',
        title: 'No.Billing',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.no_bill}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'nama_pasien',
        title: 'Nama Pasien',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.nama_pasien}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_rm',
        title: 'No.RM',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.no_rm}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'kamar',
        title: 'Kamar Terakhir',
        width: '150px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.Kamar}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'ri_rj',
        title: 'RI/RJ',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.ri_rj}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'stat_kamar',
        title: 'Stat.Kamar',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.stat_kamar}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'asuransi',
        title: 'Asuransi',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.asuransi}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'instansi',
        title: 'Instansi',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.instansi}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'admisi',
        title: 'Admission',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.admisi}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'bpjs',
        title: 'BPSJ',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.bpjs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'klaim_bpjs',
        title: 'Klaim BPJS',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <NumberBox tabIndex="2"
                        value={row?.klaim_bpjs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'jam',
        title: 'Jam',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.jam}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'operator',
        title: 'Operator',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.no_rm}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'total',
        title: 'Jumlah (Rp.)',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <NumberBox tabIndex="3" 
                        value={row?.jumlah}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
];

interface IPropsListBillingInvoice {
    hidePagination?: boolean;
}

const ListBillingInvoice = (props: IPropsListBillingInvoice) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            tanggal: '01-01-2020',
            no_invoice:'INV-200700001',
            no_rm:12011233,
            no_bill:2002153,
            nama_pasien:'THAARIQ FAJRA M., An',
            ri_rj:'RI',
            kamar:'Kelas 1A 234 Bed A',
            bpjs:'trial',
            jam:'08:00',
            operator:'',
            stat_kamar:'Titipan',
            admisi:'',
            klaim_bpjs:40000,
            total:4000000,
            instansi:'BPJS MANDIRI',
            asuransi:'BPJS',
            lunas:true,
        },
        {
            id: 2,
            tanggal: '01-02-2020',
            no_invoice:'INV-2007000254',
            no_rm:12011456,
            no_bill:2002789,
            nama_pasien:'SHOLIHIN, Tn',
            ri_rj:'RJ',
            kamar:'Klinik P Dalam',
            bpjs:'',
            jam:'08:41',
            operator:'',
            stat_kamar:'Sesuai',
            admisi:'',
            klaim_bpjs:7000,
            total:540000,
            instansi:'PNS/TNI/POLRI',
            asuransi:'BPJS',
            lunas:true,
        },
        {
            id: 3,
            tanggal: '20-02-2020',
            no_invoice:'INV-200704123',
            no_rm:12014451,
            no_bill:2021134,
            nama_pasien:'TUMIDI, Tn',
            ri_rj:'RI',
            kamar:'Hemodialisa',
            bpjs:'',
            jam:'09:10',
            operator:'',
            stat_kamar:'sesuai',
            admisi:'',
            klaim_bpjs:0,
            total:4500000,
            instansi:'BPJS MANDIRI',
            asuransi:'BPJS',
            lunas:true,
        },
        {
            id: 4,
            tanggal: '01-03-2020',
            no_invoice:'INV-200704499',
            no_rm:12011234,
            no_bill:2000115,
            nama_pasien:'WULANDARI NINGSIH, Ny',
            ri_rj:'RI',
            kamar:'R.207 Level 1 Bed 1',
            bpjs:'',
            jam:'09:55',
            operator:'',
            stat_kamar:'Sesuai',
            admisi:'',
            klaim_bpjs:0,
            total:5000000,
            instansi:'BPJS MANDIRI',
            asuransi:'BPJS',
            lunas:true,
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataPDPKasir>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataPDPKasir>({});

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

    // const getDataTarif = async () => {
    //     try {
    //         setLoading(true);
    //         const resp = await dataTarifService.datatarif();
    //         setData(resp.list);
    //         setMeta(resp.metadata);
    //         setLoading(false);

    //     } catch (e) {
    //         console.log(e);
    //         setLoading(false);
    //     }
    // };

    // const onTableAction = (e: any) => {
    //     console.log('e', e);

    //     setPageSize(e?.pageSize);
    //     setPageNumber(e?.pageNumber);


    //     /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
    //     /// Next jika ada update akan diganti
    //     if(e.refresh) {
    //         // getDataTarif();
    //     }
    // };

    function isEmpty(obj: object) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

    const mounted:any = useRef();
    useEffect(() => {
        // fetchListMRS()

        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;

            // getDataTarif();
        }
    }, []);


    function handleChangeStartDate(e: any){
        console.log(e.target.value);
        // setStartDate(moment(e.target.value, "DD-MM-YYYY", true));
    }

    function handleChangeEndDate(e: any){
        console.log(e.target.value);
        // setEndDate(e.target.value);
    }

    return(
                <Table
                    minHeight={380}
                    disableNumber
                    title={'Laporan PDP Kasir'}
                    columns={tindakanColumn}
                    data={data}
                    loading={loading}
                    isPaginate={!hidePagination}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    editable={!loading}
                    filterable={true}
                />
    )
};

export default ListBillingInvoice;
