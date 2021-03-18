import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataTerimaSampel} from "../../../../pojo/entry/terima_sampel/data_terima_sampel";
import {detailDataSampel} from "../../../../pojo/entry/terima_sampel/data_detail_sampel";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import HorizontalInput from "../../../../components/Forms/Input/HorizontalInput";
import _ from 'lodash';
import moment from 'moment';
import { red } from '@material-ui/core/colors';

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumnTerimaSampelKanan =[
    {
        id: 'uraian',
        title: 'Uraian',
        width: '100%',
        align: 'center',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.uraian}/>
            </>
        ),
        editRules: ['required']
    },
];

const tindakanColumnTerimaSampel = [
    {
        id: 'nomor_lab',
        title: 'Nomor LAB',
        width: '100px',
        align: 'left',
        frozen : true,
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="1" autoFocus
                    value={row?.nomor_lab}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'nama_pasien',
        title: 'Nama Pasien',
        width: '200px',
        align: 'left',
        frozen : true,
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="2" autoFocus
                    value={row?.nama_pasien}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'ambil',
        title: 'Ambil',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="3" autoFocus
                    value={row?.ambil}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_rm',
        title: 'No RM',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="4" autoFocus
                    value={row?.nomor_rm}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'tanggal',
        title: 'Tanggal',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="5" autoFocus
                    value={row?.tanggal}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'jam',
        title: 'Jam',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="6" autoFocus
                    value={row?.jam}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'pengambilan',
        title: 'Pengambilan',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="7" autoFocus
                    value={row?.pengambilan}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'umur',
        title: 'Umur',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="8" autoFocus
                    value={row?.umur}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'alamat',
        title: 'Alamat',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="9" autoFocus
                    value={row?.alamat}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'unit',
        title: 'Unit',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="10" autoFocus
                    value={row?.unit}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'no_mrs',
        title: 'No MRS',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="11" autoFocus
                    value={row?.no_mrs}/>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'dokter',
        title: 'Dokter',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row }: any) => (
            <>
                <TextBox tabIndex="12" autoFocus
                    value={row?.dokter}/>
            </>
        ),
        editRules: ['required']
    }
];

interface IPropsTerimaSampel {
    hidePagination?: boolean;
}

