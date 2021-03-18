import React, {useCallback, useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataPaketLab} from "../../../../pojo/master/jenis_paket/data_paket_lab";
import {detailDataPemeriksaanLab} from "../../../../pojo/master/jenis_paket/data_pemeriksaan_lab";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import moment from 'moment';
import { detailDataRekap } from '../../../../pojo/laporan/register/data_rekap';
import { detailDataRegister } from '../../../../pojo/laporan/register/data_register';


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


const tindakanColumnRegister = [
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
        id: 'no_rm',
        title: 'No.Reg',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.no_rm}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'pemeriksaan',
        title: 'Pemeriksaan',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.pemeriksaan}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'sex_pasien',
        title: 'Sex',
        width: '100px',
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
        id: 'umur_pasien',
        title: 'Umur',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <NumberBox tabIndex="4"
                        value={row?.umur_pasien}/>
                {/* </Tooltip> */}

            </>
        ),        
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'alamat_pasien',
        title: 'Alamat',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.alamat_pasien}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.jenis}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'golongan',
        title: 'Golongan',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.golongan}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'status',
        title: 'Status',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.status}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'rujuk',
        title: 'Rujuk ke',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.rujuk}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'unit',
        title: 'Dari Unit',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.unit}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    
];

interface IPropsLaporanRegister {
    hidePagination?: boolean;
}

const LaporanRegister = (props: IPropsLaporanRegister) => {
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

    const dataDummyRegister = [
        {
            id: 1,
            tanggal: '01-01-2020',
            tanggal_mrs: '01-01-2020',
            no_mrs:'200700001',
            no_rm:'12011233',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            alamat_pasien:'Kebomas',
            umur_pasien:14,
            status:'WH',
            jenis:'HEMATOLOGI',
            pemeriksaan:'Albumin',
            golongan:'Canggih',
            unit:'Klinik Bedah Umum',
            rujuk:'Wava Husada',
        },
        {
            id: 2,
            tanggal: '01-02-2020',
            tanggal_mrs: '01-02-2020',
            no_mrs:'200700001',
            no_rm:'12011233',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            alamat_pasien:'Kebomas',
            umur_pasien:14,
            status:'WH',
            jenis:'KIMIA - HATI',
            pemeriksaan:'SGPT',
            golongan:'Sederhana',
            unit:'Klinik Bedah Umum',
            rujuk:'Wava Husada',
        },
        {
            id: 3,
            tanggal: '01-03-2020',
            tanggal_mrs: '01-03-2020',
            no_mrs:'200700001',
            no_rm:'12011233',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            alamat_pasien:'Kebomas',
            umur_pasien:14,
            status:'WH',
            jenis:'KIMIA - GINJAL',
            pemeriksaan:'Ureum',
            golongan:'Sedang',
            unit:'Klinik Bedah Umum',
            rujuk:'Wava Husada',
        },
        {
            id: 4,
            tanggal: '01-04-2020',
            tanggal_mrs: '01-04-2020',
            no_mrs:'200700001',
            no_rm:'12011233',
            nama_pasien:'THAARIQ FAJRA M., An',
            sex_pasien:'L',
            alamat_pasien:'Kebomas',
            umur_pasien:14,
            status:'WH',
            jenis:'FAECES',
            pemeriksaan:'FL',
            golongan:'Canggih',
            unit:'Klinik Bedah Umum',
            rujuk:'Wava Husada',
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [dataRekap, setDataRekap] = useState<Array<detailDataRekap>>(dataDummyRekap);
    const [dataRegister, setDataRegister] = useState<Array<detailDataRegister>>([]);
    const [masterDataRegister, setMasterDataRegister] = useState<Array<detailDataRegister>>(dataDummyRegister);
    const [metaPaket, setMetaPaket] = useState<Metadata>({});
    const [metaPemeriksaan, setMetaPemeriksaan] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selectionPaket, setSelectionPaket] = useState<detailDataRekap>({});
    const [selectionPemeriksaan, setSelectionPemeriksaan] = useState<detailDataRegister>({});

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

    const toolBarPemeriksaan = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                >
                    <i className="la la-edit"></i>
                    &nbsp;
                    Hasil Pemeriksaan Laboratiorum
                </LinkButton>
                <LinkButton plain
                >
                    <i className="la la-edit"></i>
                    &nbsp;
                    Laporan Jenis Pemeriksaan
                </LinkButton>
                <LinkButton plain
                >
                    <i className="la la-edit"></i>
                    &nbsp;
                    Cetak
                </LinkButton>
            </div>
        )
    };


    function handleSelectionPemeriksaanChange(selection: any){
        setSelectionPemeriksaan(selection);
    }

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
                <div className={'row'}>
                    <div className={'col-xl-4 col-md-4 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'Rekapitulasi'}
                            columns={tindakanColumnRekap}
                            data={dataDummyRekap}
                            tableType={'table-custom-2-table-left table-custom-2-table-top'}
                            loading={loading}
                            // toolbar={toolBar}
                            isPaginate={!hidePagination}
                            total={metaPaket.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            paginationOptions={'small'}
                            editable={!loading}
                            filterable={true}
                            // onEditCancel={onEditCancel}
                            // onEditEnd={onEditEnd}
                        />
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Register'}
                            columns={tindakanColumnRegister}
                            data={dataDummyRegister}
                            tableType={'table-custom-2-table-right table-custom-2-table-bottom'}
                            loading={loading}
                            toolbar={toolBarPemeriksaan}
                            isPaginate={!hidePagination}
                            total={metaPemeriksaan.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={true}
                        />
                    </div>
                </div>
            </div>
        </div>
    )
};

export default LaporanRegister;
