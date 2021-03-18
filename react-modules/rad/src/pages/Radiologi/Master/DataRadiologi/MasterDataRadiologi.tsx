import React, {useEffect, useRef, useState} from 'react';
import Table from "../../../../components/Table/Table";
import customForm from "../../../../assets/js/customForm";
// import dataTarifService from '../../../../services/dataTarif.service';
import {detailDataRadiologi} from "../../../../pojo/master/data_radiologi/data_radiologi";
import Metadata from "../../../../pojo/Metadata";
import {LinkButton, TextBox, Tooltip, NumberBox, ComboBox, CheckBox} from "rc-easyui";
import {NotifySuccess} from "../../../../services/notification.service";
import swal from 'sweetalert2';
import _ from 'lodash';

// const operators = ["nofilter", "equal", "notequal", "less", "greater"];

const tindakanColumn = [
    {
        id: 'nama_pemeriksakan',
        title: 'Nama Pemeriksakan',
        width: '60px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.nama_pemeriksakan}/>
                </Tooltip>

            </>
        ),
        editRules: ['required'],
        frozen : true
    },
    {
        id: 'status',
        title: 'Status',
        width: '100px',
        align: 'center',
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
    },
    {
        id: 'jenis',
        title: 'Jenis',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.jenis}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'golongan',
        title: 'Golongan',
        width: '150px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.golongan}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'kode',
        title: 'Kode No.Reg',
        width: '200px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.kode}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'vvip',
        title: 'VVIP',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.vvip}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'vip',
        title: 'VIP',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.vip}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'vipb',
        title: 'VIPB',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.vipb}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'i',
        title: 'I',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.i}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'ia',
        title: 'IA',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.ia}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'ib',
        title: 'IB',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.ib}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'ii',
        title: 'II',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.ii}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'iia',
        title: 'IIA',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.iia}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'iib',
        title: 'IIB',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.iib}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'iii',
        title: 'III',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.iii}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'iiia',
        title: 'IIIA',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.iiia}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
    {
        id: 'iiib',
        title: 'IIIB',
        width: '100px',
        align: 'left',
        editable: true,
        editor: ({ row,error }: any) => (
            <>
                <Tooltip content={error} tracking>
                    <TextBox
                        value={row?.iiib}/>
                </Tooltip>

            </>
        ),
        editRules: ['required']
    },
];

interface IPropsMasterDataRadiologi {
    hidePagination?: boolean;
}

const MasterDataRadiologi = (props: IPropsMasterDataRadiologi) => {
    let {
        hidePagination
    } = props;

    const dataDummy = [
        {
            id: 1,
            nama_pemeriksakan : 'ABDOMEN LDD',
            status : true,
            jenis : 'RONDGEN A',
            golongan : 'A',
            kode : 'A123S',
            vvip :1236,
            vip : 7827426,
            vipb : 26772,
            i : 878237332,
            ia : 835553732,
            ib : 2442732,
            ii : 26727732,
            iia : 255255732,
            iib : 8282732,
            iii : 18185732,
            iiia : 99995732,
            iiib : 11115732, 
        },
        {
            nama_pemeriksakan : 'ABDOMEN LDB',
            status : false,
            jenis : 'RONDGEN B',
            golongan : 'AB',
            kode : 'A74676G',
            vvip :3663,
            vip : 78287426,
            vipb : 45772,
            i : 178237332,
            ia : 235553732,
            ib : 3442732,
            ii : 46727732,
            iia :5255255732,
            iib : 6282732,
            iii : 78185732,
            iiia : 89995732,
            iiib : 11115732,
        },
      
    ];

    const [loading, setLoading] = useState<boolean>(false);
    const [data, setData] = useState<Array<detailDataRadiologi>>(dataDummy);
    const [meta, setMeta] = useState<Metadata>({});
    const [mode, setMode] = useState<string>('');
    const [selection, setSelection] = useState<detailDataRadiologi>({});

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
                    <i className="la la-edit"></i>
                    &nbsp;
                    Ubah
                </LinkButton>
                <LinkButton plain
                            disabled={
                                (mode === 'add' || mode === 'edit') ||
                                !selection
                            }
                            onClick={() => NotifyConfirm('Data Radiologi Berhasil Dihapus') }
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

    const NotifyConfirm = (title?: string, message?: string) => {
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
                swal.fire({
                    icon: 'success',
                    title: title,
                    text: message
                })
                removeData()
            }
          })
    }

    const addNewData = async () => {
        // await loadDataComboBox();
        if (!tableRef?.endEdit()) {
            return;
        }

        const detailData = {
            nama_pemeriksakan : '',
            status : true,
            jenis : '',
            golongan : '',
            kode : '',
            vvip : 0,
            vip : 0,
            vipb :0,
            i : 0,
            ia : 0,
            ib : 0,
            ii : 0,
            iia : 0,
            iib : 0,
            iii : 0,
            iiia : 0,
            iiib : 0,
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
                    nama_pemeriksakan: event?.row?.nama_pemeriksakan,
                    status: event?.row?.status,
                    jenis: event?.row?.jenis,
                    golongan: event?.row?.golongan,
                    kode: event?.row?.kode,
                    vvip: event?.row?.vvip,
                    vip: event?.row?.vip,
                    vipb: event?.row?.vipb,
                    i: event?.row?.i,
                    ia: event?.row?.ia,
                    ib: event?.row?.ib,
                    ii: event?.row?.ii,
                    iia: event?.row?.iia,
                    iib: event?.row?.iib,
                    iii: event?.row?.iii,
                    iiia: event?.row?.iiia,
                    iiib: event?.row?.iiib,
                }
                const newData = data;
                newData.push(payload);
                const currentData = newData.filter(row => row !== event.row);
                setData(currentData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Radiologi Berhasil Ditambahkan');
                
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
                    nama_pemeriksakan: event?.row?.nama_pemeriksakan,
                    status: event?.row?.status,
                    jenis: event?.row?.jenis,
                    golongan: event?.row?.golongan,
                    kode: event?.row?.kode,
                    vvip: event?.row?.vvip,
                    vip: event?.row?.vip,
                    vipb: event?.row?.vipb,
                    i: event?.row?.i,
                    ia: event?.row?.ia,
                    ib: event?.row?.ib,
                    ii: event?.row?.ii,
                    iia: event?.row?.iia,
                    iib: event?.row?.iib,
                    iii: event?.row?.iii,
                    iiia: event?.row?.iiia,
                    iiib: event?.row?.iiib,
                }
                const newData = data;
                const index = data.findIndex(row => row.id === event.row.id);
                newData.splice(index, 1);
                newData.splice(index, 0, payload);
                setData(newData);
                setMode('');
                setLoading(false);
                NotifySuccess('Data Radiologi Berhasil Diubah');
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
                    // title={'List Daftar Layanan'}
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
                    title={'Data Radiologi'}
                    columns={tindakanColumn}
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
        </div>
    )
};

export default MasterDataRadiologi;