const TerimaSampel = (props: IPropsTerimaSampel) => {
    let {
        hidePagination
    } = props;

    const dataDummyTerimaSampelKanan = [
        {
            id: 1,
            uraian: 'SGOT',
        },
        {
            id: 2,
            uraian: 'SGPT',
        },
        {
            id: 3,
            uraian: 'LED',
        }
    ];

    const dataDummyTerimaSampel = [
        {
            id: 1,
            nomor_lab: '36773',
            nama_pasien: 'budi',
            ambil: 'sekarang',
            no_rm: 32637,
            tanggal: '12-12-2020',
            jam: '12:20',
            pengambilan: '12-08-2020',
            umur: 20,
            alamat: 'jln ahmad yani',
            unit: 'A',
            no_mrs: 763863,
            dokter: 'siti' 
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataTerimaSampel>>(dataDummyTerimaSampel);
    const [dataSampel, setDataSampel] = useState<Array<detailDataSampel>>(dataDummyTerimaSampelKanan);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataTerimaSampel>({});
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

    const toolBar = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                {/* <LinkButton plain
                            disabled={(mode === 'add' || mode === 'edit')}
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton> */}
                <LinkButton plain
                            disabled={(mode === 'add'|| mode === 'edit')}
                            onClick={() => {
                                tableRef?.beginEdit(selection);
                                setMode('edit');
                            }}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit') ||
                                !selection
                            }
                            onClick={() => removeData()}
                >
                    <i className="flaticon2-trash"></i>
                    &nbsp;
                    Hapus
                </LinkButton>
                <LinkButton plain
                            disabled={editingItem == null}
                            onClick={() => tableRef?.endEdit()}
                >
                    <i className="la la-save"></i>
                    &nbsp;
                    Simpan
                </LinkButton>
                <LinkButton plain
                            disabled={editingItem == null}
                            onClick={() => tableRef?.cancelEdit()}
                >
                    <i className="la la-times"></i>
                    &nbsp;
                    Batal
                </LinkButton>
                <LinkButton plain
                            onClick={() => {
                                console.log(selection);
                            }}
                >
                    <i className="la la-times"></i>
                    &nbsp;
                    Debugging
                </LinkButton>
            </div>
        )
    };

    const addNewData = async () => {
        // await loadDataComboBox();

        if (!tableRef?.endEdit()) {
            return;
        }

        const detailData = {
            id: 0,
            nomor_lab: '',
            nama_pasien: '',
            ambil: '',
            no_rm: 0,
            tanggal: '',
            jam: '',
            pengambilan: '',
            umur: 0,
            alamat: '',
            unit: '',
            no_mrs: 0,
            dokter: '',
            _new: true
        };

        let newData = Array.from(data);
        newData.unshift(detailData);
        setData(newData);
        setMode('add');
        setSelection({});
        tableRef?.beginEdit(newData[0]);

        // const currentData = Array.from(data);
        // currentData.unshift(detailData);
        // setData(currentData);
        // setMode('add');
        // tableRef?.beginEdit(data[0]);
    };

    // const getData = async () => {
    //     try {
    //         setLoading(true);
    //         const resp = await dataDiitService.datadiet();
    //         setData(resp.list);
    //         setMeta(resp.metadata);
    //         setLoading(false);

    //     } catch (e) {
    //         setLoading(false);
    //         setData([]);
    //     }
    // };

    const removeData = async () => {
        try {
            setLoading(true);

            // const data = {
            //     id_diet: selection.id_diet,
            // };
            // const resp = await dataDiitService.delete_diet(data);

            // if(resp?.metadata && !resp?.metadata?.error) {
            //     getData();
            //     setMode('');
            //     NotifySuccess('Data Diit Gizi', resp?.metadata?.message)
            // };

            const newData = data.filter(row => row.id !== selection.id);
            setData(newData);
            setLoading(false);
            NotifySuccess('Data Terima Sampel Berhasil Dihapus');

        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };


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


    function handleChangeStartDate(e: any){
        console.log(e.target.value);
        // setStartDate(moment(e.target.value, "DD-MM-YYYY", true));
    }

    function handleChangeEndDate(e: any){
        console.log(e.target.value);
        // setEndDate(e.target.value);
    }

    const onEditEnd = async (event: any) => {
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
                    nomor_lab: event?.row?.nomor_lab,
                    nama_pasien: event?.row?.nama_pasien,
                    ambil: event?.row?.ambil,
                    no_rm: event?.row?.no_rm,
                    tanggal: event?.row?.tanggal,
                    jam: event?.row?.jam,
                    pengambilan: event?.row?.pengambilan,
                    umur: event?.row?.umur,
                    alamat: event?.row?.alamat,
                    unit: event?.row?.unit,
                    no_mrs: event?.row?.no_mrs,
                    dokter: event?.row?.dokter,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Terima Sampel Berhasil Ditambahkan');
                
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
                    nomor_lab: event?.row?.nomor_lab,
                    nama_pasien: event?.row?.nama_pasien,
                    ambil: event?.row?.ambil,
                    no_rm: event?.row?.no_rm,
                    tanggal: event?.row?.tanggal,
                    jam: event?.row?.jam,
                    pengambilan: event?.row?.pengambilan,
                    umur: event?.row?.umur,
                    alamat: event?.row?.alamat,
                    unit: event?.row?.unit,
                    no_mrs: event?.row?.no_mrs,
                    dokter: event?.row?.dokter,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Terima Sampel Berhasil Diubah');
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
    };

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-xl-12 header-form kt-margin-t-25 row'}>
                    <div className={'col-xl-2'}>
                        <a 
                            // type={'submit'}
                            href={'/lab/entry/terima-lab/cari-biling'}
                            className='col-1 btn btn-sm btn-secondary kt-margin-t-20 kt-margin-l-10 float-right'>
                            Cari Billing
                        </a>    
                        <a 
                            // type={'submit'}
                            href={'/lab/entry/terima-lab'}
                            className='col-1 btn btn-sm btn-warning kt-margin-t-20 kt-margin-l-10 float-right'>
                            Buat Billing
                        </a>
                        <a 
                            // type={'submit'}
                            href={'#'}
                            className='col-1 btn btn-sm btn-danger kt-margin-t-20 kt-margin-l-10 float-right'>
                            Hapus
                        </a>
                        <a 
                            // type={'submit'}
                            href={'/lab/entry/terimaa-sampel/baru'}
                            className='col-1 btn btn-sm btn-primary kt-margin-t-20 float-right'>
                            Baru
                        </a>
                        
                        
                    </div>
                </div>
            </div>

            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-0'}>
                    <hr/>
                </div>
            </div>

            <div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>
                <div className={'kt-form col-lg-12 header-form kt-margin-t-5'}>
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
                        <div className={'kt-margin-l-20'} style={{height: 30,width : 30, backgroundColor: '#ff8c1a'}}></div>
                        <span className={'kt-margin-l-20'}><h4>Sudah Dibuatkan Billing</h4></span>
                        <div className={'kt-margin-l-20'} style={{height: 30,width : 30, backgroundColor: '#b8b894'}}></div>
                        <span className={'kt-margin-l-20'}><h4>hasil Pemeriksakan Selesai</h4></span>
                    </div>
                </div>
            </div>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-lg-8'}>
                        <Table
                        height={450}
                        disableNumber
                        title={'List Terima Sampel'}
                        columns={tindakanColumnTerimaSampel}
                        tableType={'table-custom-2-table-left'}
                        data={data}
                        loading={loading}
                        toolbar={toolBar}
                        isPaginate={!hidePagination}
                        total={meta.total_data}
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
                        onEditEnd={onEditEnd}
                        />
                    </div>
                    <div className={'col-lg-4'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Uraian Sampel'}
                            columns={tindakanColumnTerimaSampelKanan}
                            tableType={'table-custom-2-table-right'}
                            data={dataSampel}
                            loading={loading}
                            isPaginate={!hidePagination}
                            total={meta.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={false}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selection) && null}
                            onSelectionChange={(selection) => setSelection(selection)}
                            onLoadTableRef={(ref) => onLoadTableRef(ref) }
                            onTableAction={onTableAction}
                            onEditCancel={onEditCancel}
                            onEditEnd={onEditEnd}
                        />
                    </div>
                </div>
            </div>
        </div>
    )
};

export default TerimaSampel;
