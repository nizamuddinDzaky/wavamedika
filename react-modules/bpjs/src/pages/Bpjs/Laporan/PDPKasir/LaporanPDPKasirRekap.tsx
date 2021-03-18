import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
//import { detailDataKondisiSampel } from '../../../../pojo/laporan/kondisi_sampel/data_kondisi_sampel';
import { detailDataRekap } from '../../../../pojo/laporan/pdp_kasir/data_rekap';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumnRekap = [
    {
        id: 'nama_rekap',
        title: 'Rekapitulasi',
        width: '80%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_rekap}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jumlah',
        title: 'Jumlah',
        width: '20%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <NumberBox
                        value={row?.jumlah}/>
                </Tooltip>

            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
];

interface IPropsLaporanPDPKasirRekap {
    hidePagination?: boolean;
}

const LaporanPDPKasirRekap = (props: IPropsLaporanPDPKasirRekap) => {
    let {
        hidePagination
    } = props;

    const dataDummyRekap = [
        {
            id: 1,
            nama_rekap: 'Jumlah Pasien Laboratorium',
            jumlah: 1
        },
        {
            id: 2,
            nama_rekap: 'Jumlah Kunjungan MRS',
            jumlah: 1
        },
        {
            id: 3,
            nama_rekap: 'Jumlah Kunjungan MRS Asuransi Non BPJS',
            jumlah: 1
        },
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataRekap>>(dataDummyRekap);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataRekap>({});


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
                    title={'Laporan Jenis Pemeriksaan'}
                    columns={tindakanColumnRekap}
                    data={data}
                    loading={loading}
                    isPaginate={!hidePagination}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    editable={!loading}
                />
    )
};

export default LaporanPDPKasirRekap;
