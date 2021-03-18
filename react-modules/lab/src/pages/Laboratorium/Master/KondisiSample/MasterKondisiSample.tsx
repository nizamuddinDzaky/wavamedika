import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
import dataKondisiSampleService from '../../../../services/master/kondisi_sampel.service';
// import {detailDataKondisiSample} from "../../../../pojo/master/kondisi_sample/data_kondisi_sample";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, ComboBox, CheckBox} from "rc-easyui";
import {NotifySuccess, NotifyError} from "../../../../services/notification.service";
import swal from 'sweetalert2';

const status = [
    { 
        value: null, 
        text: "Semua" 
    },
    { 
        value: "true", 
        text: "Aktif" 
    },
    { 
        value: "false", 
        text: "Tidak Aktif" 
    }
];

const tindakanColumn = [
    {
        id: 'nama',
        title: 'Nama Kondisi Sample',
        width: '90%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama}/>
                </Tooltip>
            </>
        ),
        editRules: ['required']
    },
    {
        id: 'aktif',
        title: 'Aktif',
        width: '10%',
        align: 'center',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <CheckBox value={row?.aktif} checked={row?.aktif} ></CheckBox>
                </Tooltip>
            </>
        ),
        editRules: ['required'],
        filter: () => (
            <ComboBox
                data={status}
                editable={false}
                inputStyle={{ textAlign: 'center' }}
            />
        ),
        render: ({row} : any) => (
            <>
                <div>
                    <CheckBox value={row?.aktif} disabled></CheckBox>
                </div>
            </>
        ),
    }
];

interface IPropsMasterKondisiSample {
    hidePagination?: boolean;
}

const MasterKondisiSample = (props: IPropsMasterKondisiSample) => {
    let {
        hidePagination
    } = props;


    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<any>>([]);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<any>(null);

    const [pageSize, setPageSize] = useState<number>(10);
    const [pageNumber, setPageNumber] = useState<number>(1);

    let tableRef: any = useRef(null);

    const getData = async (limit: any, page: any) => {
        try {
            setPageSize(limit);
            setPageNumber(page);
            setLoading(true);
            const param = {
                limit : limit
            }
            const resp = await dataKondisiSampleService.datakondisisample(param, page);
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
                    onClick={() => NotifyConfirm()}
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

    const addNewData = async () => {
        const detailData = {
            nama: '',
            aktif: false,
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
                id_kondisi_sampel: selection.id,
            }
            const resp = await dataKondisiSampleService.hapuskondisisample(payload);
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
                    nama: event?.row?.nama,
                    aktif: event?.row?.aktif,
                }
                const resp = await dataKondisiSampleService.tambahkondisisample(payload);         
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
                    id_kondisi_sampel: event?.row?.id,
                    nama: event?.row?.nama,
                    aktif: event?.row?.aktif,
                }
                const resp = await dataKondisiSampleService.ubahkondisisample(payload);
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
                <Table
                    height={400}
                    disableNumber
                    title={'List Kondisi Sample'}
                    columns={tindakanColumn}
                    data={data}
                    loading={loading}
                    toolbar={toolBar}
                    isPaginate={!hidePagination}
                    isLazy={true}
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
            </div>
        </div>
    )
};

export default MasterKondisiSample;
