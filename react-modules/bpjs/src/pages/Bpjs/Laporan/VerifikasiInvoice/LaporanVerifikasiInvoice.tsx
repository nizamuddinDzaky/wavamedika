import React, {useEffect, useRef, useState} from 'react';
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import Metadata from '../../../../pojo/Metadata';
import Table from "../../../../components/Table/Table";
import HorizontalInput from '../../../../components/Forms/Input/HorizontalInput';
import _ from 'lodash';
import moment from 'moment';
import customForm from '../../../../assets/js/customForm';
import { detailDataVerifikasiInvoice } from '../../../../pojo/laporan/verifikasi_invoice/data_verifikasi_invoice';


const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'tgl_invoice',
        title: 'Tgl. Invoice',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="1" autoFocus
                        value={row?.tgl_mrs}/>
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
                    <TextBox tabIndex="2"
                        value={row?.no_billing}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_rm',
        title: 'No. RM',
        width: '100px',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="3"
                        value={row?.no_rm}/>
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
        id: 'no_bpjs',
        title: 'No BPJS',
        width: '110px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="5"
                        value={row?.no_bpjs}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_sep',
        title: 'No. SEP',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="6"
                        value={row?.no_sep}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'status_kamar',
        title: 'Status Kamar',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="7"
                        value={row?.status_kamar}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'total_invoice',
        title: 'Total Invoice',
        width: '120px',
        align: 'right',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="8"
                        value={row?.total_invoice}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'status',
        title: 'Status',
        width: '80px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="9"
                        value={row?.status}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kd_ina_cbg',
        title: 'INA-CBGs',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="10"
                        value={row?.kd_ina_cbg}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jml_klaim',
        title: 'Jml. Klaim',
        width: '120px',
        align: 'right',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="11"
                        value={row?.jml_klaim}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kamar',
        title: 'Kamar / Bed',
        width: '130px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <NumberBox tabIndex="12"
                        value={row?.kamar}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
    },
    {
        id: 'unit',
        title: 'Unit',
        width: '130px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <TextBox tabIndex="13"
                        value={row?.unit}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required']
    },
];

interface IPropsLaporanVerifikasiInvoice {
    hidePagination?: boolean;
}

const dataDummy = [
    {
        id: 1,
        tgl_invoice: '24-06-2020',
        no_billing: '200612839',
        no_rm: '12010917',
        nama_pasien: 'ANGGRAH DEBBY ARDIANSYAH, Sdra.',
        no_bpjs: '0001441888413',
        no_sep: '1324R0070620V005640',
        status_kamar: 'Sesuai',
        total_invoice: '4,064,481',
        status: 'Trial',
        kd_ina_cbg: 'J-4-15-II',
        jml_klaim: '5,180,900',
        kamar: 'Isolasi 314 B',
        unit: 'Rawat Inap H',
    }
];

const LaporanVerifikasiInvoice = (props: IPropsLaporanVerifikasiInvoice) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataVerifikasiInvoice>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataVerifikasiInvoice>({});

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
                    title={'List Verifikasi Invoice Pasien BPJS'}
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

export default LaporanVerifikasiInvoice