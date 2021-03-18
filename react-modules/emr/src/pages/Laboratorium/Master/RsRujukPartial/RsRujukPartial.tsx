import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataRsRujukPartial} from "../../../../pojo/master/rs_rujuk_partial/data_rs_rujuk_partial";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, CheckBox, TextBox, Tooltip, NumberBox, ComboBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import _ from 'lodash';

// const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'nama_rs',
        title: 'Nama Rs Rujuk Partail',
        width: '50%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_rs}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'status',
        title: 'Aktif',
        width: '50%',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <CheckBox checked={row?.status ? true : false}></CheckBox>
                </Tooltip>

            </>
        ),
        filter:() => (
           
                <ComboBox
                data={[
                  {
                    value : null, text : 'SEMUA'
                  },
                  {
                    value : true, text : 'AKTIF',
                  },
                  {
                    value : false, text : 'TIDAK AKTIF'
                  }
                ]}
                editable={false}
                inputStyle={{ textAlign: 'center' }}
                />
            
          ),

        editRules: ['required'],
        render: ({row}: any) => (
            <>
                <div>
                    <CheckBox checked={row?.status ? true : false}></CheckBox>
                </div>
            </>
        )
    }
];

interface IPropsMasterRsRujukPartial {
    hidePagination?: boolean;
}

const MasterRsRujukPartial = (props: IPropsMasterRsRujukPartial) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            nama_rs: 'RSSA A',
            status : true 
        },
        {
            id: 2,
            nama_rs: 'RSSA B',
            status : false
        },
        {
            id: 3,
            nama_rs: 'RSSA C',
            status : true 
        },
      
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataRsRujukPartial>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState();

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

        const detailData = {
            nama_rs: '',
            status :true,
            _new: true
        };

        let newData = Array.from(data);
        newData.unshift(detailData);
        setData(newData);
        setMode('add');
        setSelection({});
        tableRef?.beginEdit(newData[0]);
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

    // const removeData = async () => {
    //     try {
    //         setLoading(true);

    //         const data = {
    //             id_diet: selection.id_diet,
    //         };
    //         const resp = await dataDiitService.delete_diet(data);

    //         if(resp?.metadata && !resp?.metadata?.error) {
    //             getData();
    //             setMode('');
    //             NotifySuccess('Data Diit Gizi', resp?.metadata?.message)
    //         };
    //     } catch(e) {
    //         console.log('error', e);
    //         setLoading(false);
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
            NotifySuccess('Data Alkes Lab Berhasil Dihapus');

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
                    nama_rs: event?.row?.nama_rs,
                    status: event?.row?.status,
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
                    nama_rs: event?.row?.nama_rs,
                    status: event?.row?.status,
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
    };

    return(
        <div className={'kt-portlet kt-portlet--height-fluid kt-portlet--mobile'}>
            {/*<div className={'kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm'}>*/}
            {/*</div>*/}
            <div className={'kt-portlet__body kt-portlet__body--fit kt-margin-b-20 kt-margin-t-20'}>
                <Table
                    // height={450}
                    // disableNumber
                    // title={'List Rumah Sakit Rujuk Partial'}
                    // columns={tindakanColumn}
                    // data={data}
                    // loading={loading}
                    // toolbar={toolBar}
                    // isPaginate={!hidePagination}
                    // total={meta.list_count}
                    // pageNumber={pageNumber}
                    // pageSize={pageSize}
                    // editable={!loading}
                    // filterable={true}
                    // onLoadTableRef={(ref) => onLoadTableRef(ref) }
                    // onTableAction={onTableAction}
                    // onEditCancel={onEditCancel}
                    height={450}
                    disableNumber
                    title={'List Rumah Sakit Rujuk Partial'}
                    columns={tindakanColumn}
                    data={data}
                    loading={loading}
                    toolbar={toolBar}
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
                    onEditEnd={onEditEnd}
                />
            </div>
        </div>
    )
};

export default MasterRsRujukPartial;
