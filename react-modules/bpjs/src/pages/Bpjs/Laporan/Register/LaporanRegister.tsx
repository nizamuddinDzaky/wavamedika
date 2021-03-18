import React, {useEffect, useRef, useState} from 'react';
import Metadata from '../../../../pojo/Metadata';
import { detailDataRegister } from '../../../../pojo/laporan/register/data_register';
import _ from 'lodash';
import moment from 'moment';
import customForm from '../../../../assets/js/customForm';
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import Table from "../../../../components/Table/Table";
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'nama_pasien',
        title: 'Nama Pasien',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="1" autoFocus
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
        id: 'tgl_lhr_pasien',
        title: 'Tgl. Lahir',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.tgl_lhr_pasien}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    }, 
    {
        id: 'no_billing',
        title: 'No. Billing',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="4"
                        value={row?.no_billing}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_bpjs',
        title: 'No. Kartu',
        width: '130px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="5"
                        value={row?.no_bpjs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'no_sjp_sep',
        title: 'No. SJP / SEP',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    {/*  */}
                    <TextBox tabIndex="6"
                        value={row?.no_sjp_sep}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
      
    },
    {
        id: 'jatah_kelas',
        title: 'Jatah Kelas',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="7"
                        value={row?.jatah_kelas}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'tgl_mrs',
        title: 'Tgl. MRS',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="8"
                        value={row?.tgl_mrs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'tgl_krs',
        title: 'Tgl. KRS',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="9"
                        value={row?.tgl_krs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'sex_pasien',
        title: 'Sex',
        width: '50px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="10"
                        value={row?.sex_pasien}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kamar',
        title: 'Ruang / Kamar',
        width: '145px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="11"
                        value={row?.kamar}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kelas',
        title: 'Kelas',
        width: '50px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="12"
                        value={row?.kelas}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jpf',
        title: 'JPF',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="13"
                        value={row?.jpf}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'nama_dokter',
        title: 'Nama Dokter',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="14"
                        value={row?.nama_dokter}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'keadaan_out',
        title: 'Keadaan Keluar',
        width: '130px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <NumberBox tabIndex="15"
                        value={row?.keadaan_out}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'berat_lhr',
        title: 'Berat Lahir',
        width: '80px',
        align: 'right',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="16"
                        value={row?.berat_lhr}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kd_ina_cbg',
        title: 'Kode INA-CBGs',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="17"
                        value={row?.kd_ina_cbg}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
];

interface IPropsLaporanRegister {
    hidePagination?: boolean;
}

const dataDummy = [
    {
        id: 1,
        nama_pasien:'SRIANAH, Ny.',
        no_rm:'12006950',
        tgl_lhr_pasien: '06-04-1970',
        no_billing:'200613943',
        no_bpjs: '0002920537045',
        no_sjp_sep: '1324R0070620V006398',
        jatah_kelas: 'III',
        tgl_mrs: '23-06-2020',
        tgl_krs: '24-06-2020',
        sex_pasien: 'P',
        kamar: 'Bed IGD',
        kelas: 'IIB',
        jpf: 'Penyakit Dalam',
        nama_dokter: 'Achmad Syarif Hidayatulloh',
        keadaan_out: 'Belum Sembuh',
        berat_lhr: '',
        kd_ina_cbg: '',
    }
];

const LaporanRegister = (props: IPropsLaporanRegister) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataRegister>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataRegister>({});

    const [startDate, setStartDate] = useState<string>(moment().format('YYYY-MM-DD'));
    const [endDate, setEndDate] = useState<string>(moment().format('YYYY-MM-DD'));

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

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

    const onTableAction = async (e: any) => {
        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        if(e.refresh) {
            tableRef?.cancelEdit();

            // getData();
        } else {
            // getData();
        }

        // if(props.onTableAction) {
        //     props.onTableAction(e)
        // }
    };

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
        console.log(tableRef);
    };

    const onEditCancel = (event: any) => {
        setMode('');
        if (event.row._new) {
            const newData = data.filter(row => row !== event.row);
            setData(newData);
        }
    };

    {/*const onEditEnd = async (event: any) => {
        try {
            setLoading(true);
            if(mode === 'add') {
                // const payload = {
                //     keterangan: event?.row?.keterangan,
                //     diet: event?.row?.diet

                // };
                // const resp = await dataDiitService.insert_diet(payload);
                // if(resp?.metadata && !resp?.metadata?.error) {
                //     getData();
                //     setMode('');
                //     NotifySuccess('Data Diit', resp?.metadata?.message)
                // }

                const payload = {
                    id: Number((data[data.length - 1 ]).id)+1,
                    nama_alkes: event?.row?.nama_alkes,
                    sat_besar: event?.row?.sat_besar,
                    qty: Number(event?.row?.qty),
                    sat_kecil: event?.row?.sat_kecil,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Alkes Lab Berhasil Ditambahkan');
                
                // const newData = Array.from(data);
                // newData.unshift(payload);
                // setData(newData);
                // setMode('');
                // setLoading(false);
                // NotifySuccess('Data Alkes Berhasil Ditambahkan');
            } else if(mode === 'edit') {
                // const data = {
                //
                // };
                // const resp = await transactionService.insert(data);
                // listTransaksi();
                const payload = {
                    id: event?.row?.id,
                    nama_alkes: event?.row?.nama_alkes,
                    sat_besar: event?.row?.sat_besar,
                    qty: Number(event?.row?.qty),
                    sat_kecil: event?.row?.sat_kecil,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Alkes Lab Berhasil Diubah');
            } else {
                setLoading(false);
            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(data[0]);
            }
        }
    };*/}

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
                    title={'List Register BPJS'}
                    columns={tindakanColumn}
                    data={data}
                    loading={loading}
                    //toolbar={toolBar}
                    isPaginate={!hidePagination}
                    total={meta.list_count}
                    pageNumber={pageNumber}
                    pageSize={pageSize}
                    editable={!loading}
                    filterable={true}
                    selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                    selection={isEmpty(selection) && null}
                    onSelectionChange={(selection) => setSelection(selection)}
                    onLoadTableRef={(ref) => onLoadTableRef(ref) }
                    onTableAction={onTableAction}
                    onEditCancel={onEditCancel}
                    //onEditEnd={onEditEnd}
                />
            </div>
        </div>
    )       
}

export default LaporanRegister;