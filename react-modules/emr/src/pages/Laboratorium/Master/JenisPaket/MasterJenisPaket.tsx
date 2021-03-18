import React, {useEffect, useRef, useState} from 'react';
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

const tindakanColumnPaket = [
    {
        id: 'nama_paket',
        title: 'Nama Paket',
        width: '100%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_paket}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
];

const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumnPemeriksaan = [
    {
        id: 'nama_pemeriksaan',
        title: 'Nama Pemeriksaan',
        width: '80%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_pemeriksaan}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'qty',
        title: 'Qty',
        width: '20%',
        align: 'right',
        editable: true,
        editor: ({ row }: any) => (
            <>
                {/* <Tooltip content={error} tracking> */}
                    <NumberBox
                        value={row?.qty}/>
                {/* </Tooltip> */}

            </>
        ),
        editRules: ['required'],
        filterOperators: operators,
        filter: () => <NumberBox></NumberBox>
    }
];

interface IPropsMasterJenisPaket {
    hidePagination?: boolean;
}

const MasterJenisPaket = (props: IPropsMasterJenisPaket) => {
    let {
        hidePagination
    } = props;

    const dataDummyPaket = [
        {
            id: 1,
            nama_paket: 'Paket 1',
            pemeriksaan: [1]
        },
        {
            id: 2,
            nama_paket: 'Paket 2',
            pemeriksaan: [2]
        },
        {
            id: 3,
            nama_paket: 'Paket 3',
            pemeriksaan: [3]
        },
        {
            id: 4,
            nama_paket: 'Paket 4',
            pemeriksaan: [4] 
        }
    ];

    const dataDummyPemeriksaan = [
        {
            id: 1,
            nama_pemeriksaan: 'Pemeriksaan 1',
            qty: 1
        },
        {
            id: 2,
            nama_pemeriksaan: 'Pemeriksaan 2',
            qty: 3
        },
        {
            id: 3,
            nama_pemeriksaan: 'Pemeriksaan 3',
            qty: 2
        },
        {
            id: 4,
            nama_pemeriksaan: 'Pemeriksaan 4',
            qty: 4 
        }
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [dataPaket, setDataPaket] = useState<Array<detailDataPaketLab>>(dataDummyPaket);
    const [dataPemeriksaan, setDataPemeriksaan] = useState<Array<detailDataPemeriksaanLab>>([]);
    const [masterDataPemeriksaan, setMasterDataPemeriksaan] = useState<Array<detailDataPemeriksaanLab>>(dataDummyPemeriksaan);
    const [metaPaket, setMetaPaket] = useState<Metadata>({});
    const [metaPemeriksaan, setMetaPemeriksaan] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selectionPaket, setSelectionPaket] = useState<detailDataPaketLab>({});
    const [selectionPemeriksaan, setSelectionPemeriksaan] = useState<detailDataPemeriksaanLab>({});

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
                            disabled={(mode === 'add' || mode === 'edit' || isEmpty(selectionPaket))}
                            onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                            disabled={(mode === 'add'|| mode === 'edit' || isEmpty(selectionPemeriksaan))}
                            onClick={() => {
                                tableRef?.beginEdit(selectionPemeriksaan);
                                setMode('edit');
                            }}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit' || isEmpty(selectionPemeriksaan)) ||
                                !selectionPemeriksaan
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
                                console.log(masterDataPemeriksaan);
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
            nama_pemeriksaan: '',
            qty: 0,
            _new: true
        };

        let newData = Array.from(dataPemeriksaan);
        newData.unshift(detailData);
        setDataPemeriksaan(newData);
        setMode('add');
        setSelectionPemeriksaan({});
        tableRef?.beginEdit(newData[0]);

        // const currentData = Array.from(data);
        // currentData.unshift(detailData);
        // setData(currentData);
        // setMode('add');
        // tableRef?.beginEdit(data[0]);
    };

    // // const getData = async () => {
    // //     try {
    // //         setLoading(true);
    // //         const resp = await dataDiitService.datadiet();
    // //         setData(resp.list);
    // //         setMeta(resp.metadata);
    // //         setLoading(false);

    // //     } catch (e) {
    // //         setLoading(false);
    // //         setData([]);
    // //     }
    // // };

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

            const newData = masterDataPemeriksaan.filter(row => row.id !== selectionPemeriksaan.id);
            setMasterDataPemeriksaan(newData);
            setLoading(false);
            NotifySuccess('Data Pemeriksaan Pasien Berhasil Dihapus');

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
    };

    const onEditCancel = (event: any) => {
        setMode('');
        if (event.row._new) {
            const newData = dataPemeriksaan.filter(row => row !== event.row);
            setDataPemeriksaan(newData);
        }
    };

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
                    id: Number((dataDummyPemeriksaan[dataDummyPemeriksaan.length - 1 ]).id)+1,
                    nama_pemeriksaan: event?.row?.nama_pemeriksaan,
                    qty: event?.row?.qty
                }

                //menambah row data dummy pemeriksaan
                const newData = masterDataPemeriksaan;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setMasterDataPemeriksaan(currentData);

                //menambahkan id row riwayat baru pada array riwayat di pasien
                for (var i in dataDummyPaket) {
                    if (dataDummyPaket[i].id === selectionPaket.id) {
                       dataDummyPaket[i].pemeriksaan.push(payload.id);
                       break; //Stop this loop, we found it!
                    }
                }
                setDataPaket(dataDummyPaket);
                handleSelectionPaketChange(selectionPaket);

                setMode('');
                setLoading(false);
                NotifySuccess('Data Pemeriksaan Berhasil Ditambahkan');
                
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
                    nama_pemeriksaan: event?.row?.nama_pemeriksaan,
                    qty: event?.row?.qty
                }

                //merubah row data pemeriksaan
                setMode('');
                setLoading(false);
                NotifySuccess('Data Riwayat Berhasil Ditambahkan');
                const newData = masterDataPemeriksaan;
                const index = masterDataPemeriksaan.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setMasterDataPemeriksaan(newData);

                setMode('');
                setLoading(false);
                NotifySuccess('Data Pemeriksaan Berhasil Diubah');
            } else {
                setLoading(false);
            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRef?.beginEdit(dataPemeriksaan[0]);
            }
        }
    };

    function handleSelectionPaketChange(selection: any){
        const newPemeriksaanData = masterDataPemeriksaan.filter(function(pemeriksaan){
            return selection.pemeriksaan.indexOf(pemeriksaan.id) !== -1;
        });
        setDataPemeriksaan(newPemeriksaanData);
        setSelectionPaket(selection);
    }

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
                            title={'List Data Paket'}
                            columns={tindakanColumnPaket}
                            data={dataPaket}
                            tableType={'table-custom-2-table-left'}
                            loading={loading}
                            // toolbar={toolBar}
                            isPaginate={!hidePagination}
                            total={metaPaket.list_count}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            paginationOptions={'small'}
                            editable={!loading}
                            filterable={true}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selectionPaket) && null}
                            onSelectionChange={(selection) => handleSelectionPaketChange(selection)}
                            onLoadTableRef={(ref) => onLoadTableRef(ref) }
                            onTableAction={onTableAction}
                            // onEditCancel={onEditCancel}
                            // onEditEnd={onEditEnd}
                        />
                    </div>
                    <div className={'col-xl-8 col-md-8 col-sm-12'}>
                        <Table
                            height={450}
                            disableNumber
                            title={'List Data Pemeriksaan'}
                            columns={tindakanColumnPemeriksaan}
                            data={dataPemeriksaan}
                            tableType={'table-custom-2-table-right'}
                            loading={loading}
                            toolbar={toolBarPemeriksaan}
                            isPaginate={!hidePagination}
                            total={metaPemeriksaan.list_count}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={true}
                            selectionMode={(mode === 'edit' || mode === 'add') ? '' : 'single'}
                            selection={isEmpty(selectionPemeriksaan) && null}
                            onSelectionChange={(selection) => handleSelectionPemeriksaanChange(selection)}
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

export default MasterJenisPaket;
