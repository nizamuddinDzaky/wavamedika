import React, {useEffect, useRef, useState} from 'react';
import swal from 'sweetalert2';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
import dataJenisPaketService from '../../../../services/master/jenis_paket.service';
// import {detailDataPaketLab} from "../../../../pojo/master/jenis_paket/data_paket_lab";
// import {detailDataPemeriksaanLab} from "../../../../pojo/master/jenis_paket/data_pemeriksaan_lab";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox} from "rc-easyui";
import {NotifySuccess, NotifyError} from "../../../../services/notification.service";
import _ from 'lodash';
import EasyUISelectNamaPemeriksaan from "../../../../components/Shared/EasyUI/EasyUISelectNamaPemeriksaan";
import daftarNamaPemeriksaanContext from '../../../../stores/context/daftarNamaPemeriksaanContext';

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
                <EasyUISelectNamaPemeriksaan
                    value={row?.nama_pemeriksaan}
                    error={error}
                />
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
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <NumberBox
                        value={row?.qty}/>
                </Tooltip>
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

    const [loading, setLoading] = useState<boolean>(false);
    const [dataPaket, setDataPaket] = useState<Array<any>>([]);
    const [dataPemeriksaan, setDataPemeriksaan] = useState<Array<any>>([]);
    const [metaPaket, setMetaPaket] = useState<Metadata>({});
    const [metaPemeriksaan, setMetaPemeriksaan] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selectionPaket, setSelectionPaket] = useState<any>(null);
    const [selectionPemeriksaan, setSelectionPemeriksaan] = useState<any>(null);
    const [selectedTarif, setSelectedTarif] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRefPaket: any = useRef(null);
    let tableRef: any = useRef(null);

    const getDataPaket = async () => {
        try {
            setLoading(true);
            const resp = await dataJenisPaketService.datadaftarpaket();
            setDataPaket(resp.list);
            setMetaPaket(resp.metadata);
            setLoading(false);
        } catch (e) {
            console.log(e);
            setLoading(false);
        }
    };

    const getDataPemeriksaan = async (id_paketlab:any) => {
        try {
            setLoading(true);
            const param = {
                id_paketlab: id_paketlab
            }
            const resp = await dataJenisPaketService.datadaftarpemeriksaan(param);
            setDataPemeriksaan(resp.list);
            setMetaPemeriksaan(resp.metadata);
            setLoading(false);
        } catch (e) {
            console.log(e);
            setLoading(false);
        }
    };

    const mounted:any = useRef();
    useEffect(() => {
        // Component Did Mount
        if (!mounted.current) {
            mounted.current = true;
            getDataPaket();
        }
    }, []);

    const toolBarPaket = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                    disabled={(mode === 'add' || mode === 'edit')}
                    onClick={() => addNewDataPaket()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                    disabled={(mode === 'add'|| mode === 'edit' || !selectionPaket)}
                    onClick={() => {
                        setMode('edit');
                        if(Array.isArray(dataPaket) && dataPaket.length > 0) {
                            tableRefPaket?.beginEdit(selectionPaket)
                        }
                    }}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                    disabled={
                        (mode === 'add' || mode === 'edit') ||
                        !selectionPaket
                    }
                    onClick={() => NotifyConfirmPaket()}
                >
                    <i className="flaticon2-trash"></i>
                    &nbsp;
                    Hapus
                </LinkButton>
                <LinkButton plain
                            disabled={editingItem == null}
                            onClick={() => tableRefPaket?.endEdit()}
                >
                    <i className="la la-save"></i>
                    &nbsp;
                    Simpan
                </LinkButton>
                <LinkButton plain
                            disabled={editingItem == null}
                            onClick={() => tableRefPaket?.cancelEdit()}
                >
                    <i className="la la-times"></i>
                    &nbsp;
                    Batal
                </LinkButton>
                <LinkButton plain
                    onClick={() => {
                        console.log(selectionPaket);
                        console.log(selectionPemeriksaan);
                    }}
                >
                    <i className="la la-times"></i>
                    &nbsp;
                    Debug
                </LinkButton>
            </div>
        )
    };

    const toolBarPemeriksaan = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                    disabled={(mode === 'add' || mode === 'edit' || !selectionPaket)}
                    onClick={() => addNewDataPemeriksaan()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                    disabled={(mode === 'add'|| mode === 'edit' || !selectionPemeriksaan)}
                    onClick={() => {
                        setMode('edit');
                        if(Array.isArray(dataPemeriksaan) && dataPemeriksaan.length > 0) {
                            tableRef?.beginEdit(selectionPemeriksaan)
                        }
                    }}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                    disabled={
                        (mode === 'add' || mode === 'edit' || !selectionPemeriksaan)
                    }
                    onClick={() => NotifyConfirmPemeriksaan()}
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
            </div>
        )
    };

    const NotifyConfirmPaket = () => {
        swal.fire({
            title: 'Apakah Anda yakin menghapus data?',
            text: "Anda tidak akan bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                removeDataPaket();
                setSelectionPaket(null);
            }
        })
    }

    const NotifyConfirmPemeriksaan = () => {
        swal.fire({
            title: 'Apakah Anda yakin menghapus data?',
            text: "Anda tidak akan bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                removeData();
                setSelectionPemeriksaan(null);
            }
        })
    }

    const addNewDataPaket = async () => {
        const detailData = {
            nama_paket: '',
            _new: true
        };
        let newData = Array.from(dataPaket);
        newData.unshift(detailData);
        setDataPaket(newData);
        setMode('add');
        setSelectionPaket(null);
        tableRefPaket?.beginEdit(newData[0]);
    };

    const addNewDataPemeriksaan = async () => {
        const detailData = {
            nama_pemeriksaan: '',
            qty: 0,
            _new: true
        };
        let newData = Array.from(dataPemeriksaan);
        newData.unshift(detailData);
        setDataPemeriksaan(newData);
        setMode('add');
        setSelectionPemeriksaan(null);
        tableRef?.beginEdit(newData[0]);
    };

    const removeDataPaket = async () => {
        try {
            setLoading(true);
            const payload = {
                id_paketlab: selectionPaket.id,
            }
            const resp = await dataJenisPaketService.hapusdaftarpaket(payload);
            if(resp.metadata.response_status === 200){
                await getDataPaket();
                NotifySuccess(resp.metadata.message);
            } else {
                await getDataPaket();
                NotifyError(resp.metadata.message);
            }
            setSelectionPaket(null);
            setDataPemeriksaan([]);
            setMode('');
            setLoading(false);
        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };

    const removeData = async () => {
        try {
            setLoading(true);
            const payload = {
                id_paketlab_det: selectionPemeriksaan.id,
            }
            const resp = await dataJenisPaketService.hapusdaftarpemeriksaan(payload);
            if(resp.metadata.response_status === 200){
                await getDataPemeriksaan(selectionPaket.id);
                NotifySuccess(resp.metadata.message);
            } else {
                await getDataPemeriksaan(selectionPaket.id);
                NotifyError(resp.metadata.message);
            }
            setMode('');
            setLoading(false);
        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };

    const onTableActionPaket = async (e: any) => {
        if(e.refresh) {
            tableRefPaket?.cancelEdit();

            // getDataPaket();
        } else {
            // getDataPaket();
        }

        // if(props.onTableActionPaket) {
        //     props.onTableActionPaket(e)
        // }
    };

    const onTableAction = async (e: any) => {
        /// Karena pagination belum ready diAPI, untuk sekarang sekali query render paginationnya untuk fetch data pas componentDidMount aja atau pas refresh
        /// Next jika ada update akan diganti
        console.log(e);
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

    const onLoadTableRefPaket = (ref: any) => {
        tableRefPaket = ref;
        new (customForm as any)(tableRefPaket); // for tab on enter, inside table ref
    };

    const onLoadTableRef = (ref: any) => {
        tableRef = ref;
        new (customForm as any)(tableRef); // for tab on enter, inside table ref
    };

    const onEditCancelPaket = (event: any) => {
        setMode('');
        if (event.row._new) {
            const newDataPaket = dataPaket.filter(row => row !== event.row);
            setDataPaket(newDataPaket);
        }
    };

    const onEditCancel = (event: any) => {
        setMode('');
        if (event.row._new) {
            const newDataPemeriksaan = dataPemeriksaan.filter(row => row !== event.row);
            setDataPemeriksaan(newDataPemeriksaan);
        }
    };

    const onEditEndPaket = async (event: any) => {
        try {
            setLoading(true);
            if(mode === 'add') {
                const payload = {
                    nama_paket: event?.row?.nama_paket
                }
                const resp = await dataJenisPaketService.tambahdaftarpaket(payload);
                if(resp.metadata.response_status === 200){
                    await getDataPaket();
                    NotifySuccess(resp.metadata.message);
                } else {
                    await getDataPaket();
                    NotifyError(resp.metadata.message);
                }
                setSelectionPaket(null);
                setDataPemeriksaan([]);
                setMode('');
                setLoading(false);
            } else if(mode === 'edit') {
                const payload = {
                    id_paketlab: event?.row?.id,
                    nama_paket: event?.row?.nama_paket,
                }
                const resp = await dataJenisPaketService.ubahdaftarpaket(payload);
                if(resp.metadata.response_status === 200){
                    await getDataPaket();
                    NotifySuccess(resp.metadata.message);
                } else {
                    await getDataPaket();
                    NotifyError(resp.metadata.message);
                }
                setSelectionPaket(null);
                setDataPemeriksaan([]);
                setMode('');
                setLoading(false);
            } else {
                setLoading(false);
            }
        } catch (e) {
            console.log('error', e);
            setLoading(false);

            if(mode === 'add') {
                tableRefPaket?.beginEdit(dataPaket[0]);
            }
        }
    };

    const onEditEnd = async (event: any) => {
        try {
            setLoading(true);
            if(mode === 'add') {
                const payload = {
                    id_paketlab: selectionPaket.id,
                    id_tarif: selectedTarif.value,
                    qty: event?.row?.qty,
                }
                const resp = await dataJenisPaketService.tambahdaftarpemeriksaan(payload);
                if(resp.metadata.response_status === 200){
                    await getDataPemeriksaan(selectionPaket.id);
                    NotifySuccess(resp.metadata.message);
                } else {
                    await getDataPemeriksaan(selectionPaket.id);
                    NotifyError(resp.metadata.message);
                }
                setMode('');
                setLoading(false);
            } else if(mode === 'edit') {
                const payload = {
                    id_paketlab_det: event?.row?.id,
                    id_paketlab: selectionPaket.id,
                    id_tarif: selectedTarif.value,
                    qty: event?.row?.qty,
                }
                const resp = await dataJenisPaketService.ubahdaftarpemeriksaan(payload);
                if(resp.metadata.response_status === 200){
                    await getDataPemeriksaan(selectionPaket.id);
                    NotifySuccess(resp.metadata.message);
                } else {
                    await getDataPemeriksaan(selectionPaket.id);
                    NotifyError(resp.metadata.message);
                }
                setMode('');
                setLoading(false);
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
        getDataPemeriksaan(selection.id);
        setSelectionPaket(selection);
        setSelectionPemeriksaan(null);
    }

    function handleSelectionPemeriksaanChange(selection: any){
        setSelectionPemeriksaan(selection);
    }

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <div className={'row'}>
                    <div className={'col-xl-6 col-md-6 col-sm-12'}>
                        <Table
                            height={400}
                            disableNumber
                            title={'List Data Paket'}
                            columns={tindakanColumnPaket}
                            data={dataPaket}
                            tableType={'table-custom-2-table-left table-custom-2-table-top'}
                            loading={loading}
                            toolbar={toolBarPaket}
                            isPaginate={!hidePagination}
                            total={metaPaket.total_data}
                            pageNumber={pageNumber}
                            pageSize={pageSize}
                            editable={!loading}
                            filterable={true}
                            selectionMode={mode===''?'single':''}
                            selection={selectionPaket}
                            onSelectionChange={(selection) => {
                                if(mode!=='edit'){handleSelectionPaketChange(selection)}
                            }}
                            onLoadTableRef={(ref) => onLoadTableRefPaket(ref) }
                            onTableAction={onTableActionPaket}
                            onEditCancel={onEditCancelPaket}
                            onEditEnd={onEditEndPaket}
                        />
                    </div>
                    <div className={'col-xl-6 col-md-6 col-sm-12'}>
                        <daftarNamaPemeriksaanContext.Provider value={[setSelectedTarif]}>
                            <Table
                                height={400}
                                disableNumber
                                title={'List Data Pemeriksaan'}
                                columns={tindakanColumnPemeriksaan}
                                data={dataPemeriksaan}
                                tableType={'table-custom-2-table-right table-custom-2-table-bottom'}
                                loading={loading}
                                toolbar={toolBarPemeriksaan}
                                isPaginate={!hidePagination}
                                total={metaPemeriksaan.total_data}
                                pageNumber={pageNumber}
                                pageSize={pageSize}
                                editable={!loading}
                                filterable={true}
                                selectionMode={mode===''?'single':''}
                                selection={selectionPemeriksaan}
                                onSelectionChange={(selection) => {
                                    if(mode!=='edit'){handleSelectionPemeriksaanChange(selection)}
                                }}
                                onLoadTableRef={(ref) => onLoadTableRef(ref) }
                                onTableAction={onTableAction}
                                onEditCancel={onEditCancel}
                                onEditEnd={onEditEnd}
                            />
                        </daftarNamaPemeriksaanContext.Provider>
                    </div>
                </div>
            </div>
        </div>
    )
};

export default MasterJenisPaket;
