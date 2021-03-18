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
import SelectInput,{ISelector} from '../../../../components/Forms/Input/SelectInput';
import moment from 'moment';
import { detailDataRekap } from '../../../../pojo/laporan/register/pemakaian_darah/data_rekap';
import { detailDataRujukPartial } from '../../../../pojo/laporan/register/rujuk_partial/data_rujuk_partial';


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
        id: 'no_rm',
        title: 'No.RM',
        width: '100px',
        align: 'center',
        frozen: true,
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
        id: 'no_mrs',
        title: 'No.MRS',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.no_mrs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'no_lab',
        title: 'No.LAB',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="2"
                        value={row?.no_lab}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
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
        id: 'sex',
        title: 'Sex',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.sex}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'umur',
        title: 'Umur',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.umur}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'alamat',
        title: 'Alamat',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.alamat}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'pemeriksaan',
        title: 'Pemeriksaan',
        width: '100px',
        align: 'center',
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
        id: 'jumlah',
        title: 'Jumlah',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <NumberBox tabIndex="4"
                        value={row?.jumlah}/>
                {/* </Tooltip> */}

            </>
        ),        
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    },
    {
        id: 'nama_unit',
        title: 'Nama Unit',
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
    {
        id: 'asuransi',
        title: 'Asuransi',
        width: '150px',
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
        id: 'rujuk_partial',
        title: 'Rujuk Partial',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.rujuk_partial}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    }
];

interface IPropsLaporanRegisterRujukPartial {
    hidePagination?: boolean;
}

const LaporanRegisterRujukPartial = (props: IPropsLaporanRegisterRujukPartial) => {
    const [Total, setTotal] = useState<number>(0);
    const [Pemeriksaan, setPemeriksaan] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [Asuransi, setAsuransi] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [NamaUnit, setNamaUnit] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [RujukPartial, setRujukPartial] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    const [JenisTransfusi, setJenisTransfusi] = useState<ISelector>({
        value: '_',
        label: 'Semua'
    });
    
    const [listPemeriksaan, setListPemeriksaan] = useState<Array<ISelector>>([]);
    const [listAsuransi, setListAsuransi] = useState<Array<ISelector>>([]);
    const [listNamaUnit, setListNamaUnit] = useState<Array<ISelector>>([]);
    const [listRujukPartial, setListRujukPartial] = useState<Array<ISelector>>([]);
    const [listJenisTransfusi, setListJenisTransfusi] = useState<Array<ISelector>>([]);
    const [optionalProps, setOptionalProps] = useState<any>({
       
    });

    const onClickRefresh = (e: any) => {
        e.preventDefault();

        setOptionalProps({
            Pemeriksaan:Pemeriksaan.value
        });
    }

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

    const dataDummyRegisterRujukPartial = [
        {
            id: 1,
            tanggal: '10-10-2020',
            no_rm: '327863',
            no_mrs: 'RM365623',
            no_lab:3768736,
            nama_pasien: 'santoso',
            sex: 'P',
            umur :17,
            alamat: 'Surabaya',
            pemeriksaan: 'Medis',
            jumlah : 1424,
            nama_unit: 'Organ Dalama',
            asuransi: 'DGO',
            rujuk_partial: 'RS MDS'
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [dataRekap, setDataRekap] = useState<Array<detailDataRekap>>(dataDummyRekap);
    const [dataRegister, setDataRegister] = useState<Array<detailDataRujukPartial>>([]);
    const [masterDataRegister, setMasterDataRegister] = useState<Array<detailDataRujukPartial>>(dataDummyRegisterRujukPartial);
    const [metaPaket, setMetaPaket] = useState<Metadata>({});
    const [metaPemeriksaan, setMetaPemeriksaan] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selectionPaket, setSelectionPaket] = useState<detailDataRekap>({});
    const [selectionPemeriksaan, setSelectionPemeriksaan] = useState<detailDataRujukPartial>({});

    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM'));
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
                <form className={'kt-form col-xl-12 header-form kt-margin-t-25 row'}>
                    <div className={'col-xl-4 col-lg-6'}>
                            <div className={'row col-xl-12'}>
                                <HorizontalInput
                                    value={startDate}
                                    onChange={(e) => handleChangeStartDate(e)}
                                    label={'Tanggal'}
                                    inputType={'month'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    inputName={"tes"}
                                />
                                <SelectInput 
                                    value={Pemeriksaan}
                                    onChange={(e) => setPemeriksaan(e)}
                                    label={'Nama Pemeriksaan'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listPemeriksaan}
                                />   
                                <SelectInput 
                                    value={NamaUnit}
                                    onChange={(e) => setNamaUnit(e)}
                                    label={'NamaUnit'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listNamaUnit}
                                />   
                                 
                            </div>
                    </div>
                    <div className={'col-xl-4 col-lg-6'}>
                        <div className={'row col-lg-12'}>
                        <SelectInput 
                                    value={RujukPartial}
                                    onChange={(e) => setRujukPartial(e)}
                                    label={'Rujuk Partial'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listRujukPartial}
                                />   
                                <SelectInput 
                                    value={Asuransi}
                                    onChange={(e) => setAsuransi(e)}
                                    label={'Asuransi'}
                                    inputType={'text'}
                                    colSize={9}
                                    labelSize={3}
                                    // fontSm={true}
                                    formControlSm
                                    disabled={false}
                                    options={listAsuransi}
                                />   
                        </div>
                    </div>
                    <div className={'col-xl-2 col-lg-2'}>
                        <button 
                            // type={'submit'}
                            onClick={onClickRefresh}
                            className='col-12 btn btn-sm btn-primary kt-margin-l-10 kt-margin-t-20'>
                                <i className={'la la-filter'}/> Filter
                        </button>
                    </div>
                </form>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-12 col-md-12 col-lg-12 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Rujuk Partial'}
                            columns={tindakanColumnRegister}
                            data={dataDummyRegisterRujukPartial}
                            loading={loading}
                            toolbar={toolBarPemeriksaan}
                            isPaginate={!hidePagination}
                            total={metaPemeriksaan.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={false}
                        />
                    </div>
                </div>
            </div>

            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm border kt-margin-b-20 kt-margin-t-20 kt-margin-l-30 kt-margin-r-30 border border-10 border-success'}>
                <form className={'kt-form col-xl-12 header-form kt-margin-t-20 kt-margin-b-20 row'}>
                    <div className={'col-xl-6 col-lg-6'}></div>
                    <div className={'col-xl-4 col-lg-6'}>
                            <div className={'row col-xl-12'}>
                                <HorizontalInput
                                        value={Total}
                                        onChange={(e) => setTotal(e.target.value)}
                                        label={'Total'}
                                        inputType={'number'}
                                        colSize={9}
                                        labelSize={3}
                                        // fontSm={true}
                                        formControlSm
                                        disabled={false}
                                        styles={{fontSize:30}}
                                        // ref={register} 
                                    />
                            </div>
                    </div>
                </form>
            </div>
        </div>
    )
};

export default LaporanRegisterRujukPartial;
