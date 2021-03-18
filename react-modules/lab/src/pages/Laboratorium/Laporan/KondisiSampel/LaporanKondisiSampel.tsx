import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';
import moment from 'moment';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import { detailDataKondisiSampel } from '../../../../pojo/laporan/kondisi_sampel/data_kondisi_sampel';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'tanggal',
        title: 'Tanggal',
        width: '100px',
        align: 'center',
        frozen: true,
        editable: true,
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
        id: 'no_mrs',
        title: 'No.MRS',
        width: '100px',
        align: 'center',
        frozen: true,
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="2"
                        value={row?.no_mrs}/>
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
        editRules: ['required'],
        
    },
    {
        id: 'tanggal_mrs',
        title: 'Tanggal MRS',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.tanggal_rms}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'no_reg',
        title: 'No.Reg',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.no_reg}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'sex_pasien',
        title: 'Sex',
        width: '7%',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.sex_pasien}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kondisi_sampel',
        title: 'Kondisi Sampel',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.kondisi_sampel}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'gol_periksa',
        title: 'Gol Pemeriksaan',
        width: '200px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.gol_periksa}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'nama_unit',
        title: 'Unit',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.nama_unit}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    
];

interface IPropsLaporanKondisiSampel {
    hidePagination?: boolean;
}

const LaporanKondisiSampel = (props: IPropsLaporanKondisiSampel) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            tanggal: '01-01-2020',
            tanggal_mrs: '01-01-2020',
            no_mrs:'200700001',
            no_reg:'12011233',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            kondisi_sampel:'Normal',
            gol_periksa:'Rutin',
            nama_unit:'Klinik Bedah Umum',
        },
        {
            id: 2,
            tanggal: '01-02-2020',
            tanggal_mrs: '01-01-2020',
            no_mrs:'200700001',
            no_reg:'12011244',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            kondisi_sampel:'Normal',
            gol_periksa:'Rutin',
            nama_unit:'Klinik Bedah Umum',
        },
        {
            id: 3,
            tanggal: '01-03-2020',
            tanggal_mrs: '01-01-2020',
            no_mrs:'200700001',
            no_reg:'12011278',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            kondisi_sampel:'Normal',
            gol_periksa:'Rutin',
            nama_unit:'Klinik Bedah Umum',
        },
        {
            id: 4,
            tanggal: '01-04-2020',
            tanggal_mrs: '01-01-2020',
            no_mrs:'200700001',
            no_reg:'12011299',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            kondisi_sampel:'Normal',
            gol_periksa:'Rutin',
            nama_unit:'Klinik Bedah Umum',
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataKondisiSampel>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataKondisiSampel>({});

    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

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
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
            {/* <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}> */}
            <div className={'kt-form col-lg-12 header-form kt-margin-t-25'}>
                    <div className={'form-group row'}>
                        <HorizontalInput
                            value={startDate}
                            onChange={(e) => handleChangeStartDate(e)}
                            label={'Tanggal'}
                            inputType={'date'}
                            colSize={2}
                            // fontSm={true}
                            formControlSm
                            disabled={false}
                            inputName={"tes"}
                        />
                        <HorizontalInput
                            value={endDate}
                            onChange={(e) => handleChangeEndDate(e)}
                            label={'Sampai'}
                            inputType={'date'}
                            colSize={2}
                            formControlSm
                            disabled={false}
                        />
                    </div>
                </div>
                </div>
                <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    height={450}
                    disableNumber
                    title={'Rekap Kondisi Sampel'}
                    columns={tindakanColumn}
                    data={data}
                    loading={loading}
                    isPaginate={!hidePagination}
                    total={meta.total_data}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    editable={!loading}
                    filterable={true}
                />
            </div>
        </div>
    )
};

export default LaporanKondisiSampel;
