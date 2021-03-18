import React, {useEffect, useRef, useState} from 'react';
import swal from 'sweetalert2';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
import dataFaktorEksposiService from '../../../../services/master/faktor_eksposi.service';
// import {detailDataFaktorEksposi} from "../../../../pojo/master/faktor_eksposi/data_faktor_eksposi";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, Tooltip, NumberBox, ComboBox} from "rc-easyui";
import {NotifySuccess, NotifyError} from "../../../../services/notification.service";
import EasyUISelectNamaPemeriksaan from "../../../../components/Shared/EasyUI/EasyUISelectNamaPemeriksaan";
import daftarNamaPemeriksaanContext from '../../../../stores/context/daftarNamaPemeriksaanContext';

interface IPropsMasterFaktorEksposi {
    hidePagination?: boolean;
}

const MasterFaktorEksposi = (props: IPropsMasterFaktorEksposi) => {
    let {
        hidePagination
    } = props;

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');

    const [selection, setSelection] = useState<any>(null);
    const [selectedTarif, setSelectedTarif] = useState<any>();

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);
  
    let tableRef: any = useRef(null);

    const operators = ["nofilter", "equal", "notequal", "less", "greater"];
    const optionKategori = [
        {
            value : 'Besar', text : 'Besar',
        },
        {
            value : 'Kecil', text : 'Kecil'
        },
        {
            value : 'Sedang', text : 'Sedang'
        }
    ]

    const useColumn = () => {
        return [
            {
                id: 'nama_pemeriksaan',
                title: 'Nama Pemeriksaan',
                width: '40%',
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
                id: 'kategori',
                title: 'Kategori',
                width: '15%',
                align: 'left',
                editable: true,
                editor: ({ row,error }: any) => (
                    <>
                        <Tooltip content={error} tracking>
                            <ComboBox
                                value={row?.kategori}
                                data={optionKategori}
                            />
                        </Tooltip>
                    </>
                ),
                filter:() => (
                    <>
                        <ComboBox
                            data={[
                                {
                                    value : null, text : 'Semua'
                                },
                                {
                                    value : 'Besar', text : 'Besar',
                                },
                                {
                                    value : 'Kecil', text : 'Kecil'
                                },
                                {
                                    value : 'Sedang', text : 'Sedang'
                                }
                            ]}
                            editable={false}
                            inputStyle={{ textAlign: 'center' }}
                        />
                    </>
                ),
                editRules: ['required']
            },
            {
                id: 'kv',
                title: 'KV',
                width: '15%',
                align: 'left',
                editable: true,
                editor: ({ row, error }: any) => (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.kv}/>
                        </Tooltip> 
                    </>
                ),
                editRules: ['required', 'positive'],
                filterOperators: operators,
                filter: () => <NumberBox></NumberBox>
            },
            {
                id: 'ma',
                title: 'MA',
                width: '15%',
                align: 'left',
                editable: true,
                editor: ({ row, error }: any) => (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.ma}/>
                        </Tooltip> 
                    </>
                ),
                editRules: ['required', 'positive'],
                filterOperators: operators,
                filter: () => <NumberBox></NumberBox>
            },
            {
                id: 'sec',
                title: 'SEC',
                width: '15%',
                align: 'left',
                editable: true,
                editor: ({ row, error }: any) => (
                    <>
                        <Tooltip content={error} tracking>
                            <NumberBox value={row?.sec}/>
                        </Tooltip> 
                    </>
                ),
                editRules: ['required', 'positive'],
                filterOperators: operators,
                filter: () => <NumberBox></NumberBox>
            }
        ]
    };

    const listColumn = useColumn();

    const getData = async (limit:any, page: any) => {
        try {
            setPageSize(limit);
            setPageNumber(page);
            setLoading(true);
            const param = {
                limit: limit
            }
            const resp = await dataFaktorEksposiService.datafaktoreksposi(param, page);
            setData(resp.list);
            setMeta(resp.metadata);
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
            getData(pageSize, pageNumber);
        }
    }, [pageSize, pageNumber]);

    const toolBar = ({editingItem}: any) => {
        return(
            <div style={{padding: 4}}>
                <LinkButton plain
                    disabled={(mode === 'add' || mode === 'edit')}
                    onClick={() => addNewData()}
                >
                    <i className="la la-plus"></i>
                    &nbsp;
                    Tambah
                </LinkButton>
                <LinkButton plain
                    disabled={(mode === 'add'|| mode === 'edit')}
                    onClick={() => {
                        setMode('edit');
                        setSelectedTarif(null);
                        if(Array.isArray(data) && data.length > 0) {
                            tableRef?.beginEdit(selection)
                        }
                    }}
                >
                    <i className="la la-edit"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                    disabled={
                        (mode === 'add' || mode === 'edit') ||
                        !selection
                    }
                    onClick={() => NotifyConfirm() }
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

    const NotifyConfirm = () => {
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
                setSelection(null);
            }
        })
    }

    const addNewData = async () => {
        const detailData = {
            nama_pemeriksaan: '',
            kategori :'',
            kv : 0,
            ma :0,
            sec :0,
            _new: true
        };
        let newData = Array.from(data);
        newData.unshift(detailData);
        setData(newData);
        setMode('add');
        setSelection(null);
        tableRef?.beginEdit(newData[0]);
    };

    const removeData = async () => {
        try {
            setLoading(true);
            const payload = {
                id_faktor_eksposi: selection.id,
            }
            const resp = await dataFaktorEksposiService.hapusfaktoreksposi(payload);
            if(resp.metadata.response_status === 200){
                await getData(pageSize, pageNumber);
                NotifySuccess(resp.metadata.message);
            } else {
                await getData(pageSize, pageNumber);
                NotifyError(resp.metadata.message);
            }
            setMode('');
            setLoading(false);
        } catch(e) {
            console.log('error', e);
            setLoading(false);
        }
    };


    const onTableAction = async (e: any) => {
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
            const newData = data.filter(row => row !== event.row);
            setData(newData);
        }
    };

    const onEditEnd = async (event: any) => {
        try {
            setLoading(true);
            if(mode === 'add') {
                const payload = {
                    nama_pemeriksaan: selectedTarif.text,
                    id_tarif: selectedTarif.value,
                    kategori: event?.row?.kategori,
                    kv: event?.row?.kv,
                    ma: event?.row?.ma,
                    sec: event?.row?.sec
                }
                const resp = await dataFaktorEksposiService.tambahfaktoreksposi(payload);
                if(resp.metadata.response_status === 200){
                    await getData(pageSize, pageNumber);
                    NotifySuccess(resp.metadata.message);
                } else {
                    await getData(pageSize, pageNumber);
                    NotifyError(resp.metadata.message);
                }
                setMode('');
                setLoading(false);
            } else if(mode === 'edit') {
                const payload = {
                    id_faktor_eksposi: event?.row?.id,
                    id_tarif: selectedTarif.value,
                    kategori: event?.row?.kategori,
                    kv: event?.row?.kv,
                    ma: event?.row?.ma,
                    sec: event?.row?.sec,
                }
                const resp = await dataFaktorEksposiService.ubahfaktoreksposi(payload);
                if(resp.metadata.response_status === 200){
                    await getData(pageSize, pageNumber);
                    NotifySuccess(resp.metadata.message);
                } else {
                    await getData(pageSize, pageNumber);
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
                tableRef?.beginEdit(data[0]);
            }
        }
    };

    const onPageChange = async (event: any) => {
        getData(event.pageSize, event.pageNumber);
    };

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <daftarNamaPemeriksaanContext.Provider value={[setSelectedTarif]}>
                    <Table
                        height={400}
                        disableNumber
                        title={'Faktor Eksposi Radiologi'}
                        columns={listColumn}
                        data={data}
                        loading={loading}
                        toolbar={toolBar}
                        isPaginate={!hidePagination}
                        total={meta.total_data}
                        pageNumber={pageNumber}
                        pageSize={pageSize}
                        editable={!loading}
                        filterable={true}
                        selectionMode={mode===''?'single':''}
                        selection={selection}
                        onSelectionChange={(selection) => {
                            if(mode!=='edit'){setSelection(selection)}
                        }}
                        onLoadTableRef={(ref) => onLoadTableRef(ref) }
                        onTableAction={onTableAction}
                        onEditCancel={onEditCancel}
                        onEditEnd={onEditEnd}
                        onPageChange={(e)=>onPageChange(e)}
                    />
                </daftarNamaPemeriksaanContext.Provider>
            </div>
        </div>
    )
};

export default MasterFaktorEksposi;
